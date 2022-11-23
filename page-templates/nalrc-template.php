<?php
/**
* Template Name: NALRC Page Template
**/
global $post;

// Load Default OESE Header
get_header();

get_template_part('template-parts/nalrc/header');

?>
<div id="content" class="row custom-common-padding nalrc-template">
	<div class="row nalrc-details">
		<h1 class="page_header"><?php echo $post->post_title; ?></h1>
		<?php
		// Load Page Content
		while (have_posts()):
			the_post();
			get_template_part('content','page');
		endwhile;
		?>
	</div>
</div>
<?php 
get_template_part('template-parts/nalrc/footer');

// Load Default OESE Footer
get_footer();
?>