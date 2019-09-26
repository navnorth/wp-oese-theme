<?php
/**
 * Template Name: Program Template
 */
include_once( get_stylesheet_directory()."/classes/oese_mobile_detect.php" );

global $post;

$page_id = get_the_ID();
get_header();
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

$spages = get_pages( array( 'parent' => get_queried_object_id(), 'sort_column' => 'menu_order', 'sort_order' => 'asc' ) );
var_dump($spages);
if ($spages || (!empty($contactAddress)) || (!empty($contactPhone)) || (!empty($contactFax)) || (have_rows('sidebar_links'))){
    $leftCol = "col-md-8";
    $rightCol = "col-md-4";
}
?>

           <!--Program Landing Template Top Section START-->
        <div id="content" class="row custom-common-padding">
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
                    <!--Program Blocks START-->
                    <?php  if( have_rows('program_info') ): ?>
                        <div class="program-block-section table-responsive">
                            <table class="gray-background-color program-block-inner-section table">
                                <caption class="hidden">Program Information</caption>
                                <tr class="hidden">
                                    <td scope="col"><?php _e("Program Title", WP_OESE_THEME_SLUG); ?></td>
                                    <td scope="col"><?php _e("Program Description", WP_OESE_THEME_SLUG); ?></td>
                                </tr>
                                <?php
                                    while ( have_rows('program_info') ) : the_row();
                                      $programLabel =  get_sub_field('program_title');
                                      $programDescription =  get_sub_field('program_description');
                                ?>
                                <tr class="row program-list-detail">
                                    <td class="col-md-5">
                                        <label class="program-block-title"><?php echo $programLabel;?></label>
                                    </td>
                                    <td class="col-md-7">
                                        <p class="program-block-description"><?php echo $programDescription;?></p>
                                    </td>
                                </tr>
                             <?php endwhile; ?>
                            </table>
                        </div>
                    <?php endif; ?>
                    <!--Program Blocks END-->
                    <?php if( get_field('program_short_description') ): ?>
                        <p class="">
                            <?php echo  the_field("program_short_description") ?>
                        </p>
                    <?php endif; ?>
                    <?php
                         while (have_posts()) : the_post(); get_template_part('content', 'page');
                        endwhile;
                    ?>
                </div>
            </div>
            <?php
            $detect = new oese_mobile_detect();
            if ($detect->isMobile()){
            ?>
            <div class="col-sm-12 program-sidebar">
                <ul class="nav nav-tabs" id="mobileSidebarTab" role="tablist">
                    <?php
                    $contactTitle = get_field("ci_title");
                    if ($contactTitle):
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="true"><?php echo $contactTitle; ?></a>
                    </li>
                    <?php
                    endif;
                    $sidebar_title = get_field('sidebar_box_title');
                    if ($sidebar_title):
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" id="menu-tab" data-toggle="tab" href="#menu" role="tab" aria-controls="menu" aria-selected="false"><?php echo $sidebar_title; ?></a>
                    </li>
                    <?php endif; ?>
                </ul>
                <div class="tab-content" id="mobileSidebarTabContent">
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <?php echo contactInformationBlock(false) ?>
                        <div class="tab-close-row"><a class="tab-close-button" href="javascript:void(0)" role="button"><i class="fas fa-times"></i> CLOSE</a></div>
                    </div>
                    <div class="tab-pane fade" id="menu" role="tabpanel" aria-labelledby="menu-tab">
                        <div class="sidebar-menu">
                        <?php echo getSidebarLinks(false); ?>
                        </div>
                        <div class="col-sm-12 tab-close-row"><a class="tab-close-button"  href="javascript:void(0)" role="button"><i class="fas fa-times"></i> CLOSE</a></div>
                    </div>
                </div>
            </div>
            <?php
            } else {
            ?>
            <div class="<?php echo $rightCol; ?> program-sidebar">
                <?php echo contactInformationBlock() ?>

                <div class="spacer" style="height:20px;"></div>

                <?php get_template_part( 'content', 'resources' ); ?>

                <?php echo getSidebarLinks(); ?>
                
            </div>
            <?php } ?>
        </div>
        <!--Program Landing Template Top Section END-->

        <!--Div seperator-->
        <div class="row mr-0 ml-0">
            <div class="col-md-12 pr-0 pl-0">
                <div class="seperate-dark-blue-border"></div>
            </div>
        </div>
        <!--Div seperator END-->


        <!--Payments Section START-->

        <?php getTileLinks(); ?>

        <!--Payments Section END-->

<?php get_footer(); ?>
