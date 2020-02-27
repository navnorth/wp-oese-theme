<?php 
function oese_perftable_enqueue_script(){
  wp_enqueue_script( 'oese-performance-table-script', get_template_directory_uri() . '/modules/performance-table/js/jquery.dynatable.js', array( 'jquery' ), '20200216', true );
  wp_enqueue_style( 'oese-jquery.dynatable.css',get_stylesheet_directory_uri() . '/modules/performance-table/css/jquery.dynatable.css' );
}
add_action( 'wp_enqueue_scripts', 'oese_perftable_enqueue_script' );

add_action( 'wp_footer', 'oese_performance_table_func' );
function oese_performance_table_func(){ ?>
  <script>
  jQuery(document).ready(function() {
     jQuery('#oese_performance_table').dynatable();
  } );
  </script>
  <?php
}

add_action( 'wp_head', 'oese_performance_table_load_base_url_js_func' );
function oese_performance_table_load_base_url_js_func(){ ?>
  <script type="text/javascript">
  var templateUrl = '<?php echo get_template_directory_uri(); ?>';
  </script>
  <?php
}



?>
