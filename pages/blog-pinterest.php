<div class="blog-pinterest blog-inner-content">
<?php
	if(have_posts())
	{
		while (have_posts())
		{
			the_post();
			$post_format = (get_post_format()) ? get_post_format() : "standard";
			get_template_part( "pages/pinterest-post-formats/format", $post_format );
		}
	}
	else
	{
		?>
		<h1 class="main-color"><?php _e("Nothing was found", "Mint"); ?></h1>
		<?php
	}
?>
</div>