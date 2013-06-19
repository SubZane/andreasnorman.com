<?php get_header(); ?>
  <?php while ( have_posts() ) : the_post(); ?>

  <div class="row">
    <div class="span12">
      <h1 class="blogheader"><?php the_title(); ?></h1>
    </div>
  </div>
 
  <div class="row">
    <div class="span12">
      <article class="postcontent">

        <div class="sharebuttons clearfix">
          <div id="twitter" data-url="<?php the_permalink(); ?>?utm_source=Twitter&utm_medium=Sharebutton&utm_campaign=<?php echo urlencode(get_the_title()); ?>" data-text="<?php the_title(); ?>" data-title="Tweet"></div>
          <div id="facebook" data-url="<?php the_permalink(); ?>?utm_source=Facebook&utm_medium=Sharebutton&utm_campaign=<?php echo urlencode(get_the_title()); ?>" data-text="<?php the_title(); ?>" data-title="Like"></div>
          <div id="googleplus" data-url="<?php the_permalink(); ?>?utm_source=GooglePlus&utm_medium=Sharebutton&utm_campaign=<?php echo urlencode(get_the_title()); ?>" data-text="<?php the_title(); ?>" data-title="+1"></div>
        </div>

        <p class="preamble"><?php if($post->post_excerpt) the_excerpt(); ?></p>


        <div class="post-content"><?php the_content(); ?></div>
      </article>
    </div>
  </div>
<?php endwhile; ?>
<div class="row">
  <div class="span12">
    <div class="comments">
      <?php if (get_comments_number() > 0) { ?>
      <h3>Thoughts and comments</h3>
      <?php } ?>
      <?php comments_template( '', true ); ?>
      <?php comment_form($comment_form); ?> 
    </div>
  </div>
</div>

<?php get_footer(); ?>
