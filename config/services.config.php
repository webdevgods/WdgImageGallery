<?php
namespace WdgImageGallery;

return array(
    'invokables' => array(
        'wdgimagegallery_service_gallery' => 'WdgImageGallery\Service\Gallery'
    ),
    'factories' => array(
        'wdgimagegallery_doctrine_em' => function ($sm) {
            return $sm->get('doctrine.entitymanager.orm_default');
        },
        'wdgimagegallery_module_options' => function ($sm) {
            $config = $sm->get('Config');
            return new Options\ModuleOptions(isset($config['wdgimagegallery']) ? $config['wdgimagegallery'] : array());
        },
        'wdgimagegallery_repos_album' => function ($sm) {
            return $sm->get('wdgimagegallery_doctrine_em')->getRepository("WdgImageGallery\Entity\Album");
        }
    )
);