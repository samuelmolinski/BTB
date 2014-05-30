<article {{post_class}}>
	<div class="media">
		<div class="media-body">
			{{ if (has_post_thumbnail) }}
				<div class="article-thumbnail">
					<a href="{{permalink}}"><img src="{{ thumb }}" {{ retina }} width="{{ thumb_width }}" alt="" /></a>
				</div>
			{{ endif }}
		</div>
	</div>
</article> 