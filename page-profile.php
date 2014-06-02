<?php
/*
  Template Name: Profil
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

        <div class="lay4">
            <div class="center">

                <div class="lay4_wrap<?php if (!is_active_sidebar('sidebar')) { ?> no_sidebar<?php } ?>">
						<div class="author_div">
							<div class="author_left"><?php echo get_avatar($current_user->ID, $size = '100'); ?></div>
							<div class="author_right">
								<h2><?php echo $current_user->display_name; ?></h2>
									<?php echo $current_user->user_description; ?>
							</div>
						</div>

								<h3 class="author_posts"><?php _e('Moje príspevky ', 'asteria');?></h3>
                    <div class="lay1_inner">
			

                        <?php
//if a certain page, then display posts authored by the logged in user
                        $page_title = 'Profil';
                        if (is_user_logged_in() && is_page($page_title)) {
                            global $current_user;
                            get_currentuserinfo();
//  echo 'User ID: ' . $current_user->ID . "\n";
                            $args = array(
                                'author' => $current_user->ID,
                                'post_type' => 'post',
                                'post_status' => 'publish, private',
                                'posts_per_page' => 'n',
                                'caller_get_posts' => 2
                            );
                            $my_query = null;
                            $the_query = new WP_Query($args);
                        }
                        ?>
                        <?php
//	 $args = array(
//				   'post_type' => 'post',
//				   'cat' => ''.$asteria['blog_cat_id'].'',
//				   'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
//				   'posts_per_page' => '6');
//	$the_query = new WP_Query( $args );
                        ?>
                        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                            <div <?php post_class(); ?> id="post-<?php the_ID(); ?>"> 

                                <?php
                                global $wp_query;
                                $postid = $wp_query->post->ID;
                                $categories = get_the_category();
                                ?>

                                <h2 class="postitle"><?php the_title(); ?></h2>
                                <?php
                                if ($categories[0]->cat_ID == 7) { // audio
                                    $shortcode = "[soundcloud id='" . get_the_content() . "' playerType='Standard']";
                                    echo do_shortcode($shortcode);
                                } else if ($categories[0]->cat_ID == 6) {// video
                                    $url = get_the_content();
                                    parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
                                    $id = $my_array_of_vars['v'];
                                    ?>
                                    <object width="400" height="225"> 
                                        <param name="movie" value="https://www.youtube.com/v/<?php echo $id; ?>?version=3"></param> 
                                        <param name="allowFullScreen" value="true"></param> 
                                        <param name="allowScriptAccess" value="always"></param> 
                                        <embed src="https://www.youtube.com/v/<?php echo $id; ?>?version=3" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="400" height="225"></embed> 
                                    </object>
                                    <?php
                                } else if ($categories[0]->cat_ID == 5) {//grafika
                                    ?>
                                    <img src="<?php echo getphpthumburl(get_the_content(), 'h=225&w=400&zc=1'); ?>" alt="<?php echo get_the_title(); ?>" width="400" height="225" />
                                    <?php
                                } else if ($categories[0]->cat_ID == 76) {//sutaz
                                    ?>
                                    <img src="<?php echo getphpthumburl(get_the_content(), 'h=225&w=400&zc=1'); ?>" alt="<?php echo get_the_title(); ?>" width="400" height="225" />
                                    <?php
                                }	else if ($categories[0]->cat_ID == 8) {//web
                                ?>	<img src="<?php echo getphpthumburl(get_the_content(), 'h=225&w=400&zc=1'); ?>" alt="<?php echo get_the_title(); ?>" width="400" height="225" />
									<?php
								}	else if ($categories[0]->cat_ID == 9) {//text
                                ?>  <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( ); ?>"><text style="color:#a9a9a9; font-size:10"><i class="fa-book"></i> Čítať</a>
									<?php the_excerpt(); ?> 
									<?php
								}	else if ($categories[0]->cat_ID == 4) {//fotografia
								?>	<img src="<?php echo getphpthumburl(get_the_content(), 'h=225&w=400&zc=1'); ?>" alt="<?php echo get_the_title(); ?>" width="400" height="225" />
									<?php
								}
								?>
                                <!--POST INFO START-->
                                <div class="single_metainfo" >
									
                                    <i class="fa-calendar"></i><a class="comm_date"><?php the_time(get_option('date_format')); ?></a>
                                    <i class="fa-user"></i><a class="meta_auth"><?php the_author(); ?></a>
                                    <!--<i class="fa-comments"></i><?php if (!empty($post->post_password)) { ?>
                                    <?php } else { ?><div class="meta_comm"><?php comments_popup_link(__('0 Comment', 'asteria'), __('1 Comment', 'asteria'), __('% Comments', 'asteria'), '', __('Off', 'asteria')); ?></div><?php } ?>-->
									<?php if( function_exists('dot_irecommendthis') ) dot_irecommendthis(); ?>
								
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
                                <?php// the_excerpt(); ?> 
                                <!--POST CONTENT END-->


                            </div>
                        <?php endwhile ?> 
                        <?php wp_reset_postdata(); ?>
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
                            'prev_next' => true
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