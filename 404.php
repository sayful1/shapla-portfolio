<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Shapla Portfolio
 */

get_header(); ?>

	<div class="page-title-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'shapla-portfolio' ); ?></h1>
					</header><!-- .page-header -->
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-sm-12">

				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">

						<section class="error-404 not-found">

							<div class="page-content">
								<div class="row">
									<div class="col-sm-12">
										<div class="text-center">
											<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'shapla-portfolio' ); ?></p>

											<?php get_search_form(); ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-3">
										<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
									</div>
									<div class="col-sm-3">
										<?php if ( shapla_portfolio_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
										<div class="widget widget_categories">
											<h2 class="widgettitle"><?php esc_html_e( 'Most Used Categories', 'shapla-portfolio' ); ?></h2>
											<ul>
											<?php
												wp_list_categories( array(
													'orderby'    => 'count',
													'order'      => 'DESC',
													'show_count' => 1,
													'title_li'   => '',
													'number'     => 10,
												) );
											?>
											</ul>
										</div><!-- .widget -->
										<?php endif; ?>
									</div>
									<div class="col-sm-3">
										<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
									</div>
									<div class="col-sm-3">
										<?php
											/* translators: %1$s: smiley */
											$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'shapla-portfolio' ), convert_smilies( ':)' ) ) . '</p>';
											the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
										?>
									</div>
								</div>
							</div><!-- .page-content -->
						</section><!-- .error-404 -->

					</main><!-- #main -->
				</div><!-- #primary -->
			</div>
		</div>
	</div>

<?php get_footer(); ?>
