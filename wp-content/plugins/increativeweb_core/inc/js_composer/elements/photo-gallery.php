<?php
if ( !defined( 'ABSPATH' ) ) {
  die( '-1' );
}

class WPBakeryShortCode_icw_photo_gallery extends WPBakeryShortCode {


  protected function content( $atts, $content = null ) {

    extract( shortcode_atts( array(


      'image' => '',
      'animate_block' => 'false',
      'animation_type' => 'fadeIn',
      'animation_delay' => '',
    ), $atts ) );


    ob_start();


    $images = wp_get_attachment_image_src( $image, '' );
    $details = vc_param_group_parse_atts( $atts[ 'details' ] );
    ?>
<ul class="case-gallery masonry <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?>>
    <?php
    $new_accordion_value = array();
    foreach ( $details as $data ) {
      $new_line = $data;
      $new_line[ 'image' ] = isset( $new_line[ 'image' ] ) ? $new_line[ 'image' ] : '';
      $new_line[ 'title' ] = isset( $new_line[ 'title' ] ) ? $new_line[ 'title' ] : '';
      $new_line[ 'link_url' ] = isset( $new_line[ 'link_url' ] ) ? $new_line[ 'link_url' ] : '';

      $new_accordion_value[] = $new_line;

    }

    $idd = 0;
    foreach ( $new_accordion_value as $accordion ):
      $idd++;
    $images = wp_get_attachment_image_src( $accordion[ 'image' ], '' );
    ?>
    <li>
      <figure><a href="<?php echo esc_url($images[0]);?>" data-fancybox><img src="<?php echo esc_url($images[0]);?>" alt="<?php echo esc_attr($accordion['title']);?>"></a> </figure>
    </li>
    <?php
    endforeach;
    wp_reset_query();
    ?>
  </ul>
  



<?php
return ob_get_clean();
}
}


vc_map( array(
  "base" => "icw_photo_gallery",
  "name" => __( 'Photo Gallery', 'ICWTHEME' ),
  "icon" => ICW_CORE_URI . "assets/img/icw.png",
  "content_element" => true,
  "category" => PAGE_BUILDER_GROUP,
  'params' => array(
    
    array(
      "group" => 'Gallery',
      'type' => 'param_group',
      'param_name' => 'details',
      'heading' => __( 'Gallery Image', 'ICWTHEME' ),
      'params' => array(
        array(
          'type' => 'attach_image',
          'heading' => __( 'Image background', 'ICWTHEME' ),
          'param_name' => 'image',
          'value' => '',
          'description' => __( 'Even for using video bg at least add transparent image here ! Otherwise you can use here for adding background image', 'ICWTHEME' )
        ),

        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => __( "Alt Tag", 'ICWTHEME' ),
          "param_name" => "title",
          "value" => "",
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

      )
    ),
  ) ) );
