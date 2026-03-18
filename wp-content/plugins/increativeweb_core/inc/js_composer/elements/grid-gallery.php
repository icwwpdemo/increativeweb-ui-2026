<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WPBakeryShortCode_icw_grid_gallery extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'image1'		            => '',
			'tagline1'   			    => '',
			'title1'   			    => '',
			
			'image2'		            => '',
			'tagline2'   			    => '',
			'title2'   			    => '',
			
			'image3'		            => '',
			'tagline3'   			    => '',
			'title3'   			    => '',

			'animate_block'			=> 'false',
			'animation_type'		=> 'fadeIn',
			'animation_delay'		=> '',
		), $atts ) );

		$wrapper_class = array();

		$image_url1 = '';
		if ( $image1 != '') {
			$image_url1 = wp_get_attachment_url( $image1 );
		}

		if( !$image_url1 ) return;
		
		
		$image_url2 = '';
		if ( $image2 != '') {
			$image_url2 = wp_get_attachment_url( $image2 );
		}

		if( !$image_url2 ) return;
		
		$image_url3 = '';
		if ( $image3 != '') {
			$image_url3 = wp_get_attachment_url( $image3 );
		}

		if( !$image_url3 ) return;
		

		if( $animate_block == 'yes' ) {
			$wrapper_class[] = 'wow';
			$wrapper_class[] = $animation_type;
		}

		$wrapper_class = implode( ' ', $wrapper_class );

		ob_start();
		?>

<div class="row no-gutters masonry">
 
        <div class="col-lg-6 masonry-grid">
            <figure class="masonry-gallery reveal-effect masker <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?>>

              
                   
                        <img src="<?php echo esc_url( $image_url1 ); ?>" alt="<?php echo esc_attr( $title1 ); ?>">
                   
                        </a>
                   
                
				
				<figcaption> 
					
					<?php if( $tagline1 != '' ) { ?>
					<small><?php echo esc_html( $tagline1 ); ?></small>
           <?php } ?>
					
					
					
					<?php if( $title1 != '' ) { ?>
			
			<h4><?php echo esc_html( $title1 ); ?></h4>
		 <?php } ?>
					
          </figcaption>
            </figure>

        </div>
<!-- end col-6 -->
<div class="col-lg-6 masonry-grid">
            <figure class="masonry-gallery reveal-effect masker <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?>>

              
                   
                        <img src="<?php echo esc_url( $image_url2 ); ?>" alt="<?php echo esc_attr( $title2 ); ?>">
                   
                        </a>
                   
                
				
				<figcaption> 
					
					<?php if( $tagline2 != '' ) { ?>
					<small><?php echo esc_html( $tagline2 ); ?></small>
           <?php } ?>
					
					
					
					<?php if( $title2 != '' ) { ?>
			
			<h4><?php echo esc_html( $title2 ); ?></h4>
		 <?php } ?>
					
          </figcaption>
            </figure>

        </div>
<!-- end col-6 -->
<div class="col-lg-6 masonry-grid">
            <figure class="masonry-gallery reveal-effect masker <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?>>

              
                   
                        <img src="<?php echo esc_url( $image_url3 ); ?>" alt="<?php echo esc_attr( $title3 ); ?>">
                   
                        </a>
                   
                
				
				<figcaption> 
					
					<?php if( $tagline3 != '' ) { ?>
					<small><?php echo esc_html( $tagline3 ); ?></small>
           <?php } ?>
					
					
					
					<?php if( $title3 != '' ) { ?>
			
			<h4><?php echo esc_html( $title3 ); ?></h4>
		 <?php } ?>
					
          </figcaption>
            </figure>

        </div>
<!-- end col-6 -->


</div>
<!-- end row -->

		<?php

		return ob_get_clean();
	}
}


vc_map( array(
	"base" 			    => "icw_grid_gallery",
	"name" 			    => __( 'Grid Gallery', 'ICWTHEME' ),
	"icon"              => ICW_CORE_URI . "assets/img/icw.png",
	"content_element"   => true,
	"category" 		    => PAGE_BUILDER_GROUP,
	'params' => array(
		array(
			"type" 			=> 	"attach_image",
			"heading" 		=> 	__( 'Image', 'ICWTHEME' ),
			"param_name" 	=> 	"image1",
			"group" 		=> "Image 01",
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Tagline', 'ICWTHEME' ),
			"param_name" 	=> 	"tagline1",
			"group" 		=> 'Image 01',
			'admin_label' => true
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Title', 'ICWTHEME' ),
			"param_name" 	=> 	"title1",
			"group" 		=> 'Image 01',
			'admin_label' => true
		),
		
		array(
			"type" 			=> 	"attach_image",
			"heading" 		=> 	__( 'Image', 'ICWTHEME' ),
			"param_name" 	=> 	"image2",
			"group" 		=> "Image 02",
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Tagline', 'ICWTHEME' ),
			"param_name" 	=> 	"tagline2",
			"group" 		=> 'Image 02',
			'admin_label' => true
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Title', 'ICWTHEME' ),
			"param_name" 	=> 	"title2",
			"group" 		=> 'Image 02',
		),
		
		array(
			"type" 			=> 	"attach_image",
			"heading" 		=> 	__( 'Image', 'ICWTHEME' ),
			"param_name" 	=> 	"image3",
			"group" 		=> "Image 03",
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Tagline', 'ICWTHEME' ),
			"param_name" 	=> 	"tagline3",
			"group" 		=> 'Image 03',
			'admin_label' => true
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Title', 'ICWTHEME' ),
			"param_name" 	=> 	"title3",
			"group" 		=> 'Image 03',
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
