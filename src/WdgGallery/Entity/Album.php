<?php
namespace WdgGallery\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="WdgGallery\Repository\Album")
 * @ORM\Table(name="wdggallery_albums")
 */
class Album extends \WdgBase\Doctrine\Entity
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, unique=true, nullable=true)
     */
    protected $title;
    
    /**
     * @var ArrayCollection
     * @Orm\OneToMany(targetEntity="WdgGallery\Entity\Album\Image", mappedBy="Album")
     */
    protected $Images;

    /**
     * Initializes the Images variable.
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->Images = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Get images.
     *
     * @return ArrayCollection
     */
    public function getImages()
    {
        return $this->Images;
    }

    /**
     * Add a image to album.
     *
     * @param Album\Image $Image
     *
     * @return void
     */
    public function addRole(Album\Image $Image)
    {
        $Image->setAlbum($this);
        
        $this->Images[] = $Image;
        
        return $this;
    }
}
