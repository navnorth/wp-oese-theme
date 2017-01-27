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
    echo '<script language="javascript" id="_fed_an_ua_tag" src="//www2.ed.gov/style/Universal-Federated-Analytics.1.0.js?ver=true&agency=ED"></script>';
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

/**
 * News Categories Widget
 **/
require_once( get_stylesheet_directory() . '/widgets/news_categories_widget.php' );
add_action( 'widgets_init' , 'register_news_categories_widget' );
function register_news_categories_widget(){
    register_widget( 'News_Categories_Widget' );
}

/* minor style changes to News "Continue Reading" links */
add_filter( 'the_content_more_link', 'modify_read_more_link' );
function modify_read_more_link() {
	return ' <a class="more-link" href="' . get_permalink() . '">Read More</a>';
}


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

// altered wp_list_categories
function wp_list_categories_for_posts( $args = '' ) {
    $defaults = array(
	    'show_option_all' => '', 'show_option_none' => __('No categories'),
	    'orderby' => 'name', 'order' => 'ASC',
	    'style' => 'list',
	    'show_count' => 0, 'hide_empty' => 1,
	    'use_desc_for_title' => 1, 'child_of' => 0,
	    'feed' => '', 'feed_type' => '',
	    'feed_image' => '', 'exclude' => '',
	    'exclude_tree' => '', 'current_category' => 0,
	    'hierarchical' => true, 'title_li' => __( 'Categories' ),
	    'echo' => 1, 'depth' => 0,
	    'taxonomy' => 'category'
    );

    $r = wp_parse_args( $args, $defaults );

    if ( !isset( $r['pad_counts'] ) && $r['show_count'] && $r['hierarchical'] )
	$r['pad_counts'] = true;

    if ( true == $r['hierarchical'] ) {
	$r['exclude_tree'] = $r['exclude'];
	$r['exclude'] = '';
    }

    if ( ! isset( $r['class'] ) )
	$r['class'] = ( 'category' == $r['taxonomy'] ) ? 'categories' : $r['taxonomy'];

    if ( ! taxonomy_exists( $r['taxonomy'] ) ) {
	return false;
    }

    $show_option_all = $r['show_option_all'];
    $show_option_none = $r['show_option_none'];

    $categories = get_categories( $r );
    foreach ($categories as $key => $category){
       add_filter( 'posts_where' , 'related_posts_where' );
	$rPosts = new WP_Query(array(
		'post_type'             => array('post'),
		'posts_per_page'	=> -1,
		'is_single'             => true,
		'no_found_rows'         => true,
		'post_status'           => array('publish'),
		'ignore_sticky_posts'   => true,
		'cat'                   => $category->cat_ID
	));

	// If no posts found, ...
	if ($rPosts->post_count==0) {
	    unset($categories[$key]);
	} else {
	    $categories[$key]->count = $rPosts->post_count;
	}
    }

    $output = '';
    if ( $r['title_li'] && 'list' == $r['style'] ) {
	    $output = '<li class="' . esc_attr( $r['class'] ) . '">' . $r['title_li'] . '<ul>';
    }
    if ( empty( $categories ) ) {
	    if ( ! empty( $show_option_none ) ) {
		    if ( 'list' == $r['style'] ) {
			    $output .= '<li class="cat-item-none">' . $show_option_none . '</li>';
		    } else {
			    $output .= $show_option_none;
		    }
	    }
    } else {
	    if ( ! empty( $show_option_all ) ) {
		    $posts_page = ( 'page' == get_option( 'show_on_front' ) && get_option( 'page_for_posts' ) ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/' );
		    $posts_page = esc_url( $posts_page );
		    if ( 'list' == $r['style'] ) {
			    $output .= "<li class='cat-item-all'><a href='$posts_page'>$show_option_all</a></li>";
		    } else {
			    $output .= "<a href='$posts_page'>$show_option_all</a>";
		    }
	    }

	    if ( empty( $r['current_category'] ) && ( is_category() || is_tax() || is_tag() ) ) {
		    $current_term_object = get_queried_object();
		    if ( $current_term_object && $r['taxonomy'] === $current_term_object->taxonomy ) {
			    $r['current_category'] = get_queried_object_id();
		    }
	    }

	    if ( $r['hierarchical'] ) {
		    $depth = $r['depth'];
	    } else {
		    $depth = -1; // Flat.
	    }
	    $output .= walk_category_tree( $categories, $depth, $r );
    }

    if ( $r['title_li'] && 'list' == $r['style'] )
	    $output .= '</ul></li>';

    /**
     * Filter the HTML output of a taxonomy list.
     *
     * @since 2.1.0
     *
     * @param string $output HTML output.
     * @param array  $args   An array of taxonomy-listing arguments.
     */
    $html = apply_filters( 'wp_list_categories', $output, $args );
    wp_reset_postdata();
    if ( $r['echo'] ) {
	    echo $html;
    } else {
	    return $html;
    }
}

if (is_admin()) {
    $contact_metabox = new Contact_Metabox();
}

 /**
 * Register the footer Menu - removed in base twentytwelve theme
 */
register_nav_menu( 'Footer Menu', __( 'Footer Menu', 'twentytwelve' ) );

class oii_walker_nav_menu extends Walker_Nav_Menu {
	/**
	 * What the class handles.
	 *
	 * @see Walker::$tree_type
	 * @since 3.0.0
	 * @var string
	 */
	public $tree_type = array( 'post_type', 'taxonomy', 'custom' );

	/**
	 * Database fields to use.
	 *
	 * @see Walker::$db_fields
	 * @since 3.0.0
	 * @todo Decouple this.
	 * @var array
	 */
	public $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

	public $count = 0;
	
	public $level = 0;
	
	public $index = 0;
	
	public $menu_items = array();
	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker::start_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$this->level = $depth;
		var_dump($this->index);
		var_dump($this->menu_items[$this->index-1]);
		$indent = str_repeat("\t", $depth);
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0
		$classes = array(
		    'sub-menu',
		    ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
		    ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
		    'menu-depth-' . $display_depth
		    );
		$class_names = implode( ' ', $classes );
		$output .= "\n$indent<ul class=\"$class_names\">\n";
	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see Walker::end_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	/**
	 * Start the element output.
	 *
	 * @see Walker::start_el()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 * @param int    $id     Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		if ($depth>0)
		    $this->count++;
		
		$this->index++;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		//var_dump($depth);
		//var_dump($item->title);
		
		$this->menu_items[] = array(
				    'index' => $this->index,
				    'id' => $item->ID,
				    'depth' => $depth,
				    'title' => $item->title,
				    'parent' => $item->menu_item_parent
				    );
		
		/**
		 * Filter the CSS class(es) applied to a menu item's list item element.
		 *
		 * @since 3.0.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array  $classes The CSS classes that are applied to the menu item's `<li>` element.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of {@see wp_nav_menu()} arguments.
		 * @param int    $depth   Depth of menu item. Used for padding.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filter the ID applied to a menu item's list item element.
		 *
		 * @since 3.0.1
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of {@see wp_nav_menu()} arguments.
		 * @param int    $depth   Depth of menu item. Used for padding.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		/**
		 * Filter the HTML attributes applied to a menu item's anchor element.
		 *
		 * @since 3.6.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
		 *
		 *     @type string $title  Title attribute.
		 *     @type string $target Target attribute.
		 *     @type string $rel    The rel attribute.
		 *     @type string $href   The href attribute.
		 * }
		 * @param object $item  The current menu item.
		 * @param array  $args  An array of {@see wp_nav_menu()} arguments.
		 * @param int    $depth Depth of menu item. Used for padding.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		/** This filter is documented in wp-includes/post-template.php */
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		/**
		 * Filter a menu item's starting output.
		 *
		 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
		 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
		 * no filter for modifying the opening and closing `<li>` for a menu item.
		 *
		 * @since 3.0.0
		 *
		 * @param string $item_output The menu item's starting HTML output.
		 * @param object $item        Menu item data object.
		 * @param int    $depth       Depth of menu item. Used for padding.
		 * @param array  $args        An array of {@see wp_nav_menu()} arguments.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @see Walker::end_el()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Page data object. Not used.
	 * @param int    $depth  Depth of page. Not Used.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
	    
		$output .= "</li>\n";
	}

} // Walker_Nav_Menu