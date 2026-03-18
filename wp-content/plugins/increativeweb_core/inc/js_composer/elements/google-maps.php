<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WPBakeryShortCode_icw_google_maps extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'iframe_url'		=> '',
			'map_height'		=> '',
			'animate_block'			=> 'no',
			'animation_type'		=> '',
			'animation_delay'		=> '',
		), $atts ) );
		

		ob_start();

		$wrapper_class = '';
		if( $animate_block == 'yes' ) {
			$wrapper_class = 'wow ' . $animation_type;
		}
		if( $iframe_url ) {
			?>
            <div class="google-maps <?php echo esc_attr( $wrapper_class ); ?>" <?php if ( $animate_block == 'yes' && $animation_delay != '' ) {
				echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"';
			} ?>>
				
			
                <iframe src="<?php echo esc_url( $iframe_url ); ?>" width="100%" height="<?php echo esc_attr( $map_height ); ?>" frameborder="0" allowfullscreen></iframe>
            </div>

			<?php
		}

		return ob_get_clean();
	}
}


vc_map( array(
	"base" 			    => "icw_google_maps",
	"name" 			    => __( 'Google Maps', 'ICWTHEME' ),
	"content_element"   => true,
	"icon"              => ICW_CORE_URI . "assets/img/icw.png",
	"category" 		    => PAGE_BUILDER_GROUP,
	'params' => array(
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'iFrame Url', 'ICWTHEME' ),
			"param_name" 	=> 	"iframe_url",
			"group" 		=> 'General',
			'admin_label' => true
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Google Maps Height', 'ICWTHEME' ),
			"param_name" 	=> 	"map_height",
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
