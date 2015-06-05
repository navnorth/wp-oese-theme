<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header();
global $post;
?>

	<div id="content" class="row site-content">

	<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); }  ?>
	
        <div class="col-md-9 c ol-sm-12 col-xs-12 padding_left lft_sid_cntnr">
        	<h1 class="page_header"><?php echo $post->post_title;?></h1>
            <div class="share_links_header"><?php echo do_shortcode("[ssba]"); ?></div>

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php endwhile; ?>
         </div>

        <div class="col-md-3 col-sm-12 col-xs-12 right_sid_mtr">
            <?php get_sidebar(); ?>
        </div>

    </div>

<?php get_footer(); ?>
