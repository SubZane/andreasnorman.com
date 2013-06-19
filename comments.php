<ol class="commentlist">
<?php $args = array(
	'walker'            => null,
	'max_depth'         => '',
	'style'             => 'ol',
	'callback'          => 'my_comments',
	'end-callback'      => null,
	'type'              => 'all',
	'reply_text'        => 'Reply',
	'page'              => '',
	'per_page'          => '200',
	'avatar_size'       => 120,
	'reverse_top_level' => null,
	'reverse_children'  => ''
);
wp_list_comments($args); 
?>
</ol>