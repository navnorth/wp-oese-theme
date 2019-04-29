<?php
/**
 * Template Name: Office Template
 */

get_header();
global $post;
$page_id = get_the_ID();
?>

        <!--Office Template Top Section START-->
        <div class="row custom-common-padding">
            <div class="col-md-8">
                <div class="left-description-section">
                    <h1 class="h1-bottom-space"><?php echo get_the_title(); ?></h1>
                     <?php
                     while (have_posts()) : the_post(); get_template_part('content', 'page'); 
                     endwhile;
                   ?>
                </div>
            </div>
            <div class="col-md-4">
                <?php echo contactInformationBlock() ?>
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
       
            <?php getTileLinks(); ?>
            
        <!--Office Template Grid Section END-->

<?php get_footer(); ?>