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
icw_render_page_header( 'archive' );

$show_sidebar = ( icw_get_option( 'archive_show_sidebar' ) ) ? icw_get_option( 'archive_show_sidebar' ) : 'yes';
$wrapper_cols = '8';
$section_class = 'blog';
/*
if ( !is_active_sidebar( 'sidebar-1' ) ) {
  $show_sidebar = 'no';
}

if ( $show_sidebar == 'yes' ) {
  $wrapper_cols = '8';
}*/
?>
<main class="main-content-wrapper">
  <section class="content-section pb-0">
    <div class="container">
      <div class="row justify-content-center">
        <?php
        if ( have_posts() ):
          ?>
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
        if ( $show_sidebar == 'yes' ) {
          ?>
        <div class="col-lg-4">
          <?php get_sidebar(); ?>
        </div>
        <!-- end col-4 -->
        <?php
        }
        ?>
        <?php
        else :
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
<!-- end blog -->
<?php
get_footer();
