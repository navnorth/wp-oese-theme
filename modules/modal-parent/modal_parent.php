<?php
function wp_nn_script_enqueue(){
	wp_enqueue_style('wp-nn-parentpage-style.css', get_template_directory_uri() . '/modules/modal-parent/css/modal-parent.css', array() , null, 'all');
	wp_enqueue_script('wp-nn-parentpage-script.js', get_template_directory_uri() . '/modules/modal-parent/js/modal-parent.js' , array('jquery') , null, true);
}
add_action('admin_enqueue_scripts', 'wp_nn_script_enqueue');

function wp_nn_parentpage_add_metabox(){
    remove_meta_box('pageparentdiv', 'page', 'side');
    add_meta_box('wp-nn-parent-page','Parent Attributes','wp_nn_parentpage_meta_box_content','page','side','core');
}
add_action('add_meta_boxes', 'wp_nn_parentpage_add_metabox');

function wp_nn_parentpage_meta_box_content($post_id){
?>
	<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="parent_id">Parent</label></p>
	<div class="wp-nn-parentpage-display-wrapper">
    		<div class="wp-nn-parentpage-display-block">
        <?php $_curval = $post_id->post_parent; ?>
        <?php $_display = '(no parent)'; ?>
        <?php if ($post_id->post_parent > 0){
			$_ptitle = get_the_title($post_id->post_parent);
            if ($_ptitle == '') $_ptitle = "#" . $post_id->post_parent . ' (no title)';
			$_display = $_ptitle;
		}
		?>
        <input name="wp-nn-parentpage-display" type="text" id="wp-nn-parentpage-display" value="<?php echo $_display ?>" readonly="readonly" />
				<input name="parent_id" id="parent_id" type="hidden" value="<?php echo $_curval ?>" class="tagsdiv" />
        <input type="button" class="button  wp-nn-parentpage-display-change" value="Change">
        </div>
    </div>

	<?php $current_template = get_post_meta($post_id->ID, '_wp_page_template', true); ?>
    <p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="parent_id">Template</label></p>
		<select name="page_template" id="page_template">
		<option value="default">Default Template</option>
		<?php
        $templates = wp_get_theme()->get_page_templates();
        foreach ($templates as $template_name => $template_filename)
        {
            $_chk = '';
            if ($current_template == $template_name) $_chk = 'selected';
            ?><option value="<?php echo $template_name ?>" <?php echo $_chk ?>><?php echo $template_filename; ?></option>';<?php
        }
        ?>
	</select>

    <p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="menu_order">Order</label></p>
    <input name="menu_order" type="text" size="4" id="menu_order" value="<?php echo $post_id->menu_order ?>">
    <p>Need help? Use the Help tab above the screen title.</p>

    <?php
}

function loadchild($parentid, $_level, $_curval, $_mypage)
{
    $args = array(
        'sort_order' => 'asc',
        'sort_column' => 'post_title',
        'hierarchical' => 1,
        'parent' => $parentid,
        'offset' => 0,
        'post_type' => 'page',
        'post_status' => 'publish'
    );
    $pages = get_pages($args);
    if (empty($pages)) return;
    if ($_level == 0){
        echo '<ul class="children level-' . $_level . '-children">';
        if ($parentid == 0){ ?>
            <li>
            <label class="wp-nn-tag-p <?php echo $_state ?>" data-search-term="(no parent)">
            <input name="wp-nn-parentpage-rad" title="(no parent)" type="radio" value="0" checked />(no parent)
			<span class="fa fa-check"></span>
            </label>
            </li> <?php
        }
    }else{
        echo '<ul class="children level-' . $_level . '-children" style="padding-left:10px">';
    }

    foreach ($pages as $page)
    {
        if ($page->ID != $_mypage)
        {
            $_state = '';
            if ($page->ID == $_curval) $_state = "checked";
            echo '<li>';
            $_ptitle = $page->post_title;
            if ($page->post_title == '') $_ptitle = "#" . $page->ID . ' (no title)';

            echo '<label class="wp-nn-tag-p ' . $_state . '" data-search-term="' . strtolower($_ptitle) . '">';
            echo '<input name="wp-nn-parentpage-rad" title="' . $_ptitle . '" type="radio" value="'.$page->ID.'"' . $_state . '/>' . $_ptitle;
			echo '<span class="fa fa-check"></span>';
            echo '</label>';
            loadchild($page->ID, (int)$_level + 1, $_curval, $_mypage);
            echo '</li>';
        }
    }
    echo '</ul>';
}

function wp_nn_parentpage_modal()
{
    $screen = get_current_screen();
    if ($screen->id == 'page'){
	?>
		<div class="wp-nn-parentpage-overlay animated" style="visibility:hidden;">
			<div class="wp-nn-parentpage-table">
				<div class="wp-nn-parentpage-cell">
					<div class="wp-nn-parentpage-content">
                    	<h1>Parent</h1>
                    	<div class="wp-nn-parentpage-search">
                        	<span class="fa fa-search"></span>
                        	<input placeholder="Search page here." name="wp-nn-parentpage-criteria" type="text" />
                        </div>
                        <div class="wp-nn-parentpage-search-result">
						<?php global $post; ?>
                        <?php loadchild(0, 0, $post->post_parent, $post->ID); ?>
                        </div>
                        <div class="wp-nn-parentpage-nav-wrapper">
                        	<input type="hidden" name="wp-nn-parentpage-prev-selected" value='<?php echo $post->post_parent; ?>'/>
                        	<a href="#" class="wp-nn-parentpage-select">Select</a>
                        </div>
                        <div class="wp-nn-parentpage-search-close">
                        	<span class="fa fa-times"></span>
                        </div>
					</div>
				</div>
			</div>
		</div>
        <?php
    }
}
add_action('admin_footer', 'wp_nn_parentpage_modal');
?>
