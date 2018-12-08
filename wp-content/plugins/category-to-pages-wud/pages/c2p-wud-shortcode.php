<?php
/* 
=== Category to Pages WUD shortcodes===
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
//==============================================================================//

//Shortcode to show related posts and/or pages.
if(!function_exists('cattopage_wud_short_code_page_list')){
	function cattopage_wud_short_code_page_list($atts) {
		global $post;
		$max_posts = 50;
		$result = NULL;
		$ctp_title = get_option('cattopage_wud_widget_title3');
		$flat_cat = 0;
		$incl_cat = 0;
		$incl_cat_title = get_option('cattopage_wud_widget_title4');
		$taxo = "";
		$orderby = "title";
		$order = "ASC";
		
		if ( is_archive() ) {return;}
		$standard_post = array('page','post');
		$custom_post_type = array(get_option('cattopage_wud_custom_post0'), get_option('cattopage_wud_custom_post1'), get_option('cattopage_wud_custom_post2'));	
		$post_typ = array_merge($standard_post, $custom_post_type);
				
		if( get_option('cattopage_wud_cat') == "page" ){
			$taxo = "categories";
			$categories = get_the_terms( $post->ID, 'categories' );
			if(empty($categories)){	
				return;	
			}
			$category_id = $categories[0]->term_id;
			$post_categories = get_the_terms( $post->ID, 'categories' );			
		}
		elseif( get_option('cattopage_wud_cat') == "post" ){
			$taxo = "category";
			$categories = get_the_category();
			if(empty($categories)){	
				return;	
			}
			$category_id = $categories[0]->cat_ID;
			$post_categories = get_the_terms( $post->ID, 'category' );			
		}
		
		if($taxo == ""){
			return;
		}
		
		if(isset($atts["max"]) && $atts["max"]!='' ){			
			if(is_numeric($atts["max"]) && $atts["max"] > 0 && $atts["max"] < 50 && $atts["max"] == round($atts["max"], 0)){
				$max_posts = trim(filter_var($atts["max"], FILTER_SANITIZE_STRING));
			}
		}
		
		if(isset($atts["type"]) && $atts["type"]!='' ){
			if($atts["type"] == 'page'){
				$post_typ = array('page');
			}
			elseif($atts["type"] == 'post'){
				$post_typ = array('post');
			}
			elseif($atts["type"] == 'all'){
				$post_typ = array('page, post');
			}			
		}
		
		if(isset($atts["include"]) && $atts["include"]!='' ){
			if($atts["include"] == 'category'){
				$incl_cat = 1;
			}			
		}
		
		if(isset($atts["flat"]) && $atts["flat"]!='' ){			
			if(is_numeric($atts["flat"]) && $atts["flat"] > 0 && $atts["flat"] < 2 && $atts["flat"] == round($atts["flat"], 0)){
				$flat_cat = $atts["flat"];
			}
			else{
				return;
			}
		}

		if(isset($atts["title"]) && $atts["title"]!='' ){			
			if($atts["title"] > '' && strlen($atts["title"]) < 50 ){
				$ctp_title = $atts["title"];
			}
			else{
				return;
			}
		}

		if(isset($atts["sort"]) && $atts["sort"]!='' ){			
			if($atts["sort"] > '' && strlen($atts["sort"]) < 50 ){
				if ($atts["sort"] =="date+"){$orderby = "date"; $order = "ASC";}
				if ($atts["sort"] =="date-"){$orderby = "date"; $order = "DESC";}
				elseif ($atts["sort"] =="name+"){$orderby = "title"; $order = "ASC";}
				elseif ($atts["sort"] =="name-"){$orderby = "title"; $order = "DESC";}
				elseif ($atts["sort"] =="random"){$orderby = "rand"; $order = "";}
			}
			else{
				return;
			}
		}
		
		$current_post = $post->ID;
		$related_args = array(
			'post_type' => $post_typ,
			'posts_per_page' => $max_posts,
			'post__not_in' => array($post->ID),
			'orderby'=> $orderby, 
			'order' => $order,
			'tax_query'		   => array(array('taxonomy'  => $taxo, 'field'  => 'term_id', 'terms' => $category_id,)),
		);
		$related = new WP_Query( $related_args );
		
		if($incl_cat == 1){
			if ( ! empty( $post_categories ) && ! is_wp_error( $post_categories ) ) {
				if($incl_cat_title <> ""){$result .= "<div><strong>".$incl_cat_title."</strong><br>";}
				foreach ( $categories as $cats ) {
					$term_link = get_term_link( $cats->term_id );
					if($flat_cat == 1){
						$result .=  ' <a href="' . esc_url( $term_link ) . '">' . $cats->name . '</a> - ';
					}
					else{
						$result .=  '<li><a href="' . esc_url( $term_link ) . '">' . $cats->name . '</a></li>';
					}
				}
						if($ctp_title <> ""){$result .=  '<br><br>';}
						else{$result .=  '<br>';}
			}
		}
		
			
		
		if( $related->have_posts() ) :
			if($ctp_title <> ""){$result .= "<div><strong>".$ctp_title."</strong><br>";}
		while( $related->have_posts() ): $related->the_post(); 
		foreach ( $related as $post_found ) {
			if($flat_cat == 1 && ! empty($post_found->post_title) ){
				$result .= " <a href='" . esc_url( get_permalink() ) . "'>".$post_found->post_title."</a> - ";
			}
			elseif($flat_cat == 0 && ! empty($post_found->post_title) ){
				$result .= "<li><a href='" . esc_url( get_permalink() ) . "'>".$post_found->post_title."</a></li>";
			}
		}
		endwhile;
			$result .= "</div>";
		endif;		
		wp_reset_postdata();
			$result .=  '<br>';
			return $result;
	}
}

//Shortcode to show posts and/or pages from a category.
if(!function_exists('cattopage_wud_short_code_pages_list')){
	function cattopage_wud_short_code_pages_list($atts) {
		global $post;
		$max_posts = 50;
		$result = NULL;
		$category_id  = 0;
		$flat_cat = 0;
		$category_title = get_option('cattopage_wud_widget_title3');
		$post_typ = array('page');
		$taxo = "";
		$orderby = "title";
		$order = "ASC";
				
		if( get_option('cattopage_wud_cat') == "page" ){
			$taxo = "categories";
		}
		elseif( get_option('cattopage_wud_cat') == "post" ){
			$taxo = "category";			
		}
		
		if($taxo == ""){
			return;
		}
		if(isset($atts["max"]) && $atts["max"]!='' ){			
			if(is_numeric($atts["max"]) && $atts["max"] > 0 && $atts["max"] < 50 && $atts["max"] == round($atts["max"], 0)){
				$max_posts = trim(filter_var($atts["max"], FILTER_SANITIZE_STRING));
			}
		}

		if(isset($atts["cat"]) && $atts["cat"]!='' ){			
			if(is_numeric($atts["cat"]) && $atts["cat"] > 0 && $atts["cat"] < 5000 && $atts["cat"] == round($atts["cat"], 0)){
				$category_id = $atts["cat"];
			}
			else{
				return;
			}
		}

		if(isset($atts["flat"]) && $atts["flat"]!='' ){			
			if(is_numeric($atts["flat"]) && $atts["flat"] > 0 && $atts["flat"] < 2 && $atts["flat"] == round($atts["flat"], 0)){
				$flat_cat = $atts["flat"];
			}
			else{
				return;
			}
		}
		
		if(isset($atts["title"]) && $atts["title"]!='' ){			
			if($atts["title"] > '' && strlen($atts["title"]) < 50 ){
				$category_title = $atts["title"];
			}
			else{
				return;
			}
		}
		
		if(isset($atts["sort"]) && $atts["sort"]!='' ){			
			if($atts["sort"] > '' && strlen($atts["sort"]) < 50 ){
				if ($atts["sort"] =="date+"){$orderby = "date"; $order = "ASC";}
				if ($atts["sort"] =="date-"){$orderby = "date"; $order = "DESC";}
				elseif ($atts["sort"] =="name+"){$orderby = "title"; $order = "ASC";}
				elseif ($atts["sort"] =="name-"){$orderby = "title"; $order = "DESC";}
				elseif ($atts["sort"] =="random"){$orderby = "rand"; $order = "";}
			}
			else{
				return;
			}
		}
		
		$related_args = array(
			'post_type' => 'page',
			'posts_per_page' => $max_posts,
			'post__not_in' => array($post->ID),
			'orderby'=> $orderby, 
			'order' => $order,
			'tax_query'		   => array(array('taxonomy'  => $taxo, 'field'  => 'term_id', 'terms' => $category_id)),
		);
		$related = new WP_Query( $related_args );

		if( $related->have_posts() ) :
			if($category_title <> ""){$result .= "<div><strong>".$category_title."</strong><br>";}
		while( $related->have_posts() ): $related->the_post(); 
		foreach ( $related as $post_found ) {
			if($flat_cat == 1 && ! empty($post_found->post_title) ){
				$result .= " <a href='" . esc_url( get_permalink() ) . "'>".$post_found->post_title."</a> - ";
			}
			elseif($flat_cat == 0 && ! empty($post_found->post_title) ){
				$result .= "<li><a href='" . esc_url( get_permalink() ) . "'>".$post_found->post_title."</a></li>";
			}
		}
		endwhile;
			$result .= "</div>";
		endif;	

		
		wp_reset_postdata();
		
			return $result;
	}
}
	
//Shortcode to show categories anywhere LIST
if(!function_exists('cattopage_wud_short_code_cat_list')){
	function cattopage_wud_short_code_cat_list($atts) {
		$ctp_show = "categories";
		$max_posts = 50;
		$flat_cat = 0;
		if( get_option('cattopage_wud_cat') == "post" ){
			$ctp_show = "category";
		}
		$ctp_title = get_option('cattopage_wud_widget_title1');
		$result = NULL;
		$orderby = "name";
		$order = "ASC";
				
		if(isset($atts["max"]) && $atts["max"]!='' ){			
			if(is_numeric($atts["max"]) && $atts["max"] > 0 && $atts["max"] < 50 && $atts["max"] == round($atts["max"], 0)){
				$max_posts = trim(filter_var($atts["max"], FILTER_SANITIZE_STRING));
			}
		}
		
		if(isset($atts["flat"]) && $atts["flat"]!='' ){			
			if(is_numeric($atts["flat"]) && $atts["flat"] > 0 && $atts["flat"] < 2 && $atts["flat"] == round($atts["flat"], 0)){
				$flat_cat = $atts["flat"];
			}
			else{
				return;
			}
		}

		if(isset($atts["title"]) && $atts["title"]!='' ){			
			if($atts["title"] > '' && strlen($atts["title"]) < 50 ){
				$ctp_title = $atts["title"];
			}
			else{
				return;
			}
		}
		
		if(isset($atts["sort"]) && $atts["sort"]!='' ){			
			if($atts["sort"] > '' && strlen($atts["sort"]) < 50 ){
				if ($atts["sort"] =="date+"){$orderby = "date"; $order = "ASC";}
				if ($atts["sort"] =="date-"){$orderby = "date"; $order = "DESC";}
				elseif ($atts["sort"] =="name+"){$orderby = "name"; $order = "ASC";}
				elseif ($atts["sort"] =="name-"){$orderby = "name"; $order = "DESC";}
				elseif ($atts["sort"] =="random"){$orderby = "rand"; $order = "";}
			}
			else{
				return;
			}
		}
		
		$standard_post = array('page','post');
		$custom_post_type = array(get_option('cattopage_wud_custom_post0'), get_option('cattopage_wud_custom_post1'), get_option('cattopage_wud_custom_post2'));	
		$post_typ = array_merge($standard_post, $custom_post_type);
		
		$categories = get_categories( array(
			'orderby' => 'name',
			'order'   => 'ASC',
			'post_type' => $post_typ,
			'number' => $max_posts,
			'taxonomy' => $ctp_show
		) );
		$result .= "<strong>".$ctp_title."</strong><br>";
		if(!empty($categories)){
			foreach( $categories as $category ) {
				if($flat_cat == 1){
					$result.= '<a href="'.get_option("home").'/categories/'.$category->slug.'" alt='.$category->name.'>'.$category->name.'</a>('. $category->count.') - ';
				}
				else{
					$result.= '<a href="'.get_option("home").'/categories/'.$category->slug.'" alt='.$category->name.'>'.$category->name.'</a>('. $category->count.')<br>';
				}
				
			} 
		}
		return $result."<br><br>";
	}
}
//Shortcode to show categories anywhere DROP
if(!function_exists('cattopage_wud_short_code_cat_drop')){
	function cattopage_wud_short_code_cat_drop($atts) {
		$ctp_show = "categories";
		if( get_option('cattopage_wud_cat') == "post" ){
			$ctp_show = "category";
		}	
		$ctp_title = get_option('cattopage_wud_widget_title1');
		$result = NULL;
		$orderby = "name";
		$order = "ASC";
		
		if(isset($atts["sort"]) && $atts["sort"]!='' ){			
			if($atts["sort"] > '' && strlen($atts["sort"]) < 50 ){
				if ($atts["sort"] =="date+"){$orderby = "date"; $order = "ASC";}
				if ($atts["sort"] =="date-"){$orderby = "date"; $order = "DESC";}
				elseif ($atts["sort"] =="name+"){$orderby = "name"; $order = "ASC";}
				elseif ($atts["sort"] =="name-"){$orderby = "name"; $order = "DESC";}
				elseif ($atts["sort"] =="random"){$orderby = "rand"; $order = "";}
			}
			else{
				return;
			}
		}	
		
		$standard_post = array('page','post');
		$custom_post_type = array(get_option('cattopage_wud_custom_post0'), get_option('cattopage_wud_custom_post1'), get_option('cattopage_wud_custom_post2'));	
		$post_typ = array_merge($standard_post, $custom_post_type);
		
		$result .= "<strong>".$ctp_title."</strong><br>";	
		$result .= '<select name="event-dropdown" onchange=\'document.location.href=this.options[this.selectedIndex].value;\'>'; 
			$categories = get_categories( array(
				'orderby' => $orderby,
				'order'   => $order,
				'post_type' => $post_typ,
				'taxonomy' => $ctp_show
			) ); 
			if(!empty($categories)){
				foreach ($categories as $category) {
					$result .= '<option value="'.get_option('home').'/categories/'.$category->slug.'">';
					$result .= $category->cat_name;
					$result .= ' ('.$category->category_count.')';
					$result .= '</option>';
				}
			}
		$result .= '</select>';
		return $result."<br><br>";
	}
}

//Shortcode to show tags anywhere LIST
if(!function_exists('cattopage_wud_short_code_tag_list')){
	function cattopage_wud_short_code_tag_list($atts) {
		$ctp_show = "tags";
		if( get_option('cattopage_wud_cat') == "post" ){
			$ctp_show = "post_tag";
		}	
		$ctp_title = get_option('cattopage_wud_widget_title2');
		$result = NULL;
		$orderby = "name";
		$order = "ASC";

		if(isset($atts["sort"]) && $atts["sort"]!='' ){			
			if($atts["sort"] > '' && strlen($atts["sort"]) < 50 ){
				if ($atts["sort"] =="date+"){$orderby = "date"; $order = "ASC";}
				if ($atts["sort"] =="date-"){$orderby = "date"; $order = "DESC";}
				elseif ($atts["sort"] =="name+"){$orderby = "name"; $order = "ASC";}
				elseif ($atts["sort"] =="name-"){$orderby = "name"; $order = "DESC";}
				elseif ($atts["sort"] =="random"){$orderby = "rand"; $order = "";}
			}
			else{
				return;
			}
		}
		
		$standard_post = array('page','post');
		$custom_post_type = array(get_option('cattopage_wud_custom_post0'), get_option('cattopage_wud_custom_post1'), get_option('cattopage_wud_custom_post2'));	
		$post_typ = array_merge($standard_post, $custom_post_type);
		
		$categories = get_categories( array(
			'orderby' => $orderby,
			'order'   => $order,
			'post_type' => $post_typ,
			'taxonomy' => $ctp_show
		) );
		$result .= "<strong>".$ctp_title."</strong>";
		if(!empty($categories)){
			foreach( $categories as $category ) {
				$category_link = sprintf( 
					'<a href="%1$s" alt="%2$s">%3$s</a>',
					esc_url( get_category_link( $category->term_id ) ),
					esc_attr( sprintf( '%s', $category->name ) ),
					esc_html( $category->name )
				);		 
				$result .= '<br>' . sprintf( '%s', $category_link ) . ' ('. $category->count.') ';
			}
		}	 
		return $result."<br><br>";
	}
}

//Shortcode to show tags anywhere DROP
if(!function_exists('cattopage_wud_short_code_tag_drop')){
	function cattopage_wud_short_code_tag_drop($atts) {
		$ctp_show = "tags";
		if( get_option('cattopage_wud_cat') == "post" ){
			$ctp_show = "post_tag";
		}	
		$ctp_title = get_option('cattopage_wud_widget_title2');
		$result = NULL;
		$orderby = "name";
		$order = "ASC";

		if(isset($atts["sort"]) && $atts["sort"]!='' ){			
			if($atts["sort"] > '' && strlen($atts["sort"]) < 50 ){
				if ($atts["sort"] =="date+"){$orderby = "date"; $order = "ASC";}
				if ($atts["sort"] =="date-"){$orderby = "date"; $order = "DESC";}
				elseif ($atts["sort"] =="name+"){$orderby = "name"; $order = "ASC";}
				elseif ($atts["sort"] =="name-"){$orderby = "name"; $order = "DESC";}
				elseif ($atts["sort"] =="random"){$orderby = "rand"; $order = "";}
			}
			else{
				return;
			}
		}
		
		$standard_post = array('page','post');
		$custom_post_type = array(get_option('cattopage_wud_custom_post0'), get_option('cattopage_wud_custom_post1'), get_option('cattopage_wud_custom_post2'));	
		$post_typ = array_merge($standard_post, $custom_post_type);
		
		$result .= "<strong>".$ctp_title."</strong><br>";	
		$result .= '<select name="event-dropdown" onchange=\'document.location.href=this.options[this.selectedIndex].value;\'>'; 
			$categories = get_categories( array(
				'orderby' => $orderby,
				'order'   => $order,
				'post_type' => $post_typ,
				'taxonomy' => $ctp_show
			) ); 
			if(!empty($categories)){
				foreach ($categories as $category) {
					$result .= '<option value="'.get_option('home').'/tags/'.$category->slug.'">';
					$result .= $category->cat_name;
					$result .= ' ('.$category->category_count.')';
					$result .= '</option>';
				}
			}

		$result .= '</select>';
		return $result."<br><br>";	
	}
}

//Show categories like parameters from the widget.
	function cattopage_wud_shortcode_display($atts) {
		$result = NULL;
		//load options
		$cattopage_wud_widget_title = get_option('cattopage_wud_widget_title');
		$cattopage_wud_widget_cats = get_option('cattopage_wud_widget_cats');
		$cattopage_wud_widget_tags = get_option('cattopage_wud_widget_tags');
		
		if($cattopage_wud_widget_cats=="1"){
			if( get_option('cattopage_wud_cat') == "post" ){
				$result .= cattopage_wud_widget_urls("category");
			}
			elseif( get_option('cattopage_wud_cat') == "page" ){
				$result .= cattopage_wud_widget_urls("categories");
			}		
		}
		
		if($cattopage_wud_widget_tags=="1"){		
			if( get_option('cattopage_wud_cat') == "post" ){
				$result .= cattopage_wud_widget_urls("post_tag");
			}
			elseif( get_option('cattopage_wud_cat') == "page" ){
				$result .= cattopage_wud_widget_urls("tags");
			}
		}
	return $result;	
	}
	
if(!function_exists('cattopage_wud_shortcode_urls')){
	function cattopage_wud_shortcode_urls($cat_tag){
		global $post;
		$cattopage_wud_widget_font1 = get_option('cattopage_wud_widget_font1');
		$cattopage_wud_widget_title1 = get_option('cattopage_wud_widget_title1');
		$cattopage_wud_widget_font2 = get_option('cattopage_wud_widget_font2');
		$cattopage_wud_widget_title2 = get_option('cattopage_wud_widget_title2');
		$cattopage_wud_widget_option1 = get_option('cattopage_wud_widget_option1');
		$cattopage_wud_widget_option2 = get_option('cattopage_wud_widget_option2');
		$cattopage_wud_widget_parent = get_option('cattopage_wud_widget_parent');
		$cattopage_wud_quantity = get_option('cattopage_wud_quantity');
		if(!get_option('cattopage_wud_quantity')){$cattopage_wud_quantity="5";}		
		
		$args = get_terms($cat_tag, array('parent' => 0, 'orderby' => 'slug', 'hide_empty' => true));	
		
	if ( ! empty( $args ) && ! is_wp_error( $args ) ) {
		$count = count( $args );
		$i = 0;
		$term_list = '<div class="wud_cat_tag_css">';
			if(!empty($cat_tag) && ($cat_tag=="categories" || $cat_tag=="category")){
				$term_list .= '<'.$cattopage_wud_widget_font1.'><br><span class="wudicon wudicon-category"></span> '.$cattopage_wud_widget_title1.'</'.$cattopage_wud_widget_font1.'>';
				if($cattopage_wud_widget_font1=="normal" || $cattopage_wud_widget_font1=="strong"){$term_list .= '<br>';}
			}
			if(!empty($cat_tag) && ($cat_tag=="tags" || $cat_tag=="post_tag")){
				$term_list .= '<'.$cattopage_wud_widget_font2.'><br><span class="wudicon wudicon-tag"></span> '.$cattopage_wud_widget_title2.'</'.$cattopage_wud_widget_font2.'>';
				if($cattopage_wud_widget_font2=="normal" || $cattopage_wud_widget_font2=="strong"){$term_list .= '<br>';}
			}
			
		if($cat_tag=="categories" || $cat_tag=="category" || $cat_tag=="tags" || $cat_tag=="post_tag") {
			
			foreach ($args as $pterm) {
				$xterms = get_terms($cat_tag, array('parent' => $pterm->term_id, 'orderby' => 'slug', 'hide_empty' => false));	
		//-> CAT OR TAG
				$cattopage_wud_cnt= substr(round(microtime(true) * 1000),10,3);
			
				if($cattopage_wud_widget_option2=="1"){
					$term_list .= '<button ClickResult="'.$cattopage_wud_cnt.'" class="cattopage_wud_split" id="cattopage_wud_split"><span>+</span></button> ';
				}
				
				//If current page haves this category or tag
				$return = is_object_in_term( $post->ID, $cat_tag, $pterm->slug );
					if(!empty($return)){$term_list .='<b>';} 
				$term_list .= '<a href="' . esc_url( get_term_link( $pterm ) ) . '">' . $pterm->name . '</a><br>';
					if(!empty($return)){$term_list .='</b>';}
					
				//Show pages URL
				if($cattopage_wud_widget_option1=="1"){	
					if($cattopage_wud_widget_option2=="1"){
						$term_list .= '<div class="cattopage_wud_items" id="cattopage_wud_split_'.$cattopage_wud_cnt.'">';
					}
					
					$standard_post = array('page','post');
					$custom_post_type = array(get_option('cattopage_wud_custom_post0'), get_option('cattopage_wud_custom_post1'), get_option('cattopage_wud_custom_post2'));	
					$post_typ = array_merge($standard_post, $custom_post_type);
		
					$argspost = array( 'posts_per_page' => $cattopage_wud_quantity, 'post_status'	=> 'publish', 'post_type' => $post_typ, 'offset'=> 0, 'tax_query' => array(array('taxonomy' => $cat_tag, 'field' => 'slug', 'terms' => array($pterm->slug))),);
					$myposts = get_posts( $argspost );
					foreach ( $myposts as $postwud ){ 
					
					//Check or this is the PARENT category (no child/sub)
					$terms = get_the_terms($postwud->ID, $cat_tag);
					$term_parent=0;
					if($terms){
					   foreach ($terms as $term) {
						 if (($term->parent) == 0) {$term_parent=0;}
						   else{
							   //If parameter parent is not 1, show also childs (subs)
							   if($cattopage_wud_widget_parent =="1"){
								   $term_parent=1;
								}
							 }  
						}
					}
									
					//If is a Tag or the Category is Parent
					if($term_parent==0){$term_list .= '&nbsp;&nbsp;&nbsp;&nbsp;&#8627;&nbsp;<a href="'.esc_url(get_permalink($postwud->ID)).'">'.$postwud->post_title.'</a><br>';}			
					}
					if($cattopage_wud_widget_option2=="1"){
						$term_list .= '</div>';
					}
				}		
				foreach ($xterms as $term) {
		//-> SUB CAT OR SUB TAG
					$cattopage_wud_cnt= substr(round(microtime(true) * 1000),10,3);

					if($cattopage_wud_widget_option2=="1"){
						$term_list .= '<button ClickResult="'.$cattopage_wud_cnt.'" class="cattopage_wud_split" id="cattopage_wud_split"><span>+</span></button> ';
					}
					
					//If current page haves this category or tag
					$return = is_object_in_term( $post->ID, $cat_tag, $term->slug );
						if(!empty($return)){$term_list .='<b>';} 
					$term_list .= '&#9492; &nbsp;<a href="' . esc_url( get_term_link( $term ) ) . '">' . $term->name . '</a><br>'; 
						if(!empty($return)){$term_list .='</b>';}

					$standard_post = array('page','post');
					$custom_post_type = array(get_option('cattopage_wud_custom_post0'), get_option('cattopage_wud_custom_post1'), get_option('cattopage_wud_custom_post2'));	
					$post_typ = array_merge($standard_post, $custom_post_type);
					
					//Show pages URL
					if($cattopage_wud_widget_option1=="1"){	
						if($cattopage_wud_widget_option2=="1"){
							$term_list .= '<div class="cattopage_wud_items" id="cattopage_wud_split_'.$cattopage_wud_cnt.'">';
						}
						$argspost = array( 'posts_per_page' => $cattopage_wud_quantity, 'post_status'	=> 'publish', 'post_type' => $post_typ, 'offset'=> 0, 'tax_query' => array(array('taxonomy' => $cat_tag, 'field' => 'slug', 'terms' => array($term->slug))),);
						$myposts = get_posts( $argspost );
						foreach ( $myposts as $postwud ){ 
						$term_list .= '&nbsp;&nbsp;&nbsp;&nbsp;&#8627;&nbsp;<a href="'.esc_url(get_permalink($postwud->ID)).'">'.$postwud->post_title.'</a><br>';
						}
						if($cattopage_wud_widget_option2=="1"){
							$term_list .= '</div>';
						}
					}				
				}
			}
			$term_list .= '</div>';
			return $term_list;
		}
		else{
			$term_list .= '</div>';
			return $term_list;
		}
	}
	}
}

//Show CURRENT Category and ord tag title on pages
if(!function_exists('cattopage_wud_current_cat_tag')){
	function cattopage_wud_current_cat_tag($atts) {
		if(is_singular('page') || is_singular('post')) {
			global $post;
		
		$cats_title = NULL;
		$tags_title = NULL;	
		$categories = NULL;
		$cat_images_wud_shortcode = NULL;
		//If same content is active with FIXED TITLE and with IMAGES: return
		if( get_option('cattopage_wud_title') == 'page' && get_option('cattopage_wud_txt_cat_img') == 1 ){
			return;
		}
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
		
		$wud_cat_img = 0;
		
		//Use images instead text only
		if(isset($atts["img"]) && $atts["img"]!='' ){			
			if(is_numeric($atts["img"]) && $atts["img"] > 0 && $atts["img"] < 2 && $atts["img"] == round($atts["img"], 0)){
				$wud_cat_img = $atts["img"];
			}
			else{
				$wud_cat_img = 0;
			}
		}
		
		//p or h1 to h3
		$pp = get_option('cattopage_wud_title_h1');
		if($pp == 'p'){ 
			$ppstyle = "style= 'font-family:".$fontct."; font-size: ".$sizect."px; line-height: ".$sizel."px; margin: 0px; margin-top: 4px; font-weight: bold;'"; 
			$iconsize = "style='font-size: ".$sizect."px;'";
		}
		else{
			$ppstyle = "";
			$iconsize = "";			
		}
		
		//If images used
		if( $wud_cat_img == 1 ){
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
					elseif(get_option('cattopage_wud_tag')=="post" ){
						$tags_title = 	get_the_term_list( $post->ID, 'post_tag', '', ', ' );
					}
					
					if(get_option('cattopage_wud_cat')=="post"){
						$cats_title = 	get_the_term_list( $post->ID, 'category', '', ', ' );
					}								
		}	
		//If nothing is in the loop ... return
		if(!in_the_loop()){return 'nothing found';}
		
			//If images used
			if( $wud_cat_img == 1 ){
				$categories = get_the_terms($post->ID,'categories');
				$categories_keys = array_keys($categories);
				$last_categories_key = array_pop($categories_keys);
				if( empty($categories) ){ return; }
				
				$cat_images_wud_shortcode = '<div class="wud_main_cat_img">';
				$cat_images_wud_shortcode .= '<section id="ctp_wud_cat_img" class="slider" style="height: '.$wud_total_size.'px">';
					foreach ($categories as $key => $value) {
					   $cat_ID_img = $value->term_id;
					   $image_id = NULL;
					   $image_id = get_term_meta ( $cat_ID_img, 'category-image-id', true );
						   if($image_id == "" || $image_id == NULL || empty($image_id) ){
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
								$cat_images_wud_shortcode .= '<a href="'.esc_url(get_tag_link($value->term_id)).'" class="'.$value->name.'" style="text-decoration: none; box-shadow: none; background-image: url(\''.$image_to_display.'\'); height: '.$wud_image_height.'px;"><p '.$pp_image_style.'>'.$value->name.'</p></a>';

							if ($key != $last_categories_key){
							  //last picture found
							}			
					 }
			$cat_images_wud_shortcode .= '</section>';    
			$cat_images_wud_shortcode .= '</div><br>';
						
			if(get_option('cattopage_wud_scroll_img') == 1){ $cattopage_wud_scroll_img = 'true'; }
			else{ $cattopage_wud_scroll_img = 'false'; }

			if(get_option('cattopage_wud_pause_img') == 1){ $cattopage_wud_pause_img = 'true'; }
			else{ $cattopage_wud_pause_img = 'false'; }

			if(get_option('cattopage_wud_image_interval') > 0){ $cattopage_wud_image_interval = get_option('cattopage_wud_image_interval'); }
			else{ $cattopage_wud_image_interval = '5000'; }
			
			$cat_images_wud_shortcode .= '
				<script type="text/javascript">$(window).load(function() { $("#ctp_wud_cat_img").ctp_wud({ visibleItems: 4, itemsToScroll: 1, autoPlay: { enable: '.$cattopage_wud_scroll_img.', interval: '.$cattopage_wud_image_interval.', pauseOnHover: '.$cattopage_wud_pause_img.' } }); });</script>
			';
			}
			
		//If Oké, display the Title('s)
				if(!empty($cats_title)){
					$cats_title = "<".$pp." class='ctp-wud-title' ".$ppstyle."><span class='wudicon wudicon-category' ".$iconsize."> </span> ".$cats_title."</".$pp.">";
				}
				if(!empty($tags_title)){
					$tags_title = "<".$pp." class='ctp-wud-title' ".$ppstyle."><span class='wudicon wudicon-tag' ".$iconsize."> </span> ".$tags_title."</".$pp.">";
				}
		}
		
		if( $wud_cat_img != 1 ){
			if(!empty($cats_title) && !empty($tags_title)){
				return $cats_title.$tags_title."<br><br>";
			}
			elseif(!empty($cats_title)){
				return $cats_title."<br><br>";
			}
			elseif(!empty($tags_title)){
				return $tags_title."<br><br>";
			}
		}
		else{
			return $cat_images_wud_shortcode;
		}
	}
}

?>
