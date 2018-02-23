<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Shapla Portfolio
 */

get_header(); 

$options = shapla_portfolio_get_options();

?>

<?php if ( is_home() ): if (isset($options['blog_title']) && !empty($options['blog_title'])): ?>
	<div class="page-title-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<header class="page-header">
						<h1 class="page-title"><?php echo $options['blog_title']; ?></h1>
					</header><!-- .page-header -->
				</div>
			</div>
		</div>
	</div>
<?php endif; endif; ?>

	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">

					<?php if ( have_posts() ) : ?>

						<?php if ( is_home() && ! is_front_page() ) : ?>
							<header>
								<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
							</header>
						<?php endif; ?>

						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<?php

								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'content', get_post_format() );
							?>

						<?php endwhile; ?>

						<?php
							the_posts_pagination( array(
								'prev_text'          => __( '&laquo; Previous', 'shapla-portfolio' ),
								'next_text'          => __( 'Next &raquo;', 'shapla-portfolio' )
							) );
						?>

					<?php else : ?>

						<?php get_template_part( 'content', 'none' ); ?>

					<?php endif; ?>

					</main><!-- #main -->
				</div><!-- #primary -->
			</div>
		</div>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
