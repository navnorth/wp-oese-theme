<?php
/**
 * Block Name: Tile Links
 *
 * This is the template that displays the Tlie link block.
 */

// get image field (array)
$title = get_field('tile_link_title');
$link = get_field('tile_link_url');
$external = get_field('external_link');
$width = get_field('width');

// create id attribute for specific styling
$id = 'oese-tile-link-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';

?>
<blockquote id="<?php echo $id; ?>" class="tile-link <?php echo $align_class; ?>">
    <p><?php the_field('testimonial'); ?></p>
    <cite>
    	<img src="<?php echo $avatar['url']; ?>" alt="<?php echo $avatar['alt']; ?>" />
    	<span><?php the_field('author'); ?></span>
    </cite>
</blockquote>
<style type="text/css">
	#<?php echo $id; ?> {
		background: <?php the_field('background_color'); ?>;
		color: <?php the_field('text_color'); ?>;
	}
</style>
?>