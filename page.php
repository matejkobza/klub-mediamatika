<?php global $asteria;?>
<?php get_header(); ?>

<!--Content-->
<div class="fixed_site">
	<div class="fixed_wrap singlefx">
		<?php if(($asteria['page_type_id']) == '1' || !get_option( 'asteria' )){ ?>
            <div class="page_tt">
                <div class="center"><h1 class="postitle"><?php the_title(); ?></h1></div>
            </div> 
        <?php } ?>

<div id="content">
	<div class="center">
		<div class="single_wrap<?php if ( !is_active_sidebar( 'sidebar' ) ) { ?> no_sidebar<?php } ?>">
			<div class="single_post">
                   <?php if(have_posts()): ?><?php while(have_posts()): ?><?php the_post(); ?>
                <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">  
        
                <div class="single_post_content">
                	<?php if(($asteria['page_type_id']) == '2'){ ?><h1 class="postitle"><?php the_title(); ?></h1><?php } ?>
                
                    <div class="thn_post_wrap"><?php the_content(); ?> </div> 
                    <div style="clear:both"></div>
                    <div class="thn_post_wrap"><?php wp_link_pages('<p class="pages"><strong>'.__('Pages:').'</strong> ', '</p>', 'number'); ?></div>
                </div>
                        </div>
            <?php endwhile ?> 
                </div>
                <!--COMMENT START: Calling the Comment Section. If you want to hide comments from your posts, remove the line below-->     
                
                <!--COMMENT END-->
            <?php endif ?>

    </div>
   
    <!--PAGE END-->


<!--SIDEBAR START--> 
<?php if ( is_active_sidebar( 'sidebar' ) ) { ?><?php get_sidebar();?><?php } ?>
<!--SIDEBAR END--> 
		</div>
	</div>
</div>
</div>
<?php get_footer(); ?>