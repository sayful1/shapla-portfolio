<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Shapla Portfolio
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php
	wp_head();
	$options          = shapla_portfolio_get_options();
	$has_social_nav   = has_nav_menu( 'social-nav' );
	$has_contact_info = ! empty( $options['phone'] ) || ! empty( $options['email'] );
	?>
</head>

<body <?php body_class(); ?>>

<!-- PRE LOADER -->
<div class="preloader">
    <div class="status">&nbsp;</div>
</div>

<div id="page" class="hfeed site">
    <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'shapla-portfolio' ); ?></a>

	<?php if ( $has_social_nav || $has_contact_info ): ?>
        <div id="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
						<?php if ( ! empty( $options['phone'] ) || ! empty( $options['email'] ) ): ?>
                            <ul>
								<?php if ( ! empty( $options['phone'] ) ): ?>
                                    <li class="phone"><?php echo $options['phone']; ?></li>
								<?php endif; ?>
								<?php if ( ! empty( $options['email'] ) ): ?>
                                    <li class="email">
                                        <a href="mailto:<?php echo $options['email']; ?>"><?php echo $options['email']; ?></a>
                                    </li>
								<?php endif; ?>
                            </ul>
						<?php endif; ?>
                    </div>
                    <div class="col-sm-6">

						<?php if ( has_nav_menu( 'social-nav' ) ) : ?>
                            <nav id="social-navigation" class="social-navigation" role="navigation">
								<?php
								// Social links navigation menu.
								wp_nav_menu( array(
									'theme_location' => 'social-nav',
									'depth'          => 1,
									'link_before'    => '<span class="screen-reader-text">',
									'link_after'     => '</span>',
								) );
								?>
                            </nav><!-- .social-navigation -->
						<?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
	<?php endif; ?>

    <header id="masthead" class="site-header" role="banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <nav id="site-navigation" class="navbar navbar-inverse" role="navigation">
                        <div class="container-fluid">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse"
                                        data-target="#bs-example-navbar-collapse-1">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
								<?php if ( isset( $options['logo'] ) && ! empty( $options['logo'] ) ) : ?>

                                    <a class="navbar-brand logo-img" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                        <img src='<?php echo esc_url( $options['logo'] ); ?>'
                                             alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'>
                                    </a>

								<?php else : ?>

                                    <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
										<?php bloginfo( 'name' ); ?>
                                    </a>

								<?php endif; ?>
                            </div>
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
								<?php
								if ( has_nav_menu( 'primary' ) ) {
									wp_nav_menu( array(
										'menu'           => 'primary',
										'theme_location' => 'primary',
										'depth'          => 2,
										'container'      => false,
										'menu_class'     => 'nav navbar-nav navbar-right',
										'walker'         => new wp_bootstrap_navwalker()
									) );
								}
								?>
                            </div>
                        </div>
                    </nav><!-- #site-navigation -->
                </div>
            </div>
        </div>

    </header><!-- #masthead -->

    <div id="content" class="site-content">
