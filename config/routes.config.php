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
                    'video' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/video[/:slug][/:page]',
                            'constraints' => array(
                                'slug' => '[a-zA-Z0-9_-]+'
                            ),
                            'defaults' => array(
                                'page' => 1,
                                'controller' => 'WdgImageGallery\Controller\Gallery',
                                'action' => 'video'
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
                            'image' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/image'
                                ),
                                'child_routes' => array(
                                    'show' => array(
                                        'type' => 'Segment',
                                        'options' => array(
                                            'route' => '/[:id]',
                                            'defaults' => array(
                                                'controller' => 'WdgImageGallery\Controller\GalleryAdminImage',
                                                'action' => 'show'
                                            )
                                        ),
                                        'may_terminate' => true,                                        
                                        'priority' => 100,
                                    ),
                                    'list' => array(
                                        'type' => 'Segment',
                                        'options' => array(
                                            'route' => '/list[/:page]',
                                            'defaults' => array(
                                                'controller' => 'WdgImageGallery\Controller\GalleryAdminImage',
                                                'action' => 'list',
                                                'page' => '1'
                                            )
                                        ),
                                        'may_terminate' => true,                                        
                                        'priority' => 1000,
                                    ),
                                    'add' => array(
                                        'type' => 'Literal',
                                        'options' => array(
                                            'route' => '/add',
                                            'defaults' => array(
                                                'controller' => 'WdgImageGallery\Controller\GalleryAdminImage',
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
                                                'controller' => 'WdgImageGallery\Controller\GalleryAdminImage',
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
                                                'controller' => 'WdgImageGallery\Controller\GalleryAdminImage',
                                                'action' => 'edit'
                                            )
                                        ),
                                        'priority' => 1000,
                                        'may_terminate' => true,
                                    ),
                                    'images' => array(
                                        'type' => 'Segment',
                                        'options' => array(
                                            'route' => '/images[/:id]',
                                            'defaults' => array(
                                                'controller' => 'WdgImageGallery\Controller\GalleryAdminImage',
                                                'action' => 'images'
                                            )
                                        ),
                                        'priority' => 1000,
                                        'may_terminate' => true,
                                    ),
                                ),
                            ),
                            'video' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/video',
                                ),
                                'child_routes' => array(
                                    'show' => array(
                                        'type' => 'Segment',
                                        'options' => array(
                                            'route' => '[/:id]',
                                            'defaults' => array(
                                                'controller' => 'WdgImageGallery\Controller\GalleryAdminVideo',
                                                'action' => 'show'
                                            )
                                        ),
                                        'may_terminate' => true,
                                        'priority' => 10,
                                    ),
                                    'list' => array(
                                        'type' => 'Literal',
                                        'options' => array(
                                            'route' => '/list',
                                            'defaults' => array(
                                                'controller' => 'WdgImageGallery\Controller\GalleryAdminVideo',
                                                'action' => 'list'
                                            )
                                        ),
                                        'may_terminate' => true,
                                        'priority' => 1000,
                                    ),
                                    'add' => array(
                                        'type' => 'Literal',
                                        'options' => array(
                                            'route' => '/add',
                                            'defaults' => array(
                                                'controller' => 'WdgImageGallery\Controller\GalleryAdminVideo',
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
                                                'controller' => 'WdgImageGallery\Controller\GalleryAdminVideo',
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
                                                'controller' => 'WdgImageGallery\Controller\GalleryAdminVideo',
                                                'action' => 'edit'
                                            )
                                        ),
                                        'may_terminate' => true,
                                        'priority' => 1000,
                                    ),
                                )
                            )
                        )
                    )
                )
            )
        )
    )
);