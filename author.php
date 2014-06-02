<?php get_header(); ?>
<?php
if(isset($_GET['author_name'])) :
$curauth = get_userdatabylogin($author_name);
else :
$curauth = get_userdata(intval($author));
endif;
?>
<!--Content-->
<div class="fixed_site">
	<div class="fixed_wrap">
<div id="content">
<div class="center">

<div class="lay4">
	
<div class="lay4_wrap<?php if ( !is_active_sidebar( 'sidebar' ) ) { ?> no_sidebar<?php } ?>">
		
<div class="author_div">
		
    <div class="author_left"><?php echo get_avatar($curauth->ID, $size = '100'); ?></div>
    <div class="author_right">
    <h2><?php echo $curauth->display_name; ?></h2>
	<div class="fa-envelope" style="color:#a9a9a9"><a href="mailto:<?php echo get_the_author_meta("user_email");?>" class="meta_auth" style="font-family:Corbel"><i> Napísať e-mail   </a></i></div>
    <?php
	global $wp_query;
	$curauth = $wp_query->get_queried_object();
	$post_count = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_author = '" . $curauth->ID . "' AND post_type = 'post' AND post_status = 'publish'");
	?>
	<div class="fa-thumb-tack" style="color:#a9a9a9"><i style="font-family:Corbel"> Príspevkov: <?php echo $post_count; ?> . </i></div>
	<div> <?php echo $curauth->user_description; ?></div>
    </div>

	
</div>


<h3 class="author_posts"><?php _e('Príspevky od ', 'asteria');?><?php echo $curauth->display_name; ?></h3>
<div class="lay4_inner">

                   <?php if(have_posts()): ?><?php while(have_posts()): ?><?php the_post(); ?>
                <div <?php post_class(); ?> id="post-<?php the_ID(); ?>"> 

                <div class="post_content" style="float:center; display:inline">
	
 
					<?php
                                global $wp_query;
                                $postid = $wp_query->post->ID;
                                $categories = get_the_category();
                                ?>
            
                <h2 class="postitle"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
</h2>
				<?php switch($categories[0]->cat_ID)
				{
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
				}?>                               

                                

                
                        </div>
            <?php endwhile ?> 
			<?php wp_reset_postdata(); ?>
            <?php endif ?>
			
</div>
<div class="ast_pagenav">
<?php
global $wp_query;
$big = 999999999; // need an unlikely integer
echo paginate_links( array(
	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	'format' => '?paged=%#%',
	'current' => max( 1, get_query_var('paged') ),
	'total' => $wp_query->max_num_pages,
	'show_all'     => true,
	'prev_next'    => false

) );
?>
</div>
</div>
 
    <!--PAGE END-->
	

<?php get_sidebar();?>
			</div>
		</div>
	</div>

</div>
</div>
<?php get_footer(); ?>