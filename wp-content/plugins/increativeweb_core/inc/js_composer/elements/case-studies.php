<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class WPBakeryShortCode_icw_case_studies extends WPBakeryShortCode {

    protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array(
            'total_count'		    => 4,
            'show_tags'			    => 'yes',
            'animate_block'			=> 'false',
            'animation_type'		=> 'fadeIn',
            'animation_delay'       => ''
        ), $atts ) );

        $total_count = (int) $total_count;
        if( $total_count < 1 ) {
            $total_count = 8;
        }
        ob_start();

        $args = array (
            'post_type'              => 'case',
            'posts_per_page'            => $total_count,
            'meta_query' => array(
                array(
                    'key'       => '_thumbnail_id',
                    'compare'   => 'EXISTS'
                )
            )
        );
        $case = new WP_Query( $args );

        $wrapper_class = array();
        if( $animate_block == 'yes' ) {
            $wrapper_class[] = 'wow';
            $wrapper_class[] = $animation_type;
        }

        $wrapper_class = implode( ' ', $wrapper_class );

        if ( $case->have_posts() ) :
            ?>
            
            <ul class="all-cases">
                <?php
                while ( $case->have_posts() ) :
                    $case->the_post();

                    $thumbnail_image = get_the_post_thumbnail_url( get_the_ID() );

                    $title = get_the_title();

                    if( get_field( 'listing_title_type' ) == 'custom' && get_field( 'listing_title') ) {
                        $title = get_field( 'listing_title' );
                    }
		
		$description = get_field( 'description' );
		
                    $terms = '';
                    if( $show_tags == 'yes' ) {
                        $_terms = wp_get_post_terms($case->post->ID, 'case_tag');
                        if( $_terms ) {
                            $terms = implode(', ', array_column($_terms, 'name'));
                        }
                    }
                    ?>
                    <li>
						<div class="cases">
						<figure> <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( $thumbnail_image ); ?>" alt="<?php the_title_attribute(); ?>"></a>
          <figcaption> <a href="<?php the_permalink(); ?>">
              <h6><?php echo wp_kses_post( $title ); ?></h6>
              <p><?php echo wp_kses_post( $description ); ?></p>
				<small><?php echo wp_kses_post( $terms ); ?></small>
				
            
              </a> </figcaption>
        </figure>
							</div>
						<!-- end cases -->
						
						
						
						
						
						
						
                           
                           
                      
                    </li>
                <?php
                endwhile;
                ?>
            </ul>
        <?php
        endif;

        wp_reset_query();
        return ob_get_clean();
    }
}


vc_map( array(
    "base" 			    => "icw_case_studies",
    "name" 			    => __( "Case Studies", "ICWTHEME" ),
    "icon"              => ICW_CORE_URI . "assets/img/icw.png",
    "content_element"   => true,
    "category" 		    => PAGE_BUILDER_GROUP,
    'params' => array(
        array(
            "type" 			=> "textfield",
            "heading" 		=> __( 'Total Count', 'ICWTHEME' ),
            "param_name" 	=> "total_count",
            "value"         => 6,
            "description"	=> "Total number of case items that will be shown.",
            "group" 		=> 'General',
            'admin_label' => true
        ),
        array(
            "type" 			=> 	"dropdown",
            "heading" 		=> 	__( 'Show Tags', 'ICWTHEME' ),
            "param_name" 	=> 	"show_tags",
            "group" 		=> 'General',
            "value"			=>	array(
                "Yes"			=>		'yes',
                "No"			=>		'no',
            )
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
