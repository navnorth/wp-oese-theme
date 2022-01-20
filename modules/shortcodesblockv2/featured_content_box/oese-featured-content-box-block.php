<?php
/**
 * Plugin Name:       Featured Content Box
 * Description:       Add OESE Featured Content Box
 * Requires at least: 5.7.2
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       oese-featured-content-box-block
 *
 * @package           oese-block
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/how-to-guides/block-tutorial/writing-your-first-block-type/
 */
function oese_block_oese_featured_content_box_block_block_init(){
 $__oese_relative_path = (strpos(__DIR__, 'shortcodesblockv2') !== false)? get_stylesheet_directory_uri().'/modules/shortcodesblockv2/featured_content_box/':plugin_dir_url( __FILE__ );
 $oese_featured_content_box_block_json= file_get_contents($__oese_relative_path."/block.json");
 wp_register_script('oese_featured_content_box_block_js', $__oese_relative_path.'/build/index.js', array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), null, true	);
 wp_register_style('oese_featured_content_box_block_editor_css', $__oese_relative_path.'/build/index.css',array( 'wp-edit-blocks' ),null);
 wp_register_style('oese_featured_content_box_block_front_css', $__oese_relative_path.'/build/style-index.css',array( 'wp-edit-blocks' ),null);
 wp_localize_script('oese_featured_content_box_block_js', 'oese_featured_content_box_legacy_marker', $oese_featured_content_box_block_json);
	register_block_type(
	 'oese-block/oese-featured-content-box-block', array(
		 'editor_script' => 'oese_featured_content_box_block_js',
		 'editor_style'  => 'oese_featured_content_box_block_editor_css',
		 'style'         => 'oese_featured_content_box_block_front_css'
	 )
 );
}
add_action( 'init', 'oese_block_oese_featured_content_box_block_block_init' );

