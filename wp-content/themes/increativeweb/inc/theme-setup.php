<?php
if(!defined('ABSPATH')) exit; // Exit if accessed directly

/*-----------------------------------------------------------------------------------*/
/* icw_register_sidebar  | InCreativeWeb
/*-----------------------------------------------------------------------------------*/
function icw_widgets_init() {
    register_sidebar( array(
      'name' => esc_html__( 'Aside Bar', 'ICWTHEME' ),
      'id' => 'aside-bar',
      'description' => esc_html__( 'Add widgets here.', 'ICWTHEME' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h6 class="widget-title">',
      'after_title' => '</h6>',
    ) );
  
    register_sidebar( array(
      'name' => esc_html__( 'Sidebar', 'ICWTHEME' ),
      'id' => 'sidebar-1',
      'description' => esc_html__( 'Add widgets here.', 'ICWTHEME' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h6 class="widget-title">',
      'after_title' => '</h6>',
    ) );
  
    register_sidebar( array(
      'name' => esc_html__( 'Footer Info', 'ICWTHEME' ),
      'id' => 'footer-widget-1',
      'before_widget' => '<div class="widget footer-widget">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="widget-title">',
      'after_title' => '</h3>',
    ) );
  
    register_sidebar( array(
      'name' => esc_html__( 'Footer Contact', 'ICWTHEME' ),
      'id' => 'footer-widget-2',
      'before_widget' => '<div class="widget footer-widget">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="widget-title">',
      'after_title' => '</h3>',
    ) );
  
  }
add_action( 'widgets_init', 'icw_widgets_init' );


/*-------------------------------------------*
* icwTheme Setup | InCreativeWeb
*------------------------------------------*/
if(!function_exists('icwtheme_setup')):
	function icwtheme_setup() {
		// load textdomain
    load_theme_textdomain( 'ICWTHEME', get_template_directory() . '/languages' );

    // Add Wordpress Feature Support
    add_theme_support( 'menus' );
    add_theme_support( 'post-thumbnails' );
    // add_theme_support( 'html5' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );

		// add_image_size( 'header-slide', 1500, 500, true );
    add_image_size( 'icw-post-thumb-small', 370, 198, true );
    add_image_size( 'icw-post-thumb', 930, 500, true );

        
		//add_theme_support( 'post-formats', array( 'aside','audio','chat','gallery','image','link','quote','status','video' ) );
		//add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );
		//add_theme_support( 'automatic-feed-links' );
        // add_theme_support( 'html5', array('search-form','comment-form','comment-list','gallery','caption',) );

		 // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'header'    => esc_html__( 'Main menu',  'ICWTHEME' ),
        'services'  => esc_html__( 'Services Menu', 'ICWTHEME' ),
        'footer'    => esc_html__( 'Footer Menu', 'ICWTHEME' ),
    ));

		// Apply filter do_shortcode
    add_filter('widget_text', 'do_shortcode');
		add_filter('widget_content', 'do_shortcode');

		add_editor_style('');
		if ( ! isset( $content_width ) )
		$content_width = 900;
	}
	add_action('after_setup_theme','icwtheme_setup');
endif;


function icw_content_width() {
// This variable is intended to be overruled from themes.
// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
$GLOBALS[ 'content_width' ] = apply_filters( 'icw_content_width', 640 );
}
add_action( 'after_setup_theme', 'icw_content_width', 0 );


function icw_favicon() { ?>
<link rel="shortcut icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/favicon/favicon.ico">
<link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/favicon/favicon-16x16.png">
<link rel="manifest" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/favicon/site.webmanifest">
<link rel="mask-icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
<meta name="apple-mobile-web-app-title" content="InCreativeWeb"><meta name="application-name" content="InCreativeWeb"><meta name="msapplication-TileColor" content="#da532c"><meta name="theme-color" content="#308FCE"><?php }
add_action( 'wp_head', 'icw_favicon' );