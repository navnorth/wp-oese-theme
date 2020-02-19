<?php 
oese_perfrep_create_db();
//oese_perfrep_delete_db();
function oese_perfrep_create_db(){
  global $wpdb;
  $charset_collate = $wpdb->get_charset_collate();
  //Create table if it doesn't exist
  if ( $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", 'oese_performance_report' ) ) != 'oese_performance_report' ) {
    //** CREATE THE TABLE **//
		$sql[] = "CREATE TABLE `oese_performance_report` (
		  `ID` int(11) NOT NULL AUTO_INCREMENT,
		  `state` varchar(255) DEFAULT NULL,
      `year` varchar(16) DEFAULT NULL,
		  `program` longtext DEFAULT NULL,
      `report` longtext DEFAULT NULL,
      `type` varchar(16) DEFAULT NULL,
		  PRIMARY KEY (`ID`)
		) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  	dbDelta($sql);  
    //** INSERT RECORD TO DB **/
    $myquery = $wpdb->get_results("SELECT COUNT(*) as cnt FROM oese_performance_report ".$_crit); 
    $cnt = $myquery[0]->cnt;
    echo $cnt;
    if($cnt < 1){
      if ( $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", 'oese_performance_report' ) ) == 'oese_performance_report' ) {    
        $_sql = "INSERT INTO oese_performance_report (`state`,`year`,`program`,`report`,`type`) VALUES";
        $tmp = '';
        $csvFile = file(get_stylesheet_directory() . '/modules/performance-report/state-performance-table-for-upload.csv');
        foreach ($csvFile as $line) {
            $_line = str_getcsv($line);
            if($tmp == ''){
              $tmp = "('".$_line[0]."','".$_line[1]."','".$_line[2]."','".$_line[3]."','".$_line[4]."')";
            }else{
              $tmp .= ",('".$_line[0]."','".$_line[1]."','".$_line[2]."','".$_line[3]."','".$_line[4]."')";
            }  
        }         
        $_sql .= $tmp;                    
        $wpdb->query($_sql);
      }     
    }	
	}
}
function oese_perfrep_enqueue_script()
{
  wp_enqueue_style( 'oese-perfrep-style',get_stylesheet_directory_uri() . '/modules/performance-report/css/perfrep-style.css' );
  wp_enqueue_script( 'oese-performance-report-script', get_template_directory_uri() . '/modules/performance-report/js/performance_report_script.js', array( 'jquery' ), '20200216', true );
  wp_localize_script( 'oese-performance-report-script', 'perfrep_ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'oese_perfrep_enqueue_script' );
function oese_perfrep_delete_db() {
  global $wpdb;
  $table_name = 'oese_performance_report';
  $sql = "DROP TABLE IF EXISTS oese_performance_report";
	$wpdb->query($sql);
	flush_rewrite_rules();
}
add_shortcode('oese_perfrep_table', 'oese_perfrep_table_func');
function oese_perfrep_table_func($atts, $content = null){
	if (is_array($atts)) extract($atts);
  ?>
  <h2 class="wpdt-c" id="wdt-table-title-10">Performance Reports</h2>
  <div id="oese-perfrep-wrapper">
    <div id="oese-perfrep-filter-wrapper">
      <div class="col-xs-12 col-sm-6 col-lg-6 col-md-6 oese-perfrep-showentries">
        <label>Show:&nbsp;<select class="oese-perfrep-showentries-select">
          <option value="1">1</option>
          <option value="5">5</option>
          <option value="10" selected>10</option>
          <option value="25">25</option>
          <option value="50">50</option>
          <option value="100">100</option>
          <option value="-1">All</option>
        </select>&nbsp;entries</label>
      </div>
      <div class="col-xs-12 col-sm-6 col-lg-6 col-md-6 oese-perfrep-search">
        <label>Search: <input type="search" class="form-control" placeholder="" aria-controls="table_1"></label>
      </div>
    </div>
    <div id="oese-perfrep-content" class="col-md-12">
      <div class="oese-perfrep-content-block">
      <?php if(isset($state)){ 
        echo getTable($state); 
      }else{
        echo getTable();
      } ?>
      </div>
      <div class='oese-perfrep-preloader' style="display:none;"><img src="<?php echo get_stylesheet_directory_uri() . '/modules/performance-report/img/preloader-v2.gif' ?>" alt="preloader-image" /></div>
    </div>  
  </div>
  <?php
	return $return;
}
function getTable($fixstate=''){
  global $wpdb;
  $_nums = 3;  // left and right of the current page
  if($fixstate!=''){
    if(isset($_POST['crit'])){
      $_crit .= " WHERE (state = '".$fixstate."') AND ";
      $_crit .= "(";
      $_crit .= "year LIKE '%".$_POST['crit']."%' OR ";
      $_crit .= "program LIKE '%".$_POST['crit']."%' OR ";
      $_crit .= "type LIKE '%".$_POST['crit']."%'";
      $_crit .= ") ";
    }else{
      $_crit .= " WHERE (state = '".$fixstate."')";
    }
  }else{
    if(isset($_POST['crit'])){
      $_crit .= " WHERE (";
      $_crit .= "state LIKE '%".$_POST['crit']."%' OR ";
      $_crit .= "year LIKE '%".$_POST['crit']."%' OR ";
      $_crit .= "program LIKE '%".$_POST['crit']."%' OR ";
      $_crit .= "type LIKE '%".$_POST['crit']."%'";
      $_crit .= ") ";
    }else{
      $_crit = '';
    }
  }
  if(isset($_POST['col']) && isset($_POST['dir'])){
    //echo 'WOW: '.$_POST['col'].'--'.$_POST['dir'];
    $_sort = 'ORDER BY '.$_POST['col'].' '.$_POST['dir'];
  }else{
    $_sort = 'ORDER BY state ASC';
  }
  
  $myquery = $wpdb->get_results("SELECT COUNT(*) as cnt FROM oese_performance_report ".$_crit); 
 
  if(isset($_POST['ent'])){
    if($_POST['ent']>0){
      $_perpage = $_POST['ent'];
      $_maxpage = $myquery[0]->cnt/$_perpage;
    }else{
      $_perpage = $myquery[0]->cnt;   
      $_maxpage = 1;
    }
  }else{
    $_perpage = 10;
    $_maxpage = $myquery[0]->cnt/$_perpage;
  }
  $_page = isset($_POST['page'])? $_POST['page']: 0;
  
  $_maxpage = ($_maxpage > floor($_maxpage))? floor($_maxpage): floor($_maxpage)-1;
  //echo $_maxpage. $_sort; 
  $result = $wpdb->get_results ( "SELECT * FROM oese_performance_report ".$_crit." ".$_sort." LIMIT ".$_page * $_perpage.", ".$_perpage );
  ob_start( );
  
  $existing_columns = $wpdb->get_col("DESC oese_performance_report", 0);
  $colnames=[];
  foreach($existing_columns as $val){
    if($val != 'ID' && $val != 'report'){    
      $colnames[$val] = ucfirst($val);
    }
  }
  $n_state = (isset($fixstate))? 'stt="'.$fixstate.'"':'';
  ?>
  <table id="oese-perfrep-table" <?php echo $n_state ?>>
    <tr>    
      <?php 
      foreach($colnames as $key => $val){
        $_th_class = ((isset($_POST['col']) && $_POST['col']==$key)? (($_POST['dir']=='asc')? 'headerSortAsc': 'headerSortDesc'): 'headerSortAsc');
        ?><th><a href="#" class="<?php echo $_th_class ?>" col="<?php echo $key ?>"><?php echo strtoupper($key); ?></a></th><?php
      }
      ?>  
    </tr>
  <?php
    if($myquery[0]->cnt > 0){
      foreach ( $result as $item ){
        ?>
          <tr>
            <?php $n_item = (array)$item; ?>
            <?php 
            foreach($colnames as $key => $val){
              if($key!='type'){
                ?><td><?php echo $n_item[$key] ?></td><?php
              }else{
                ?><td><a href="<?php echo $n_item['report'] ?>" target="_blank"><?php echo $n_item[$key] ?></a></td><?php
              }        
            }
            ?>
          </tr>
        <?php
      }
    }else{
      ?>
        <tr>
        <td colspan="<?php echo count($colnames) ?>" style="text-align:center;">No matching records found</td>
        </tr>
      <?php
    }
  ?>
  </table>
  <div class="oese-perfrep-nav-wrapper">
    <table id="oese-perfrep-nav">
      <tr>
        <td>
          <?php if($myquery[0]->cnt > $_perpage){ ?>
            <?php if($_page <= 0){ ?>
                <div class="oese_perfrep_nav_button off"><img src="<?php echo get_stylesheet_directory_uri().'/modules/performance-report/img/chevron-double-left.png' ?>" alt="first page" /></div>
                <div class="oese_perfrep_nav_button off"><img src="<?php echo get_stylesheet_directory_uri().'/modules/performance-report/img/chevron-single-left.png' ?>" alt="previous page" /></div>
            <?php }else{ ?>
                <a href="#" pg="0" class="oese_perfrep_nav_button"><img src="<?php echo get_stylesheet_directory_uri().'/modules/performance-report/img/chevron-double-left.png' ?>" alt="first page" /></a>
                <a href="#" pg="<?php echo $_page - 1 ?>" class="oese_perfrep_nav_button"><img src="<?php echo get_stylesheet_directory_uri().'/modules/performance-report/img/chevron-single-left.png' ?>" alt="previous page" /></a>
            <?php } ?>
            
            <?php
            $arr = array();
            if(($_maxpage) >= (($_nums*2) + 1)){          
              if($_page < ($_nums + 1)){
                for ($x = 0; $x <= (($_nums*2)); $x++) {array_push($arr, $x);}
              }else{
                if($_page <= ($_maxpage) - $_nums){
                  for ($x = $_page - $_nums; $x <= $_page + $_nums; $x++) {array_push($arr, $x);}
                }else{
                  for ($x = ($_maxpage) - ($_nums*2); $x <= $_maxpage; $x++) {array_push($arr, $x);}
                }      
              }
            }else{
              for ($x = 0; $x <= $_maxpage; $x++) {array_push($arr, $x);}
            }
            foreach ($arr as $val) {
              $sel = ($_page == $val)? ' selected': '';
              ?>
              <a href="#" pg="<?php echo $val ?>" class="oese_perfrep_nav_button midnum<?php echo $sel ?>"><?php echo $val+1 ?></i></a>
              <?php
            }
            ?>    
            <?php if($_page >= $_maxpage){ ?>
                <div class="oese_perfrep_nav_button off"><img src="<?php echo get_stylesheet_directory_uri().'/modules/performance-report/img/chevron-single-right.png' ?>" alt="next page" /></div>
                <div class="oese_perfrep_nav_button off"><img src="<?php echo get_stylesheet_directory_uri().'/modules/performance-report/img/chevron-double-right.png' ?>" alt="last page" /></div>
            <?php }else{ ?>
                <a href="#" pg="<?php echo $_page + 1 ?>" class="oese_perfrep_nav_button"><img src="<?php echo get_stylesheet_directory_uri().'/modules/performance-report/img/chevron-single-right.png' ?>" alt="next page" /></a>
                <a href="#" pg="<?php echo $_maxpage ?>" class="oese_perfrep_nav_button"><img src="<?php echo get_stylesheet_directory_uri().'/modules/performance-report/img/chevron-double-right.png' ?>" alt="last page" /></a>    
            <?php } ?>
          <?php } ?>
          </td>
      </tr>
    </table>
  </div>
  <?php
  $output = ob_get_clean( );
  return $output;
}
function retrieveperfrep(){
  if(isset($_POST['stt'])){
    echo getTable($_POST['stt']);
  }else{
    echo getTable();
  }
	die();
}
add_action( 'wp_ajax_retrieveperfrep', 'retrieveperfrep',100 );
add_action('wp_ajax_nopriv_retrieveperfrep', 'retrieveperfrep',100);
?>