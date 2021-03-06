<article {{ post_class }}>
	<div class="media">
		{{ if (has_date || has_author_icon) }}
			<div class="article-info pull-left">
				{{ if (has_author_icon) }}
					{{avatar}}
				{{endif}}

				{{ if (has_date) }}
					<p class='article-date'><span class='article-date-month'> {{ date.month }}</span><span class='article-date-day'> {{ date.date }}</span></p>
				{{endif}}
				
			</div>
		{{endif}}

		<div class="media-body">
				{{ if (has_audio ) }}
				<div class="article-thumbnail">
					{{ embed }}
				</div>
				{{ endif }}
			
				<div class="article-body">
					<h2 class="article-title"><a href="{{permalink}}">{{ title }}</a></h2>
					<div class="article-meta">
						{{ if (has_author) }}
							<span class="article-meta-author">{{ str.by }}: {{ the_author_link }}</span>
						{{ endif }}
						
						
						{{ if (has_comments_count) }}
							<span class="article-meta-comments-count"><a href="{{ permalink }}#comments">{{ comments_number }}</a></span>
						{{ endif }}

						{{ if (has_categories) }}
							<span class="article-meta-category">{{ str.in }}: {{ categories }}</span>
						{{ endif }}

						{{ if (has_tags) }}
							<span class="article-meta-tags">{{ tags }}</span>
						{{ endif }}
					</div>

					<div class="article-excerpt">
						{{ excerpt }}
					</div>
					<div class="article-more"><a href="{{ permalink }}"><i class="icon-right-thin"></i>{{ str.read_ahead }}</a></div>
				</div>
		</div>
	</div>
</article> 