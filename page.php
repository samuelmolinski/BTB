<?php if (!defined("ABSPATH")) die(); ?><?php get_header(); ?>
<?php get_template_part( "header", "inner" ) ?>
<?php the_post(); ?>
<?php 
	extract( (array) mint_get_page_settings() );

?>
<div id="mint-content" <?php post_class(array("elastic", $content_space)); ?>>
<?php if ($fullwidth) { ?>
		<div class="mint-content-fullwidth"><?php the_content(); ?></div>
<?php } else { ?>
	<div class="row">
		<div class="col-sm-9 <?php echo $content_position; ?>">
			<?php the_content(); ?>
		</div>
		<div class="col-sm-3">
			<div class="mint-aside">
				<?php dynamic_sidebar($sidebar); ?>
			</div>
		</div>
	</div>
<?php }; ?>
</div>
<?php get_footer(); ?>