<?php
/* 
=== Category to Pages WUD Administration===
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
//==============================================================================//
	
if(!function_exists('cattopage_wud_settings_page')){
// Admin settings page	
function cattopage_wud_settings_page(){

		echo '<div class="ctp-wud-admin-table">';
		echo "<form name='cattopage_wud_form' method='post' action=".admin_url('admin.php')."?page=category-to-pages-wud>";
		echo'<h1>'.__("Adds easily Categories and Tags to Pages!", "category-to-pages-wud").' (Version : '.get_option('pcwud_wud_version').')</h1>';	//Activation	
		if(isset($_GET['act']) && $_GET['act'] == 1 ){
			echo '<div class="activated"><p><strong>'.__("IMPORTANT: Plugin activation sets all settings to the default values.", "category-to-pages-wud").'</strong></p></div>';
		}
		elseif(isset($_GET['act']) && $_GET['act'] == 2 ){
			echo '<div class="activated"><p><strong>'.__("IMPORTANT: Check all your settings and save it before you continue !!!.", "category-to-pages-wud").'</strong></p></div>';
		}		
		else{
			echo '<p></p>';
		}
	// Save the values to WP_OPTIONS
	if ( isset($_POST['ctp_opt_hidden']) && $_POST['ctp_opt_hidden'] == 'Y' && isset( $_POST['cattopage-wud-save'] ) && wp_verify_nonce($_POST['cattopage-wud-save'], 'cattopage-wud-check')) {
		
		// Check and save

		if ( isset($_POST['cattopage_wud_cat']) ) {$cattopage_wud_cat=$_POST['cattopage_wud_cat'];}
		update_option('cattopage_wud_cat', filter_var($cattopage_wud_cat, FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_tag']) ) {$cattopage_wud_tag=$_POST['cattopage_wud_tag'];}
		update_option('cattopage_wud_tag', filter_var($cattopage_wud_tag, FILTER_SANITIZE_STRING));

		if ( isset($_POST['cattopage_wud_scroll_img']) && $_POST['cattopage_wud_scroll_img']=='1') {$cattopage_wud_scroll_img = '1';} else{$cattopage_wud_scroll_img ='0';}
		update_option('cattopage_wud_scroll_img', filter_var($cattopage_wud_scroll_img, FILTER_SANITIZE_STRING));

		if ( isset($_POST['cattopage_wud_cat_img']) && $_POST['cattopage_wud_cat_img']=='1') {$cattopage_wud_cat_img = '1';} else{$cattopage_wud_cat_img ='0';}
		update_option('cattopage_wud_cat_img', filter_var($cattopage_wud_cat_img, FILTER_SANITIZE_STRING));

		if ( isset($_POST['cattopage_wud_java']) && $_POST['cattopage_wud_java']=='1') {$cattopage_wud_java = '1';} else{$cattopage_wud_java ='0';}
		update_option('cattopage_wud_java', filter_var($cattopage_wud_java, FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_pause_img']) && $_POST['cattopage_wud_pause_img']=='1') {$cattopage_wud_pause_img = '1';} else{$cattopage_wud_pause_img ='0';}
		update_option('cattopage_wud_pause_img', filter_var($cattopage_wud_pause_img, FILTER_SANITIZE_STRING));
			
		if ( isset($_POST['cattopage_wud_image_interval']) && $_POST['cattopage_wud_image_interval']=='') {$cattopage_wud_image_interval ='5000';} else{$cattopage_wud_image_interval=$_POST['cattopage_wud_image_interval'];}
		update_option('cattopage_wud_image_interval', filter_var($cattopage_wud_image_interval, FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_title']) && $_POST['cattopage_wud_title']=='1') {$cattopage_wud_title = 'page';} else{$cattopage_wud_title ='none';}
		update_option('cattopage_wud_title', filter_var($cattopage_wud_title, FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_txt_cat_img']) && $_POST['cattopage_wud_txt_cat_img']=='1') {$cattopage_wud_txt_cat_img = '1';} else{$cattopage_wud_txt_cat_img ='0';}
		update_option('cattopage_wud_txt_cat_img', filter_var($cattopage_wud_txt_cat_img, FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_title_size']) && $_POST['cattopage_wud_title_size']=='') {$cattopage_wud_title_size ='16';} else{$cattopage_wud_title_size=$_POST['cattopage_wud_title_size'];}
		update_option('cattopage_wud_title_size', filter_var($cattopage_wud_title_size, FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_image_title_size']) && $_POST['cattopage_wud_image_title_size']=='') {$cattopage_wud_image_title_size ='16';} else{$cattopage_wud_image_title_size=$_POST['cattopage_wud_image_title_size'];}
		update_option('cattopage_wud_image_title_size', filter_var($cattopage_wud_image_title_size, FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_image_size']) && $_POST['cattopage_wud_image_size']=='') {$cattopage_wud_image_size ='300';} else{$cattopage_wud_image_size=$_POST['cattopage_wud_image_size'];}
		update_option('cattopage_wud_image_size', filter_var($cattopage_wud_image_size, FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_title_h1']) && $_POST['cattopage_wud_title_h1']=='') {$cattopage_wud_title_h1 ='16';} else{$cattopage_wud_title_h1=$_POST['cattopage_wud_title_h1'];}
		update_option('cattopage_wud_title_h1', filter_var($cattopage_wud_title_h1, FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_quantity']) && $_POST['cattopage_wud_quantity']=='') {$cattopage_wud_quantity ='5';} else{$cattopage_wud_quantity=$_POST['cattopage_wud_quantity'];}
		update_option('cattopage_wud_quantity', filter_var($cattopage_wud_quantity, FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_title_font']) && $_POST['cattopage_wud_title_font']=='') {$cattopage_wud_title_font ='inherit';} else{$cattopage_wud_title_font=$_POST['cattopage_wud_title_font'];}
		update_option('cattopage_wud_title_font', filter_var($cattopage_wud_title_font, FILTER_SANITIZE_STRING));		
		
		if ( isset($_POST['cattopage_wud_image_title_font']) && $_POST['cattopage_wud_image_title_font']=='') {$cattopage_wud_image_title_font ='inherit';} else{$cattopage_wud_image_title_font=$_POST['cattopage_wud_image_title_font'];}
		update_option('cattopage_wud_image_title_font', filter_var($cattopage_wud_image_title_font, FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_image_select']) && $_POST['cattopage_wud_image_select']=='') {$cattopage_wud_image_select ='medium';} else{$cattopage_wud_image_select=$_POST['cattopage_wud_image_select'];}
		update_option('cattopage_wud_image_select', filter_var($cattopage_wud_image_select, FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_index_pos']) && $_POST['cattopage_wud_index_pos']=='') {$cattopage_wud_index_pos ='0';} else{$cattopage_wud_index_pos=$_POST['cattopage_wud_index_pos'];}
		update_option('cattopage_wud_index_pos', filter_var($cattopage_wud_index_pos, FILTER_SANITIZE_STRING));

		if ( isset($_POST['cattopage_wud_widget_option1']) && $_POST['cattopage_wud_widget_option1']=='1') {$cattopage_wud_widget_option1 = '1';} else{$cattopage_wud_widget_option1 ='0';}
		update_option('cattopage_wud_widget_option1', filter_var($cattopage_wud_widget_option1, FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_widget_option2']) && $_POST['cattopage_wud_widget_option2']=='1') {$cattopage_wud_widget_option2 = '1';} else{$cattopage_wud_widget_option2 ='0';}
		update_option('cattopage_wud_widget_option2', filter_var($cattopage_wud_widget_option2, FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_widget_parent']) && $_POST['cattopage_wud_widget_parent']=='1') {$cattopage_wud_widget_parent = '1';} else{$cattopage_wud_widget_parent ='0';}
		update_option('cattopage_wud_widget_parent', filter_var($cattopage_wud_widget_parent, FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_exp_yes']) && $_POST['cattopage_wud_exp_yes']=='1') {$cattopage_wud_exp_yes = '1';} else{$cattopage_wud_exp_yes ='0';}
		update_option('cattopage_wud_exp_yes', filter_var($cattopage_wud_exp_yes, FILTER_SANITIZE_STRING));		

		if ( isset($_POST['cattopage_wud_hardcoded']) && $_POST['cattopage_wud_hardcoded']=='1') {$cattopage_wud_hardcoded = '1';} else{$cattopage_wud_hardcoded ='0';}	
		//Disable hardcoded URL if wud_cat <> post
		if($_POST['cattopage_wud_cat'] != "post" ){ $cattopage_wud_hardcoded ='0'; }
		update_option('cattopage_wud_hardcoded', filter_var($cattopage_wud_hardcoded, FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_hatom']) && $_POST['cattopage_wud_hatom']=='1') {$cattopage_wud_hatom = '1';} else{$cattopage_wud_hatom ='0';}
		update_option('cattopage_wud_hatom', filter_var($cattopage_wud_hatom, FILTER_SANITIZE_STRING));	

		if ( isset($_POST['cattopage_wud_rss']) && $_POST['cattopage_wud_rss']=='1') {$cattopage_wud_rss = '1';} else{$cattopage_wud_rss ='0';}
		update_option('cattopage_wud_rss', filter_var($cattopage_wud_rss, FILTER_SANITIZE_STRING));	
		
		if ( isset($_POST['cattopage_wud_exp_lenght']) ) {$cattopage_wud_exp_lenght =$_POST['cattopage_wud_exp_lenght'];}
		update_option('cattopage_wud_exp_lenght', filter_var($cattopage_wud_exp_lenght, FILTER_SANITIZE_STRING));

		if ( isset($_POST['cattopage_wud_widget_title1']) ) {$cattopage_wud_widget_title1 =$_POST['cattopage_wud_widget_title1'];}
		update_option('cattopage_wud_widget_title1', filter_var($_POST['cattopage_wud_widget_title1'], FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_widget_title2']) ) {$cattopage_wud_widget_title2 =$_POST['cattopage_wud_widget_title2'];}
		update_option('cattopage_wud_widget_title2', filter_var($_POST['cattopage_wud_widget_title2'], FILTER_SANITIZE_STRING));	
		
		if ( isset($_POST['cattopage_wud_widget_title3']) ) {$cattopage_wud_widget_title3 =$_POST['cattopage_wud_widget_title3'];}
		update_option('cattopage_wud_widget_title3', filter_var($_POST['cattopage_wud_widget_title3'], FILTER_SANITIZE_STRING));	

		if ( isset($_POST['cattopage_wud_widget_title4']) ) {$cattopage_wud_widget_title4 =$_POST['cattopage_wud_widget_title4'];}
		update_option('cattopage_wud_widget_title4', filter_var($_POST['cattopage_wud_widget_title4'], FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_custom_post0']) ) {$cattopage_wud_custom_post0 =$_POST['cattopage_wud_custom_post0'];}
		update_option('cattopage_wud_custom_post0', filter_var($_POST['cattopage_wud_custom_post0'], FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_custom_post1']) ) {$cattopage_wud_custom_post1 =$_POST['cattopage_wud_custom_post1'];}
		update_option('cattopage_wud_custom_post1', filter_var($_POST['cattopage_wud_custom_post1'], FILTER_SANITIZE_STRING));
		
		if ( isset($_POST['cattopage_wud_custom_post2']) ) {$cattopage_wud_custom_post2 =$_POST['cattopage_wud_custom_post2'];}
		update_option('cattopage_wud_custom_post2', filter_var($_POST['cattopage_wud_custom_post2'], FILTER_SANITIZE_STRING));

	
	//load options		
		// Saved message
		if( empty($error) ){
		echo "<div class='updated'><p>" . ( __( 'Successfully updated ... one moment please.', 'category-to-pages-wud' ) ) . "</p></div><br>";
		wud_custom_cats();
		wud_custom_tags();
		flush_rewrite_rules();
		echo '<meta http-equiv="refresh" content="1">';
		}
		
		// If some error occured
		else{
			echo "<div class='error'><p><strong>";
			foreach ( $error as $key=>$val ) {
				_e($val, 'ctp-wud'); 
				echo "<br/>";
			}
				echo "</strong></p></div>";
		}
	} 
	
	// READ the used vaiables
	else {
		$cattopage_wud_cat = get_option('cattopage_wud_cat');
		$cattopage_wud_tag = get_option('cattopage_wud_tag');
		$cattopage_wud_title = get_option('cattopage_wud_title');
		$cattopage_wud_txt_cat_img = get_option('cattopage_wud_txt_cat_img');
		$cattopage_wud_title_h1 = get_option('cattopage_wud_title_h1');
		$cattopage_wud_title_size = get_option('cattopage_wud_title_size');
		if(!get_option('cattopage_wud_title_size')){$cattopage_wud_title_size="16";}
		$cattopage_wud_image_title_size = get_option('cattopage_wud_image_title_size');
		if(!get_option('cattopage_wud_image_title_size')){$cattopage_wud_image_title_size="16";}	
		$cattopage_wud_image_size = get_option('cattopage_wud_image_size');
		if(!get_option('cattopage_wud_image_size')){$cattopage_wud_image_size="50";}		
		$cattopage_wud_quantity = get_option('cattopage_wud_quantity');
		if(!get_option('cattopage_wud_quantity')){$cattopage_wud_quantity="5";}		
		$cattopage_wud_title_font = get_option('cattopage_wud_title_font');
		$cattopage_wud_image_title_font = get_option('cattopage_wud_image_title_font');
		$cattopage_wud_image_interval = get_option('cattopage_wud_image_interval');
		$cattopage_wud_image_select = get_option('cattopage_wud_image_select');		
		$cattopage_wud_index_pos = get_option('cattopage_wud_index_pos');
		$cattopage_wud_widget_option1 = get_option('cattopage_wud_widget_option1');
		$cattopage_wud_widget_option2 = get_option('cattopage_wud_widget_option2');
		$cattopage_wud_widget_parent = get_option('cattopage_wud_widget_parent');
		$cattopage_wud_scroll_img = get_option('cattopage_wud_scroll_img');
		$cattopage_wud_cat_img = get_option('cattopage_wud_cat_img');
		$cattopage_wud_java = get_option('cattopage_wud_java');
		$cattopage_wud_pause_img = get_option('cattopage_wud_pause_img');
		$cattopage_wud_exp_yes = get_option('cattopage_wud_exp_yes');
		$cattopage_wud_exp_lenght = get_option('cattopage_wud_exp_lenght');
		$cattopage_wud_hatom = get_option('cattopage_wud_hatom');	
		$cattopage_wud_rss = get_option('cattopage_wud_rss');	
		$cattopage_wud_hardcoded = get_option('cattopage_wud_hardcoded');
		$cattopage_wud_widget_title1 = get_option('cattopage_wud_widget_title1');
		$cattopage_wud_widget_title2 = get_option('cattopage_wud_widget_title2');
		$cattopage_wud_widget_title3 = get_option('cattopage_wud_widget_title3');	
		$cattopage_wud_widget_title4 = get_option('cattopage_wud_widget_title4');
		$cattopage_wud_custom_post0 = get_option('cattopage_wud_custom_post0');
		$cattopage_wud_custom_post1 = get_option('cattopage_wud_custom_post1');
		$cattopage_wud_custom_post2 = get_option('cattopage_wud_custom_post2');
	}
	
		wp_nonce_field('cattopage-wud-check','cattopage-wud-save'); 
		echo "<input type='hidden' name='ctp_opt_hidden' value='Y'>";
	

//LEFT START
	echo "<div class='leftdiv'>";
	
		echo "<div class='ctp-wud-wrap-a'>";
			echo '<strong><label>'.__("Add Categories to pages", "category-to-pages-wud").' </label></strong><br><br>';
			echo '<select class="ctp-select" id="cattopage" name="cattopage_wud_cat">';
			echo     '<option value="post"'; if ( $cattopage_wud_cat == "post" ){echo 'selected="selected"';} echo '>Use WP Post Categories for Pages</option>';
			echo     '<option value="page"'; if ( $cattopage_wud_cat == "page" ){echo 'selected="selected"';} echo '>Enable Unique Page Categories</option>';
			echo     '<option value="none"'; if ( $cattopage_wud_cat == "none" ){echo 'selected="selected"';} echo '>Disable Page Categories</option>';
			echo '</select>';	
		echo '</div>';

		echo "<div class='ctp-wud-wrap-b'>";
			echo '<label><b>'.__("Show the Category/Tag Title on the Page.", "category-to-pages-wud").'</b></label><br><br>';
			echo'<div id="ctp-wud-tip"><b class="ctp-trigger">?</b><div class="tooltip">'.__("Show the categories and tags, just BELOW the Page Title or on TOP of your Page Content", "category-to-pages-wud").'.<br><br>'.__("Depending the Theme you are using, you can choose here where to place the Categories and Tags.", "category-to-pages-wud", "category-to-pages-wud").'</div></div>';				
			echo '<label></label><input id="cmn-toggle-3" class="cmn-toggle cmn-toggle-round" name="cattopage_wud_title" type="checkbox" value="1" '. checked( $cattopage_wud_title, "page", false ) .'/><label for="cmn-toggle-3" class="ctp-wud-right"></label>';
			
			echo '<label>'.__("Activate", "category-to-pages-wud").' :</label><br><br>';
			echo '<select class="ctp-select" name="cattopage_wud_index_pos" style="float:right;">';
			echo     '<option value="0"'; if ( $cattopage_wud_index_pos == "0" ){echo 'selected="selected"';} echo '>Below the Title</option>';
			echo     '<option value="1"'; if ( $cattopage_wud_index_pos == "1" ){echo 'selected="selected"';} echo '>Above the Content</option>';
			echo     '<option value="2"'; if ( $cattopage_wud_index_pos == "2" ){echo 'selected="selected"';} echo '>After the Content</option>';
			echo '</select><br><br>';
		
			if($cattopage_wud_cat == 'page'){
				echo'<div id="ctp-wud-tip"><b class="ctp-trigger">?</b><div class="tooltip">'.__("Show Featured Category Images instead text only", "category-to-pages-wud").'.<br><br>'.__("Please, check first the settings from 'Activate Featured Category Images', before activating this option.<br><br>Please notice that this feature only can be used by options: Above or After the content.", "category-to-pages-wud", "category-to-pages-wud").'</div></div>';				
				echo '<label>'.__("Use Featured Category Images", "category-to-pages-wud").' </label><input id="cmn-toggle-16" class="cmn-toggle cmn-toggle-round" name="cattopage_wud_txt_cat_img" type="checkbox" value="1" '. checked( $cattopage_wud_txt_cat_img, "1", false ) .'/><label for="cmn-toggle-16" class="ctp-wud-right"></label>';
			}
		if($cattopage_wud_txt_cat_img == 0){		
			echo '<br><br><select class="ctp-select" name="cattopage_wud_title_h1" style="float:right;">';
		}
		else{
			echo '<select class="ctp-select" name="cattopage_wud_title_h1" style="float:right; display: none !important;">';
		}
			echo     '<option value="p"'; if ( $cattopage_wud_title_h1 == "p" ){echo 'selected="selected"';} echo '>Use Font Size</option>';
			echo     '<option value="h1"'; if ( $cattopage_wud_title_h1 == "h1" ){echo 'selected="selected"';} echo '>H1</option>';
			echo     '<option value="h2"'; if ( $cattopage_wud_title_h1 == "h2" ){echo 'selected="selected"';} echo '>H2</option>';
			echo     '<option value="h3"'; if ( $cattopage_wud_title_h1 == "h3" ){echo 'selected="selected"';} echo '>H3</option>';
			echo '</select>';		

		if($cattopage_wud_txt_cat_img == 0){		
			echo '<br><label>'.__("Font size (if not H1,H2 or H3)", "category-to-pages-wud").' </label><br><input class="ctp-wud-right ctp-select" name="cattopage_wud_title_size" type="number"  min="12" max="34" value="'.$cattopage_wud_title_size.'"/><br>';
		}
		else{
			echo '<input class="ctp-wud-right ctp-select" name="cattopage_wud_title_size" style="display: none !important;" type="number"  min="12" max="34" value="'.$cattopage_wud_title_size.'"/>';
		}			
				
		if($cattopage_wud_txt_cat_img == 0){	
			echo '<br><label>'.__("Font Family", "category-to-pages-wud").'</label> ';
			echo '<select class="ctp-select" name="cattopage_wud_title_font" style="float:right;">';
		}
		else{
			echo '<select class="ctp-select" name="cattopage_wud_title_font" style="float:right; display: none !important;">';
		}
			echo     '<option value="inherit"'; if ( $cattopage_wud_title_font == "inherit" ){echo 'selected="selected"';} echo '>Inherit</option>';
			echo     '<option value="initial"'; if ( $cattopage_wud_title_font == "initial" ){echo 'selected="selected"';} echo '>Initial</option>';
			echo     '<option value="Arial"'; if ( $cattopage_wud_title_font == "Arial" ){echo 'selected="selected"';} echo '>Arial</option>';
			echo     '<option value="Times New Roman"'; if ( $cattopage_wud_title_font == "Times New Roman" ){echo 'selected="selected"';} echo '>Times New Roman</option>';
			echo     '<option value="Georgia"'; if ( $cattopage_wud_title_font == "Georgia" ){echo 'selected="selected"';} echo '>Georgia</option>';
			echo     '<option value="Serif"'; if ( $cattopage_wud_title_font == "Serif" ){echo 'selected="selected"';} echo '>Serif</option>';
			echo     '<option value="Helvetica"'; if ( $cattopage_wud_title_font == "Helvetica" ){echo 'selected="selected"';} echo '>Helvetica</option>';
			echo     '<option value="Lucida Sans Unicode"'; if ( $cattopage_wud_title_font == "Lucida Sans Unicode" ){echo 'selected="selected"';} echo '>Lucida Sans Unicode</option>';
			echo     '<option value="Tahoma"'; if ( $cattopage_wud_title_font == "Tahoma" ){echo 'selected="selected"';} echo '>Tahoma</option>';
			echo     '<option value="Verdana"'; if ( $cattopage_wud_title_font == "Verdana" ){echo 'selected="selected"';} echo '>Verdana</option>';
			echo     '<option value="Courier New"'; if ( $cattopage_wud_title_font == "Courier New" ){echo 'selected="selected"';} echo '>Courier New</option>';
			echo     '<option value="Lucida Console"'; if ( $cattopage_wud_title_font == "Lucida Console" ){echo 'selected="selected"';} echo '>Lucida Console</option>';
			echo '</select>';
		echo "<br></div>";
		
		if($cattopage_wud_cat == 'page'){
			echo "<div class='ctp-wud-wrap-b'>";
		}
		else{
			echo "<div class='ctp-wud-wrap-b' style='display: none !important;'>";
		}
			echo '<label><strong>'.__("Featured Category Images", "category-to-pages-wud").'</strong><br>'.__("If enabled this can be used by:", "category-to-pages-wud").'<br>'.__(" -> Show the Category/Tag Title on the Page", "category-to-pages-wud").'<br>'.__(" -> shortcode [currentcattag img=\"1\"]", "category-to-pages-wud").'<br><br>';
			echo'<div id="ctp-wud-tip"><b class="ctp-trigger">?</b><div class="tooltip">'.__("Activate Featured Category Images", "category-to-pages-wud").'.<br>'.__("If Activated: By each Page Category, you can select a featured image.", "category-to-pages-wud", "category-to-pages-wud").'</div></div>';
			echo '<label>'.__("Activate Featured Category Images", "category-to-pages-wud").' </label><input id="cmn-toggle-14" class="cmn-toggle cmn-toggle-round" name="cattopage_wud_cat_img" type="checkbox" value="1" '. checked( $cattopage_wud_cat_img, "1", false ) .'/><label for="cmn-toggle-14" class="ctp-wud-right"></label><br><br>';
			echo'<div id="ctp-wud-tip"><b class="ctp-trigger">?</b><div class="tooltip">'.__("Activate Javascript for Featured Category Images", "category-to-pages-wud").'.<br>'.__("Activate only if the Featured Category Images, are not visible or scrolling is not working on the production side.", "category-to-pages-wud", "category-to-pages-wud").'</div></div>';
			echo '<label>'.__("Activate Javascript", "category-to-pages-wud").' </label><input id="cmn-toggle-15" class="cmn-toggle cmn-toggle-round" name="cattopage_wud_java" type="checkbox" value="1" '. checked( $cattopage_wud_java, "1", false ) .'/><label for="cmn-toggle-15" class="ctp-wud-right"></label><br><br>';
			echo '<label>'.__("Auto Scroll Images", "category-to-pages-wud").' </label><input id="cmn-toggle-12" class="cmn-toggle cmn-toggle-round" name="cattopage_wud_scroll_img" type="checkbox" value="1" '. checked( $cattopage_wud_scroll_img, "1", false ) .'/><label for="cmn-toggle-12" class="ctp-wud-right"></label><br><br>';
			echo '<label>'.__("Pause on Hover", "category-to-pages-wud").' </label><input id="cmn-toggle-13" class="cmn-toggle cmn-toggle-round" name="cattopage_wud_pause_img" type="checkbox" value="1" '. checked( $cattopage_wud_pause_img, "1", false ) .'/><label for="cmn-toggle-13" class="ctp-wud-right"></label><br><br>';
			echo '<label>'.__("Auto Scroll Interval", "category-to-pages-wud").'</label> ';
			echo '<select class="ctp-select" name="cattopage_wud_image_interval" style="float:right;">';
			echo     '<option value="1000"'; if ( $cattopage_wud_image_interval == "1000" ){echo 'selected="selected"';} echo '>1000</option>';
			echo     '<option value="2000"'; if ( $cattopage_wud_image_interval == "2000" ){echo 'selected="selected"';} echo '>2000</option>';
			echo     '<option value="3000"'; if ( $cattopage_wud_image_interval == "3000" ){echo 'selected="selected"';} echo '>3000</option>';
			echo     '<option value="4000"'; if ( $cattopage_wud_image_interval == "4000" ){echo 'selected="selected"';} echo '>4000</option>';
			echo     '<option value="5000"'; if ( $cattopage_wud_image_interval == "5000" ){echo 'selected="selected"';} echo '>5000</option>';
			echo     '<option value="7000"'; if ( $cattopage_wud_image_interval == "7000" ){echo 'selected="selected"';} echo '>7000</option>';
			echo     '<option value="9000"'; if ( $cattopage_wud_image_interval == "9000" ){echo 'selected="selected"';} echo '>9000</option>';
			echo '</select><br>';
			
			echo '<br><label>'.__("Category Images & Text Height", "category-to-pages-wud").' </label><input class="ctp-wud-right ctp-select" name="cattopage_wud_image_size" type="number"  min="150" max="500" value="'.$cattopage_wud_image_size.'"/><br>';
			echo '<br><label>'.__("Category Images Font Size", "category-to-pages-wud").' </label><input class="ctp-wud-right ctp-select" name="cattopage_wud_image_title_size" type="number"  min="12" max="34" value="'.$cattopage_wud_image_title_size.'"/><br>';
			echo '<br><label>'.__("Category Images Font Family", "category-to-pages-wud").'</label> ';
			echo '<select class="ctp-select" name="cattopage_wud_image_title_font" style="float:right;">';
			echo     '<option value="inherit"'; if ( $cattopage_wud_image_title_font == "inherit" ){echo 'selected="selected"';} echo '>Inherit</option>';
			echo     '<option value="initial"'; if ( $cattopage_wud_image_title_font == "initial" ){echo 'selected="selected"';} echo '>Initial</option>';
			echo     '<option value="Arial"'; if ( $cattopage_wud_image_title_font == "Arial" ){echo 'selected="selected"';} echo '>Arial</option>';
			echo     '<option value="Times New Roman"'; if ( $cattopage_wud_image_title_font == "Times New Roman" ){echo 'selected="selected"';} echo '>Times New Roman</option>';
			echo     '<option value="Georgia"'; if ( $cattopage_wud_image_title_font == "Georgia" ){echo 'selected="selected"';} echo '>Georgia</option>';
			echo     '<option value="Serif"'; if ( $cattopage_wud_image_title_font == "Serif" ){echo 'selected="selected"';} echo '>Serif</option>';
			echo     '<option value="Helvetica"'; if ( $cattopage_wud_image_title_font == "Helvetica" ){echo 'selected="selected"';} echo '>Helvetica</option>';
			echo     '<option value="Lucida Sans Unicode"'; if ( $cattopage_wud_image_title_font == "Lucida Sans Unicode" ){echo 'selected="selected"';} echo '>Lucida Sans Unicode</option>';
			echo     '<option value="Tahoma"'; if ( $cattopage_wud_image_title_font == "Tahoma" ){echo 'selected="selected"';} echo '>Tahoma</option>';
			echo     '<option value="Verdana"'; if ( $cattopage_wud_image_title_font == "Verdana" ){echo 'selected="selected"';} echo '>Verdana</option>';
			echo     '<option value="Courier New"'; if ( $cattopage_wud_image_title_font == "Courier New" ){echo 'selected="selected"';} echo '>Courier New</option>';
			echo     '<option value="Lucida Console"'; if ( $cattopage_wud_image_title_font == "Lucida Console" ){echo 'selected="selected"';} echo '>Lucida Console</option>';
			echo '</select>';

			echo '<br><br><label>'.__("Image Size", "category-to-pages-wud").'</label> ';
			echo '<select class="ctp-select" name="cattopage_wud_image_select" style="float:right;">';
			echo     '<option value="thumbnail"'; if ( $cattopage_wud_image_select == "thumbnail" ){echo 'selected="selected"';} echo '>Thumbnail</option>';
			echo     '<option value="medium"'; if ( $cattopage_wud_image_select == "medium" ){echo 'selected="selected"';} echo '>Medium</option>';
			echo     '<option value="large"'; if ( $cattopage_wud_image_select == "large" ){echo 'selected="selected"';} echo '>Large</option>';;
			echo '</select>';
			
		echo "<br></div>";

		echo "<div class='ctp-wud-wrap-c'>";
			echo'<div id="ctp-wud-tip"><b class="ctp-trigger">?</b><div class="tooltip">'.__("If activated", "category-to-pages-wud").':<br>'.__("Unique excerpts are available for pages and posts", "category-to-pages-wud").'.<br><br>'.__("If not activated", "category-to-pages-wud").':<br>'.__("Excerpts are only available for posts (WordPress standard).", "category-to-pages-wud").'</div></div>';
			echo '<label>'.__("Use excerpts for pages", "category-to-pages-wud").' </label><input id="cmn-toggle-8" class="cmn-toggle cmn-toggle-round" name="cattopage_wud_exp_yes" type="checkbox" value="1" '. checked( $cattopage_wud_exp_yes, "1", false ) .'/><label for="cmn-toggle-8" class="ctp-wud-right"></label>';
			echo '<br><br>';
			echo '<label>'.__("Excerpt length in words (max.: 150)", "category-to-pages-wud").' </label><input class="ctp-wud-right ctp-select" name="cattopage_wud_exp_lenght" type="number"  min="5" max="150" value="'.$cattopage_wud_exp_lenght.'"/>';
		echo "<br><br></div>";
		
		echo "<div class='ctp-wud-wrap-e'>";
			echo'<div id="ctp-wud-tip"><b class="ctp-trigger">?</b><div class="tooltip">'.__("When Categories/Tags are not unique and WordPress permalink  is set to: /%category%/%postname%/", "category-to-pages-wud").' <br><br>'.__("If activated", "category-to-pages-wud").':<br>'.__("You can edit the page URL (WordPress standard)", "category-to-pages-wud").'.<br><br>'.__("If not activated", "category-to-pages-wud").':<br>'.__("A page URL name contains the hardcoded category and is not Editable.", "category-to-pages-wud").'</div></div>';
			echo '<label><b>'.__("Disable 'Page category/tag' in the URL", "category-to-pages-wud").' </b></label><input id="cmn-toggle-9" class="cmn-toggle cmn-toggle-round" name="cattopage_wud_hardcoded" type="checkbox" value="1" '. checked( $cattopage_wud_hardcoded, "1", false ) .'/><label for="cmn-toggle-9" class="ctp-wud-right"></label>';
		echo "<br></div>";
		
			
	echo "</div>";	
//LEFT END	
	
//RIGHT START
	echo "<div class='rightdiv'>";
	
		echo "<div class='ctp-wud-wrap-2'>";
			echo '<strong><label>'.__("Add Tags to pages", "category-to-pages-wud").'</label></strong><br><br>';
			echo '<select class="ctp-select" name="cattopage_wud_tag">';
			echo     '<option value="post"'; if ( $cattopage_wud_tag == "post" ){echo 'selected="selected"';} echo '>Use WP Post Tags for Pages</option>';
			echo     '<option value="page"'; if ( $cattopage_wud_tag == "page" ){echo 'selected="selected"';} echo '>Enable Unique Page Tags</option>';
			echo     '<option value="none"'; if ( $cattopage_wud_tag == "none" ){echo 'selected="selected"';} echo '>Disable Page Tags</option>';
			echo '</select>';	
		echo '</div>';	
		
		echo "<div class='ctp-wud-wrap-3'>";
			echo ''.__("Please visit our website, where ShortCodes are explained <a href='https://wud-plugins.com/category-to-pages-how-to-use/'  target='_blank'>here</a>", "category-to-pages-wud");
			echo '<b class="ctp-info">i</b>';
		echo '<br></div>';	

		echo "<div class='ctp-wud-wrap-4'>";
			echo '<label><b><u>'.__("Widget", "category-to-pages-wud").'</u> '.__("or shortcode [wudwidget]", "category-to-pages-wud").' </b></label><br><br>';
			echo'<div id="ctp-wud-tip"><b class="ctp-trigger">?</b><div class="tooltip">'.__("If activated", "category-to-pages-wud").':<br>'.__("A list from maximum 5 page descriptions with URL's are displayed per Category and/or Tag", "category-to-pages-wud").'.<br><br>'.__("If not activated", "category-to-pages-wud").':<br>'.__("No pages descriptions with URL's are displayed.", "category-to-pages-wud").'</div></div>';		
			echo '<label>'.__("Show Category and Tag pages", "category-to-pages-wud").'  </label><input id="cmn-toggle-5" class="cmn-toggle cmn-toggle-round" name="cattopage_wud_widget_option1" type="checkbox" value="1" '. checked( $cattopage_wud_widget_option1, "1", false ) .'/><label for="cmn-toggle-5" class="ctp-wud-right"></label>';
			echo '<br><br>';
			echo'<div id="ctp-wud-tip"><b class="ctp-trigger">?</b><div class="tooltip">'.__("If activated", "category-to-pages-wud").':<br>'.__("A button will appear to show the pages descriptions with URL's.", "category-to-pages-wud").'<br></div></div>';
			echo '<label>'.__("Show a button to display the pages", "category-to-pages-wud").'  </label><input id="cmn-toggle-6" class="cmn-toggle cmn-toggle-round" name="cattopage_wud_widget_option2" type="checkbox" value="1" '. checked( $cattopage_wud_widget_option2, "1", false ) .'/><label for="cmn-toggle-6" class="ctp-wud-right"></label>';
			echo '<br><br>';

			
			echo '<label>'.__("Quantity pages to display (max.: 50)", "category-to-pages-wud").'  </label><input class="ctp-wud-right ctp-select" name="cattopage_wud_quantity" type="number"  min="5" max="50" value="'.$cattopage_wud_quantity.'"/><br><br>';
			echo'<div id="ctp-wud-tip"><b class="ctp-trigger">?</b><div class="tooltip">'.__("If activated", "category-to-pages-wud").':<br>'.__("It shows the parent categories pages only", "category-to-pages-wud").'.<br>'.__("If not activated", "category-to-pages-wud").':<br>'.__("It shows the parent and child (sub) categories pages together.", "category-to-pages-wud").'<br></div></div>';
			echo '<label>'.__("Show only Parent Categories", "category-to-pages-wud").' </label><input id="cmn-toggle-7" class="cmn-toggle cmn-toggle-round" name="cattopage_wud_widget_parent" type="checkbox" value="1" '. checked( $cattopage_wud_widget_parent, "1", false ) .'/><label for="cmn-toggle-7" class="ctp-wud-right"></label>';
			echo '<br><br>';
			echo '<label>'.__("Page Category Description", "category-to-pages-wud").' </label><input class="ctp-wud-right ctp-select" name="cattopage_wud_widget_title1" type="text" value="'.$cattopage_wud_widget_title1.'"/><br><br>';
			echo '<label>'.__("Page Tag Description", "category-to-pages-wud").'  </label><input class="ctp-wud-right ctp-select" name="cattopage_wud_widget_title2" type="text" value="'.$cattopage_wud_widget_title2.'"/><br><br>';	
			echo '<label>'.__("Related Post Description", "category-to-pages-wud").' </label><input class="ctp-wud-right ctp-select" name="cattopage_wud_widget_title3" type="text" value="'.$cattopage_wud_widget_title3.'"/><br><br>';
			echo '<label>'.__("Related Cat. Description", "category-to-pages-wud").' </label><input class="ctp-wud-right ctp-select" name="cattopage_wud_widget_title4" type="text" value="'.$cattopage_wud_widget_title4.'"/>';						
		echo "<br></div>";

		echo "<div class='ctp-wud-wrap-g'>";
			echo'<div id="ctp-wud-tip"><b class="ctp-trigger">?</b><div class="tooltip">'.__("If activated", "category-to-pages-wud").':<br>'.__("Custom post type will be available in our shortcut or widget results", "category-to-pages-wud").'.<br><br>'.__("If not activated", "category-to-pages-wud").':<br>'.__("Custom Post types are not included in our shortcode or widget results (WordPress standard).", "category-to-pages-wud").'</div></div>';
			echo '<label><strong>'.__("Custom Post type", "category-to-pages-wud").'</strong></label><br><br>';
			echo '<label>'.__("Custom Post type 1", "category-to-pages-wud").' </label><input class="ctp-wud-right ctp-select" name="cattopage_wud_custom_post0" type="text" value="'.$cattopage_wud_custom_post0.'"/>';
			echo '<br><br>';
			echo '<label>'.__("Custom Post type 2", "category-to-pages-wud").' </label><input class="ctp-wud-right ctp-select" name="cattopage_wud_custom_post1" type="text" value="'.$cattopage_wud_custom_post1.'"/>';
			echo '<br><br>';
			echo '<label>'.__("Custom Post type 3", "category-to-pages-wud").' </label><input class="ctp-wud-right ctp-select" name="cattopage_wud_custom_post2" type="text" value="'.$cattopage_wud_custom_post2.'"/>';
			echo '<br><br><a href="https://wordpress.org/plugins/search/Custom+Content+Types+and+Fields/" target="_blank">'.__("Read more @ WordPress", "category-to-pages-wud").'</a>';		
		echo "<br><br></div>";

		
		echo "<div class='ctp-wud-wrap-f'>";
			echo'<div id="ctp-wud-tip"><b class="ctp-trigger">?</b><div class="tooltip">'.__("Hatom: Fixes errors in Google Webmaster Tools", "category-to-pages-wud").' <br><br>'.__("If activated","category-to-pages-wud").':<br>'.__("It wil display (in hidden format) Hatom data to Google", "category-to-pages-wud").'.<br>'.__("Hatom data = post/page title, date last updated and author vcard", "category-to-pages-wud").'.</br><br>'.__("If not activated", "category-to-pages-wud").':<br>'.__("Category to Page WUD does not force the hidden Hatom data.", "category-to-pages-wud").'</div></div>';
			echo '<label><b>'.__("Enable Page & Post Hatom data for Google", "category-to-pages-wud").' </b></label><input id="cmn-toggle-10" class="cmn-toggle cmn-toggle-round" name="cattopage_wud_hatom" type="checkbox" value="1" '. checked( $cattopage_wud_hatom, "1", false ) .'/><label for="cmn-toggle-10" class="ctp-wud-right"></label>';
			echo '<br><br><a href="https://productforums.google.com/forum/#!topic/webmasters/UpxVsTjQexk;context-place=topicsearchin/webmasters/category$3Astructured-data%7Csort:relevance%7Cspell:false" target="_blank">'.__("Read more @ Google", "category-to-pages-wud").'</a>';
		echo "<br></div>";

		echo "<div class='ctp-wud-wrap-5'>";
			echo'<div id="ctp-wud-tip"><b class="ctp-trigger">?</b><div class="tooltip">'.__("RSS FEEDS for pages", "category-to-pages-wud").' <br><br>'.__("If activated","category-to-pages-wud").':<br>'.__("It wil display pages in RSS FEED", "category-to-pages-wud").'<br>'.__("If not activated", "category-to-pages-wud").':<br>'.__("Category to Page WUD does not force RSS FEED for pages.", "category-to-pages-wud").'</div></div>';
			echo '<label><b>'.__("Enable RSS FEED for pages", "category-to-pages-wud").' </b></label><input id="cmn-toggle-11" class="cmn-toggle cmn-toggle-round" name="cattopage_wud_rss" type="checkbox" value="1" '. checked( $cattopage_wud_rss, "1", false ) .'/><label for="cmn-toggle-11" class="ctp-wud-right"></label>';
		echo "<br></div>";
		
	echo "</div>";
//RIGHT END	


		echo '<div class="clear"></div>';
	// ADMIN Submit		
		echo '<input type="submit" name="Submit" class="button-primary" id="ctp-wud-adm-subm" value="'.__("Save Changes", "category-to-pages-wud").'" />';
		echo "</form>";
		echo '<a href="https://wud-plugins.com" class="button-primary" id="ctp-adm-wud" target="_blank">'.__("Visit our website", "category-to-pages-wud").'</a>  <a href="https://wordpress.org/support/plugin/category-to-pages-wud" class="button-primary" id="ctp-adm-wud" target="_blank">'.__("Get FREE Support", "category-to-pages-wud").'</a>';
		echo ' <a href="https://wud-plugins.com/contact-us/" class="button-primary" id="ctp-adm-wud-or" target="_blank">'.__("Contact", "category-to-pages-wud").'</a><br>';
		echo '</div>';	
	
} // END cattopage_wud_settings_page

} // END check function



?>
