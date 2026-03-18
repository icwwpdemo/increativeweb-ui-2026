<?php
if ( !defined( 'ABSPATH' ) ) {
  die( '-1' );
}

class WPBakeryShortCode_icw_info_box_dark extends WPBakeryShortCode {

  protected function content( $atts, $content = null ) {

    extract( shortcode_atts( array(
      'title' => '',
      'text_content' => '',
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



<div class="info-box-dark <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?>>
	
	<?php if( $title != '' ) { ?>
	<h6><?php echo wp_kses_post( $title ); ?></h6>
   <?php } ?>
	<?php if( $text_content != '' ) { ?>
	<p><?php echo wp_kses_post( $text_content ); ?></p>
  <?php } ?>

</div>
<?php

return ob_get_clean();
}
}


vc_map( array(
  "base" => "icw_info_box_dark",
  "name" => __( 'Info Box Dark', 'ICWTHEME' ),
  "icon" => ICW_CORE_URI . "assets/img/icw.png",
  "content_element" => true,
  "category" => PAGE_BUILDER_GROUP,
  'params' => array(
	 
    array(
      "type" => "textfield",
      "heading" => __( 'Title', 'ICWTHEME' ),
      "param_name" => "title",
      "group" => 'General',
      'admin_label' => true
    ),
    array(
      "type" => "textarea",
      "heading" => __( 'Content', 'ICWTHEME' ),
      "param_name" => "text_content",
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
