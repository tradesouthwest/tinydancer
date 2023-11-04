<?php 
/**
 * Page options settings and helpers
 * @since 1.0
 * @package tinydancer
 */
// #A1
add_action( 'tinydancer_theme_customizer', 'tinydancer_theme_customizer_css' );
		
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

/** A1
 * Send custum CSS to wp_head
 * @since 1.0
 * 
 */
function tinydancer_theme_customizer_css() {
    $styles = '';
    $styles .= '<style id="tinydancer-theme-mods">';

    if ( get_theme_mods() ) : 
        $background_color = get_background_color();
        
        
            $cpaddg = get_theme_mod( 'tinydancer_padding_content' );
            $pcolor = get_theme_mod( 'tinydancer-font-color' );
            $dloop  = get_theme_mod( 'tinydancer_blog_layout' ); 
            $calign = get_theme_mod( 'tinydancer_content_align' ); 
            $cposit = (empty(get_theme_mod( 'tinydancer_hero_callposition' ) ) )
                    ? '12' : get_theme_mod( 'tinydancer_hero_callposition' ); 
            $hheight = (empty(get_theme_mod( 'tinydancer_hero_bkgheight' ) ) ) 
                    ? '520' : get_theme_mod( 'tinydancer_hero_bkgheight' ); 
        

    $styles .= 'body{ background-color: #' . esc_attr( $background_color ) . ';}.section-content{ padding: ' . esc_attr( $cpaddg ) . 'px;text-align:' . esc_attr( $calign ) .'; }.section-sidebar{padding-top: ' . esc_attr( $cpaddg ) . 'px;}.hero-inner-content{height: calc( '. absint($hheight).'px - 10vh ); }.page-header{padding: calc(.5 * ' . esc_attr( $cpaddg ) . 'px);padding-bottom: 0;}.dancer-loop{flex-direction: ' . esc_attr( $dloop ) . ';}div > *:not([style]), p, .entry-content, .excerpt-content, li, h2, h3, h4 {color: ' . esc_attr( $pcolor ) . ';}
            .call-to-action{top: '. esc_attr( $cposit ) . 'em;}';
    
    endif;
    $styles .= '</style>';
    echo $styles;
}
