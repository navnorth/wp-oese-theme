<?php
global $post;
$contact_content = get_post_meta($post->ID,'_contact_box',true);
if (strlen($contact_content)>0){
?>
<div class="right_sid_mtr program_toc_box" id="contact">
	<div class="col-md-12 col-sm-6 col-xs-6" style="border: 3px solid #00529f;margin-bottom:10px;">
		<div class="pblctn_box">
			<span class="socl_icns fa-stack"><i class="fa fa-phone"></i></span>
		</div>
		<div class="cntnbx_cntnr">
			<p><span class="program_toc_header">Contact</span></p>
			<?php echo $contact_content; ?>
		</div>
	</div>
</div>
<?php }?>