<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package wp_oese_theme
 * @since 1.5.0
 */
?>
<?php
$menuLocations = get_nav_menu_locations();
$menuID = $menuLocations['footer'];
$footerNav = wp_get_nav_menu_items($menuID);
$childMenuItems = array();
$parentMenuItems = array();
$items= array();

if($footerNav) {
    foreach ($footerNav as $key => $navItems) {
       // print_r($navItems);
        if($navItems->menu_item_parent == 0){
            $parentMenuItems[$navItems->ID]=array('title'=>$navItems->title,'url'=>$navItems->url);
        }
        else{
            $childMenuItems[$navItems->menu_item_parent][]=array('title'=>$navItems->title,'url'=>$navItems->url);
        }
    }
}
    ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="row custom-common-padding footer-main-section mr-0 ml-0">
                    <?php foreach ($parentMenuItems as $key => $menuItems) { ?>
                        <div class="col-md-3">
                            <div class="footer-title">
                                <p><a href="<?php echo $menuItems['url']; ?>"><?php echo $menuItems['title']; ?></a></p>
                            </div>
                            <div class="footer-sub-menu">
                            <?php
                                $childMenu = $childMenuItems[$key];
                                if($childMenu){ ?>
                                    <ul class='sub-menu-links'>
                                    <?php  foreach ($childMenu as $key => $value) { ?>
                                        <li>
                                            <a href="<?php echo $value['url']; ?>">
                                                <?php echo $value['title']; ?>
                                            </a>
                                        </li>
                                   <?php  }
                                }
                            ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row bottom-footer-section mr-0 ml-0">
                        <div class="col-md-2">
                            <div class="footer-bottom-left-logo">
                                <a href="https://www.ed.gov/">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/footer_logo.png">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="footer-bottom-right-links text-right">
                                <a href="<?php echo site_url(); ?>/privacy-policy">
                                    Privacy Policy
                                </a>

                                <a href="<?php echo site_url(); ?>/topics-a-z">
                                    Topics A-Z
                                </a>

                                <a href="https://www.ed.gov">
                                    ED.gov
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
<?php wp_footer(); ?>
</body>
</html>
