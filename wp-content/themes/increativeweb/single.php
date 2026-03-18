<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package icw
 */

get_header();
$page_for_posts = get_option( 'page_for_posts' );
?>
<?php
//icw_render_page_header( 'single' );

$show_sidebar = ( icw_get_option( 'archive_show_sidebar' ) ) ? icw_get_option( 'archive_show_sidebar' ) : 'yes';
if ( !is_active_sidebar( 'sidebar-1' ) ) {
  $show_sidebar = 'no';
}
$wrapper_cols = '8';

if ( $show_sidebar === 'yes' ) {
  $wrapper_cols = '8';
}

?>
<header class="page-header post-header">
  <div class="container">
        <div class="back-link"><a href="<?php the_permalink($page_for_posts); ?>">Back to Blog</a></div>
        <h1><?php echo get_the_title(); ?></h1>
        <div class="row-post-meta"> 
      <div class="row">
        <div class="col-auto">
          <div class="post-meta">
          <?php while ( have_posts() ): the_post(); icw_posted_by(); endwhile; ?>
          <span class="line">|</span> <?php echo get_the_date( 'F, d Y' ); ?>
          </div>  
          </div>
          <div class="col-auto ml-auto align-self-center justify-content-md-end"><?php get_template_part( 'inc/social-buttons' ); ?></div>
        </div>
    </div>
    </div>
    <div class="animation-svg">
      <div class="circle">
          <svg width="580" height="400" class="svg-morph">
          <path id="svg_morph" d="m261,30.4375c0,0 114,6 151,75c37,69 37,174 6,206.5625c-31,32.5625 -138,11.4375 -196,-19.5625c-58,-31 -86,-62 -90,-134.4375c12,-136.5625 92,-126.5625 129,-127.5625z"></path>
        </svg>
      </div>
  </div>
</header>
<main class="main-content-wrapper">
<!-- end int-hero -->
<section class="content-section icw-bg1-img pb-0">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-<?php echo esc_attr( $wrapper_cols ); ?>">
        <div id="post-<?php the_ID(); ?>" class="blog-post single-post">
          <?php if ( get_the_post_thumbnail_url() ) {
            echo '<figure class="post-image"><img loading="lazy" src="'.esc_url(lazyloading).'" srcset="'.get_the_post_thumbnail_url( get_the_ID(), 'icw-post-thumb' ).'" alt="'.esc_attr(get_the_title()).'" /></figure>';
          }  ?>
          <div class="post-content">
            <div class="inner">
              <?php
              while ( have_posts() ):
                the_post();

              get_template_part( 'template-parts/content', get_post_type() );

              // If comments are open or we have at least one comment, load up the comment template.
              if ( comments_open() || get_comments_number() ):
                comments_template();
              endif;

              ?>
              <div class="clearfix"></div>
              <div class="post-navigation">
                <?php the_post_navigation(); ?>
              </div>
              <br>
              <?php
              endwhile; // End of the loop.
              ?>
            </div>
          </div>
        </div>
      </div>
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
    </div>
  </div>
  <!-- end news --> 

<?php 
$related = new WP_Query( array( 'post_type' => 'post', 'post__not_in' => array( get_the_id() ), 'posts_per_page' => 4 ) );
if ( $related->have_posts() ) { ?>
<div class="blog-categories icw-bg2-img">
<div class="container">
<div class="section-title"><span class="tagline">Explore</span><h2 class="heading-title h2">Related Articles</h2></div>
<div class="post-slider">
<div class="swiper-wrapper">
  <?php 
  foreach ( $related->posts as $post  ):  
      if ( get_the_post_thumbnail_url($post->ID) ) {
        $postthumbnail = get_the_post_thumbnail_url( $post->ID, 'icw-post-thumb-small' );
      } else {
        $postthumbnail = get_template_directory_uri() . '/images/no-post.jpg';
      }
      ?>
    <div class="swiper-slide">
      <div class="recent-news">
        <?php if( icw_get_post_thumbnail_url() ) { ?>
          <figure class="post-image"><img loading="lazy" src="<?php echo esc_url(lazyloading); ?>" srcset="<?php echo $postthumbnail; ?>" alt=""> </figure>
        <?php } ?>  
        <div class="content"> <small> <?php echo date( ' jS F, Y', strtotime( $post->post_date ) );?> </small>
          <h3 class="h2"><a class="stretched-link" href="<?php echo get_permalink($post->ID) ?>"><?php echo $post->post_title ?></a></h3>
          <div class="author post-author"> <img loading="lazy" src="<?php echo esc_url(lazyloading); ?>" srcset="<?php echo get_avatar_url( get_the_author_meta( "user_email", $post->post_author ) ) ?> " alt="<?php the_author_meta( 'display_name', $post->post_author ); ?>"> <span>by <b>
            <?php the_author_meta( 'display_name', $post->post_author ); ?>
            </b></span></div>
        </div>
      </div>
    </div>
  <?php endforeach; wp_reset_query(); ?>
</div>
<div class="swiper-pagination"></div>
<div class="button-prev"><i class="lni lni-angle-double-left"></i></div>
<div class="button-next"><i class="lni lni-angle-double-right"></i></div>
</div>
</div>
</div>
<?php } ?>

<?php 
	$categories = get_categories( array(
		'orderby' => 'name',
		'order'   => 'ASC',
    'hide_empty'      => false
	));
	echo '<div class="blog-categories icw-bg3-img"><div class="container"><div class="section-title"><span class="tagline">Explore</span><h2 class="heading-title h2">All Categories</h2></div><ul>';
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
