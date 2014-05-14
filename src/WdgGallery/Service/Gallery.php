<?php
namespace WdgImageGallery\Service;

use WdgZf2\Service\ServiceAbstract,
    WdgImageGallery\Options\ModuleOptionsInterface;

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
     * @return array
     */
    public function getAllAlbums()
    {
        return $this->getAlbumRepository()->findAll();
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
            $this->albumRepository = new \WdgImageGallery\Repository\Album();
        
        return $this->albumRepository;
    }
}