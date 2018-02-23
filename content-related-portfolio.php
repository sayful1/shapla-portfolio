<?php
/**
 * The template used for displaying related portfolio items in single-portfolio.php
 *
 * @package Shapla Portfolio
 */
$options = shapla_portfolio_get_options();

$tags = wp_get_post_terms( get_the_ID(), 'skill' );

?>
<section class="related-projects">
	
	<?php if( $tags ) : ?>


	<div class="section-title">
		<h1 class="title-wrapper"><?php echo $options[ 'retated_project_text' ]; ?></h1>
	</div>
	
	<div id="grid" class="portfolio-items">
		<?php

		$tag_ids = array();
		foreach( $tags as $individual_tag ) $tag_ids[] = $individual_tag->term_id;

		$args = array(
			'post_type'      => 'portfolio',
			'posts_per_page' => 3,
			'post__not_in'   => array( get_the_ID() ),
			'tax_query'      => array(
				array(
					'taxonomy' => 'skill',
					'field'    => 'id',
					'terms'    => $tag_ids
				)
			)
		);

		$tax_query = new WP_Query($args);

		while( $tax_query->have_posts() ) : $tax_query->the_post();

		get_template_part( 'content', 'portfolio' );

		endwhile;

		wp_reset_query();

		?>
	</div>
	<?php endif; // if have tags ?>
</section><!-- .related-projects -->
