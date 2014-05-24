<?php
namespace WdgImageGallery\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class GalleryController extends AbstractActionController
{
    /**
     * @var \WdgImageGallery\Service\Gallery
     */
    public $service;
    
    public function indexAction()
    {
        return new ViewModel();
    }
    
    /**
     * @return \WdgImageGallery\Service\Gallery
     */
    public function getService()
    {
        if($this->service === null)
        {
            $this->service = $this->$this->getServiceLocator()->get('wdgimagegallery_service_gallery');
        }
        
        return $this->service;
    }
}