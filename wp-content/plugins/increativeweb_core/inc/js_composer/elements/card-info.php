<?php
if ( !defined( 'ABSPATH' ) ) {
  die( '-1' );
}

class WPBakeryShortCode_icw_team_member extends WPBakeryShortCode {

  protected function content( $atts, $content = null ) {

    extract( shortcode_atts( array(
      'details' => '',
      'member' => '',
      'member_name' => '',
      'title' => '',
      'phone' => '',
      'animate_block' => 'false',
      'animation_type' => 'fadeIn',
      'animation_delay' => '',
    ), $atts ) );
    $member_url = '';
    if ( $member != '' ) {
      $member_url = wp_get_attachment_url( $member );
    }
    ob_start();

    $wrapper_class = array();
    if ( $animate_block == 'yes' ) {
      $wrapper_class[] = 'wow';
      $wrapper_class[] = 'fadeIn';
    }
    $wrapper_class = implode( ' ', $wrapper_class );

    $details = vc_param_group_parse_atts( $atts[ 'details' ] );
    ?>
<figure class="card-info <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?>>
	<div><img class="icw-lazy" src="<?php echo esc_url(lazyloading); ?>" data-src="<?php echo esc_url($member_url); ?>" alt="<?php echo esc_attr($title); ?>"></div>
  <figcaption>
    <?php if( $member_name != '' ) { ?>
    <h3><?php echo esc_attr( $member_name ); ?></h3>
    <?php } ?>
    <?php if( $title != '' ) { ?>
    <small><?php echo esc_html( $title ); ?></small>
    <?php } ?>
    <?php if(!empty($details[0]['social_url'])){ ?>
    <ul>
      <?php
      $new_accordion_value = array();
      foreach ( $details as $data ) {
        $new_line = $data;
        $new_line[ 'social_icon' ] = isset( $new_line[ 'social_icon' ] ) ? $new_line[ 'social_icon' ] : '';
        $new_line[ 'social_url' ] = isset( $new_line[ 'social_url' ] ) ? $new_line[ 'social_url' ] : '';
        $new_accordion_value[] = $new_line;

      }

      $idd = 0;
      foreach ( $new_accordion_value as $accordion ):
        $idd++;
      ?>
      <li> <a href="<?php echo esc_url($accordion['social_url']);?>"> <?php echo wp_kses_post($accordion['social_icon']);?></a> </li>
      <?php
      endforeach;
      wp_reset_query();
      ?>
    </ul>
    <?php } ?>
  </figcaption>
</figure>
<?php

return ob_get_clean();
}
}


vc_map( array(
  "base" => "icw_team_member",
  "name" => __( 'Card Info', 'ICWTHEME' ),
  "icon" => ICW_CORE_URI . "assets/img/icw.png",
  "content_element" => true,
  "category" => PAGE_BUILDER_GROUP,
  'params' => array(
    array(
      "type" => "attach_image",
      "heading" => __( 'Member', 'ICWTHEME' ),
      "param_name" => "member",
      "group" => 'General',
      'admin_label' => true
    ),
    array(
      "type" => "textfield",
      "heading" => __( 'Member Name', 'ICWTHEME' ),
      "param_name" => "member_name",
      "group" => 'General',
      'admin_label' => true
    ),
    array(
      "type" => "textfield",
      "heading" => __( 'Job Title', 'ICWTHEME' ),
      "param_name" => "title",
      "group" => 'General',
      'admin_label' => true
    ),


    array(
      'type' => 'param_group',
      'param_name' => 'details',
      'heading' => __( 'Social Item', 'ICWTHEME' ),
      "group" => 'General',
      'params' => array(

        array(
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => __( "Social Icon", 'ICWTHEME' ),
          'admin_label' => true,
          "param_name" => "social_icon",
              "value"			=>	array(
                "Facebook"		=> '<i class="lni lni-facebook-filled"></i>',
                "Twitter"		=> '<i class="lni lni-twitter-original"></i>',
                "Instagram"		=> '<i class="lni lni-instagram-original"></i>',
                
                "Linkedin"		=> '<i class="lni lni-linkedin-original"></i>',
                "Youtube"		=> '<i class="lni lni-youtube"></i>',
                "Pinterest"		=> '<i class="lni lni-pinterest"></i>',
                "Behance"		=> '<i class="lni lni-behance-original"></i>',
                "Vimeo"			=> '<i class="lni lni-vimeo"></i>',
                "ViewMore"			=> '<strong>View More</strong>',
              )
			
          
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => __( "Social URL", 'ICWTHEME' ),
          "param_name" => "social_url",
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
    )
  ),
) );
