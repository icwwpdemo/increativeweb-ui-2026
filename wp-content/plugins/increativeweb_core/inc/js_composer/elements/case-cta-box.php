<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WPBakeryShortCode_icw_case_cta_box extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'title'   			=> '',
			'button_label'   			=> '',
			'button_url'   			=> '',
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
		?>
		<div class="cta-box-sm <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?>>
			
			<h4><?php echo esc_html( $title ); ?></h4>
			<a href="<?php echo esc_url( $buton_url ); ?>"><?php echo esc_html( $button_label ); ?></a>
			

         
		</div>
		<?php

		return ob_get_clean();
	}
}


vc_map( array(
	"base" 			    => "icw_case_cta_box",
	"name" 			    => __( 'Case CTA Box', 'ICWTHEME' ),
	"icon"              => ICW_CORE_URI . "assets/img/icw.png",
	"content_element"   => true,
	"category" 		    => PAGE_BUILDER_GROUP,
	'params' => array(
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Title', 'ICWTHEME' ),
			"param_name" 	=> 	"title",
			"group" 		=> 'General',
			'admin_label' => true
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Button Label', 'ICWTHEME' ),
			"param_name" 	=> 	"button_label",
			"group" 		=> 'General',
			'admin_label' => true
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Button URL', 'ICWTHEME' ),
			"param_name" 	=> 	"button_url",
			"group" 		=> 'General',
			'admin_label' => true
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
		)
	),
) );
