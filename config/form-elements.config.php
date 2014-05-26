<?php
use WdgImageGallery\Form;

return array(
    'factories' => array(
        'wdgimagegallery_album_add_form' => function(\Zend\Form\FormElementManager $sm){
            $form = new Form\Album\Add();
            
            $form->setInputFilter(new \WdgImageGallery\Filter\Album\Add());

            return $form;
        },
        'wdgimagegallery_album_edit_form' => function(\Zend\Form\FormElementManager $sm){
            $form = new Form\Album\Edit();
            
            $form->setInputFilter(new \WdgImageGallery\Filter\Album\Edit());

            return $form;
        },
        'wdgimagegallery_album_add_image_form' => function(\Zend\Form\FormElementManager $sm){
            $form = new Form\Album\AddImage();
            
            $form->setInputFilter(new \WdgImageGallery\Filter\Album\AddImage());

            return $form;
        },
    )
);