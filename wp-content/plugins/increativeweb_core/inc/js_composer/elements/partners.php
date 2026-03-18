<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WPBakeryShortCode_icw_partners extends WPBakeryShortCode {

	
	 protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array(
			
			'has_readmore'   	    => 'no',
			'readmore_label'   		=> 'Learn More',
			'readmore_link'   		=> '',
      		'image' => '',
        ), $atts ) );

        
        ob_start();
	
		 
		
	
	
    $images = wp_get_attachment_image_src($image,''); 
    $details = vc_param_group_parse_atts($atts['details']);
    ?> 



    
     <div class="partners">
		 <div class="container">
		 <div class="inner">
			 
       
			<ul>
				<li><h6>PARTNERS</h6></li>
          <?php $new_accordion_value = array();
      foreach($details as $data){
        $new_line = $data;
        $new_line['image'] = isset($new_line['image']) ? $new_line['image'] : '';
        $new_line['title'] = isset($new_line['title']) ? $new_line['title'] : '';
     
        $new_accordion_value[] = $new_line;
     
      }
     
      $idd = 0;
      foreach($new_accordion_value as $accordion):
      $idd++;
    $images = wp_get_attachment_image_src($accordion['image'],'');
                ?>
         
				
				<li>
            <figure><img src="<?php echo esc_url($images[0]);?>" alt="<?php echo esc_attr($accordion['title']);?>">
            
            </figure>
          </li>
				
			
			
			  
            
			
		
          
    
          <?php endforeach;
                  wp_reset_query(); ?>
        </ul>
       
			
			</div>
		 </div>
</div>








<?php  return ob_get_clean();
} 
	}
	


vc_map( array(
	"base" 			    => "icw_partners",
	"name" 			    => __( 'Partners', 'ICWTHEME' ),
	"icon"              => ICW_CORE_URI . "assets/img/icw.png",
	"content_element"   => true,
	"category" 		    => PAGE_BUILDER_GROUP,
	'params' => array(
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
		
             
   array(
	   "group" 		=> 'Partners',
      'type' => 'param_group',
      'param_name' => 'details',
      'heading' => __('Logo', 'ICWTHEME'),
      'params' => array(
            array(
                  'type' => 'attach_image',
                  'heading' => __( 'Logo', 'ICWTHEME' ),
                  'param_name' => 'image',
                  'value' => '',
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
               )
	),
)));
