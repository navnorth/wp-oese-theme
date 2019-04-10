<?php
/**
 * The Template for displaying all single posts
 *
 * @package wp_oese_theme
 * @since 1.5.0
 */

get_header(); ?>

	<div id="content" class="row site-content">
		<div class="col-md-9 col-sm-12 col-xs-12 padding_left lft_sid_cntnr">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<hr class="post_bottom_hr" />

				<nav class="nav-single">
					<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
					<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentytwelve' ) . '</span> %title' ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentytwelve' ) . '</span>' ); ?></span>
				</nav><!-- .nav-single -->

				<?php #comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>
		</div>
        <div class="col-md-3 col-sm-12 col-xs-12 right_sid_mtr">
            <?php get_sidebar(); ?>
        </div>
	</div><!-- #row -->

<?php get_footer(); ?>
