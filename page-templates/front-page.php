<?php
/**
 * Template Name: Home Page Template
 */
?>
<?php get_header();?>
<div class="row" id="home_content">
    <div id="content" class="col-md-9 col-sm-12 col-xs-12 padding_left lft_sid_cntnr" tabindex="-1">
        <?php
            while ( have_posts() ) : the_post();
                get_template_part( 'content', 'page' );
            endwhile;
        ?>
    </div>

    <div class="col-md-3 col-sm-12 col-xs-12 right_sid_mtr">
        <?php get_sidebar( 'front' ); ?>
    </div>
</div>

<?php get_footer();?>
