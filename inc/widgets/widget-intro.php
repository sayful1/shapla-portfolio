<?php
add_action('widgets_init', create_function('', 'return register_widget("shapla_portfolio_widget_intro");'));

class shapla_portfolio_widget_intro extends WP_Widget{

    public function __construct() {

        // TODO: update description
        parent::__construct(
            'shapla_portfolio_widget_intro',
            __( 'Section: Intro', 'shapla-portfolio' ),
            array(
                'classname'  => 'section-intro',
                'description' => __( 'Displays a basic intro.', 'shapla-portfolio' )
            )
        );

    } // end constructor

    function widget($args, $instance){
        extract($args);

        // VARS FROM WIDGET SETTINGS
        $content = $instance['content'];

        echo $before_widget;
        ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1><?php echo $content; ?></h1>
                </div>
            </div>
        </div>

        <?php

        echo $after_widget;

    }

    function update($new_instance, $old_instance){
        $instance = $old_instance;

        // STRIP TAGS TO REMOVE HTML
        $instance['content'] = $new_instance['content'];

        return $instance;
    }

    function form($instance){
        $defaults = array(
            /* Deafult options goes here */
            'content' => __( 'I am a <span>dedicated</span> designer who enjoys <span>awesome</span> projects.', 'shapla-portfolio' ),
        );

        $instance = wp_parse_args((array) $instance, $defaults);

    /* HERE GOES THE FORM */
    ?>

    <p>
      <textarea rows="16" cols="20" name="<?php echo $this->get_field_name( 'content' ); ?>" id="<?php echo $this->get_field_id( 'content' ); ?>" class="widefat"><?php echo @$instance['content']; ?></textarea>
      <span class="description">
          <?php _e( 'Use &lt;span&gt; tag to highlight text.', 'shapla-portfolio' ); ?>
      </span>
    </p>

    <?php
  }
}
