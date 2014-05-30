<article {{ post_class }}>
	<div class="media">
		<div class="media-body">
			{{ if (has_gallery) }}
				<div class="article-thumbnail">
					{{ gallery_slider }}
				</div>
			{{ endif }}
		</div>
	</div>
</article> 