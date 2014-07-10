<?php
namespace WdgImageGallery\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use WdgDoctrine2\Entity\Entity;

/**
 * @ORM\Entity(repositoryClass="WdgImageGallery\Repository\Album")
 * @ORM\Table(name="wdgimagegallery_albums")
 */
class Album extends Entity
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
     * @var string
     * @ORM\Column(type="string", length=255, unique=true, nullable=true)
     */
    protected $slug;
    
    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="FileBank\Entity\File")
     * @ORM\JoinTable(name="wdgimagegallery_album_images")
     */
    protected $Files;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->Files = new ArrayCollection();
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
     * @param string $title
     * @return \WdgImageGallery\Entity\Album
     */
    public function setTitle($title)
    {
        $this->title = $title;
        
        return $this;
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
     * @param string $slug
     * @return \WdgImageGallery\Entity\Album
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
    
    /**
     * Get files.
     *
     * @return ArrayCollection
     */
    public function getImages()
    {
        return $this->Files;
    }

    /**
     * Add a image to album.
     *
     * @param \FileBank\Entity\File $Image
     *
     * @return void
     */
    public function addImage(\FileBank\Entity\File $Image)
    {
        $this->Files[] = $Image;
        
        return $this;
    }
    
    /**
     * @param \FileBank\Entity\File $Image
     * @return bool
     */
    public function removeImage(\FileBank\Entity\File $Image)
    {
        return $this->getImages()->removeElement($Image);
    }
}
