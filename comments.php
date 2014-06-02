<?php

if ( post_password_required() ) { ?>
<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'asteria'); ?></p>
<?php
return;
}
?>
 
<!-- You can start editing here. -->
 
<?php if ( have_comments() ) : ?>
<?php if ( ! empty($comments_by_type['komentár']) ) : ?>

<h3 id="comments"><?php comments_number(__( 'Žiadne komentáre', 'asteria'), __('Jeden komentár', 'asteria'), __('Dva komentáre', 'asteria'), __('Tri komentáre', 'asteria'), __('Štyri komentáre', 'asteria'), __('% Komentárov', 'asteria'));?> to &#8220;<a><?php the_title(); ?></a>&#8221;</h3>
 
 
<ul class="commentlist">	

<?php wp_list_comments('type=comment&callback=asteria_comment');?>
</ul>

 <div class="navigation">
<?php paginate_comments_links( array('prev_text' => '&laquo;', 'next_text' => '&raquo;')) ?> 
</div>

<?php endif; ?>
<?php if ( ! empty($comments_by_type['pings']) ) : ?>
<h3 id="comments_ping"><?php _e('Trackbacks &amp; Pings', 'asteria'); ?></h3>
 
<ul class="commentlist" id="ping">
<?php wp_list_comments('type=pings&callback=asteria_ping'); ?>
</ul>

<div class="navigation">
<?php paginate_comments_links( array('prev_text' => '&laquo;', 'next_text' => '&raquo;')) ?>
</div>

<?php endif; ?>
 



<?php else : // this is displayed if there are no comments so far ?>
 
<?php if ('open' == $post->comment_status) : ?>
<!-- If comments are open, but there are no comments. -->
 
<?php else : // comments are closed ?>
<!-- If comments are closed. -->
<?php if ( !is_page() ) { ?><p class="nocomments"><?php _e('Komentovanie nie je možné.', 'asteria'); ?></p><?php } ?>
 
<?php endif; ?>
<?php endif; ?>
 

<?php 
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );

$comment_args = array( 'title_reply'=>''. __( 'Vyjadri sa k dielu', 'asteria' ) . '',

'fields' => apply_filters( 'comment_form_default_fields', array(

  'author' => '<div class="comm_wrap"><p class="comment-form-author"><input placeholder="' . __( 'Meno', 'asteria' ) . '" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .'" size="30"' . $aria_req . ' /></p>',

  'email' => '<p class="comment-form-email"><input placeholder="' . __( 'Email', 'asteria' ) . '" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .'" size="30"' . $aria_req . ' /></p>',

  'url' => '<p class="comment-form-url"><input placeholder="' . __( 'Web', 'asteria' ) . '" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .'" size="30" /></p></div>')
  
 ));

comment_form($comment_args); ?>




