<article {{ post_class }} >
	<div class="media">
		<div class="media-body">
			<div class="article-quote">
				<blockquote class="mint-quote-a">
					<div class="mint-quote-text">{{ quote_text }}</div>
					{{ if (quote_author) }}
						<div class="mint-quote-author pull-right">&mdash; {{ quote_author }}</div>
					{{ endif }}
					<div class="clearfix"></div>
				</blockquote>
			</div>
			
				<div class="article-body">
					<h2 class="article-title"><a href="{{ permalink }}">{{ title }}</a></h2>
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
