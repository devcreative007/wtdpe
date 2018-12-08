<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #wrapper div and <main> element.
 *
 * @package Override
 * @since Override 1.2.1.8
 */

?>
<div class="clear-footer"></div>
<footer>
	<div id="footer">

		<?php if ( is_active_sidebar( 'footer-sidebar' ) ) {
			?>
			<div id="footer-sidebar" class="footer-sidebar-one">
				<?php dynamic_sidebar( 'footer-sidebar' ); ?>
			</div>
		<?php } ?>

		<?php
		if ( is_active_sidebar( 'footer-sidebar-two' ) ) {
			?>
			<div id="footer-sidebar-two" class="footer-sidebar-two">
				<?php dynamic_sidebar( 'footer-sidebar-two' ); ?>
			</div>
		<?php } ?>

		<?php
		if ( is_active_sidebar( 'footer-sidebar-three' ) ) {
			?>
			<div id="footer-sidebar-three" class="footer-sidebar-three">
				<?php dynamic_sidebar( 'footer-sidebar-three' ); ?>
			</div>
		<?php } ?>

		<?php
		if ( is_active_sidebar( 'footer-sidebar-four' ) ) {
			?>
			<div id="footer-sidebar-four" class="footer-sidebar-four">
				<?php dynamic_sidebar( 'footer-sidebar-four' ); ?>
			</div>
		<?php } ?>


		<div class="copyright">

			<?php if ( get_post() ) { // We are checking if any post are returned.
				?>
				<p>
					<strong><?php esc_html_e( 'Copyright', 'override' ); ?> &copy; <?php echo esc_html( date_i18n( get_option( 'date_format' ) ) ); ?>
						<a title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
						   href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html( bloginfo( 'name' ) ); ?></a>
						| <?php esc_html_e( 'All Rights Reserved.', 'override' ); ?></strong>
					<?php printf( esc_html__( '%1$s by %2$s and %3$s', 'override' ), 'Powered', '<a href="https://wordpress.org" target="_blank">WordPress</a>', '<a href="https://wordpress.org/themes/override/" target="_blank">Override</a>' ); ?>
				</p>
				<p>
					<a href="<?php bloginfo( 'rss2_url' ); ?>"><?php esc_html_e( 'Latest Stories RSS', 'override' ); ?></a>
					|
					<?php post_comments_feed_link( $link_text = 'Comments RSS', $post_id = 'post_id', $feed = 'rss2' ); ?>
				</p>
			<?php }
			?>

		</div>

	</div><!--/footer-->
</footer>
</div><!--/wrapper-->
</main>
<?php
/**
 * Always have wp_footer() just before the closing </body>
 * tag of your theme, or you will break many plugins, which
 * generally use this hook to reference JavaScript files.
 */

wp_footer(); ?>
</body>
</html>
