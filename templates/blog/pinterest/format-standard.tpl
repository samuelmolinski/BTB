<article {{post_class}}>
	<div class="media">
		<div class="media-body">
			{{ if (has_post_thumbnail) }}
				<div class="article-thumbnail">
					<a href="{{ permalink }}"><img src="{{ thumb }}" {{ retina }} width="{{thumb_width}}" alt="" /></a>
				</div>
			{{ endif }}
			
				<div class="article-body">
					<h2 class="article-title"><a href="{{permalink}}">{{title}}</a></h2>
					<div class="article-meta">
						{{ if (has_author) }}
							<span class="article-meta-author">{{ str.by }}: {{ the_author_link }}</span>
						{{ endif }}
						

						{{ if (has_author) }}
							<span class="article-meta-date">{{ str.posted }}: <a href="{{ daylink }}">{{ the_date }}</a></span>
						{{ endif }}
						
					</div>

					<div class="article-excerpt">
						{{ excerpt }}
					</div>
				</div>

				<div class="article-caption">
					<div class="article-caption-comment pull-left">
						{{ if (has_comments_count) }}
							<i class="icon-chat"></i>
							<span class="article-meta-comments-count"><a href="{{permalink}}#comments">{{ comments_number }}</a></span>
						{{ endif }}
					</div>
					<div class="article-caption-readmore pull-right">
						<div class="article-more"><a href="{{ permalink }}"><i class="icon-right-thin"></i> {{ str.more }}</a></div>
					</div>

					<div class="clearfix"></div>
				</div>
		</div>
	</div>
</article> 