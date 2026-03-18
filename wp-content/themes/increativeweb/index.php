<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package icw
 */

get_header();
?>
<?php
// icw_render_page_header( 'frontpage' );
$show_sidebar = ( icw_get_option( 'archive_show_sidebar' ) ) ? icw_get_option( 'archive_show_sidebar' ) : 'yes';
$wrapper_cols = '10';
$section_class = 'blog';

// if ( !is_active_sidebar( 'sidebar-1' ) ) {
//   $show_sidebar = 'no';
// }
// if ( $show_sidebar == 'yes' ) {
//   $wrapper_cols = '8';
// }
$header_description = icw_get_archive_description();
$header_title = icw_get_page_title();
?>
<header class="page-header post-header">
  <div class="container">
      <h1><?php echo $header_title; ?></h1>
      <p><?php echo $header_description; ?></p>
  </div>
  <div class="animation-svg animation-top">
    <div class="circle">
        <svg width="580" height="400" class="svg-morph">
        <path id="svg_morph" d="m261,30.4375c0,0 114,6 151,75c37,69 37,174 6,206.5625c-31,32.5625 -138,11.4375 -196,-19.5625c-58,-31 -86,-62 -90,-134.4375c12,-136.5625 92,-126.5625 129,-127.5625z"></path>
      </svg>
    </div>
  </div>
</header>

<main id="main-content" class="main-content-wrapper">
  <section class="content-section pb-0">
    <div class="container">
      <div class="row justify-content-center">
        <?php
        if ( have_posts() ): ?>
          <div class="col-lg-<?php echo esc_attr( $wrapper_cols ); ?>">
            <?php
              echo '<div class="row">';
              while ( have_posts() ):
                the_post();
                get_template_part( 'template-parts/listing' );
              endwhile;
              echo '</div>';
              // show pagination
              icw_pagination();
            ?>
          </div>
        <!-- end col-8 -->
        <?php
          /* if ( $show_sidebar == 'yes' ) {
            ?>
          <div class="col-lg-4">
            <?php get_sidebar(); ?>
          </div>
          <!-- end col-4 -->
          <?php
          } */ ?>
      <?php else :
          get_template_part( 'template-parts/content', 'none' );
        endif;
        ?>
      </div>
      <!-- end row --> 
    </div>
    <!-- end container --> 

<?php 
	$categories = get_categories( array(
		'orderby' => 'name',
		'order'   => 'ASC',
    'hide_empty'      => false
	));
	$page_for_posts = get_option( 'page_for_posts' );
	echo '<div class="blog-categories"><div class="container"><div class="section-title"><span class="tagline">Explore</span><h2 class="heading-title h2">All Categories</h2></div><ul>';
	echo '<li><a href="'.esc_url( get_the_permalink($page_for_posts)).'" data-toggle="tooltip" data-placement="top" title="View all posts in '.get_the_title($page_for_posts).'">View All</a></li>';
	foreach( $categories as $category ) {
		echo '<li><a href="'.esc_url( get_category_link($category->term_id)).'" data-toggle="tooltip" data-placement="top" title="View all posts in '.$category->name.'">'.esc_html( $category->name ).'</a></li>';
	}
	echo '</ul></div>';
?>
  </section>
</main>
<?php
get_footer();
