<?php global $asteria;?>
<?php get_header(); ?>
<!--Content-->
<div class="fixed_site"><?php global $authordata; $post_author = "<a class='auth_meta' href=\"".get_author_posts_url( $authordata->ID, $authordata->user_nicename )."\">".get_the_author()."</a>\r\n"; echo $post_author; ?>
	<div class="fixed_wrap singlefx">
		<div id="content">
			<div class="center">
				<div class="content_wrap">
                    <!--POST END-->
					<div class="single_wrap<?php if ( !is_active_sidebar( 'sidebar' ) ) { ?> no_sidebar<?php } ?>">
				<div class="single_post">

                   <?php if(have_posts()): ?><?php while(have_posts()): ?><?php the_post(); ?>
                    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>"> 
					
                                
                    
                    <!--POST START-->
                    <div class="single_post_content">
                        <h1 class="postitle"><?php the_title(); ?></h1>
                        <!--POST INFO START-->
                        <?php if (!empty ($asteria['post_info_id'])) { ?>
                        <div class="single_metainfo">
                            <i class="fa-calendar"></i><a class="comm_date"><?php the_time( get_option('date_format') ); ?></a>
                            <i class="fa-user"></i><?php global $authordata; $post_author = "<a class='auth_meta' href=\"".get_author_posts_url( $authordata->ID, $authordata->user_nicename )."\">".get_the_author()."</a>\r\n"; echo $post_author; ?>
                            <i class="fa-comments"></i><?php if (!empty($post->post_password)) { ?>
                        <?php } else { ?><div class="meta_comm"><?php comments_popup_link( __('0 Komentárov', 'asteria'), __('1 Komentár', 'asteria'), __('2 Komentáre', 'asteria'), __('3 Komentáre', 'asteria'), __('4 Komentáre Comments', 'asteria'), __('% Comments', 'asteria'), '', __('Off' , 'asteria')); ?></div><?php } ?>
                        	<?php
          setPostViews(get_the_ID());
?>
                          <!-- <i class="fa-th-list"></i><div class="catag_list"><?php the_category(', '); ?></div>-->
			<?php if( function_exists('dot_irecommendthis') ) dot_irecommendthis(); ?> Tichých ocenení
			<i class="fa-eye"></i><?php echo getPostViews(get_the_ID());?>
                        </div>
                        <?php } ?>
                        <!--POST INFO START-->
<?php
                                global $wp_query;
                                $postid = $wp_query->post->ID;
                                $categories = get_the_category();
                                ?>
                        
                        <!--POST CONTENT START-->
                        
                        <div style="clear:both"></div>
                        <div class="thn_post_wrap"><?php wp_link_pages('<p class="pages"><strong>'.__('Pages:').'</strong> ', '</p>', 'number'); ?>
						<?php
                                if ($categories[0]->cat_ID == 7) { // audio
                                    $shortcode = "[soundcloud id='" . get_the_content() . "' playerType='Standard']";
                                    echo do_shortcode($shortcode);
                                } else if ($categories[0]->cat_ID == 6) {// video
                                    $url = get_the_content();
                                    parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
                                    $id = $my_array_of_vars['v'];
                                    ?>
                                    <object width="640" height="360">
                                        <param name="movie" value="https://www.youtube.com/v/<?php echo $id; ?>?version=3"></param> 
                                        <param name="allowFullScreen" value="true"></param> 
                                        <param name="allowScriptAccess" value="always"></param> 
                                        <embed src="https://www.youtube.com/v/<?php echo $id; ?>?version=3" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="400" height="225"></embed> 
                                    </object>
                                    <?php
                                } else if ($categories[0]->cat_ID == 5) {//grafika
                                    ?>
                                    <img src="<?php echo getphpthumburl(get_the_content()); ?>" alt="<?php echo get_the_title(); ?>"  />
                                    <?php
                                } else if ($categories[0]->cat_ID == 76) {//sutaz
                                    ?>
                                    <img src="<?php echo getphpthumburl(get_the_content(), ); ?>" alt="<?php echo get_the_title(); ?>"  />
                                    <?php
                                } else if ($categories[0]->cat_ID == 8) {//web
                                ?>	<img src="<?php echo getphpthumburl(get_the_content(),); ?>" alt="<?php echo get_the_title(); ?>"  />
									<?php
								}	else if ($categories[0]->cat_ID == 9) {//text
                                ?>  <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( ); ?>"><text style="color:#a9a9a9; font-size:10"><i class="fa-book"></i> Čítať</a>
									<?php the_excerpt(); ?> 
									<?php
								}	else if ($categories[0]->cat_ID == 4) {//fotografia
								?>	<img src="<?php echo getphpthumburl(get_the_content(), ); ?>" alt="<?php echo get_the_title(); ?>"  />
									<?php
								}
								?>                        <!--POST CONTENT END-->
                        </div>
                        
                        
                        <!--POST FOOTER START-->
                        <div class="post_foot">
                            <div class="post_meta">
         <?php if( has_tag() ) { ?><div class="post_tag"><div class="tag_list"><?php the_tags('<i class="fa-tag"></i>','  '); ?></div></div><?php } ?>
                            </div>
                       </div>
                       <!--POST FOOTER END-->
                        
                    </div>
                    <!--POST END-->
                    </div>
                        
            <?php endwhile ?> 
       
            <?php endif ?>

<!--SOCIAL SHARE POSTS START-->
<?php if (!empty ($asteria['social_single_id']) || !get_option( 'asteria' )) { ?>
	<?php get_template_part('share_this');?>
<?php } ?>
<!--SOCIAL SHARE POSTS END-->
</div>

<!--NEXT AND PREVIOUS POSTS START-->
<?php if (!empty ($asteria['post_nextprev_id']) || !get_option( 'asteria' )) { ?>
<div id="ast_nextprev" class="navigation">
	<?php $prevPost = get_previous_post(true); if($prevPost) {?>
        <div class="nav-box ast-prev">
        <?php $prevthumbnail = get_the_post_thumbnail($prevPost->ID, array(100,100) );?>
        <?php previous_post_link('%link',"$prevthumbnail Predchádzajúci príspevok<br><span>%title</span>", TRUE); ?>
        <a class="left_arro" href="#"><i class="fa-angle-left"></i></a>
        </div>
    <?php }?>
    <?php $nextPost = get_next_post(true); if($nextPost) { ?>
        <div class="nav-box ast-next">
        <?php $nextthumbnail = get_the_post_thumbnail($nextPost->ID, array(100,100) ); ?>
        <?php next_post_link('%link',"$nextthumbnail Ďalší príspevok<br><span>%title</span>", TRUE); ?>
        <a class="right_arro" href="#"><i class="fa-angle-right"></i></a>
        </div>
    <?php }?>
</div>
<?php }?>
<!--NEXT AND PREVIOUS POSTS END-->                


<!--COMMENT START: Calling the Comment Section. If you want to hide comments from your posts, remove the line below-->     
<?php if (!empty ($asteria['post_comments_id']) || !get_option( 'asteria' )) { ?>
    <div class="comments_template">
    	<?php comments_template('',true); ?>
    </div>
<?php }?> 

<!--COMMENT END-->


			</div>
<!--SIDEBAR START--> 
<?php if ( is_active_sidebar( 'sidebar' ) ) { ?><?php get_sidebar();?><?php } ?>
<!--SIDEBAR END--> 

		</div>
	</div>
</div>
</div>
</div>
<?php get_footer(); ?>