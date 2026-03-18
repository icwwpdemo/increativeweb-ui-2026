<?php
if ( !defined( 'ABSPATH' ) ) {
  die( '-1' );
}

class WPBakeryShortCode_icw_price_box extends WPBakeryShortCode {

  protected function content( $atts, $content = null ) {

    extract( shortcode_atts( array(
	  'details' => '',
      'icon' => '',
      'title' => '',
      'currency' => '',
      'price' => '',
      'time' => '',
      'description' => '',
      'button_label' => '',
      'button_url' => '',
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
	  
	 

    $wrapper_class = '';
    if ( $animate_block == 'yes' ) {
      $wrapper_class = 'wow ' . $animation_type;
    }
	  
	   $details = vc_param_group_parse_atts( $atts[ 'details' ] );
    ?>
<div class="price-box <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?>>
  <figure> <img src="<?php echo esc_url( $icon_url ); ?>" alt="<?php echo esc_attr( get_the_title( $icon ) ); ?>"> </figure>
  <?php if( $title != '' ) { ?>
  <h6><?php echo esc_html( $title ); ?></h6>
  <?php } ?>
  <span><?php echo esc_html( $currency ); ?><?php echo esc_html( $price ); ?><small>/ <?php echo esc_html( $time ); ?></small></span>
	<ul>
	<?php
      $new_accordion_value = array();
      foreach ( $details as $data ) {
        $new_line = $data;
        $new_line[ 'list' ] = isset( $new_line[ 'list' ] ) ? $new_line[ 'list' ] : '';
        $new_accordion_value[] = $new_line;

      }

      $idd = 0;
      foreach ( $new_accordion_value as $accordion ):

        $idd++;
      ?>
   <li>
		<?php echo esc_html($accordion['list']);?> 
	
	</li>
    <?php
    endforeach;
    wp_reset_query();
    ?>
	</ul>
	
	
  <?php if( $button_label ) { ?>
  <a href="<?php echo esc_url( $button_url ); ?>"><?php echo wp_kses_post( $button_label ); ?></a>
  <?php } ?>
</div>
<?php

return ob_get_clean();
}
}


vc_map( array(
  "base" => "icw_price_box",
  "name" => __( 'Price Box', 'ICWTHEME' ),
  "icon" => ICW_CORE_URI . "assets/img/icw.png",
  "content_element" => true,
  "category" => PAGE_BUILDER_GROUP,
  'params' => array(
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
      "type" => "textfield",
      "heading" => __( 'Currency', 'ICWTHEME' ),
      "param_name" => "currency",
      "group" => 'General',
    ),
    array(
      "type" => "textfield",
      "heading" => __( 'Price', 'ICWTHEME' ),
      "param_name" => "price",
      "group" => 'General',
      'admin_label' => true
    ),
    array(
      "type" => "textfield",
      "heading" => __( 'Time', 'ICWTHEME' ),
      "param_name" => "time",
      "group" => 'General',
    ),

    array(
      "type" => "textfield",
      "heading" => __( 'Button Label', 'ICWTHEME' ),
      "param_name" => "button_label",
      "group" => 'General',
    ),
    array(
      "type" => "textfield",
      "heading" => __( 'Button URL', 'ICWTHEME' ),
      "param_name" => "button_url",
      "group" => 'General',
    ),
	 
	   array(
      'type' => 'param_group',
      'param_name' => 'details',
		   "group" => 'List Content',
      'heading' => __( 'List Item', 'ICWTHEME' ),
      'params' => array(

		  
        array(
          "group" => 'List Content',
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => __( "List Item", 'ICWTHEME' ),
          "param_name" => "list",
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
    )
  ),
) );
