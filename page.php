<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Shapla Portfolio
 */

get_header(); ?>

	<div class="page-title-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<header class="page-header">
						<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
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

						<?php while ( have_posts() ) : the_post(); ?>

							<?php get_template_part( 'content', 'page' ); ?>

							<?php
								// If comments are open or we have at least one comment, load up the comment template
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;
							?>

						<?php endwhile; // end of the loop. ?>

					</main><!-- #main -->
				</div><!-- #primary -->
			</div>
		</div>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
