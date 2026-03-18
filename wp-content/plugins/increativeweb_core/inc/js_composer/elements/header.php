<?php
if ( !defined( 'ABSPATH' ) ) {
  die( '-1' );
}

class WPBakeryShortCode_icw_hero_slider extends WPBakeryShortCode {

  protected function content( $atts, $content = null ) {

    extract( shortcode_atts( array(
      'hero_slider' => 0,
    ), $atts ) );

    //		 if( !is_int( $hero_slider ) ) {
    //		 	return;
    //		 }
    ob_start();
    $args = array(
      'post_type' => 'hero',
      'post__in' => array( $hero_slider )
    );

    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ):
      while ( $the_query->have_posts() ):
        $the_query->the_post();

    $hero_type = get_field( 'type' );

    if ( $hero_type === 'hero' ):
      // echo "HERO come";
      ?>

      <?php
    elseif ( $hero_type === 'swiper' ):

      if ( have_rows( 'slider' ) ):

        $transition_speed = ( get_field( 'transition_speed' ) ) ? get_field( 'transition_speed' ) : 600;
        $auto_play_delay = ( get_field( 'auto_play_delay' ) ) ? get_field( 'auto_play_delay' ) : 3500;
        $loop = ( get_field( 'disable_loop' ) ) ? 'disable' : 'enable';

        $page_number = ( get_field( 'disable_page_number' ) ) ? false : true;
        $pagination = ( get_field( 'disable_pagination' ) ) ? false : true;
        $navigation = ( get_field( 'disable_navigation' ) ) ? false : true;


	      $yellow_box = icw_get_option( 'header_yellow_box' );  
	  
        $slides = count( get_field( 'slider' ) );

        if ( $slides < 2 ) {
          $loop = 'disable';
        }

?>
<header class="hero-slider">
  <div class="container">
    <div class="swiper-container hero-slider-content">
      <div class="swiper-wrapper">
        <?php
        $j = 1;
        while ( have_rows( 'slider' ) ): the_row();  ?>
          <div class="swiper-slide">
            <div class="inner">
              <?php
                  if ( !empty(get_sub_field( 'title' )) ) {
                    if($j == 1) {
                      echo '<h1 class="h2" data-icw="icw-fadeInUp">'.get_sub_field( 'title' ).'</h1>';
                    } else {
                      echo '<h2 class="h2" data-icw="icw-fadeInUp">'.get_sub_field( 'title' ).'</h2>';
                    }
                  } 
                  if ( !empty(get_sub_field( 'description' )) ) {
                    echo '<p data-icw="icw--fadeInUp">'.get_sub_field( 'description' ).'</p>';
                  } 
                  if ( $button_link = get_sub_field( 'button_link' ) ) {
                    $button_label = get_sub_field( 'button_label' ); 
                    echo '<p data-icw="icw---fadeInUp"><a href="'.esc_url( $button_link ).'">'.$button_label.'</a></p>';
                  } 
              ?>
            </div>
          </div>
        <?php $j++; endwhile; ?>
      </div>
      <div class="controls"><div class="swiper-pagination"></div></div> 
    </div>

    <div class="swiper-container hero-slider-main">
      <div class="swiper-wrapper">
		   <?php
        while ( have_rows( 'slider' ) ): the_row();
        $background_image = get_sub_field( 'background_image' );
        $alt_slide = get_sub_field( 'alt' );
        $alt = (!empty($alt_slide)) ? esc_attr($alt_slide) : esc_html( get_bloginfo( 'name' ) );
        // data-background="<?php echo esc_url( $background_image );
        ?>
        <div class="swiper-slide">
          <div class="slide-image"><img src="<?php echo esc_url( $background_image ); ?>" alt="<?php echo $alt; ?>"></div>
        </div>
        <?php
        endwhile;
        ?>
      </div>
    </div>
  </div>
  
  <?php if( $yellow_box != '' ) { ?>
    <div class="header-box"><?php echo wp_kses_post( $yellow_box ); ?></div>
  <?php } ?>
<div class="sldier-bg"><video autoplay loop muted playsinline><source src="<?php echo esc_url( get_template_directory_uri() . '/bg.mp4' ); ?>" type="video/mp4">Your browser does not support the video tag.</video></div>
<div class="divider"><svg width="1920" height="298" x="0px" y="0px" viewBox="0 0 1920 298" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M49.987 152.987L0 134.05V298H1920V1.99331L1826.52 10.4649L1638.07 0L1433.13 22.9231L1198.69 10.4649L1009.24 28.903L833.283 66.7759L645.832 55.8127L467.378 86.2107L289.924 90.6957L49.987 152.987Z" fill="white" fill-opacity="0.5"/><path d="M90.5236 222.632L0 191.187V298H1920V12L1828.48 26.9738L1650.43 12L1449.88 36.4572L1268.33 70.3979L1059.78 60.9145L862.725 112.325H634.665L422.61 169.225L299.578 142.272L90.5236 222.632Z" fill="#EBF0FF" fill-opacity="0.85"/><path d="M113.707 287.945L0 251.245V298H1920V23L1665.04 86.3455L1401.05 75.7879L1181.65 124.554H961.753L792.945 177.845L587.571 190.413L454.328 225.102L318.581 209.015L113.707 287.945Z" fill="white"/></svg></div>


  <!-- <svg version="1.1" class="divider" x="0px" y="0px" width="240px" height="24px" viewBox="0 0 240 24" enable-background="new 0 0 240 24" xml:space="preserve" preserveAspectRatio="none">
    <path fill="#ffffff" fill-opacity="0.33" d="M240,24V0c-51.797,0-69.883,13.18-94.707,15.59c-24.691,2.4-43.872-1.17-63.765-1.08
c-19.17,0.1-31.196,3.65-51.309,6.58C15.552,23.21,4.321,22.471,0,22.01V24H240z"></path>
    <path fill="#ffffff" fill-opacity="0.33" d="M240,24V2.21c-51.797,0-69.883,11.96-94.707,14.16
c-24.691,2.149-43.872-1.08-63.765-1.021c-19.17,0.069-31.196,3.311-51.309,5.971C15.552,23.23,4.321,22.58,0,22.189V24h239.766H240
z"></path>
    <path fill="#ffffff" d="M240,24V3.72c-51.797,0-69.883,11.64-94.707,14.021c-24.691,2.359-43.872-3.25-63.765-3.17
c-19.17,0.109-31.196,3.6-51.309,6.529C15.552,23.209,4.321,22.47,0,22.029V24H240z"></path>
  </svg> -->
  <div class="animation-svg">
      <div class="circle">
          <svg width="580" height="400" class="svg-morph">
          <path id="svg_morph" d="m261,30.4375c0,0 114,6 151,75c37,69 37,174 6,206.5625c-31,32.5625 -138,11.4375 -196,-19.5625c-58,-31 -86,-62 -90,-134.4375c12,-136.5625 92,-126.5625 129,-127.5625z"></path>
        </svg>
      </div>
  </div>
  <a class="icw-scroll" href="#scroll">scroll</a>
</header>
<div id="scroll"></div>

<?php
endif;

elseif ( $hero_type === 'video' ):
  ?>
<header class="header">
  <div class="video-bg">
    <video src="<?php echo esc_url( get_field( 'background_video' ) ); ?>" muted loop autoplay></video>
  </div>
  <!-- end video-bg -->
  <div class="container">
    <div class="inner">
      <?php if( get_field( 'video_bg_tagline' ) ) { ?>
      <div class="tagline"><span></span>
        <h6>
          <?php the_field( 'video_bg_tagline' ); ?>
        </h6>
      </div>
      <?php } ?>
      <h1>
        <?php the_field( 'video_bg_title' ); ?>
      </h1>
      <?php if( get_field( 'video_bg_button_link' ) ){ ?>
      <a href="<?php echo esc_url( get_field( 'video_bg_button_link' ) ); ?>" title="<?php echo esc_attr( get_field( 'video_bg_button_label' ) ); ?>"> <?php echo esc_html( get_field( 'video_bg_button_label' ) ); ?> </a>
      <?php } ?>
    </div>
  </div>
</header>
<?php

endif;

endwhile;
endif;

return ob_get_clean();
}
}

vc_map( array(
  "base" => "icw_hero_slider",
  "name" => __( 'Hero Slider', 'ICWTHEME' ),
  "icon" => ICW_CORE_URI . "assets/img/icw.png",
  "content_element" => true,
  "category" => PAGE_BUILDER_GROUP,
  'params' => array(
    array(
      "type" => "dropdown",
      "heading" => __( 'Hero Slider', 'ICWTHEME' ),
      "param_name" => "hero_slider",
      "group" => "General",
      "description" => __( 'Select the slider that you created in Hero Slider section.', 'ICWTHEME' ),
      "value" => icw_get_hero_slider(),
      'admin_label' => true
    )
  ),
) );
