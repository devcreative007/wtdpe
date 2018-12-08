<?php
/* 
=== Category to Pages WUD Administration===
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
//==============================================================================//
	
//RSS OPTIONS
if(!function_exists('ctpwud_options_page')){
function ctpwud_options_page() {
	
	
	if (get_option('cattopage_wud_rss')!=1){
		echo '<div class="ctp-wud-admin-table">';
		echo'<h1>'.__("Remove easily Categories from any RSS Feed!", "category-to-pages-wud").' (Version : '.get_option('pcwud_wud_version').')</h1>';		if ( isset( $message ) ) { 
			echo '<div>';
			echo $message; 
			echo '</div>';
		}
		else{
			echo '<div style="min-height: 62px;">';
			echo ''; 
			echo '</div>';			
		}		
		echo "<div class='ctp-wud-wrap-d'>";
		echo '<font  size="5" color="red">'.__("Category to Page RSS WUD", "category-to-pages-wud").'</font><br><br><p>';
		_e( 'Please enable first <strong>RSS feeds for pages</strong> in: <strong>Cat to Page WUD</b></p></strong>', 'category-to-pages-wud' ); 
		echo '</div>';
		echo '<a href="https://wud-plugins.com" class="button-primary" id="ctp-adm-wud" target="_blank">'.__("Visit our website", "category-to-pages-wud").'</a>  <a href="https://wordpress.org/support/plugin/category-to-pages-wud" class="button-primary" id="ctp-adm-wud" target="_blank">'.__("Get FREE Support", "category-to-pages-wud").'</a>';
		echo ' <a href="https://wud-plugins.com/contact-us/" class="button-primary" id="ctp-adm-wud-or" target="_blank">'.__("Contact", "category-to-pages-wud").'</a><br>';
		echo '</div>';
		return;
	}
	
	if( get_option('cattopage_wud_cat') == "page" ){ 
		$cats = get_terms( array( 'taxonomy' => 'categories', 'hide_empty' => 0, 'order' => 'ASC' ) );
	}
	elseif( get_option('cattopage_wud_cat') == "post" ){
		$cats = get_categories( array( 'taxonomy' => 'category', 'hide_empty' => 0, 'order' => 'ASC' ) );
	}
	$alt = 0;
	if ( empty( $cats ) || is_wp_error( $cats ) ) {
		echo '<div class="ctp-wud-admin-table">';
		echo'<h1>'.__("Remove easily Categories from any RSS Feed!", "category-to-pages-wud").' (Version : '.get_option('pcwud_wud_version').')</h1>';		if ( isset( $message ) ) { 
			echo '<div>';
			echo $message; 
			echo '</div>';
		}
		else{
			echo '<div style="min-height: 62px;">';
			echo ''; 
			echo '</div>';			
		}		
		echo "<div class='ctp-wud-wrap-d'>";
		echo '<font  size="5" color="red">'.__("Category to Page RSS WUD", "category-to-pages-wud").'</font><br><br><p>';
		echo '</div>';
		_e( 'Something went wrong or no categories where found.<br>Did you disable the PAGE categories?</b></p>', 'category-to-pages-wud' ); 
		echo '<a href="https://wud-plugins.com" class="button-primary" id="ctp-adm-wud" target="_blank">'.__("Visit our website", "category-to-pages-wud").'</a>  <a href="https://wordpress.org/support/plugin/category-to-pages-wud" class="button-primary" id="ctp-adm-wud" target="_blank">'.__("Get FREE Support", "category-to-pages-wud").'</a>';
		echo ' <a href="https://wud-plugins.com/contact-us/" class="button-primary" id="ctp-adm-wud-or" target="_blank">'.__("Contact", "category-to-pages-wud").'</a><br>';
		echo '</div>';
		 return;
	}		
	if( isset( $_POST[ 'ctpwud' ] ) ) { $message = ctpwud_process(); }
	$options = ctpwud_get_options();
	?>
	<div class="ctp-wud-admin-table">
	<?php
		echo'<h1>'.__("Remove easily Categories from any RSS Feed!", "category-to-pages-wud").' (Version : '.get_option('pcwud_wud_version').')</h1>';		if ( isset( $message ) ) { 
			echo '<div>';
			echo $message; 
			echo '</div>';
		}
		else{
			echo '<div style="min-height: 62px;">';
			echo ''; 
			echo '</div>';			
		}		
		echo "<div class='ctp-wud-wrap-d'>";
		echo '<font  size="5" color="red">'.__("Category to Pages RSS WUD", "category-to-pages-wud").'</font><br><br>';
		if( get_option('cattopage_wud_cat') == "page" ){
			_e( '<strong>Select an UNIQUE "Category to Page WUD" category to exclude from RSS</strong>', 'category-to-pages-wud' ); 
		}
		elseif( get_option('cattopage_wud_cat') == "post" ){
			_e( '<strong>Select a WP POST & "Category to Page WUD" category to exclude from RSS</strong>', 'category-to-pages-wud' );
		}
		echo '<br><br>If selected, the pages/post from this category will not be available on any RSS feed.<br><br>';
		echo "</div>";
	?>

		<form action="admin.php?page=category-to-pages-rss-wud" method="post">
		<table class="widefat">
		<thead>
			<tr>
				<th scope="col"><?php _e( 'Category', 'category-to-pages-wud' ); ?></th>
				<th scope="col"><?php _e( 'RSS Feeds', 'category-to-pages-wud' ); ?></th>
			</tr>
		</thead>
		<tbody id="the-list">
	<?php

	foreach( $cats as $cat ) {
		?>
		<tr<?php if ( $alt == 1 ) { echo ' class="alternate"'; $alt = 0; } else { $alt = 1; } ?>>
			<th scope="row"><?php echo $cat->name; //. ' (' . $cat->term_id . ')'; ?></th>
			<td><input type="checkbox" name="exclude_feed[]" value="<?php echo $cat->term_id ?>" <?php if ( in_array( '' . $cat->term_id, $options['exclude_feed'] ) ) { echo 'checked="true" '; } ?>/></td>
		</tr>			
	<?php } ?>
	</table>
	<p class="submit"><input type="submit" class="button-primary" id="ctp-wud-adm-subm" value="<?php _e('Save Changes', 'category-to-pages-wud'); ?>" /></p>
	<input type="hidden" name="ctpwud" value="true" />
	</form>
	</div>

	<?php
		echo '<a href="https://wud-plugins.com" class="button-primary" id="ctp-adm-wud" target="_blank">'.__("Visit our website", "category-to-pages-wud").'</a>  <a href="https://wordpress.org/support/plugin/category-to-pages-wud" class="button-primary" id="ctp-adm-wud" target="_blank">'.__("Get FREE Support", "category-to-pages-wud").'</a>';
		echo ' <a href="https://wud-plugins.com/contact-us/" class="button-primary" id="ctp-adm-wud-or" target="_blank">'.__("Contact", "category-to-pages-wud").'</a><br>';
	echo '</div>';		
}
}

function ctpwud_process() {
	if( !isset( $_POST[ 'exclude_feed' ] ) )     { $_POST[ 'exclude_feed' ] = array(); }
	$options['exclude_feed'] = $_POST[ 'exclude_feed' ];
	update_option( 'cattopage_wud_cat_RSS', $options );
	$message = "<div class='updated'><p>" . ( __( 'Successfully updated!', 'category-to-pages-wud' ) ) . "</p></div>";
	return $message;
}

function ctpwud_get_options(){
	$defaults = array();
	$defaults['exclude_feed'] = array();
	$options = get_option( 'cattopage_wud_cat_RSS' );
	if ( !is_array( $options ) ){
		$options = $defaults;
		update_option( 'cattopage_wud_cat_RSS', $options );
	}
	return $options;
}

function ctpwud_exclude_categories( $query ) {
	$array2[0] = "";
	unset( $array2[0] );
	$array3[0] = "";
	unset( $array3[0] );	
	$options = ctpwud_get_options();
	
//FEED
	//PAGES
	if( get_option('cattopage_wud_cat') == "page" ){
		if ( $query->is_feed ) {
			$mbccount = 0;
			$mbccountID = 0;
			foreach ( $options[ 'exclude_feed' ] as $value ) {
				$array2[$mbccount] = $value;
				$mbccount++;

			$args = array('post_type' => 'page', 'tax_query' => array( array( 'taxonomy' => 'categories', 'field' => 'term_id', 'terms' => $value, ), ), );
			$loop = new WP_Query($args);
				if($loop->have_posts()) {
					while($loop->have_posts()) : $loop->the_post();
						$valueID = get_the_ID();
						$array3[$mbccountID] = $valueID;
						$mbccountID++;
					endwhile;
				}
			}		
			$query->set( 'category__not_in', $array2 );
			$query->set( 'post__not_in', $array3);
		}
	}
	//POSTS & PAGES
	elseif( get_option('cattopage_wud_cat') == "post" ){	
		if ( $query->is_feed ) {
			$mbccount = 0;
			foreach ( $options[ 'exclude_feed' ] as $value ) {
				$array2[$mbccount] = $value;
				$mbccount++;
			}
			$query->set( 'category__not_in', $array2 );
		}
	}	
	return $query;
}

function ctpwud_include_categories( $query ){
    if (isset($query['feed']) && !isset($query['post_type']))
        $query['post_type'] = array('post', 'page');
    return $query;
}


?>
