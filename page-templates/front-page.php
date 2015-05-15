<?php
/**
 * Template Name: Home Page Template
 */
?>
<?php get_header();?>

<div class="row" id="home_content">
    <div class="col-md-9 col-sm-12 col-xs-12 padding_left tlkt_stp_cntnr_lft_sid">
        <?php
            while ( have_posts() ) : the_post();
                get_template_part( 'content', 'page' );
            endwhile;
        ?>
    </div>

    <div class="col-md-3 col-sm-12 col-xs-12 pblctn_right_sid_mtr">
        <?php get_sidebar( 'front' ); ?>
    </div>
</div>

<?php get_footer();?>