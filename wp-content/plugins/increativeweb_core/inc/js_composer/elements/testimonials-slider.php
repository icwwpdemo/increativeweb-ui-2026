<?php
if ( !defined( 'ABSPATH' ) ) {
  die( '-1' );
}

class WPBakeryShortCode_icw_testimonials_slider extends WPBakeryShortCode {


  protected function content( $atts, $content = null ) {

    extract( shortcode_atts( array(
      'tagline' => '',
      'title' => '',
	    'control' => 'show',	
      'details' => '',
      'image' => '',
      'animate_block' => 'false',
      'animation_type' => 'fadeIn',
      'animation_delay' => '',
    ), $atts ) );


    ob_start();


    $wrapper_class = array();

    if ( $animate_block == 'yes' ) {
      $wrapper_class[] = 'wow';
      $wrapper_class[] = $animation_type;
    }

    $wrapper_class = implode( ' ', $wrapper_class );


    $images = wp_get_attachment_image_src( $image, '' );
    $details = vc_param_group_parse_atts( $atts[ 'details' ] );
    ?>

<div class="testimonials-slider-block">
<?php if( $tagline ) { ?>
<span class="tagline"><?php echo esc_html( $tagline ); ?></span>
<?php } ?>
<?php if( $title ) { ?>
<h2><?php echo wp_kses_post( $title ); ?></h2>
<?php } ?> 
<div class="testimonials-quote"><svg xmlns="http://www.w3.org/2000/svg" width="82.039" height="74.185" viewBox="0 0 82.039 74.185"><g transform="translate(82.039 74.185) rotate(180)"><path d="M34.91,14.547c-14.545,3.2-17.454,11.344-17.454,24.727H34.91V74.185H0V38.11C0,10.183,13.092.29,34.91,0Zm47.129,0c-14.546,3.2-17.456,11.344-17.456,24.727H82.039V74.185H47.129V38.11C47.129,10.183,60.219.29,82.039,0Z" fill="#f37d19"></path></g></svg></div>

<div class="testimonials-slider <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?>>
  <div class="animation-svg-block">
      <div class="animation-svg-circle">
          <svg width="580" height="400" class="svg-morph">
          <path id="svg_morph" d="m261,30.4375c0,0 114,6 151,75c37,69 37,174 6,206.5625c-31,32.5625 -138,11.4375 -196,-19.5625c-58,-31 -86,-62 -90,-134.4375c12,-136.5625 92,-126.5625 129,-127.5625z"></path>
        </svg>
      </div>
  </div>
  <div class="swiper-wrapper">
      <?php
      $new_testimonials_value = array();
      foreach ( $details as $data ) {
        $new_line = $data;
        $new_line[ 'testimonial' ] = isset( $new_line[ 'testimonial' ] ) ? $new_line[ 'testimonial' ] : '';
        $new_line[ 'name' ] = isset( $new_line[ 'name' ] ) ? $new_line[ 'name' ] : '';
        $new_line[ 'jobtitle' ] = isset( $new_line[ 'jobtitle' ] ) ? $new_line[ 'jobtitle' ] : '';
      $new_line[ 'image' ] = isset( $new_line[ 'image' ] ) ? $new_line[ 'image' ] : '';

        $new_testimonials_value[] = $new_line;
      }

      $idd = 0;
      foreach ( $new_testimonials_value as $testimonial ):
        $idd++;
        $images = wp_get_attachment_image_src( $testimonial[ 'image' ], '' );

        $client_img = get_template_directory_uri() . '/images/no-client.svg';
        if(!empty($images)){
          $client_img = $images[0];
        } else {
          $client_img = get_template_directory_uri() . '/images/no-client.svg';
        }
      ?>
      <div class="swiper-slide">
        <div class="testimonial">
            <figure data-icw="icw----fadeInUp"><img class="icw-lazy" src="<?php echo esc_url(lazyloading); ?>" data-src="<?php echo esc_url($client_img);?>" alt="<?php echo esc_attr($testimonial['title']);?>"></figure>
            <div class="content">
              <?php if($testimonial['testimonial']) { 
                echo '<div class="info" data-icw="icw-fadeInUp">'.$testimonial['testimonial'].'</div>';
              }
              if($testimonial['name']) { 
                echo '<div class="name" data-icw="icw--fadeInUp">'.$testimonial['name'].'</div>';
              } 
              if($testimonial['jobtitle']) { 
              echo '<small data-icw="icw---fadeInUp">'.$testimonial['jobtitle'].'</small>';
              } ?>
          </div>
        </div>
      </div>
      <?php
      endforeach;
      wp_reset_query();
      ?>
  </div>

<?php
  if( $control == 'show' ) { ?>
    <div class="controls">
      <div class="swiper-pagination"></div>
    </div>
    <?php } ?>
    <?php /* if( $control == 'hide' ) { ?> 
      <?php } */ ?>
</div>
</div>
<?php
return ob_get_clean();
}
}


vc_map( array(
  "base" => "icw_testimonials_slider",
  "name" => __( 'Testimonials Slider', 'ICWTHEME' ),
  "icon" => ICW_CORE_URI . "assets/img/icw.png",
  "content_element" => true,
  "category" => PAGE_BUILDER_GROUP,
  'params' => array(
    array(
      "type" => "textfield",
      "holder" => "div",
      "class" => "",
      "heading" => __( "Tagline", 'ICWTHEME' ),
      "param_name" => "tagline",
      "value" => "",
      'admin_label' => true
    ),
    array(
      "type" => "textfield",
      "holder" => "div",
      "class" => "",
      "heading" => __( "Block Title", 'ICWTHEME' ),
      "param_name" => "title",
      "value" => "",
      'admin_label' => true
    ),
	  array(
			"type" 			=> 	"dropdown",
			"heading" 		=> 	__( 'Slider Control', 'ICWTHEME' ),
			"param_name" 	=> 	"control",
			// "group" 		=> 'Control',
			"value"			=>	array(
				"Show"		=> 'show',
				"Hide"		=> 'hide',
				
			)
		),	


    array(
      'type' => 'param_group',
      'param_name' => 'details',
      'heading' => __( 'Reviews', 'ICWTHEME' ),
      'params' => array(
		   array(
          'type' => 'attach_image',
          'heading' => __( 'Image', 'ICWTHEME' ),
          'param_name' => 'image',
          'value' => '',
        ),
		  

        array(
          "type" => "textarea",
          "holder" => "div",
          "class" => "",
          "heading" => __( "Testimonial", 'ICWTHEME' ),
          "param_name" => "testimonial",
          "value" => ""
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => __( "Name", 'ICWTHEME' ),
          "param_name" => "name",
          "value" => "",
          'admin_label' => true
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => __( "Job Title", 'ICWTHEME' ),
          "param_name" => "jobtitle",
          "value" => ""
        ),

      )
    ),
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
    ),
  ) ) );
