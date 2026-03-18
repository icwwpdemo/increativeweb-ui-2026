<?php
/*
Plugin Name: InCreativeWeb Core
Plugin URI: https://increativeweb.com
Description: InCreativeWeb Core
Author: Jayesh Patel
Version: 1.1.0
Author URI: https://increativeweb.com
*/

define( "ICW_CORE_PATH", plugin_dir_path( __FILE__ ) );
define( "ICW_CORE_URI", plugins_url( 'increativeweb_core/'  ) );
define( "PAGE_BUILDER_GROUP", __( 'MY-ICW', 'ICWTHEME' ) );

add_action( 'vc_before_init', 'ICWTHEME_vc_addons' );
/**
* JS Composer Elements
*/

function ICWTHEME_vc_addons() {
	require_once ICW_CORE_PATH . '/inc/js_composer/elements/header.php';
	require_once ICW_CORE_PATH . '/inc/js_composer/elements/section-title.php';
	require_once ICW_CORE_PATH . '/inc/js_composer/elements/icon-box.php';
	require_once ICW_CORE_PATH . '/inc/js_composer/elements/image-box-carousel.php';
	require_once ICW_CORE_PATH . '/inc/js_composer/elements/cta-box.php';
	require_once ICW_CORE_PATH . '/inc/js_composer/elements/text-box.php';
	require_once ICW_CORE_PATH . '/inc/js_composer/elements/video-box.php';
	require_once ICW_CORE_PATH . '/inc/js_composer/elements/counter-box.php';
	require_once ICW_CORE_PATH . '/inc/js_composer/elements/price-box.php';
	require_once ICW_CORE_PATH . '/inc/js_composer/elements/recent-cases.php';
	require_once ICW_CORE_PATH . '/inc/js_composer/elements/image.php';
	require_once ICW_CORE_PATH . '/inc/js_composer/elements/testimonials-slider.php';
	require_once ICW_CORE_PATH . '/inc/js_composer/elements/logo-item.php';
	require_once ICW_CORE_PATH . '/inc/js_composer/elements/logos.php';
	require_once ICW_CORE_PATH . '/inc/js_composer/elements/our-clients-slider.php';
	require_once ICW_CORE_PATH . '/inc/js_composer/elements/recent-news.php';
	require_once ICW_CORE_PATH . '/inc/js_composer/elements/contact-box.php';
	require_once ICW_CORE_PATH . '/inc/js_composer/elements/google-maps.php';
	require_once ICW_CORE_PATH . '/inc/js_composer/elements/side-content.php';
	require_once ICW_CORE_PATH . '/inc/js_composer/elements/card-info.php';
	require_once ICW_CORE_PATH . '/inc/js_composer/elements/steps-slider.php';
	require_once ICW_CORE_PATH . '/inc/js_composer/elements/accordion-box.php';
	require_once ICW_CORE_PATH . '/inc/js_composer/elements/office-slider.php';
	require_once ICW_CORE_PATH . '/inc/js_composer/elements/tab-content.php';
	require_once ICW_CORE_PATH . '/inc/js_composer/elements/case-studies.php';
	require_once ICW_CORE_PATH . '/inc/js_composer/elements/case-cta-box.php';
	require_once ICW_CORE_PATH . '/inc/js_composer/elements/photo-gallery.php';
	require_once ICW_CORE_PATH . '/inc/js_composer/elements/job-slider.php';
}

require_once ICW_CORE_PATH . '/inc/js_composer/vc_extra_params.php';

/**
 * Include advanced custom field
 */
// 1. customize ACF path
add_filter('acf/settings/path', 'ICWTHEME_acf_settings_path');

function ICWTHEME_acf_settings_path( $path ) {
	$path = ICW_CORE_PATH . '/inc/acf/';

	return $path;
}


// 2. customize ACF dir
add_filter('acf/settings/dir', 'ICWTHEME_acf_settings_dir');

function ICWTHEME_acf_settings_dir( $dir ) {
	$dir = ICW_CORE_URI . '/inc/acf/';

	return $dir;
}

//Hide ACF field group menu item
add_filter('acf/settings/show_admin', '__return_false');
require ICW_CORE_PATH .  '/inc/acf/acf.php';

require_once ICW_CORE_PATH . '/inc/theme-options.php';

require_once ICW_CORE_PATH . '/inc/cpt-taxonomy.php';


function icw_animations(){

    return array(
	    'bounce' => 'bounce',
	    'flash' => 'flash',
	    'pulse' => 'pulse',
	    'rubberBand' => 'rubberBand',
	    'shake' => 'shake',
	    'headShake' => 'headShake',
	    'swing' => 'swing',
	    'tada' => 'tada',
	    'wobble' => 'wobble',
	    'jello' => 'jello',
	    'bounceIn' => 'bounceIn',
	    'bounceInDown' => 'bounceInDown',
	    'bounceInLeft' => 'bounceInLeft',
	    'bounceInRight' => 'bounceInRight',
	    'bounceInUp' => 'bounceInUp',
	    'bounceOut' => 'bounceOut',
	    'bounceOutDown' => 'bounceOutDown',
	    'bounceOutLeft' => 'bounceOutLeft',
	    'bounceOutRight' => 'bounceOutRight',
	    'bounceOutUp' => 'bounceOutUp',
	    'fadeIn' => 'fadeIn',
	    'fadeInDown' => 'fadeInDown',
	    'fadeInDownBig' => 'fadeInDownBig',
	    'fadeInLeft' => 'fadeInLeft',
	    'fadeInLeftBig' => 'fadeInLeftBig',
	    'fadeInRight' => 'fadeInRight',
	    'fadeInRightBig' => 'fadeInRightBig',
	    'fadeInUp' => 'fadeInUp',
	    'fadeInUpBig' => 'fadeInUpBig',
	    'fadeOut' => 'fadeOut',
	    'fadeOutDown' => 'fadeOutDown',
	    'fadeOutDownBig' => 'fadeOutDownBig',
	    'fadeOutLeft' => 'fadeOutLeft',
	    'fadeOutLeftBig' => 'fadeOutLeftBig',
	    'fadeOutRight' => 'fadeOutRight',
	    'fadeOutRightBig' => 'fadeOutRightBig',
	    'fadeOutUp' => 'fadeOutUp',
	    'fadeOutUpBig' => 'fadeOutUpBig',
	    'flipInX' => 'flipInX',
	    'flipInY' => 'flipInY',
	    'flipOutX' => 'flipOutX',
	    'flipOutY' => 'flipOutY',
	    'lightSpeedIn' => 'lightSpeedIn',
	    'lightSpeedOut' => 'lightSpeedOut',
	    'rotateIn' => 'rotateIn',
	    'rotateInDownLeft' => 'rotateInDownLeft',
	    'rotateInDownRight' => 'rotateInDownRight',
	    'rotateInUpLeft' => 'rotateInUpLeft',
	    'rotateInUpRight' => 'rotateInUpRight',
	    'rotateOut' => 'rotateOut',
	    'rotateOutDownLeft' => 'rotateOutDownLeft',
	    'rotateOutDownRight' => 'rotateOutDownRight',
	    'rotateOutUpLeft' => 'rotateOutUpLeft',
	    'rotateOutUpRight' => 'rotateOutUpRight',
	    'hinge' => 'hinge',
	    'jackInTheBox' => 'jackInTheBox',
	    'rollIn' => 'rollIn',
	    'rollOut' => 'rollOut',
	    'zoomIn' => 'zoomIn',
	    'zoomInDown' => 'zoomInDown',
        'zoomInLeft' => 'zoomInLeft',
        'zoomInRight' => 'zoomInRight',
        'zoomInUp' => 'zoomInUp',
        'zoomOut' => 'zoomOut',
        'zoomOutDown' => 'zoomOutDown',
        'zoomOutLeft' => 'zoomOutLeft',
        'zoomOutRight' => 'zoomOutRight',
        'zoomOutUp' => 'zoomOutUp',
        'slideInDown' => 'slideInDown',
        'slideInLeft' => 'slideInLeft',
        'slideInRight' => 'slideInRight',
        'slideInUp' => 'slideInUp',
        'slideOutDown' => 'slideOutDown',
        'slideOutLeft' => 'slideOutLeft',
        'slideOutRight' => 'slideOutRight',
        'slideOutUp' => 'slideOutUp',
        'heartBeat' => 'heartBeat'
    );
}


function icw_get_hero_slider() {
	$args = array (
		'post_type'			=> 'hero',
		'posts_per_page'	=> -1,
	);
	$sliders = get_posts( $args );

	$_slider = array();

	if( count( $sliders ) ) {
		foreach( $sliders as $slider ) {
			$_slider[ $slider->ID . ' ' . $slider->post_title ] = $slider->ID;
		}
	}

	return $_slider;
}


// default options
function icw_after_import(){

	update_field('enable_page_transition', 1, 'option');
	update_field('enable_search', 1, 'option');
	update_field('enable_navbar_button', 1, 'option');	
	update_field( 'archive_show_sidebar', 'yes', 'option' );

	$custom_menu = array(
		array(
			'label'		=> esc_html__( 'Ru', 'icw' ),
			'url'		=> '#',
		),
		array(
			'label'		=> esc_html__( 'En', 'icw' ),
			'url'		=> '#',
		),
	);
	
	update_field( 'custom_menu', $custom_menu, 'option' );	
	update_field( 'navbar_button_icon', wp_kses_post( "<i class='lni lni-mobile'></i>" ), 'option' );
	update_field( 'navbar_button_label', esc_html( "SALES SPECIALIST" ), 'option' );
	update_field( 'navbar_button_url', esc_url( "#" ), 'option' );
	update_field( 'header_yellow_box', wp_kses_post( "<b>27</b> <small>YEARS OF EXPERIENCE</small>" ), 'option' );

}



// After VC Init
add_action( 'vc_after_init', 'icw_vc_after_init_actions' );
function icw_vc_after_init_actions() {
    // Remove VC Elements
    if( function_exists('vc_remove_element') ){ 
        // vc_remove_element( 'vc_btn' );
        // Remove VC Element
        vc_remove_element( 'vc_facebook' );
        vc_remove_element( 'vc_tweetmeme' );
        vc_remove_element( 'vc_pinterest' );
        vc_remove_element( 'vc_message' );
        // vc_remove_element( 'vc_images_carousel' );
        // vc_remove_element( 'vc_custom_heading' );
        // vc_remove_element( 'vc_posts_slider' );
        vc_remove_element( 'vc_flickr' );
        vc_remove_element( 'vc_progress_bar' );
        vc_remove_element( 'vc_pie' );
        vc_remove_element( 'vc_round_chart' );
        vc_remove_element( 'vc_line_chart' );
        vc_remove_element( 'vc_masonry_media_grid' );
        vc_remove_element( 'vc_masonry_grid' );
        vc_remove_element( 'vc_basic_grid' );
        vc_remove_element( 'vc_media_grid' );
        // vc_remove_element( 'vc_cta' );
        vc_remove_element( 'vc_tta_tour' );

        vc_remove_element( 'vc_wp_search' );
        vc_remove_element( 'vc_wp_meta' );
        vc_remove_element( 'vc_wp_recentcomments' );
        vc_remove_element( 'vc_wp_calendar' );
        vc_remove_element( 'vc_wp_tagcloud' );
        vc_remove_element( 'vc_wp_rss' );

        vc_remove_element( 'vc_googleplus' );
        vc_remove_element( 'vc_tabs' );
        vc_remove_element( 'vc_tour' );
        vc_remove_element( 'vc_accordion' );
    }
}