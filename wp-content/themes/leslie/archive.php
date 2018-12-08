<?php
/*
 * archive.php
 * The template which shows category, tag, archive, date, etc.
 * @theme leslie
 */ 
get_header(); ?>
<div class="c2">
    <div id="main-nav" role="navigation">
        <nav>
            <?php wp_nav_menu( array( 'container_id' => 'access', 'theme_location' => 'primary' ) ); ?>
        </nav><!-- ends access# -->
    </div>
</div><!-- ends row left -->

     <div class="c10">
         <div id="content" role="main">
            <?php get_template_part( 'content', 'excerpt' ); ?>
        </div><!-- ends content -->        
    </div><!-- ends c10 without sidebar -->
        
        <?php get_footer(); ?>