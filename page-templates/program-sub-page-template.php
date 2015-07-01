<?php
/**
 * Template Name: Program Sub-page Template
 */

get_header();
global $post;
?>

	<div id="content" class="row site-content">
	
        <div class="col-md-9 c ol-sm-12 col-xs-12 padding_left lft_sid_cntnr">
		<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); }  ?>
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
