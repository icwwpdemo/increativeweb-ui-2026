<?php
if ( !defined( 'ABSPATH' ) ) {
  die( '-1' );
}

class WPBakeryShortCode_icw_job_slider extends WPBakeryShortCode {


  protected function content( $atts, $content = null ) {

    extract( shortcode_atts( array(
      'details' => '',
	    'image' => '',
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
<div class="job-slider <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?>>
  <div class="swiper-wrapper">
    <?php
    $new_job_value = array();
    foreach ( $details as $data ) {
      $new_line = $data;
      $new_line[ 'time' ] = isset( $new_line[ 'time' ] ) ? $new_line[ 'time' ] : '';
      $new_line[ 'badge' ] = isset( $new_line[ 'badge' ] ) ? $new_line[ 'badge' ] : '';
      $new_line[ 'title' ] = isset( $new_line[ 'title' ] ) ? $new_line[ 'title' ] : '';
      $new_line[ 'description' ] = isset( $new_line[ 'description' ] ) ? $new_line[ 'description' ] : '';
      $new_line[ 'image' ] = isset( $new_line[ 'image' ] ) ? $new_line[ 'image' ] : '';
      $new_line[ 'link' ] = isset( $new_line[ 'link' ] ) ? $new_line[ 'link' ] : '';

      $new_job_value[] = $new_line;

    }

    $idd = 0;
    foreach ( $new_job_value as $job ):
      $idd++;
      $images = wp_get_attachment_image_src( $job[ 'image' ], '' );
    ?>
    <?php if($job['image']){ ?>
      <div class="swiper-slide">
        <div class="job-box"> 
          <?php 
            echo '<figure><img class="icw-lazy" src="'.esc_url(lazyloading).'" data-src="'.esc_url($images[0]).'" alt="'.esc_attr($job['title']).'"></figure>';
            echo '<div class="job-head">';
            if($job['time']) {
              echo '<strong class="job-time"><i class="lni lni-briefcase"></i> '.$job['time'].'</strong>';
            }
            if($job['badge']) {
              echo '<span class="job-badge badge rounded-pill ms-1 px-3 py-2 small">'.$job['badge'].'</span>';
            }
            echo '</div>';

            if($job['title']) {
              echo '<h2>'.esc_html($job['title']).'</h2>';
            } 
            if($job['description']) {
              echo '<div class="info"><i class="lni lni-consulting"></i> <span>'.esc_attr($job['description']).'</span></div>';  
            } 
            if($job['address']) {
              echo '<div class="address"><i class="lni lni-pointer-right"></i> <span>'.esc_attr($job['address']).'</span></div>';  
            } 

            $link = $job['link'];
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
            
            if(!empty($a_href)) {
              echo '<div class="job-action"><a class="icw-btn --primary --btn-sm stretched-link hash-link" title="'.esc_attr($a_title ).'" target="'.esc_attr( $a_target ).'" href="'.esc_url($a_href).'">'.esc_attr($a_title ).'</a></div>';
           }
          ?>
          </div>
    </div>
    <?php } ?>
    <?php
    endforeach;
    wp_reset_query();
    ?>
  </div>
  <div class="swiper-pagination"></div>
</div>

<?php
return ob_get_clean();
}
}


vc_map( array(
  "base" => "icw_job_slider",
  "name" => __( 'Job Carousel', 'ICWTHEME' ),
  "icon" => ICW_CORE_URI . "assets/img/icw.png",
  "content_element" => true,
  "category" => PAGE_BUILDER_GROUP,
  'params' => array(
	  array(
      'type' => 'param_group',
      'param_name' => 'details',
      'heading' => __( 'Job Slider', 'ICWTHEME' ),
      'params' => array(
        array(
          'type' => 'attach_image',
          'heading' => __( 'Image', 'ICWTHEME' ),
          'param_name' => 'image',
          'value' => '',
        ),
		  
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => __( "Time", 'ICWTHEME' ),
          "param_name" => "time",
          "value" => "Onsite - Full Time"
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => __( "Badge", 'ICWTHEME' ),
          "param_name" => "badge",
          "value" => "Developer"
        ),
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
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => __( "Address", 'ICWTHEME' ),
          "param_name" => "address",
          "value" => "Surat, Gujarat",
          'admin_label' => true
        ),
        array(
          'type' => 'vc_link',
          'heading' => esc_html__( 'URL (Link)', 'ICWTHEME' ),
          'param_name' => 'link',
          'description' => esc_html__( 'Add link to button.', 'ICWTHEME' ),
          "group" => 'General',
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
    ),


    
  ) ) );
