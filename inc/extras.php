<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Shapla Portfolio
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function shapla_portfolio_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	$classes[] = 'shapla-portfolio';

	return $classes;
}
add_filter( 'body_class', 'shapla_portfolio_body_classes' );


/**
 * Register the required plugins for this theme.
 */
function shapla_portfolio_required_plugins() {
	$plugins = array(

        array(
            'name'      => 'ShaplaTools',
            'slug'      => 'shaplatools',
            'required'  => true,
        ),

    );

    tgmpa( $plugins );
}
add_action( 'tgmpa_register', 'shapla_portfolio_required_plugins' );


if (is_shaplatools_activated()):

// Include ShaplaTools Portfolio Feature
if (function_exists('run_shaplatools_portfolio')) {
	run_shaplatools_portfolio();
}
if (function_exists('run_shaplatools_portfolio_meta')) {
	run_shaplatools_portfolio_meta();
}
// Include ShaplaTools Slide Feature
if (function_exists('run_shaplatools_slide')) {
	run_shaplatools_slide();
}
if (function_exists('run_shaplatools_nivoslide_meta')) {
	run_shaplatools_nivoslide_meta();
}

endif;