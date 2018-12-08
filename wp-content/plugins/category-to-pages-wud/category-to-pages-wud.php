<?php
/* 
=== Category to Pages WUD ===
Contributors: wistudat.be
Plugin Name: Category to Pages WUD
Donate Reason: Enough for a cup of coffee?
Donate link: https://www.paypal.me/WudPluginsCom
Description: Add Easily Page Categories and Page Tags.
Author: Danny WUD
Author URI: https://wud-plugins.com
Plugin URI: https://wud-plugins.com
Tags: category pages, categories page, category page, categories pages, category to page, page category, hatom, related post, page excerpts, seo pages, rss feed, hatom
Requires at least: 3.6
Tested up to: 4.9
Stable tag: 2.4.6
Version: 2.4.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: category-to-pages-wud
Domain Path: /languages
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
//==============================================================================//
$ctp_version='2.4.6';
// Store the latest version.
	if (get_option('pcwud_wud_version')!=$ctp_version) {
		cattopage_wud_update();
	}
	if( get_option('cattopage_wud_update_warning')==0 || get_option('cattopage_wud_update_warning')=="" ){ 
		add_action('admin_notices', 'cattopage_wud_major_update'); 
	}	
//==============================================================================//
global $template;
// Action after activation (button activate)
	add_action( 'activated_plugin', 'cattopage_wud_activation' );
	
// Actions inside this page
		add_action( 'plugins_loaded', 'cattopage_wud_require' );
		add_action('wp_head', 'show_wud_cattopage_template');
		add_action('admin_menu', 'cattopage_wud_create_menu');
		add_action( 'admin_menu', 'ctpwud_admin_menu' );
		add_filter( 'plugin_action_links', 'cattopage_wud_action_links', 10, 5 );
		add_action('admin_enqueue_scripts', 'cattopage_wud_styling');
		add_action('init', 'cattopage_wud_site_page');
		add_action('plugins_loaded', 'cattopage_wud_languages');
		
// Actions from other pages (loaded by: cattopage_wud_require)	
		add_filter( 'widget_text', 'cattopage_wud_widget_text', 1, 1);	
		add_filter("the_content", "cattopage_wud_change_to_excerpt");
		add_action( 'init', 'cattopage_wud_add_excerpts_to_pages' );
		add_shortcode('wudrelated', 'cattopage_wud_short_code_page_list');
		add_shortcode('wudcatlist', 'cattopage_wud_short_code_cat_list');
		add_shortcode('wudtaglist', 'cattopage_wud_short_code_tag_list');
		add_shortcode('wudcatdrop', 'cattopage_wud_short_code_cat_drop');
		add_shortcode('wudtagdrop', 'cattopage_wud_short_code_tag_drop');
		add_shortcode('wudpagelist', 'cattopage_wud_short_code_pages_list');		
		add_shortcode('wudwidget', 'cattopage_wud_shortcode_display');
		add_shortcode( 'currentcattag', 'cattopage_wud_current_cat_tag');
		
//Enable or Disable Javascript from Googleapis
		if( get_option('cattopage_wud_java')=='1'){
			add_action( 'wp_enqueue_scripts',    'cattopage_wud_replace_jquery', 100 );
		}
		
//Actions From the WUD RSS Page	
		if (! is_admin() && get_option('cattopage_wud_rss')==1){
			add_filter('request', 'ctpwud_include_categories');
			add_filter( 'pre_get_posts','ctpwud_exclude_categories' );
		}
						
// Actions with conditions
//-> Change the hardcoded URL only if no unique cat/tag is actiated.		
	if(get_option('cattopage_wud_cat') == "post" ){
		add_filter( 'page_link', 'cattopage_wud_custom_urls', 'edit_files', 2 );	
	}		
//-> Use the same categories and tags for pages, as it is for post.		
	if(get_option('cattopage_wud_cat') == "post" ){
		//CAT POST
		add_action('init', 'cattopage_wud_reg_cat');
		if ( ! is_admin()) {
			add_action( 'pre_get_posts', 'cattopage_wud_cat_archives', 10, 1 );
		}
	}
	if( get_option('cattopage_wud_tag') == "post" ){	
		//TAG POST
		$action = add_action('init', 'cattopage_wud_reg_tag');
		if ($action != 1){ $action = add_action('plugins_loaded','cattopage_wud_reg_tag'); }
		if ( ! is_admin()) {
			add_action( 'pre_get_posts', 'cattopage_wud_tag_archives', 10, 1 );
		}	
	}
	
//-> Use unique categories and tags for pages.	
		//Page Category
		if( get_option('cattopage_wud_cat') == "page" ){
			add_action( 'init', 'wud_custom_cats', 0 );
		}
		//Page Tag
		if ( get_option('cattopage_wud_tag') == "page" ){
			add_action( 'init', 'wud_custom_tags', 0 );
		}
		if(get_option('cattopage_wud_tag') == "page" || get_option('cattopage_wud_tag') == "post" || get_option('cattopage_wud_cat') == "page" || get_option('cattopage_wud_cat') == "post"){
			add_action( 'restrict_manage_posts', 'filter_wud_by_taxonomies' , 10, 2);
		}



	 
//-> Show Category and ord tag link on pages
	if ( ! is_admin() && get_option('cattopage_wud_title')=='page' && (get_option('cattopage_wud_cat') != "none" || get_option('cattopage_wud_tag') != "none" )) {
		//the category/tag in the page
		if (get_option('cattopage_wud_index_pos')==1 || get_option('cattopage_wud_index_pos')==2 ){
			add_filter ('the_content', 'cattopage_wud_titles_in_page');
		}
		//the category/tag below the page title
		else{
			add_filter( 'the_title', 'cattopage_wud_titles', 10, 2);
		}		
	}

//-> Add HATOM data	 
	if (! is_admin() && get_option('cattopage_wud_hatom')==1){
		add_filter('the_content', 'cattopage_wud_hatom_data');
	}


//-> JQuery from Googleapis
function cattopage_wud_replace_jquery() {
	global $wp_scripts; 
	if ( ! is_admin() ){
		if (isset($wp_scripts->registered['jquery']->ver)) {
			$ver = $wp_scripts->registered['jquery']->ver;
		} else {
			$ver = '2.2.0';
		}
		//If jquery-core is used, replace with the version from googleapis
		if( wp_script_is( 'jquery-core', 'enqueued' ) ) {
			wp_deregister_script('jquery-core');
			wp_register_script('jquery-core', "//ajax.googleapis.com/ajax/libs/jquery/$ver/jquery.min.js", false, $ver);
			wp_enqueue_script('jquery-core');
		}
		//If jquery is used, place the current version from googleapis
		elseif( wp_script_is( 'jquery', 'enqueued' ) ) {
			wp_deregister_script('jquery');
			wp_register_script('jquery', "//ajax.googleapis.com/ajax/libs/jquery/$ver/jquery.min.js", false, $ver);
			wp_enqueue_script('jquery');
		}
	}
}

	
//-> Extra pages	
if(!function_exists('cattopage_wud_require')){ 
	function cattopage_wud_require() {
	//Load the admin page
		require_once( plugin_dir_path( __FILE__ ) . '/pages/c2p-wud-admin.php' );
	//Load the RSS page
		require_once( plugin_dir_path( __FILE__ ) . '/pages/c2p-wud-rss.php' );
	//Load the shortcodes
		require_once( plugin_dir_path( __FILE__ ) . '/pages/c2p-wud-shortcode.php' );
	//Load the register terms
		require_once( plugin_dir_path( __FILE__ ) . '/pages/c2p-wud-reg-terms.php' );
	//Load the widgets
		require_once( plugin_dir_path( __FILE__ ) . '/pages/c2p-wud-widgets.php' );
	//Load the options
		require_once( plugin_dir_path( __FILE__ ) . '/pages/c2p-wud-options.php' );
	//Load the category images	
		require_once( plugin_dir_path( __FILE__ ) . '/pages/c2p-wud-cat-img.php' );			
	}
}	 
//-> Debug used template file	
if(!function_exists('show_wud_cattopage_template')){ 
	function show_wud_cattopage_template() {
		global $template;
		$temp = basename($template);
		//echo $temp;
		echo '<meta name = "viewport" content = "user-scalable=no, width=device-width">
<meta name="apple-mobile-web-app-capable" content="yes" />';		
	}
}

//-> Category to pages wud languages
function cattopage_wud_languages() {
	load_plugin_textdomain( 'category-to-pages-wud', false, dirname(plugin_basename( __FILE__ ) ) . '/languages' );
}

//-> Lay-out and js functions	 
function cattopage_wud_site_page(){
	wp_enqueue_script('jquery');
	wp_register_script('cattopage_wud_script', plugins_url( 'js/cat-to-page.js', __FILE__ ), array('jquery'), null, true );
	wp_enqueue_script('cattopage_wud_script');	
	wp_register_script('cattopage_wud_cat_img_script', plugins_url( 'js/jquery.ctp_wud.js', __FILE__ ), array('jquery'), null, true );
	wp_enqueue_script('cattopage_wud_cat_img_script');		
	wp_enqueue_style( 'cattopage_wud_site_style' );
	wp_enqueue_style( 'cattopage_wud_site_style', plugins_url('css/category-to-pages-wud.css', __FILE__ ), false, null );
	wp_enqueue_style( 'cattopage_wud_img_style' );
	wp_enqueue_style( 'cattopage_wud_img_style', plugins_url('css/jquery.ctp_wud.css', __FILE__ ), false, null );
}

//-> CSS for admin
function cattopage_wud_styling($hook) {
	if   ( $hook == "toplevel_page_category-to-pages-wud" || $hook == "toplevel_page_category-to-pages-rss-wud" ) {
		wp_enqueue_style( 'cattopage_wud_admin_style' );
		wp_enqueue_style( 'cattopage_wud_admin_style', plugins_url('css/admin.css', __FILE__ ), false, null );
     }
}

//-> Settings page menu item	
function cattopage_wud_create_menu() {
	add_menu_page( 'Page Category WUD', 'Cat to Page WUD', 'manage_options', 'category-to-pages-wud', 'cattopage_wud_settings_page', plugins_url('images/wud_icon.png', __FILE__ ) );
}

function ctpwud_admin_menu() {
	add_menu_page( 'Page Cat RSS WUD', 'Cat to Page RSS', 'manage_options', 'category-to-pages-rss-wud', 'ctpwud_options_page', plugins_url('images/wud_icon.png', __FILE__ ) );
}

//-> category-to-pages-wud options page (menu options by plugins)
function cattopage_wud_action_links( $actions, $pcwud_set ){
		static $plugin;
		if (!isset($plugin))
			$plugin = plugin_basename(__FILE__);
		if ($plugin == $pcwud_set) {
				$settings_page = array('settings' => '<a href="'.admin_url("admin.php").'?page=category-to-pages-wud">' . __('Settings', 'General') . '</a>');
				$support_link = array('support' => '<a href="https://wordpress.org/support/plugin/category-to-pages-wud" target="_blank">Support</a>');				
					$actions = array_merge($support_link, $actions);
					$actions = array_merge($settings_page, $actions);
			}			
			return $actions;
}

function cattopage_wud_major_update(){
	//The hide button where used before ... or this is a new installation ...
	if (get_option('cattopage_wud_update_warning')==1){ return;}
	
    $screen = get_current_screen();
	if( array_key_exists( 'submit_hide', $_POST ) )
	{
	  update_option('cattopage_wud_update_warning', 1);
	  echo '<meta http-equiv="refresh" content="1">';
	}
	if( array_key_exists( 'submit_wait', $_POST ) ){
	  update_option('cattopage_wud_update_warning', 0);
	}
	
    if ( in_array( $screen->id, array( 'toplevel_page_category-to-pages-wud' ) ) ){
		echo'	
			<div class="notice notice-warning"> 
				<form method="post">
					<h1>Your attention is required</h1>
					This is a <b>major update</b> from <b>Category to Pages WUD</b>, which require some attention!<br><br>	
					Therfore, if you are using ANY <b>caching plugin</b> like WP Super Cache, W3 Total Cache or another one, please <b>switch it off</b> and <b>clean the cache files</b>.<br>
					After this has been executed you can enable the caching plugin without any problems.<br>
					This action wil cleanup old Category to Pages WUD data which is changed and ensure proper operation of our plug-in..<br><br>
					Please check <b>all</b> the Category to Pages WUD <b>settings</b> and save them.<br>
					Enjoy our FREE plugin!.<br><br>			
					If you do not want to use this major update, download the previous version 2.4.3 <a href="https://downloads.wordpress.org/plugin/category-to-pages-wud.2.4.3.zip">here</a> and copy it with FTP on top of this version.<br>
					This will result that you do not have the extra options: Featured Category Images + a configurable Category Images Carousel.<br><br>
					<input class="button-primary" id="submit_hide"    type="submit" name = "submit_hide"    value = "Hide this message permanently." /> 	<input class="button-primary" id="submit_wait" type="submit" name = "submit_wait" value = "Do not hide this message." /><br><br>
				</form>
			</div>
		';
    }
}



//-> Update variables if new version
function cattopage_wud_update(){
		global $ctp_version;

			//Update fields	 cattopage_wud categories or tags for post or pages
			if(get_option('pcwud_wud_version') < '2.4.4'){
				if (get_option('cattopage_wud_unique')=='0' && (get_option('cattopage_wud_cat')=='page' )) {update_option('cattopage_wud_cat','post');}
				if (get_option('cattopage_wud_unique')=='0' && (get_option('cattopage_wud_tag')=='page' )) {update_option('cattopage_wud_tag','post');}
				if (get_option('cattopage_wud_unique')=='0' && (get_option('cattopage_wud_cat')=='' )) {update_option('cattopage_wud_cat','none');}
				if (get_option('cattopage_wud_unique')=='0' && (get_option('cattopage_wud_tag')=='' )) {update_option('cattopage_wud_tag','none');}
				
				if (get_option('cattopage_wud_unique')=='1' && (get_option('cattopage_wud_cat')=='page' )) {update_option('cattopage_wud_cat','page');}
				if (get_option('cattopage_wud_unique')=='1' && (get_option('cattopage_wud_tag')=='page' )) {update_option('cattopage_wud_tag','page');}		
				if (get_option('cattopage_wud_unique')=='1' && (get_option('cattopage_wud_cat')=='' )) {update_option('cattopage_wud_cat','none');}
				if (get_option('cattopage_wud_unique')=='1' && (get_option('cattopage_wud_tag')=='' )) {update_option('cattopage_wud_tag','none');}
			}

			//Update version number
			update_option('pcwud_wud_version', $ctp_version);
				
			if (get_option('cattopage_wud_custom_post0')=='') {update_option('cattopage_wud_custom_post0', '');}
			if (get_option('cattopage_wud_custom_post1')=='') {update_option('cattopage_wud_custom_post1', '');}
			if (get_option('cattopage_wud_custom_post2')=='') {update_option('cattopage_wud_custom_post2', '');}
			if (get_option('cattopage_wud_title')=='') {update_option('cattopage_wud_title', 'none');}
			if (get_option('cattopage_wud_txt_cat_img')=='') {update_option('cattopage_wud_txt_cat_img', 0);}
			if (get_option('cattopage_wud_title_size')=='') {update_option('cattopage_wud_title_size', 16);}
			if (get_option('cattopage_wud_image_title_size')=='') {update_option('cattopage_wud_image_title_size', 16);}
			if (get_option('cattopage_wud_image_size')=='') {update_option('cattopage_wud_image_size', 200);}
			if (get_option('cattopage_wud_title_h1')=='') {update_option('cattopage_wud_title_h1', 'p');}
			if (get_option('cattopage_wud_quantity')=='') {update_option('cattopage_wud_quantity', 5);}
			if (get_option('cattopage_wud_title_font')=='') {update_option('cattopage_wud_title_font', 'inherit');}
			if (get_option('cattopage_wud_image_title_font')=='') {update_option('cattopage_wud_image_title_font', 'inherit');}
			if (get_option('cattopage_wud_image_interval')=='') {update_option('cattopage_wud_image_interval', '5000');}
			if (get_option('cattopage_wud_image_select')=='') {update_option('cattopage_wud_image_select', 'medium');}
			if (get_option('cattopage_wud_index_pos')=='') {update_option('cattopage_wud_index_pos', 0);}
			if (get_option('cattopage_wud_widget_option1')=='') {update_option('cattopage_wud_widget_option1', 0);}
			if (get_option('cattopage_wud_widget_option2')=='') {update_option('cattopage_wud_widget_option2', 0);}
			if (get_option('cattopage_wud_widget_parent')=='') {update_option('cattopage_wud_widget_parent', 0);}
			if (get_option('cattopage_wud_scroll_img')=='') {update_option('cattopage_wud_scroll_img', 0);}
			if (get_option('cattopage_wud_cat_img')=='') {update_option('cattopage_wud_cat_img', 0);}
			if (get_option('cattopage_wud_java')=='') {update_option('cattopage_wud_java', 0);}
			if (get_option('cattopage_wud_pause_img')=='') {update_option('cattopage_wud_pause_img', 0);}
			if (get_option('cattopage_wud_exp_yes')=='') {update_option('cattopage_wud_exp_yes', 1);}
			if (get_option('cattopage_wud_hatom')=='') {update_option('cattopage_wud_hatom', 0);}
			if (get_option('cattopage_wud_rss')=='') {update_option('cattopage_wud_rss', 0);}
			if (get_option('cattopage_wud_hardcoded')=='') {update_option('cattopage_wud_hardcoded', 0);}
			if (get_option('cattopage_wud_exp_lenght')=='') {update_option('cattopage_wud_exp_lenght', 25);}	
			if (get_option('cattopage_wud_widget_title1')=='') {update_option('cattopage_wud_widget_title1', '');}
			if (get_option('cattopage_wud_widget_title2')=='') {update_option('cattopage_wud_widget_title2', '');}	
			if (get_option('cattopage_wud_widget_title3')=='') {update_option('cattopage_wud_widget_title3', '');}
			if (get_option('cattopage_wud_widget_title4')=='') {update_option('cattopage_wud_widget_title4', '');}
			if (get_option('cattopage_wud_update_warning')=='') {update_option('cattopage_wud_update_warning', 0);}
}

//-> Update required variables only by activation from the plugin! (button activate)
function cattopage_wud_activation( $plugin ) {
    if( $plugin == plugin_basename( __FILE__ ) ) {			
			update_option('cattopage_wud_cat', 'page');
			update_option('cattopage_wud_tag', 'page');
			update_option('cattopage_wud_custom_post0', '');
			update_option('cattopage_wud_custom_post1', '');
			update_option('cattopage_wud_custom_post2', '');
			update_option('cattopage_wud_title', 'none');
			update_option('cattopage_wud_txt_cat_img', 0);
			update_option('cattopage_wud_title_size', 16);
			update_option('cattopage_wud_image_size', 200);
			update_option('cattopage_wud_title_h1', 'p');
			update_option('cattopage_wud_quantity', 5);
			update_option('cattopage_wud_title_font', 'inherit');
			update_option('cattopage_wud_image_title_font', 'medium');
			update_option('cattopage_wud_image_select', 'inherit');
			update_option('cattopage_wud_image_select', '5000');
			update_option('cattopage_wud_index_pos', 0);
			update_option('cattopage_wud_widget_option1', 0);
			update_option('cattopage_wud_widget_option2', 0);
			update_option('cattopage_wud_widget_parent', 0);
			update_option('cattopage_wud_scroll_img', 0);
			update_option('cattopage_wud_cat_img', 0);
			update_option('cattopage_wud_java', 0);
			update_option('cattopage_wud_pause_img', 0);
			update_option('cattopage_wud_exp_yes', 1);
			update_option('cattopage_wud_hatom', 0);
			update_option('cattopage_wud_rss', 0);
			update_option('cattopage_wud_hardcoded', 0);
			update_option('cattopage_wud_exp_lenght', 25);
			update_option('cattopage_wud_widget_title1', 'Page Categories');
			update_option('cattopage_wud_widget_title2', 'Page Tags');
			update_option('cattopage_wud_widget_title3', 'Related Post');
			update_option('cattopage_wud_widget_title4', 'Related Categories');
			update_option('cattopage_wud_update_warning', 1);
			exit( wp_redirect( admin_url("admin.php").'?page=category-to-pages-wud&act=1' ) );
    }
}

?>
