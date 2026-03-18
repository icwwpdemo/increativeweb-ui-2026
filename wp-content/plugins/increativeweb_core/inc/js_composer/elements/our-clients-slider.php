<?php
if ( !defined( 'ABSPATH' ) ) {
  die( '-1' );
}

class WPBakeryShortCode_icw_clients_slider extends WPBakeryShortCode {


  protected function content( $atts, $content = null ) {

    extract( shortcode_atts( array(
      'tagline' => '',
      'title' => '',
	    'control' => 'show',	
      'details' => '',
      'image' => '',
      'link' => '',
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

<div class="clients-slider-block">
<?php if( $tagline ) { ?>
<span class="tagline"><?php echo esc_html( $tagline ); ?></span>
<?php } ?>
<?php if( $title ) { ?>
<h2><?php echo wp_kses_post( $title ); ?></h2>
<?php } ?> 

<div class="client-slider <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?>>
  <div class="swiper-wrapper">
    <?php
    $new_clients_value = array();
    foreach ( $details as $data ) {
      
      $new_line = $data;
      $new_line[ 'image' ] = isset( $new_line[ 'image' ] ) ? $new_line[ 'image' ] : '';
      $new_line[ 'title' ] = isset( $new_line[ 'title' ] ) ? $new_line[ 'title' ] : '';

      //parse link
      // $link = ( $new_line[ 'link' ] == '||' ) ? '' : $new_line[ 'link' ];
      // $new_line[ 'link' ] = vc_build_link( $link );

      $link = ( isset($new_line['link']) && $new_line['link'] == '||' ) ? '' : (isset($new_line['link']) ? $new_line['link'] : '');
      $new_line['link'] = vc_build_link($link);


      // $new_line[ 'url' ]='';
      // $new_line[ 'target' ] = '_self';
      // $new_line[ 'cta' ] = '';
      
      // if ( strlen( $link['url'] ) > 0 ) {
      //     $new_line[ 'url' ] = $link['url'];
      //     $new_line[ 'cta' ] = $link['title'];
      //     $new_line[ 'target' ] = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
      // }
      // pr($new_line);
      $new_clients_value[] = $new_line;

    }
    $idd = 0;
    foreach ( $new_clients_value as $client ):
      $idd++;
      $images = wp_get_attachment_image_src( $client[ 'image' ], '' );

      $alt = $client['title'];
      if(empty($alt)){
        $alt = 'InCreativeWeb';
      }

      $url = $client['link'];

      $a_href='';
      $a_target = '_self';
      $a_title = '';

      if ( strlen( $url['url'] ) > 0 ) {
          $a_href = $url['url'];
          $a_title = $url['title'];
          $a_target = strlen( $url['target'] ) > 0 ? $url['target'] : '_self';
      }

      // pr($url);
    ?>
    <?php 
    $eliment_start = 'div';
    $eliment_end = 'div';
    if(!empty($a_href)) {
      $eliment_start = 'a title="'.esc_attr($a_title ).'" target="'.esc_attr( $a_target ).'" href="'.esc_url($a_href).'"';
      $eliment_end = 'a';
      //<a class="icw-btn-link" title="'.esc_attr($a_title ).'" target="'.esc_attr( $a_target ).'" href="'.esc_url($a_href).'">'.esc_attr($a_title ).'</a>';
    } else {
    
    }

    if(!empty($images[0])){ ?>
    <div class="swiper-slide">
    <<?php echo $eliment_start; ?> class="client-slide"><img src="<?php echo esc_url($images[0]);?>" alt="<?php echo esc_html($alt);?>" /></<?php echo $eliment_end; ?>>
    </div>
    <?php } ?>
    <?php
    endforeach;
    wp_reset_query();
    ?>
  </div>


<?php
  if( $control == 'show' ) { ?>
    <div class="controls">
      <div class="button-prev"><i class="lni lni-angle-double-left"></i></div><div class="button-next"><i class="lni lni-angle-double-right"></i></div>
    </div>
    <?php } ?>
    <?php /* if( $control == 'hide' ) { ?> 
      <?php } */ ?>
</div>
</div>
<?php
return ob_get_clean();
}
}


vc_map( array(
  "base" => "icw_clients_slider",
  "name" => __( 'Our Clients Slider', 'ICWTHEME' ),
  "icon" => ICW_CORE_URI . "assets/img/icw.png",
  "content_element" => true,
  "category" => PAGE_BUILDER_GROUP,
  'params' => array(
    array(
      "type" => "textfield",
      "holder" => "div",
      "class" => "",
      "heading" => __( "Tagline", 'ICWTHEME' ),
      "param_name" => "tagline",
      "value" => "",
      'admin_label' => true
    ),
    array(
      "type" => "textfield",
      "holder" => "div",
      "class" => "",
      "heading" => __( "Block Title", 'ICWTHEME' ),
      "param_name" => "title",
      "value" => "",
      'admin_label' => true
    ),
	  array(
			"type" 			=> 	"dropdown",
			"heading" 		=> 	__( 'Slider Control', 'ICWTHEME' ),
			"param_name" 	=> 	"control",
			// "group" 		=> 'Control',
			"value"			=>	array(
				"Show"		=> 'show',
				"Hide"		=> 'hide',
				
			)
		),	


    array(
      'type' => 'param_group',
      'param_name' => 'details',
      'heading' => __( 'Our Clients List', 'ICWTHEME' ),
      'params' => array(
        array(
          'type' => 'attach_image',
          'heading' => __( 'Logo Image', 'ICWTHEME' ),
          'param_name' => 'image',
          "description" => __( 'Select the logo : BEST SIZE: 180px * 75px', 'ICWTHEME' ),
          'value' => ''
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
          'type' => 'vc_link',
          'heading' => esc_html__( 'URL (Link)', 'ICWTHEME' ),
          'param_name' => 'link',
          'description' => esc_html__( 'Add link to button.', 'ICWTHEME' )
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
