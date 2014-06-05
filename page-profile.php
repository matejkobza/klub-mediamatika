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
                        <div class="author_div" style="width: 100%; display: block;">
                            <div
                                class="author_left"><?php echo get_avatar($current_user->ID, $size = '100'); ?></div>
                            <div class="author_right">
                                <h2><?php echo $current_user->display_name; ?></h2>
                                <?php echo $current_user->user_description; ?>
                            </div>
                        </div>

                        <h3 class="author_posts"><?php _e('Moje príspevky ', 'asteria'); ?></h3>

                        <div class="lay4_inner">


                            <?php
                            //if a certain page, then display posts authored by the logged in user
                            $page_title = 'Profil';
                            global $current_user;
                            get_currentuserinfo();
                            $args = array(
                                'author' => $current_user->ID,
                                'post_type' => 'post',
                                'post_status' => 'publish, private',
                                'posts_per_page' => 'n',
                                'caller_get_posts' => 2
                            );
                            $my_query = null;
                            $the_query = new WP_Query($args);

                            ?>
                            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                                <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

                                    <div class="post_content" style="float:center; display:inline">
                                        <h2 class="postitle"><a href="<?php the_permalink(); ?>"
                                                                title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                        </h2>

                                        <?php switch ($categories[0]->cat_ID) {
                                            case 4: // fotografia
                                                require 'post-graphic.php';
                                                break;
                                            case 5: // grafika
                                                require 'post-graphic.php';
                                                break;
                                            case 6: // video
                                                require 'post-video.php';
                                                break;
                                            case 7: // audio
                                                require 'post-audio.php';
                                                break;
                                            case 8: // web
                                                require 'post-graphic.php';
                                                break;
                                            case 9: // text
                                                require 'post-text.php';
                                                break;
                                            case 76: // sutaz
                                                require 'post-graphic.php';
                                                break;
                                            case 77: // klub
                                                require 'post-text.php';
                                                break;
                                        }
                                        ?>
                                    </div>
                                </div>
                            <?php endwhile ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    </div>
                    <!--SIDEBAR START-->
                    <?php if (is_active_sidebar('sidebar')) { ?><?php get_sidebar(); ?><?php } ?>
                    <!--SIDEBAR END-->
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
            </div>
        </div>
    </div>
<?php get_footer(); ?>