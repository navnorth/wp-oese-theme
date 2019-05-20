<?php
/**
 * Template Name: Audience Template
 */

get_header();
global $post;
$page_id = get_the_ID();
?>


        <!--Audience Page Custom Design -- START-->

        <!--Families section START-->
        <div id="content" class="row custom-common-padding">
            <div class="col-md-8">
                <?php
                    if ( has_post_thumbnail() ) {
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id($page_id), 'single-post-thumbnail' );

                        echo "<div class='left-section-featured-image'>
                                <img src=".$image[0]."></div>";
                    }

                ?>
                <div class="left-description-section">
                   <h1><?php echo get_the_title(); ?></h1>
                   <?php
                     while (have_posts()) : the_post(); get_template_part('content', 'page');
                     endwhile;
                   ?>
                </div>
            </div>
            <div class="col-md-4">
                <?php echo getSidebarLinks(); ?>
            </div>
        </div>
        <!--Families section END-->

        <!--Div seperator-->
        <div class="row">
            <div class="col-md-12">
                <div class="seperate-dark-blue-border"></div>
            </div>
        </div>
        <!--Div seperator END-->

        <!--Post in grids section START-->
        <div class="row custom-common-padding gray-background-color mr-0 ml-0">
                <?php
                if( have_rows('categories') ):
                    while ( have_rows('categories') ) : the_row();
                        $cImage =  get_sub_field('c_image');
                        $cTitle =  get_sub_field('c_title');
                        $cLink =  get_sub_field('link');
                        $externaLink =  get_sub_field('c_external_link');
                        $target = ($externaLink ? "_blank" : "");
                ?>
            <div class="col-xl-4 col-lg-4 col-md-6 custom-col-md-4-padding custom-col-md-4-margin custom-grid-mobile-margin-top">
                <div class="custom-image-main-section">
                    <div class="custom-image-media">
                       <a target="<?php echo $target; ?>" href="<?php echo $cLink; ?>">
                            <div class="custom-image-thumbnail">
                                <div>
                                    <img src="<?php echo $cImage; ?>" alt="" class="img-responsive img-thumbnail-square">
                                </div>
                            </div>
                            <div class="custom-image-heading text-center">
                                <p><?php echo $cTitle; ?></p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
           <?php
                endwhile;

                else :

                endif;

            ?>
        </div>
        <!--Post in grids section START-->

        <!--Div seperator START-->
        <div class="row">
            <div class="col-md-12">
                <div class="seperate-dark-blue-border"></div>
            </div>
        </div>
        <!--Div seperator END-->

        <!--Full width Search Section START-->
        <div class="row custom-common-padding">
            <div class="full-search-section m-auto text-center">
                <div class="full-search-heading">
                    <h1>What can we help you find?</h1>
                </div>

                <div class="full-search-field">
                     <?php get_search_form() ?>
                </div>
            </div>
        </div>
        <!--Full width Search Section END-->

        <!--Audience Page Custom Design -- END-->



<?php get_footer(); ?>
