<?php
namespace WdgImageGallery\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions implements ModuleOptionsInterface
{
    /**
     * Turn off strict options mode
     */
    protected $__strictMode__ = false;

    /**
     * Array of data to show in the product list
     * Key = Label in the list
     * Value = entity property(expecting a 'getProperty())
     */
    protected $imageListElements = array('Name' => 'name', 'Slug' => 'slug');
    
    /**
     * Array of data to show in the category list
     * Key = Label in the list
     * Value = entity property(expecting a 'getProperty())
     */
    protected $albumListElements = array('Title' => 'title', 'Slug' => 'slug');
    
    /**
     * @var Filebank tag for product thumbnail specific images
     */
    protected $imageTag = "";

    public function setImageListElements(array $listElements)
    {
        $this->imageListElements = $listElements;
    }

    public function getImageListElements()
    {
        return $this->imageListElements;
    }
    
    public function setAlbumListElements(array $listElements)
    {
        $this->albumListElements = $listElements;
    }

    public function getAlbumListElements()
    {
        return $this->albumListElements;
    }
    
    /**
     * This is the name of the tag to put in the filebank for all of the
     * images so they can be filtered later
     * 
     * @param string $imageTag
     */
    public function setImageTag($imageTag)
    {
        $this->imageTag = $imageTag;
    }
    
    /**
     * Filebank tag for product specific images
     * 
     * @return type
     */
    public function getImageTag()
    {
        return $this->imageTag;
    }
}
