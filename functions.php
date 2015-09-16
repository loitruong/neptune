<?php
/**
 * loft functions and definitions
 *
 * @package loft
 */

define( 'LOFT_VERSION', '1.0.0' );

// Theme initialization
require get_template_directory() . '/lib/init.php';

// Custom theme functions definited in /lib/init.php
require get_template_directory() . '/lib/theme-functions.php';

// Helper functions for use in other areas of the theme
require get_template_directory() . '/lib/theme-helpers.php';

// Custom template tags for this theme.
require get_template_directory() . '/lib/inc/template-tags.php';

// Custom functions that act independently of the theme templates.
require get_template_directory() . '/lib/inc/extras.php';

// Customizer additions.
require get_template_directory() . '/lib/inc/customizer.php';

// Load Jetpack compatibility file.
require get_template_directory() . '/lib/inc/jetpack.php';

//All Admin stufff 
require get_template_directory() . '/admin/loft-admin.php';