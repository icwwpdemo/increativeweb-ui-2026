<?php
if ( !defined( 'ABSPATH' ) ) {
  die( '-1' );
}

class WPBakeryShortCode_icw_section_title extends WPBakeryShortCode {

  protected function content( $atts, $content = null ) {

    extract( shortcode_atts( array(
      'spacing' => '',
      'color' => 'dark',
      'tagline' => '',
      'title' => '',
      'description' => '',
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
    $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
    ?>
<div class="section-title <?php if( $spacing == 'no-spacing' ) { ?> no-spacing <?php } ?> <?php if( $color == 'light' ) { ?> light <?php } ?>">
  <?php if( $tagline ) { ?>
  <span class="tagline"><?php echo esc_html( $tagline ); ?></span>
  <?php } ?>
  <?php if( $title ) { ?>
  <h2><?php echo wp_kses_post( $title ); ?></h2>
  <?php } ?>
  <?php if( $description ) { ?>
  <div class="info"><?php echo wp_kses_post( $description ); ?></div>
  <?php } 
  if( $content != '' ) { 
    echo '<div class="info mt-3">'. $content . '</div>';
  }?>
</div>
<?php

return ob_get_clean();
}
}


vc_map( array(
  "base" => "icw_section_title",
  "name" => __( 'Section Title', 'ICWTHEME' ),
  "icon" => ICW_CORE_URI . "assets/img/icw.png",
  "content_element" => true,
  "category" => PAGE_BUILDER_GROUP,
  'params' => array(
    array(
      "type" => "dropdown",
      "heading" => __( 'Color', 'ICWTHEME' ),
      "param_name" => "color",
      "group" => 'General',
      "value" => array(
        "Dark" => 'dark',
        "Light" => 'light',

      )
    ),
    array(
      "type" => "dropdown",
      "heading" => __( 'Spacing', 'ICWTHEME' ),
      "param_name" => "spacing",
      "group" => 'General',
      "value" => array(
        "Space" => '',
        "No Spacing" => 'no-spacing',

      )
    ),

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
      "type" => "textarea",
      "heading" => __( 'Description', 'ICWTHEME' ),
      "param_name" => "description",
      "group" => 'General',
    ),
    array(
      "type" => "textarea_html",
      "holder" => "div",
      "class" => "",
      "heading" => __( "Content", "ICWTHEME" ),
      "param_name" => "content", // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
      "description" => __( "Enter your content.", "ICWTHEME" ),
      "group" 		=> "General",
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
