<?php
register_nav_menu( 'top', 'Top Menu' );
remove_filter( 'the_excerpt', 'wpautop' );
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );
add_filter( 'the_content', 'remove_thumbnail_dimensions', 10 );
add_filter(	'the_content', 'filter_the_content', 90 );
add_filter( 'the_content', 'wrap_div_around_images', 100 );

add_action( 'wp_print_scripts', 'my_deregister_javascript', 100 );

function my_deregister_javascript() {
	if ( !is_admin() ) wp_deregister_script('jquery');
}

function download_func( $atts ){
	extract( shortcode_atts( array(
		'text' => 'text',
		'url' => 'url',
	), $atts ) );
	return '
	<div class="downloadbox">
		<a href="'.$url.'"><img class="icon" src="'.get_bloginfo('template_url').'/images/icon-download.png" data-at2x="'.get_bloginfo('template_url').'/images/icon-download@2x.png" alt="a"> '.$text.'</a>
	</div>
	';

}
add_shortcode( 'download', 'download_func' );



$comment_form = array(
	'id_form' => 'commentform',
	'id_submit' => 'submit',
	'title_reply' => __( 'Share your thoughts' ),
	'title_reply_to' => __( 'Leave a Reply to %s' ),
	'cancel_reply_link' => __( 'Cancel Reply' ),
	'label_submit' => __( 'Post Comment' ),
	'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><textarea id="comment" name="comment" class="span8" cols="45" rows="8" aria-required="true"></textarea></p>',
	'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
	'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
	'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) . '</p>',
	'comment_notes_after' => '',
	'fields' => apply_filters( 'comment_form_default_fields', array(
		'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'domainreference' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input class="span4" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
		'email' => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'domainreference' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input class="span4" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
		'url' => '<p class="comment-form-url"><label for="url">' . __( 'Website', 'domainreference' ) . '</label>' . '<input class="span4" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>' ) ) );

function my_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);

		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
?>
		<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>
		<div class="comment-author vcard">
		<span class="avatarholder"><?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?></span>
		<cite class="fn">
<?php if ($comment->user_id) {
$user=get_userdata($comment->user_id);
echo $user->display_name;
} else { comment_author_link(); } ?>			

		</cite> <span class="says">says:</span>
		</div>
<?php if ($comment->comment_approved == '0') : ?>
		<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
		<br />
<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
			?>
		</div>

		<?php comment_text() ?>

		<div class="reply">
		<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</div>
		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
		<?php endif; ?>
<?php
}

function bootstrap_pagination( $pages = '', $range = 2 ) {
	$showitems = ( $range * 2 )+1;
	global $paged;
	if ( empty( $paged ) ) $paged = 1;

	if ( $pages == '' ) {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if ( !$pages ) {
			$pages = 1;
		}
	}

	if ( 1 != $pages ) {
		echo "<div class='pagination pagination-centered'><ul>";
		if ( $paged > 2 && $paged > $range+1 && $showitems < $pages ) echo "<li><a href='".get_pagenum_link( 1 )."'>&laquo;</a></li>";
		if ( $paged > 1 && $showitems < $pages ) echo "<li><a href='".get_pagenum_link( $paged - 1 )."'>&lsaquo;</a></li>";

		for ( $i=1; $i <= $pages; $i++ ) {
			if ( 1 != $pages &&( !( $i >= $paged+$range+1 || $i <= $paged-$range-1 ) || $pages <= $showitems ) ) {
				echo ( $paged == $i )? "<li class='active'><span class='current'>".$i."</span></li>":"<li><a href='".get_pagenum_link( $i )."' class='inactive' >".$i."</a></li>";
			}
		}

		if ( $paged < $pages && $showitems < $pages ) echo "<li><a href='".get_pagenum_link( $paged + 1 )."'>&rsaquo;</a></li>";
		if ( $paged < $pages-1 && $paged+$range-1 < $pages && $showitems < $pages ) echo "<li><a href='".get_pagenum_link( $pages )."'>&raquo;</a></li>";
		echo "</ul></div>\n";
	}
}



function remove_thumbnail_dimensions( $html ) {
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	return $html;
}

function wrap_div_around_images( $content ) {
	// /^<([a-z]+)([^<]+)*(?:>(.*)<\/\1>|\s+\/>)$/
	$content = preg_replace( '/(<img [^>]*src="([^"]*)"[^>]*>)/i', '<div class="imageborderbox">$1</div>', $content );
	return $content;
}

function filter_the_content($content) {
	#return $content;
	return preg_replace_callback('/(<\s*img[^>]+)(src\s*=\s*"[^"]+")([^>]+>)/i', 'addlazy_callback', $content);
}

function addlazy_callback($matches) {
	// alter original img tag:
	//   - add empty class attribute if no existing class attribute
	//   - set src to placeholder image
	//   - add back original src attribute, but rename it to "data-original"
	if (!preg_match('/class\s*=\s*"/i', $matches[0])) {
		$class_attr = 'class="" ';
	}
	$replacement = $matches[1] . $class_attr . 'src="' . get_bloginfo('template_url').'/images/grey.gif' . '" data-original' . substr($matches[2], 3) . $matches[3];

	// add "lazy" class to existing class attribute
	$replacement = preg_replace('/class\s*=\s*"/i', 'class="lazy ', $replacement);

	// add noscript fallback with original img tag inside
	$replacement .= '<noscript>' . $matches[0] . '</noscript>';
	return $replacement;
}



// This theme styles the visual editor with editor-style.css to match the theme style.
add_editor_style();

function disable_admin_bar() {
	add_filter( 'show_admin_bar', '__return_false' );
	add_action( 'admin_print_scripts-profile.php', 'hide_admin_bar_settings' );
}
add_action( 'init', 'disable_admin_bar' , 9 );

// This theme uses post thumbnails
add_theme_support( 'post-thumbnails' );

// Add default posts and comments RSS feed links to head
add_theme_support( 'automatic-feed-links' );

set_post_thumbnail_size( 370, 300, false );
add_image_size( 370, 300, false );

add_shortcode('wp_caption', 'fixed_img_caption_shortcode');
add_shortcode('caption', 'fixed_img_caption_shortcode');
function fixed_img_caption_shortcode($attr, $content = null) {
	// New-style shortcode with the caption inside the shortcode with the link and image tags.
	if ( ! isset( $attr['caption'] ) ) {
		if ( preg_match( '#((?:<a [^>]+>\s*)?<img [^>]+>(?:\s*</a>)?)(.*)#is', $content, $matches ) ) {
			$content = $matches[1];
			$attr['caption'] = trim( $matches[2] );
		}
	}

	// Allow plugins/themes to override the default caption template.
	$output = apply_filters('img_caption_shortcode', '', $attr, $content);
	if ( $output != '' )
		return $output;

	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> 'alignnone',
		'width'	=> '',
		'caption' => ''
	), $attr));

	if ( empty($caption) )
		return $content;

	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

	return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '">'
	. do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}

function hide_meta_boxes() {
	remove_meta_box('suggestedtags','post','advanced');
	remove_meta_box('suggestedtags','page','advanced');
	#remove_meta_box('tagsdiv-post_tag','post','side');
	#remove_meta_box('tagsdiv-post_tag','page','side');
	remove_meta_box('trackbacksdiv','post','normal');
	remove_meta_box('trackbacksdiv','page','normal');
	remove_meta_box('postcustom','post','normal');
	remove_meta_box('slugdiv','post','normal');
	remove_meta_box('slugdiv','page','normal');
	remove_meta_box('postcustom','page','normal');
	#remove_meta_box('commentstatusdiv','post','normal');
	#remove_meta_box('commentstatusdiv','page','normal');
	remove_meta_box('commentsdiv','post','normal');
	remove_meta_box('commentsdiv','page','normal');
	remove_meta_box('postimagediv','page','side');
	remove_meta_box('postimagediv','post','side');
	
	#remove_meta_box('postexcerpt','page','side');
	#remove_meta_box('postexcerpt','post','side');
	
	remove_meta_box('authordiv','page','side');
	remove_meta_box('authordiv','post','side');
	remove_meta_box('authordiv','page','normal');
	remove_meta_box('authordiv','post','normal');

	remove_meta_box('categorydiv','page','side');
	remove_meta_box('categorydiv','post','side');
	remove_meta_box('categorydiv','page','normal');
	remove_meta_box('categorydiv','post','normal');

	remove_meta_box('postimagediv','page','side');
	remove_meta_box('postimagediv','post','side');
	remove_meta_box('postimagediv','page','normal');
	remove_meta_box('postimagediv','post','normal');

	
}

function remove_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
} 

function remove_menus () {
	if (current_user_can('editor') && !current_user_can('administrator')) {
		global $menu;
		$restricted = array(__('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins'));
		end ($menu);
		while (prev($menu)){
			$value = explode(' ',$menu[key($menu)][0]);
			if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
		}
	}
}

add_action('admin_menu', 'remove_menus');
add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );
add_action( 'admin_init','hide_meta_boxes');


register_sidebar( array(
	'name' => __( 'Footer Column 1', '' ),
	'id' => 'footer-1',
	'description' => __( 'Footer widget area', '' ),
	'before_widget' => '<div class="%2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );

register_sidebar( array(
	'name' => __( 'Footer Column 2', '' ),
	'id' => 'footer-2',
	'description' => __( 'Footer widget area', '' ),
	'before_widget' => '<div class="%2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );

register_sidebar( array(
	'name' => __( 'Footer Column 3', '' ),
	'id' => 'footer-3',
	'description' => __( 'Footer widget area', '' ),
	'before_widget' => '<div class="%2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );

?>
