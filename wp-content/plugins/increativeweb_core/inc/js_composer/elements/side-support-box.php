<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WPBakeryShortCode_icw_side_support_box extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'title'		=> '',
			'description'		=> '',
			'link_label'		=> '',
			'link_url'		=> '',
			'animate_block'			=> 'no',
			'animation_type'		=> '',
			'animation_delay'		=> '',
		), $atts ) );
		

		ob_start();

		$wrapper_class = '';
		if( $animate_block == 'yes' ) {
			$wrapper_class = 'wow ' . $animation_type;
		}
		 {
			?>
            <aside class="side-support-box <?php echo esc_attr( $wrapper_class ); ?>" <?php if ( $animate_block == 'yes' && $animation_delay != '' ) {
				echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"';
			} ?>>
				
				
				
					 <i class="fas fa-file-pdf"></i>
            <h5><?php echo esc_html( $title ); ?></h5>
				<p><?php echo esc_html( $description ); ?></p>
            <a href="<?php echo esc_attr( $link_url ); ?>"><?php echo esc_html( $link_label ); ?></a>
				
				
				
	
				
            </aside>

			<?php
		}

		return ob_get_clean();
	}
}


vc_map( array(
	"base" 			    => "icw_side_support_box",
	"name" 			    => __( 'Side Support Box', 'ICWTHEME' ),
	"content_element"   => true,
	"icon"              => ICW_CORE_URI . "assets/img/icw.png",
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
			"heading" 		=> 	__( 'Description', 'ICWTHEME' ),
			"param_name" 	=> 	"description",
			"group" 		=> 'General',
			'admin_label' => true
		),
		array(
		"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Link Label', 'ICWTHEME' ),
			"param_name" 	=> 	"link_label",
			"group" 		=> 'General',
		),
		array(
	   	"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Link URL', 'ICWTHEME' ),
			"param_name" 	=> 	"link_url",
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
