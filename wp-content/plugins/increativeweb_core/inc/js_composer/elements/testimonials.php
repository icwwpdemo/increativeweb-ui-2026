<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WPBakeryShortCode_icw_testimonials extends WPBakeryShortCode {


	
	
	
	
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
		
	
	
    $images = wp_get_attachment_image_src($image,''); 
    $details = vc_param_group_parse_atts($atts['details']);
    ?> 



    
      <div class="testimonials-slider <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?>>
        <div class="swiper-wrapper">
          <?php $new_accordion_value = array();
      foreach($details as $data){
        $new_line = $data;
		  $new_line['quote'] = isset($new_line['quote']) ? $new_line['quote'] : '';
        $new_line['image'] = isset($new_line['image']) ? $new_line['image'] : '';
        $new_line['company'] = isset($new_line['company']) ? $new_line['company'] : '';
        $new_line['fullname'] = isset($new_line['fullname']) ? $new_line['fullname'] : '';
        
       
     
        $new_accordion_value[] = $new_line;
     
      }
     
      $idd = 0;
      foreach($new_accordion_value as $accordion):
      $idd++;
    $images = wp_get_attachment_image_src($accordion['image'],'');
                ?>
          <?php if($accordion['image']){ ?>
          <div class="swiper-slide">
			
			  
			  
			  
			  <div class="testimonial">
				   <?php if($accordion['quote']) { ?>
			    <blockquote><?php echo esc_attr($accordion['quote']);?></blockquote> 
				 <?php } ?>
      
          <figure> <img src="<?php echo esc_url($images[0]);?>" alt="Image">
            <figcaption>
              <?php if($accordion['company']) { ?>
			    <h6><?php echo esc_attr($accordion['company']);?></h6> 
				 <?php } ?>
             
			   <?php if($accordion['fullname']) { ?>
			    <small><?php echo esc_attr($accordion['fullname']);?></small> 
				 <?php } ?>
			  </figcaption>
          </figure>
        </div>
        
			</div>
          
        <?php } ?>
          <?php endforeach;
                  wp_reset_query(); ?>
        </div>
      
      </div>
    








<?php  return ob_get_clean();
} 
	}
	


vc_map( array(
	"base" 			    => "icw_testimonials",
	"name" 			    => __( 'Testimonials', 'ICWTHEME' ),
	"icon"              => ICW_CORE_URI . "assets/img/icw.png",
	"content_element"   => true,
	"category" 		    => PAGE_BUILDER_GROUP,
	'params' => array(
		
          
   array(
      'type' => 'param_group',
      'param_name' => 'details',
      'heading' => __('Item Slider', 'ICWTHEME'),
      'params' => array(
		   array(
               "type" => "textarea",
               "holder" => "div",
               "class" => "",
               "heading" => __("Review", 'ICWTHEME'),
               "param_name" => "quote",
               "value" => ""
            ),
            array(
                  'type' => 'attach_image',
                  'heading' => __( 'Thumbnail', 'ICWTHEME' ),
                  'param_name' => 'image',
                  'value' => '',
               ),
            array(
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => __("Company", 'ICWTHEME'),
               "param_name" => "company",
               "value" => "",
               'admin_label' => true
            ),
		   array(
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => __("Full Name", 'ICWTHEME'),
               "param_name" => "fullname",
               "value" => "",
               'admin_label' => true
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
