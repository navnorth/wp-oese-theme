<?php
/**
 * Template Name: Audience Template
 */

get_header();
global $post;
$page_id = get_the_ID();
$img_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
$img_alt = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);
?>

        <div class="col-md-12">
            <!--Families section START-->
            <div class="row custom-common-padding">
                <div class="col-md-8">
                    <div class="left-section-featured-image">
                        <img src="">
                    </div>
                    <div class="left-description-section">
                        <h1><?php echo get_the_title(); ?></h1>
                       <?php 
                           if ( has_post_thumbnail() ) {
                                $image = wp_get_attachment_image_src( get_post_thumbnail_id($page_id), 'single-post-thumbnail' );

                                echo "<img src=".$image[0]." alt='' class='img-responsive' >";
                            } 
                            while (have_posts()) : the_post(); get_template_part('content', 'page'); 
                            endwhile;
                        ?>  
                    </div>
                </div>
                <div class="col-md-4">
                    <?php get_sidebar(); ?>
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
            <div class="row custom-common-padding">
               <?php  
                    if( have_rows('categories') ): 
                        while ( have_rows('categories') ) : the_row();  
                            $cImage =  get_sub_field('c_image');
                            $cTitle =  get_sub_field('c_title');
                            $cLink =  get_sub_field('link');
                            $externaLink =  get_sub_field('c_external_link');
                            $target = ($externaLink ? "_blank" : "");
                ?>

                    <div class="col-md-4 custom-col-md-4-padding custom-col-md-4-margin">
                        <div class="custom-image-main-section">
                            <div class="custom-image-media">
                                <a target="<?php echo $target; ?>" href="<?php echo $cLink; ?>">
                                    <div class="custom-image-thumbnail">
                                        <div>
                                            <img src="<?php echo $cImage; ?>" alt="" class="img-responsive img-thumbnail-square">
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="custom-image-heading text-center">
                                <p><?php echo $cTitle; ?></p>
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

        </div>


<?php get_footer(); ?>
()