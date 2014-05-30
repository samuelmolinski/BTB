<?php /* Template Name: Fullwidth Slider */ ?>
<?php get_header(); ?>
<?php get_template_part( "header", "inner" ) ?>
<?php the_post(); ?>
<?php 
	extract( (array) mint_get_page_settings() );

?>
<div id="mint-content" <?php post_class(array($content_space, 'mint-content-notopspace')); ?>>
	<?php the_content(); ?>
</div>
<?php get_footer(); ?>