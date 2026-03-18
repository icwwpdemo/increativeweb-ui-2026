<?php
if ( !defined( 'ABSPATH' ) ) {
  die( '-1' );
}

class WPBakeryShortCode_icw_cta_box extends WPBakeryShortCode {

  protected function content( $atts, $content = null ) {

    extract( shortcode_atts( array(
      'tagline' => '',
      'title' => '',
      'button_label' => '',
      'button_url' => '',
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
    ?>
<div class="cta-box <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?>>
 
  <?php if( $tagline != '' ) { ?>
  <h6><?php echo wp_kses_post( $tagline ); ?></h6>
  <?php } ?>
	
  <?php if( $title != '' ) { ?>
  <h2><?php echo wp_kses_post( $title ); ?></h2>
	 <?php } ?>
	
  <?php if( $button_label != '' ) { ?>
  <a href="<?php echo esc_url( $button_url ); ?>"><?php echo wp_kses_post( $button_label ); ?></a>
  <?php } ?>
</div>
<?php

return ob_get_clean();
}
}


vc_map( array(
  "base" => "icw_cta_box",
  "name" => __( 'CTA Box', 'ICWTHEME' ),
  "icon" => ICW_CORE_URI . "assets/img/icw.png",
  "content_element" => true,
  "category" => PAGE_BUILDER_GROUP,
  'params' => array(
    array(
      "type" => "textfield",
      "heading" => __( 'Tagline', 'ICWTHEME' ),
      "param_name" => "tagline",
      "group" => 'General',
      'admin_label' => true
    ),
    array(
      "type" => "textfield",
      "heading" => __( 'Title', 'ICWTHEME' ),
      "param_name" => "title",
      "group" => 'General',
      'admin_label' => true
    ),

    array(
      "type" => "textfield",
      "heading" => __( 'Button Label', 'ICWTHEME' ),
      "param_name" => "button_label",
      "group" => 'General',
      'admin_label' => true
    ),
    array(
      "type" => "textfield",
      "heading" => __( 'Button URL', 'ICWTHEME' ),
      "param_name" => "button_url",
      "group" => 'General',
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
