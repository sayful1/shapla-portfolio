<?php
/**
 * Shapla Portfolio Theme Customizer
 *
 * @package Shapla Portfolio
 */

/**
 * Returns the options array for shapla_portfolio
 * @since shapla_portfolio 1.0
 */
function shapla_portfolio_options($name, $default = false) {
    $options = ( get_option( 'shapla_portfolio_options' ) ) ? get_option( 'shapla_portfolio_options' ) : null;
    // return the option if it exists
    if ( isset( $options[ $name ] ) ) {
        return apply_filters( 'shapla_portfolio_options_$name', $options[ $name ] );
    }
    // return default if nothing else
    return apply_filters( 'shapla_portfolio_options_$name', $default );
}



function shapla_portfolio_get_options(){

    $default_value = array(
        'phone'                     => '',
        'email'                     => '',
        'logo'                      => '',
        'show_related_project'      => true,
        'retated_project_text'      => __('Other Projects', 'shapla-portfolio'),
        'show_portfolio_cta'        => false,
        'portfolio_cta_text'        => '',
        'cta_btn_text'              => '',
        'cta_btn_url'               => '',
        'blog_title'                => __('Blog Posts', 'shapla-portfolio'),
        'footer_text'               => sprintf(__( '<a href="%1$s">Proudly powered by WordPress</a><span> | </span>Theme: Shapla Portfolio by <a href="%2$s">Sayful Islam</a>', 'shapla-portfolio' ), 'http://wordpress.org/', 'http://sayfulit.com/'),
    );

    $options = wp_parse_args(get_option( 'shapla_portfolio_options' ), $default_value);

    return $options;
}


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function shapla_portfolio_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    /*=========================================================
    Shapla Customize Panels
    ===========================================================*/
    $wp_customize->add_panel( 'sp_general_panel', array(
        'priority'       => 1,
        'capability'     => 'edit_theme_options',
        'title'          => __( 'Theme Options', 'shapla-portfolio' ),
        'description'    => __( 'Change options for Shapla Portfolio.', 'shapla-portfolio' ),
    ) );

    /*=========================================================
    Shapla Customize Section
    ===========================================================*/
    // Logo Section - Header Panel
    $wp_customize->add_section( 'sp_portfolio_logo_section' , array(
        'title'       => __( 'Site Logo', 'shapla-portfolio' ),
        'priority'    => 1,
        'panel'  => 'sp_general_panel',
    ) );
    // Logo Section - Header Panel
    $wp_customize->add_section( 'sp_portfolio_header_section' , array(
        'title'       => __( 'Site Header', 'shapla-portfolio' ),
        'priority'    => 2,
        'panel'  => 'sp_general_panel',
    ) );
    // Copyright text - Footer Panel
    $wp_customize->add_section( 'sp_portfolio_copyright_section' , array(
        'title'       => __( 'Site Copyright Text', 'shapla-portfolio' ),
        'priority'    => 3,
        'panel'  => 'sp_general_panel',
    ) );
    // Homepage - Header Panel
    $wp_customize->add_section( 'sp_portfolio_portfolio_section' , array(
        'title'       => __( 'Portfolio Settings', 'shapla-portfolio' ),
        'priority'    => 4,
        'panel'  => 'sp_general_panel',
    ) );
    // Homepage - Header Panel
    $wp_customize->add_section( 'sp_portfolio_blog_section' , array(
        'title'       => __( 'Blog Settings', 'shapla-portfolio' ),
        'priority'    => 5,
        'panel'  => 'sp_general_panel',
    ) );

    /*=========================================================
    Shapla Customize Settings
    ===========================================================*/
    // Site Logo
    $wp_customize->add_setting( 'shapla_portfolio_options[logo]', array(
        'default'     => get_template_directory_uri() . '/assets/img/logo.png',
        'capability'  => 'edit_theme_options',
        'type'        => 'option',
        'transport'   => 'refresh',
        'sanitize_callback' => 'shapla_portfolio_url_sanitize',
        ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'shapla_portfolio_options[logo]', array(
        'label'    => __( 'Site Logo', 'shapla-portfolio' ),
        'description' => __( 'Upload your site logo. You can upload any size (widths * heights). It will automatically adjust with the theme. This logo will be shown in state of "Site Title & Tagline". ', 'shapla-portfolio' ),
        'section'  => 'sp_portfolio_logo_section',
        'settings' => 'shapla_portfolio_options[logo]',
    ) ) );

    // Topbar phone
    $wp_customize->add_setting( 'shapla_portfolio_options[phone]', array(
        'default'     => '',
        'capability'  => 'edit_theme_options',
        'type'        => 'option',
        'transport'   => 'refresh',
        'sanitize_callback' => 'shapla_portfolio_no_html',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'shapla_portfolio_options[phone]', array(
        'label'    => __( 'Topbar Phone Number', 'shapla-portfolio' ),
        'description' => __( 'Write phone number to show at topbar.', 'shapla-portfolio' ),
        'section'  => 'sp_portfolio_header_section',
        'settings' => 'shapla_portfolio_options[phone]',
        'type'     => 'text',
    ) ) );

    // Topbar email
    $wp_customize->add_setting( 'shapla_portfolio_options[email]', array(
        'default'     => '',
        'capability'  => 'edit_theme_options',
        'type'        => 'option',
        'transport'   => 'refresh',
        'sanitize_callback' => 'shapla_portfolio_email',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'shapla_portfolio_options[email]', array(
        'label'    => __( 'Topbar Email Address', 'shapla-portfolio' ),
        'description' => __( 'Write email address to show at topbar.', 'shapla-portfolio' ),
        'section'  => 'sp_portfolio_header_section',
        'settings' => 'shapla_portfolio_options[email]',
        'type'     => 'text',
    ) ) );

    // Footer Copyright text
    $wp_customize->add_setting( 'shapla_portfolio_options[footer_text]', array(
        'default'     => __( '<a href="http://wordpress.org/">Proudly powered by WordPress</a><span> | </span>Theme: Shapla Portfolio by <a href="http://sayful1.wordpress.com/">Sayful Islam</a>', 'shapla-portfolio' ),
        'capability'  => 'edit_theme_options',
        'type'        => 'option',
        'transport'   => 'refresh',
        'sanitize_callback' => 'shapla_portfolio_textarea_inline_html',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'shapla_portfolio_options[footer_text]', array(
        'label'    => __( 'Footer Text', 'shapla-portfolio' ),
        'description' => __( 'Write Footer Copyright text. Only inline html tags are allowed.', 'shapla-portfolio' ),
        'section'  => 'sp_portfolio_copyright_section',
        'settings' => 'shapla_portfolio_options[footer_text]',
        'type'     => 'textarea',
    ) ) );

    // Home page featured section
    $wp_customize->add_setting( 'shapla_portfolio_options[show_related_project]', array(
        'default'     => true,
        'capability'  => 'edit_theme_options',
        'type'        => 'option',
        'transport'   => 'refresh',
        'sanitize_callback' => 'shapla_portfolio_checkbox',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'shapla_portfolio_options[show_related_project]', array(
        'label'    => __( 'Show Related Projects?', 'shapla-portfolio' ),
        'description' => __( 'Enable to show related projects on portfolio single page.', 'shapla-portfolio' ),
        'section'  => 'sp_portfolio_portfolio_section',
        'settings' => 'shapla_portfolio_options[show_related_project]',
        'type'     => 'checkbox',
    ) ) );

    // Portfolio Page subtitle
    $wp_customize->add_setting( 'shapla_portfolio_options[retated_project_text]', array(
        'default'     => __( 'Other Projects', 'shapla-portfolio' ),
        'capability'  => 'edit_theme_options',
        'type'        => 'option',
        'transport'   => 'refresh',
        'sanitize_callback' => 'shapla_portfolio_no_html',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'shapla_portfolio_options[retated_project_text]', array(
        'label'    => __( 'Related Project Text', 'shapla-portfolio' ),
        'description' => __( 'Enter the text for related projects.', 'shapla-portfolio' ),
        'section'  => 'sp_portfolio_portfolio_section',
        'settings' => 'shapla_portfolio_options[retated_project_text]',
        'type'     => 'text',
    ) ) );

    // Home page featured section
    $wp_customize->add_setting( 'shapla_portfolio_options[show_portfolio_cta]', array(
        'default'     => true,
        'capability'  => 'edit_theme_options',
        'type'        => 'option',
        'transport'   => 'refresh',
        'sanitize_callback' => 'shapla_portfolio_checkbox',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'shapla_portfolio_options[show_portfolio_cta]', array(
        'label'    => __( 'Show Portfolio CTA?', 'shapla-portfolio' ),
        'description' => __( 'Enable to show call to action on portfolio page.', 'shapla-portfolio' ),
        'section'  => 'sp_portfolio_portfolio_section',
        'settings' => 'shapla_portfolio_options[show_portfolio_cta]',
        'type'     => 'checkbox',
    ) ) );

    // Portfolio Page subtitle
    $wp_customize->add_setting( 'shapla_portfolio_options[portfolio_cta_text]', array(
        'default'     => '',
        'capability'  => 'edit_theme_options',
        'type'        => 'option',
        'transport'   => 'refresh',
        'sanitize_callback' => 'shapla_portfolio_no_html',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'shapla_portfolio_options[portfolio_cta_text]', array(
        'label'    => __( 'CTA Text', 'shapla-portfolio' ),
        'description' => __( 'Enter the text for call to action on portfolio page.', 'shapla-portfolio' ),
        'section'  => 'sp_portfolio_portfolio_section',
        'settings' => 'shapla_portfolio_options[portfolio_cta_text]',
        'type'     => 'text',
    ) ) );

    // Portfolio Page subtitle
    $wp_customize->add_setting( 'shapla_portfolio_options[cta_btn_text]', array(
        'default'     => '',
        'capability'  => 'edit_theme_options',
        'type'        => 'option',
        'transport'   => 'refresh',
        'sanitize_callback' => 'shapla_portfolio_no_html',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'shapla_portfolio_options[cta_btn_text]', array(
        'label'    => __( 'CTA Button Text', 'shapla-portfolio' ),
        'description' => __( 'Enter the text for call to action button on portfolio page.', 'shapla-portfolio' ),
        'section'  => 'sp_portfolio_portfolio_section',
        'settings' => 'shapla_portfolio_options[cta_btn_text]',
        'type'     => 'text',
    ) ) );

    // Portfolio Page subtitle
    $wp_customize->add_setting( 'shapla_portfolio_options[cta_btn_url]', array(
        'default'     => '',
        'capability'  => 'edit_theme_options',
        'type'        => 'option',
        'transport'   => 'refresh',
        'sanitize_callback' => 'shapla_portfolio_url_sanitize',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'shapla_portfolio_options[cta_btn_url]', array(
        'label'    => __( 'CTA Button Link', 'shapla-portfolio' ),
        'description' => __( 'Enter the url for call to action button link on portfolio page.', 'shapla-portfolio' ),
        'section'  => 'sp_portfolio_portfolio_section',
        'settings' => 'shapla_portfolio_options[cta_btn_url]',
        'type'     => 'text',
    ) ) );


    // Blog page title
    $wp_customize->add_setting( 'shapla_portfolio_options[blog_title]', array(
        'default'     => __( 'Blog Posts', 'shapla-portfolio' ),
        'capability'  => 'edit_theme_options',
        'type'        => 'option',
        'transport'   => 'refresh',
        'sanitize_callback' => 'shapla_portfolio_no_html',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'shapla_portfolio_options[blog_title]', array(
        'label'    => __( 'Blog Page Title', 'shapla-portfolio' ),
        'description' => __( 'Enter the default title for the blog page header section.', 'shapla-portfolio' ),
        'section'  => 'sp_portfolio_blog_section',
        'settings' => 'shapla_portfolio_options[blog_title]',
        'type'     => 'text',
    ) ) );

    function shapla_portfolio_no_html($input) {
        //accept the input only after stripping out all html, extra white space etc!
        return sanitize_text_field($input);
    }

    function shapla_portfolio_url_sanitize($input) {
        // trim whitespace
        $valid_input    = trim($input);
        //accept the input only when the url has been sanited for database usage with esc_url_raw()
        $valid_input    = esc_url_raw($valid_input);
         
        return $valid_input;
    }
    function shapla_portfolio_textarea_inline_html($input) {
        $valid_input    = trim($input);         // trim whitespace
        $valid_input    = force_balance_tags($valid_input);     // find incorrectly nested or missing closing tags and fix markup
        $valid_input    = addslashes($valid_input);     //calls stripslashes then addslashes
        $valid_input    = wp_filter_kses($valid_input); //wp_filter_kses expects content to be escaped!
        $valid_input    = stripslashes($valid_input);   //calls stripslashes then addslashes
         
        return $valid_input;
    }
    /**
     * Sanitize a value from a list of allowed values.
     *
     * @param  mixed    $input      The value to sanitize.
     * @param  mixed    $setting    The setting for which the sanitizing is occurring.
     */
    function shapla_portfolio_choice( $input, $setting ) {
 
        global $wp_customize;
        $field = $wp_customize->get_control( $setting->id );
 
        return ( array_key_exists( $input, $field->choices ) ) ? $input : $setting->default;

    }
    /**!
     * Validation for checkbox
     */
    function shapla_portfolio_checkbox($input) {
        // Our checkbox value is either true or false
        return ($input == true) ? true : false;
    }
    /**!
     * Validation for email
     */
    function shapla_portfolio_email($input) {
        //Strips out all characters that are not allowable in an email address.
        $valid_input    = sanitize_email($input);
        //accept the input only after the email has been validated
        return (is_email($valid_input)!== FALSE) ? $valid_input : '';
    }
}
add_action( 'customize_register', 'shapla_portfolio_customize_register' );
