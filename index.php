<?php get_header(); ?>
<div class="row">
  <div class="col-lg-8 col-md-8 col-lg-push-2 col-md-push-2 col-sm-12 col-xs-12">
    <div class="intro">
      <p>This is my blog about geeky stuff like web design, wordpress, css, html and I'm totally obsessed with white space!</p>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-8 col-md-8 col-lg-push-2 col-md-push-2 col-sm-12 col-xs-12">
    <div class="post-list">
      <ul>
      <?php while ( have_posts() ) : the_post(); ?>
            <li id="postid_<?php the_ID(); ?>">
              <div class="date"><?php the_time( 'j M, Y' ) ?></div>
              <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a> 
              <div class="excerpt"><?php the_excerpt(); ?></div>
            </li>
      <?php endwhile; ?>
      </ul>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-8 col-md-8 col-lg-push-2 col-md-push-2 col-sm-12 col-xs-12">
    <?php bootstrap_pagination();?>
  </div>
</div>

<?php get_footer(); ?>
