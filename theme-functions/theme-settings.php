<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $message, $type;

if (!current_user_can('edit_theme_options')) {
    wp_die( "You don't have permission to access this page!" );
}

?>
<div class="wrap">
    <h1>Theme Options</h1>
    <form id="wp-oese-theme-settings" method="post" action="options.php">
	<?php settings_errors(); ?>
        <?php settings_fields("theme_settings_page"); ?>
        <div class="row">
            <fieldset>
                <legend><h3><?php _e('Modal', WP_OESE_THEME_SLUG); ?></h3></legend>
		<?php
		    do_settings_fields("theme_settings_page", "wp_oese_theme_settings");
		    submit_button();
		?>
            </fieldset>
        </div>
    </form>
</div>
<div class="admin-theme-footer">
	<div class="admin-theme-info"><?php echo WP_OESE_THEME_NAME . " " . WP_OESE_THEME_VERSION .""; ?></div>
	<div class="clear"></div>
</div>