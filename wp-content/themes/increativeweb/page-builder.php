<?php
/**
 * Template Name: Builder
 */

get_header();
?>
<?php icw_render_page_header( 'page' ); ?>
<main id="main-content" class="main-content-wrapper">
  <?php
  if ( have_posts() ):
    while ( have_posts() ):
      the_post();
      the_content();
    endwhile;
  endif;
  ?>
  <!-- end wrap-page -->
</main>
<?php
get_footer();
