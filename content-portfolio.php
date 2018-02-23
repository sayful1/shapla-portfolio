<?php
/**
 * The template used for displaying portfolio content
 */
?>

<?php
	$terms = get_the_terms( get_the_ID(), 'skill' );   //To get custom taxonomy catagory name

	if ( $terms && ! is_wp_error( $terms ) ) :
		$links = array();

		foreach ( $terms as $term ) {
        	$links[] = $term->name;
        }

        $links = str_replace(' ', '-', $links);

        $tax = strtolower(join( " ", $links ));
        $tax = json_encode(explode(' ', $tax));
    else :
        $tax = '';
    endif;
?>
<div id="portfolio-<?php the_ID(); ?>" <?php post_class( 'item col-md-4' ); ?> data-groups='<?php echo (isset($tax)) ? $tax : ''; ?>'>
	<div class="single-portfolio-item">
		<div class="portfolio-f-image">
			<?php
				if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ){

					the_post_thumbnail( 'portfolio-thumbnails', array( 'alt' => get_the_title() ) );

				}
			?>
			<div class="portfolio-hover">
				<a href="#" class="portfolio-title-link"><?php the_title(); ?></a>
				<a href="<?php the_permalink(); ?>" class="view-details-link">See details</a>
			</div>
		</div>
	</div>
</div>
