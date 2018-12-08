<?php
/**
 * @package wimplepro
 */
?>

<?php
/*
* Social Button Position
* 0 => top
* 1 => bottom
* 2 => Float
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemtype="http://schema.org/BlogPosting" itemscope="itemscope" itemprop="blogPost">
	<header class="entry-header">
		
		<?php
		
		the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );

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

	<div class="entry-content" itemprop="text">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'zimple-lite' ),
				'after'  => '</div>',
			) );
		?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->

<div class="related-posts clear">
	<?php zimple_lite_related_posts() ?>
</div>

