<?php global $asteria;?>
<?php $homeposts = $asteria['home_sort_id']; if(!empty($homeposts['posts'])){ ?>
<!--Latest Posts-->
	<?php if ( asteria_is_mobile() && (!empty($asteria['hide_mob_frontposts'])) ) { ?>
    <?php }else{ ?>
	<?php get_template_part('layout'.$asteria['front_layout_id'].''); ?>
    <?php } ?>
<!--Latest Posts END-->
<?php } ?>

<!--?php if ( is_user_logged_in() ) && ( is_page('Profil') ) { global $current_user;       get_currentuserinfo(); echo 'User ID: ' . $current_user--->ID . "\n";

//The Query
query_posts('author='.$current_user-&gt;ID );

//The Loop
if ( have_posts() ) : while ( have_posts() ) : the_post();
the_title();
echo "
";
endwhile; else:
echo "The user has not contributed anything!";
endif;

//Reset Query
wp_reset_query();

} else {
echo 'Welcome, visitor!';
};
?&gt;