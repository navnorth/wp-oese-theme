<?php
/**
 * Template Name: Office Template
 */
include_once( get_stylesheet_directory()."/classes/oese_mobile_detect.php" );

get_header();
global $post;
global $screen_width;
var_dump($screen_width);
$page_id = get_the_ID();
$head_class = "";
$is_archived = false;
$archived_date = null;
$leftCol = "col-md-12";
$rightCol = "col-md-right";
$contactAddress = get_field("ci_address");
$contactPhone = get_field("ci_phone");
$contactFax = get_field("ci_fax");

if (get_field('archive_date'))
    $archived_date = get_field('archive_date');
    
if ($archived_date){
    $is_archived = true;
    $head_class = " archived-header";
}

if(!empty($contactAddress) || (!empty($contactPhone)) || (!empty($contactFax))){
    $leftCol = "col-md-8 col-sm-12";
    $rightCol = "col-md-4";
}

if( have_rows('sidebar_links') ){
    $leftCol = "col-md-8 col-sm-12";
    $rightCol = "col-md-4";
}
?>

        <!--Office Template Top Section START-->
        <div id="content" class="row custom-common-padding office-template">
            <div class="<?php echo $leftCol; ?>">
                <div class="left-description-section">
                    <h1 class="h1-bottom-space<?php echo $head_class; ?>"><?php echo get_the_title(); ?></h1>
                    <?php if ($is_archived): ?>
                    <div class="oese-archived-disclaimer">
                            <?php _e('<span class="fa fa-archive"></span><strong>Archived Content:</strong> The following page was archived on '.$archived_date.' but still has content that may be valuable to some people.', WP_OESE_THEME_SLUG); ?>
                    </div>
                    <?php endif; ?>
                    <?php
                        if ( has_post_thumbnail() ) {
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id($page_id), 'single-post-thumbnail' );
                            $img_alt = get_post_meta(get_post_thumbnail_id($page_id), '_wp_attachment_image_alt', true);
                            
                            echo "<div class='left-section-featured-image'>
                                    <img src='".$image[0]."' alt='".$img_alt."'></div>";
                        }
                    ?>
                     <?php
                     while (have_posts()) : the_post(); get_template_part('content', 'page'); 
                     endwhile;
                   ?>
                </div>
            </div>
            <?php
            $detect = new oese_mobile_detect();
            if ($detect->isMobile() || $screen_width<=800){
                $li_class = "";
                $contact = get_field('ci_address');
                $sidebar_links = have_rows('sidebar_links');
                if ($contact && $sidebar_links)
                    $li_class = " half";
                elseif ($contact || $sidebar_links)
                    $li_class = " full";
                
                if ($contact || $sidebar_links){
                ?>
                <div class="col-sm-12 program-sidebar">
                    <ul class="nav nav-tabs" id="mobileSidebarTab" role="tablist">
                        <?php
                        $contactTitle = get_field("ci_title");
                        if ($contactTitle):
                        ?>
                        <li class="nav-item<?php echo $li_class; ?>">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="true"><?php echo $contactTitle; ?></a>
                        </li>
                        <?php
                        endif;
                        if( have_rows('sidebar_links') ):
                            $sidebar_title = get_field('sidebar_box_title');
                            if ($sidebar_title):
                            ?>
                            <li class="nav-item<?php echo $li_class; ?>">
                                <a class="nav-link" id="menu-tab" data-toggle="tab" href="#menu" role="tab" aria-controls="menu" aria-selected="false"><?php echo $sidebar_title; ?></a>
                            </li>
                            <?php endif;
                        endif;
                        ?>
                    </ul>
                    <div class="tab-content" id="mobileSidebarTabContent">
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <?php echo contactInformationBlock(false) ?>
                            <div class="tab-close-row"><a class="tab-close-button" href="javascript:void(0)" role="button"><i class="fas fa-times"></i> CLOSE</a></div>
                        </div>
                        <?php if( have_rows('sidebar_links') ): ?>
                        <div class="tab-pane fade" id="menu" role="tabpanel" aria-labelledby="menu-tab">
                            <div class="sidebar-menu">
                            <?php echo getSidebarLinks(false); ?>
                            </div>
                            <div class="col-sm-12 tab-close-row"><a class="tab-close-button"  href="javascript:void(0)" role="button"><i class="fas fa-times"></i> CLOSE</a></div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
                }
            } else {
            ?>
            <div class="<?php echo $rightCol; ?>">
                <?php echo contactInformationBlock() ?>
                <?php
                if (have_rows('sidebar_links'))
                    getSidebarLinks();
                ?>
            </div>
            <?php } ?>
        </div>
        <!--Office Template Top Section END-->
        
        <!--Div seperator-->
        <div class="row">
            <div class="col-md-12">
                <div class="seperate-dark-blue-border"></div>
            </div>
        </div>
        <!--Div seperator END-->
        
        <!--Office Template Grid Section START-->
        <?php getTileLinks(); ?>
        <!--Office Template Grid Section END-->

<?php get_footer(); ?>