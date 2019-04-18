<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package wp_oese_theme
 * @since 1.5.0
 */
?>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="ftr_strp"></div>
            </div>
            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-8">
                <div class="ftr_lnks">
                    <?php wp_nav_menu( array('menu' => "Footer Menu") );?>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4">
                <div class="ftr_logo text-right">
                    <a href="https://www.ed.gov" target="_blank"><img src="<?php echo get_stylesheet_directory_uri();?>/images/footer_logo.png" alt="Logo"/></a>
                </div>
            </div>
            <div class="col-md-12">
                <div class="ftr"></div>
            </div>
        </div>

    </div>
</div>
<?php wp_footer(); ?>
<!--[if lt IE 10]>
<!--<script src="<?php //echo get_stylesheet_directory_uri(); ?>/js/ie-menu.js" type="text/javascript"></script>-->
<![endif]-->
</body>
</html>
