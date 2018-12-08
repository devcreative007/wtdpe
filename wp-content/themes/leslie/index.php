<?php
/*
 * index.php
 * The main template. blog home and fallback for any page without a template
 * @theme leslie
 */ 
get_header(); ?>

<div id="homeWrapper">
    <div class="c2" id="main-nav" role="navigation">    
        <nav>
        
            <?php wp_nav_menu( array( 'container_id' => 'access', 'theme_location' => 'primary' ) ); ?>
            
        </nav><!-- ends access# -->
    </div>

        <div class="c7">    
            <div id="content" role="main">
            
                <?php get_template_part( 'content' ); ?>
                
            </div><!-- ends content -->    
        </div>
	
	<div class="c3" id="left-sidebar-container">
	
	    <?php get_sidebar(); ?>  
	
	</div>

        <div class="clearfix"><br></div>

            <nav class="c12">        
            <div>
            
                <?php leslie_pagination(); ?>
                
            </div>
            </nav>
</div>
<?php get_footer(); ?>