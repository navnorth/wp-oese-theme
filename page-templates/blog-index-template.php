<?php
/**
 * Template Name: News Index
 */
?>
<?php
    get_header();
    $page_id = get_the_ID();
?>

<div class="row">
    <div class="col-md-9 col-sm-12 col-xs-12 padding_left lft_sid_cntnr">

        <h1 class="entry-title"><?php the_title(); ?></h1>
        <div class="share_links_header"><?php echo do_shortcode("[ssba]"); ?></div>

        <?php // start with the top content for the page
            while ( have_posts() ) : the_post();
                get_template_part( 'content', 'page' );
            endwhile;
        ?>

        <hr />

        <?php /* Loop over all the blog posts */
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            query_posts( array( 'posts_per_page' => 10, 'post_status' => 'publish', 'paged' => $paged ) );

            while( have_posts() ): the_post();
                get_template_part( 'content', get_post_format() );
            endwhile;

            twentytwelve_content_nav( 'nav-below' );
        ?>

    </div>

    <div class="col-md-3 col-sm-12 col-xs-12 right_sid_mtr">
        <?php dynamic_sidebar( 'blog-index-template' ); ?>
    </div>
</div>
<?php get_footer();?>
