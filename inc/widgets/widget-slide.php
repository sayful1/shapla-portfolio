<?php

class Shapla_Portfolio_Widget_Slide extends WP_Widget {

	public function __construct() {

		// TODO: update description
		parent::__construct(
			'shapla_portfolio_widget_slide',
			__( 'Section: Slide', 'shapla-portfolio' ),
			array(
				'classname'   => 'section-slide',
				'description' => __( 'Displays slide', 'shapla-portfolio' )
			)
		);

		// Register site styles and scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_scripts' ) );

	} // end constructor

	function widget( $args, $instance ) {
		extract( $args );

		// VARS FROM WIDGET SETTINGS
		$slide_id    = isset( $instance['slide_id'] ) ? intval( $instance['slide_id'] ) : '';
		$slide_width = isset( $instance['slide_width'] ) ? esc_attr( $instance['slide_width'] ) : '';

		echo $args['before_widget'];

		if ( $slide_width == 'on' ) {
			echo do_shortcode( '[shapla_slide id="' . $slide_id . '"]' );
		} else {
			?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
						<?php echo do_shortcode( '[shapla_slide id="' . $slide_id . '"]' ); ?>
                    </div>
                </div>
            </div>
			<?php
		}

		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		// STRIP TAGS TO REMOVE HTML
		$instance['slide_id']    = strip_tags( $new_instance['slide_id'] );
		$instance['slide_width'] = strip_tags( $new_instance['slide_width'] );

		return $instance;
	}

	function form( $instance ) {
		$defaults = array(
			/* Deafult options goes here */
			'slide_id'    => '',
			'slide_width' => '',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		/* HERE GOES THE FORM */
		?>

        <p>
            <label for="<?php echo $this->get_field_id( 'slide_id' ); ?>"><?php _e( 'Slide ID', 'shapla-portfolio' ); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'slide_id' ); ?>"
                   name="<?php echo $this->get_field_name( 'slide_id' ); ?>"
                   value="<?php echo $instance['slide_id']; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'slide_width' ); ?>">
                <input type="checkbox" name="<?php echo $this->get_field_name( 'slide_width' ); ?>"
                       id="<?php echo $this->get_field_id( 'slide_width' ); ?>"
                       value="on" <?php checked( $instance['slide_width'], 'on' ); ?>>
				<?php _e( 'Enable Full Page Slide', 'shapla-portfolio' ); ?>
            </label>
        </p>

		<?php
	}

	public function register_widget_scripts() {
		wp_enqueue_script( 'nivo-slider' );
		wp_enqueue_style( 'nivo-slider' );
	}

	public static function register() {
		register_widget( __CLASS__ );
	}
}

add_action( 'widgets_init', array( 'Shapla_Portfolio_Widget_Slide', 'register' ) );
