<?php 
/**
 * Page options settings and helpers
 * @since 1.0
 * @package tinydancer
 */
add_action( 'wp_head', 'tinydancer_theme_customizer_css');
/**
 * Text sanitizer for numeric values
 * @since 1.0
 * @see https://themefoundation.com/wordpress-theme-customizer/
 * @return string $input
 */
function tinydancer_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
} 

/**
 * Text sanitizer for outputs
 * @since 1.0
 * 
 * @return string $input
 */
function tinydancer_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Send custum CSS to wp_head
 * @since 1.0
 * 
 */
function tinydancer_theme_customizer_css() {
    if ( get_theme_mods() ) : 
        $background_color = get_background_color();
        echo '<style id="tinydancer-theme-mods">';
        if ( get_theme_mod( 'tinydancer-font-color' ) ) :
            $cpaddg = get_theme_mod( 'tinydancer_padding_content' );
            $pcolor = get_theme_mod( 'tinydancer-font-color' );
            $dloop  = get_theme_mod( 'tinydancer_blog_layout' ); 
            echo 'body{ background-color: #' . esc_attr( $background_color ) . ';}.section-content{ padding: ' . esc_attr( $cpaddg ) . 'px; }.section-sidebar{padding-top: ' . esc_attr( $cpaddg ) . 'px;}.dancer-loop{flex-direction: ' . esc_attr( $dloop ) . ';}p, .entry-content, .excerpt-content, li, h2, h3, h4 {color: ' . esc_attr( $pcolor ) . ';}';
        endif;
        echo '</style>';
    endif;
}
