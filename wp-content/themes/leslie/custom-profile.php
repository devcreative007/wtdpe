<?php
/*
 * Template Name: Portfolio Page
 * The special theme template with post gallery on right
 * @theme leslie
 */ 
get_header(); ?>

<div class="c2" id="main-nav">
    <nav role="navigation">
        <?php wp_nav_menu( array( 'container_id' => 'access', 'theme_location' => 'primary' ) ); ?>
    </nav><!-- ends access# -->
</div><!-- ends row left -->

    <div class="c7">
        <div id="content" role="main">
            <?php get_template_part( 'content' ); ?>
        </div><!-- ends content -->
    </div>

        <div class="c3 end">
            <?php get_template_part( 'content', 'profile' ); ?>
        </div><!-- ends row right -->

            <?php get_footer(); ?>