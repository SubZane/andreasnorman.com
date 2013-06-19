<?php get_header(); ?>
<?php 
if( is_tag() ) {
  ?><h1 class="blogheader">Archive for &#8216;<?php single_tag_title(); ?>&#8217;</h1><?php
} elseif (is_day()) {
  ?><h1 class="blogheader">Archive for <?php the_time('F jS, Y'); ?></h1><?php
} elseif (is_month()) {
  ?><h1 class="blogheader">Archive for <?php the_time('F, Y'); ?></h1><?php
} elseif (is_year()) {
  ?><h1 class="blogheader">Archive for <?php the_time('Y'); ?></h1><?php
} 
?>
<div class="postlist">
  <?php while ( have_posts() ) : the_post(); ?>
  <div class="row post" id="postid_<?php the_ID(); ?>">
    <div class="span12">
      <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
      <div class="meta small clearfix">
        <ul>
          <li class="calendar"><?php the_time( 'j M, Y' ) ?></li>
          <li class="tags"><?php the_tags('', ', ', ''); ?></li>
        </ul>
      </div>
      <p><?php if($post->post_excerpt) the_excerpt(); ?></p>
    </div>
  </div>
  <?php endwhile; ?>
  <?php bootstrap_pagination();?>
</div>

<?php get_footer(); ?>
