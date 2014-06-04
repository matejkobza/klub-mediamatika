<?php
/*
  Template Name: posts
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

                    <div class="lay4_wrap">

                        <!--SIDEBAR START-->
                        <?php if (is_active_sidebar('sidebar')) { ?><?php get_sidebar(); ?><?php } ?>
                        <!--SIDEBAR END-->

                        <?php
                        $id = get_the_ID();
                        $category = get_the_category();
                        $args = array(
                            'post_type' => 'post',
                            'paged' => (get_query_var('paged') ? get_query_var('paged') : 1),
                            'cat' => $category[0]->cat_ID,
                            'posts_per_page' => '12',
                            'post__not_in' => array($id),
                        );
                        $the_query = new WP_Query($args);
                        //                        $the_query = query_posts($args);
                        ?>
                        <?php if ($the_query->have_posts()): ?><?php while ($the_query->have_posts()): ?><?php $the_query->the_post(); ?>
                            <?php if (!in_array("page", get_post_class())) { ?>
                                <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                                    <?php
                                    global $wp_query;
                                    $postid = $wp_query->post->ID;
                                    $categories = get_the_category();
                                    ?>
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
                            <?php } ?>
                        <?php endwhile ?>
                            <?php wp_reset_postdata(); ?>
                        <?php endif ?>

                        <!--PAGINATION START-->
                        <div class="ast_pagenav">
                            <?php
                            $big = 999999999; // need an unlikely integer
                            echo paginate_links(array(
                                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                                'format' => '?paged=%#%',
                                'current' => max(1, get_query_var('paged')),
                                'total' => $the_query->max_num_pages,
                                'show_all' => true,
                                'prev_next' => false
                            ));
                            ?>
                        </div>
                        <!--PAGINATION END-->
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>