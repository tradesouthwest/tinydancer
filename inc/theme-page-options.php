<?php 
/**
 * Page options settings
 */
// A1
//add_action( 'tinydancer_hero_heading', 'tinydancer_hero_heading_render', 9 );

/** #A1
 * Render text h4 hero heading
 * @since 1.0
 * @return string Text only wrapped in h4 tag
 */
function tinydancer_hero_heading_render(){

    $heading = get_theme_mod( 'tinydancer_hero_heading', 'site' );
    //tinyDancer is a minimalistic tiny flex based theme templated for general website use. Has a Hero section template for a home (or any) page. Basic content sections are seventy percent and thirty percent widths. Footer is full width with three widget sections.";
return $heading;
}