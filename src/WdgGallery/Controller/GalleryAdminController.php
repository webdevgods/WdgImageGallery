<?php
namespace WdgImageGallery\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class GalleryAdminController extends AbstractActionController
{
    protected $galleryService;
    
    public function indexAction()
    {
        return new ViewModel();
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
}