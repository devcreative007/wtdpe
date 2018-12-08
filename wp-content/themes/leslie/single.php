<?php
/*
 * single.php
 * The single article page template
 * @theme leslie
 */ 
get_header(); ?>

<div class="c3" id="left-sidebar-container">
    <?php get_sidebar(); ?>
</div>

    <div class="c2" id="main-nav" role="navigation">
        <nav>
            <?php wp_nav_menu( array( 'container_id' => 'access', 'theme_location' => 'primary' ) ); ?>
        </nav><!-- ends access# -->
    </div>
    
        <div class="c7 end" id="content-right">
            <div id="content" role="main">
                <?php get_template_part( 'content-single' ); ?>
                    <div class="clearfix"><br></div>
                        <?php comments_template(); ?>  
                            <hr>    
            </div><!-- ends content -->
        </div>

<?php get_footer(); ?>