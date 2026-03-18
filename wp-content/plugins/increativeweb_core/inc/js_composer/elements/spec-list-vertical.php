<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WPBakeryShortCode_icw_spec_list_vertical extends WPBakeryShortCode {


	
	
	
	
	 protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array(
			'animate_block'			=> 'false',
			'animation_type'		=> 'fadeIn',
			'animation_delay'		=> '',
        ), $atts ) );

        
        ob_start();
	
		 $wrapper_class = array();

		if( $animate_block == 'yes' ) {
			$wrapper_class[] = 'wow';
			$wrapper_class[] = $animation_type;
		}

		$wrapper_class = implode( ' ', $wrapper_class );
		
	
	
   
    $details = vc_param_group_parse_atts($atts['details']);
    ?> 


	<ul class="spec-list-vertical <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?> id="accordion" role="tablist">
            
          


    
  
          <?php $new_accordion_value = array();
      foreach($details as $data){
        $new_line = $data;
       
        $new_line['title'] = isset($new_line['title']) ? $new_line['title'] : '';
        $new_line['description'] = isset($new_line['description']) ? $new_line['description'] : '';
        
     
        $new_accordion_value[] = $new_line;
     
      }
     
      $idd = 0;
      foreach($new_accordion_value as $accordion):
		
      $idd++;
                ?>
       
		<li>
		<b><?php echo esc_html($accordion['title']);?></b>
			 <strong><?php echo esc_html($accordion['description']);?></strong>
            </li>
		
		
		
		
			
			
          
       
          <?php endforeach;
                  wp_reset_query(); ?>
       </ul>
    








<?php  return ob_get_clean();
} 
	}
	


vc_map( array(
	"base" 			    => "icw_spec_list_vertical",
	"name" 			    => __( 'Specification List Vertical', 'ICWTHEME' ),
	"icon"              => ICW_CORE_URI . "assets/img/icw.png",
	"content_element"   => true,
	"category" 		    => PAGE_BUILDER_GROUP,
	'params' => array(
	      
   array(
      'type' => 'param_group',
      'param_name' => 'details',
      'heading' => __('Specification Item', 'ICWTHEME'),
      'params' => array(
           
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
               "type" => "textarea",
               "holder" => "div",
               "class" => "",
               "heading" => __("Description", 'ICWTHEME'),
               "param_name" => "description",
               "value" => "",
			   'admin_label' => true
            ),
            
	  ),
	 
	),
		array(
			"type" 			=> 	"dropdown",
			"heading" 		=> 	__( 'Animate', 'ICWTHEME' ),
			"param_name" 	=> 	"animate_block",
			"group" 		=> 'Animation',
			"value"			=>	array(
				"No"			=>		'no',
				"Yes"			=>		'yes',
			)
		),
		array(
			"type" 			=> 	"dropdown",
			"heading" 		=> 	__( 'Animation Type', 'ICWTHEME' ),
			"param_name" 	=> 	"animation_type",
			"dependency" => array('element' => "animate_block", 'value' => 'yes'),
			"group" 		=> 'Animation',
			"value"			=>	icw_animations()
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Animation Delay', 'ICWTHEME' ),
			"param_name" 	=> 	"animation_delay",
			"dependency" => array('element' => "animate_block", 'value' => 'yes'),
			"description"	=>	__( 'Animation delay set in second e.g. 0.6s', 'ICWTHEME' ),
			"group" 		=> 'Animation',
		),
)));
