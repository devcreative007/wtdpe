<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @package Override
 * @since Override 1.0
 */

?>

<div id="post-0" class="post no-results not-found">
	<header class="entry-header">
		<h1 class="entry"><?php esc_html_e( 'Nothing Found', 'override' ); ?></h1>
	</header><!-- .entry-header -->

	<br/>

	<div class="entry-content-none">
		<p><?php esc_html_e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'override' ); ?></p>
		<br/><?php get_search_form(); ?>
	</div><!--/entry-content-none-->
</div><!-- #post-0 -->
