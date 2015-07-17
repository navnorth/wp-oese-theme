<?php
/**
 * Twenty Twelve Child functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 */

/**
 * Register sidebars.
 */
require_once( get_stylesheet_directory() . '/theme-functions/widget-areas.php' );

/**
 * Theme Social Media Settings.
 */
require_once( get_stylesheet_directory() . '/theme-functions/theme-social.php' );

/**
 * Theme Shortcode.
 */
require_once( get_stylesheet_directory() . '/theme-functions/theme-shortcode.php' );

/**
 *
 * Theme Widget
 */
 require_once(get_stylesheet_directory() . '/theme-functions/custom_widget.php');

/**
 * Shortcode Button.
 */
 require_once( get_stylesheet_directory() . '/tinymce_button/shortcode_button.php' );
 
 /**
  * Contact Metabox
  **/
 require_once( get_stylesheet_directory() . '/metaboxes/contact-metabox.php' );

function theme_back_enqueue_script()
{
    wp_enqueue_script( 'theme-back-script', get_stylesheet_directory_uri() . '/js/back-script.js' );
	wp_enqueue_style( 'theme-back-style',get_stylesheet_directory_uri() . '/css/back-style.css' );
	wp_enqueue_style( 'tinymce_button_backend',get_stylesheet_directory_uri() . '/tinymce_button/shortcode_button.css' );
}
add_action( 'admin_enqueue_scripts', 'theme_back_enqueue_script' );

function theme_front_enqueue_script()
{
	wp_enqueue_style( 'theme-front-style',get_stylesheet_directory_uri() . '/css/front-style.css' );

	wp_enqueue_style( 'theme-main-style',get_stylesheet_directory_uri() . '/css/mainstyle.css' );
	wp_enqueue_style( 'theme-bootstrap-style',get_stylesheet_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'theme-font-style',get_stylesheet_directory_uri() . '/css/font-awesome.min.css' );

	wp_enqueue_script('jquery');
	wp_enqueue_script('theme-front-script', get_stylesheet_directory_uri() . '/js/front-script.js' );
	wp_enqueue_script('bootstrap-script', get_stylesheet_directory_uri() . '/js/bootstrap.js' );
}
add_action( 'wp_enqueue_scripts', 'theme_front_enqueue_script' );

/*
function theme_dynamic_sidebar($index, $page_id)
{
	global $wp_registered_sidebars, $wp_registered_widgets;
	if(isset($page_id) && !empty($page_id))
	{
		$theme_assign_widget = unserialize( get_post_meta($page_id,"_theme_assign_widget",true) );

		if (!empty($index))
		{
			$sidebar = $wp_registered_sidebars[$index];
			foreach ( (array) $theme_assign_widget as $id )
			{
				if ( !isset($wp_registered_widgets[$id]) ) continue;

				$params = array_merge(
					array( array_merge( $sidebar, array('widget_id' => $id, 'widget_name' => $wp_registered_widgets[$id]['name']) ) ),
					(array) $wp_registered_widgets[$id]['params']);

				// Substitute HTML id and class attributes into before_widget
				$classname_ = '';
				foreach ( (array) $wp_registered_widgets[$id]['classname'] as $cn )
				{
					if ( is_string($cn) )
						$classname_ .= '_' . $cn;
					elseif ( is_object($cn) )
						$classname_ .= '_' . get_class($cn);
				}

				$classname_ = ltrim($classname_, '_');
				$params[0]['before_widget'] = sprintf($params[0]['before_widget'], $id, $classname_);

				$params = apply_filters( 'dynamic_sidebar_params', $params );

				$callback = $wp_registered_widgets[$id]['callback'];

				do_action( 'dynamic_sidebar', $wp_registered_widgets[ $id ] );

				if ( is_callable($callback) )
				{
					call_user_func_array($callback, $params);
					$did_one = true;
				}
			}
		}//index found
	}//pagid found
}
*/

function the_content_filter($content) {

    $block = join("|",array("home_left_column", "home_right_column"));
    $rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
    $rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
	return $rep;
}
add_filter("the_content", "the_content_filter");

function wpse_wpautop_nobr( $content )
{
	return wpautop( $content, false );
}

function my_remove_version_info() {
     return '';
}
add_filter('the_generator', 'my_remove_version_info');

// remove wp version param from any enqueued scripts
function vc_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = esc_url( remove_query_arg( 'ver', $src ) );
    return $src;
}
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );

// Fed Govt analytics script
function federated_analytics_tracking_code(){
    echo '<script language="javascript" id="_fed_an_ua_tag" src="http://www2.ed.gov/style/Universal-Federated-Analytics.1.0.js?ver=true&agency=ED"></script>';
}
add_action('wp_head', 'federated_analytics_tracking_code');

/** 
 * Title tag filter - to include parent titles
 */
function oii_title_filter( $title, $sep, $seplocation ) {
    global $post;
    // get special index page type (if any)
    if( is_category() ) $type = 'News Category';
    elseif( is_tag() ) $type = 'Tag';
    elseif( is_author() ) $type . 'Author';
    elseif( is_date() || is_archive() ) $type = 'Archives';
    else $type = false;
 
    // get the page number
    if( get_query_var( 'paged' ) ) 
        $page_num = 'Page '.get_query_var( 'paged' ); // on index
    elseif( get_query_var( 'page' ) ) 
        $page_num = get_query_var( 'page' ); // on single
    else $page_num = false;
 
    // strip title separator
    $title = trim( str_replace( $sep, '', $title ) );
    
    if(intval($post->post_parent)>0)
    	$title = get_the_title($post->post_parent) . ' '.$sep.' '. $title;
 
    // determine order based on seplocation
    $parts = array( get_bloginfo( 'name' ), $type, $title, $page_num );
    if( $seplocation == 'left' ) 
        $parts = array_reverse( $parts );
     
    // strip blanks, implode, and return title tag
    $parts = array_filter( $parts );
    return implode( ' ' . $sep . ' ', $parts );
}
add_filter( 'wp_title', 'oii_title_filter', 10, 3 );

// remove the default twentytwelve_title filter
add_action( 'after_setup_theme', 'oii_turnoff_twentytwelve_title' );
function oii_turnoff_twentytwelve_title() {
        remove_filter( 'wp_title', 'twentytwelve_wp_title', 10, 2 );
}

// Google Analytics script
function google_analytics_with_pagetitle(){
    $ga_id = 'UA-64242956-1';
	$sep = '|';
	
    $pagetitle = trim( str_replace( get_bloginfo('name'), '', wp_title('|', false) ), $sep.' ');
    
	// is the current page a tag archive page?
	if ( is_home() || is_front_page() ) {
		$pagetitle = 'Home';
		
	} elseif (function_exists('is_tag') && is_tag()) { 
		$pagetitle = 'Tag Archive - '.$tag; 

	// or, is the page a search page?
	} elseif (is_search()) { 
		$pagetitle = 'Search for &quot;'.get_search_query().'&quot;'; 

	// or, is the page an error page?
	} elseif (is_404()) {
		$pagetitle = '404 Error - Page Not Found'; 
	}
    
    echo "<script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga'); ";
    echo "ga('create', '" . $ga_id . "', 'auto'); ";
	echo "ga('send', 'pageview', {'title': '". $pagetitle ."' }); </script>";
	
}
add_action('wp_head', 'google_analytics_with_pagetitle');


/**
 * Related Posts Widget.
 */
require_once( get_stylesheet_directory() . '/widgets/related_posts_widget.php' );
add_action( 'widgets_init' , 'register_oii_widget' );

function register_oii_widget(){
    register_widget( 'Related_Posts_Widget' );
}

/* minor style changes to News "Continue Reading" links
add_filter( 'the_content_more_link', 'modify_read_more_link' );
function modify_read_more_link() {
	return '<a class="more-link" href="' . get_permalink() . '">Read More <span class="meta-nav">&rarr;</span></a>';
}
*/

/**
 * Initialize Categories and Tags for Pages
 **/
add_action( 'init', 'taxonomies_for_pages' );
if ( ! is_admin() ) {
    add_action( 'pre_get_posts',  'category_archives' );
    add_action( 'pre_get_posts', 'tags_archives' );
} //

/**
* Registers the taxonomy terms for the post type
*
*/
function taxonomies_for_pages() {
    register_taxonomy_for_object_type( 'post_tag', 'page' );
    register_taxonomy_for_object_type( 'category', 'page' );
} // taxonomies_for_pages

/**
  * Includes the tags in archive pages
  *
  * Modifies the query object to include pages
  * as well as posts in the items to be returned
  * on archive pages
  *
  */
 function tags_archives( $wp_query ) {
    if ( $wp_query->get( 'tag' ) )
        $wp_query->set( 'post_type', 'any' );

 } // tags_archives

 /**
  * Includes the categories in archive pages
  *
  * Modifies the query object to include pages
  * as well as posts in the items to be returned
  * on archive pages
  *
  */
 function category_archives( $wp_query ) {
    if ( $wp_query->get( 'category_name' ) || $wp_query->get( 'cat' ) )
        $wp_query->set( 'post_type', 'any' );

 } // category_archives

 add_action( 'wp_footer' , 'add_footer_script' );
 function add_footer_script(){
    wp_enqueue_script('theme-bottom-script', get_stylesheet_directory_uri() . '/js/bottom-script.js' );
 }
 
function related_posts_where( $where ) {
    return $where." AND post_type='post'";
}

if (is_admin()) {
    $contact_metabox = new Contact_Metabox();
}
