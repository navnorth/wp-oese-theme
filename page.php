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
global $post;
$page_id = get_the_ID();
$img_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
$img_alt = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);
?>

<div id="content" class="row site-content">

    <div class="col-md-9 col-sm-12 col-xs-12 lft_sid_cntnr">
        <?php if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
        } ?>
        <?php
        if (isset($img_url) && !empty($img_url)) {
            echo '<div class="program_header_image"><img src="' . $img_url . '" alt="' . $img_alt . '" /></div>';
        }
        ?>
        <h1 class="page_header"><?php echo $post->post_title; ?></h1>
        <div class="share_links_header"><?php echo do_shortcode("[ssba]"); ?></div>

        <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('content', 'page'); ?>
        <?php endwhile; ?>

<!--        Code for audience page START -->

       <!-- <div class="row">
            <div class="col-md-6">
                <div class="left-section-featured-image">
                    <img src="">
                </div>
                <div class="left-description-section">
                    <h1>Families</h1>
                    <p>
                        Families serve as the cornerstone of every community across our nation. As such, the Office of Elementary and Secondary Education is dedicated to helping provide each family access to world-class schools, research-based programs, and effective practitioners.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="secondary-navigation-menu">
                    <div class="secondary-navigation-menu-header">
                        <p>Popular Resources</p>
                    </div>
                    <ul class="secondary-navigation-menu-list">
                        <li>
                            <a href="#">Early Learning</a>
                        </li>
                        <li>
                            <a href="#">Family & Community Engagement</a>
                        </li>
                        <li>
                            <a href="#">Every Student Succeeds Act</a>
                        </li>
                        <li>
                            <a href="#">FERPA</a>
                        </li>
                        <li>
                            <a href="#">Project Prevent Grant</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>-->
        <!--        Code for audience page END -->
    </div>

    <div class="col-md-3 col-sm-12 col-xs-12 right_sid_mtr">
        <?php get_sidebar(); ?>
    </div>

</div>

<?php get_footer(); ?>
