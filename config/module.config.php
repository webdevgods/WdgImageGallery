<?php
return array(
    'asset_manager' => array(
        'resolver_configs' => array(
            'paths' => array(
                __DIR__ . '/../public',
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'WdgImageGallery_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/WdgImageGallery/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'WdgImageGallery\Entity' => 'WdgImageGallery_driver'
                )
            )
        )
    ),
    'module_layouts' => array(
        'WdgImageGallery' => 'application/layout/layout',
    ),
    'navigation' => array(
        'admin' => array(
            'wdgimagegallery' => array(
                'label' => 'Gallery',
                'route' => 'zfcadmin/wdg-imagegallery-admin'
            ),
        ),
    ),
);
