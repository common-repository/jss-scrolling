<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       www.js-ss.co.uk
 * @since      1.0.0
 *
 * @package    Jss_Scrolling
 * @subpackage Jss_Scrolling/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Jss_Scrolling
 * @subpackage Jss_Scrolling/admin
 * @author     Nathanael Ainsworth <info@seeksupport.org>
 */
class Jss_Scrolling_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		add_action('admin_post_add_admin_post_scrolljss', array($this, 'add_admin_post_scrolljss')); 
		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles($hook) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Jss_Scrolling_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Jss_Scrolling_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
   if ( 'javascript-stylesheet_page_jss-scrolling_submenu2' == $hook ) {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/jss-scrolling-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'genericons', plugin_dir_url( __FILE__ ) . 'css/genericons/genericons.css' );
 }
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts($hook) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Jss_Scrolling_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Jss_Scrolling_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
   if ( 'javascript-stylesheet_page_jss-scrolling_submenu2' == $hook ) {
		wp_enqueue_script('jquery');                    // Enque jQuery
		wp_enqueue_script('jquery-ui-core');            // Enque jQuery UI Core
		wp_enqueue_script('jquery-ui-accordion'); 
		wp_enqueue_script('jquery-ui-tabs');            // Enque jQuery UI Tabs
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-ui-selectable'); 

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/jss-scrolling-admin.js', array( 'jquery' ), $this->version, false );
	}
	}
	public function add_plugin_admin_menu() {

	    /*
	     * Add a settings page for this plugin to the Settings menu.
	     *
	     * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
	     *
	     *        Administration Menus: http://codex.wordpress.org/Administration_Menus
	     *
	     */

		add_submenu_page( 'javascript-stylesheet' , 'JSS Scrolling', 'JSS Scrolling' , 'manage_options' , $this->plugin_name . '_submenu2' , array($this, 'js_ss_submenu_2'));

	}
 



   
	 /**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	 
	public function add_action_links( $links ) {
	    /*
	    *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
	    */
	   $settings_link = array(
	    '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
	   );
	   return array_merge(  $settings_link, $links );

	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	 

	public function js_ss_submenu_2() {
		include_once( 'partials/jss-scrolling-admin-display.php' );

	}	

	public function add_admin_post_scrolljss(){
echo "post successful";
          if (isset($_POST['add_admin_post_nonce'], $_POST['add_admin_post_scrolljss_submit']) && wp_verify_nonce($_POST['add_admin_post_nonce'], 'add_admin_post_scrolljss')) {
                //include_once('inc/backend/save-set.php');

// table Info / get current results from database
global $wpdb;		
$table_name = $wpdb->prefix . 'jsss_scrolling';
$result = $wpdb->get_results( "SELECT * FROM wp_jsss_scrolling"); 



if ($_POST['add_admin_post_scrolljss_submit'] == 'Save all changes') {
    // Do nothing different
} else if ($_POST['add_admin_post_scrolljss_submit'] == 'Add row') { // isn't save all changes but is a number instead
    // Add Row




		$page = get_page_by_title($_POST['pagenames']);
		$pageid =  $page->ID;
		$amountofrows = $_POST['addrowval'] ;
		
	    $rowhidden = '0';
		$objectname = 'example';
		$effect = 'pageholding';
		$eventlength = '1';
		$pagelocation = '0';
		$pagelocationm = '0';
		$pagelocations = '0';
		$lockwith = 'none';
		$lockstatus = 'unlocked';

for ($i = 0; $i < $amountofrows; $i++) {
   
		$wpdb->insert( 
		$table_name, 
		array( 
			'rowhidden'	=> $rowhidden,		
			'pageid' => $pageid,
			'objectname' => $objectname, 
			'effect' => $effect, 
			'eventlength' => $eventlength,
			'pagelocation' => $pagelocation, 
			'pagelocationm' => $pagelocationm,  
			'pagelocations' => $pagelocations,
			'lockwith' => $lockwith,
			'lockstatus' => $lockstatus,  
			) 
		);
}

} else {
    //invalid action!
}

// GETS ARRAY AND PUTS IT IN NEW VARIABLE
$identityarray = $_POST['identityarray'];

$arrset1 = [];
$arrset2 = [];

foreach( $identityarray as $key => $singleid ) {



		$arrset1[] = $singleid;

$jsoncontent = $_POST['fulldata'. $singleid];
		$jsonreplaed = str_replace("\\", "", $jsoncontent );
		$jsonreplaed2 = str_replace("'", '"', $jsonreplaed );
		//$obj = json_decode($jsonreplaed);


$jsonArray = json_decode($jsonreplaed2, false);

/*echo "<pre>";  print_r($jsonreplaed2); echo "</pre>"; 
	echo "<pre>";  print_r($jsonArray->id); echo "</pre>"; 	
*/

	    $rowhidden = $jsonArray->rowhidden;
		$pageid = $jsonArray->pageid ;
		$objectname = $jsonArray->objectname ;
		$effect = $jsonArray->effect ;
		$eventlength = $jsonArray->eventlength ;
		$pagelocation = $jsonArray->pagelocation ;
		$pagelocationm = $jsonArray->pagelocationm ;
		$pagelocations = $jsonArray->pagelocations ;
		$lockwith = $jsonArray->lockwith ;
		$lockstatus = $jsonArray->lockstatus ;

/*	    
		$pageid = $_POST['sp'. $singleid] ;
	    $rowhidden = $_POST['sg'. $singleid];
		$objectname = $_POST['sa'. $singleid] ;
		$effect = $_POST['sb'. $singleid];
		$eventlength = $_POST['sc'. $singleid];
		$pagelocation = $_POST['sd'. $singleid];
		$pagelocationm = '0';
		$pagelocations = '0';
		$lockwith = $_POST['se'. $singleid];
		$lockstatus = $_POST['sf'. $singleid];
*/
		$wpdb->update( 
				$table_name,
				array( 
					'rowhidden'	=> $rowhidden,		
					'pageid' => $pageid,
					'objectname' => $objectname, 
					'effect' => $effect, 
					'eventlength' => $eventlength,
					'pagelocation' => $pagelocation, 
					'pagelocationm' => $pagelocationm,  
					'pagelocations' => $pagelocations,
					'lockwith' => $lockwith,
					'lockstatus' => $lockstatus,
				), 
				array( 'id' => $singleid)
			);
}
foreach($result as $row) {
		$arrset2[] = $row->id;
}
$addlist = array_diff($arrset1, $arrset2);
$deletelist = array_diff($arrset2, $arrset1);
/*print_r($deletelist);
echo "<pre>";  print_r($arrset1); echo "<pre>"; 
echo "<pre>";  print_r($arrset2); echo "<pre>";
print_r($addlist);
echo "<pre>";  print_r($_POST); echo "<pre> </br> </br>"; 

*/

foreach ($deletelist as $key => $delid) {
	$wpdb->delete(
	$table_name, 
	array( 
		'ID' => $delid 
		) 
	);

}

foreach ($addlist as $key => $add) {
		
$jsoncontent = $_POST['fulldata'. $singleid];
		$jsonreplaed = str_replace("\\", "", $jsoncontent );
		$jsonreplaed2 = str_replace("'", '"', $jsonreplaed );
		//$obj = json_decode($jsonreplaed);


$jsonArray = json_decode($jsonreplaed2, false);

/*echo "<pre>";  print_r($jsonreplaed2); echo "</pre>"; 
	echo "<pre>";  print_r($jsonArray->id); echo "</pre>"; 	
*/

	    $rowhidden = $jsonArray->rowhidden;
		$pageid = $jsonArray->pageid ;
		$objectname = $jsonArray->objectname ;
		$effect = $jsonArray->effect ;
		$eventlength = $jsonArray->eventlength ;
		$pagelocation = $jsonArray->pagelocation ;
		$pagelocationm = $jsonArray->pagelocationm ;
		$pagelocations = $jsonArray->pagelocations ;
		$lockwith = $jsonArray->lockwith ;
		$lockstatus = $jsonArray->lockstatus ;

		$wpdb->insert( 
		$table_name, 
		array( 
					'rowhidden'	=> $rowhidden,		
					'pageid' => $pageid,
					'objectname' => $objectname, 
					'effect' => $effect, 
					'eventlength' => $eventlength,
					'pagelocation' => $pagelocation, 
					'pagelocationm' => $pagelocationm,  
					'pagelocations' => $pagelocations,
					'lockwith' => $lockwith,
					'lockstatus' => $lockstatus,
			) 
		);


}



if(isset($_POST['current_page']))
{
    wp_redirect($_POST['current_page']);
}
else
{
  wp_redirect(admin_url().'admin.php?page=jss-scrolling_submenu2');    

}



            } else {
                die('No messing please!');
            }

	}
}
