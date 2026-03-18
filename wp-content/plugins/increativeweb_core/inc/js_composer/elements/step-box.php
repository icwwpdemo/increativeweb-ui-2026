<?php
if ( !defined( 'ABSPATH' ) ) {
  die( '-1' );
}

class WPBakeryShortCode_icw_step_box extends WPBakeryShortCode {

  protected function content( $atts, $content = null ) {

    extract( shortcode_atts( array(
		'image' => '',
      'number' => '',
      'icon' => '',
		'title' => '',
      'description' => '',
      'animate_block' => 'false',
      'animation_type' => 'fadeIn',
      'animation_delay' => '',
    ), $atts ) );

    ob_start();

    $icon_url = '';
    if ( $icon != '' ) {
      $icon_url = wp_get_attachment_url( $icon );
    }

    if ( !$icon_url ) return;
	  
	  
	 $image_url = '';
    if ( $image != '' ) {
      $image_url = wp_get_attachment_url( $image );
    }

    if ( !$image_url ) return; 

    $wrapper_class = '';
    if ( $animate_block == 'yes' ) {
      $wrapper_class = 'wow ' . $animation_type;
    }
    ?>




<div class="step-box <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?>>
	
  <figure class="image"> <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_html( $title ); ?>"> </figure>
	
	<div class="content"> 
		<?php if( $number != '' ) { ?>
		<span><?php echo esc_html( $number ); ?></span>
		 <?php } ?>
		<figure class="icon">
		<img src="<?php echo esc_url( $icon_url ); ?>" alt="<?php echo esc_html( $title ); ?>">
		</figure>
		
  <?php if( $title != '' ) { ?>
  <h6><?php echo esc_html( $title ); ?></h6>
  <?php } ?>
  <p><?php echo esc_html( $description ); ?></p> 
</div>
</div>
<?php

return ob_get_clean();
}
}


vc_map( array(
  "base" => "icw_step_box",
  "name" => __( 'Step Box', 'ICWTHEME' ),
  "icon" => ICW_CORE_URI . "assets/img/icw.png",
  "content_element" => true,
  "category" => PAGE_BUILDER_GROUP,
  'params' => array(
    array(
      "type" => "attach_image",
      "heading" => __( 'Box Image', 'ICWTHEME' ),
      "param_name" => "image",
      "group" => "General",
    ),
	 array(
      "type" => "textfield",
      "heading" => __( 'Number', 'ICWTHEME' ),
      "param_name" => "number",
      "group" => 'General',
      'admin_label' => true
    ), 
	array(
      "type" => "attach_image",
      "heading" => __( 'Icon', 'ICWTHEME' ),
      "param_name" => "icon",
      "group" => "General",
    ),  
    array(
      "type" => "textfield",
      "heading" => __( 'Title', 'ICWTHEME' ),
      "param_name" => "title",
      "group" => 'General',
      'admin_label' => true
    ),
    array(
      "type" => "textarea",
      "heading" => __( 'Description', 'ICWTHEME' ),
      "param_name" => "description",
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
