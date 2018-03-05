<?php

class Shapla_Portfolio_Widget_Contact extends WP_Widget {

	public function __construct() {

		// TODO: update description
		parent::__construct(
			'shapla_portfolio_widget_contact',
			__( 'Section: Contact Info', 'shapla-portfolio' ),
			array(
				'classname'   => 'section-contact',
				'description' => __( 'Displays contact information.', 'shapla-portfolio' )
			)
		);

	} // end constructor

	function widget( $args, $instance ) {
		extract( $args );

		// VARS FROM WIDGET SETTINGS
		$title        = apply_filters( 'widget_title', $instance['title'] );
		$subtitle     = $instance['subtitle'];
		$lat          = $instance['lat'];
		$long         = $instance['long'];
		$description  = $instance['description'];
		$contact_form = $instance['contact_form'];

		echo $args['before_widget'];

		?>
        <div class="container">
            <div class="row">
				<?php if ( $title || $subtitle ) : ?>
                    <div class="section-title">
                        <h1 class="title-wrapper"><?php echo $title; ?></h1>
                        <p class="subtitle"><?php echo $subtitle; ?></p>
                    </div>
				<?php endif; ?>

                <div class="col-sm-12">
					<?php
					if ( $lat != '' && $long != '' ) {
						echo do_shortcode( "[shapla_map lat='$lat' long='$long' height=400px]" );
					}
					?>
                    <span class="inner-section-divider"><i class="fa fa-envelope-o"></i></span>

					<?php if ( $contact_form == 'on' ): ?>
                        <div class="row">
                            <div class="col-sm-6">
								<?php
								if ( class_exists( 'ShaplaContactFormAJAX' ) ) {
									the_widget( 'ShaplaContactFormAJAX' );
								}
								?>
                            </div>
                            <div class="col-sm-6">
                                <div class="entry-content">
									<?php echo wpautop( $description ); ?>
                                </div>
                            </div>
                        </div>
					<?php else: ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="entry-content text-center">
									<?php echo wpautop( $description ); ?>
                                </div>
                            </div>
                        </div>
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
		$instance['title']        = strip_tags( $new_instance['title'] );
		$instance['subtitle']     = strip_tags( $new_instance['subtitle'] );
		$instance['description']  = stripslashes( wp_filter_post_kses( addslashes( $new_instance['description'] ) ) );
		$instance['lat']          = $new_instance['lat'];
		$instance['long']         = $new_instance['long'];
		$instance['contact_form'] = $new_instance['contact_form'];

		return $instance;
	}

	function form( $instance ) {
		$defaults = array(
			/* Deafult options goes here */
			'title'        => __( 'Get in Touch', 'shapla-portfolio' ),
			'subtitle'     => __( 'Call us if you need', 'shapla-portfolio' ),
			'description'  => '',
			'lat'          => '',
			'long'         => '',
			'contact_form' => 'on'
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
            <label for="<?php echo $this->get_field_id( 'lat' ); ?>"><?php _e( 'Google Map Latitude:', 'shapla-portfolio' ); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'lat' ); ?>"
                   name="<?php echo $this->get_field_name( 'lat' ); ?>" value="<?php echo $instance['lat']; ?>"/>
            <span class="description"><?php echo sprintf( __( 'Enter the latitude of Google Map, which can be found <a href="%s" target="_blank">here</a>.', 'shapla-portfolio' ), '//universimmedia.pagesperso-orange.fr/geo/loc.htm' ) ?></span>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'long' ); ?>"><?php _e( 'Google Map Longitude:', 'shapla-portfolio' ); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'long' ); ?>"
                   name="<?php echo $this->get_field_name( 'long' ); ?>" value="<?php echo $instance['long']; ?>"/>
            <span class="description"><?php _e( 'Enter the longitude of Google map.', 'shapla-portfolio' ); ?></span>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Contact Information:', 'shapla-portfolio' ); ?></label>
            <textarea rows="16" cols="20" name="<?php echo $this->get_field_name( 'description' ); ?>"
                      id="<?php echo $this->get_field_id( 'description' ); ?>"
                      class="widefat"><?php echo @$instance['description']; ?></textarea>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'contact_form' ); ?>"><?php _e( 'Show contact form', 'shapla-portfolio' ); ?>
                <input type="checkbox" id="<?php echo $this->get_field_id( 'contact_form' ); ?>"
                       name="<?php echo $this->get_field_name( 'contact_form' ); ?>"
                       value="on" <?php checked( $instance['contact_form'], 'on' ); ?>>
            </label>
            <span class="description"><br><?php _e( 'Check to show contact form from ShaplaTools', 'shapla-portfolio' ); ?></span>
        </p>

		<?php
	}

	public static function register() {
		register_widget( __CLASS__ );
	}
}

add_action( 'widgets_init', array( 'Shapla_Portfolio_Widget_Contact', 'register' ) );
