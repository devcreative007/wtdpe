<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ZimpleLite
 */

$theme_options = zimple_lite_theme_options();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
	<div class="thumbnail-post col-xs-4 col-sm-4 col-md-4 col-lg-4">
		<a href="<?php the_permalink() ?>" rel="bookmark">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail(); ?>
			<?php else : ?>
				<img src="<?php echo get_template_directory_uri(); ?>/images/default-200x170.jpg" />
			<?php endif; ?>
		</a>
	</div>

	<div class="post-content col-xs-8 col-sm-8 col-md-8 col-lg-8">
		<header class="entry-header">
			<?php if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

			if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php
						zimple_lite_entry_meta();
					?>
				</div><!-- .entry-meta -->
			<?php
			endif;
			?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				if ( $theme_options['post_content'] != 'index' ) :
					the_excerpt();
				else : 
					the_content();
				endif;
			?>
		</div><!-- .entry-content -->

		<div class="bnt-default">
			<a href="<?php the_permalink() ?>" class="btn-view default-button">
				<?php _e( 'View More', 'zimple-lite' ); ?>
				<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
			</a>
		</div>

	</div>
</article><!-- #post-## -->