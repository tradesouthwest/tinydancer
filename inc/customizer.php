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
 * TODO module selection checkboxes. pagination prev next post
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
	// Add layout section
    $wp_customize->add_section( 'tinydancer_layout', array(
		'title' => 'Blog and Page Settings',
		'priority' => 25
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
	$wp_customize->add_control( new WP_Customize_Control( 
		$wp_customize, 'tinydancer_hero_heading',
		array('label' => __( 'Hero Heading', 'tinydancer' ),
			'section'  => 'tinydancer_hero',
			'settings'  => 'tinydancer_hero_heading',
			'type'       => 'text',
			'description' => __( 'Change colors in Additional CSS section. ".hero-heading"', 'tinydancer')
		) ) 
    );  
	  // Add setting & control for hero image
	  $wp_customize->add_setting( 'tinydancer_hero_image', array(
		'default' => '', //get_template_directory_uri() . '/imgs/default-hero.jpg',
		'transport' => 'refresh'
	  ));
  
	$wp_customize->add_control(	new WP_Customize_Cropped_Image_Control( 
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
	$wp_customize->add_setting( 'tinydancer_hero_calltotext', array(
		'default' => '',
		'transport' => 'refresh'
	));
	$wp_customize->add_control( 'tinydancer_hero_calltotext', array(
		'label'   => 'Call To Action Button Text',
		'section'  => 'tinydancer_hero',
		'settings'  => 'tinydancer_hero_calltotext',
		'type'       => 'text',
		'description' => __( 'Leave blank to remove/not show button.', 'tinydancer')
	));
	$wp_customize->add_setting( 'tinydancer_hero_calltourl', array(
		'default' => '',
		'transport' => $transport
	));
	$wp_customize->add_control( 'tinydancer_hero_calltourl', array(
		'label'   => 'Call To Action Button URL',
		'section'  => 'tinydancer_hero',
		'settings'  => 'tinydancer_hero_calltourl',
		'type'       => 'url',
		'description' => __( 'Styles for button are using ".cta-tinyd"', 'tinydancer')
	));
	$wp_customize->add_setting( 'tinydancer_hero_callposition', array(
		'default' => '4',
		'transport' => 'refresh'
	));
	$wp_customize->add_control( 'tinydancer_hero_callposition', array(
		'label'   => 'Call To Action Position',
		'section'  => 'tinydancer_hero',
		'settings'  => 'tinydancer_hero_callposition',
		'type'       => 'number',
		'description' => __( 'Vertical positioning only. Uses em not px. Decimals OK.', 'tinydancer')
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
	// Add setting & control for hero h2
    $wp_customize->add_setting( 'tinydancer_blog_layout', array(
		'default' => 'column',
		'transport' => $transport
	));
	$wp_customize->add_control( 'tinydancer_blog_layout', array(
		'label'   => 'Display Blog Posts',
		'section'  => 'tinydancer_layout',
		'settings'  => 'tinydancer_blog_layout',
		'description' => __( 'Choose how to set posts on blog page. Column or Row?', 'tinydancer'),
		'type'        => 'select',
    	'choices'     => array(
        	'default' => 'Select Layout',
        	'row'     => 'Row',
        	'column'  => 'Column',
    		)
	));
	// Add setting & control for content alignment
    $wp_customize->add_setting( 'tinydancer_content_align', array(
		'default' => 'justify',
		'transport' => 'refresh'
	));
	$wp_customize->add_control( 'tinydancer_content_align', array(
		'label'   => 'Text Align Style for Content',
		'section'  => 'tinydancer_layout',
		'settings'  => 'tinydancer_content_align',
		'description' => __( 'Choose the text alignment for central content.', 'tinydancer'),
		'type'        => 'select',
    	'choices'     => array(
        	'default' => 'Default/Justify',
        	'left'    => 'Left',
			'right'   => 'Right',
        	'justify' => 'Justify',
			'center'  => 'Center',
    		)
	));
	$wp_customize->add_setting( 'tinydancer_padding_content', array(
		'default' => '',
		'transport' => $transport
	));
	$wp_customize->add_control( 'tinydancer_padding_content', array(
		'label'   => 'Content Padding',
		'section'  => 'tinydancer_layout',
		'settings'  => 'tinydancer_padding_content',
		'type'       => 'number',
		'description' => __( 'Change padding space of Content sections.', 'tinydancer')
	));
}  
