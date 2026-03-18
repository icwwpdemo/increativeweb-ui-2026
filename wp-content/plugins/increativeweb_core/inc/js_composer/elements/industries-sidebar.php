<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class WPBakeryShortCode_icw_industries_sidebar extends WPBakeryShortCode {

    protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array(
            
            'animate_block'			=> 'false',
            'animation_type'		=> 'fadeIn',
            'animation_delay'       => ''
        ), $atts ) );

        
        ob_start();

        $args = array (
            'post_type'              => 'industrie',
           
            
        );
        $industrie = new WP_Query( $args );

        $wrapper_class = array();
        if( $animate_block == 'yes' ) {
            $wrapper_class[] = 'wow';
            $wrapper_class[] = $animation_type;
        }

        $wrapper_class = implode( ' ', $wrapper_class );

        if ( $industrie->have_posts() ) :
            ?>
            <aside class="industries-sidebar">
				<div class="inner">
				<h4><?php  echo esc_html__( 'Industries', 'consto' ); ?></h4>
				
            <ul>
                <?php
                while ( $industrie->have_posts() ) :
                    $industrie->the_post();

                   

                    $title = get_the_title();

                    if( get_field( 'listing_title_type' ) == 'custom' && get_field( 'listing_title') ) {
                        $title = get_field( 'listing_title' );
                    }
                    
		
		global $wp_query;

		
                   
                    ?>
				
				  <li>
					  
					 

					  
					
						
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                                            <?php echo wp_kses_post( $title ); ?>
                                        </a>
						
						
						
                           
                           
                      
                    </li>
                <?php
                endwhile;
                ?>
            </ul>
					</div>
				</aside>
        <?php
        endif;

        wp_reset_query();
        return ob_get_clean();
    }
}


vc_map( array(
    "base" 			    => "icw_industries_sidebar",
    "name" 			    => __( "industrie Sidebar", "ICWTHEME" ),
    "icon"              => ICW_CORE_URI . "assets/img/icw.png",
    "content_element"   => true,
    "category" 		    => PAGE_BUILDER_GROUP,
    'params' => array(
        
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
