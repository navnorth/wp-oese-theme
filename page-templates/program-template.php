<?php
/**
 * Template Name: Program Template
 */

global $post;

$page_id = get_the_ID();
$img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$img_alt = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);

get_header();
?>

           <!--Offices/Programs Design START-->
        <div class="row custom-common-padding mr-0 ml-0">

            <div class="col-md-8">
                <!--Program Blocks START-->
                <div class="row program-block-section">
                    <div class="gray-background-color program-block-inner-section">
                        <div class="row">
                            <div class="col-md-5">
                                <label class="program-block-title">Program Office</label>
                            </div>
                            <div class="col-md-7">
                                <p class="program-block-description">Office of Formula Grants</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <label class="program-block-title">Program Type</label>
                            </div>
                            <div class="col-md-7">
                                <p class="program-block-description">Discretionary/Competitive Grants</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <label class="program-block-title">CFDA Number</label>
                            </div>
                            <div class="col-md-7">
                                <p class="program-block-description">12.345A</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <label class="program-block-title">Also Known as</label>
                            </div>
                            <div class="col-md-7">
                                <p class="program-block-description">Aid for Impacted Schools</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Program Blocks END-->


                <h1 class="h1-bottom-space">Offices & Programs</h1>

                <div class="office-programs-btn-section">
                    <button class="btn oese-blue-btn by-office-btn" title="By Office">By Office</button>
                    <button class="btn oese-blue-btn" title="By Subject">By Subject</button>
                </div>

                <h2 class="h2-top-bottom-space">Office of Administration</h2>
                <ul class="page-list-section">
                    <li>Executive Office</li>
                    <li>Management Support Office</li>
                </ul>

                <h2 class="h2-top-bottom-space">Office of Discretionary Grants & Support Services</h2>
                <ul class="page-list-section">
                    <li>Innovation & Early Learning Programs</li>
                    <li>Well-Rounded Education Programs</li>
                    <li>Charter School Programs</li>
                    <li>School Choice & Improvement Programs</li>
                    <li>Effective Educator Development Programs</li>
                    <li>Program & Grantee Support Services</li>
                </ul>

                <h2 class="h2-top-bottom-space">Office of Formula Grants</h2>
                <ul class="page-list-section">
                    <li>School Support & Accountability</li>
                    <li>Safe & Supportive Schools</li>
                    <li>Impact Aid Program</li>
                    <li>Rural, Insular, & Native Achievement Programs</li>
                </ul>

                <h2 class="h2-top-bottom-space">Office of Evidence - Based Practices and State & Grantee Relations</h2>
                <ul class="page-list-section">
                    <li>Expanding Student Choice & High Quality Schools</li>
                    <li>Effective Teaching & Social Emotional Learning</li>
                    <li>High Quality Assessments & Accountability Systems</li>
                    <li>State & Grantee Relations</li>
                </ul>

                <h2 class="h2-top-bottom-space">Office of Migrant Education</h2>
                <ul class="page-list-section">
                    <li>Migrant Education Group 1</li>
                    <li>Migrant Education Group 2</li>
                </ul>

                <h2 class="h2-top-bottom-space">Office of Indian Education</h2>
                <ul class="page-list-section">
                    <li>Migrant Education Group 1</li>
                    <li>Migrant Education Group 2</li>
                </ul>

            </div>
            <div class="col-md-4">
                <div class="secondary-navigation-menu">
                    <div class="secondary-navigation-menu-header">
                        <p>Popular Resources</p>
                    </div>
                    <ul class="secondary-navigation-menu-list">
                        <li>
                            <a href="#">Early Learning</a>
                        </li>
                        <li>
                            <a href="#">Family & Community Engagement</a>
                        </li>
                        <li>
                            <a href="#">Every Student Succeeds Act</a>
                        </li>
                        <li>
                            <a href="#">FERPA</a>
                        </li>
                        <li>
                            <a href="#">Project Prevent Grant</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <!--Offices/Programs Design STOP-->

<?php get_footer(); ?>
