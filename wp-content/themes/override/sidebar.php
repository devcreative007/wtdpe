<?php
/**
 * The Template for displaying right sidebar
 *
 * @package Override
 * @since Override 1.0
 */

/**
 * This file is used to display our primary sidebar
 * If no active widgets in sidebar, let's hide it completely.
 */

?>

<?php if ( is_active_sidebar( 'main' ) ) : ?>
	<div class="sidebar">
		<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'main' ) ) : ?>
		<?php endif; ?>
	</div>
<?php endif; ?>
