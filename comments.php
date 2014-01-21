<ol class="commentlist">
<?php $args = array(
	'walker'            => null,
	'max_depth'         => '',
	'style'             => 'ol',
	'callback'          => 'my_comments',
	'end-callback'      => null,
	'type'              => 'comment',
	'reply_text'        => 'Reply',
	'page'              => '',
	'per_page'          => '200',
	'avatar_size'       => 240,
	'reverse_top_level' => null,
	'reverse_children'  => ''
);
wp_list_comments($args); 
?>
</ol>
<?php
if (trackback_count() > 0) {
?>

<h4>Other mentions</h4>
<ol class="commentlist pings">
<?php $args = array(
	'walker'            => null,
	'max_depth'         => '',
	'style'             => 'ol',
	'callback'          => 'my_pings',
	'end-callback'      => null,
	'type'              => 'pings',
	'reply_text'        => 'Reply',
	'page'              => '',
	'per_page'          => '200',
	'avatar_size'       => 240,
	'reverse_top_level' => null,
	'reverse_children'  => ''
);
wp_list_comments($args); 
?>
</ol>
<?php
}
?>
