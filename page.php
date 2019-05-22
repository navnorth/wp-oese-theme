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
$col_class = "col-md-12";
if (is_active_sidebar('sidebar-1'))
    $col_class = "col-md-8";
?>

        <div id="content" class="row custom-common-padding mr-0 ml-0">

            <div class="<?php echo $col_class; ?>">
    
                <h1 class="h1-bottom-space"><?php echo $post->post_title; ?></h1>
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('content', 'page'); ?>
                <?php endwhile; ?>
                
            </div>
           
            <?php get_sidebar(); ?>

        </div>
    

<?php get_footer(); ?>
