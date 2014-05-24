<?php
return array(
    'router' => array(
        'routes' => array(
            'wdg-imagegallery' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/gallery',
                    'defaults' => array(
                        'controller' => 'WdgImageGallery\Controller\Gallery',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'image' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/image[/:slug]',
                            'constraints' => array(
                                'slug' => '[a-zA-Z0-9_-]+'
                            ),
                            'defaults' => array(
                                'controller' => 'WdgImageGallery\Controller\Gallery',
                                'action' => 'image'
                            )
                        ),
                    ),
                )
            ),
            'zfcadmin' => array(
                'child_routes' => array(
                    'wdg-imagegallery-admin' => array(
                        'type' => 'Literal',
                        'priority' => 1000,
                        'options' => array(
                            'route' => '/gallery',
                            'defaults' => array(
                                'controller' => 'WdgImageGallery\Controller\GalleryAdmin',
                                'action'     => 'index'
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'album' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/album'
                                ),
                                'child_routes' => array(
                                    'show' => array(
                                        'type' => 'Segment',
                                        'options' => array(
                                            'route' => '/[:id]',
                                            'defaults' => array(
                                                'controller' => 'WdgImageGallery\Controller\GalleryAdmin',
                                                'action' => 'show'
                                            )
                                        ),
                                        'may_terminate' => true,                                        
                                        'priority' => 100,
                                    ),
                                    'add' => array(
                                        'type' => 'Literal',
                                        'options' => array(
                                            'route' => '/add',
                                            'defaults' => array(
                                                'controller' => 'WdgImageGallery\Controller\GalleryAdmin',
                                                'action' => 'add'
                                            )
                                        ),
                                        'may_terminate' => true,
                                        'priority' => 1000,
                                    ),
                                    'delete' => array(
                                        'type' => 'Segment',
                                        'options' => array(
                                            'route' => '/delete[/:id]',
                                            'defaults' => array(
                                                'controller' => 'WdgImageGallery\Controller\GalleryAdmin',
                                                'action' => 'delete'
                                            )
                                        ),
                                        'may_terminate' => true,
                                        'priority' => 1000,
                                    ),
                                    'edit' => array(
                                        'type' => 'Segment',
                                        'options' => array(
                                            'route' => '/edit[/:id]',
                                            'defaults' => array(
                                                'controller' => 'WdgImageGallery\Controller\GalleryAdmin',
                                                'action' => 'edit'
                                            )
                                        ),
                                        'priority' => 1000,
                                        'may_terminate' => true,
                                    ),
                                    'add-image' => array(
                                        'type' => 'Segment',
                                        'options' => array(
                                            'route' => '/add-image[/:id]',
                                            'defaults' => array(
                                                'controller' => 'WdgImageGallery\Controller\GalleryAdmin',
                                                'action' => 'add-image'
                                            )
                                        ),
                                        'priority' => 1000,
                                        'may_terminate' => true,
                                    ),
                                ),
                            ),
                        )
                    )
                )
            )
        )
    )
);