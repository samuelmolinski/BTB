<?php if (!defined('ABSPATH')) die(); ?>
<?php get_header(); ?>
<?php get_template_part( "header", "inner" ); ?>
<?php 

	the_post();

?>
<div id="mint-content">
	<div class="elastic">
		<div class="mint-content-section">
			<?php the_content(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>