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
       
        <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('content', 'page'); ?>
        <?php endwhile; ?>
    </div>

    <div class="col-md-3 col-sm-12 col-xs-12 right_sid_mtr">
        <?php get_sidebar(); ?>
    </div>


    <!--Audience Page Custom Design -- START-->

    <div class="col-md-12">
        <!--Families section START-->
        <div class="row custom-common-padding">
            <div class="col-md-8">
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
            <div class="col-md-4">
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
            <div class="col-md-4 custom-col-md-4-padding custom-col-md-4-margin">
                <div class="custom-image-main-section">
                    <div class="custom-image-media">
                        <a href="#">
                            <div class="custom-image-thumbnail">
                                <div>
                                    <img src="" alt="" class="img-responsive img-thumbnail-square">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="custom-image-heading text-center">
                        <p>READING FIRST</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 custom-col-md-4-padding custom-col-md-4-margin">
                <div class="custom-image-main-section">
                    <div class="custom-image-media">
                        <a href="#">
                            <div class="custom-image-thumbnail">
                                <div>
                                    <img src="" alt="" class="img-responsive img-thumbnail-square">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="custom-image-heading text-center">
                        <p>Smaller Learning Communities</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 custom-col-md-4-padding custom-col-md-4-margin">
                <div class="custom-image-main-section">
                    <div class="custom-image-media">
                        <a href="#">
                            <div class="custom-image-thumbnail">
                                <div>
                                    <img src="" alt="" class="img-responsive img-thumbnail-square">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="custom-image-heading text-center">
                        <p>Statewide Family Engagement Centers</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 custom-col-md-4-padding custom-col-md-4-margin">
                <div class="custom-image-main-section">
                    <div class="custom-image-media">
                        <a href="#">
                            <div class="custom-image-thumbnail">
                                <div>
                                    <img src="" alt="" class="img-responsive img-thumbnail-square">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="custom-image-heading text-center">
                        <p>Promise Neighborhoods</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 custom-col-md-4-padding custom-col-md-4-margin">
                <div class="custom-image-main-section">
                    <div class="custom-image-media">
                        <a href="#">
                            <div class="custom-image-thumbnail">
                                <div>
                                    <img src="" alt="" class="img-responsive img-thumbnail-square">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="custom-image-heading text-center">
                        <p>Safe & Healthy Students</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 custom-col-md-4-padding custom-col-md-4-margin">
                <div class="custom-image-main-section">
                    <div class="custom-image-media">
                        <a href="#">
                            <div class="custom-image-thumbnail">
                                <div>
                                    <img src="" alt="" class="img-responsive img-thumbnail-square">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="custom-image-heading text-center">
                        <p>School Support & Rural Programs</p>
                    </div>
                </div>
            </div>
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
                    <div class="input-group to-focus">
                        <input type="text" class="form-control full-search-input" id="inputSuccess2" placeholder="Search" name="s"/>
                        <div class="input-group-append">
                            <button class="btn btn-secondary full-search-btn" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Full width Search Section END-->

    </div>

    <!--Audience Page Custom Design -- END-->

</div>

<?php get_footer(); ?>
