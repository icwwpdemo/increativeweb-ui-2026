<?php
if(!defined('ABSPATH')) exit; // Exit if accessed directly

if ( !function_exists( 'icw_google_fonts_url' ) ) {
  /*
   * Register Google Font Family
   */
  function icw_google_fonts_url() {
    $fonts_url = '';
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    $fjalla_one = _x( 'on', 'Fjalla One: on or off', 'ICWTHEME' );
    $poppins = _x( 'on', 'Poppins font: on or off', 'ICWTHEME' );
    $dancing_script = _x( 'on', 'Dancing Script: on or off', 'ICWTHEME' );

    if ( 'off' !== $fjalla_one || 'off' !== $poppins || 'off' !== $dancing_script ) {

      $font_families = array();

      if ( 'off' !== $fjalla_one ) {
        $font_families[] = 'Fjalla One';
      }

      if ( 'off' !== $dancing_script ) {
        $font_families[] = 'Dancing Script';
      }

      if ( 'off' !== $poppins ) {
        $font_families[] = 'Poppins:400,600,800';
      }

      $f_query_args = array(
        'family' => urlencode( implode( '|', $font_families ) ),
        'subset' => urlencode( 'latin-ext' ),
      );
      $fonts_url = add_query_arg( $f_query_args, '//fonts.googleapis.com/css' );

    }

    return esc_url_raw( $fonts_url );
  }

}

if ( !function_exists( 'icw_enqueue_styles_and_scripts' ) ) {
  /**
   * This function enqueues the required css and js files.
   *
   * @return void
   */
  function icw_enqueue_styles_and_scripts() {
    /**
     * Enqueue css files.
     */
    wp_enqueue_style( 'lineicons', get_template_directory_uri() . '/css/lineicons.css' );
    // wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/css/fancybox.min.css' );
    // wp_enqueue_style( 'swiper', get_template_directory_uri() . '/css/swiper.min.css' );
    // wp_enqueue_style( 'odometer', get_template_directory_uri() . '/css/odometer.min.css' );
    // wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
    wp_enqueue_style( 'icw-main', get_template_directory_uri() . '/css/main.css' );
    // wp_enqueue_style( 'icw-stylesheet', get_stylesheet_uri() );
    // wp_add_inline_style( 'icw-stylesheet', icw_dynamic_css() );

    /**
     * Enqueue javascript files.
     */
    wp_enqueue_script( 'icw-lozad', get_template_directory_uri() . '/js/lozad.min.js', array(), false, true );
    wp_enqueue_script( 'all-jquery', get_template_directory_uri() . '/js/all-jquery.js', array(), false, true );
    // wp_enqueue_script( 'comments', get_template_directory_uri() . '/js/comments.js', array(), false, false );
    // wp_enqueue_script( 'TweenMax', get_template_directory_uri() . '/js/TweenMax.min.js',array(), false, true);
    // wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), false, true );
    // wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/js/fancybox.min.js', array( 'jquery' ), false, true );
    // wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/isotope.min.js', array( 'jquery' ), false, true );
    // wp_enqueue_script( 'odometer', get_template_directory_uri() . '/js/odometer.min.js', array( 'jquery' ), false, true );
    // wp_enqueue_script( 'swiper', get_template_directory_uri() . '/js/swiper-bundle.min.js', array( 'jquery' ), false, true );
    // wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array( 'jquery' ), false, true );
    // wp_enqueue_script( 'stellar', get_template_directory_uri() . '/js/jquery.stellar.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'icw-main', get_template_directory_uri() . '/js/main.min.js', array( 'jquery' ), false, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }

    $data = array(
      'pre_loader_typewriter' => [],
      'audio_source' => '',
      'enable_sound_bar' => false
    );

    if ( icw_get_option( 'enable_preloader' ) ) {
      $typewriter_text = [];
      $text_rotater = icw_get_option( 'pre_loader_text_rotater' );
      if ( $text_rotater ) {
        foreach ( $text_rotater as $rotater ) {
          $typewriter_text[] = esc_html( $rotater[ 'title' ] );
        }
      }
      $data[ 'pre_loader_typewriter' ] = $typewriter_text;
    }


    $comment_data = array(
      'name' => esc_html__( 'Name is required', 'ICWTHEME' ),
      'email' => esc_html__( 'Email is required', 'ICWTHEME' ),
      'comment' => esc_html__( 'Comment is required', 'ICWTHEME' ),

    );

    wp_localize_script( 'icw-main', 'data', $data );
    wp_localize_script( 'comments', 'comment_data', $comment_data );
  }

  add_action( 'wp_enqueue_scripts', 'icw_enqueue_styles_and_scripts', 10 );
}

if ( !function_exists( 'icw_dynamic_css' ) ) {
  function icw_dynamic_css() {

    $styles = '';
    /*if ( icw_get_option( 'logo_height' ) ) {
      $logo_height = str_replace( ' ', '', icw_get_option( 'logo_height' ) );
      $logo_height = str_replace( 'px', '', $logo_height );
      $styles .= "
				body .navbar > .logo img{
					height: {$logo_height}px;
				}
			";
    }*/
    if ( icw_get_option( 'pageheader_height' ) ) {
      $pageheader_height = str_replace( ' ', '', icw_get_option( 'pageheader_height' ) );
      $styles .= "
				.page-header{
					height: {$pageheader_height};
				}
			";
    }
    if ( icw_get_option( 'enable_dynamic_color' ) ) {

      $site_color = ( icw_get_option( 'theme_color' ) ) ? icw_get_option( 'theme_color' ) : '#33a16e';
      $body_bg_color = ( icw_get_option( 'body_background_color' ) ) ? icw_get_option( 'body_background_color' ) : '#131314';

      $styles .= "
				main{
					background: {$body_bg_color} !important;
				}
				.sidebar .widget .widget-title:after,
				.custom-button,
				.first-transition,
				.page-transition,
				.navbar .custom-menu ul li a:after,
				.navbar .custom-menu ul li a:hover:before,
				.navbar .site-menu ul li ul,
				.navbar .site-menu ul li a:after,
				.navbar .site-menu ul li a:hover:before,
				.navbar .navbar-button,
				.slider .slider-content .inner a,
				.slider .slider-content .controls .button-prev:hover,
				.slider .slider-content .controls .button-next:hover,
				.slider .slider-main .header-box,
				.section-title h6:before,
				.icon-content:before,
				.icon-content:hover,
				.side-content u:before,
				.counter-box h6:before,
				.contact-box h6:before,
				.isotope-filter li:before,
				.projects li .project-box:hover figcaption,
				.project-slider .swiper-slide .project-box figcaption,
				.sector-box:hover,
				.calculator-form .price-box,
				.step-box .content h6:before,
				.cta-box-yellow,
				.services-list-box .button:hover,
				.custom-list li:hover:before,
				.our-history .swiper-pagination-progressbar-fill,
				.our-history .swiper-slide:hover b:after,
				.our-history .controls .button-prev:hover,
				.our-history .controls .button-next:hover,
				.core-values-box h6:before,
				.director-team h6:before,
				.sales-team:hover,
				.tab-left ul li a:before,
				.video-box .play-btn:hover,
				.testimonials-slider .controls .button-prev,
				.testimonials-slider .controls .button-next,
				.testimonials-slider .testimonial i,
				.recent-news-box figure,
				.recent-news-box .content,
				.blog-post .post-content .post-date,
				.blog-post .post-content blockquote,
				.footer-bar .button,
				.footer-bar .sales-representive b:before,
				.footer .scroll-top,
				.sidebar .widget .widget-title:after,
				.range-slider__value,
				.footer form input[type=submit],
				.calculator-form input[type=checkbox]:checked + .custom-checkbox,
				input[type=submit], input[type=button], button[type=button], button[type=submit],
				.search-box .inner form input[type=submit],
				.yes-no .switch span,
				.yes-no #no:checked ~ .switch
				{
					background-color: {$site_color} !important;
				}
				
				.side-widget .widget-title,
				.side-widget .site-menu ul li a,
				.page-header .container ul li,
				.tab-left ul li a:hover,
				.footer .mc4wp-response,
				.footer .mc4wp-response a,
				.footer-bar .sales-representive b
				{
				  color: {$site_color} !important;
				}
				
				
				.accordion .card .card-header a:hover,
				.accordion .card [aria-expanded=true],
				.icon-content:hover,
				.calculator-form input[type=checkbox]:checked + .custom-checkbox,
				.video-box .play-btn:hover,
				.blog-post .post-content .post-tags li a,
				.blog-post .post-content .post-categories li a:hover,
				.footer .custom-link
				{
				  border-color: {$site_color} !important;
				}
				
				
			";
    }

    return $styles;
  }
}


// add_action( 'init', 'icw_dynamic_css' );
add_action(
  'after_setup_theme',
  function () {
    add_theme_support( 'html5', [ 'script', 'style' ] );
  }
);