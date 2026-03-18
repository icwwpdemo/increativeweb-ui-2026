<?php
if ( !defined( 'ABSPATH' ) ) {
  die( '-1' );
}

class WPBakeryShortCode_icw_image_box extends WPBakeryShortCode {

  protected function content( $atts, $content = null ) {

    extract( shortcode_atts( array(
      'image' => '',
      'title' => '',
      'fancybox' => 'no',
      'animate_block' => 'false',
      'animation_type' => 'fadeIn',
      'animation_delay' => '',
    ), $atts ) );

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

    ob_start();
    ?>
<figure class="image <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?>>
  <?php if( $fancybox === 'yes' ) { ?>
  <a href="<?php echo esc_url( $image_url ); ?>" data-fancybox title="<?php echo esc_attr( $title ); ?>">
  <?php } ?>
  <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $title ); ?>">
  <?php if( $fancybox === 'yes' ) { ?>
  </a>
  <?php } ?>
</figure>
<?php

return ob_get_clean();
}
}


vc_map( array(
  "base" => "icw_image_box",
  "name" => __( 'Image Box', 'ICWTHEME' ),
  "icon" => ICW_CORE_URI . "assets/img/icw.png",
  "content_element" => true,
  "category" => PAGE_BUILDER_GROUP,
  'params' => array(
    array(
      "type" => "attach_image",
      "heading" => __( 'Image', 'ICWTHEME' ),
      "param_name" => "image",
      "group" => "General",
      'admin_label' => true
    ),
    array(
      "type" => "textfield",
      "heading" => __( 'Alt Tag/Title', 'ICWTHEME' ),
      "param_name" => "title",
      "group" => 'General',
      'admin_label' => true
    ),

    array(
      "type" => "dropdown",
      "heading" => __( 'Fancybox', 'ICWTHEME' ),
      "param_name" => "fancybox",
      "group" => 'General',
      "value" => array(
        "Disable" => 'no',
        "Enable" => 'yes',
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
    )
  ),
) );
