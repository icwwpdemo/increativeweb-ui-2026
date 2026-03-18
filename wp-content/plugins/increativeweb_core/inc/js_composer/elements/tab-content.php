<?php
if ( !defined( 'ABSPATH' ) ) {
  die( '-1' );
}

class WPBakeryShortCode_icw_tab_content extends WPBakeryShortCode {


  protected function content( $atts, $content = null ) {

    extract( shortcode_atts( array(
      'image' => '',
      'details' => '',
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
<div class="tab-wrapper <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?> >

    <ul class="tab-nav">
      <?php
      $new_accordion_value = array();
      foreach ( $details as $data ) {
        $new_line = $data;
        $new_line[ 'tab_icon' ] = isset( $new_line[ 'tab_icon' ] ) ? $new_line[ 'tab_icon' ] : '';
        $new_line[ 'tab_item' ] = isset( $new_line[ 'tab_item' ] ) ? $new_line[ 'tab_item' ] : '';
        $new_accordion_value[] = $new_line;

      }

      $idd = 0;
      foreach ( $new_accordion_value as $accordion ):

        $idd++;
      ?>
      <li><a href="#tab<?php echo esc_attr( $idd ); ?>">
		  <span><?php echo wp_kses_post($accordion['tab_icon']);?></span>
		  <small><?php echo esc_html($accordion['tab_item']);?></small>
		  
		  
		  </a></li>
      <?php
      endforeach;
      wp_reset_query();
      ?>
    </ul>
   
 

    <?php
    $new_accordion_value = array();
    foreach ( $details as $data ) {
      $new_line = $data;
      $new_line[ 'tab_content' ] = isset( $new_line[ 'tab_content' ] ) ? $new_line[ 'tab_content' ] : '';
      $new_line[ 'image' ] = isset( $new_line[ 'image' ] ) ? $new_line[ 'image' ] : '';
      $new_accordion_value[] = $new_line;

    }

    $idd = 0;
    foreach ( $new_accordion_value as $accordion ):

      $idd++;
    $images = wp_get_attachment_image_src( $accordion[ 'image' ], '' );
    ?>
    <div id="tab<?php echo esc_attr( $idd ); ?>" class="tab-item">
		<?php echo esc_html($accordion['tab_content']);?> </div>
    <?php
    endforeach;
    wp_reset_query();
    ?>
 
</div>
<!-- end tan-content -->
<?php
return ob_get_clean();
}
}


vc_map( array(
  "base" => "icw_tab_content",
  "name" => __( 'Tab Content', 'ICWTHEME' ),
  "icon" => ICW_CORE_URI . "assets/img/icw.png",
  "content_element" => true,
  "category" => PAGE_BUILDER_GROUP,
  'params' => array(
    

    array(
      'type' => 'param_group',
      'param_name' => 'details',
      'heading' => __( 'Tab Item', 'ICWTHEME' ),
      'params' => array(

		  array(
          "group" => 'Tab Content',
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => __( "Tab Icon", 'ICWTHEME' ),
          "param_name" => "tab_icon",
          "value" => ""
        ),
        array(
          "group" => 'Tab Content',
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => __( "Tab Item", 'ICWTHEME' ),
          "param_name" => "tab_item",
          "value" => "",
          'admin_label' => true
        ),
       
        array(
          "group" => 'Tab Content',
          "type" => "textarea",
          "holder" => "div",
          "class" => "",
          "heading" => __( "Tab Content", 'ICWTHEME' ),
          "param_name" => "tab_content",
          "value" => ""
        ),

      ),

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
