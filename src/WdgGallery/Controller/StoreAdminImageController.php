<?php
namespace WdgImageGallery\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    WdgImageGallery\Options\ModuleOptions;

class GalleryAdminImageController extends AbstractActionController
{
    protected $options;
    protected $galleryService;
    
    public function indexAction()
    {
        return new ViewModel;
    }
    
    public function setOptions(ModuleOptions $options)
    {
        $this->options = $options;
        return $this;
    }

    public function getOptions()
    {
        if (!$this->options instanceof ModuleOptions) {
            $this->setOptions($this->getServiceLocator()->get('wdgimagegallery_module_options'));
        }
        return $this->options;
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
    
    public function getTranslator()
    {
        return $this->getServiceLocator()->get('translator');
    }
}