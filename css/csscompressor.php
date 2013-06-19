<?php
/*
    <link href="<?php bloginfo('template_url'); ?>/bootstrap/css/thin-bootstrap.min.css" rel="stylesheet">
    <link href="<?php bloginfo('template_url'); ?>/style.css" rel="stylesheet">
    <link href="<?php bloginfo('template_url'); ?>/css/footer.css" rel="stylesheet">
    <link href="<?php bloginfo('template_url'); ?>/css/pagination.css" rel="stylesheet">
    <link href="<?php bloginfo('template_url'); ?>/css/socialicons.css" rel="stylesheet">
    <link href="<?php bloginfo('template_url'); ?>/css/sharre.css" rel="stylesheet">
    <link href="<?php bloginfo('template_url'); ?>/css/comments.css" rel="stylesheet">
    <link href="<?php bloginfo('template_url'); ?>/css/responsive.css" rel="stylesheet">
*/
$css_cache_file = 'compressedstyles.css';
$css_path = '';
$css_files = array(
					"../bootstrap/css/thin-bootstrap.min.css",
 					"../style.css",
 					"../css/footer.css",
 					"../css/pagination.css",
 					"../css/sharre.css",
 					"../css/comments.css",
 					"../css/responsive.css"
);

function update() {
	global $css_path, $css_cache_file_path, $css_cache_file, $css_files;
	if (file_exists($css_cache_file)) {
		$cache_time = filemtime($css_cache_file);
		foreach ($css_files as $file) {
			if (file_exists($css_path.$file)) {
				$time = filemtime($css_path.$file);
				if ($time > $cache_time) {
					return joinCSSFiles();
					break;
				}
			}
		}
	} else {
		return joinCSSFiles();
	}
	return file_get_contents($css_cache_file);;
}

function compressCSS($file) {
	$filedata = file_get_contents($file);
	$filedata = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $filedata);
	$filedata = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $filedata);
  $filedata = str_replace('{ ', '{', $filedata);
  $filedata = str_replace(' }', '}', $filedata);
  $filedata = str_replace('; ', ';', $filedata);
  $filedata = str_replace(', ', ',', $filedata);
  $filedata = str_replace(' {', '{', $filedata);
  $filedata = str_replace('} ', '}', $filedata);
  $filedata = str_replace(': ', ':', $filedata);
  $filedata = str_replace(' ,', ',', $filedata);
  $filedata = str_replace(' ;', ';', $filedata);	
	return $filedata;
}

function joinCSSFiles() {
	global $css_cache_file, $css_files, $css_path;
	$data = '';
	foreach ($css_files as $file) {
		if (file_exists($css_path.$file)) {
			$data .= compressCSS($css_path.$file);
		}
	}
	$data = "/*".date("Y-m-d H:i:s")."*/".$data;
	file_put_contents($css_cache_file, $data);
	return $data;
}

ob_start ("ob_gzhandler");
ob_start("compress");
header("Content-type: text/css;charset: UTF-8");
echo update();
?>