<?php
/**
 * Template Name: Office Template
 */

get_header();
global $post;
$page_id = get_the_ID();
$head_class = "";
$is_archived = false;
$archived_date = null;
$leftCol = "col-md-12";
$rightCol = "col-md-right";
$contactTitle = get_field("ci_title");
$contactAddress = get_field("ci_address");
$contactPhone = get_field("ci_phone");
$contactFax = get_field("ci_fax");
$contactEmailOption = get_field("ci_email");

if (get_field('archive_date'))
    $archived_date = get_field('archive_date');
    
if ($archived_date){
    $is_archived = true;
    $head_class = " archived-header";
}

if(!empty($contactAddress) || (!empty($contactPhone)) || (!empty($contactFax)) || (!empty($contactEmailOption))){
    $leftCol = "col-md-8";
    $rightCol = "col-md-4";
}

if( have_rows('sidebar_links') ){
    $leftCol = "col-md-8";
    $rightCol = "col-md-4";
}
?>

        <!--Office Template Top Section START-->
        <div id="content" class="row custom-common-padding office-template">
            <div class="col-md-8">
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
            <div class="col-md-4">
                <?php echo contactInformationBlock() ?>
                <?php echo getSidebarLinks(); ?>
            </div>
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