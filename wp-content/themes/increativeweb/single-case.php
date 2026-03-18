<?php get_header(); ?>
<?php icw_render_page_header( 'case' ); ?>
<main class="main-content-wrapper">
  <?php
  while ( have_posts() ):
    the_post();
  ?>
  <?php the_content(); ?>
  <?php endwhile; ?>
</main>
<?php get_footer(); ?>
