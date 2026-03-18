<div class="col-lg-4 col-md-6 mb-4">
  <div class="recent-news with-shadow">
  <figure class="post-image"><img loading="lazy" src="<?php echo esc_url(lazyloading); ?>" srcset="<?php echo esc_url( icw_get_post_thumbnail_url() ); ?>" alt="<?php the_title_attribute(); ?>"></figure>
    <div class="content"><small> <?php echo date( ' jS F, Y', strtotime( get_the_date() ) );?></small>
      <h2 class="h2"><a class="stretched-link" href="<?php echo get_permalink() ?>"><?php the_title(); ?></a></h2>
      <?php icw_posted_by(); ?>
    </div>
  </div>
</div>
<?php /* ?>
<div id="post-<?php the_ID(); ?>" <?php post_class( array( 'blog-post col-lg-4' ) ); ?>>
  <?php if( icw_get_post_thumbnail_url() ) { ?>
  <figure class="post-image"> <img src="<?php echo esc_url( icw_get_post_thumbnail_url() ); ?>" alt="<?php the_title_attribute(); ?>"> </figure>
  <?php } ?>
  <div class="post-content">
    <div class="post-inner"><small class="post-date"><?php echo get_the_date(); ?></small>
      <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <?php icw_posted_by(); ?>
    </div>
    <!-- end post-inner --> 
  </div>
  <!-- end post-content --> 
  
</div>
<!-- end blog-post --> 
<?php */ ?>
