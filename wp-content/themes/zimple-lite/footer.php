<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ZimpleLite
 */

$theme_options = zimple_lite_theme_options();
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		
		<?php get_sidebar('footer'); ?>

		<div class="copyright-footer col-xs-12">
			<div class="inner clearfix">
				<div class="left-path site-info col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<?php zimple_lite_footer_copyright(); ?>
				</div><!-- .site-info -->
				<?php if ( has_nav_menu( 'zimple-lite-footer' ) ) : ?>
					<div class="right-path smenu default-menu col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<?php wp_nav_menu( array('theme_location' => 'zimple-lite-footer', 'container' => false, 'menu_id' => 'menu-footer-menu',  'menu_class' => 'menu footer-menu') ); ?> 
					</div>
				<?php endif; ?>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<!-- Back To Top -->
<?php if( $theme_options['back_to_top'] == 1 ) : ?>
	<span class="back-to-top"><i class="fa fa-angle-double-up"></i></span>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>
