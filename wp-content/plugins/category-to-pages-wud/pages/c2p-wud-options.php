<?php
/* 
=== Category to Pages WUD Options ===
=> Excerpt for page
=> Cat/Tag in title
=> Cat/Tag in post

*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
//==============================================================================//


//Allow using shortcodes in a widget
function cattopage_wud_widget_text( $widget_text ){
	$pattern = get_shortcode_regex();
	if ( preg_match_all( '/'. $pattern .'/s', $widget_text, $matches )&& array_key_exists( 2, $matches ) ){
         add_filter( 'widget_text', 'shortcode_unautop');
		 add_filter( 'widget_text', 'do_shortcode');	
	}
    return $widget_text;
}

// Inject HATOM data
if(!function_exists('cattopage_wud_hatom_data')){
	function cattopage_wud_hatom_data($content) {
	   $t = get_the_modified_time('F jS, Y');
	   $author = get_the_author();
	   $title = get_the_title();
		if ((!is_home() && !is_front_page()) && (is_singular() || is_archive() || is_single() || is_page())) {
			$content .= '<div class="hatom-extra" id="wud-plugins" style="display:none; visibility:hidden; color:red;"><span class="entry-title">'.$title.'</span> was last modified: <span class="updated"> '.$t.'</span> by <span class="author vcard"><span class="fn">'.$author.'</span></span></div>';
		}
		return $content;
	}
}

//If 'Use excerpts for pages:' is activated
function cattopage_wud_add_excerpts_to_pages() {
	if(get_option('cattopage_wud_exp_yes')==1){
		add_post_type_support( 'page', 'excerpt' );
	}
}

//If 'Use excerpts for pages:' and if is archive page and if is pages
function cattopage_wud_change_to_excerpt($content) {
	global $post, $excerpt;
	if ( is_archive() && get_option('cattopage_wud_exp_yes')==1 && $post->post_type =="page" ) {
		//Unique page excerpt
		if( $post->post_excerpt && post_type_supports( 'page', 'excerpt' )) {
			$ctp_excerpt = $post->post_excerpt;
			$pattern = '~http(s)?://[^\s]*~i';
			$content = preg_replace($pattern, '', $ctp_excerpt);			
		}
		//Make excerpt from content
		else{
			$ctp_excerpt = strip_shortcodes ( wp_trim_words ( $content, get_option('cattopage_wud_exp_lenght') ) );
			$pattern = '~http(s)?://[^\s]*~i';
			$content = preg_replace($pattern, '', $ctp_excerpt);		
		}
	}
	return $content;
}

//Show Category and ord tag title on pages IN TITLE
if(!function_exists('cattopage_wud_titles')){
	function cattopage_wud_titles( $title , $id = null ) {
		
		if(is_singular('page')) {
			global $post;
		
		$cats_title = NULL;
		$tags_title = NULL;		
		//Font Size
		$sizect = get_option('cattopage_wud_title_size');
		if(empty($sizect)){$sizect="12";}
		//Line Size
		$sizel=$sizect+1;
		//Font Family
		$fontct = get_option('cattopage_wud_title_font');
		if(empty($fontct)){$fontct="inherit";}

		//p or h1 to h3
		$pp = get_option('cattopage_wud_title_h1');
		if($pp == 'p'){ 
			$ppstyle = "style= 'font-family:".$fontct."; font-size: ".$sizect."px; line-height: ".$sizel."px; margin: 0px; margin-top: 4px;'"; 
			$iconsize = "style='font-size: ".$sizect."px;'";
		}
		else{
			$ppstyle = "";
			$iconsize = "";			
		}
		
		if(!empty($post)){	
					if(get_option('cattopage_wud_cat')=="page"){
						$cats_title = 	get_the_term_list( $post->ID, 'categories', '', ', ' );
					}
					if(get_option('cattopage_wud_tag')=="page"){
						$tags_title = 	get_the_term_list( $post->ID, 'tags', '', ', ' );
					}
					if(get_option('cattopage_wud_tag')=="post" ){
						$tags_title = 	get_the_term_list( $post->ID, 'post_tag', '', ', ' );
					}	
					if(get_option('cattopage_wud_cat')=="post"){
						$cats_title = 	get_the_term_list( $post->ID, 'category', '', ', ' );
					}					
		}	
		//If nothing is in the loop ... return
		if(!in_the_loop()){return $title;}

		//If Oké, display the Title('s)
		 if(get_option('cattopage_wud_title')=='page'){
				if(!empty($cats_title)){
					$cats_title = "<".$pp." class='ctp-wud-title' ".$ppstyle."><span class='wudicon wudicon-category' ".$iconsize."> </span>".$cats_title."</".$pp.">";
				}
				if(!empty($tags_title)){
					$tags_title = "<".$pp." class='ctp-wud-title' ".$ppstyle."><span class='wudicon wudicon-tag' ".$iconsize."> </span>".$tags_title."</".$pp.">";
				}
			//Build the new Title ...
			$title .= $cats_title.$tags_title;
		} 
		}	
		return $title;
	}
}

//Show Category and ord tag title on pages ON TOP OR IN BOTTOM OF THE POST
if(!function_exists('cattopage_wud_titles_in_page')){
	function cattopage_wud_titles_in_page($content) {	
	   if(is_singular('page')) {	   
			global $post;
		
		$cats_title = NULL;
		$tags_title = NULL;	
		$catstags = NULL;
		$categories = NULL;
		$cat_images_wud_options = NULL;
		
		//Font Size
		$sizect = get_option('cattopage_wud_title_size');
		if(empty($sizect)){$sizect="12";}
		//Line Size
		$sizel=$sizect+1;
		//Font Family
		$fontct = get_option('cattopage_wud_title_font');
		if(empty($fontct)){$fontct="inherit";}

				//Image Font Size
		$sizect_img = get_option('cattopage_wud_image_title_size');
		if(empty($sizect_img)){$sizect_img="12";}
		//Image Line Size
		$sizel_img=$sizect_img+1;
		//Image Font Family
		$fontct_img = get_option('cattopage_wud_image_title_font');
		if(empty($fontct_img)){$fontct_img="inherit";}
		//Image WP size
		$wud_img_size = get_option('cattopage_wud_image_select');
		if(empty($wud_img_size)){$fontct_img="medium";}
		
		//p or h1 to h3
		$pp = get_option('cattopage_wud_title_h1');
		if($pp == 'p'){ 
			$ppstyle = "style= 'font-family:".$fontct."; font-size: ".$sizect."px; line-height: ".$sizel."px; margin: 0px; margin-top: 4px;'"; 
			$iconsize = "style='font-size: ".$sizect."px;'";
		}
		else{
			$ppstyle = "";
			$iconsize = "";			
		}
		
		//If images used
		if( get_option('cattopage_wud_txt_cat_img') == 1 ){
			$pp_image_style = "style= 'font-family:".$fontct_img."; font-size: ".$sizect_img."px; line-height: ".$sizel_img."px; margin: 0px; margin-top: 4px; font-weight: bold;'";
			$wud_image_height = get_option('cattopage_wud_image_size');	
			$wud_total_size = $wud_image_height + 50;
		}
		
		if(!empty($post)){	
					if(get_option('cattopage_wud_cat')=="page"){
						$cats_title = 	get_the_term_list( $post->ID, 'categories', '', ', ' );
					}
					if(get_option('cattopage_wud_tag')=="page"){
						$tags_title = 	get_the_term_list( $post->ID, 'tags', '', ', ' );
					}
					if(get_option('cattopage_wud_tag')=="post" ){
						$tags_title = 	get_the_term_list( $post->ID, 'post_tag', '', ', ' );
					}	
					if(get_option('cattopage_wud_cat')=="post"){
						$cats_title = 	get_the_term_list( $post->ID, 'category', '', ', ' );
					}
		}	

		//If images used
		if( get_option('cattopage_wud_txt_cat_img') == 1 ){
				$categories = get_the_terms($post->ID,'categories');
				if( empty($categories) ){ return $content; }
				$categories_keys = array_keys($categories);
				$last_categories_key = array_pop($categories_keys);
				
				$cat_images_wud_options = '<div class="wud_main_cat_img">';
				$cat_images_wud_options .= '<section id="ctp_wud_cat_img" class="slider" style="height: '.$wud_total_size.'px">';
					foreach ($categories as $key => $value) {
					   $cat_ID_img = $value->term_id;
					   $image_id = NULL;
					   $image_id = get_term_meta ( $cat_ID_img, 'category-image-id', true );
						   if($image_id == "" || $image_id == NULL ){
								$image_to_display = plugin_dir_url( dirname( __FILE__ ) ) . "images/blossom.jpg";   
						   }
						   else{
							   if (isset($image_to_display[0])) { 
									$image_to_display = wp_get_attachment_image_src( $image_id, $wud_img_size);
									$image_to_display = $image_to_display[0];
							   }
							   else{
									$image_to_display = plugin_dir_url( dirname( __FILE__ ) ) . "images/blossom.jpg";
							   }
						   }
								$cat_images_wud_options .= '<a href="'.esc_url(get_tag_link($value->term_id)).'" class="'.$value->name.'" style="text-decoration: none; box-shadow: none; background-image: url(\''.$image_to_display.'\'); height: '.$wud_image_height.'px;"><p '.$pp_image_style.'>'.$value->name.'</p></a>';

							if ($key != $last_categories_key){
							  //last picture found
							}			
					 }
			$cat_images_wud_options .= '</section>';    
			$cat_images_wud_options .= '</div><br>';
						
			if(get_option('cattopage_wud_scroll_img') == 1){ $cattopage_wud_scroll_img = 'true'; }
			else{ $cattopage_wud_scroll_img = 'false'; }

			if(get_option('cattopage_wud_pause_img') == 1){ $cattopage_wud_pause_img = 'true'; }
			else{ $cattopage_wud_pause_img = 'false'; }

			if(get_option('cattopage_wud_image_interval') > 0){ $cattopage_wud_image_interval = get_option('cattopage_wud_image_interval'); }
			else{ $cattopage_wud_image_interval = '5000'; }
			
			$cat_images_wud_options .= '
				<script type="text/javascript">$(window).load(function() { $("#ctp_wud_cat_img").ctp_wud({ visibleItems: 4, itemsToScroll: 1, autoPlay: { enable: '.$cattopage_wud_scroll_img.', interval: '.$cattopage_wud_image_interval.', pauseOnHover: '.$cattopage_wud_pause_img.' } }); });</script>
			';
		}
	
		if( get_option('cattopage_wud_txt_cat_img') == 0 ){	
			//If Oké, display the Title('s)
			 if(get_option('cattopage_wud_title')=='page' ){ 
					if(!empty($cats_title)){
						$cats_title = "<".$pp." class='ctp-wud-title' ".$ppstyle."><span class='wudicon wudicon-category' ".$iconsize."> </span>".$cats_title."</".$pp.">";
					}
					if(!empty($tags_title)){
						$tags_title = "<".$pp." class='ctp-wud-title' ".$ppstyle."><span class='wudicon wudicon-tag' ".$iconsize."> </span>".$tags_title."</".$pp.">";
					}
				//Build the new Title ...
				$catstags = '<div style="margin-bottom:20px;">'.$cats_title.$tags_title.'</div>';
			}
			if (get_option('cattopage_wud_index_pos')==1 ){
				$content = $catstags.$content;
			}
			else{
				$content = $content.$catstags;
			}		
		}

		
	   }
	   if( get_option('cattopage_wud_txt_cat_img') == 1 ){
			if (get_option('cattopage_wud_index_pos')==1 ){
				
				return $cat_images_wud_options.$content;
			}
			else{
				return $content.$cat_images_wud_options;					
			}
	   }
	   else{
		  return $content; 
	   }
	}
}



?>
