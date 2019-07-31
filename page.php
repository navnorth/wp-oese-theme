<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package wp_oese_theme
 * @since 1.5.0
 */

get_header();
$col_class = "col-md-12";
$head_class = "";
$is_archived = false;
$archived_date = null;

if( have_rows('sidebar_links') )
    $col_class = "col-md-8";

if (get_field('archive_date'))
    $archived_date = get_field('archive_date');
    
if ($archived_date){
    $is_archived = true;
    $head_class = " archived-header";
}

?>

        <div id="content" class="row custom-common-padding mr-0 ml-0">

            <div class="<?php echo $col_class; ?>">
    
                <h1 class="h1-bottom-space<?php echo $head_class; ?>"><?php echo $post->post_title; ?></h1>
                <?php if ($is_archived): ?>
		<div class="oese-archived-disclaimer">
			<?php _e('<span class="fa fa-archive"></span><strong>Archived Content:</strong> The following page was archived on '.$archived_date.' but still has content that may be valuable to some people.', WP_OESE_THEME_SLUG); ?>
		</div>
		<?php endif; ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('content', 'page'); ?>
                <?php endwhile; ?>
                
            </div>
           
            <?php get_sidebar(); ?>

        </div>
    

<?php get_footer(); ?>
