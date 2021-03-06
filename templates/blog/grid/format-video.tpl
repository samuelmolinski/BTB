<article {{post_class}}>
	<div class="media">
		<div class="media-body">
			{{ if (has_video) }}
				<div class="article-thumbnail">
					<div class="video-elastic">{{ embed_video }}</div>
				</div>
			{{ endif }}
			
				<div class="article-body">
					<h2 class="article-title"><a href="<?php echo get_permalink(); ?>">{{ title }}</a></h2>
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