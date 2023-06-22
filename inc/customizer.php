<?php
/**
 * tinyDancer Customizer functionality
 *
 * @package tinydancer
 * @subpackage inc/tinydancer
 * @since 1.0
 * 
 * @see https://developer.wordpress.org/reference/classes/wp_customize_manager/add_setting/
 */

/** TODO 
 * suport footer background & text color
 * header background & color
 * page background & color
 */ 

add_action( 'customize_register', 'tinydancer_register_theme_customizer_setup' );

/**
 * Remove parts of the Options menu we don't use.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 * @since 1.0.2
*/

function tinydancer_register_theme_customizer_setup($wp_customize)
{
	$transport = 'postMessage'; 
    // Theme font choice section
    $wp_customize->add_section( 'title_tagline', array(
        'title'       => __( 'Theme Headings', 'tinydancer' ),
        'capability'  => 'edit_theme_options',
		'priority'    => 15
    ) );
	// Add hero section
    $wp_customize->add_section( 'tinydancer_hero', array(
		'title' => 'Hero and Headings Section',
		'priority' => 20
	  ));

    //-----------------Settings and Controls ----------------------------------
	
	// Add setting & control for hero h2
    $wp_customize->add_setting( 'tinydancer_hero_title', array(
		'default' => '',
		'transport' => $transport
	));
	$wp_customize->add_control( 'tinydancer_hero_title', array(
		'label'   => 'Title',
		'section'  => 'tinydancer_hero',
		'settings'  => 'tinydancer_hero_title',
		'type'       => 'text',
		'description' => __( 'Change colors in Additional CSS section. ".hero-title"', 'tinydancer')
	));
	$wp_customize->add_setting( 'tinydancer_hero_heading', array(
		'default' => '',
		'transport' => $transport
	));
	// hero h3 control
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
        'tinydancer_hero_heading',
		array('label' => __( 'Hero Heading', 'tinydancer' ),
			'section'  => 'tinydancer_hero',
			'settings'  => 'tinydancer_hero_heading',
			'type'       => 'text',
			'description' => __( 'Change colors in Additional CSS section. ".hero-heading"', 'tinydancer')
		) ) 
    );  
	  // Add setting & control for hero image
	  $wp_customize->add_setting( 'tinydancer_hero_image', array(
		'default' => get_template_directory_uri() . '/imgs/default-hero.jpg',
		'transport' => $transport
	  ));
  
	$wp_customize->add_control(
		new WP_Customize_Cropped_Image_Control( 
	$wp_customize, 'tinydancer_hero_image', array(
		  'label' => 'Image',
		  'section' => 'tinydancer_hero',
		  'context' => 'hero-image',
		  'flex_width' => false,
		  'flex_height' => true,
		  'width' => 1080,
		  'height' => 520
		) )
	);
	$wp_customize->add_setting( 'tinydancer_padding_content', array(
		'default' => '',
		'transport' => $transport
	));
	$wp_customize->add_control( 'tinydancer_padding_content', array(
		'label'   => 'Content Padding',
		'section'  => 'tinydancer_hero',
		'settings'  => 'tinydancer_padding_content',
		'type'       => 'number',
		'description' => __( 'Change padding space of Content sections.', 'tinydancer')
	));

	$wp_customize->add_setting(
		'tinydancer-font-color',
		array(
			'default' => '#444444',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	 
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'tinydancer-font-color',
			array(
				'label' => 'Font Color',
				'section' => 'colors',
				'settings' => 'tinydancer-font-color'
			)
		)
	);

}
// Easy Boolean checker for checkbox
function tinydancer_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
} 
