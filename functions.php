<?php
/**
 * OESE functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 */


// Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
  $content_width = 625;
}

/**
 * Twenty Twelve setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Twelve supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 *  custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_setup() {
  /*
   * Makes Twenty Twelve available for translation.
   *
   * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentytwelve
   * If you're building a theme based on Twenty Twelve, use a find and replace
   * to change 'twentytwelve' to the name of your theme in all the template files.
   */
  load_theme_textdomain( 'twentytwelve' );

  // This theme styles the visual editor with editor-style.css to match the theme style.
  add_editor_style();

  // Load regular editor styles into the new block-based editor.
  add_theme_support( 'editor-styles' );

  // Load default block styles.
  add_theme_support( 'wp-block-styles' );

  // Add support for responsive embeds.
  add_theme_support( 'responsive-embeds' );

  // Add support for custom color scheme.
  add_theme_support(
    'editor-color-palette',
    array(
      array(
        'name'  => __( 'Blue', 'twentytwelve' ),
        'slug'  => 'blue',
        'color' => '#21759b',
      ),
      array(
        'name'  => __( 'Dark Gray', 'twentytwelve' ),
        'slug'  => 'dark-gray',
        'color' => '#444',
      ),
      array(
        'name'  => __( 'Medium Gray', 'twentytwelve' ),
        'slug'  => 'medium-gray',
        'color' => '#9f9f9f',
      ),
      array(
        'name'  => __( 'Light Gray', 'twentytwelve' ),
        'slug'  => 'light-gray',
        'color' => '#e6e6e6',
      ),
      array(
        'name'  => __( 'White', 'twentytwelve' ),
        'slug'  => 'white',
        'color' => '#fff',
      ),
    )
  );

  // Adds RSS feed links to <head> for posts and comments.
  add_theme_support( 'automatic-feed-links' );

  // This theme supports a variety of post formats.
  add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

  // This theme uses wp_nav_menu() in one location.
  register_nav_menu( 'primary', __( 'Primary Menu', 'twentytwelve' ) );

  /*
   * This theme supports custom background color and image,
   * and here we also set up the default background color.
   */
  add_theme_support(
    'custom-background',
    array(
      'default-color' => 'e6e6e6',
    )
  );

  // This theme uses a custom image size for featured images, displayed on "standard" posts.
  add_theme_support( 'post-thumbnails' );
  set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop

  // Indicate widget sidebars can use selective refresh in the Customizer.
  add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'twentytwelve_setup' );

/**
 * Add support for a custom header image.
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Return the Google font stylesheet URL if available.
 *
 * The use of Open Sans by default is localized. For languages that use
 * characters not supported by the font, the font can be disabled.
 *
 * @since Twenty Twelve 1.2
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function twentytwelve_get_font_url() {
  $font_url = '';

  /* translators: If there are characters in your language that are not supported
   * by Open Sans, translate this to 'off'. Do not translate into your own language.
   */
  if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'twentytwelve' ) ) {
    $subsets = 'latin,latin-ext';

    /* translators: To add an additional Open Sans character subset specific to your language,
     * translate this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language.
     */
    $subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'twentytwelve' );

    if ( 'cyrillic' == $subset ) {
      $subsets .= ',cyrillic,cyrillic-ext';
    } elseif ( 'greek' == $subset ) {
      $subsets .= ',greek,greek-ext';
    } elseif ( 'vietnamese' == $subset ) {
      $subsets .= ',vietnamese';
    }

    $query_args = array(
      'family' => 'Open+Sans:400italic,700italic,400,700',
      'subset' => $subsets,
    );
    $font_url   = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
  }

  return $font_url;
}

/**
 * Enqueue scripts and styles for front end.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_scripts_styles() {
  global $wp_styles;

  /*
   * Adds JavaScript to pages with the comment form to support
   * sites with threaded comments (when in use).
   */
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }

  // Adds JavaScript for handling the navigation menu hide-and-show behavior.
  wp_enqueue_script( 'twentytwelve-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20140711', true );

  $font_url = twentytwelve_get_font_url();
  if ( ! empty( $font_url ) ) {
    wp_enqueue_style( 'twentytwelve-fonts', esc_url_raw( $font_url ), array(), null );
  }

  // Loads our main stylesheet.
  wp_enqueue_style( 'twentytwelve-style', get_stylesheet_uri() );

  // Theme block stylesheet.
  wp_enqueue_style( 'twentytwelve-block-style', get_template_directory_uri() . '/css/blocks.css', array( 'twentytwelve-style' ), '20181230' );

  // Loads the Internet Explorer specific stylesheet.
  wp_enqueue_style( 'twentytwelve-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentytwelve-style' ), '20121010' );
  $wp_styles->add_data( 'twentytwelve-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'twentytwelve_scripts_styles' );

/**
 * Enqueue styles for the block-based editor.
 *
 * @since Twenty Twelve 2.6
 */
function twentytwelve_block_editor_styles() {
  // Block styles.
  wp_enqueue_style( 'twentytwelve-block-editor-style', get_template_directory_uri() . '/css/editor-blocks.css', array(), '20181230' );
  // Add custom fonts.
  wp_enqueue_style( 'twentytwelve-fonts', twentytwelve_get_font_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'twentytwelve_block_editor_styles' );

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Twelve 2.2
 *
 * @param array   $urls          URLs to print for resource hints.
 * @param string  $relation_type The relation type the URLs are printed.
 * @return array URLs to print for resource hints.
 */
function twentytwelve_resource_hints( $urls, $relation_type ) {
  if ( wp_style_is( 'twentytwelve-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
    if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '>=' ) ) {
      $urls[] = array(
        'href' => 'https://fonts.gstatic.com',
        'crossorigin',
      );
    } else {
      $urls[] = 'https://fonts.gstatic.com';
    }
  }

  return $urls;
}
add_filter( 'wp_resource_hints', 'twentytwelve_resource_hints', 10, 2 );

/**
 * Filter TinyMCE CSS path to include Google Fonts.
 *
 * Adds additional stylesheets to the TinyMCE editor if needed.
 *
 * @uses twentytwelve_get_font_url() To get the Google Font stylesheet URL.
 *
 * @since Twenty Twelve 1.2
 *
 * @param string $mce_css CSS path to load in TinyMCE.
 * @return string Filtered CSS path.
 */
function twentytwelve_mce_css( $mce_css ) {
  $font_url = twentytwelve_get_font_url();

  if ( empty( $font_url ) ) {
    return $mce_css;
  }

  if ( ! empty( $mce_css ) ) {
    $mce_css .= ',';
  }

  $mce_css .= esc_url_raw( str_replace( ',', '%2C', $font_url ) );

  return $mce_css;
}
add_filter( 'mce_css', 'twentytwelve_mce_css' );

/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Twenty Twelve 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function twentytwelve_wp_title( $title, $sep ) {
  global $paged, $page;

  if ( is_feed() ) {
    return $title;
  }

  // Add the site name.
  $title .= get_bloginfo( 'name', 'display' );

  // Add the site description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title = "$title $sep $site_description";
  }

  // Add a page number if necessary.
  if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
    $title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );
  }

  return $title;
}
add_filter( 'wp_title', 'twentytwelve_wp_title', 10, 2 );

/**
 * Filter the page menu arguments.
 *
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_page_menu_args( $args ) {
  if ( ! isset( $args['show_home'] ) ) {
    $args['show_home'] = true;
  }
  return $args;
}
add_filter( 'wp_page_menu_args', 'twentytwelve_page_menu_args' );

/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_widgets_init() {
  register_sidebar(
    array(
      'name'          => __( 'Main Sidebar', 'twentytwelve' ),
      'id'            => 'sidebar-1',
      'description'   => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'twentytwelve' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>',
    )
  );

  register_sidebar(
    array(
      'name'          => __( 'First Front Page Widget Area', 'twentytwelve' ),
      'id'            => 'sidebar-2',
      'description'   => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'twentytwelve' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>',
    )
  );

  register_sidebar(
    array(
      'name'          => __( 'Second Front Page Widget Area', 'twentytwelve' ),
      'id'            => 'sidebar-3',
      'description'   => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'twentytwelve' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>',
    )
  );
}
add_action( 'widgets_init', 'twentytwelve_widgets_init' );

if ( ! function_exists( 'twentytwelve_content_nav' ) ) :
  /**
   * Displays navigation to next/previous pages when applicable.
   *
   * @since Twenty Twelve 1.0
   */
  function twentytwelve_content_nav( $html_id ) {
    global $wp_query;

    if ( $wp_query->max_num_pages > 1 ) : ?>
      <nav id="<?php echo esc_attr( $html_id ); ?>" class="navigation" role="navigation">
        <h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
        <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentytwelve' ) ); ?></div>
        <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?></div>
      </nav><!-- .navigation -->
      <?php
  endif;
  }
endif;

if ( ! function_exists( 'twentytwelve_comment' ) ) :
  /**
   * Template for comments and pingbacks.
   *
   * To override this walker in a child theme without modifying the comments template
   * simply create your own twentytwelve_comment(), and that function will be used instead.
   *
   * Used as a callback by wp_list_comments() for displaying the comments.
   *
   * @since Twenty Twelve 1.0
   */
  function twentytwelve_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
      case 'pingback':
      case 'trackback':
        // Display trackbacks differently than normal comments.
        ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
    <p><?php _e( 'Pingback:', 'twentytwelve' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?></p>
        <?php
        break;
      default:
        // Proceed with normal comments.
        global $post;
        ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <article id="comment-<?php comment_ID(); ?>" class="comment">
      <header class="comment-meta comment-author vcard">
        <?php
          echo get_avatar( $comment, 44 );
          printf(
            '<cite><b class="fn">%1$s</b> %2$s</cite>',
            get_comment_author_link(),
            // If current post author is also comment author, make it known visually.
            ( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'twentytwelve' ) . '</span>' : ''
          );
          printf(
            '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
            esc_url( get_comment_link( $comment->comment_ID ) ),
            get_comment_time( 'c' ),
            /* translators: 1: date, 2: time */
            sprintf( __( '%1$s at %2$s', 'twentytwelve' ), get_comment_date(), get_comment_time() )
          );
        ?>
        </header><!-- .comment-meta -->

        <?php if ( '0' == $comment->comment_approved ) : ?>
        <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentytwelve' ); ?></p>
      <?php endif; ?>

        <section class="comment-content comment">
        <?php comment_text(); ?>
        <?php edit_comment_link( __( 'Edit', 'twentytwelve' ), '<p class="edit-link">', '</p>' ); ?>
        </section><!-- .comment-content -->

        <div class="reply">
        <?php
        comment_reply_link(
          array_merge(
            $args,
            array(
              'reply_text' => __( 'Reply', 'twentytwelve' ),
              'after'      => ' <span>&darr;</span>',
              'depth'      => $depth,
              'max_depth'  => $args['max_depth'],
            )
          )
        );
        ?>
        </div><!-- .reply -->
      </article><!-- #comment-## -->
        <?php
        break;
    endswitch; // end comment_type check
  }
endif;

if ( ! function_exists( 'twentytwelve_entry_meta' ) ) :
  /**
   * Set up post entry meta.
   *
   * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
   *
   * Create your own twentytwelve_entry_meta() to override in a child theme.
   *
   * @since Twenty Twelve 1.0
   */
  function twentytwelve_entry_meta() {
    // Translators: used between list items, there is a space after the comma.
    $categories_list = get_the_category_list( __( ', ', 'twentytwelve' ) );

    // Translators: used between list items, there is a space after the comma.
    $tag_list = get_the_tag_list( '', __( ', ', 'twentytwelve' ) );

    $date = sprintf(
      '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
      esc_url( get_permalink() ),
      esc_attr( get_the_time() ),
      esc_attr( get_the_date( 'c' ) ),
      esc_html( get_the_date() )
    );

    $author = sprintf(
      '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
      esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
      esc_attr( sprintf( __( 'View all posts by %s', 'twentytwelve' ), get_the_author() ) ),
      get_the_author()
    );

    // Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
    if ( $tag_list ) {
      $utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
    } elseif ( $categories_list ) {
      $utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
    } else {
      $utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
    }

    printf(
      $utility_text,
      $categories_list,
      $tag_list,
      $date,
      $author
    );
  }
endif;

/**
 * Extend the default WordPress body classes.
 *
 * Extends the default WordPress body class to denote:
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 * 2. Front Page template: thumbnail in use and number of sidebars for
 *    widget areas.
 * 3. White or empty background color to change the layout and spacing.
 * 4. Custom fonts enabled.
 * 5. Single or multiple authors.
 *
 * @since Twenty Twelve 1.0
 *
 * @param array $classes Existing class values.
 * @return array Filtered class values.
 */
function twentytwelve_body_class( $classes ) {
  $background_color = get_background_color();
  $background_image = get_background_image();

  if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) ) {
    $classes[] = 'full-width';
  }

  if ( is_page_template( 'page-templates/front-page.php' ) ) {
    $classes[] = 'template-front-page';
    if ( has_post_thumbnail() ) {
      $classes[] = 'has-post-thumbnail';
    }
    if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) ) {
      $classes[] = 'two-sidebars';
    }
  }

  if ( empty( $background_image ) ) {
    if ( empty( $background_color ) ) {
      $classes[] = 'custom-background-empty';
    } elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) ) {
      $classes[] = 'custom-background-white';
    }
  }

  // Enable custom font class only if the font CSS is queued to load.
  if ( wp_style_is( 'twentytwelve-fonts', 'queue' ) ) {
    $classes[] = 'custom-font-enabled';
  }

  if ( ! is_multi_author() ) {
    $classes[] = 'single-author';
  }

  return $classes;
}
add_filter( 'body_class', 'twentytwelve_body_class' );

/**
 * Adjust content width in certain contexts.
 *
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_content_width() {
  if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {
    global $content_width;
    $content_width = 960;
  }
}
add_action( 'template_redirect', 'twentytwelve_content_width' );

/**
 * Register postMessage support.
 *
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Twenty Twelve 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function twentytwelve_customize_register( $wp_customize ) {
  $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
  $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
  $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

  if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial(
      'blogname',
      array(
        'selector'            => '.site-title > a',
        'container_inclusive' => false,
        'render_callback'     => 'twentytwelve_customize_partial_blogname',
      )
    );
    $wp_customize->selective_refresh->add_partial(
      'blogdescription',
      array(
        'selector'            => '.site-description',
        'container_inclusive' => false,
        'render_callback'     => 'twentytwelve_customize_partial_blogdescription',
      )
    );
  }
}
add_action( 'customize_register', 'twentytwelve_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Twenty Twelve 2.0
 * @see twentytwelve_customize_register()
 *
 * @return void
 */
function twentytwelve_customize_partial_blogname() {
  bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Twenty Twelve 2.0
 * @see twentytwelve_customize_register()
 *
 * @return void
 */
function twentytwelve_customize_partial_blogdescription() {
  bloginfo( 'description' );
}

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_customize_preview_js() {
  wp_enqueue_script( 'twentytwelve-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20141120', true );
}
add_action( 'customize_preview_init', 'twentytwelve_customize_preview_js' );


/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Twelve 2.4
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function twentytwelve_widget_tag_cloud_args( $args ) {
  $args['largest']  = 22;
  $args['smallest'] = 8;
  $args['unit']     = 'pt';
  $args['format']   = 'list';

  return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentytwelve_widget_tag_cloud_args' );




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
// require_once( get_stylesheet_directory() . '/theme-functions/theme-shortcode.php' );

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

  /**
  * OII Menu Walker
  **/
 require_once( get_stylesheet_directory() . '/classes/oii-walker.php' );

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
    wp_enqueue_style( 'theme-bootstrap-style',get_stylesheet_directory_uri() . '/css/bootstrap.min.css' );
    wp_enqueue_style( 'theme-font-style',get_stylesheet_directory_uri() . '/css/fontawesome/css/all.min.css' );

	wp_enqueue_style( 'theme-main-style',get_stylesheet_directory_uri() . '/css/mainstyle.css' );

	wp_enqueue_script('jquery');
	wp_enqueue_script('theme-front-script', get_stylesheet_directory_uri() . '/js/front-script.js' );
	wp_enqueue_script('bootstrap-script', get_stylesheet_directory_uri() . '/js/bootstrap.js' );
    wp_enqueue_script('theme-back-script', get_stylesheet_directory_uri() . '/js/modernizr-custom.js' );
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
    echo '<script type="text/javascript" id="_fed_an_ua_tag" src="https://dap.digitalgov.gov/Universal-Federated-Analytics-Min.js?agency=ED"></script>';
}
add_action('wp_head', 'federated_analytics_tracking_code');

/**
 * Title tag filter - to include parent titles
 */
// function oii_title_filter( $title, $sep, $seplocation ) {
//     global $post;
//     // get special index page type (if any)
//     if( is_category() ) $type = 'News Category';
//     elseif( is_tag() ) $type = 'Tag';
//     elseif( is_author() ) $type . 'Author';
//     elseif( is_date() || is_archive() ) $type = 'Archives';
//     else $type = false;

//     // get the page number
//     if( get_query_var( 'paged' ) )
//         $page_num = 'Page '.get_query_var( 'paged' ); // on index
//     elseif( get_query_var( 'page' ) )
//         $page_num = get_query_var( 'page' ); // on single
//     else $page_num = false;

//     // strip title separator
//     $title = trim( str_replace( $sep, '', $title ) );

//     if(intval($post->post_parent)>0)
//     	$title = get_the_title($post->post_parent) . ' '.$sep.' '. $title;

//     // determine order based on seplocation
//     $parts = array( get_bloginfo( 'name' ), $type, $title, $page_num );
//     if( $seplocation == 'left' )
//         $parts = array_reverse( $parts );

//     // strip blanks, implode, and return title tag
//     $parts = array_filter( $parts );
//     return implode( ' ' . $sep . ' ', $parts );
// }
// add_filter( 'wp_title', 'oii_title_filter', 10, 3 );

// remove the default twentytwelve_title filter
add_action( 'after_setup_theme', 'oii_turnoff_twentytwelve_title' );
function oii_turnoff_twentytwelve_title() {
        remove_filter( 'wp_title', 'twentytwelve_wp_title', 10, 2 );
}

// Google Analytics script
// function google_analytics_with_pagetitle(){
//     $ga_id = 'UA-64242956-1';
// 	$sep = '|';

//     $pagetitle = trim( str_replace( get_bloginfo('name'), '', wp_title('|', false) ), $sep.' ');

// 	// is the current page a tag archive page?
// 	if ( is_home() || is_front_page() ) {
// 		$pagetitle = 'Home';

// 	} elseif (function_exists('is_tag') && is_tag()) {
// 		$pagetitle = 'Tag Archive - '.$tag;

// 	// or, is the page a search page?
// 	} elseif (is_search()) {
// 		$pagetitle = 'Search for &quot;'.get_search_query().'&quot;';

// 	// or, is the page an error page?
// 	} elseif (is_404()) {
// 		$pagetitle = '404 Error - Page Not Found';
// 	}

//     echo "<script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga'); ";
//     echo "ga('create', '" . $ga_id . "', 'auto'); ";
// 	echo "ga('send', 'pageview', {'title': '". $pagetitle ."' }); </script>";

// }
// add_action('wp_head', 'google_analytics_with_pagetitle');


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
register_nav_menu( 'footer', __( 'Footer Menu', 'twentytwelve' ) );


/**
* Getting Populars post from Pages OESE Theme
*/
  function getPopularResources(){

    if( have_rows('popular_resources_links') ):
      $output = "<div class='secondary-navigation-menu'><div class='secondary-navigation-menu-header'><p>". get_field('popular_resources_title')."</p></div>";
      // check if the repeater field has rows of data

        $output.=  "<ul class='secondary-navigation-menu-list'>";
        // loop through the rows of data
          while ( have_rows('popular_resources_links') ) : the_row();
            $resourceLabel =  get_sub_field('resource_label');
            $resourceLink =  get_sub_field('resource_link');
            $externaLink =  get_sub_field('external_link');
            $target = ($externaLink ? "_blank" : "");
            $output.= "<li><a ". $target." href=".$resourceLink.">".$resourceLabel."</a></li>";
          endwhile;
        $output.=  "</ul>";
        $output.="</div>";
        echo $output;
      endif;

   }


/**
Enabling the Category and Tags for the media attachment
*
**/
function addingCategoryToAttachment() {
    register_taxonomy_for_object_type( 'category', 'attachment' );
}
add_action( 'init' , 'addingCategoryToAttachment' );


function addingTagsToAttachment() {
    register_taxonomy_for_object_type( 'post_tag', 'attachment' );
}
add_action( 'init' , 'addingTagsToAttachment' );

/*
  Category Filter for Media List Page
*/


add_action('pre_get_posts', 'mediaFilterByCategory');

function mediaFilterByCategory( $q ) {
if(is_admin()){

  global $current_user, $pagenow;

  if( !is_a( $current_user, 'WP_User') )
  return;  

  $cat = filter_input(INPUT_GET, 'category_name', FILTER_SANITIZE_STRING );   
  if ( ! $q->is_main_query() || ! is_admin() || (int)$cat <= 0 || !in_array( $pagenow, array( 'upload.php', 'admin-ajax.php' ) ))
  return;
    $posts = get_posts( 'nopaging=1&category=' . $cat );
    $pids = ( ! empty( $posts ) ) ? wp_list_pluck($posts, 'ID') : false;
    if ( ! empty($pids) ) {
      $pidstxt = implode($pids, ',');
      global $wpdb;
      $mids = $wpdb->get_col("SELECT ID FROM $wpdb->posts WHERE post_parent IN ($pidstxt)");
      if ( ! empty($mids) ) {

        $q->set( 'post__in', $mids );
      } else {
        $q->set( 'p', -1 );
      }
    }
  }
}

add_action( 'restrict_manage_posts', 'mediaCategoryDropdown' );

function mediaCategoryDropdown() {
  $scr = get_current_screen();
  if ( $scr->base !== 'upload' ) return;
  $cat = filter_input(INPUT_GET, 'category_name', FILTER_SANITIZE_STRING );
  $selected = (int)$cat > 0 ? $cat : '-1';
  $args = array(
      'show_option_none'   => 'All Post Categories',
      'name'               => 'category_name',
      'selected'           => $selected,
      'value_field'       => 'slug'
  );
  wp_dropdown_categories( $args );
}

function oeseBreadcrumb() {
  if(!is_front_page()){
    $html = ' <div class="col-md-12"><a class="breadcrumbs-link" href="'.home_url().'" rel="nofollow">OESE</a>';

    if (is_category() || is_single()) {
        $html .=  "&nbsp;&nbsp;&#47;&nbsp;&nbsp;";
        the_category(' &bull; ');
        if (is_single()) {
            $html .= "&nbsp;&nbsp;&#47;&nbsp;&nbsp;";
            $html .= "<a href='#' class='breadcrumbs-link active'>".get_the_title()."</a>";
        }
    } elseif (is_page()) {
        $html .= " &nbsp;&nbsp;&#47;&nbsp;&nbsp;";
        $html .=  "<a href='#' class='breadcrumbs-link active'>".get_the_title()."</a>";

    } elseif (is_search()) {
        $html .=  "&nbsp;&nbsp;&#47;&nbsp;&nbsp;Search Results for... ";
        $html .=  '"<em>';
        $html .=  the_search_query();
        $html .=  '</em>"';
    }
    $html .="</div>";
    echo $html;

  }
}


function contactInformationBlock(){

  $contactTitle = get_field("ci_title");
  $contactAddress = get_field("ci_address");
  $contactPhone = get_field("ci_phone");
  $contactFax = get_field("ci_fax");
  $contactEmailCheck = get_field("ci_email");
  $contactEmailOption = get_field("ci_email");
  $contactEmailAddress = get_field("ci_email_address");
  $output = "";
  if(!empty($contactAddress)){
      $output = '<div class="secondary-navigation-menu">
                        <div class="secondary-navigation-menu-header">
                            <p>'.$contactTitle.'</p>
                        </div>
                        <ul class="secondary-navigation-menu-list">
                            <li>'.$contactAddress.'</li>';
     if($contactPhone){
      $output.=  '<li>
                    <div class="sub-nav-icons">
                        <span>
                          <i class="fas fa-phone"></i>
                        </span>
                        <p>'.$contactPhone.'</p>
                    </div>
                  </li>';
     }
    if($contactFax){
      $output.= '<li>
                    <div class="sub-nav-icons">
                        <span>
                          <i class="fas fa-fax"></i>
                        </span>
                        <p>'.$contactFax.' FAX</p>
                     </div>
                </li>';
    }

    $output .= '<li>
                  <div class="sub-nav-icons">
                    <span>
                      <i class="fas fa-envelope"></i>
                    </span>
                    <p>';

    if($contactEmailOption != 'disabled'){
      if( ($contactEmailOption == 'email') && ($contactEmailAddress) ){
        $output.= '<a href="mailto:'.$contactEmailAddress.'?subject=OESE Website Contact">'.$contactEmailAddress.'</a>';
      } elseif ($contactEmailOption == 'contact_form'){
        $output.= '<button onclick="window.location.href=\'/contact\';">Contact Us</button>';
      }
    }

    $output .= '</p>
                  </div>
                </li>
              </ul>
          </div>';
  }
  return $output;

}

function getTileLinks(){
   if( have_rows('tile_links') ):
      $output = "<div class='row custom-common-padding gray-background-color mr-0 ml-0'>";
         while ( have_rows('tile_links') ) : the_row();
              $tileLinkLabel =  get_sub_field('tile_link_title');
              $tileLinkUrl =  get_sub_field('tile_link_url');
              $externaLink =  get_sub_field('external_link');
              $tileLinkWidth =  get_sub_field('width');
              if($tileLinkWidth == "half"){
                $colSize = "col-md-6 office-custom-padding office-grid-section-custom-margin";
                $outerDivClass = "office-grid-section";
                $innerDivClass = "office-grid-list-details text-center";
              }
              else{
                $colSize = "col-md-12 col-md-12 payments-custom-padding";
                $outerDivClass = "payments-overlay-section";
                $innerDivClass = "payments-details-list text-center";
              }
              $target = ($externaLink ? "_blank" : "");
              $output.= '<div class="'.$colSize.'">
                            <div class="'.$outerDivClass.'">
                                <div class="'.$innerDivClass.'">
                                  <p>'.$tileLinkLabel.'</p>
                                </div>
                            </div>
                          </div>';
            endwhile;
         $output.="</div>";
         echo $output;
    endif;
}


function oeseListChildPages() {

  global $post;
  if ( is_page() && $post->post_parent )

      $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
  else
      $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );

  if ( $childpages ) {
    $string = '<ul class="secondary-navigation-menu-list">' . $childpages . '</ul>';
  }

  return $string;

}

