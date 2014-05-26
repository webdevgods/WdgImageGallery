<?php
namespace WdgImageGallery\Form\Album;

use WdgZf2\Form\PostFormAbstract;

class Base extends PostFormAbstract
{
    public function __construct()
    {
        parent::__construct();

        $this->add(array(
            'name' => 'title',
            'options' => array(
                'label' => 'Title',
            ),
        ));

        $this->add(array(
            'name' => 'slug',
            'options' => array(
                'label' => 'Slug',
            ),
        ));
    }
}