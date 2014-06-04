<?php
global $wp_query;
$postid = $wp_query->post->ID;?>
<!--POST INFO START-->

<img src="<?php echo getphpthumburl(get_the_content(), 'h=225&w=400&zc=1'); ?>" alt="<?php echo get_the_title(); ?>"
     width="400" height="225"/>
<div class="single_metainfo" align="center">

    <!--POST META INFO START-->
    <div class="single_metainfo" align="center">
        <i class="fa-user"></i><?php global $authordata;
        $post_author = "<a class='auth_meta' href=\"" . get_author_posts_url($authordata->ID, $authordata->user_nicename) . "\">" . get_the_author() . "</a>\r\n";
        echo $post_author; ?>

        <i class="fa-comments"></i><?php if (!empty($post->post_password)) { ?>
        <?php } else { ?>
            <div
                class="meta_comm"><?php comments_popup_link(__('0 Komentárov', 'asteria'), __('1 Komentár', 'asteria'), __('2 Komentáre', 'asteria'), __('3 Komentáre', 'asteria'), __('4 Komentáre', 'asteria'), __('% Komenárov', 'asteria'), '', __('Off', 'asteria')); ?></div><?php } ?>

        <i class="fa-mail-forward"></i><?php if (function_exists('dot_irecommendthis')) dot_irecommendthis(); ?>
        <!--<i class="fa-th-list"></i><div class="catag_list"><?php the_category(', '); ?></div>-->
        <i class="fa-eye"></i><?php echo getPostViews(get_the_ID()); ?>
        <?php
        $url = get_bloginfo('url');
        if (current_user_can('edit_post', $post->ID)) {
            echo '<a class="delete-post" href="';
            echo wp_nonce_url("$url/wp-admin/post.php?action=delete&post=$id", 'delete-post_' . $post->ID);
            echo '"><i> Vymazať</i></a>';
        }
        ?>
        <!--SOCIAL SHARE POSTS START-->
        <?php if (!empty ($asteria['social_single_id']) || !get_option('asteria')) { ?>
            <?php get_template_part('share_this'); ?>
        <?php } ?>
        <!--SOCIAL SHARE POSTS END-->
    </div>
</div>
									
