<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WPBakeryShortCode_icw_counter extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'char'			        => '',
			'value' 			    => '',
			'title' 				=> '',
			'animate_block'			=> 'false',
		), $atts ) );
		
		ob_start();

		$wrapper_class = array();
		if( $animate_block == 'yes' ) {
			$wrapper_class[] = 'wow';
			$wrapper_class[] = 'fadeIn';
		}
		$wrapper_class = implode( ' ', $wrapper_class );
		?>

	  	<div class="counter">
 			<?php if( $title != '' ) { ?>
			<h6><?php echo esc_html( $title ); ?></h6>
		 <?php } ?>
			<?php if( $value != '' ) { ?>
          		<span class="odometer" data-count="<?php echo esc_attr( $value ); ?>" data-status="yes">0</span>
 	 		<?php } ?>
			<small class="char"><?php echo esc_html( $char ); ?></small>
		</div>

		<?php
		return ob_get_clean();
	}
}


vc_map( array(
	"base" 			    => "icw_counter",
	"name" 			    => __( 'Counter', 'ICWTHEME' ),
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
			"heading" 		=> 	__( 'Value', 'ICWTHEME' ),
			"param_name" 	=> 	"value",
			"group" 		=> 'General',
			'admin_label' => true
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Character', 'ICWTHEME' ),
			"param_name" 	=> 	"char",
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
