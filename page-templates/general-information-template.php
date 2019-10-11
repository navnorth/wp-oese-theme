<?php
/**
 * Template Name: General Information Template
 */

get_header();
global $post;
$page_id = get_the_ID();
$head_class = "";
$is_archived = false;
$archived_date = null;
?>

    <!--Office Template Top Section START-->
    <div id="content" class="row custom-common-padding general-info-template">
        <div class="col-md-12">
            <?php if( have_rows('general_information_section')): ?>
                <?php while( have_rows('general_information_section')): the_row();

                    //vars
                    $tileTitle = get_sub_field('title');
                    $show_view_more = get_sub_field('include_view_more');
                    ?>

                    <div class="general-info-section">

                        <?php if($tileTitle): ?>
                            <h2> <?php echo $tileTitle; ?> </h2>
                        <?php endif; ?>

                        <?php if( have_rows('information_tiles')): ?>
                        <div class="row general-info-row">
                            <?php while( have_rows('information_tiles')): the_row();

                            //vars
                            $name = get_sub_field('name');
                            $description = get_sub_field('description');
                            $link = get_sub_field('link');
                            ?>

                            <div class="col-md-4 home-col-md-4 pl-0 pr-0 ml-0 mr-0">
                                <div class="general-info-section clearfix mb-5">
                                    <div class="general-info-details rounded">
                                        <h3 class="general-info-details-title mb-4" title="<?php echo $name; ?>">
                                            <?php echo $name; ?>
                                        </h3>
                                        <p class="general-info-details-description">
                                            <?php echo $description; ?>
                                        </p>
                                        <a href="<?php echo $link; ?>" role="button" class="btn oese-btn-danger oese-btn-danger-small" title="Read More">
                                            Read More
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <?php endwhile; ?>
                        </div>
                        <?php endif; ?>

                        <?php if($show_view_more): ?>
                            <button class="btn oese-btn-view-more float-right">View More</button>
                        <?php endif; ?>

                    </div>


                <?php endwhile; ?>

            <?php endif; ?>

            <?php
            while (have_posts()) : the_post(); get_template_part('content', 'page');
            endwhile;
            ?>
        </div>
    </div>
    <!--Office Template Top Section END-->


    <!--Div seperator-->
    <div class="row">
        <div class="col-md-12">
            <div class="seperate-dark-blue-border"></div>
        </div>
    </div>
    <!--Div seperator END-->
    <!--Office Template Grid Section START-->


    <!--Office Template Grid Section END-->

<?php get_footer(); ?>
