<?php
namespace WdgGallery\Entity\Album;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="WdgGallery\Repository\Album")
 * @ORM\Table(name="wdggallery_album_images")
 */
class Image extends \WdgImageFile\Entity\ImageFile
{    
    
}
