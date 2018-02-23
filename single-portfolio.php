<?php
/**
 * The template for displaying single portfolio.
 *
 * @package Shapla Portfolio
 */
$options = shapla_portfolio_get_options();
// Use get_post_meta to retrieve an existing value from the database.
$images_ids = explode(',', get_post_meta( get_the_ID(), '_shapla_image_ids', true) );

$subtitle 	= get_post_meta( get_the_ID(), '_shapla_portfolio_subtitle', true );
$client 	= get_post_meta( get_the_ID(), '_shapla_portfolio_client', true );
$date 		= strtotime(get_post_meta( get_the_ID(), '_shapla_portfolio_date', true ));
$url 		= get_post_meta( get_the_ID(), '_shapla_portfolio_url', true );

get_header(); ?>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">

				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">

					<?php while ( have_posts() ) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header class="entry-header">
								<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
								<?php
									if (!empty($subtitle)) {
										echo "<p class='text-center entry-sub-title'>".$subtitle."</p>";
									}
								?>
							</header><!-- .entry-header -->
							<?php if( $images_ids[0] !== "" ) : ?>
								<ul id="portfolio-slider" class="portfolio-slider">
									<?php
										foreach ($images_ids as $images_id) {
											if(!$images_id) continue;
											$src = wp_get_attachment_image_src( $images_id, 'full' );
											echo "<li><img src='{$src[0]}' width='{$src[1]}' height='{$src[2]}'></li>";
										}
									?>
								</ul>
							<?php elseif( has_post_thumbnail() ):
								the_post_thumbnail('full');
							endif;
							?>

							<div class="entry-content">
								<div class="row">
									<div class="col-sm-8">
										<?php the_content(); ?>
									</div>
									<div class="col-sm-4">
										<div class="well portfolio-well">
											<ul>
											<?php if (!empty($url)): ?>
												<li><a class="btn btn-primary btn-lg btn-block" target="_blank" href="<?php echo esc_url($url); ?>"><?php _e('Project URL','shapla-portfolio'); ?></a></li>
											<?php endif; ?>
											<?php if (!empty($client)): ?>
												<li>
													<span><?php _e('Client:','shapla-portfolio'); ?></span>
													<p><?php echo esc_attr($client); ?></p>
												</li>
											<?php endif; ?>
											<?php if (!empty($date)): ?>
												<li>
													<span><?php _e('Project Date:','shapla-portfolio'); ?></span>
													<p><?php echo date_i18n( get_option( 'date_format' ), $date); ?></p>
												</li>
											<?php endif; ?>
											</ul>
										</div>
									</div>
								</div>
								<?php
									wp_link_pages( array(
										'before' => '<div class="page-links">' . __( 'Pages:', 'shapla-portfolio' ),
										'after'  => '</div>',
									) );
								?>
							</div><!-- .entry-content -->
						</article><!-- #post-## -->

					<?php endwhile; // end of the loop. ?>
					<?php
						if(isset($options[ 'show_related_project' ]) && $options[ 'show_related_project' ] == true ){
							get_template_part( 'content', 'related-portfolio' );
						}
					?>

					</main><!-- #main -->
				</div><!-- #primary -->
			</div>
		</div>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
