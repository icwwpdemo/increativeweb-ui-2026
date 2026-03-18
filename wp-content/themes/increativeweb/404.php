<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package icw
 */

get_header();
// icw_render_page_header( '404' );
?>
<main class="main-content-wrapper">
<section class="content-section error-404 not-found">
  <div class="container"> 
      <h1>:/</h1>
      <p class="description">Sorry, this page isn't available</p>
      <a href="/" class="icw-btn --primary">Return Home</a>
  </div>
  <!-- end container --> 
</section>
<!-- end content-section -->
<?php
get_footer();
