<?php
namespace WdgImageGallery;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        $config         = array();
        $configFiles    = array(
            'module.config.php',
            'routes.config.php',
        );
        
        foreach ($configFiles as $configFile) 
        {
            $config = \Zend\Stdlib\ArrayUtils::merge($config, include __DIR__ . '/config/' . $configFile);
        }

        return $config;
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    /**
     * {@InheritDoc}
     */
    public function getControllerConfig() 
    {
        return include __DIR__ . '/config/controller.config.php';
    }
    
    public function getServiceConfig() 
    {
        return include __DIR__ . '/config/services.config.php';
    }
    
    /**
    * {@InheritDoc}
    */
    public function getFormElementConfig()
    {
        return include __DIR__ . '/config/form-elements.config.php';
    }
    
    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                // the array key here is the name you will call the view helper by in your view scripts
                'wdgImageGallery' => function($sm) {
                    // $sm is the view helper manager, so we need to fetch the main service manager
                    $locator = $sm->getServiceLocator(); 
                    $galleryService = $locator->get("wdgimagegallery_service_gallery");
                    
                    return new \WdgImageGallery\View\Helper\Gallery($galleryService->getAllAlbums());
                },
            ),
        );
    }
}

