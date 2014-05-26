<?php
namespace WdgImageGallery\Form\Album;

use WdgZf2\Form\PostFormAbstract;

class AddImage extends PostFormAbstract
{
    public function __construct()
    {
        parent::__construct();
        
        $this->setAttribute('enctype','multipart/form-data');
        
        $this->add(array(
            'name' => 'image_name',
            'options' => array(
                'label' => 'Name',
            ),
        ));
        
        $this->add(array(
            'type' => 'file',
            'name' => 'image',
            'options' => array(
                'label' => 'Image',
            ),
        ));
        
        $this->add(array(
            'type' => 'hidden',
            'name' => 'album_id'
        ));
    }
}