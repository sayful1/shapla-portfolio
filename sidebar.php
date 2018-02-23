<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Shapla Portfolio
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

?>
<div class="footer-widget-area">
	<div class="container">
		<div class="row">
			<div id="secondary" class="widget-area" role="complementary">
				<?php if(is_active_sidebar( 'sidebar-1' )): ?>
					<div class="col-sm-3 col-xs-12">
						<?php dynamic_sidebar( 'sidebar-1' ); ?>
					</div>
				<?php endif; ?>
				<?php if(is_active_sidebar( 'sidebar-2' )): ?>
					<div class="col-sm-3 col-xs-12">
						<?php dynamic_sidebar( 'sidebar-2' ); ?>
					</div>
				<?php endif; ?>
				<?php if(is_active_sidebar( 'sidebar-3' )): ?>
					<div class="col-sm-3 col-xs-12">
						<?php dynamic_sidebar( 'sidebar-3' ); ?>
					</div>
				<?php endif; ?>
				<?php if(is_active_sidebar( 'sidebar-4' )): ?>
					<div class="col-sm-3 col-xs-12">
						<?php dynamic_sidebar( 'sidebar-4' ); ?>
					</div>
				<?php endif; ?>
			</div><!-- #secondary -->
		</div>
	</div>
</div><!-- .footer-widget-area -->
