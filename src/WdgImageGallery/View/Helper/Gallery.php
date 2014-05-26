<?php
namespace WdgImageGallery\View\Helper;

use Zend\View\Helper\AbstractHelper;

class Gallery extends AbstractHelper
{
    protected $albums;
    
    /**
     * @param array $albums
     */
    public function __construct(array $albums) 
    {
        $this->albums = $albums;
    }

    /**
     * __invoke
     *
     * @access public
     * @param \ZfcUser\Entity\UserInterface $user
     * @throws \ZfcUser\Exception\DomainException
     * @return String
     */
    public function __invoke()
    {
        $albums_array = array(
            "albums" => array()
        );
        
        foreach($this->albums as $album)
        {
            $album_object = (object) array(
                "title" => $album->getTitle(),
                "images" => array()
            );
            
            /* @var $Image \FileBank\File */
            foreach ($album->getImages() as $image)
            {
                $url = $this->getView()->getFileById($image->getId())->getUrl();

                $album_object->images[] = (object) array(
                    "caption" => $image->getName(), 
                    "src" => $url, 
                    "th" => $url
                );
            };
            
            $albums_array["albums"][] = $album_object;
        }

        ?>
        <div class="entry-content">
            <!-- The HTML -->
            <div id="plusgallery"
                 data-image-path="/plusgallery/images/plusgallery"
                 data-credit="false"
                 data-type="local"
                 data-image-data='<?php echo json_encode($albums_array);?>'
                 data-object-path="test"
                 ><!-- +Gallery http://www.plusgallery.net/ -->
            </div>
        </div>

        <!-- Load jQuery ahead of this -->
        <script src="/wdg-image-gallery/plusgallery/js/plusgallery.js"></script>
        <link rel="stylesheet" href="/wdg-image-gallery/plusgallery/css/plusgallery.css">
        <script>
            $(function() {
                //DOM loaded
                $('#plusgallery').plusGallery();
            });
        </script>
        <?php
    }
    
    private function _arrayToObject($d) 
    {
        if (is_array($d)) 
        {
            return (object) array_map( array( $this, __METHOD__ ), $d );
        }
        else 
        {
            return $d;
        }
    }
}