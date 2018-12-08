<?php
/**
 * Dynamic CSS file handles display of the theme's sidebars,header image and header text.
 *
 * @package Override
 * @since Override 1.0
 */

?>
<?php
function override_dynamic_layout() {
	echo '<style type="text/css">';

	if ( ! display_header_text() ) {
		?>

		.header-text-wrapper a,
		.header-text-wrapper,
		.header-text-wrapper h1,
		.header-text-wrapper .site-description {
		display: none;
		}
	<?php } else {
		?>

		.header-text-wrapper a {
		color: #<?php echo esc_attr( get_header_textcolor() ); ?>;
		}
	<?php }
	if ( is_active_sidebar( 'secondary' ) && is_active_sidebar( 'main' ) ) {// If both sidebars are active.
		?>

		#blogs {
		width: 100%;
		}

		#blogs .post {
		width: 100%;
		}

		#blogwrapper {
		display: inline-block;
		width: 58%;
		float: none;
		}

		.sidebar-sec {
		float: left;
		}

		/*Three Columns Template*/
		#blogs-three-cols .post {
		width: 100%;
		}

		#blogs-three-cols .middle-column {
		float: left;
		margin: 0 1.1%;
		}

		#blogs-three-cols {
		position: relative;
		width: 100%;
		}

		#blogs-three-cols .postmetadata span {
		line-height: 1.8;
		padding-bottom: 0.091em; /* 1px */
		}

		/*Reduce the font size metadata on three-columns when both sidebars active*/
		#blogs-three-cols .left-column .postmetadata,
		#blogs-three-cols .middle-column .postmetadata ,
		#blogs-three-cols .right-column .postmetadata {
		font-size: 0.688em; /* 11px */
		}
	<?php } // End If both sidebars are active

	elseif ( ! is_active_sidebar( 'secondary' ) && is_active_sidebar( 'main' ) ) {/*If main sidebar here*/
		?>

		#blogs-three-cols .middle-column {
		float: left;
		margin: 0 1.1%;
		}

		#blogs-three-cols {
		width: 100%;
		}

		#blogs .right-column {
		float: right;
		width: 49.5%;
		}

		#blogs .left-column {
		width: 49.5%;
		}

		#blogs {
		float: none;
		max-width: 100%;
		}
	<?php } /*End If main sidebar here*/
	elseif ( ! is_active_sidebar( 'secondary' ) && ! is_active_sidebar( 'main' ) ) {/*No sidebar*/
		?>

		#blogs {
		float: none;
		max-width: 100%;
		}

		#blogs .right-column, .left-column {
		width: 49.6%;
		}

		#blogs-three-cols .middle-column,
		#blogs-three-cols .left-column,
		#blogs-three-cols .right-column {
		width: 32.7%;
		}

		#blogwrapper {
		width: 100%;
		}

		#blogs-three-cols {
		width: 100%;
		}

		#blogs-three-cols .post {
		width: 100%;
		}

		#blogs-three-cols .middle-column {
		float: left;
		margin: 0 .95%;
		}
	<?php } /*End No sidebar*/
	elseif ( is_active_sidebar( 'secondary' ) && ! is_active_sidebar( 'main' ) ) {/*If only secondary sidebar is here*/
		?>

		#blogs {
		float: left;
		}

		#blogs .right-column, .left-column {
		width: 49.5%;
		}

		#blogwrapper {
		float: right;
		}

		#blogs-three-cols .middle-column {
		float: left;
		margin: 0 1.1%;
		}

		#blogs {
		float: none;
		max-width: 100%;
		}

		#blogs-three-cols {
		width: 100%;
		}
	<?php }/*End If only secondary sidebar is here */
	echo '</style>';
}//end override_dynamic_layout()
