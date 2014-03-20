<?php
namespace WdgGallery\View\Helper;

use Zend\View\Helper\AbstractHelper;

class WdgGallery extends AbstractHelper
{

    /**
     * __invoke
     *
     * @access public
     * @param \ZfcUser\Entity\UserInterface $user
     * @throws \ZfcUser\Exception\DomainException
     * @return String
     */
    public function __invoke(\WdgGallery\Entity\Gallery $Gallery)
    {
        $images = new stdClass();

        $images->albums = array(
            (object) array(
                "title" => "Test Album",
                "images" => array(
                    (object) array(
                        "caption" => "test caption", 
                        "src" => "/img/gallery/ElSalvadorMission9-2010/Picture-374-2592x1735.jpg", 
                        "th" => "/img/gallery/ElSalvadorMission9-2010/Picture-374-2592x1735.jpg"
                    ),
                    (object) array(
                        "caption" => "test caption", 
                        "src" => "/img/gallery/ElSalvadorMission9-2010/Picture-389-2592x1735.jpg", 
                        "th" => "/img/gallery/ElSalvadorMission9-2010/Picture-389-2592x1735.jpg"
                    ),
                    (object) array(
                        "caption" => "test caption", 
                        "src" => "/img/gallery/ElSalvadorMission9-2010/Picture-390-2592x1735.jpg", 
                        "th" => "/img/gallery/ElSalvadorMission9-2010/Picture-390-2592x1735.jpg"
                    ),
                    (object) array(
                        "caption" => "test caption", 
                        "src" => "/img/gallery/ElSalvadorMission9-2010/Picture-420-2592x1735.jpg", 
                        "th" => "/img/gallery/ElSalvadorMission9-2010/Picture-420-2592x1735.jpg"
                    ),
                )
            )
        );
        ?>
        <div class="entry-content">
            <!-- The HTML -->
            <div id="plusgallery"
                 data-image-path="/plusgallery/images/plusgallery"
                 data-credit="false"
                 data-type="local"
                 data-image-data='<?php echo json_encode($images);?>'
                 data-object-path="test"
                 ><!-- +Gallery http://www.plusgallery.net/ -->
            </div>
        </div>

        <!-- Load jQuery ahead of this -->
        <script src="/plusgallery/js/plusgallery.js"></script>
        <script>
            $(function() {
                //DOM loaded
                $('#plusgallery').plusGallery();
            });
        </script>
        <?php
    }
}