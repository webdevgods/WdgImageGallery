<?php
namespace WdgImageGallery\View\Helper;

use Zend\View\Helper\AbstractHelper;

class WdgImageGallery extends AbstractHelper
{

    /**
     * __invoke
     *
     * @access public
     * @param \ZfcUser\Entity\UserInterface $user
     * @throws \ZfcUser\Exception\DomainException
     * @return String
     */
    public function __invoke(array $albums)
    {
        $albums_array = array(
            "albums" => array()
        );
        
        foreach($albums as $album)
        {
            $album_array = array(
                "title" => $album->getTitle(),
                "images" => array()
            );
            
            /* @var $Image \FileBank\File */
            foreach ($album->getImages() as $image)
            {
                $url = $this->getView()->getFileById($image->getId())->getUrl();

                $album_array["images"][] = array(
                    "caption" => $image->getName(), 
                    "src" => $url, 
                    "th" => $url
                );
            };
            
            $albums_array["albums"][] = $album_array;
        }

        $albums_object = $this->_arrayToObject($albums_array);
        ?>
        <div class="entry-content">
            <!-- The HTML -->
            <div id="plusgallery"
                 data-image-path="/plusgallery/images/plusgallery"
                 data-credit="false"
                 data-type="local"
                 data-image-data='<?php echo json_encode($albums_object);?>'
                 data-object-path="test"
                 ><!-- +Gallery http://www.plusgallery.net/ -->
            </div>
        </div>

        <!-- Load jQuery ahead of this -->
        <script src="/wdg-image-gallery/plusgallery/js/plusgallery.js"></script>
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
            return (object) array_map( array( $this, __METHOD___ ), $d );
        }
        else 
        {
            return $d;
        }
    }
}