<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WPBakeryShortCode_icw_image_slider extends WPBakeryShortCode {

	
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



    
      <div class="content-slider <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?>>
        <div class="swiper-wrapper">
          <?php $new_accordion_value = array();
      foreach($details as $data){
        $new_line = $data;
        $new_line['image'] = isset($new_line['image']) ? $new_line['image'] : '';
        $new_line['video'] = isset($new_line['video']) ? $new_line['video'] : '';
        $new_line['title'] = isset($new_line['title']) ? $new_line['title'] : '';
        $new_line['description'] = isset($new_line['description']) ? $new_line['description'] : '';
        $new_line['link'] = isset($new_line['link']) ? $new_line['link'] : '';
        $new_line['link_url'] = isset($new_line['link_url']) ? $new_line['link_url'] : '';
     
        $new_accordion_value[] = $new_line;
     
      }
     
      $idd = 0;
      foreach($new_accordion_value as $accordion):
      $idd++;
    $images = wp_get_attachment_image_src($accordion['image'],'');
                ?>
          <?php if($accordion['image']){ ?>
          <div class="swiper-slide">
			  <figure>
			  <img src="<?php echo esc_url($images[0]);?>" alt="<?php echo esc_html($accordion['title']);?>">
				   <?php if($accordion['title']) { ?>
				  <figcaption>
					    <?php if($accordion['description']) { ?>
			    <small><?php echo esc_html($accordion['description']);?></small> 
				 
				  
			    <h3><?php echo esc_html($accordion['title']);?></h3> 
				 <?php } ?>
				
				
				  </figcaption>
				  <?php } ?>
			  </figure>
			
			
			</div>
          
        <?php } ?>
          <?php endforeach;
                  wp_reset_query(); ?>
        </div>
        <!-- end swiper-wrapper -->
        <div class="swiper-button-prev"><i class="fas fa-chevron-left"></i></div>
                <!-- end button-prev -->
                <div class="swiper-button-next"><i class="fas fa-chevron-right"></i></div>
                <!-- end button-next --> 
      </div>
      <!-- end content-slider -->
    








<?php  return ob_get_clean();
} 
	}
	


vc_map( array(
	"base" 			    => "icw_image_slider",
	"name" 			    => __( 'Content Slider', 'ICWTHEME' ),
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
                  'type' => 'attach_image',
                  'heading' => __( 'Image', 'ICWTHEME' ),
                  'param_name' => 'image',
                  'value' => '',
                  'description' => __( 'Even for using video bg at least add transparent image here ! Otherwise you can use here for adding background image', 'ICWTHEME' )
               ),
            
            array(
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => __("Title", 'ICWTHEME'),
               "param_name" => "title",
               "value" => "",
               'admin_label' => true
            ),
            array(
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => __("Tags", 'ICWTHEME'),
               "param_name" => "description",
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
)));
