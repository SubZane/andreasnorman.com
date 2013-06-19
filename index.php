<?php get_header(); ?>
<div class="row intro">
  <div class="span12">
    <p>This is my blog about geeky stuff like web design, wordpress, css, html and I'm totally obsessed with white space!</p>
  </div>
</div>
<div class="postlist">
  <div class="row post">
    <div class="span12">
      <ul>
      <?php while ( have_posts() ) : the_post(); ?>
            <li id="postid_<?php the_ID(); ?>"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>, <span class="date"><?php the_time( 'j M, Y' ) ?></span></li>
      <?php endwhile; ?>
      </ul>
    </div>
  </div>
  <?php bootstrap_pagination();?>
</div>

<?php get_footer(); ?>
