<?php
namespace WdgImageGallery\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class GalleryController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}