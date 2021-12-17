<?php
/**
 * Plugin Name:       OESE Featured Item Block
 * Description:       Featured Item Block for oese
 * Requires at least: 5.7.2
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       oese-featured-item-block
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
 
 global $wp_version;
 function oese_block_oese_accordion_block_block_init() {
 	register_block_type( __DIR__ );
 }
 
 function oese_blocks_oese_featured_item_block_block_init_legacy(){
 	$__oese_relative_path = (strpos(__DIR__, 'shortcodesblockv2') !== false)? get_stylesheet_directory_uri().'/modules/shortcodesblockv2/featured_item/':plugin_dir_url( __FILE__ );
 	$oese_featured_item_block_json= file_get_contents($__oese_relative_path."/block.json");
 	wp_register_script('oese_featured_item_block_js', $__oese_relative_path.'/build/index.js', array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), null, true	);
 	wp_register_style('oese_featured_item_block_editor_css', $__oese_relative_path.'/build/index.css',array( 'wp-edit-blocks' ),null);
 	wp_register_style('oese_featured_item_block_front_css', $__oese_relative_path.'/build/style-index.css',array( 'wp-edit-blocks' ),null);
  //wp_register_script('oese_featured_item_block-backend-js', $__oese_relative_path.'/backend.js',array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'jquery' ), null, true );
  wp_localize_script('oese_featured_item_block_js', 'oese_featured_item_legacy_marker', $oese_featured_item_block_json);
   register_block_type(
 		'oese-block/oese-featured-item-block', array(
 			'editor_script' => 'oese_featured_item_block_js',
 			'editor_style'  => 'oese_featured_item_block_editor_css',
 			'style'         => 'oese_featured_item_block_front_css'
 		)
 	);
 }
add_action( 'init', 'oese_blocks_oese_featured_item_block_block_init' );

function oese_featured_item_block_backend_script(){
 $__oese_relative_path = (strpos(__DIR__, 'shortcodesblockv2') !== false)? get_stylesheet_directory_uri().'/modules/shortcodesblockv2/featured_item/':plugin_dir_url( __FILE__ );
 wp_enqueue_script('oese_featured_item_block-backend-js', $__oese_relative_path.'/backend.js',array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'jquery' ), '1.0' );
}
add_action( 'admin_enqueue_scripts', 'oese_featured_item_block_backend_script' );

if($wp_version < 5.8){
	add_action( 'init', 'oese_blocks_oese_featured_item_block_block_init_legacy' );
}else{
	add_action( 'init', 'oese_blocks_oese_featured_item_block_block_init' );
}

add_action( 'init', 'oese_featured_item_color_palette_func' );
function oese_featured_item_color_palette_func() {	
		$existing = get_theme_support( 'editor-color-palette' );
		$new = array_merge( $existing[0], array(
		    array(
		        'name' => __( 'Orange', 'wp_oese_theme' ),
		        'slug' => 'oese-color-pallete-maroon',
		        'color' => '#981F33',
		    ),
		    array(
		        'name' => __( 'Green', 'wp_oese_theme' ),
		        'slug' => 'oese-color-pallete-green',
		        'color' => '#549944',
		    ),
        array(
            'name' => __( 'Black', 'wp_oese_theme' ),
             'slug' => 'oese-color-pallete-black',
             'color' => '#000000',
         ),
		));
		add_theme_support( 'editor-color-palette',  $new);
}





