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
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header();
global $post;
?>

	<div id="content" class="row site-content">

        	<div class="col-md-12 c ol-sm-12 col-xs-12 padding_left padding_right">

                <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); }  ?>

            	<h1 class="page_header"><?php echo $post->post_title;?></h1>
                <div class="share_links_header"><?php echo do_shortcode("[ssba]"); ?></div>

				<?php while ( have_posts() ) : the_post(); ?>

                	<?php get_template_part( 'content', 'page' ); ?>

				<?php endwhile;?>

            </div>
	</div>

<?php get_footer(); ?>
