<?php get_header(); ?>
<h1 class="blogheader">Search Results for &#8216;<?php echo get_search_query(); ?>&#8217;</h1>
<div class="postlist">
  <?php while ( have_posts() ) : the_post(); ?>
  <div class="row post" id="postid_<?php the_ID(); ?>">
    <div class="span4">
      <?php the_post_thumbnail(); ?>
    </div>
    <div class="span8">
      <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
      <div class="meta small clearfix">
        <ul>
          <li class="calendar"><?php the_time( 'j M, Y' ) ?></li>
          <li class="comments"><?php comments_number('No comments'); ?></li>
        </ul>
      </div>
      <p><?php if($post->post_excerpt) the_excerpt(); ?></p>
      <div class="meta small clearfix">
        <ul>
          <li class="tags"><?php the_tags('', ', ', ''); ?></li>
        </ul>
      </div>
    </div>
  </div>
  <?php endwhile; ?>
  <?php bootstrap_pagination();?>
</div>

<?php get_footer(); ?>
