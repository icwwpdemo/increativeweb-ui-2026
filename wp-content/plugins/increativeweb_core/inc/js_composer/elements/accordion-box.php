<?php
if ( !defined( 'ABSPATH' ) ) {
  die( '-1' );
}

class WPBakeryShortCode_icw_accordion extends WPBakeryShortCode {


  protected function content( $atts, $content = null ) {

    extract( shortcode_atts( array(
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


    $details = vc_param_group_parse_atts( $atts[ 'details' ] );
    ?>
<div class="accordion <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?> id="accordion" role="tablist">
  <?php
    if( $tagline ) { 
    echo '<span class="tagline">'.esc_html( $tagline ).'</span>';  
    }
    if( $title ) {
      echo '<h2>'.wp_kses_post( $title ).'</h2>';  
    }
    if( $description ) {
      echo '<div>'.wp_kses_post( $description ).'</div>';
    }

  $new_accordion_value = array();
  foreach ( $details as $data ) {
    $new_line = $data;

    $new_line[ 'title' ] = isset( $new_line[ 'title' ] ) ? $new_line[ 'title' ] : '';
    $new_line[ 'description' ] = isset( $new_line[ 'description' ] ) ? $new_line[ 'description' ] : '';


    $new_accordion_value[] = $new_line;

  }

  $idd = 0;
  foreach ( $new_accordion_value as $accordion ):
    $idd++;
    $expanded = ($idd == 1 ? esc_attr('true') : esc_attr('false') );
  ?>
  <div class="card">
    <h3 class="card-header" role="tab"><a data-toggle="collapse" href="#collapse<?php echo esc_attr( $idd ); ?>" aria-expanded="<?php echo $expanded; ?>" ><?php echo esc_html($accordion['title']);?> <i class="lni lni-plus"></i></a></h3>
    <div id="collapse<?php echo esc_attr( $idd ); ?>" class="collapse" data-parent="#accordion">
      <div class="card-body"> <?php echo $accordion['description'];?></div>
      <!-- end card-body --> 
    </div>
    <!-- end collapse --> 
  </div>
  <!-- end card -->
  
  <?php
  endforeach;
  wp_reset_query();
  ?>
</div>
<!-- end accordion -->

<?php
return ob_get_clean();
}
}


vc_map( array(
  "base" => "icw_accordion",
  "name" => __( 'Accordion Box', 'ICWTHEME' ),
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
      "type" => "textarea",
      "heading" => __( 'Description', 'ICWTHEME' ),
      "param_name" => "description",
      "group" => 'General',
    ),
    array(
      'type' => 'param_group',
      'param_name' => 'details',
      'heading' => __( 'Accordion Item', 'ICWTHEME' ),
      "group" => 'General',
      'params' => array(

        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => __( "Title", 'ICWTHEME' ),
          "param_name" => "title",
          "value" => "",
          'admin_label' => true
        ),
        array(
          "type" => "textarea",
          "holder" => "div",
          "class" => "",
          "heading" => __( "Description", 'ICWTHEME' ),
          "param_name" => "description",
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
