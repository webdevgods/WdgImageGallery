<?php
namespace WdgImageGallery\Options;

interface ModuleOptionsInterface
{
    public function setImageListElements(array $listElements);

    public function getImageListElements();
    
    public function setAlbumListElements(array $listElements);

    public function getAlbumListElements();
    
    public function setImageTag($thumbnailImageTag);
    
    /**
     * Filebank tag for product specific images
     */
    public function getImageTag();
}
