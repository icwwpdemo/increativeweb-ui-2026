<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WPBakeryShortCode_icw_project_slider extends WPBakeryShortCode {


	
	
	
	
	 protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array(
		'control'   	    => 'show',	
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





    
      <div class="swiper-container project-slider <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?>>
        <div class="swiper-wrapper">
          <?php $new_accordion_value = array();
      foreach($details as $data){
        $new_line = $data;
        $new_line['image'] = isset($new_line['image']) ? $new_line['image'] : '';
        $new_line['title'] = isset($new_line['title']) ? $new_line['title'] : '';
        $new_line['description'] = isset($new_line['description']) ? $new_line['description'] : '';
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
			  
			    <figure class="project-box">
					<a href="<?php echo esc_url($accordion['link_url']);?>"> <img src="<?php echo esc_url($images[0]);?>" alt="<?php echo esc_html($accordion['title']);?>"></a>
          <figcaption>
			  <?php if($accordion['title']) { ?>
            <h5> <?php echo esc_html($accordion['title']);?></h5>
			   <?php } ?>
			  
			  <?php if($accordion['description']) { ?>
            <p><?php echo esc_html($accordion['description']);?></p>
			   <?php } ?>
          </figcaption>
        </figure>
			  
			  
			
			
			</div>
          
        <?php } ?>
          <?php endforeach;
                  wp_reset_query(); ?>
        </div>
       
		  <?php
            if( $control == 'show' ) { ?>
        <div class="swiper-pagination"></div>
		  <?php
            }
            ?>
		  <?php
            if( $control == 'hide' ) { ?>
		  
		   <?php
            }
            ?>
		  
      </div>
    








<?php  return ob_get_clean();
} 
	}
	


vc_map( array(
	"base" 			    => "icw_project_slider",
	"name" 			    => __( 'Project Slider', 'ICWTHEME' ),
	"icon"              => ICW_CORE_URI . "assets/img/icw.png",
	"content_element"   => true,
	"category" 		    => PAGE_BUILDER_GROUP,
	'params' => array(
	array(
			"type" 			=> 	"dropdown",
			"heading" 		=> 	__( 'Slider Control', 'ICWTHEME' ),
			"param_name" 	=> 	"control",
			"group" 		=> 'General',
			"value"			=>	array(
				"Show"		=> 'show',
				"Hide"		=> 'hide',
				
			)
		),	
		
            
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
                 
               ),
            
            array(
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => __("Project Title", 'ICWTHEME'),
               "param_name" => "title",
               "value" => "",
               'admin_label' => true
            ),
            array(
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => __("Project Description", 'ICWTHEME'),
               "param_name" => "description",
               "value" => "",
               'admin_label' => true
            ),
		   array(
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => __("Project URL", 'ICWTHEME'),
               "param_name" => "link_url",
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
    ),
)));
