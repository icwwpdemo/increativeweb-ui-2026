<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WPBakeryShortCode_icw_portfolio_text_content extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'block_type'   			=> 'normal',
			'has_readmore'   	    => 'no',
			'readmore_label'   		=> 'Learn More',
			'readmore_link'   		=> '',
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



<div class="works-content <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?>>
		  <?php echo wpb_js_remove_wpautop( $content, true ); ?>
	
	
	<?php
            if( $has_readmore == 'yes' ) { ?>
                <div class="custom-link <?php echo esc_attr( $wrapper_class ); ?>">
                    <a href="<?php echo esc_url( $readmore_link ); ?>" data-text="<?php echo esc_attr( $readmore_label ); ?>">
                        <?php echo esc_html( $readmore_label ); ?>
                    </a>
                </div>
            <?php
            }
            ?>
	
	
		  </div>

		<?php

		return ob_get_clean();
	}
}


vc_map( array(
	"base" 			    => "icw_portfolio_text_content",
	"name" 			    => __( 'Portfolio Text Content', 'ICWTHEME' ),
	"icon"              => ICW_CORE_URI . "assets/img/icw.png",
	"content_element"   => true,
	"category" 		    => PAGE_BUILDER_GROUP,
	'params' => array(
		array(
			"type" 			=> 	"textarea_html",
			"heading" 		=> 	__( 'Text', 'ICWTHEME' ),
			"param_name" 	=> 	"content",
			"group" 		=> 'General',
		),
		array(
			"type" 			=> 	"dropdown",
			"heading" 		=> 	__( 'URL', 'ICWTHEME' ),
			"param_name" 	=> 	"has_readmore",
			"group" 		=> 'General',
			"value"			=>	array(
				"No"		=> 'no',
				"Yes"		=> 'yes',
			)
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Read More Label', 'ICWTHEME' ),
			"param_name" 	=> 	"readmore_label",
			"dependency"    => array('element' => "has_readmore", 'value' => 'yes'),
			"value"         => __( 'Visit Case', 'ICWTHEME' ),
			"group" 		=> 'General',
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'URL', 'ICWTHEME' ),
			"param_name" 	=> 	"readmore_link",
			"dependency"    => array('element' => "has_readmore", 'value' => 'yes'),
			"group" 		=> 'General',
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
