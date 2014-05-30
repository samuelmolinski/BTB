<article {{post_class}}>
	<div class="media">
		<div class="media-body">
			{{ if (has_post_thumbnail) }}
				<div class="article-thumbnail">
					<a href="{{ permalink }}"><img src="{{ thumb }}" {{retina}} width="{{ thumb_width }}" alt="" /></a>
				</div>
			{{ endif }}
			
				<div class="article-body">
					
					<div class="article-meta">
						{{ if (has_date) }}
							<span class="article-meta-date">{{ str.posted }}: <a href="{{ daylink }}">{{ the_date }}</a></span>
						{{ endif }}
					

						{{ if (has_comments_count) }}
							<span class="article-meta-comments-count"><a href="{{permalink}}#comments">{{ comments_number }}</a></span>
						{{ endif }}
						
					</div>

					<div class="article-excerpt">
						{{excerpt}}
					</div>
				</div>
		</div>
	</div>
</article> 