<?php
if ( !defined( 'ABSPATH' ) ) {
  die( '-1' );
}

class WPBakeryShortCode_icw_recent_news extends WPBakeryShortCode {

  protected function content( $atts, $content = null ) {

    extract( shortcode_atts( array(
      'animate_block' => 'false',
      'animation_type' => 'fadeIn',
      'animation_delay' => ''
    ), $atts ) );


    ob_start();


    $wrapper_class = array();
    if ( $animate_block == 'yes' ) {
      $wrapper_class[] = 'wow';
      $wrapper_class[] = $animation_type;
    }

    $wrapper_class = implode( ' ', $wrapper_class );

    ?>
<div class="post-slider">
<div class="swiper-wrapper">
  <?php
  $recent_posts = wp_get_recent_posts( array(
    'numberposts' => 5, // Number of recent posts thumbnails to display
    'post_status' => 'publish' // Show only the published posts
  ) );
  foreach ( $recent_posts as $post ): 
    if ( get_the_post_thumbnail_url($post['ID']) ) {
      $postthumbnail = get_the_post_thumbnail_url( $post['ID'], 'icw-post-thumb-small' );
    } else {
      $postthumbnail = get_template_directory_uri() . '/images/no-post.jpg';
    }
  ?>
  <div class="swiper-slide">
    <div class="recent-news <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?>>
      <?php if( icw_get_post_thumbnail_url() ) { ?>
        <figure class="post-image position-relative"><img class="icw-lazy" src="<?php echo esc_url(lazyloading); ?>" data-src="<?php echo $postthumbnail; ?>" alt="<?php the_title_attribute(); ?>"></figure>
      <?php } ?>  
      <?php // echo get_the_post_thumbnail($post['ID'], 'full'); ?>
      <div class="content"> <small> <?php echo date( ' jS F, Y', strtotime( $post['post_date'] ) );?> </small>
        <h3 class="h2"><a class="stretched-link" href="<?php echo get_permalink($post['ID']) ?>"><?php echo $post['post_title'] ?></a></h3>
        <div class="author post-author"><img class="icw-lazy" src="<?php echo esc_url(lazyloading); ?>" data-src="<?php echo get_avatar_url( get_the_author_meta( "user_email", $post["post_author"] ) ) ?> " alt="<?php the_author_meta( 'display_name', $post['post_author'] ); ?>"> <span>by <b>
          <?php the_author_meta( 'display_name', $post['post_author'] ); ?>
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
<?php


wp_reset_query();
return ob_get_clean();
}
}


vc_map( array(
  "base" => "icw_recent_news",
  "name" => __( "Recent News", "ICWTHEME" ),
  "icon" => ICW_CORE_URI . "assets/img/icw.png",
  "content_element" => true,
  "category" => PAGE_BUILDER_GROUP,
  'params' => array(
    array(
      "type" => "dropdown",
      "heading" => __( 'Animate', 'ICWTHEME' ),
      "param_name" => "animate_block",
      "group" => 'Animation',
      "value" => array(
        "No" => 'no',
        "Yes" => 'yes',
      )
    ),
    array(
      "type" => "dropdown",
      "heading" => __( 'Animation Type', 'ICWTHEME' ),
      "param_name" => "animation_type",
      "dependency" => array( 'element' => "animate_block", 'value' => 'yes' ),
      "group" => 'Animation',
      "value" => icw_animations()
    ),
    array(
      "type" => "textfield",
      "heading" => __( 'Animation Delay', 'ICWTHEME' ),
      "param_name" => "animation_delay",
      "dependency" => array( 'element' => "animate_block", 'value' => 'yes' ),
      "description" => __( 'Animation delay set in second e.g. 0.6s', 'ICWTHEME' ),
      "group" => 'Animation',
    )
  ),
) );
