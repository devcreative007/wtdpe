<?php
/**
 * The Template for displaying left sidebar
 *
 * @package Override
 * @since Override 1.0
 */

/**
 * This file is used to display our secondary sidebar
 * If no active widgets in sidebar, let's hide it completely.
 */

?>

<?php if ( is_active_sidebar( 'secondary' ) ) : ?>
	<div class="sidebar-sec">
		<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'secondary' ) ) : ?>
		<?php endif; ?>
	</div>
<?php endif; ?>
