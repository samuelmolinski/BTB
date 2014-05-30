<?php if (!defined("ABSPATH")) die(); ?><div class="space60">&nbsp;</div>
<h3><?php _e("Comments", "Mint"); ?></h3>
<?php 

wp_list_comments( array(
	'callback' => array('MintUtils', 'listComments')
) );
MintUtils::getCommentForm();