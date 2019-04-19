<?php
/**
 * Template Name: Full-width Page Template, No Sidebar
 *
 * Description: Twenty Twelve loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package wp_oese_theme
 * @since 1.5.0
 */

get_header();
global $post;
?>

<div id="content" class="row site-content" tabindex="-1">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <?php if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
        } ?>

        <h1 class="page_header"><?php echo $post->post_title; ?></h1>
       
        <?php while (have_posts()) : the_post(); ?>

            <?php get_template_part('content', 'page'); ?>

        <?php endwhile; ?>

    </div>
</div>

<?php get_footer(); ?>
