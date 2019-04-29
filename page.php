<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package wp_oese_theme
 * @since 1.5.0
 */

get_header();
?>

        <div class="row custom-common-padding mr-0 ml-0">

            <div class="col-md-8">
    
                <h1 class="h1-bottom-space"><?php echo $post->post_title; ?></h1>
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('content', 'page'); ?>
                <?php endwhile; ?>
                
            </div>
            <div class="col-md-4">
               <?php get_sidebar(); ?>
            </div>

        </div>
    

<?php get_footer(); ?>
