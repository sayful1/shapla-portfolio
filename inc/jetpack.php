<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Shapla Portfolio
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function shapla_portfolio_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'shapla_portfolio_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function shapla_portfolio_jetpack_setup
add_action( 'after_setup_theme', 'shapla_portfolio_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function shapla_portfolio_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'content', get_post_format() );
	}
} // end function shapla_portfolio_infinite_scroll_render
