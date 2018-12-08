<?php
/* 
=== Category to Pages WUD Register the Terms===
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
//==============================================================================//

	
//-> Register the post category to post and pages
if(!function_exists('cattopage_wud_reg_cat')){
	function cattopage_wud_reg_cat(){ 
		$activated = 0;
		$cattopage_wud_cat = get_option('cattopage_wud_cat');
		if( !empty($cattopage_wud_cat) ){	
			register_taxonomy_for_object_type('category', 'page');
			$activated = 1;
		}
		return $activated;
	}
}

//-> Register the post tag to post and pages
if(!function_exists('cattopage_wud_reg_tag')){
	function cattopage_wud_reg_tag(){ 
		$activated = 0;
		$cattopage_wud_tag = get_option('cattopage_wud_tag');
		if( !empty($cattopage_wud_tag) ){
			register_taxonomy_for_object_type('post_tag', 'page');
			$activated = 1;
		}
		return $activated;
	}
}

//-> Use the post and page as post_type
if(!function_exists('cattopage_wud_cat_archives')){
	function cattopage_wud_cat_archives( $query ) {
		$cattopage_wud_cat = get_option('cattopage_wud_cat');		
			$my_cat_array = array('post','page');
	// Category post_type to post and page 
	 if ( ($query->get( 'category_name' ) || $query->get( 'cat' )) && !empty($my_cat_array) ){
		$query->set( 'post_type', $my_cat_array );
	 }
	}
}

//-> Use the post and page as post_type
if(!function_exists('cattopage_wud_tag_archives')){
	function cattopage_wud_tag_archives( $query ) {
		$cattopage_wud_tag = get_option('cattopage_wud_tag');		
			$my_tag_array = array('post','page');
	// Tag post_type to post and page
	 if ( $query->get( 'tag' ) && !empty($my_tag_array) ){
		$query->set( 'post_type', $my_tag_array );
	 }
	}
}
	
//-> Get page URL by category or categories when permalink is set to /%category%/%postname%/
if(!function_exists('cattopage_wud_custom_urls')){
	function cattopage_wud_custom_urls( $url, $post ){
			$permalink = get_option('permalink_structure');
			//If no permalink structure or its admin panel, return the original URL
			if($permalink !== "/%category%/%postname%/"){
				return $url;
			}		
			$my_cat= NULL;
			$wud_post = get_post( $post );
			$post_type = $wud_post->post_type;
			$replace = $wud_post->post_name;
			//Only pages
			if($post_type=="page"){
				//Original WP category
					$terms = wp_get_post_terms( $wud_post->ID, 'category');
						if($terms){
						//If sub from categories, search parent
						if($terms[0]->parent !== 0){				
							$my_cat_nr= $terms[0]->parent.'/';
							$my_cat_id=get_term_by('id', $my_cat_nr, 'category');						
							$my_cat=$my_cat_id->slug.'/';
						}
						else{
							$my_cat= $terms[0]->slug.'/';
						}
					}				   
			}
			//If the URL haves already a category
			if (strpos($url, $my_cat) !== false) {
				return $url;
			} 
			if(get_option('cattopage_wud_hardcoded')=="1"){		
				$url = str_replace($wud_post->post_name, $my_cat.$replace, $url );
			}
			else{
				$url= site_url().'/'.$my_cat.$wud_post->post_name.'/';
			}
			return $url;
	}
}

//-> Register the unique category and tag to pages
// UNIQUE CATEGORIES
if(!function_exists('wud_custom_cats')){
	function wud_custom_cats() {
	 if(get_option('cattopage_wud_cat')=="page"){	 
	  $labels = array(
		'name' => _x( 'Page Categories', 'taxonomy general name' ),
		'singular_name' => _x( 'Category', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Page Categories' ),
		'all_items' => __( 'All Page Categories' ),
		'parent_item' => __( 'Parent Page Category' ),
		'parent_item_colon' => __( 'Parent Page Category:' ),
		'edit_item' => __( 'Edit Page Category' ), 
		'update_item' => __( 'Update Page Category' ),
		'add_new_item' => __( 'Add New Page Category' ),
		'new_item_name' => __( 'New Page Category Name' ),
		'menu_name' => __( 'Page Categories' ),
	  ); 	

	  $args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'public' => true,
		'show_admin_column' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array('slug' => 'categories', 'with_front' => false)
	  );
	  register_taxonomy('categories',array('page'),$args);
	  
	 }
	}
}

// UNIQUE TAGS	
if(!function_exists('wud_custom_tags')){
	function wud_custom_tags() {
	 if(get_option('cattopage_wud_tag')=="page"){ 
	  $labels = array(
		'name' => _x( 'Page Tags', 'taxonomy general name' ),
		'singular_name' => _x( 'Tag', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Page Tags' ),
		'popular_items' => __( 'Popular Page Tags' ),
		'all_items' => __( 'All Page Tags' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Page Tag' ), 
		'update_item' => __( 'Update Page Tag' ),
		'add_new_item' => __( 'Add New Page Tag' ),
		'new_item_name' => __( 'New Page Tag Name' ),
		'separate_items_with_commas' => __( 'Separate Page Tags with commas' ),
		'add_or_remove_items' => __( 'Add or remove Page Tags' ),
		'choose_from_most_used' => __( 'Choose from the most used Page Tags' ),
		'menu_name' => __( 'Page Tags' ),
	  ); 

	  $args = array(
		'hierarchical' => false,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array( 'slug' => 'tags', 'with_front' => false ),
	  );
	  register_taxonomy('tags',array('page'), $args);
	 }
	}
}

//Selection in admin bar if page list
function filter_wud_by_taxonomies( $post_type, $which ) {
	
	if(get_option('cattopage_wud_cat') == "page" && get_option('cattopage_wud_tag') == "page"){
		$taxonomies = array( 'categories', 'tags' );
	}
	elseif(get_option('cattopage_wud_cat') == "post" && get_option('cattopage_wud_tag') == "page"){
		$taxonomies = array( 'tags' );
	}
	elseif(get_option('cattopage_wud_cat') == "page" && get_option('cattopage_wud_tag') == "post"){
		$taxonomies = array( 'categories', 'post_tag' );
	}
	elseif(get_option('cattopage_wud_cat') == "post" && get_option('cattopage_wud_tag') == "post"){
		$taxonomies = array( 'post_tag' );
	}
	elseif(get_option('cattopage_wud_cat') == "page" && get_option('cattopage_wud_tag') == "none"){
		$taxonomies = array( 'categories' );
	}
	elseif(get_option('cattopage_wud_cat') == "none" && get_option('cattopage_wud_tag') == "page"){
		$taxonomies = array( 'tags' );
	}
	elseif(get_option('cattopage_wud_cat') == "post" && get_option('cattopage_wud_tag') == "none"){
		//$taxonomies = array( 'category' );
	}
	elseif(get_option('cattopage_wud_cat') == "none" && get_option('cattopage_wud_tag') == "post"){
		$taxonomies = array( 'post_tag' );
	}
	
	if(empty($taxonomies) || $taxonomies == "none"){return;}

	foreach ( $taxonomies as $taxonomy_slug ) {
		$taxonomy_obj = get_taxonomy( $taxonomy_slug );
		$taxonomy_name = $taxonomy_obj->labels->name;
		$terms = get_terms( $taxonomy_slug );
		if(is_wp_error($taxonomy_name)){return;}
		echo "<select name='{$taxonomy_slug}' id='{$taxonomy_slug}' class='postform'>";
		echo '<option value="">' . sprintf( esc_html__( 'All %s', 'text_domain' ), $taxonomy_name ) . '</option>';		
		foreach ( $terms as $term ) {
			printf(
				'<option value="%1$s" %2$s>%3$s</option>',
				$term->slug,
				( ( isset( $_GET[$taxonomy_slug] ) && ( $_GET[$taxonomy_slug] == $term->slug ) ) ? ' selected="selected"' : '' ),
				$term->name,
				$term->count
			);
		}
		echo '</select>';
	}

}
?>
