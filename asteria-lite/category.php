<?php get_header(); ?>
<?php global $asteria;?>
<!--Categoryt Posts-->
<div class="fixed_site">
	<div class="fixed_wrap">
		<?php get_template_part('layout4'); ?>
	</div>
</div>

<?php if ( is_active_sidebar( 'sidebar' ) ) { ?><?php get_sidebar();?><?php } ?>

<?php get_footer(); ?>