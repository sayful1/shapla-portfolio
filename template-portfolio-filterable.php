<?php
/**
 * Template Name: Portfolio - Filterable
 * Description: Template to display filterable portfolio items
 */

get_header();
$options = shapla_portfolio_get_options();
?>

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
					<div class="portfolio-content">
						<!--#container -->
						<div id="portfolio-container">

							<div id="filter">
								<?php
						            $terms = get_terms("skill");
						            echo '<ul>';
						                if (taxonomy_exists('skill') && count($terms) > 0 ){
						                    echo '<li><a class="active" href="#" data-group="all">'.__('All','shapla-portfolio').'</a></li>';
						                    foreach ( $terms as $term ) {
						                        echo '<li><a href="#" data-group="'.$term->slug.'">'.$term->name.'</a></li>';
						                    }
						                }
						            echo "</ul>";
						        ?>
							</div>

							<div id="grid" class="row">

								<?php

								$args = array(
								  'post_type' => 'portfolio',
								  'posts_per_page' => -1,
								);

								$the_query = new WP_Query( $args );

								if( $the_query->have_posts() ) :
								while( $the_query->have_posts() ): $the_query->the_post();

								if( ! has_post_thumbnail() ) continue;

								get_template_part( 'content', 'portfolio' );

								endwhile;
								endif;

								wp_reset_postdata();

								?>
							</div>

						</div>
						<!-- /#container -->
					</div>
					</main><!-- #main -->
				</div><!-- #primary -->
			</div>
		</div>
	</div>
	<?php if(isset($options[ 'show_portfolio_cta' ]) && $options[ 'show_portfolio_cta' ] == true ): ?>
		<section class="section-call-to-action">
	        <div class="container">
	            <div class="row">
	                <div class="col-sm-8">
	                    <h2><?php echo $options[ 'portfolio_cta_text' ]; ?></h2>
	                </div>
	                <div class="col-sm-4">
	                    <a class="btn btn-primary btn-lg btn-block" href="<?php echo $options[ 'cta_btn_url' ]; ?>"><?php echo $options[ 'cta_btn_text' ]; ?></a>
	                </div>
	            </div>
	        </div>
	   	</section>
   <?php endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
