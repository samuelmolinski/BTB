<article {{post_class}}>
	<div class="media">
			{{ if (has_author_icon || has_date ) }} 
			<div class="article-info pull-left">

				{{ if (has_author_icon) }}
					{{avatar}}
				{{endif}}

				{{ if (has_date) }}
					<p class='article-date'><span class='article-date-month'>{{ date.month }}</span><span class='article-date-day'>{{date.date}}</span></p>
				{{endif}}
			
			</div>
		{{ endif }}

		<div class="media-body">
			{{ if (has_post_thumbnail) }}
				<div class="article-thumbnail">
					<a href="{{ permalink }}"><img src="{{ thumb }}" {{ retina }} width="{{ thumb_width }}" alt="" /></a>
				</div>
			{{ endif }}
		</div>
	</div>
</article> 