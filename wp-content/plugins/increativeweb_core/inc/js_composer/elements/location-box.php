<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WPBakeryShortCode_icw_location_box extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'iframe_url'		=> '',
			'address'		=> '',
			'phone'		=> '',
			'email'		=> '',
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
            <div class="location-box <?php echo esc_attr( $wrapper_class ); ?>" <?php if ( $animate_block == 'yes' && $animation_delay != '' ) {
				echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"';
			} ?>>
			 <div class="location-map">
			
                <iframe src="<?php echo esc_url( $iframe_url ); ?>" width="100%" height="380" frameborder="0" style="border:0" allowfullscreen></iframe>
				 <i class="fas fa-map-marker-alt"></i>
				 </div>
				<div class="location-content">
				<address><?php echo esc_html( $address ); ?></address>
				<p><?php echo esc_html( $phone ); ?></p>
				<a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
				
				
				</div>
				
            </div>

			<?php
		}

		return ob_get_clean();
	}
}


vc_map( array(
	"base" 			    => "icw_location_box",
	"name" 			    => __( 'Location Box', 'ICWTHEME' ),
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
			"heading" 		=> 	__( 'Address', 'ICWTHEME' ),
			"param_name" 	=> 	"address",
			"group" 		=> 'General',
			'admin_label' => true
		),
		array(
		"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Phone', 'ICWTHEME' ),
			"param_name" 	=> 	"phone",
			"group" 		=> 'General',
			'admin_label' => true
		),
		array(
	   	"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'E-mail', 'ICWTHEME' ),
			"param_name" 	=> 	"email",
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
