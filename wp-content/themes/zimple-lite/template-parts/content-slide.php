<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ZimpleLite
 */
?>
		  
<?php
	$limit_slide = 11;
	$cats = get_theme_mod('zimple_lite_slideshow_category_type');

	$args = array( 
		'category__in' 		=> $cats, 
		'posts_per_page' 	=> $limit_slide
	);
	
	$slide_posts = new WP_Query( $args );

	if ( $slide_posts->have_posts() ) :

	?>
	<div class="slider-container" >
		<div class="flexslider inner clearfix">
			<ul class="slides">
				<?php 
					while ( $slide_posts->have_posts() ) : $slide_posts->the_post();
					if (has_post_thumbnail()) :
				 ?>
					<li>
						<a href="<?php the_permalink() ?>">
							<?php the_post_thumbnail('zimple-lite-slide-thumb') ?>
						</a>
						<p class="flex-caption"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></p>
					</li>
				<?php 
					endif;
					endwhile; 
				?>
			</ul>
		</div>
	</div>

	<?php
	endif;
	wp_reset_postdata();
	?>


		