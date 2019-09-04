<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $message, $type;

if (!current_user_can('edit_theme_options')) {
    wp_die( "You don't have permission to access this page!" );
}
if (isset($_GET['oii_update']) && $_GET['oii_update']=="true"){
    // Update oii page with parent id 3613 and oii category
    update_oii_page_parent(3613, "oii");
} elseif (isset($_GET['oii_migrate']) && $_GET['oii_migrate']=="true"){
    if (!isset($_GET['post_from']) && !isset($_GET['post_to']))
	replace_page_old_urls();
    else
	replace_page_old_urls($_GET['post_from'],$_GET['post_to']);
} elseif (isset($_GET['page_empty']) && $_GET['page_empty']=="true"){
    if (!isset($_GET['post_from']) && !isset($_GET['post_to']))
	update_empty_page_to_draft();
    else
	update_empty_page_to_draft($_GET['post_from'],$_GET['post_to']);
} else {
?>
<div class="wrap">
    <h1>Theme Options</h1>
    <form id="wp-oese-theme-settings" method="post" action="options.php">
	<?php settings_errors(); ?>
        <?php settings_fields("theme_settings_page"); ?>
        <div class="row">
	    <fieldset>
		<legend><h3><?php _e('Google Analytics', WP_OESE_THEME_SLUG); ?></h3></legend>
		<?php do_settings_fields("theme_settings_page", "wp_oese_ga_settings"); ?>
	    </fieldset>
            <fieldset>
                <legend><h3><?php _e('Modal', WP_OESE_THEME_SLUG); ?></h3></legend>
		<?php do_settings_fields("theme_settings_page", "wp_oese_theme_settings"); ?>
            </fieldset>
	    <fieldset>
                <legend><h3><?php _e('PDF Embed', WP_OESE_THEME_SLUG); ?></h3></legend>
		<?php do_settings_fields("theme_settings_page", "wp_oese_pdf_settings"); ?>
            </fieldset>
	    <?php submit_button(); ?>
        </div>
    </form>
</div>
<div class="admin-theme-footer">
	<div class="admin-theme-info"><?php echo WP_OESE_THEME_NAME . " " . WP_OESE_THEME_VERSION .""; ?></div>
	<div class="clear"></div>
</div>
<?php } ?>