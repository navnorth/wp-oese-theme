<?php
add_action("admin_init", "add_image_metabox");
function add_image_metabox()
{
	add_meta_box( "Assign Widgets to Pages", "Assign Widgets to Pages", "asgnwidget_metabox_func", "page", "side", "high" );
}
function asgnwidget_metabox_func()
{
	global $post;
	?>
	<a target="_blank" href="<?php echo site_url(); ?>/wp-admin/themes.php?page=theme-options&action=widget_assign&page_id=<?php echo $post->ID;?>">
			<strong><?php echo $post->post_title;?></strong>
	</a>
<?php
}

