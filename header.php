<?php global $asteria;?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=UTF-8" />	
<title><?php wp_title( '|', true, 'right' ); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1">
<?php get_template_part('style');?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_head(); ?>
<script language="javascript" type="text/javascript" >
  jQuery(document).ready(function() {

    jQuery('#menu-item-59').find('a').live('click', function() {
      jQuery('a.login').click();
      return false;
    });

    jQuery('#menu-item-92').find('a').attr('href', '<?php echo wp_logout_url(home_url())?>')

  });
</script>
</head>

<body <?php body_class(); ?>>

<!-- modal login button is hidden -->
<div style="display:none;">
<?php add_modal_login_button( $login_text = 'Login', $logout_text = 'Logout', $logout_url = '', $show_admin = true ); ?>
</div>
<!--Header-->
<div class="fixed_site">
<!--Maintenance Mode Message-->
<?php if((!empty($asteria['offline_id']))){ ?>
<div class="lgn_info"><?php _e('The Website is running in Maintenance Mode.', 'asteria'); ?></div>
<?php } ?>

<!--Get Header Type-->
<?php get_template_part('head4'); ?>
</div>