<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class WPBakeryShortCode_icw_project extends WPBakeryShortCode {

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
            'post_type'              => 'project',
            'posts_per_page'            => $total_count,
            'meta_query' => array(
                array(
                    'key'       => '_thumbnail_id',
                    'compare'   => 'EXISTS'
                )
            )
        );
        $project = new WP_Query( $args );

        $wrapper_class = array();
        if( $animate_block == 'yes' ) {
            $wrapper_class[] = 'wow';
            $wrapper_class[] = $animation_type;
        }

        $wrapper_class = implode( ' ', $wrapper_class );

        if ( $project->have_posts() ) :
            ?>
            
            <ul class="projects">
                <?php
                while ( $project->have_posts() ) :
                    $project->the_post();

                    $thumbnail_image = get_the_post_thumbnail_url( get_the_ID() );

                    $title = get_the_title();

                    if( get_field( 'listing_title_type' ) == 'custom' && get_field( 'listing_title') ) {
                        $title = get_field( 'listing_title' );
                    }
                    $terms = '';
                    if( $show_tags == 'yes' ) {
                        $_terms = wp_get_post_terms($project->post->ID, 'project_tag');
                        if( $_terms ) {
                            $terms = implode(', ', array_column($_terms, 'name'));
                        }
                    }
                    ?>
                    <li>
						
						<figure class="project-box"> <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( $thumbnail_image ); ?>" alt="<?php the_title_attribute(); ?>"></a>
          <figcaption>
            <h5><?php echo wp_kses_post( $title ); ?></h5>
          </figcaption>
        </figure>
						
						
						
						
						
						
						
                           
                           
                      
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
    "base" 			    => "icw_project",
    "name" 			    => __( "Projects", "ICWTHEME" ),
    "icon"              => ICW_CORE_URI . "assets/img/icw.png",
    "content_element"   => true,
    "category" 		    => PAGE_BUILDER_GROUP,
    'params' => array(
        array(
            "type" 			=> "textfield",
            "heading" 		=> __( 'Total Count', 'ICWTHEME' ),
            "param_name" 	=> "total_count",
            "value"         => 6,
            "description"	=> "Total number of project items that will be shown.",
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
