<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package tinyDancer
 * @since   1.0
 */

?><!DOCTYPE html>
<html>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#sitecontent"><?php _e( 'Skip to content', 'classicsixteen' ); ?></a>
    <div class="page">
        <header class="page-header">
        <?php 
                if( has_custom_logo() ) : ?>
                <div class="site-logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    <?php echo wp_kses_post( force_balance_tags( 
                        tinydancer_theme_custom_logo() ) ); ?></a>
                </div>
                <?php endif; ?>
            <div class="page-header-inner">
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <div class="site-description"><?php echo get_bloginfo( 'description', 'display' ); ?></div>
            </div>
        </header>
            <div class="nav-container">
                <!--<fieldset class="toggle-page-nav">
                <input type="checkbox" id="menu-toggle">
                <label for="menu-toggle" class="label-toggle">menu</label>
                    </fieldset>-->
                <nav id="main__nav" class="page-nav-wrapper">
                    
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary-menu',
                            'menu_class' => 'page-nav',
                        )
                    );
                    ?>
                
                </nav>
            </div>
