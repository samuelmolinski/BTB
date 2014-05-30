<?php
class MintUtils
{

	public static function init() 
	{
		self::header_cleanup();
	}

	public static function header_cleanup()
	{

	}

	public static function thumb( $post_id , $w, $h , $resize = true , $c = true) 
	{

		if (!$post_id) return;

		list($r) = wp_get_attachment_image_src(get_post_thumbnail_id( $post_id ) , "original" );
		if (!$resize) 
		{
			return $r;
		}
		return self::resized($r , $w , $h, $c );
	}

	public static function resized( $src, $w, $h, $c = true )
	{

		$file = pathinfo($src);

		if(!is_array($file)) return false;
		
		$saveTo =  get_template_directory() . "/cache/";
		$saveToURI = get_template_directory_uri() . "/cache/";

		if (!isset( $file['filename'] ) || !isset($file['extension'])) return;

		$fileName =  md5($src) . "-" . $w . "x" . $h . "." . $file['extension'] ;

		
		if ( !in_array(  $file['extension'],array('jpg', 'jpeg', 'gif', 'png') ) ) return $src; // bail early

		if ( ! file_exists( $saveTo . $fileName ) )
		{
			$image = wp_get_image_editor($src);
			if (!is_wp_error( $image ))
			{
				$image->resize($w, $h, $c);
				$saved = $image->save( $saveTo . $fileName );
			}
		}

		return $saveToURI .  $fileName;
	}



	function getThumb( $src, $width = NULL, $height = NULL )
	{
		// retrieve image info
		$info = pathinfo($src);
		$name = $info['filename'] . "-" . $width . "x" . $height . "." . $info['extension']; // new image name
		$path = get_template_directory() . "/thumbs/"; // image path where to save
		// check if file exists return it (thumb)
		if(file_exists( $path . $name ))
		{
		return get_template_directory_uri() . "/thumbs/" . $name;
		}
		else // if no thumb available generate one and return the file
		{
		$image = wp_get_image_editor( $src );
		 
		if( !is_wp_error( $image ) )
		{
		$image->resize($width, $height, true);
		$newImage = $image->save( $path . $name );
		return get_template_directory_uri() . "/thumbs/" . $newImage['file'];
		}
		}
		return false;
	}



	public static function pagination( $wp_query )
	{
		  global $wp_rewrite;
		  $pages = '';
		  $max = $wp_query->max_num_pages;
		  if (!$current = get_query_var('paged')) $current = 1;
		  $args['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
		  $args['total'] = $max;
		  $args['current'] = $current;
		 
		  $total = 1;
		  $args['mid_size'] = 3;
		  $args['end_size'] = 1;
		  $args['prev_text'] = 'Previous'; // &laquo;
		  $args['next_text'] = 'Next'; // &raquo;

		  $args['type'] = 'list';

		  $pagination =  paginate_links($args);

		  // fix style to match bootstrap
		  $pagination = str_replace("page-numbers", "pagination", $pagination);
		 
		  return "<div class='pagination center'>" . $pagination . "</div>";
	}


	public static function getCommentForm()
	{
			if(is_user_logged_in())
			{
				$fields = array(
					'author'  => '<p><input required="required" name="author"  type="text" id="for_name" placeholder="Name *" /></p>',
					'email'   => '<p><input required="required" name="email" type="email" id="for_email" placeholder="Email *" /></p>',
					'url'     => '<p><input type="text" name="url" id="for_website" placeholder="Website" /></p>'
				);

				$args = array(
					'comment_notes_after' => false,
					'fields'              => $fields,
					'title_reply'         => 'Post Comment',
					'comment_field'       => '<p><textarea name="comment" required="required" id="for_message" placeholder="Message"></textarea></p>'
					);

			}
			else
			{
				$fields = array(
					'author'  => '<div class="row"><div class="col-sm-6"><p><input required="required" name="author"  type="text" id="for_name" placeholder="Name *" /></p>',
					'email'   => '<p><input required="required" name="email" type="email" id="for_email" placeholder="Email *" /></p>',
					'url'     => '<p><input type="text" name="url" id="for_website" placeholder="Website" /></p></div>'
				);

				$args = array(
					'comment_notes_after' => false,
					'fields'              => $fields,
					'title_reply'         => 'Post Comment',
					'comment_field'       => '<div class="col-sm-6"><p><textarea name="comment" required="required" id="for_message" placeholder="Message"></textarea></p></div></div>'
					);

			}

		?>
		<div class="space30">&nbsp;</div>
		<div class="comments-form">
			<?php comment_form( $args );  ?> 
		</div>


		<?php
	}


	public static function listComments($comment, $args , $depth)
	{
			$GLOBALS['comment'] = $comment;
			switch ( $comment->comment_type ) :
				case 'pingback' :
				case 'trackback' :
				// Display trackbacks differently than normal comments.
			?>
			<div <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<p>
					<?php _e( 'Pingback:', 'twentytwelve' ); ?> 
							<?php comment_author_link(); ?> 
							<?php edit_comment_link( __( '(Edit)', 'Mint' ), '<span class="edit-link">', '</span>' ); ?>
				</p>
			</div>
			<?php
					break;
				default :
				// Proceed with normal comments.
				global $post;
			?>
			

		<div <?php comment_class("comments-post-user media"); ?>  id="comment-<?php comment_ID(); ?>">
			<div class="comments-gravatar pull-left">
				<?php echo get_avatar($comment, 48); ?>
			</div>

			<div class="comments-content media-body">
				<div class="comment-content-reply"><?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'Mint' ), 'before' => ' <span>&rarr;</span> ', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></div>

				<h4 class="comments-content-author theme-color-text"><?php echo get_comment_author_link() ?> <small class="comments-content-date"><?php echo human_time_diff( get_comment_time('U'), current_time('timestamp') ) . ' ago'; ?></small></h4>
				<div class="comments-content-text mb5">
					<?php comment_text(); ?>
				</div>
			</div>

		</div>


			<?php
				break;
			endswitch; // end comment_type check


	}


	public static function getAttachedImages ( $post_id )
	{
		$images = get_posts('post_type=attachment&order=ASC&orderby=menu_order&posts_per_page=-1&post_parent='.$post_id);
		$return = array();
		if (!empty($images)) {
			foreach($images as $image)
			{
				if ( stristr($image->post_mime_type, "image/") === false) continue;
				$return[] = array( 'title' => $image->post_title, 'src' => $image->guid , 'id' => $image->ID );
			}
		}
		return $return;
	}

	function getAttachmentMeta( $attachment_id ) {

		$attachment = get_post( $attachment_id );
		return array(
			'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
			'caption' => $attachment->post_excerpt,
			'description' => $attachment->post_content,
			'href' => get_permalink( $attachment->ID ),
			'src' => $attachment->guid,
			'title' => $attachment->post_title
		);
	}
	

	/* If WPML exists and activated or qTranslate exists or activated will show the flags */
	public static function getLanguageSelector()
	{
		if (function_exists('qtrans_generateLanguageSelectCode'))
		{
			return qtrans_generateLanguageSelectCode('image', 'ff-languages');
		}

		
		if (function_exists('icl_get_languages'))
		{
			$langs = icl_get_languages('skip_missing=0');

			$return = "<ul id='ff-languages-chooser'>";
			if (!empty($langs) && is_array($langs))
			{
				foreach ($langs as $lang)
				{
					$return .= "<li><a title='".$lang['native_name']."' href='".$lang['url']."'><img src='".$lang['country_flag_url']."' /></a></li>";
				}
			}

			$return .= "</ul>";
			return $return;
		}

		return false;
	}

	public static function parseYoutubeUrl( $url )
	{
		if (strpos( $url,"v=") !== false)
	    {
	        return substr($url, strpos($url, "v=") + 2, 11);
	    }
	    elseif(strpos( $url,"embed/") !== false)
	    {
	        return substr($url, strpos($url, "embed/") + 6, 11);
	    }

	    return false;
		
	}

	public static function parseVimeoUrl( $url )
	{
		return (int)substr(parse_url($url, PHP_URL_PATH), 1);
	}

	public static function getBreadcrumbs( $del = " &raquo; " ) 
	{
		/* === OPTIONS === */
		$text['home']     = __('Home', 'Mint'); // text for the 'Home' link
		$text['category'] = __('Archive by Category "%s"', 'Mint'); // text for a category page
		$text['search']   = __('Search Results for "%s" Query', 'Mint'); // text for a search results page
		$text['tag']      = __('Posts Tagged "%s"', 'Mint'); // text for a tag page
		$text['author']   = __('Articles Posted by %s', 'Mint'); // text for an author page
		$text['404']      = __('Error 404', 'Mint'); // text for the 404 page

		$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
		$showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
		$delimiter   = $del; // delimiter between crumbs
		$before      = '<span class="current">'; // tag before the current crumb
		$after       = '</span>'; // tag after the current crumb
		/* === END OF OPTIONS === */

		global $post;
		$homeLink = home_url() . '/';
		$linkBefore = '<span>';
		$linkAfter = '</span>';
		$linkAttr = ' ';
		$link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;

		if (is_home() || is_front_page()) {

			if ($showOnHome == 1) echo '<div id="breadcrumbs"><a href="' . $homeLink . '">' . $text['home'] . '</a></div>';

		} else {

			echo '<div id="breadcrumbs">' . sprintf($link, $homeLink, $text['home']) . $delimiter;

			if ( is_category() ) {
				$thisCat = get_category(get_query_var('cat'), false);
				if ($thisCat->parent != 0) {
					$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
					$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
					$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
					echo $cats;
				}
				echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

			} elseif ( is_search() ) {
				echo $before . sprintf($text['search'], get_search_query()) . $after;

			} elseif ( is_day() ) {
				echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
				echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
				echo $before . get_the_time('d') . $after;

			} elseif ( is_month() ) {
				echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
				echo $before . get_the_time('F') . $after;

			} elseif ( is_year() ) {
				echo $before . get_the_time('Y') . $after;

			} elseif ( is_single() && !is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
					if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
				} else {
					$cat = get_the_category(); $cat = $cat[0];
					$cats = get_category_parents($cat, TRUE, $delimiter);
					if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
					$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
					$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
					echo $cats;
					if ($showCurrent == 1) echo $before . get_the_title() . $after;
				}

			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
				$post_type = get_post_type_object(get_post_type());
				echo $before . $post_type->labels->singular_name . $after;

			} elseif ( is_attachment() ) {
				$parent = get_post($post->post_parent);
				$cat = get_the_category($parent->ID); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo $cats;
				printf($link, get_permalink($parent), $parent->post_title);
				if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

			} elseif ( is_page() && !$post->post_parent ) {
				if ($showCurrent == 1) echo $before . get_the_title() . $after;

			} elseif ( is_page() && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					echo $breadcrumbs[$i];
					if ($i != count($breadcrumbs)-1) echo $delimiter;
				}
				if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

			} elseif ( is_tag() ) {
				echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				echo $before . sprintf($text['author'], $userdata->display_name) . $after;

			} elseif ( is_404() ) {
				echo $before . $text['404'] . $after;
			}

			if ( get_query_var('paged') ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
				echo __('Page', 'Mint') . ' ' . get_query_var('paged');
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
			}

			echo '</div>';

		}
	}

	// As seen on http://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/
	function  hex2rgb($hex) {
	   $hex = str_replace("#", "", $hex);

	   if(strlen($hex) == 3) {
	      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
	      $r = hexdec(substr($hex,0,2));
	      $g = hexdec(substr($hex,2,2));
	      $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);

	   return implode(",", $rgb); // returns the rgb values separated by commas
	   //return $rgb; // returns an array with the rgb values
	}

	function rgb2hex($rgb) {
	   $hex = "#";
	   $hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
	   $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
	   $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);

	   return $hex; // returns the hex value including the number sign (#)
	}
	
}