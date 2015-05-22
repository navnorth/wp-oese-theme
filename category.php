<?php
/**
 * The template for displaying Category pages
 *
 * Used to display archive-type pages for posts in a category.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="content" class="row site-content">
		<div class="col-md-9 c ol-sm-12 col-xs-12 padding_left pblctn_lft_sid_img_cntnr">

			<?php if ( have_posts() ) : ?>
				<header class="archive-header">
					<h1 class="archive-title"><?php printf( __( 'News Posts: %s', 'twentytwelve' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>

				<?php if ( category_description() ) : // Show an optional category description ?>
					<div class="archive-meta"><?php echo category_description(); ?></div>
				<?php endif; ?>
				</header><!-- .archive-header -->

				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
					get_template_part( 'content', get_post_format() );

				endwhile;

				twentytwelve_content_nav( 'nav-below' );
				?>

			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>

		</div>
        <div class="col-md-3 col-sm-12 col-xs-12 pblctn_right_sid_mtr">
            <?php get_sidebar(); ?>
        </div>
	</div><!-- #row -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
