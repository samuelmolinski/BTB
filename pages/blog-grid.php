<div class="blog-grid blog-inner-content">

<?php
	$blog_layout = MintOptions::get("blog-layout");
	$per_row = intval(str_replace("grid", "", $blog_layout));
	$grid_class = "col-sm-" . 12 / $per_row;
	$i = 0;
	$isClosed = false; // is the row div closed?, if not close it outside of loop
?>

<?php
	if(have_posts())
	{
		while (have_posts())
		{
			if($i == 0)
			{
				echo "<div class='row'>";
				$isClosed = false;
			}

			echo "<div class='{$grid_class}'>";

				the_post();
				$post_format = (get_post_format()) ? get_post_format() : "standard";
				get_template_part( "pages/grid-post-formats/format", $post_format );

				$i++; // increase iterator

			echo "</div>";

			if($i == $per_row)
			{
				echo "</div><!-- close the grid -->"; // close the grid
				$i = 0;
				$isClosed = true;
			}
		}

		if(!$isClosed) { echo "</div> <!-- final div is close -->";}
	}
	else
	{
		?>
		<h1 class="main-color"><?php _e("Nothing was found", "Mint"); ?></h1>
		<?php
	}
?>
</div>