<?php
/**
 * Template Name: Program Template
 */

global $post;

$page_id = get_the_ID();
get_header();
?>

           <!--Program Landing Template Top Section START-->
        <div class="row custom-common-padding">
            <div class="col-md-8">
                <div class="left-description-section">
                    <h1 class="h1-bottom-space"><?php echo get_the_title(); ?></h1>
                     <?php
                        if ( has_post_thumbnail() ) {
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id($page_id), 'single-post-thumbnail' );

                            echo "<div class='left-section-featured-image'>
                                    <img src=".$image[0]."></div>";
                        } 
                    ?>
                    <!--Program Blocks START-->
                    <?php  if( have_rows('program_info') ): ?>
                        <div class="program-block-section">
                            <div class="gray-background-color program-block-inner-section">
                                <?php 
                                    while ( have_rows('program_info') ) : the_row();
                                      $programLabel =  get_sub_field('program_title');
                                      $programDescription =  get_sub_field('program_description');
                                ?>
                                <div class="row program-list-detail">
                                    <div class="col-md-5">
                                        <label class="program-block-title"><?php echo $programLabel;?></label>
                                    </div>
                                    <div class="col-md-7">
                                        <p class="program-block-description"><?php echo $programDescription;?></p>
                                    </div>
                                </div>
                             <?php endwhile; ?>   
                            </div>
                        </div>
                    <?php endif; ?>    
                    <!--Program Blocks END-->
                    <?php if( get_field('program_short_description') ): ?>
                        <p class="">
                            <?php echo  the_field("program_short_description") ?>
                        </p>
                    <?php endif; ?>    
                </div>
            </div>
            <div class="col-md-4">
                <?php echo contactInformationBlock() ?>
            </div>
        </div>
        <!--Program Landing Template Top Section END-->

        <!--Program Landing Template Overview Section START-->
        <div class="row custom-common-padding overview-custom-padding">
            <div class="col-md-8">
               <?php
                 while (have_posts()) : the_post(); get_template_part('content', 'page'); 
                endwhile;
               ?>
            </div>
            <div class="col-md-4">
                <div class="secondary-navigation-menu">
                    <div class="secondary-navigation-menu-header">
                        <p>Impact Aid Program</p>
                    </div>
                    <ul class="secondary-navigation-menu-list">
                        <li>
                            <a href="#">Families</a>
                        </li>
                        <li>
                            <a href="#">Educators</a>
                        </li>
                        <li>
                            <a href="#">Administrators</a>
                        </li>
                        <li>
                            <a href="#">Eligibility</a>
                        </li>
                        <li>
                            <a href="#">Applicant Info</a>
                        </li>
                        <li>
                            <a href="#">Awards</a>
                        </li>
                        <li>
                            <a href="#">Performance</a>
                        </li>
                        <li>
                            <a href="#">Funding Status</a>
                        </li>
                        <li>
                            <a href="#">Laws, Regs, & Guidance</a>
                        </li>
                        <li>
                            <a href="#">Resources</a>
                        </li>
                        <li>
                            <a href="#">FAQs</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--Program Landing Template Overview Section END-->

        <!--Div seperator-->
        <div class="row mr-0 ml-0">
            <div class="col-md-12 pr-0 pl-0">
                <div class="seperate-dark-blue-border"></div>
            </div>
        </div>
        <!--Div seperator END-->


        <!--Payments Section START-->
     
        <?php getTileLinks(); ?>
        
        <!--Payments Section END-->

<?php get_footer(); ?>
