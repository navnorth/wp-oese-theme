<?php
/**
 * The sidebar containing the main widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
global $post;
var_dump(is_search());
?>

	<?php if( have_rows('sidebar_links', $post->ID) ) : ?>
		<div class="col-md-4">
			<div id="secondary" class="widget-area" role="complementary">
				<?php getSidebarLinks(); ?>
			</div><!-- #secondary -->
		</div>
	<?php endif; ?>
