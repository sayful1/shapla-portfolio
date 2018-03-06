<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Shapla Portfolio
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="site-info">
						<?php
							$options = get_option('shapla_portfolio_options');
							if ( isset($options[ 'footer_text' ]) && !empty($options[ 'footer_text' ])) :

								echo $options['footer_text'];

							else:
						?>
							<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'shapla-portfolio' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'shapla-portfolio' ), 'WordPress' ); ?></a>
							<span class="sep"> | </span>
							<?php printf( __( 'Theme: %1$s by %2$s.', 'shapla-portfolio' ), 'Shapla Portfolio', '<a href="http://sayfulit.com" rel="designer">Sayful Islam</a>' ); ?>
						<?php endif; ?>
					</div><!-- .site-info -->
				</div><!-- .col-sm-12 -->
			</div><!-- .row -->
		</div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<span id="shapla-back-to-top" class="back-to-top" data-distance="500">
    <span class="screen-reader-text"><?php esc_html_e( 'Scroll to Top', 'shaplaportfolio' ) ?></span>
</span>

<?php wp_footer(); ?>

</body>
</html>
