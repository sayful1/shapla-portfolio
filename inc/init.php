<?php

/**
 * Load Theme Custom Widgets
 */
require get_template_directory() . '/inc/widgets/widget-recent-projects.php';
require get_template_directory() . '/inc/widgets/widget-featured-blog-posts.php';
require get_template_directory() . '/inc/widgets/widget-slide.php';
require get_template_directory() . '/inc/widgets/widget-cta.php';
require get_template_directory() . '/inc/widgets/widget-contact.php';
require get_template_directory() . '/inc/widgets/widget-hero.php';
require get_template_directory() . '/inc/widgets/widget-intro.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/options/customizer.php';

/**
 * Register Bootstrap Navigation Walker
 */
require_once get_template_directory() . '/inc/framework/wp_bootstrap_navwalker.php';

/**
 * TGM Plugin Activation
 */
require_once get_template_directory() . '/inc/framework/class-tgm-plugin-activation.php';
