<?php get_header(); ?>
  <?php while ( have_posts() ) : the_post(); ?>

  <div class="row">
    <div class="col-lg-8 col-md-10 col-lg-push-2 col-md-push-1 col-sm-12 col-xs-12">
      <h1 class="blogheader"><?php the_title(); ?></h1>
    </div>
  </div>
 
  <div class="row">
    <div class="col-lg-8 col-md-10 col-lg-push-2 col-md-push-1 col-sm-12 col-xs-12">
      <article class="postcontent">
        <p class="preamble"><?php if($post->post_excerpt) the_excerpt(); ?></p>
        <div class="post-content"><?php the_content(); ?></div>
        <hr class="divider">

        <div class="sharebuttons clearfix hidden-sm hidden-xs">
          <div class="postdate">Posted <?php the_date("l, F j, Y"); ?></div>
        </div>

      </article>
    </div>
  </div>
<?php endwhile; ?>

</div>
</div>
<div class="wrapper black">
<div class="container black">

<div class="row">
  <div class="col-lg-8 col-md-10 col-lg-push-2 col-md-push-1 col-sm-12 col-xs-12">
    <div class="comments">
      <?php if (get_comments_number() > 0) { ?>
      <h3>Thoughts and comments</h3>
      <?php comments_template( '', true ); ?>
      <?php } ?>
      <?php comment_form($comment_form); ?> 
    </div>
  </div>
</div>

<?php get_footer(); ?>
