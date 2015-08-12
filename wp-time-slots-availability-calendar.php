<?php     
/* 
Plugin Name: WP Time Slots Availability Calendar
Plugin URI: http://www.wptimeslots.com
Description: WP Time Slots Availability Calendar - Free version
Version: 1.4
Author: WP Time Slots Availability Calendar
Author URI: http://www.wptimeslots.com
*/    

define("TSA_PATH",plugins_url('',__FILE__));
define("TSA_DIR_PATH",dirname(__FILE__));
include 'php/functions.php';

function tsa_textdomain(){    
    load_plugin_textdomain('tsa', false, dirname(plugin_basename(__FILE__)) . '/languages/');    
}
add_action('plugins_loaded', 'tsa_textdomain');

if (is_admin()) {

	add_action('admin_menu', 'tsa_menu');   

    function tsa_admin_styles() {
        wp_enqueue_style( 'tsa-admin', TSA_PATH . '/css/tsa-admin.css' );
        wp_enqueue_style( 'tsa', TSA_PATH . '/css/tsa.css' );
        wp_enqueue_script('tsa', TSA_PATH . '/js/tsa-admin.js',array('jquery'));
    }
    add_action( 'admin_init', 'tsa_admin_styles' );
       
} else {
    function tsa_styles() {
        wp_enqueue_style( 'tsa', TSA_PATH . '/css/tsa.css' );
        wp_enqueue_script('tsa', TSA_PATH . '/js/tsa.js',array('jquery'));
    }
    add_action( 'init', 'tsa_styles' );
    
    
    function pluginname_ajaxurl() {
    ?>
    <script type="text/javascript">var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';</script>
    <?php }
    add_action('wp_head','pluginname_ajaxurl');
 
}

function tsa_menu(){
    add_menu_page( 'WP Time Slots', __('WP Time Slots','tsa'), 'add_users', 'wp-time-slots', 'tsa_menu_calendar_list', '' , 105 );
    add_submenu_page( 'wp-time-slots', __('Calendars','tsa'), __('Calendars','tsa'), 'add_users', 'wp-time-slots', 'tsa_menu_calendar_list' ); 
    add_submenu_page( 'wp-time-slots', __('Add New','tsa'), __('Add New','tsa'), 'add_users', 'wp-time-slots-add-new', 'tsa_menu_add_calendar' );
    add_submenu_page( 'wp-time-slots', __('Settings','tsa'), __('Settings','tsa'), 'add_users', 'wp-time-slots-settings', 'tsa_menu_settings' );
}

function tsa_menu_calendar_list(){
    if(!empty($_GET['action']) && $_GET['action'] == 'save')
        include 'php/save-calendar.php';
    elseif(!empty($_GET['action']) && $_GET['action'] == 'delete'){
        include 'php/delete-calendar.php';
        include 'views/calendar-list.php';
    } elseif(!empty($_GET['id']) && $_GET['id'])
        include 'views/edit-calendar.php';
    else        
        include 'views/calendar-list.php';
}


function tsa_menu_add_calendar(){
    if(!empty($_GET['action']) && $_GET['action']=='add'){
        include 'php/add-calendar.php';
        
        if(!empty($status) && $status == 'OK')
            include 'views/edit-calendar.php';
        else
            include 'views/add-calendar.php';
    } else {
        include 'views/add-calendar.php';
    }
            
}


function tsa_menu_settings(){
    
    include 'views/calendar-settings.php';
    
}



function tsa_shortcode( $atts ) {
	extract( shortcode_atts( array(
		'id' => '',
		'legend' => 'no',
        'title' => 'no'
	), $atts ) );

    $daysToShow = 1;
    $calendarData = unserialize(get_option('tsa-calendar-data'));
    if(empty($calendarData[$id])):
        echo __("Wrong calendar ID",'tsa');
    else:    
        $calendarData = $calendarData[$id];
        $currentTimestamp = time();
        $currentDay = date('D d-m-y',$currentTimestamp);
        
    
        $tsaCalendarArray = $calendarData['calendarData'];  
        
        ob_start();
            include 'php/show-calendar.php';
        $content = ob_get_clean();  
        
    	return $content;
    endif;
}
add_shortcode( 'tsa', 'tsa_shortcode' );

function tsa_tokenGeneratorInit(){
    add_meta_box('tsa-metabox', __('Generate WP Time Slot Availability Calendar Token', 'tsa'), 'tsa_tokenGenerator', 'page', 'normal', 'high');
    add_meta_box('tsa-metabox', __('Generate WP Time Slot Availability Calendar Token', 'tsa'), 'tsa_tokenGenerator', 'post', 'normal', 'high');
    $customPostTypes = get_post_types( array('_builtin' => false) );
    foreach($customPostTypes as $customPostType):
        add_meta_box('tsa-metabox', __('Generate WP Time Slot Availability Calendar Token', 'tsa'), 'tsa_tokenGenerator', $customPostType, 'normal', 'high');
    endforeach;
}
add_action( 'admin_menu', 'tsa_tokenGeneratorInit' );

function tsa_tokenGenerator(){
    include 'views/token-generator.php';
}

include 'php/widget.php';

function tsa_widgetInit(){
    register_widget('tsa_widget');  
}
add_action( 'widgets_init', 'tsa_widgetInit' );


?>