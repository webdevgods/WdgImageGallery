<?php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
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
