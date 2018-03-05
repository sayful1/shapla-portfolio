<?php

class Shapla_Portfolio_Widget_Hero extends WP_Widget {

	public function __construct() {

		// TODO: update description
		parent::__construct(
			'shapla_portfolio_widget_hero',
			__( 'Section: Static Content', 'shapla-portfolio' ),
			array(
				'classname'   => 'section-hero',
				'description' => __( 'Displays content from a specific page.', 'shapla-portfolio' )
			)
		);

	} // end constructor

	function widget( $args, $instance ) {
		// VARS FROM WIDGET SETTINGS
		$title      = apply_filters( 'widget_title', $instance['title'] );
		$bg_image   = $instance['bg_image'];
		$bg_opacity = ( isset( $instance['bg_opacity'] ) ) ? $instance['bg_opacity'] / 10 : '1';
		$bg_color   = $this->hex2RGB( $instance['bg_color'], true );
		$text_color = $instance['text_color'];
		$link_color = $instance['link_color'];
		$page       = $instance['page'];

		$data = array(
			"img_url"    => $bg_image,
			"bg_color"   => sprintf( 'rgba(%s,%s)', $bg_color, $bg_opacity ),
			"text_color" => $text_color,
			"link_color" => $link_color,
		);

		echo $args['before_widget'];

		?>
        <div class="hero-content-wrapper" data-options='<?php echo wp_json_encode( $data ); ?>'>
            <div class="hero-content-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
							<?php
							if ( ! empty( $title ) ) {
								echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
							}
							?>
                            <div class="hero-content">
								<?php
								$_page = get_post( $page );
								if ( $_page instanceof WP_Post ) {
									echo apply_filters( 'the_content', $_page->post_content );
								}
								?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

		<?php

		echo $args['after_widget'];

	}

	private function hex2RGB( $hexStr, $returnAsString = false, $seperator = ',' ) {
		$hexStr   = preg_replace( "/[^0-9A-Fa-f]/", '', $hexStr ); // Gets a proper hex string
		$rgbArray = array();
		if ( strlen( $hexStr ) == 6 ) { //If a proper hex code, convert using bitwise operation. No overhead... faster
			$colorVal          = hexdec( $hexStr );
			$rgbArray['red']   = 0xFF & ( $colorVal >> 0x10 );
			$rgbArray['green'] = 0xFF & ( $colorVal >> 0x8 );
			$rgbArray['blue']  = 0xFF & $colorVal;
		} elseif ( strlen( $hexStr ) == 3 ) { //if shorthand notation, need some string manipulations
			$rgbArray['red']   = hexdec( str_repeat( substr( $hexStr, 0, 1 ), 2 ) );
			$rgbArray['green'] = hexdec( str_repeat( substr( $hexStr, 1, 1 ), 2 ) );
			$rgbArray['blue']  = hexdec( str_repeat( substr( $hexStr, 2, 1 ), 2 ) );
		} else {
			return false; //Invalid hex color code
		}

		return $returnAsString ? implode( $seperator, $rgbArray ) : $rgbArray; // returns the rgb string or the associative array
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		// STRIP TAGS TO REMOVE HTML
		$instance['title']      = strip_tags( $new_instance['title'] );
		$instance['bg_image']   = esc_url( $new_instance['bg_image'] );
		$instance['bg_color']   = strip_tags( $new_instance['bg_color'] );
		$instance['text_color'] = strip_tags( $new_instance['text_color'] );
		$instance['link_color'] = strip_tags( $new_instance['link_color'] );
		$instance['bg_opacity'] = strip_tags( $new_instance['bg_opacity'] );
		$instance['page']       = strip_tags( $new_instance['page'] );

		return $instance;
	}

	function form( $instance ) {
		$defaults = array(
			/* Deafult options goes here */
			'title'      => 'Static Content',
			'bg_image'   => '',
			'bg_color'   => '#363f48',
			'text_color' => '#ffffff',
			'link_color' => '#dddddd',
			'bg_opacity' => 9,
			'page'       => 0,
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
            <label for="<?php echo $this->get_field_id( 'page' ); ?>"><?php _e( 'Select Page:', 'shapla-portfolio' ); ?></label>

            <select id="<?php echo $this->get_field_id( 'page' ); ?>"
                    name="<?php echo $this->get_field_name( 'page' ); ?>" class="widefat">
				<?php

				$args = array(
					'sort_order'  => 'ASC',
					'sort_column' => 'post_title',
				);

				$pages = get_pages( $args );

				foreach ( $pages as $paged ) { ?>
                    <option value="<?php echo $paged->ID; ?>" <?php if ( $instance['page'] == $paged->ID ) {
						echo "selected";
					} ?>><?php echo $paged->post_title; ?></option>
				<?php }

				?>
            </select>
            <span class="description">This page will be used to display the content.</span>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'bg_image' ); ?>"><?php _e( 'Background Image URL:', 'shapla-portfolio' ); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'bg_image' ); ?>"
                   name="<?php echo $this->get_field_name( 'bg_image' ); ?>"
                   value="<?php echo $instance['bg_image']; ?>"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'bg_color' ); ?>"><?php _e( 'Background Color:', 'shapla-portfolio' ); ?></label><br>
            <input type="text" data-default-color="<?php echo $defaults['bg_color'] ?>" class="colorpicker"
                   name="<?php echo $this->get_field_name( 'bg_color' ); ?>"
                   id="<?php echo $this->get_field_id( 'bg_color' ); ?>" value="<?php echo @$instance['bg_color']; ?>"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'bg_opacity' ); ?>"><?php _e( 'Background Opacity:', 'shapla-portfolio' ); ?></label>
            <input type="number" min='0' max='10' class="widefat"
                   id="<?php echo $this->get_field_id( 'bg_opacity' ); ?>"
                   name="<?php echo $this->get_field_name( 'bg_opacity' ); ?>"
                   value="<?php echo $instance['bg_opacity']; ?>"/>
            <span class="description">Enter value 0 to 10. 0 for full opacity and 10 for no opacity.</span>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'text_color' ); ?>"><?php _e( 'Text Color:', 'shapla-portfolio' ); ?></label><br>
            <input type="text" data-default-color="<?php echo $defaults['text_color'] ?>" class="colorpicker"
                   name="<?php echo $this->get_field_name( 'text_color' ); ?>"
                   id="<?php echo $this->get_field_id( 'text_color' ); ?>"
                   value="<?php echo @$instance['text_color']; ?>"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'link_color' ); ?>"><?php _e( 'Link Color:', 'shapla-portfolio' ); ?></label><br>
            <input type="text" data-default-color="<?php echo $defaults['link_color'] ?>" class="colorpicker"
                   name="<?php echo $this->get_field_name( 'link_color' ); ?>"
                   id="<?php echo $this->get_field_id( 'link_color' ); ?>"
                   value="<?php echo @$instance['link_color']; ?>"/>
        </p>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                if ($().wpColorPicker) {
                    $('.colorpicker').wpColorPicker();
                }
            });
        </script>
		<?php
	}

	public static function register() {
		register_widget( __CLASS__ );
	}
}

add_action( 'widgets_init', array( 'Shapla_Portfolio_Widget_Hero', 'register' ) );
