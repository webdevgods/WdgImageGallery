<?php
namespace WdgImageGallery\Service;

use WdgZf2\Service\ServiceAbstract,
    WdgImageGallery\Options\ModuleOptionsInterface,
    DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as PaginatorAdapter,
    Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator,
    Zend\Paginator\Paginator as ZendPaginator,
    WdgImageGallery\Entity\Album as AlbumEntity,
    WdgImageGallery\Exception\Service\FormException as FormException;

class Gallery extends ServiceAbstract
{
    /**
     * @var \WdgImageGallery\Repository\Album
     */
    protected $albumRepository;
    
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;
    
    /**
     * @var \WdgImageGallery\Options\ModuleOptionsInterface
     */
    protected $options;
    
    /**
     * @return \Zend\Form\Form 
     */
    public function getAddAlbumForm()
    {
        return $this->getServiceManager()->get('FormElementManager')->get('wdgimagegallery_album_add_form');
    }
    
    /**
     * @param int $id
     * @return \Zend\Form\Form 
     */
    public function getEditAlbumForm($id)
    {
        $Album = $this->getAlbumById($id);
        
        /* @var $form \Zend\Form\Form */
        $form = $this->getServiceManager()->get('FormElementManager')->get('wdgimagegallery_album_edit_form');

        $form->populateValues($Album->toArray());

        return $form;
    }
    
    /**
     * @param \WdgImageGallery\Entity\Album $album
     * @return Form
     */
    public function getAlbumAddImageForm(AlbumEntity $album)
    {
        /* @var $form \Zend\Form\Form */
        $form = $this->getServiceManager()->get('FormElementManager')->get('wdgimagegallery_album_add_image_form');
        
        $form->get("album_id")->setValue($album->getId());
        
        return $form;
    }  
    
    /**
     * @param int $id
     * @return \WdgImageGallery\Entity\Album
     */
    public function getAlbumById($id)
    {
        return $this->getAlbumRepository()->findOneBy(array("id" => $id));
    }
    
    /**
     * @return array
     */
    public function getAllAlbums()
    {
        return $this->getAlbumRepository()->findAll();
    }
    
    /**
     * @param int $pageNumber
     * @param int $albumsPerPage
     * @return ZendPaginator
     */
    public function getAlbumsPaginator($pageNumber, $albumsPerPage)
    {
        $paginator = new ZendPaginator(
                        new PaginatorAdapter(
                            new ORMPaginator($this->getAlbumRepository()->findAlphaPaginationQuery())
                        )
                    );
        
        return $paginator->setCurrentPageNumber($pageNumber)->setItemCountPerPage($albumsPerPage);
    }
    
    /**
     * @param array $array
     * @return \WdgImageGallery\Entity\Album
     * @throws FormException
     */
    public function addAlbumByArray(array $array)
    {
        $form   = $this->getAddAlbumForm();
        $em     = $this->getEntityManager();

        $form->setData($array);

        if(!$form->isValid())throw new FormException("Form values are invalid");

        $data   = $form->getInputFilter()->getValues();
        $Album  = new AlbumEntity();

        $Album->setTitle($data["title"])
            ->setSlug($data["slug"]);

        $em->persist($Album);

        $em->flush();

        return $Album;
    }
    
    /**
     * @param array $array
     * @return AlbumEntity
     * @throws FormException
     */
    public function editAlbumByArray($array)
    {
        $form   = $this->getEditAlbumForm($array["id"]);
        $em     = $this->getEntityManager();

        $form->setData($array);

        if(!$form->isValid())throw new FormException("Form values are invalid");

        $data   = $form->getInputFilter()->getValues();

        $Album = $this->getAlbumById($data["id"]);

        $Album->setTitle($data["title"])
            ->setSlug($data["slug"]);

        $em->persist($Album);

        $em->flush();

        return $Album;
    }
    
    /**
     * @param array $data
     * @return \FileBank\Entity\File
     * @throws FormException
     */
    public function addAlbumImageByArray($data)
    {
        $album      = $this->getAlbumById($data["album_id"]);
        $form       = $this->getAlbumAddImageForm($album);
        $em         = $this->getEntityManager();

        $form->setData($data);

        if(!$album || !$form->isValid())throw new FormException("Form values are invalid");
        
        $em->beginTransaction();
        
        $tags = array();
            
        if($this->getOptions()->getImageTag())
        {
            $tags[] = $this->getOptions()->getImageTag();
        }

        /* @var $fileBank \FileBank\Manager */
        $fileBank = $this->getServiceManager()->get('FileBank');

        /* @var $file \FileBank\Entity\File */
        $file = $fileBank->save($data["image"]["tmp_name"], $tags);

        if(isset($data["image_name"]) && strlen($data["image_name"]) > 0)
            $file->setName($data["image_name"]);

        $album->addImage($file);

        $em->persist($file);
        
        $em->persist($album);  
        
        $em->commit(); 
              
        $em->flush();
        
        return $file;
    }
    
    /**
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEntityManager()
    {
        if($this->entityManager === null)
        {
            $this->entityManager = $this->getServiceManager()->get("wdgimagegallery_doctrine_em");
        }
        
        return $this->entityManager;
    }
    
    /**
     * @param \WdgImageGallery\Service\ModuleOptionsInterface $options
     */
    public function setOptions( ModuleOptionsInterface $options )
    {
        $this->options = $options;
    }

    /**
     * @return \WdgImageGallery\Options\ModuleOptionsInterface
     */
    public function getOptions()
    {
        if (!$this->options instanceof ModuleOptionsInterface) {
            $this->setOptions($this->getServiceManager()->get('wdgimagegallery_module_options'));
        }
        
        return $this->options;
    }
    
    /**
     * @return \WdgImageGallery\Repository\Album
     */
    public function getAlbumRepository()
    {
        if($this->albumRepository === NULL)
            $this->albumRepository = $this->getServiceManager()->get('wdgimagegallery_repos_album');
        
        return $this->albumRepository;
    }
}