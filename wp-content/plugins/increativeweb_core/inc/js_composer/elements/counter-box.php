<?php
if ( !defined( 'ABSPATH' ) ) {
  die( '-1' );
}

class WPBakeryShortCode_icw_counter_box extends WPBakeryShortCode {

  protected function content( $atts, $content = null ) {

    extract( shortcode_atts( array(
      'image' => '',
      'value' => '',
      'symbol' => '',
      'title' => '',
      'description' => '',
      'animate_block' => 'false',
      'animation_type' => 'fadeIn',
      'animation_delay' => '',
    ), $atts ) );

    ob_start();

    $wrapper_class = array();


    $image_url = '';
    if ( $image != '' ) {
      $image_url = wp_get_attachment_url( $image );
    }

    if ( !$image_url ) return;


    if ( $animate_block == 'yes' ) {
      $wrapper_class[] = 'wow';
      $wrapper_class[] = $animation_type;
    }

    $wrapper_class = implode( ' ', $wrapper_class );
    ?>
<div class="counter-box <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?>>
  <figure><img class="icw-lazy" src="<?php echo esc_url(lazyloading); ?>" data-src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $description ); ?>"> </figure>
  <?php if( $value ) { ?>
  <span class="odometer" data-count="<?php echo esc_html( $value ); ?>" data-status="yes">0</span>
  <?php } ?>
  <?php if( $symbol ) { ?>
  <span class="value"><?php echo esc_html( $symbol ); ?></span>
  <?php } ?>
  <?php if( $description ) { ?>
  <p> <?php echo esc_html( $description ); ?> </p>
  <?php } ?>
</div>
<?php

return ob_get_clean();
}
}


vc_map( array(
  "base" => "icw_counter_box",
  "name" => __( 'Counter Box', 'ICWTHEME' ),
  "icon" => ICW_CORE_URI . "assets/img/icw.png",
  "content_element" => true,
  "category" => PAGE_BUILDER_GROUP,
  'params' => array(
    array(
      "type" => "attach_image",
      "heading" => __( 'Icon', 'ICWTHEME' ),
      "param_name" => "image",
      "group" => "General",
    ),
    array(
      "type" => "textfield",
      "heading" => __( 'Value', 'ICWTHEME' ),
      "param_name" => "value",
      "group" => 'General',
      'admin_label' => true
    ),
    array(
      "type" => "textfield",
      "heading" => __( 'Symbol', 'ICWTHEME' ),
      "param_name" => "symbol",
      "group" => 'General',
      'admin_label' => true
    ),

    array(
      "type" => "textarea",
      "heading" => __( 'Description', 'ICWTHEME' ),
      "param_name" => "description",
      "group" => 'General',
      'admin_label' => true
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
    )
  ),
) );
