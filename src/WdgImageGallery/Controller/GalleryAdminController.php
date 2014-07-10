<?php
namespace WdgImageGallery\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use WdgImageGallery\Options\ModuleOptionsInterface as ModuleOptions;

class GalleryAdminController extends AbstractActionController
{
    protected $options;
    
    protected $galleryService;
    
    public function indexAction()
    {
        $page       = (int) $this->params()->fromRoute('page', 0);
        $paginator  = $this->getGalleryService()->getAlbumsPaginator($page, 10);
        
        if($paginator->count() > 0 && $paginator->count() < $page)
            $this->redirect()->toRoute("zfcadmin/wdg-imagegallery-admin");
        
        return new ViewModel(
                array(
                    'albums' => $paginator,
                    'albumlistElements' => $this->getOptions()->getAlbumListElements()
                )
            );
    }
    
    public function showAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        
        return new ViewModel(array("album" => $this->getGalleryService()->getAlbumById($id)));
    }
    
    public function addAction()
    {
        $service    = $this->getGalleryService();        
        $form       = $service->getAddAlbumForm();
        $request    = $this->getRequest();
        
        if($request->isPost())
        {
            $post = $request->getPost();
            
            try 
            {
                $Album = $service->addAlbumByArray($post->toArray());
                
                $this->flashMessenger()->addSuccessMessage("Added Album");

                return $this->redirect()->toRoute("zfcadmin/wdg-imagegallery-admin/album/show", array("id" => $Album->getId()));
            }
            catch (\WdgImageGallery\Exception\Service\FormException $exc)
            {
                $this->flashMessenger()->addErrorMessage($exc->getMessage());
            }
            catch (\Exception $exc)
            {
                $this->flashMessenger()->addErrorMessage("Could not add album: ".$exc->getMessage());
            }
            
            $form->setData($post)->isValid();   
        }
        
        return new ViewModel(array('form' => $form));
    }
    
    public function editAction()
    {
        $service    = $this->getGalleryService();
        $form       = $service->getEditAlbumForm($this->getEvent()->getRouteMatch()->getParam("id"));
        $request    = $this->getRequest();
        
        if($request->isPost())
        {
            $post = $request->getPost();
            
            try 
            {
                $Album = $service->EditAlbumByArray($post->toArray());
                
                $this->flashMessenger()->addSuccessMessage("Edited Album");

                return $this->redirect()->toRoute("zfcadmin/wdg-imagegallery-admin/album/show", array("id" => $Album->getId()));
            }
            catch (\WdgImageGallery\Exception\Service\FormException $exc)
            {
                $this->flashMessenger()->addErrorMessage($exc->getMessage());
            }
            catch (\Exception $exc)
            {
                $this->flashMessenger()->addErrorMessage("Could not edit album: ".$exc->getMessage());
            }
            
            $form->setData($post)->isValid();   
        }
        
        return new ViewModel(array("form" => $form));
    }
    
    public function deleteAction()
    {
        $id = $this->getEvent()->getRouteMatch()->getParam("id");
        
        try 
        {
            $this->getGalleryService()->deleteAlbum($id);
            
            $this->flashMessenger()->addSuccessMessage("Album Deleted");
        } 
        catch(\Exception $exc) 
        {
            $this->flashMessenger()->addErrorMessage($exc->getMessage());
        }
        
        return $this->redirect()->toRoute("zfcadmin/wdg-imagegallery-admin");
    }
    
    public function addImageAction()
    {
        $id         = (int) $this->params()->fromRoute('id', 0);
        $service    = $this->getGalleryService();
        $album      = $service->getAlbumById($id);
        $request    = $this->getRequest();
        
        if(!$album)
        {
            $this->flashMessenger()
                ->addErrorMessage(
                    $this->getTranslator()->translate('No album with that id')
                );
            
            $this->redirect()->toRoute("zfcadmin/wdg-imagegallery-admin");
        }
        
        $form = $service->getAlbumAddImageForm($album);
        
        if($request->isPost())
        {
            $post = $request->getPost();
            
            try 
            {
                $data = array_merge_recursive(
                    $post->toArray(),          
                    $this->getRequest()->getFiles()->toArray()
                );
                
                $service->addAlbumImageByArray($data);
                
                $this->flashMessenger()->addSuccessMessage("Added Image");

                return $this->redirect()->toRoute("zfcadmin/wdg-imagegallery-admin/album/show", array("id" => $album->getId()));
            }
            catch (\WdgStore\Exception\Service\Store\FormException $exc)
            {
                $this->flashMessenger()->addErrorMessage($exc->getMessage());
            }
            catch (\Exception $exc)
            {
                $this->flashMessenger()->addErrorMessage("Could not add image: ".$exc->getMessage());
            }
            
            $form->setData($data)->isValid();   
        }
        
        return new ViewModel(array("form" => $form, "album" => $album));
    }
    
    public function removeImageAction()
    {
        $id         = (int) $this->params()->fromRoute("id");        
        $image_id   = (int) $this->params()->fromRoute('image_id', 0);
        
        try 
        {
            $this->getGalleryService()->removeImage($id, $image_id);
            
            $this->flashMessenger()->addSuccessMessage("Image Removed");
        } 
        catch(\Exception $exc) 
        {
            $this->flashMessenger()->addErrorMessage($exc->getMessage());
        }
        
        return $this->redirect()->toRoute("zfcadmin/wdg-imagegallery-admin/album/show", array("id" => $id));
    }
    
    /**
     * getGalleryService
     *
     * @return \WdgImageGallery\Service\Gallery
     */
    public function getGalleryService()
    {
        if (null === $this->galleryService)
        {
            $this->galleryService = $this->getServiceLocator()->get('wdgimagegallery_service_gallery');
        }
        return $this->galleryService;
    }
    
    /**
     * @param \WdgImageGallery\Options\ModuleOptionsInterface
     */
    public function setOptions(ModuleOptions $options)
    {
        $this->options = $options;
        
        return $this;
    }
    
    /**
     * @return \WdgImageGallery\Options\ModuleOptionsInterface
     */
    public function getOptions()
    {
        if (!$this->options instanceof ModuleOptions) 
        {
            $this->setOptions($this->getServiceLocator()->get('wdgimagegallery_module_options'));
        }
        
        return $this->options;
    }
}