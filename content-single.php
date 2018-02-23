<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Shapla Portfolio
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
        // Post thumbnail.
        shapla_portfolio_post_thumbnail();
    ?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php shapla_portfolio_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'shapla-portfolio' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php shapla_portfolio_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
