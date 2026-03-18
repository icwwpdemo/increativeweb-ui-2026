<?php
if ( !defined( 'ABSPATH' ) ) {
  die( '-1' );
}

class WPBakeryShortCode_icw_logos extends WPBakeryShortCode {

  protected function content( $atts, $content = null ) {

    extract( shortcode_atts( array(
      'brand_logos' => '',
      'iftitle' => 'show',
      'animate_block' => 'false',
      'animation_type' => 'fadeIn',
      'animation_delay' => '',
    ), $atts ) );

    $wrapper_class = array();

    if ( !$brand_logos ) return;

    if ( $animate_block == 'yes' ) {
      $wrapper_class[] = 'wow';
      $wrapper_class[] = $animation_type;
    }

    $wrapper_class = implode( ' ', $wrapper_class );

    ob_start();

    $all_wrapper_class =  esc_attr( $wrapper_class );
    if( $animate_block == 'yes' && $animation_delay != '' ) { 
      $all_wrapper_class .= ' data-wow-delay="' . esc_attr( $animation_delay ); 
    } 
    // pr($atts);
    $image_ids = explode(',',$atts['brand_logos']);
        $html = '<div class="brand-logos '.$all_wrapper_class.'">';
            foreach( $image_ids as $image_id ){
                $images = wp_get_attachment_image_src( $image_id, 'thumbnail' );
                // $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true);
                // $attachment_metadata = wp_get_attachment_caption( $image_id );
                $attachment_content = wp_prepare_attachment_for_js( $image_id );
                // pr($attachment_content);
                $image_alt = $attachment_content['title'];
                if(empty($image_alt)){
                  $image_alt = 'InCreativeWeb';
                }
                // if(!empty($attachment_content['description'])){
                //     $html .='<div class="brand-logo"><a href="'.$attachment_content['description'].'" title="'.$attachment_content['caption'].'" target="_blank"><img src="'.$images[0].'" alt="'.$image_alt.'"></a></div>';
                // } else {
                    $html .='<figure class="brand-logo" data-toggle="tooltip" title="'.esc_attr( $image_alt ).'"><div><img class="icw-lazy" src="'.esc_url(lazyloading).'" data-src="'.$images[0].'" alt="'.$image_alt.'"></div>';
                    if( $iftitle == 'show' ) {
                      $html .='<h3>'.esc_attr( $image_alt ).'</h3>';
                    }
                    $html .='</figure>';
                // }
                // $images++;
            }
            $html .='</div>';
        echo $html;
        /*
    ?>
<figure class="logo-item <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?>>
  dsd
  <h6><img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $alt_tag ); ?>"></h6>
  </figure>
<?php
*/
return ob_get_clean();
}
}


vc_map( array(
  "base" => "icw_logos",
  "name" => __( 'Logos', 'ICWTHEME' ),
  "icon" => ICW_CORE_URI . "assets/img/icw.png",
  "content_element" => true,
  "category" => PAGE_BUILDER_GROUP,
  'params' => array(
    array(
			"type" 			=> 	"dropdown",
			"heading" 		=> 	__( 'With Title', 'ICWTHEME' ),
			"param_name" 	=> 	"iftitle",
			"group" 		=> 'General',
			"value"			=>	array(
				"Show"		=> 'show',
				"Hide"		=> 'hide',
			)
		),
    array(
      "type" => "attach_images",
      "heading" => __( 'Brand Logos', 'ICWTHEME' ),
      "param_name" => "brand_logos",
      "group" => "General",
      "description" 	=> 	__( 'Select the image : BEST SIZE: 120px * 70px', 'ICWTHEME' ),
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
