<?php
/**
 * Template Name: Home Page Template
 */
?>
<?php get_header();?>

               <!--Home Page Custom Design - START-->

        <div class="row custom-common-padding front-page-content mr-0 ml-0">

            <!-- <h1 class="h1-bottom-space"><?php the_title(); ?></h1> -->
             <?php
                if(have_posts()):
                     while (have_posts()) : the_post(); get_template_part('content', 'page');
                     endwhile;
                endif;
            ?>

            <?php if( have_rows('categories') ):  ?>

                <div class="col-md-12 home-grid-section">
                    <div class="row">
                        <?php
                            while ( have_rows('categories') ) : the_row();
                                $cImage =  get_sub_field('c_image');
                                $cTitle =  get_sub_field('c_title');
                                $cLink =  get_sub_field('link');
                                $externaLink =  get_sub_field('c_external_link');
                                $target = ($externaLink ? "_blank" : "");
                        ?>
                        <div class="col-md-4 pl-0 pr-0 ml-0 mr-0 home-col-md-4">
                            <div class="custom-home-image-section">
                                <div class="custom-image-media">
                                    <a target="<?php echo $target; ?>" href="<?php echo $cLink ?>">
                                        <div class="custom-image-thumbnail">
                                            <div>
                                                <img src="<?php echo $cImage ;?>" alt="<?php echo $cTitle; ?>" class="img-responsive img-thumbnail-square">
                                            </div>
                                        </div>
                                        <div class="custom-home-image-heading text-center">
                                            <p><?php echo $cTitle; ?></p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>


        <!--Div seperator-->
        <div class="row mr-0 ml-0">
            <div class="col-md-12 pr-0 pl-0">
                <div class="seperate-dark-blue-border"></div>
            </div>
        </div>
        <!--Div seperator END-->


        <!--Tile Links Grid Section START-->

            <?php getTileLinks(); ?>

        <!--Tile Links Grid Section END-->



        <!--Div seperator-->
        <div class="row mr-0 ml-0">
            <div class="col-md-12 pr-0 pl-0">
                <div class="seperate-dark-blue-border"></div>
            </div>
        </div>
        <!--Div seperator END-->
        <?php if( have_rows('trending_now') ):  ?>

        <div class="row custom-common-padding mr-0 ml-0">

            <div class="col-md-12">
                <div class="row text-center">
                    <h1 class="h1-bottom-space trending-now-heading">Trending Now</h1>
                </div>
            </div>
            <div class="col-md-12 pl-0 pr-0">
                <div class="row">
                    <?php
                        while ( have_rows('trending_now') ) : the_row();
                            $tImage =  get_sub_field('image');
                            $tTitle =  get_sub_field('title');
                            $tDescription =  get_sub_field('description');
                            $tButtonLabel =  get_sub_field('button_label');
                            $tLink =  get_sub_field('link');
                            $externaLink =  get_sub_field('external_link');
                            $target = ($externaLink ? "_blank" : "");
                    ?>
                    <div class="col-md-4 home-col-md-4 pl-0 pr-0 ml-0 mr-0">
                        <div class="trending-now-section rounded">
                            <div class="trending-image-section">
                                <img src="<?php echo $tImage; ?>" alt="<?php echo $tTitle; ?>">
                            </div>
                            <div class="trending-image-details">
                                <p class="trending-image-details-title" title="Safe & Healthy Students">
                                    <?php echo $tTitle; ?>
                                </p>
                                <p class="trending-image-details-description">
                                   <?php echo $tDescription; ?>
                                </p>
                                <a target="<?php echo $target; ?>" href="<?php echo $tLink; ?>">
                                <button type="button" class="btn oese-btn-danger oese-btn-danger-small" title="Read More"><?php echo $tButtonLabel; ?></button>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                </div>
            </div>
        </div>

       <?php endif; ?>
        <!--Audience Page Custom Design - END-->


<?php get_footer();?>
