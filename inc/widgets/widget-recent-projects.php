<?php

class Shapla_Portfolio_Widget_Recent_Projects extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'shapla_portfolio_widget_recent_projects',
			__( 'Section: Recent Projects', 'shapla-portfolio' ),
			array(
				'classname'   => 'section-recent-projects',
				'description' => __( 'Displays recent portfolio items.', 'shapla-portfolio' )
			)
		);

	} // end constructor

	function widget( $args, $instance ) {
		// VARS FROM WIDGET SETTINGS
		$title       = apply_filters( 'widget_title', $instance['title'] );
		$subtitle    = $instance['subtitle'];
		$button_text = $instance['button_text'];
		$button_link = $instance['button_link'];
		$post_count  = $instance['post_count'];

		echo $args['before_widget'];

		?>
        <div class="container">
        <div class="row">
		<?php if ( $title ) : ?>
            <div class="section-title">
                <h1 class="title-wrapper"><?php echo $title; ?></h1>
                <p class="subtitle"><?php echo $subtitle; ?></p>
            </div>
		<?php endif; ?>

        <div class="grids portfolio-items">
			<?php

			$args = array(
				'post_type'      => 'portfolio',
				'posts_per_page' => $post_count,
				'orderby'        => 'date'
			);

			$the_query = new WP_Query( $args );

			if ( $the_query->have_posts() ) :
				while ( $the_query->have_posts() ): $the_query->the_post();

					if ( ! has_post_thumbnail() ) {
						continue;
					}

					get_template_part( 'content', 'portfolio' );

				endwhile;
			endif;
			wp_reset_postdata();
			?>
        </div>

		<?php
		if ( $button_link != '' ) {
			?>
            <div class="text-center section-cta">
                <a href="<?php echo esc_url( $button_link ); ?>"
                   class="btn btn-primary btn-lg"><?php echo esc_attr( $button_text ); ?></a>
            </div>
            </div></div>
			<?php
		}

		echo $args['after_widget'];

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		// STRIP TAGS TO REMOVE HTML
		$instance['title']       = strip_tags( $new_instance['title'] );
		$instance['subtitle']    = strip_tags( $new_instance['subtitle'] );
		$instance['button_text'] = strip_tags( $new_instance['button_text'] );
		$instance['button_link'] = strip_tags( $new_instance['button_link'] );
		$instance['post_count']  = strip_tags( $new_instance['post_count'] );

		return $instance;
	}

	function form( $instance ) {
		/* Default options goes here */
		$defaults = array(
			'title'       => 'Recent Projects',
			'subtitle'    => 'here is some recent work I have done for my clients',
			'button_text' => 'I like them. Show me more!',
			'button_link' => '',
			'post_count'  => 3,
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		/* HERE GOES THE FORM */
		?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'shapla-portfolio' ); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
                   name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php _e( 'Subtitle:', 'shapla-portfolio' ); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>"
                   name="<?php echo $this->get_field_name( 'subtitle' ); ?>"
                   value="<?php echo $instance['subtitle']; ?>"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'button_link' ); ?>"><?php _e( 'Portfolio Link:', 'shapla-portfolio' ); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'button_link' ); ?>"
                   name="<?php echo $this->get_field_name( 'button_link' ); ?>"
                   value="<?php echo $instance['button_link']; ?>"/>
            <span class="description"><?php _e( 'Enter the portfolio page URL.', 'shapla-portfolio' ); ?></span>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php _e( 'Button Text:', 'shapla-portfolio' ); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>"
                   name="<?php echo $this->get_field_name( 'button_text' ); ?>"
                   value="<?php echo $instance['button_text']; ?>"/>
            <span class="description"><?php _e( 'Enter text for the portfolio button.', 'shapla-portfolio' ); ?></span>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'post_count' ); ?>"><?php _e( 'Post Count:', 'shapla-portfolio' ); ?></label>
            <input type="number" step="3" class="widefat" id="<?php echo $this->get_field_id( 'post_count' ); ?>"
                   name="<?php echo $this->get_field_name( 'post_count' ); ?>"
                   value="<?php echo $instance['post_count']; ?>"/>
            <span class="description"><?php _e( 'Enter the number of recent portfolio items to display at homepage.', 'shapla-portfolio' ); ?></span>
        </p>
		<?php
	}

	public static function register() {
		register_widget( __CLASS__ );
	}
}

add_action( 'widgets_init', array( 'Shapla_Portfolio_Widget_Recent_Projects', 'register' ) );
