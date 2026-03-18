<?php
if(!defined('ABSPATH')) exit; // Exit if accessed directly

add_filter('nav_menu_css_class', 'icw_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'icw_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'icw_css_attributes_filter', 100, 1);
function icw_css_attributes_filter($var) {
  return is_array($var) ? array_intersect($var, array('current-menu-item','menu-item-has-children', 'dropdown', '--is-mega-menu', '--is-ux', '--is-web', '--is-seo', 'current-page-parent')) : '';
}


// limit search to Posts
function certain_search_only_posts($query){
  if ($query->is_search)
  {
      $query->set('post_type', 'post');
  }
  return $query;
}
// add_filter('pre_get_posts', 'certain_search_only_posts');



/**
 * Post link read more text content.
 */
function icw_post_link() {
    return '<a class="link-more" title="' . get_the_title() . '" href="' . esc_url( get_permalink() ) . '">' . sprintf( esc_html__( 'READ MORE', 'ICWTHEME' ) ) . '</a>';
}
add_filter( 'the_content_more_link', 'icw_post_link' );


if ( !function_exists( 'icw_get_the_post_excerpt' ) ) {
    /**
     * This function makes excerpt for the post.
     *
     * @param integer $limit of charachers
     * @return string
     */
    function icw_get_the_post_excerpt( $string, $limit = 70, $more = '...', $break_words = false ) {
      if ( $limit == 0 ) return '';
  
      if ( mb_strlen( $string, 'utf8' ) > $limit ) {
        $limit -= mb_strlen( $more, 'utf8' );
  
        if ( !$break_words ) {
          $string = preg_replace( '/\s+\S+\s*$/su', '', mb_substr( $string, 0, $limit + 1, 'utf8' ) );
        }
  
        return '<p>' . mb_substr( $string, 0, $limit, 'utf8' ) . $more . '</p>';
      } else {
  
        return '<p>' . $string . '</p>';
      }
    }
  
}

if ( !function_exists( 'icw_posted_date_with_tags' ) ) {

  function icw_posted_date_with_tags() {

    echo sprintf( esc_html__( 'Posted %s', 'ICWTHEME' ), get_the_date( 'j F Y' ) );

    $tags = get_the_tags();
    if ( false !== $tags ) {
      foreach ( $tags as $tag ) {
        $link = get_tag_link( $tag->term_id );
        $data[] = '<a href="' . $link . '">' . $tag->name . '</a>';
      }

      echo ' | ' . implode( ', ', $data );
    }
  }
}

if ( !function_exists( 'icw_move_comment_field_to_bottom' ) ) {
  function icw_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields[ 'comment' ];
    unset( $fields[ 'comment' ] );
    $fields[ 'comment' ] = $comment_field;

    return $fields;
  }

  add_filter( 'comment_form_fields', 'icw_move_comment_field_to_bottom' );
}

if ( !function_exists( 'icw_bootstrap_comment' ) ) {
  /**
   * Custom callback for comment output
   *
   */
  function icw_bootstrap_comment( $comment, $args, $depth ) {
    $GLOBALS[ 'comment' ] = $comment;

    $comment_link_args = array(
      'add_below' => 'comment',
      'respond_id' => 'respond',
      'reply_text' => esc_html__( 'Reply', 'ICWTHEME' ),
      'login_text' => esc_html__( 'Log in to Reply', 'ICWTHEME' ),
      'depth' => 1,
      'before' => '',
      'after' => '',
      'max_depth' => 5
    );
    ?>
<?php if ( $comment->comment_approved == '1' ): ?>
<li class="comment">
  <figure class="comment-avatar"><?php echo get_avatar( $comment ); ?></figure>
  <div class="comment-content">
    <h4>
      <?php comment_author_link() ?>
    </h4>
    <p>
      <?php comment_text() ?>
    </p>
    <small>
    <?php comment_date() ?>
    </small>
    <?php
    comment_reply_link( $comment_link_args );
    ?>
  </div>
</li>
<?php
endif;
}

}

if ( !function_exists( 'icw_get_option' ) ) {

  function icw_get_option( $slug ) {
    if ( function_exists( 'get_field' ) ) {
      return get_field( $slug, 'option' );
    }

    return false;
  }
}

if ( !function_exists( 'icw_get_field' ) ) {

  function icw_get_field( $slug, $post_id = 0 ) {
    if ( function_exists( 'get_field' ) ) {
      return get_field( $slug, $post_id );
    }

    return false;
  }
}


if ( !function_exists( 'icw_pagination' ) ) {
  function icw_pagination() {
    global $wp_query;
    echo '<div class="icw-pagination">'. paginate_links().'</div>';
  }
}
  
  
if ( !function_exists( 'icw_get_post_thumbnail_url' ) ) {
  /**
   * Get Post Thumbnail URL
   */
  function icw_get_post_thumbnail_url() {
    if ( get_the_post_thumbnail_url() ) {
      return get_the_post_thumbnail_url( get_the_ID(), 'icw-post-thumb-small' );
    } else {
      return get_template_directory_uri() . '/images/no-post.jpg';
    }

    return false;
  }
}
  
if ( !function_exists( 'icw_get_page_title' ) ) {

  function icw_get_page_title() {
    $title = '';

    if ( is_category() ) {
      $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
      $title = single_term_title( "", false ) . esc_html__( 'Tag', 'ICWTHEME' );
    } elseif ( is_date() ) {
      $title = get_the_time( 'F Y' );
    } elseif ( is_author() ) {
      $title = esc_html__( 'Author:', 'ICWTHEME' ) . ' ' . esc_html( get_the_author() );
    } elseif ( is_search() ) {
      $title = esc_html__( 'Search Result', 'ICWTHEME' );
    } elseif ( is_404() ) {
      $title = esc_html__( 'Page not found', 'ICWTHEME' );
    } elseif ( is_archive() ) {
      $title = esc_html__( 'Archive', 'ICWTHEME' );
    } elseif ( is_home() || is_front_page() ) {
      if ( is_home() && !is_front_page() ) {
        $title = esc_html( single_post_title( '', false ) );
      } else {
        $title = ( icw_get_option( 'archive_blog_title' ) ) ? esc_html( icw_get_option( 'archive_blog_title' ) ) : esc_html__( 'Blog', 'ICWTHEME' );
      }
    } else {
      global $post;
      if ( !empty( $post ) ) {
        if ( $post->post_type == 'post' ) {
          // $title = ( icw_get_option( 'archive_blog_title' ) ) ? esc_html( icw_get_option( 'archive_blog_title' ) ) : esc_html__( 'Blog', 'ICWTHEME' );
          $id = $post->ID;
          $title = esc_html( get_the_title( $id ) );
        } else {
          $id = $post->ID;
          $title = esc_html( get_the_title( $id ) );
        }
      } else {
        $title = esc_html__( 'Post not found.', 'ICWTHEME' );
      }
    }

    return $title;
  }

}

if ( !function_exists( 'icw_get_archive_description' ) ) {
  function icw_get_archive_description() {
    $description = '';

    if ( is_home() || is_front_page() ) {
      $description = ( icw_get_option( 'archive_blog_description' ) ) ? esc_html( icw_get_option( 'archive_blog_description' ) ) : '';
    } elseif ( is_category() || is_tag() || is_author() || is_post_type_archive() || is_archive() ) {
      $description = get_the_archive_description();
    }

    return $description;
  }
}

if ( !function_exists( 'icw_render_page_header' ) ) {

  function icw_render_page_header( $type ) {

    $show_header = true;
    $header_style = '';
    $header_title = '';
    $header_description = '';
    $enable_social_icons = true;
    $header_bg_video = '';
    $header_top = '';

    switch ( $type ) {
      case 'page':
        $show_header = false;
        if ( icw_get_field( 'show_page_header' ) !== 'no' ) {
          $show_header = true;

          if ( icw_get_field( 'header_title_type' ) === 'custom' ) {
            $header_title = icw_get_field( 'header_title' );
          } else {
            $header_title = get_the_title();
          }

          $header_bg_type = icw_get_field( 'header_bg_type' ) ? icw_get_field( 'header_bg_type' ) : 'image';
          $header_bg_color = icw_get_field( 'header_bg_color' ) ? icw_get_field( 'header_bg_color' ) : '#5513a0';
          $header_bg_image = icw_get_field( 'header_bg_image' ) ? icw_get_field( 'header_bg_image' ) : '';

          if ( $header_bg_image && $header_bg_type == 'image' ) {
            $header_style = 'background-image: url(' . esc_url( $header_bg_image ) . ')';
          } else {
            $header_style = 'background-color: ' . $header_bg_color . ';';
          }

          if ( $header_bg_type == 'video' ) {
            $header_bg_video = icw_get_field( 'header_bg_video' ) ? icw_get_field( 'header_bg_video' ) : '';
          }

          $header_description = icw_get_field( 'description' );
          $enable_social_icons = ( icw_get_field( 'disable_social_icons' ) ) ? false : true;
        }

        break;
      case 'solution':

        $show_header = true;

        if ( icw_get_field( 'header_title_type' ) === 'custom' ) {
          $header_title = icw_get_field( 'header_title' );
        } else {
          $header_title = get_the_title();
        }

        $header_bg_type = icw_get_field( 'header_bg_type' ) ? icw_get_field( 'header_bg_type' ) : 'image';
        $header_bg_color = icw_get_field( 'header_bg_color' ) ? icw_get_field( 'header_bg_color' ) : '#5513a0';
        $header_bg_image = icw_get_field( 'header_bg_image' ) ? icw_get_field( 'header_bg_image' ) : '';

        if ( $header_bg_image && $header_bg_type == 'image' ) {
          $header_style = 'background-image: url(' . esc_url( $header_bg_image ) . ') ';
        } else {
          $header_style = 'background-color: ' . $header_bg_color . ';';
        }

        if ( $header_bg_type == 'video' ) {
          $header_bg_video = icw_get_field( 'header_bg_video' ) ? icw_get_field( 'header_bg_video' ) : '';
        }

        $header_description = icw_get_field( 'description' );
        $enable_social_icons = ( icw_get_field( 'disable_social_icons' ) ) ? false : true;
        break;
      case 'case':

        $show_header = true;

        if ( icw_get_field( 'header_title_type' ) === 'custom' ) {
          $header_title = icw_get_field( 'header_title' );
        } else {
          $header_title = get_the_title();
        }

        $header_bg_type = icw_get_field( 'header_bg_type' ) ? icw_get_field( 'header_bg_type' ) : 'image';
        $header_bg_color = icw_get_field( 'header_bg_color' ) ? icw_get_field( 'header_bg_color' ) : '#5513a0';
        $header_bg_image = icw_get_field( 'header_bg_image' ) ? icw_get_field( 'header_bg_image' ) : '';

        if ( $header_bg_image && $header_bg_type == 'image' ) {
          $header_style = 'background-image: url(' . esc_url( $header_bg_image ) . ') ';
        } else {
          $header_style = 'background-color: ' . $header_bg_color . ';';
        }

        if ( $header_bg_type == 'video' ) {
          $header_bg_video = icw_get_field( 'header_bg_video' ) ? icw_get_field( 'header_bg_video' ) : '';
        }

        $header_description = icw_get_field( 'description' );
        $enable_social_icons = ( icw_get_field( 'disable_social_icons' ) ) ? false : true;
        break;
      case 'archive':
        $header_top = "Blog";
      case 'single':
        $header_top = "Blog";
      case 'frontpage':
        $header_description = icw_get_archive_description();
        $header_title = icw_get_page_title();
        $header_bg_type = icw_get_option( 'archive_header_bg_type' ) ? icw_get_option( 'archive_header_bg_type' ) : 'image';
        $header_bg_color = icw_get_option( 'archive_header_bg_color' ) ? icw_get_option( 'archive_header_bg_color' ) : '#5513a0';
        $header_bg_image = icw_get_option( 'archive_header_bg_image' ) ? icw_get_option( 'archive_header_bg_image' ) : '';

        if ( $header_bg_image && $header_bg_type == 'image' ) {
          $header_style = 'background-image: url(' . esc_url( $header_bg_image ) . ') ';
        } else {
          $header_style = 'background-color: ' . $header_bg_color . ';';
        }
        if ( $header_bg_type == 'video' ) {
          $header_bg_video = icw_get_option( 'archive_header_bg_video' ) ? icw_get_option( 'archive_header_bg_video' ) : '';
        }

        break;
      case '404':
        $header_title = icw_get_page_title();

        $header_bg_type = icw_get_option( 'page_404_header_bg_type' ) ? icw_get_option( 'page_404_header_bg_type' ) : 'image';
        $header_bg_color = icw_get_option( 'page_404_header_bg_color' ) ? icw_get_option( 'page_404_header_bg_color' ) : '#5513a0';
        $header_bg_image = icw_get_option( 'page_404_header_bg_image' ) ? icw_get_option( 'page_404_header_bg_image' ) : '';

        if ( $header_bg_image && $header_bg_type == 'image' ) {
          $header_style = 'background-image: url(' . esc_url( $header_bg_image ) . ') ';
        } else {
          $header_style = 'background-color: ' . $header_bg_color . ';';
        }

        if ( $header_bg_type == 'video' ) {
          $header_bg_video = icw_get_option( 'page_404_header_bg_video' ) ? icw_get_option( 'page_404_header_bg_video' ) : '';
        }

        break;
      case 'search':
        $header_title = icw_get_page_title();
        $header_description = sprintf( __( 'Search result for: %s ', 'ICWTHEME' ), '<span>' . get_search_query() . '</span>' );

        $header_bg_type = icw_get_option( 'search_header_bg_type' ) ? icw_get_option( 'search_header_bg_type' ) : 'image';
        $header_bg_color = icw_get_option( 'search_header_bg_color' ) ? icw_get_option( 'search_header_bg_color' ) : '#5513a0';
        $header_bg_image = icw_get_option( 'search_header_bg_image' ) ? icw_get_option( 'search_header_bg_image' ) : '';

        if ( $header_bg_image && $header_bg_type == 'image' ) {
          $header_style = 'background-image: url(' . esc_url( $header_bg_image ) . ') center ' . $header_bg_color . ';';
        } else {
          $header_style = 'background-color: ' . $header_bg_color . ';';
        }

        if ( $header_bg_type == 'video' ) {
          $header_bg_video = icw_get_option( 'search_header_bg_video' ) ? icw_get_option( 'search_header_bg_video' ) : '';
        }
        break;
    }

    if ( $show_header ) { ?>
    <header class="page-header" <?php if ( $header_style !== '' ) { echo 'style="' . esc_attr( $header_style ) . '"'; } ?>>
      <?php if( $header_bg_video ) { ?>
      <div class="video-bg">
        <video src="<?php echo esc_url( $header_bg_video ); ?>" muted loop playsinline autoplay></video>
      </div>
      <?php } ?>
      <div class="container">
        <?php if( $header_top ) { ?>
          <p><?php echo $header_top; ?></p>
        <?php } ?>
        <h1><?php echo esc_html( $header_title ); ?></h1>
        <?php if( $header_description ) { ?>
        <p><?php echo $header_description; ?></p>
        <?php } ?>
      </div>
      <?php /* ?>
      <div class="divider"><svg width="1920" height="298" x="0px" y="0px" viewBox="0 0 1920 298" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M49.987 152.987L0 134.05V298H1920V1.99331L1826.52 10.4649L1638.07 0L1433.13 22.9231L1198.69 10.4649L1009.24 28.903L833.283 66.7759L645.832 55.8127L467.378 86.2107L289.924 90.6957L49.987 152.987Z" fill="white" fill-opacity="0.5"/><path d="M90.5236 222.632L0 191.187V298H1920V12L1828.48 26.9738L1650.43 12L1449.88 36.4572L1268.33 70.3979L1059.78 60.9145L862.725 112.325H634.665L422.61 169.225L299.578 142.272L90.5236 222.632Z" fill="#EBF0FF" fill-opacity="0.85"/><path d="M113.707 287.945L0 251.245V298H1920V23L1665.04 86.3455L1401.05 75.7879L1181.65 124.554H961.753L792.945 177.845L587.571 190.413L454.328 225.102L318.581 209.015L113.707 287.945Z" fill="white"/></svg></div><?php */ ?>
      <div class="animation-svg animation-top">
      <div class="circle">
          <svg width="580" height="400" class="svg-morph">
          <path id="svg_morph" d="m261,30.4375c0,0 114,6 151,75c37,69 37,174 6,206.5625c-31,32.5625 -138,11.4375 -196,-19.5625c-58,-31 -86,-62 -90,-134.4375c12,-136.5625 92,-126.5625 129,-127.5625z"></path>
        </svg>
      </div>
  </div>
    </header>
    <!-- end page-header -->
    <?php
    }
    
  }
}
  
  
if ( !function_exists( 'icw_post_tags' ) ) {

  function icw_post_tags() {

    $tags = get_the_tags();
    if ( false !== $tags ) {
      ?>
    <ul class="post-categories">
      <?php
      foreach ( $tags as $tag ) {
        $link = get_tag_link( $tag->term_id );
        ?>
      <li><a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $tag->name ); ?></a></li>
      <?php
      }
      ?>
    </ul>
  <?php
  }
  }
}
  
if ( !function_exists( 'icw_get_wpml_langs' ) ) {

  function icw_get_wpml_langs() {

    if ( function_exists( 'icl_get_languages' ) ) {
      $langs = icl_get_languages( 'skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str' );
      if ( $langs ) {
        ?>
  <ul class="languages">
    <?php foreach ( $langs as $lang ) { ?>
    <li <?php if( $lang['active'] === 1 ) { ?> class="active" <?php } ?>> <a href="<?php echo esc_url( $lang['url'] ); ?>" title="<?php echo esc_attr__( $lang['native_name'],  'ICWTHEME' ); ?>"><?php echo esc_html( strtoupper( $lang['language_code'] ) ); ?></a> </li>
    <?php } ?>
  </ul>
  <?php
  }
  }

  }
}
  
if ( !function_exists( 'wp_body_open' ) ) {
  function wp_body_open() {
    do_action( 'wp_body_open' );
  }
}

function icw_import_files() {
  return array(
    array(
      'import_file_name' => 'ICWSITE Demo Import',
      'import_file_url' => 'http://icw.net/import/demo-data.xml',
      'import_widget_file_url' => 'http://icw.net/import/widgets.wie',
      'import_notice' => esc_html__( 'With one click import demo content.', 'ICWTHEME' ),
    ),
  );

}
add_filter( 'pt-ocdi/import_files', 'icw_import_files' );

function icw_after_import_setup() {
  // Assign menus to their locations.
  $main_menu = get_term_by( 'name', esc_html__( 'Main Menu', 'ICWTHEME' ), 'nav_menu' );
  set_theme_mod( 'nav_menu_locations', array(
    'header' => $main_menu->term_id,
  ) );

  // Assign front page and posts page (blog page).
  $front_page_id = get_page_by_title( 'Home' );
  $blog_page_id = get_page_by_title( 'News' );

  update_option( 'show_on_front', 'page' );
  update_option( 'page_on_front', $front_page_id->ID );
  update_option( 'page_for_posts', $blog_page_id->ID );

  if ( function_exists( 'icw_after_import' ) ) {
    icw_after_import();
  }
}
  
  
add_action( 'pt-ocdi/after_import', 'icw_after_import_setup' );
add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );
add_action( 'pt-ocdi/disable_pt_branding', '__return_true' );



//Remove the REST API endpoint.
remove_action('rest_api_init', 'wp_oembed_register_route');
 
// Turn off oEmbed auto discovery.
add_filter( 'embed_oembed_discover', '__return_false' );
 
//Don't filter oEmbed results.
remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
 
//Remove oEmbed discovery links.
remove_action('wp_head', 'wp_oembed_add_discovery_links');
 
//Remove oEmbed JavaScript from the front-end and back-end.
remove_action('wp_head', 'wp_oembed_add_host_js');



/*-----------------------------------------------------------------------------------*/
/* Block Bad Queries start | InCreativeWeb
/*-----------------------------------------------------------------------------------*/
if (!defined('ABSPATH')) die();
$request_uri_array  = apply_filters( 'request_uri_items',  array( 'eval\(', 'UNION\+SELECT', '\(null\)', 'base64_', '\/localhost', '\%2Flocalhost', '\/pingserver', '\/config\.', '\/wwwroot', '\/makefile', 'crossdomain\.', 'proc\/self\/environ', 'etc\/passwd', '\/https\:', '\/http\:', '\/ftp\:', '\/cgi\/', '\.cgi', '\.exe', '\.sql', '\.ini', '\.dll', '\.asp', '\.jsp', '\/\.bash', '\/\.git', '\/\.svn', '\/\.tar', ' ', '\<', '\>', '\/\=', '\.\.\.', '\+\+\+', '\:\/\/', '\/&&', '\/Nt\.', '\;Nt\.', '\=Nt\.', '\,Nt\.', '\.exec\(', '\)\.html\(', '\{x\.html\(', '\(function\(' ) );
$query_string_array = apply_filters( 'query_string_items', array( '\.\.\/', '127\.0\.0\.1', 'localhost', 'loopback', '\%0A', '\%0D', '\%00', '\%2e\%2e', 'input_file', 'execute', 'mosconfig', 'path\=\.', 'mod\=\.' ) );
$user_agent_array   = apply_filters( 'user_agent_items',   array( 'binlar', 'casper', 'cmswor', 'diavol', 'dotbot', 'finder', 'flicky', 'nutch', 'planet', 'purebot', 'pycurl', 'skygrid', 'sucker', 'turnit', 'vikspi', 'zmeu' ) );

$request_uri_string = false;
$query_string_string = false;
$user_agent_string = false;

if (isset($_SERVER['REQUEST_URI']) && !empty($_SERVER['REQUEST_URI'])) $request_uri_string = $_SERVER['REQUEST_URI'];
if (isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING'])) $query_string_string = $_SERVER['QUERY_STRING'];
if (isset($_SERVER['HTTP_USER_AGENT']) && !empty($_SERVER['HTTP_USER_AGENT'])) $user_agent_string = $_SERVER['HTTP_USER_AGENT'];

if ($request_uri_string || $query_string_string || $user_agent_string) {
	if (
		// strlen( $_SERVER['REQUEST_URI'] ) > 255 || // optional
		preg_match( '/' . implode( '|', $request_uri_array )  . '/i', $request_uri_string ) ||
		preg_match( '/' . implode( '|', $query_string_array ) . '/i', $query_string_string ) ||
		preg_match( '/' . implode( '|', $user_agent_array )   . '/i', $user_agent_string )
	) {
		header('HTTP/1.1 403 Forbidden');
		header('Status: 403 Forbidden');
		header('Connection: Close');
		exit;
	}
}


/* Block Bad Queries End */
/*-----------------------------------------------------------------------------------*/
/* Remove Unnecessary Code From Your WordPress Blog Header | InCreativeWeb
/*-----------------------------------------------------------------------------------*/
remove_action( 'wp_head', 'wlwmanifest_link');
remove_action ('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'feed_links_extra', 3); // Remove category feeds
remove_action('wp_head', 'feed_links', 2); // Remove Post and Comment Feeds
remove_action('wp_head', 'wp_resource_hints', 2 );
remove_action('wp_head', 'rest_output_link_wp_head'); // Remove REST API //api.w.org
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('template_redirect', 'rest_output_link_header', 11, 0);


 /*-----------------------------------------------------------------------------------*/
 /* Disable the emoji's | InCreativeWeb
 /*-----------------------------------------------------------------------------------*/
function disable_emojis() {
 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'wp_print_styles', 'print_emoji_styles' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' );
 remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
 remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
 remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
 add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
 add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param array $plugins
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
 if ( is_array( $plugins ) ) {
 return array_diff( $plugins, array( 'wpemoji' ) );
 } else {
 return array();
 }
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
 if ( 'dns-prefetch' == $relation_type ) {
 /** This filter is documented in wp-includes/formatting.php */
 $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

$urls = array_diff( $urls, array( $emoji_svg_url ) );
 }

return $urls;
}

/*-----------------------------------------------------------------------------------*/
/*   Remove query strings from static resources  |   InCreativeWeb @ 23 Feb 2017
Plugin URI: http://www.yourwpexpert.com/remove-query-strings-from-static-resources-wordpress-plugin/
/*-----------------------------------------------------------------------------------*/
function _remove_query_strings_1( $src ){
	$rqs = explode( '?ver', $src );
        return $rqs[0];
}
if ( is_admin() ) {
// Remove query strings from static resources disabled in admin
} else {
add_filter( 'script_loader_src', '_remove_query_strings_1', 15, 1 );
add_filter( 'style_loader_src', '_remove_query_strings_1', 15, 1 );
}

function _remove_query_strings_2( $src ){
	$rqs = explode( '&ver', $src );
        return $rqs[0];
}
if ( is_admin() ) {
// Remove query strings from static resources disabled in admin
} else {
add_filter( 'script_loader_src', '_remove_query_strings_2', 15, 1 );
add_filter( 'style_loader_src', '_remove_query_strings_2', 15, 1 );
}


//REMOVE GUTENBERG BLOCK LIBRARY CSS FROM LOADING ON FRONTEND
function remove_wp_block_library_css(){
  wp_dequeue_style( 'wp-block-library' );
  wp_dequeue_style( 'wp-block-library-theme' );
  wp_dequeue_style( 'wc-block-style' ); // REMOVE WOOCOMMERCE BLOCK CSS
  wp_dequeue_style( 'global-styles' ); // REMOVE THEME.JSON
  }
  add_action( 'wp_enqueue_scripts', 'remove_wp_block_library_css', 100 );