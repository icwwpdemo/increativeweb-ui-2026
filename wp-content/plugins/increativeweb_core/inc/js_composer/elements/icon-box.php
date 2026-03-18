<?php
if ( !defined( 'ABSPATH' ) ) {
  die( '-1' );
}

class WPBakeryShortCode_icw_icon_box extends WPBakeryShortCode {

  protected function content( $atts, $content = null ) {

    extract( shortcode_atts( array(
      'title' => '',
      'icon' => '',
      'description' => '',
      'link' => '',
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

    //parse link
    $link = ( $link == '||' ) ? '' : $link;
    $link = vc_build_link( $link );

    $a_href='';
    $a_target = '_self';
    $a_title = '';

    if ( strlen( $link['url'] ) > 0 ) {
        $a_href = $link['url'];
        $a_title = $link['title'];
        $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
    }
    ?>
<div class="icon-box <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?>>
  <figure><img class="icw-lazy" src="<?php echo esc_url(lazyloading); ?>" data-src="<?php echo esc_url( $icon_url ); ?>" alt="<?php echo esc_attr( get_the_title( $icon ) ); ?>"></figure>
  <?php 
  if(!empty($title)) {
    if(!empty($a_href)) {
      echo '<h3><a target="'.esc_attr( $a_target ).'" href="'.esc_url($a_href).'">'.esc_html( $title ).'</a></h3>';
    } else {
      echo '<h3>'.esc_html( $title ).'</h3>';
    }
  }
  if(!empty($description)) {
    echo '<div class="info">'.$description.'</div>';
  }
  if(!empty($a_href)) {
     echo '<a class="icw-btn-link" title="'.esc_attr($a_title ).'" target="'.esc_attr( $a_target ).'" href="'.esc_url($a_href).'">'.esc_attr($a_title ).'</a>';
  } ?>
</div>
<?php
return ob_get_clean();
}
}


vc_map( array(
  "base" => "icw_icon_box",
  "name" => __( 'Icon Box', 'ICWTHEME' ),
  "icon" => ICW_CORE_URI . "assets/img/icw.png",
  "content_element" => true,
  "category" => PAGE_BUILDER_GROUP,
  'params' => array(
    array(
      "type" => "attach_image",
      "heading" => __( 'Icon', 'ICWTHEME' ),
      "param_name" => "icon",
      "group" => "General",
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
      'type' => 'vc_link',
      'heading' => esc_html__( 'URL (Link)', 'ICWTHEME' ),
      'param_name' => 'link',
      'description' => esc_html__( 'Add link to button.', 'ICWTHEME' ),
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
