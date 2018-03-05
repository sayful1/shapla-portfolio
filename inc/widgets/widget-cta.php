<?php

class Shapla_Portfolio_Widget_Cta extends WP_Widget {

	public function __construct() {
		// TODO: update description
		parent::__construct(
			'shapla_portfolio_widget_cta',
			__( 'Section: Call To Action', 'shapla-portfolio' ),
			array(
				'classname'   => 'section-call-to-action',
				'description' => __( 'Displays a call to action.', 'shapla-portfolio' )
			)
		);

	} // end constructor

	function widget( $args, $instance ) {
		extract( $args );

		// VARS FROM WIDGET SETTINGS
		$title = apply_filters( 'widget_title', $instance['title'] );
		$link  = $instance['link'];
		$text  = $instance['text'];

		echo $args['before_widget'];
		?>

        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <h2><?php echo $title; ?></h2>
                </div>
                <div class="col-sm-4">
					<?php if ( $text != '' ): ?>
                        <a href="<?php echo esc_url( $link ); ?>"
                           class="btn btn-primary btn-lg btn-block"><?php echo esc_attr( $text ); ?></a>
					<?php endif; ?>
                </div>
            </div>
        </div>

		<?php

		echo $args['after_widget'];

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		// STRIP TAGS TO REMOVE HTML
		$instance['title'] = $new_instance['title'];
		$instance['link']  = strip_tags( $new_instance['link'] );
		$instance['text']  = strip_tags( $new_instance['text'] );

		return $instance;
	}

	function form( $instance ) {
		$defaults = array(
			/* Deafult options goes here */
			'title' => '',
			'link'  => '',
			'text'  => '',
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
            <label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Button Link:', 'shapla-portfolio' ); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>"
                   name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo $instance['link']; ?>"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Button Text:', 'shapla-portfolio' ); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>"
                   name="<?php echo $this->get_field_name( 'text' ); ?>" value="<?php echo $instance['text']; ?>"/>
        </p>

		<?php
	}

	public static function register() {
		register_widget( __CLASS__ );
	}
}

add_action( 'widgets_init', array( 'Shapla_Portfolio_Widget_Cta', 'register' ) );
