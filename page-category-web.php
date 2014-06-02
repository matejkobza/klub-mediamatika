<?php
/*
  Template Name: web
 */
?>
<?php global $asteria; ?>
<?php get_header(); ?>

<div class="fixed_site">
    <!--BIG PAGE HEADER START-->
    <div class="fixed_wrap singlefx">
        <div class="page_tt">
            <div class="center"><h1 class="postitle"><?php the_title(); ?></h1></div>
        </div> 
        <!--BIG PAGE HEADER END-->

        <div class="lay1">
            <div class="center">

                <div class="lay1_wrap<?php if (!is_active_sidebar('sidebar')) { ?> no_sidebar<?php } ?>">
                    <div class="lay1_inner">
                        <?php
                        $args = array(
                            'post_type' => 'post',
//                            'cat' => '' . $asteria['blog_cat_id'] . '',
                            'cat' => '8',
                            'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
                            'posts_per_page' => '6');
                        $the_query = new WP_Query($args);
                        ?>
                        <?php
                        while ($the_query->have_posts()) : $the_query->the_post();
                            ?>
                            <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                                <?php
                                global $wp_query;
                                $postid = $wp_query->post->ID;
                                ?>
                                <!--<div class="post_content">-->
                                    
                                <!--POST INFO START-->
                                
                                <img src="<?php echo getphpthumburl(get_the_content(), 'h=225&w=400&zc=1'); ?>" alt="<?php echo get_the_title(); ?>" width="400" height="225" />
                                <div class="single_metainfo" align="center">
								
                                    <!--<i class="fa-calendar"></i><a class="comm_date"><?php the_time(get_option('date_format')); ?></a>-->
									<i class="fa-user"></i><?php global $authordata; $post_author = "<a class='auth_meta' href=\"".get_author_posts_url( $authordata->ID, $authordata->user_nicename )."\">".get_the_author()."</a>\r\n"; echo $post_author; ?>
                                    <i class="postitle; fa-bars" style="color:#a9a9a9"></i><?php the_title(); ?>
		
									<!--<i class="fa-comments"></i><?php if (!empty($post->post_password)) { ?>
                                    <?php } else { ?><div class="meta_comm"><?php comments_popup_link(__('0 Comment', 'asteria'), __('1 Comment', 'asteria'), __('% Comments', 'asteria'), '', __('Off', 'asteria')); ?></div><?php } ?>-->
									<i class="fa-mail-forward"></i><?php if( function_exists('dot_irecommendthis') ) dot_irecommendthis(); ?> 
                                    <!--<i class="fa-th-list"></i><div class="catag_list"><?php the_category(', '); ?></div>-->
									
									<?php
										$url = get_bloginfo('url');
											if (current_user_can('edit_post', $post->ID)){
											echo '<a class="delete-post" href="';
											echo wp_nonce_url("$url/wp-admin/post.php?action=delete&post=$id", 'delete-post_' . $post->ID);
											echo '"><i> Vymazať</i></a>';
										  }
									?>
									
									
                                </div>
                                <!--POST INFO END-->
						
                                <!--POST CONTENT START-->
                                <?php // the_excerpt(); ?> 
                                <!--POST CONTENT END-->
                                <!--</div>-->

                            </div>
                        <?php endwhile ?> 
                        <?php ?>
                    </div>

                    <!--PAGINATION START-->
                    <div class="ast_pagenav">
                        <?php
                        global $wp_query;
                        $big = 999999999; // need an unlikely integer
                        echo paginate_links(array(
                            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                            'format' => '?paged=%#%',
                            'current' => max(1, get_query_var('paged')),
                            'total' => $wp_query->max_num_pages,
                            'show_all' => true,
                            'prev_next' => false
                        ));
                        ?>
                    </div>
                    <!--PAGINATION END-->

                </div>
                <!--SIDEBAR START-->
                <?php if (is_active_sidebar('sidebar')) { ?><?php get_sidebar(); ?><?php } ?>
                <!--SIDEBAR END-->
            </div>
        </div>
    </div>
</div>    
<?php get_footer(); ?>