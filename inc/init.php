<?php

/**
 * Load Theme Custom Widgets
 */
require dirname( __FILE__ ) . '/widgets/widget-recent-projects.php';
require dirname( __FILE__ ) . '/widgets/widget-featured-blog-posts.php';
require dirname( __FILE__ ) . '/widgets/widget-slide.php';
require dirname( __FILE__ ) . '/widgets/widget-cta.php';
require dirname( __FILE__ ) . '/widgets/widget-contact.php';
require dirname( __FILE__ ) . '/widgets/widget-hero.php';
require dirname( __FILE__ ) . '/widgets/widget-intro.php';

/**
 * Custom template tags for this theme.
 */
require dirname( __FILE__ ) . '/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require dirname( __FILE__ ) . '/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require dirname( __FILE__ ) . '/jetpack.php';

/**
 * Customizer additions.
 */
require dirname( __FILE__ ) . '/options/customizer.php';

/**
 * Register Bootstrap Navigation Walker
 */
require_once dirname( __FILE__ ) . '/framework/class-wp-bootstrap-navwalker.php';

/**
 * TGM Plugin Activation
 */
require_once dirname( __FILE__ ) . '/framework/class-tgm-plugin-activation.php';
