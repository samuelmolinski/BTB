<article {{post_class}}>
	{{ if (has_post_thumbnail) }}
		<div class="article-thumbnail pinterest-grid-postformat-image">
			<a href="{{ permalink }}"><img src="{{thumb}}"  {{ retina }} width="{{ thumb_width }}" alt="" /></a>
		</div>
	{{ endif }}
</article> 