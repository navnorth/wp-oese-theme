<?php
/**
 * Template Name: Awards template, full-width - no sidebar
 */


global $post;

$page_id = get_the_ID();
$img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$img_alt = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);

get_header();
?>

    <div id="content" class="row site-content" tabindex="-1">

        <div class="col-md-12 col-sm-12 col-xs-12 padding_left padding_right">

        <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); }  ?>

            <?php
                if(isset($img_url) && !empty($img_url))
                {
                    echo '<div class="program_header_image"><img src="'. $img_url .'" alt="'.$img_alt. '" /></div>';
                }
            ?>

            <h1 class="program_header"><?php echo $post->post_title;?></h1>
            <div class="share_links_header"><?php echo do_shortcode("[ssba]"); ?></div>

            <?php while ( have_posts() ) : the_post(); ?>
                <?php
                    get_template_part( 'content', 'resources' );
                    get_template_part( 'content', 'page' );
                ?>
            <?php endwhile; ?>
         </div>

    </div>

<?php get_footer(); ?>
