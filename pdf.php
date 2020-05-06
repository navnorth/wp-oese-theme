<?php
/**
 * The Template for displaying PDF Media Files
 *
 * @package wp_oese_theme
 * @since 1.5.0
 */

get_header(); ?>
  <style>
    /* CSS for responsive iframe */
  /* ========================= */

  /* outer wrapper: set max-width & max-height; max-height greater than padding-bottom % will be ineffective and height will = padding-bottom % of max-width */
  #Iframe-Master-CC-and-Rs {
  max-width: 2000px;
  max-height: 100%; 
  overflow: hidden;
  }

  /* inner wrapper: make responsive */
  .responsive-wrapper {
  position: relative;
  height: 0;    /* gets height from padding-bottom */
  padding-bottom: 107%;

  /* put following styles (necessary for overflow and scrolling handling on mobile devices) inline in .responsive-wrapper around iframe because not stable in CSS:
    -webkit-overflow-scrolling: touch; overflow: auto; */

  }

  .responsive-wrapper iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;

  margin: 0;
  padding: 0;
  border: none;
  }

  /* padding-bottom = h/w as % -- sets aspect ratio */
  /* YouTube video aspect ratio */
  .responsive-wrapper-wxh-572x612 {
  padding-bottom: 107%;
  }

  /* general styles */
  /* ============== */
  .set-border {
  border: 5px inset #4f4f4f;
  }
  .set-box-shadow { 
  -webkit-box-shadow: 4px 4px 14px #4f4f4f;
  -moz-box-shadow: 4px 4px 14px #4f4f4f;
  box-shadow: 4px 4px 14px #4f4f4f;
  }
  .set-padding {
  padding: 40px;
  }
  .set-margin {
  margin: 30px;
  }
  .center-block-horiz {
  margin-left: auto !important;
  margin-right: auto !important;
  }
  </style>
  
	<div id="content" class="site-content">
		<div class="col-md-12 col-sm-12 col-xs-12 padding_left padding_right lft_sid_cntnr">
			<?php while ( have_posts() ) : the_post(); ?>  
        
        
        
        <?php
        //$attachment = get_post( $attachment_id );
        //get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
        //$caption = $attachment->post_excerpt,
        //'description' => $attachment->post_content,
        //'href' => get_permalink( $attachment->ID ),
        //'src' => $attachment->guid,
        ?>
        <header class="entry-header">
          <h1 class="entry-title"><?php the_title(); ?></h1>
        </header>
            
        <div class="responsive-wrapper" style="-webkit-overflow-scrolling: touch; overflow: auto;">
          <iframe src="<?php echo wp_get_attachment_url($post->id); ?>"> 
            <p style="font-size: 110%;"><em><strong>ERROR: </strong>  
      An &#105;frame should be displayed here but your browser version does not support &#105;frames. </em>Please update your browser to its most recent version and try again.</p>
          </iframe> 
        </div>   

        <script>
        var tout;
        jQuery(document).ready(function(){
          jQuery(window).resize(function(){
            clearTimeout(tout);
            tout = setTimeout(function(){
              jQuery('.responsive-wrapper iframe').attr('src', "<?php echo wp_get_attachment_url($post->ID) ?>");
            }, 500);  
          });
        });
        </script>
        


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
