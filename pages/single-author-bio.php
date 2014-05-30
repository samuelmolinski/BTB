<div class="space60">&nbsp;</div>
<h3><?php _e('About Author', 'Mint'); ?></h3>
<?php 
	
	global $mint_social_networks;

?>

<div class="author-bio">
	<div class="media author-content">
		<div class="pull-left"><?php echo get_avatar(get_the_author_meta( 'ID' ), 84); ?></div>
		<div class="media-content">
			<h5 class="author-name"><?php echo get_the_author_link(); ?></h5>
			<?php echo get_the_author_meta('description'); ?>
		</div>
	</div>
	<div class="author-caption">
		<p class="pull-left"><?php _e("Number of Posts", "Mint"); ?> <?php echo count_user_posts(get_the_author_meta("ID")); ?></p>
		<p class="pull-right">
			<?php
				foreach ($mint_social_networks as $key => $val) {
					if(get_the_author_meta( $key ))
					{
						echo "<a href='".get_the_author_meta($key)."' target='_blank'><i class='icon-{$key}'></i></a>";
					}
				}
			?>
		</p>
		<div class="clearfix"></div>
	</div>
</div>

	