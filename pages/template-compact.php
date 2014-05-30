<?php // Template Name: Compact ?>
<?php get_header("compact"); ?>
<?php the_post(); ?>
<div id="mint-content" <?php post_class("elastic"); ?>>
	<?php the_content(); ?>
</div>
<?php get_footer("compact"); ?>