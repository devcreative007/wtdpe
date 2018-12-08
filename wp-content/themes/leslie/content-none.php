<div class="c12">

    <article id="post-not-found">
        <header>
            <h1><?php _e("Not Found", "leslie"); ?></h1>
                <p><?php _e( 'No posts matched your criteria. You may want to try search form', 'leslie' ); ?></p>  
        </header>
            <div class="entry">
                <form action="<?php echo home_url( '/' ); ?>" method="get" class="searchform">
                    <fieldset>
                        <div class="input-group">
                            <input type="text" name="s" id="search" placeholder="<?php _e("Search","leslie"); ?>" value="<?php the_search_query(); ?>" /> <span class="input-group-btn"><button type="submit" class="btn-default"><?php _e("Search","leslie"); ?></button</span>
                        </div>
                   </fieldset>
                </form>
           </div>
   </article>

</div>