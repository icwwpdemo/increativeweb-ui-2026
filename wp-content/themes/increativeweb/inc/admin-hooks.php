<?php
if(!defined('ABSPATH')) exit; // Exit if accessed directly

define('lazyloading', get_template_directory_uri().'/images/loader.svg');

/*-----------------------------------------------------------------------------------*/
/* template-functions.php | InCreativeWeb
/*-----------------------------------------------------------------------------------*/
function icw_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	if( !icw_get_option( 'enable_page_transition' ) ) {
		$classes[] = 'no-transition';
	}
	return $classes;
}
add_filter( 'body_class', 'icw_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function icw_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'icw_pingback_header' );




/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @param string $title Default title text for current view.
 * @param string $sep   Optional separator.
 * @return string Filtered title.
 */
function icw_wpdocs_filter_wp_title( $title, $sep ) {
  global $paged, $page;

  if ( is_feed() )
      return $title;

  // Add the site name.
  $title .= get_bloginfo( 'name' );

  // Add the site description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) )
      $title = "$title $sep $site_description";

  // Add a page number if necessary.
  if ( $paged >= 2 || $page >= 2 )
      $title = "$title $sep " . sprintf( __( 'Page %s', 'ICWTHEMENAME' ), max( $paged, $page ) );

  return $title;
}
add_filter( 'wp_title', 'icw_wpdocs_filter_wp_title', 10, 2 );


/*-----------------------------------------------------------------------------------*/
/* pr code  | InCreativeWeb
/*-----------------------------------------------------------------------------------*/
function pr($data){
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}


/*-----------------------------------------------------------------------------------*/
/*  Disable Gutenberg via Code | InCreativeWeb
/*-----------------------------------------------------------------------------------*/
add_filter('use_block_editor_for_post', '__return_false', 10); // disable for posts 
add_filter('use_block_editor_for_post_type', '__return_false', 10); // disable for post types
add_filter('use_block_editor_for_page', '__return_false', 10); // disable for posts 

// Disables the block editor from managing widgets in the Gutenberg plugin.
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );

// Disables the block editor from managing widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );


add_action('wp_head', 'myoverride', 1);
function myoverride() {
  if ( class_exists( 'Vc_Manager' ) ) {
    remove_action('wp_head', array(visual_composer(), 'addMetaData'));
  }
}

add_filter( 'wpseo_debug_markers', '__return_false' );

/*-----------------------------------------------------------------------------------*/
/*  Change wp_mail_from and wp_mail_from_name WordPress | InCreativeWeb
/*-----------------------------------------------------------------------------------*/
// wp_mail_from
add_filter('wp_mail_from', 'icw_from_mail');
function icw_from_mail($original_email_address) {
    return 'wordpress@increativeweb.com';
}

// wp_mail_from_name
add_filter('wp_mail_from_name', 'icw_from_mail_name');
function icw_from_mail_name($original_email_address_name) {
    return 'InCreativeWeb';
}


/*-----------------------------------------------------------------------------------*/
/*  Disable Admin Bar for All Users Except for Administrators | InCreativeWeb
/*-----------------------------------------------------------------------------------*/
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
		add_filter('show_admin_bar', '__return_false');
		//show_admin_bar(false);
	}
}


/*-----------------------------------------------------------------------------------*/
/*  wordpress redirect after password reset | InCreativeWeb
/*-----------------------------------------------------------------------------------*/
/*function icw_lost_password_redirect() {
  $confirm = ( isset($_GET['action'] ) && $_GET['action'] == 'resetpass' );
  if( $confirm ) {
   return home_url('/my-account/');
       wp_redirect( home_url('/my-account/') );
       exit;
   }
  }
//add_action('login_headerurl', 'icw_lost_password_redirect');
add_filter( 'lostpassword_redirect', 'my_redirect_home' );
function my_redirect_home( $lostpassword_redirect ) {
 return home_url('/my-account/');
}
function icw_after_password_reset_redirect() {
   wp_redirect( home_url('/my-account/') ); 
   exit; // always exit after wp_redirect
}
add_action('after_password_reset', 'icw_after_password_reset_redirect');
*/
/*-----------------------------------------------------------------------------------*/
/*  Function to add Meta Tags in Header without Plugin | InCreativeWeb
/*-----------------------------------------------------------------------------------*/
function add_meta_tags() {
 echo '<link rel="dns-prefetch" href="//www.google-analytics.com"><meta http-equiv="Expires" content="30">';
}
add_action('wp_head', 'add_meta_tags', 2 );


/*-----------------------------------------------------------------------------------*/
/* add SVG to allowed file uploads  | InCreativeWeb
/*-----------------------------------------------------------------------------------*/
function add_file_types_to_uploads($file_types){
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes );
	return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');

/*-----------------------------------------------------------------------------------*/
/* disable author query in WordPress  | InCreativeWeb
/*-----------------------------------------------------------------------------------*/
add_action('template_redirect', 'disableAuthorUrl');
function disableAuthorUrl(){
    if (is_author()) {
       wp_redirect(home_url());
       exit();
    }
}

/*-----------------------------------------------------------------------------------*/
/* Manually Disable Search Feature in WordPress  | InCreativeWeb
/*-----------------------------------------------------------------------------------*/
function wpb_filter_query( $query, $error = true ) {
	if ( is_search() ) {
		$query->is_search = false;
		$query->query_vars['s'] = false;
		$query->query['s'] = false;
	if ( $error == true )
		$query->is_404 = true;
	}
}
if ( !is_user_logged_in() ) {
	add_action( 'parse_query', 'wpb_filter_query' );
  add_filter( 'get_search_form', function($a) {return null;});
}
function remove_search_widget() {
	unregister_widget('WP_Widget_Search');
}
add_action( 'widgets_init', 'remove_search_widget' );

/*-----------------------------------------------------------------------------------*/
/* Admin Logo | InCreativeWeb
/*-----------------------------------------------------------------------------------*/
add_action( 'login_enqueue_scripts', 'icw_login_logo' );
function icw_login_logo() { ?>
<style type="text/css">
body.login { background:#07bafe url('<?php echo get_stylesheet_directory_uri(); ?>/images/wp-pattern.png') no-repeat top right fixed !important; background-size: cover!important; }
body.login div#login { position:absolute; width: 320px !important; background-color: #00339f; left: 50%;top:0;margin: 100px 0px 10px -160px !important; padding: 70px 0px 10px !important; -webkit-box-shadow: 0 8px 17px 0 rgba(0,0,0,.2), 0 6px 20px 0 rgba(0,0,0,.19); box-shadow: 0 8px 17px 0 rgba(0,0,0,.2), 0 6px 20px 0 rgba(0,0,0,.19);}
body.login div#login form { background-color: #fff; margin-top: 0px !important; padding: 20px 24px 25px !important; margin: 0px -15px; border-radius: 5px;    -webkit-box-shadow: 0 5px 11px 0 rgba(0,0,0,.18), 0 4px 15px 0 rgba(0,0,0,.15); box-shadow: 0 5px 11px 0 rgba(0,0,0,.18), 0 4px 15px 0 rgba(0,0,0,.15)}
body.login div#login h1 { position: absolute; left: 0; right: 0; top: 0; -webkit-transform: translateY(-50%); -moz-transform: translateY(-50%); transform: translateY(-50%); z-index: 1; }
body.login div#login h1 a { background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/wp-logo.png'); background-repeat: no-repeat; background-size: cover; width: 120px; height: 120px; background-position: center; position: relative; top: 50%; left: 50%; -webkit-transform: translate(-50%); -moz-transform: translate(-50%); transform: translate(-50%); margin: 0; overflow: visible; display: table; background-color: #ffffff; background-size: 90%; border-radius: 300px; }
body.login div#login form input[type="text"], #login form input[type="password"], #login form input[type="email"] { background: #ffffff; border: 1px solid #e1e1e1; box-shadow: none; color: #adadad; padding: 8px; font-size: 16px; pointer-events: all; }
body.login div#login #wp-submit { width: 100%; margin-top: 16px; padding: 5px; height: auto; border: none; box-shadow: none; border-radius: 25px; -webkit-transition: all 0.3s ease; -moz-transition: all 0.3s ease; transition: all 0.3s ease; background-color: #00339f; font-family: Lato; font-size: 17.6px; color: #ffffff; font-weight: 400; text-shadow: none; }
body.login div#login #wp-submit:hover { background-color:#ffbd33;color: #ffffff; }
body.login div#login #backtoblog a, body.login #nav a {color: #ffffff!important;}
body.login div#login #nav a:hover {color: #9c7708 !important;}
@media(max-width:480px) { body.login div#login { width: 300px !important; margin: 80px 0px 10px -150px !important;}}
</style>
<?php }

//---------------------------------
// CF7  | InCreativeWeb
//---------------------------------

add_filter( 'wpcf7_load_css', '__return_false' );
add_filter( 'wpcf7_load_js', '__return_false' );

remove_action( 'wp_enqueue_scripts','wpcf7_recaptcha_enqueue_scripts', 20 );
add_action('wp_enqueue_scripts', 'enqueue_wpcf7_css_js_as_needed', 10, 2 );
function enqueue_wpcf7_css_js_as_needed () {
  if ( is_page('career') || is_page('contact-us') || is_page('welcome-employee') ) {
      wpcf7_recaptcha_enqueue_scripts();
      wpcf7_enqueue_scripts();
      // wpcf7_enqueue_styles();
  }
}

/*-----------------------------------------------------------------------------------*/
/* Wordpress Disable Comments | InCreativeWeb
/*-----------------------------------------------------------------------------------*/
add_action('admin_init', function () {
  // Redirect any user trying to access comments page
  global $pagenow;
  
  if ($pagenow === 'edit-comments.php') {
      wp_redirect(admin_url());
      exit;
  }

  // Remove comments metabox from dashboard
  remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

  // Disable support for comments and trackbacks in post types
  foreach (get_post_types() as $post_type) {
      if (post_type_supports($post_type, 'comments')) {
          remove_post_type_support($post_type, 'comments');
          remove_post_type_support($post_type, 'trackbacks');
      }
  }
});

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page in menu
add_action('admin_menu', function () {
  remove_menu_page('edit-comments.php');
});

// Remove comments links from admin bar
add_action('init', function () {
  if (is_admin_bar_showing()) {
      remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
  }
});
/*-----------------------------------------------------------------------------------*/
/* End Wordpress Disable Comments | InCreativeWeb
/*-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/* Remove widgets from the WordPress Dashboard | InCreativeWeb
/*-----------------------------------------------------------------------------------*/
function icw_remove_dashboard_meta() {
  remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal'); //Removes the 'incoming links' widget
  remove_meta_box('dashboard_plugins', 'dashboard', 'normal'); //Removes the 'plugins' widget
  remove_meta_box('dashboard_primary', 'dashboard', 'normal'); //Removes the 'WordPress News' widget
  remove_meta_box('dashboard_secondary', 'dashboard', 'normal'); //Removes the secondary widget
  remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); //Removes the 'Quick Draft' widget
  remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side'); //Removes the 'Recent Drafts' widget
  remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); //Removes the 'Activity' widget
  remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); //Removes the 'At a Glance' widget
  remove_meta_box('dashboard_activity', 'dashboard', 'normal'); //Removes the 'Activity' widget (since 3.8)
  remove_action( 'welcome_panel', 'wp_welcome_panel' );
  // remove_meta_box( 'health_check_status', 'dashboard', 'normal' );
}
add_action('admin_init', 'icw_remove_dashboard_meta');


/*-----------------------------------------------------------------------------------*/
/* Remove all default widgets | InCreativeWeb
/*-----------------------------------------------------------------------------------*/
function icw_remove_default_widgets() {
	unregister_widget('WP_Widget_Media_Gallery');
	//unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Calendar');
	// unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Meta');
	// unregister_widget('WP_Widget_Search');
	//unregister_widget('WP_Widget_Text');
	// unregister_widget('WP_Widget_Categories');
	// unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Tag_Cloud');
	//unregister_widget('WP_Nav_Menu_Widget');
	//unregister_widget('Twenty_Eleven_Ephemera_Widget');
	unregister_widget('WP_Widget_Media_Audio');
	//unregister_widget('WP_Widget_Media_Image');
	unregister_widget('WP_Widget_Media_Video');
	//unregister_widget('WP_Widget_Custom_HTML');
}
add_action('widgets_init', 'icw_remove_default_widgets', 11);


function icw_mymodule_curl_before_request($curlhandle){
	session_write_close();
}
add_action( 'requests-curl.before_request','icw_mymodule_curl_before_request', 9999 );