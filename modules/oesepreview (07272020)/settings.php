<?php

namespace OESE_Preview;

require_once 'addon.php';

add_action('init', __NAMESPACE__.'\\settings_init');

if (is_admin() || is_cron()) {
  add_action('init', __NAMESPACE__.'\\check_for_addon_updates');
  add_action('admin_menu', __NAMESPACE__.'\\settings_menu');
  add_action('admin_init', __NAMESPACE__.'\\settings_admin_init');
  add_action('network_admin_menu', __NAMESPACE__.'\\network_settings_menu');
  add_action('network_admin_edit_oesepreview_network_settings', __NAMESPACE__.'\\network_update_settings');
  add_filter('plugin_action_links_'.OESEPREVIEW_BASE, __NAMESPACE__.'\\settings_link');
  add_filter('network_admin_plugin_action_links_'.OESEPREVIEW_BASE, __NAMESPACE__.'\\network_settings_link');
  add_filter('oesepreview_keep_original_on_publish', __NAMESPACE__.'\\filter_keep_backup');
  add_filter('oesepreview_preserve_post_date', __NAMESPACE__.'\\filter_preserve_date');
  add_filter('oesepreview_preserve_author', __NAMESPACE__.'\\filter_preserve_author');
}

function settings_init() {
  if (is_admin() || is_cron() || is_admin_bar_showing()) {
    //load_addons();
  }
}

function settings_admin_init() {
  if (is_on_settings_page()) {
    set_setting('has_seen_settings', true);
  } else if (get_setting('has_seen_settings', false) === false) {
    add_action('admin_notices', __NAMESPACE__.'\\notify_new_settings');
  }

  if (is_on_network_settings_page() && isset($_GET['updated'])) {
    add_action('network_admin_notices', __NAMESPACE__.'\\notify_updated_settings');
  }
}

function settings_menu() {
  add_submenu_page (
    'options-general.php',
    __('Preview Settings', 'oesepreview'),
    __('Preview', 'oesepreview'),
    'manage_options',
    'oesepreview',
    __NAMESPACE__.'\\settings_page'
  );

  register_setting('oesepreview', 'oesepreview_settings', array(
    "sanitize_callback" => __NAMESPACE__.'\\on_settings_saved'
  ));

  setup_basic_settings();

  if (!is_multisite()) {
    setup_addon_settings();  
  }
}

function network_settings_menu() {
  add_submenu_page (
    'settings.php',
    __('Preview Network Settings', 'oesepreview'),
    __('Preview', 'oesepreview'),
    'manage_network_options',
    'oesepreview',
    __NAMESPACE__.'\\network_settings_page'
  );  

  register_setting('oesepreview_network', 'oesepreview_network_settings', array(
    "sanitize_callback" => __NAMESPACE__.'\\on_settings_saved'
  ));

  setup_addon_settings('oesepreview_network');
}

function network_update_settings() {
  check_admin_referer('oesepreview_network-options');

  // save files. 
  on_settings_saved();

    if (isset($_POST['oesepreview_network_settings'])) {
    update_site_option('oesepreview_network_settings', $_POST['oesepreview_network_settings']);  
  }

  // need to schedule  an admin notice. 

  wp_redirect(add_query_arg(array('page'=>'oesepreview', 'updated'=>'true'), network_admin_url('settings.php')));
  exit;
}

function settings_page() {
  if (!current_user_can('manage_options')) {
    echo __('Not Allowed.', 'oesepreview');
    return;
  }
  ?>
  <div class="wrap">
    <?php settings_css(); ?>
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form action="options.php" enctype="multipart/form-data" method="post" class="rvz-settings-form">
    <?php
      settings_fields('oesepreview');
  
      do_fields_section('oesepreview_section_basic');

      // settings from Addons
      do_action('oesepreview_settings_fields');

      do_fields_section('oesepreview_section_addons');

      submit_button(save_settings_button_label());

      if (!is_multisite()) {
        addons_html();

        submit_button(save_settings_button_label());
      }
    ?>
    </form>
  </div>
  <?php 
}

function network_settings_page() {
  if (!current_user_can('manage_network_options')) {
    echo __('Not Allowed.', 'oesepreview');
    return;
  }
  ?>
  <div class="wrap">
    <?php settings_css(); ?>
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <p>Note that site specific settings for Preview can be found when viewing a site. Such as <a href="<?php echo admin_url('options-general.php?page=oesepreview')?>">here</a>.</p>

    <form action="edit.php?action=oesepreview_network_settings" enctype="multipart/form-data" method="post" class="rvz-settings-form">
    <?php
      settings_fields('oesepreview_network');
  
      do_fields_section('oesepreview_section_addons', 'oesepreview_network');

      submit_button(save_settings_button_label());

      addons_html();

      submit_button(save_settings_button_label());
    ?>
    </form>
  </div>
  <?php   
}

function do_fields_section($key, $group="oesepreview") {  
  echo '<table class="form-table">';
  do_settings_fields($group, $key);
  echo '</table>';
}

function setup_basic_settings() {
  add_settings_section('oesepreview_section_basic', '', '__return_null', 'oesepreview');  

  input_setting('checkbox', __('Keep Backup', 'oesepreview'), 'keep_backup', __("After publishing the revision, the previously live post will be kept around and marked as a backup revision of the new version.", 'oesepreview'), true, 'oesepreview_section_basic');

  input_setting('checkbox', __('Preserve Date', 'oesepreview'), 'preserve_date', __("The date of the original post will be maintained even if the revised post date changes. In particular, a scheduled revision won't modify the post date once it's published.", 'oesepreview'), true, 'oesepreview_section_basic');

  input_setting('checkbox', __('Preserve Author', 'oesepreview'), 'preserve_author', __("The author of the original post will be maintained even if the author of the revised post differs.", 'oesepreview'), true, 'oesepreview_section_basic');  
}

function setup_addon_settings($group="oesepreview") {
  add_settings_section('oesepreview_section_addons', '', '__return_null', $group);

  // These fields are displayed
  add_settings_field('oesepreview_addon_file', __('Upload Addon', 'oesepreview'), __NAMESPACE__.'\\settings_addon_file_html', $group, 'oesepreview_section_addons', array('label_for' => 'oesepreview_addon_file'));  
}

function settings_addon_file_html($args) {
  $id = esc_attr($args['label_for']);
  ?>
  <div>
    <input id="<?php echo $id?>" type="file" name="oesepreview_addon_file" style="width:320px" accept=".rvz"/> 
    <p>To install or update an addon, choose a <em>.rvz</em> file and click <em><?php echo save_settings_button_label()?></em></p>
  </div>  
  <?php  
}

function addons_html() {
  $hasUpdates = false;
  ?>
  <h1><?php _e('Preview Addons', 'oesepreview')?></h1>
  <p>Improve the free Preview plugin with these official addons.<br/>Visit <a href="https://oesepreview.pro" target="_blank">oesepreview.pro</a> for more info.</p>
  <div class="rvz-addons rvz-cf">
    <?php foreach (get_available_addons() as $addon) {
      addon_html($addon); 
      $hasUpdates = $hasUpdates || $addon["update_available"];
    }?>
  </div>
  <?php if ($hasUpdates): ?>
  <p>* To install an addon update, visit <a href="https://oesepreview.pro/account/" target="_blank">https://oesepreview.pro/account/</a> to login to your account.
    <br/>Find the relevant purchase confirmation and download the updated <em>.rvz</em> file. 
    <br/>Come back here and upload the addon.</p>
  <?php
  endif;
}

function addon_html($addon) {
  $id = $addon['id'];
  $active = "addon_${id}_active";
  $remove = "addon_${id}_delete";
  $active_checked = is_addon_active($id) ? 'checked' : '';
  $group = is_multisite() ? "oesepreview_network_settings" : "oesepreview_settings";
  ?>
  <div class="rvz-addon-col">
    <div class="rvz-addon<?php if ($addon['installed']) echo " rvz-installed" ?>">
      <h3><a href="<?php echo $addon['url']?>" target="_blank"><?php echo $addon['name'];?></a></h3>
      <?php echo $addon['description']; ?>
      <div class="rvz-meta rvz-cf">
      <?php if ($addon['installed']): ?>
        <label><?php _e('Installed', 'oesepreview')?>: <?php echo $addon['installed']?></label>
        <label>
          <input type="hidden" name="<?php echo $group?>[_<?php echo $active?>_set]" value="1"/>
          <input type="checkbox" name="<?php echo $group?>[<?php echo $active?>]" <?php echo $active_checked?> /> <?php _e('Active', 'oesepreview')?>
        </label>
        <label>
          <input type="hidden" name="<?php echo $group?>[_<?php echo $remove?>_set]" value="1"/>
          <input type="checkbox" name="<?php echo $group?>[<?php echo $remove?>]" /> <?php _e('Delete', 'oesepreview')?>
        </label>
        <?php if ($addon["update_available"]): ?>
        <div class="rvz-update-available rvz-cf">
          <a class="rvz-button button" href="https://oesepreview.pro/account/" target="_blank"><?php _e('Update Available', 'oesepreview')?>: <?php echo $addon['version']?></a>    
        </div>
        <?php endif; ?>
      <?php else: ?>
        <a class="rvz-button button" href="<?php echo $addon['url']?>" target="_blank"><?php echo $addon['price']?> - <?php echo $addon['button']?></a>
      <?php endif; ?>
      </div>
    </div>
  </div>
  <?php
}

// access settings
function get_setting($key, $default='', $multisite=false) {
  $settings = $multisite ? get_site_option('oesepreview_network_settings') : get_option('oesepreview_settings');  
  return !empty($settings[$key]) ? $settings[$key] : $default;
}

function set_setting($key, $value) {
  $settings = get_option('oesepreview_settings');  
  $settings[$key] = $value;
  update_option('oesepreview_settings', $settings);  
}

function remove_setting($keys, $multisite=false) {
  $settings = $multisite ? get_site_option('oesepreview_network_settings') : get_option('oesepreview_settings');    
  if (!is_array($keys)) {
    $keys = array($keys);
  }
  foreach ($keys as $key) {
    unset($settings[$key]);
  }
  if ($multisite) {
    update_site_option('oesepreview_network_settings', $settings);
  } else {
    update_option('oesepreview_settings', $settings);    
  }
}

function is_on_settings_page() {
  global $pagenow;
  return $pagenow == 'options-general.php' && isset($_GET['page']) && $_GET['page'] == 'oesepreview';
}

function is_on_network_settings_page() {
  global $pagenow;
  return $pagenow == 'settings.php' && isset($_GET['page']) && $_GET['page'] == 'oesepreview';
}

function on_settings_saved($settings=null) {
  if (current_user_can('install_plugins') && !empty($_FILES['oesepreview_addon_file']['tmp_name'])) {
    install_addon($_FILES['oesepreview_addon_file']['tmp_name']);
  }
  return $settings;
}

function install_addon($filename) {
  // make sure the directory exists
  $target_path = get_addons_root();
  wp_mkdir_p($target_path);

  $data = file_get_contents($filename);
  $data = json_decode(base64_decode($data), true);

  // TODO: check to see if addon already installed and if this version is newer. Maybe send warning if not (downgrading)
  file_put_contents($target_path.'/'.$data['name'].'.php', base64_decode($data['code']));

  $installed = get_installed_addons();
  $installed[] = $data['name'];
  set_installed_addons($installed);
}

function uninstall_addon($id, $file) {
  remove_setting(array(
    "addon_${id}_active",
    "addon_${id}_delete",
    "_addon_${id}_active_set",
    "_addon_${id}_delete_set",
  ), is_multisite());
  
  unlink($file);

  $installed = get_installed_addons();
  if (($key = array_search($id, $installed)) !== false) {
    array_splice($installed, $key, 1);
  }
  set_installed_addons($installed);
}

function get_available_addons() {
  $registered = apply_filters('oesepreview_registered_addons', array());
  $addons = get_transient('oesepreview_available_addons');

  if ($addons === false) {
    $response = wp_remote_get("https://oesepreview.pro/rvz-addons/");
    $json = is_array($response) && !empty($response['body']) ? $response['body'] : '';
    $payload = !empty($json) ? json_decode($json, true) : array();
    $addons = !empty($payload['addons']) ? $payload['addons'] : array();

    if (remote_addons_valid($addons)) {
      set_transient('oesepreview_available_addons', $addons, 6 * 60 * 60); // cache for 6 hours
    } else {
      // for some reason our addons list is empty. cache this for a shorter time so site perfomance
      // isn't impacted by repeated network calls.
      set_transient('oesepreview_available_addons', $addons, 5 * 60); // cache for 5 minutes
    }
  }

  // failsafe - really make sure we have valid addons
  if (empty($addons) || !is_array($addons) || !remote_addons_valid($addons)) {
    $addons = array();
  }

  foreach ($addons as &$addon) {
    $addon["installed"] = array_key_exists($addon["id"], $registered) ? $registered[$addon["id"]] : false;
    $addon["update_available"] = $addon["installed"] && version_compare($addon["version"], $addon["installed"]) > 0;
  } 

  return $addons;
}

function remote_addons_valid($addons) {
  return !empty($addons) && count($addons) > 0 && all_keys_set($addons, "id") && all_keys_set($addons, "version");
}

function all_keys_set($arr, $key) {
  $s = implode('', array_map(function($obj) use ($key) { return empty($obj[$key]) ? "" : $obj[$key]; }, $arr));
  return !empty($s);
}

function check_for_addon_updates() {
  $addons = get_available_addons();

  foreach ($addons as $addon) {
    if ($addon["update_available"]) {
      add_action(is_multisite() ? 'network_admin_notices' : 'admin_notices', __NAMESPACE__.'\\notify_needs_update');
    }
  }
}

function get_installed_addons() {
  $addons = is_multisite() ? get_site_option('oesepreview_installed_addons', array()) : get_option('oesepreview_installed_addons', array());
  return $addons ? $addons : array();
}

function get_addons_root() {
  // version 2.2.3 - move the addons_root to a safe directory
  $uploads = wp_upload_dir();
  $path = $uploads['basedir'];

  if (is_multisite() && !is_network_admin()) {
    // when network admin we get back /wp-content/uploads/
    // when in a Site we get back /wp-content/uploads/sites/site-ID
    $path = str_replace('/sites/'.get_current_blog_id(), '', $path);
  }
  return apply_filters('oesepreview_addons_root', $path.'/oesepreview/addons');
}

function set_installed_addons($installed) {
  if (is_multisite()) {
    update_site_option('oesepreview_installed_addons', array_unique($installed));  
  } else {
    update_option('oesepreview_installed_addons', array_unique($installed));
  }
}

function load_addons() {
  $addons = get_installed_addons();
  foreach ($addons as $id) {
    $file = get_addons_root().'/'.$id.'.php';

    if (file_exists($file)) {
      if (is_addon_pending_delete($id)) {
        uninstall_addon($id, $file);
      } else {
        require_once $file;
        \PreviewAddon::create($id);        
      }
    } else {
      // system thinks addon is installed, but the file doesn't exist. Probably because it got wiped during a core plugin update. 
      // v2.2.3 changes the addons_root directory to wp-content/uploads/oesepreview/addons
      add_action(is_multisite() ? 'network_admin_notices' : 'admin_notices', __NAMESPACE__.'\\notify_fix_addons');
    }
  }

  do_action('oesepreview_addons_loaded');
}

function is_addon_active($id) {
  return is_checkbox_checked('addon_'.$id.'_active', true, is_multisite());
}

function is_addon_pending_delete($id) {
  return is_checkbox_checked('addon_'.$id.'_delete', false, is_multisite());  
}

function filter_keep_backup($b) {
  return is_checkbox_checked('keep_backup', $b);
}

function filter_preserve_date($b) {
  return is_checkbox_checked('preserve_date', $b);
}

function filter_preserve_author($b) {
  return is_checkbox_checked('preserve_author', $b);  
}

// basic inputs for now
// $type: text|email|number|checkbox
function input_setting($type, $name, $key, $description, $default, $section) {
  add_settings_field('oesepreview_setting_'.$key, $name, __NAMESPACE__.'\\field_input', 'oesepreview', $section, array(
    'type' => $type,
    'label_for' => 'oesepreview_setting_'.$key,
    'key' => $key,
    'description' => $description,
    'default' => $default
  ));
}

function field_input($args) {
  $type = $args['type'];
  $id = esc_attr($args['label_for']);
  $key = esc_attr($args['key']);
  $value = '';

  if ($type == 'checkbox') {
    if (is_checkbox_checked($key, $args['default'])) {
      $value = 'checked';
    }
  } else {
    $value = 'value="'.get_setting($key, $args['default']).'"';
  }
  ?>
  <div>
    <?php if ($type=="checkbox"): ?>
    <input type="hidden" name="oesepreview_settings[_<?php echo $key?>_set]" value="1"/>
    <?php endif; ?>
    <label>
      <input id="<?php echo $id?>" type="<?php echo $type?>" name="oesepreview_settings[<?php echo $key?>]" <?php echo $value?>/> 
      <?php echo $args['description']?>
    </label>
  </div>  
  <?php  
}

function is_checkbox_checked($key, $default, $multisite=false) {
  return is_checkbox_set($key, $multisite) ? is_checkbox_on($key, $multisite) : $default;
}

function is_checkbox_on($key, $multisite=false) {
  return get_setting($key, '', $multisite) == "on";    
}

function is_checkbox_set($key, $multisite=false) {
  return get_setting('_'.$key.'_set', '', $multisite) == "1";    
}

function notify_new_settings() {
  $notice = '<strong>Preview</strong> has a new settings panel. <strong><a href="'.admin_url('options-general.php?page=oesepreview').'">Check it out!</a></strong>';
  echo '<div class="notice notice-info is-dismissible"><p>'.$notice.'</p></div>';  
}

function notify_updated_settings() {
  echo '<div class="notice updated is-dismissible"><p><strong>Settings saved.</strong></p></div>';  
}

function notify_needs_update() {
  if (!is_on_settings_page() && !is_on_network_settings_page()) {
    $url = is_multisite() ? network_admin_url('settings.php?page=oesepreview') : admin_url('options-general.php?page=oesepreview');
    echo '<div class="notice updated is-dismissible"><p>Preview has 1 or more updates available for your installed addons. <a href="'.$url.'">View settings</a> for details.</p></div>';    
  }
}

function settings_css() {
  ?>
  <style type="text/css">
  .rvz-cf:after {
    content: "";
    display: table;
    clear: both;
  }
  .rvz-settings-form {
    margin-top: 15px;
  }
  .rvz-settings-form .form-table {
    margin-top: 0;
  }
  .rvz-settings-form .form-table th, .rvz-settings-form .form-table td {
    padding-top: 12px;
    padding-bottom: 12px;
  }
  .rvz-settings-form .form-table p {
    margin-top: 0;
  }
  .rvz-addons { margin-top: 30px; }
  .rvz-addons * { box-sizing: border-box; }
  .rvz-addon-col {
    float: left;
    width: 100%;
    padding: 0;
  }
  @media (min-width: 783px) {
    .rvz-addon-col {
      padding-right: 25px;
      width: 50%;
    }
  }
  @media (min-width: 1366px) {
    .rvz-addon-col {
      width: 33.3333%;
    }
  }
  @media (min-width: 1600px) {
    .rvz-addon-col {
      width: 25%;
    }
  }
  .rvz-addon {
    background-color: #e0e0e0;
    border-radius: 4px;
    padding: 15px 15px 55px;
    min-height: 300px;
    position: relative;
    margin-bottom: 20px;
  }
  .rvz-addon h3 {
    margin-top: 0;
    line-height: 30px;
    text-transform: uppercase;
    width: 100%;
  }
  .rvz-addon ul {
    list-style: disc;
    padding-bottom: 15px;
    padding-left: 25px;
  }
  .rvz-addon .rvz-meta {
    position: absolute;
    bottom: 0;
    left: 0;
    padding: 15px;
    width: 100%;
    text-align: right;
  }
  .rvz-addon .rvz-meta label {
    line-height: 22px;
    margin-left: 15px;
  }
  .rvz-addon .rvz-meta label:first-child {
    margin-left: 0;
    float: left;
  }
  .rvz-update-available {
    clear: both;
    margin-top: 8px;
    text-align: center;
  }
  </style>  
  <?php
}

function settings_link($links) {
  return array_merge($links, array('<a href="'.admin_url('options-general.php?page=oesepreview').'">Settings</a>'));
}

function network_settings_link($links) {
  return array_merge($links, array('<a href="'.network_admin_url('settings.php?page=oesepreview').'">Settings</a>'));
}

function notify_fix_addons() {
  echo '<div class="notice notice-error is-dismissible"><p>Please re-install your <a href="https://oesepreview.pro/account/" target="_blank">Preview addons</a>.<br/>There was a problem where updates to the core Preview plugin would inadvertantly delete your installed addons.<br/>This has been fixed in version 2.2.3. Sorry for the inconvenience!</p></div>';
}

function save_settings_button_label() {
  return __('Save Settings', 'oesepreview');
}