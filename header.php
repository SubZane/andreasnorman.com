<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie6" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="ie7" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="ie8" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" xmlns:fb="http://ogp.me/ns/fb#"> <!--<![endif]-->

  <head>
    <meta charset="utf-8">
    <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<?php if(is_single() || is_page() || is_home()) { ?>
			<meta name="googlebot" content="index,archive,follow,noodp" />
			<meta name="robots" content="all,index,follow" />
			<meta name="msnbot" content="all,index,follow" />
		<?php } else { ?>
			<meta name="googlebot" content="noindex,noarchive,follow,noodp" />
			<meta name="robots" content="noindex,follow" />
			<meta name="msnbot" content="noindex,follow" />
		<?php } ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		
    <!--[if lt IE 9]>
      <script src="<?php bloginfo('template_url'); ?>/bin7assets/js/iefixes.min.js"></script>
    <![endif]-->
    <script src="<?php bloginfo('template_url'); ?>/bin/assets/js/jquery.min.js" type="text/javascript"></script>

    <link href="<?php bloginfo('template_url'); ?>/bin/assets/css/styles.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=PT+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,700,300italic,400italic,700italic' rel='stylesheet' type='text/css'>		

    <?php if (is_home() || is_archive()) { ?>
		<link rel="prefetch" href="<?php echo get_next_posts_page_link(); ?>">
		<link rel="prerender" href="<?php echo get_next_posts_page_link(); ?>">
		<?php } else if (is_single()) { ?>	
		<?php
		$prev_url = get_permalink(get_adjacent_post(false,'',true));
		?>
		<link rel="prefetch" href="<?php echo $prev_url; ?>">
		<link rel="prerender" href="<?php echo $prev_url; ?>">
		<?php } ?>
		
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico">
    <link rel="apple-touch-icon" href="<?php bloginfo('template_url'); ?>/images/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_url'); ?>/images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_url'); ?>/images/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php bloginfo('template_url'); ?>/images/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('template_url'); ?>/images/apple-touch-icon-144x144.png">
    <link rel="apple-touch-startup-image" href="<?php bloginfo('template_url'); ?>/images/apple-touch-icon-144x144.png">

		<?php wp_head(); ?>
		<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
  </head>

<body>
<div id="st-container" class="st-container">
  <div class="st-pusher">
  <nav class="st-menu st-effect-6" id="menu-6">
    <div class="post-list">
      <h2>Recent articles</h2>
      <ul>
      <?php 
      $args = array( 'posts_per_page' => 50 );
      $lastposts = get_posts( $args );
      setup_postdata( $post );
      foreach ( $lastposts as $post ) :
       ?> 
            <li id="postid_<?php the_ID(); ?>"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?> <span class="date"><?php the_time( 'j M, Y' ) ?></span></a></li>
      <?php endforeach; 
      wp_reset_postdata(); ?>
      </ul>
    </div>
  </nav>
  <div class="st-content"><!-- this is the wrapper for the content -->
    <div class="st-content-inner"><!-- extra div for emulating position:fixed of the menu -->

<a class="hidden-sm hidden-xs" href="https://github.com/subzane"><img style="position: fixed; top: 0; right: 0; border: 0; width: 149px; height: 149px;" src="http://aral.github.com/fork-me-on-github-retina-ribbons/right-graphite@2x.png" alt="Fork me on GitHub"></a>
<div class="wrapper" id="contentholder">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="logo"><a href="#" id="sidemenu" data-effect="st-effect-6">an logo</a></div>
      </div>
    </div>
