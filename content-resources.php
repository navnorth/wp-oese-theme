<?php
//Initial Checking for showing the resources box

$parentLink = null;
$withChild = false;
//$subpages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'menu_order', 'sort_order' => 'asc' ) );
$subpages = get_pages( array( 'parent' => $post->ID, 'sort_column' => 'menu_order', 'sort_order' => 'asc' ) );
if ($subpages)
	$withChild = true;
else {
	$parent_id = $post->post_parent;
	if ($parent_id>0)
		$withChild = true;
}

if($post->post_parent == 0){
	$sidebarTitle = $post->post_title;
}
else{
	$template = get_page_template_slug($post->post_parent);
	if ($template=="page-templates/program-template.php"){
		$sidebarTitle = get_the_title($post->post_parent);
		$parentLink = get_the_permalink($post->post_parent);
	}
	else
		$sidebarTitle = $post->post_title;
}

?>
<div class="secondary-navigation-menu" id="toc">
	<?php if ($withChild): ?>
		<div class="secondary-navigation-menu-header">
			<?php if ($parentLink): ?>
			<h2><a href="<?php echo $parentLink; ?>"><?php echo $sidebarTitle; ?></a></h2>
			<?php else: ?>
			<h2><?php echo $sidebarTitle; ?></h2>
			<?php endif; ?>
		</div>
		<ul class="secondary-navigation-menu-list childpages">
				<?php
					if ($subpages) {
						foreach($subpages as $spage) {
							if (!is_page_archived($spage->ID)) {
							?>
							<li><a href="<?php echo get_page_link($spage->ID); ?>"><?php echo $spage->post_title; ?></a></li>
							<?php
							}
						}
					} else {
						//Get Parent of Page
						$parent_id = $post->post_parent;
						if ($parent_id>0) {
							$parent_page = get_page($parent_id);
							//Display Sub page links
							$subpages = get_pages( array( 'parent' => $parent_id, 'sort_column' => 'menu_order', 'sort_order' => 'asc', 'parent' => $parent_id ) );

							foreach($subpages as $spage) {
								if (!is_page_archived($spage->ID)) {
									if ($post->ID==$spage->ID){
										echo "<li class='current-page'>" . $spage->post_title . "</li>";
									} else {
									?>
										<li><a href="<?php echo get_page_link($spage->ID); ?>"><?php echo $spage->post_title; ?></a></li>
									<?php
									}
								}
							}
						}
					}
				?>
		</ul>
	<?php endif; ?>
</div>