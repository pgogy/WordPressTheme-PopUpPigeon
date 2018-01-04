<?php

function popuppigeon_sanitize_text($str){
	return sanitize_text_field($str);
}

function popuppigeon_customize_register_modify( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'background_image' );
	
}

function popuppigeon_customize_register_article_height( $wp_customize ){

	$wp_customize->add_section( 'article_height' , array(
		'title'      => __( 'Article Height', 'pop-up-pigeon' ),
		'priority'   => 2,
	) );

	$wp_customize->add_setting(
		'article_height_setting',
		array(
			'default' => 'standard',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	 
	$wp_customize->add_control(
		'article_height_setting',
		array(
			'type' => 'radio',
			'label' => 'Article Height',
			'section' => 'article_height',
			'choices' => array(
				'standard' => 'As big as the title',
				'fixed' => 'Fixed Height (add below)',
			),
		)
	);
	
	$wp_customize->add_setting(
		'article_height_fixed',
		array(
			'default' => '300',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	 
	$wp_customize->add_control(
		'article_height_fixed',
		array(
			'type' => 'text',
			'label' => 'Specific Article Height',
			'section' => 'article_height'
		)
	);
	
}

function popuppigeon_customize_register_home_page_layout( $wp_customize ){

	$wp_customize->add_section( 'home_page_layout' , array(
		'title'      => __( 'Home Page', 'pop-up-pigeon' ),
		'priority'   => 2,
	) );

	$wp_customize->add_setting(
		'home_page',
		array(
			'default' => 'all_posts',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	 
	$wp_customize->add_control(
		'home_page',
		array(
			'type' => 'radio',
			'label' => 'Home page layout',
			'section' => 'home_page_layout',
			'choices' => array(
				'all_posts' => 'All Posts',
				'chosen_posts' => 'Chosen Posts',
				'all_categories' => 'All Categories',			
				'featured_posts' => 'Featured Posts',			
				'featured_c' => 'Selected Categories (see below)',
				'featured_c_and_p' => 'Selected Categories (see below) and featured posts',		
				'featured_p_and_c' => 'Selected Categories (see below) and featured posts',		
			),
		)
	);
	
	$post_categories = get_categories( array('exclude' => get_option("popuppigeon_featured"), 'hide_empty' => 0) );
	
	foreach($post_categories as $c){
	
		$cat = get_category( $c );
				
		$wp_customize->add_setting(
			'category_' . $c->term_id,
			array(
				'default' => 'on',
				'sanitize_callback' => 'popuppigeon_sanitize_text',
			)
		);
		 
		$wp_customize->add_control(
			'category_' . $c->term_id,
			array(
				'type' => 'radio',
				'label' => 'Display Category - ' . $cat->name,
				'section' => 'home_page_layout',
				'choices' => array(
					"on" => "Display",
					"off" => "Don't display"
				),
			)
		);

	}
	
}

function popuppigeon_customize_register_page_layout( $wp_customize ){

	$wp_customize->add_section( 'page_layout' , array(
		'title'      => __( 'Page Options', 'pop-up-pigeon' ),
		'priority'   => 2,
	) );
	
	$wp_customize->add_setting(
		'pagination',
		array(
			'default' => 'on',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	 
	$wp_customize->add_control(
		'pagination',
		array(
			'type' => 'radio',
			'label' => 'Display pagination',
			'section' => 'page_layout',
			'choices' => array(
				'on' => 'On',
				'off' => 'Off'		
			),
		)
	);
	
	$wp_customize->add_setting(
		'search',
		array(
			'default' => 'on',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	 
	$wp_customize->add_control(
		'search',
		array(
			'type' => 'radio',
			'label' => 'Display Search',
			'section' => 'page_layout',
			'choices' => array(
				'on' => 'On',
				'off' => 'Off'		
			),
		)
	);
	
	$wp_customize->add_setting(
		'author',
		array(
			'default' => 'on',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	 
	$wp_customize->add_control(
		'author',
		array(
			'type' => 'radio',
			'label' => 'Display Author',
			'section' => 'page_layout',
			'choices' => array(
				'on' => 'On',
				'off' => 'Off'		
			),
		)
	);
	
	
}

function popuppigeon_customize_register_fav_icon( $wp_customize ){
	
	$wp_customize->add_section( 'fav_icon' , array(
		'title'      => __( 'Fav Icon', 'pop-up-pigeon' ),
		'priority'   => 2,
	) );

	$wp_customize->add_setting(
		'fav_icon_url',
		array(
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'fav_icon_url',
			array(
				'label' => 'Fav Icon',
				'section' => 'fav_icon',
				'settings' => 'fav_icon_url'
			)
		)
	);
	
}

function popuppigeon_customize_register_add_site_colours( $wp_customize ) {
	
	$wp_customize->add_section( 'site_colours' , array(
		'title'      => __( 'Site Colours', 'pop-up-pigeon' ),
		'priority'   => 30,
	) );
	
	$wp_customize->add_setting(
		'site_allsite_background_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_allsite_background_colour',
			array(
				'label' => 'Site background colour',
				'section' => 'site_colours',
				'settings' => 'site_allsite_background_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_alllink_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_alllink_colour',
			array(
				'label' => 'Site Link Colour',
				'section' => 'site_colours',
				'settings' => 'site_alllink_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_alllink_hover_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_alllink_hover_colour',
			array(
				'label' => 'Site Link Hover Colour',
				'section' => 'site_colours',
				'settings' => 'site_alllink_hover_colour'
			)
		)
	);

	
	$wp_customize->add_setting(
		'site_post_background_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_post_background_colour',
			array(
				'label' => 'Site Post Background Colour',
				'section' => 'site_colours',
				'settings' => 'site_post_background_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_alltext_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_alltext_colour',
			array(
				'label' => 'Site Text Colour',
				'section' => 'site_colours',
				'settings' => 'site_alltext_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_title_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_title_colour',
			array(
				'label' => 'Site Article Title Colour',
				'section' => 'site_colours',
				'settings' => 'site_title_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_header_background_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_header_background_colour',
			array(
				'label' => 'Site Header Background Colour',
				'section' => 'site_colours',
				'settings' => 'site_header_background_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_header_text_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_header_text_colour',
			array(
				'label' => 'Site Header Text Colour',
				'section' => 'site_colours',
				'settings' => 'site_header_text_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_title_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_title_colour',
			array(
				'label' => 'Site Title Colour',
				'section' => 'site_colours',
				'settings' => 'site_title_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_menu_background_hover_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_menu_background_hover_colour',
			array(
				'label' => 'Site Menu Background Hover Colour',
				'section' => 'site_colours',
				'settings' => 'site_menu_background_hover_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_menu_background_current_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_menu_background_current_colour',
			array(
				'label' => 'Site Menu Current Page Colour',
				'section' => 'site_colours',
				'settings' => 'site_menu_background_current_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_menu_text_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_menu_text_colour',
			array(
				'label' => 'Site Menu Text Colour',
				'section' => 'site_colours',
				'settings' => 'site_menu_text_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_menu_text_hover_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_menu_text_hover_colour',
			array(
				'label' => 'Site Menu Text Hover Colour',
				'section' => 'site_colours',
				'settings' => 'site_menu_text_hover_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_button_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_button_colour',
			array(
				'label' => 'Site Button Colour',
				'section' => 'site_colours',
				'settings' => 'site_button_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_button_text_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_button_text_colour',
			array(
				'label' => 'Site Button Text Colour',
				'section' => 'site_colours',
				'settings' => 'site_button_text_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_left_sidebar_background_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_left_sidebar_background_colour',
			array(
				'label' => 'Site Right Sidebar Background Colour',
				'section' => 'site_colours',
				'settings' => 'site_left_sidebar_background_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_left_sidebar_text_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_left_sidebar_text_colour',
			array(
				'label' => 'Site right Sidebar Text Colour',
				'section' => 'site_colours',
				'settings' => 'site_left_sidebar_text_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_left_sidebar_link_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_left_sidebar_link_colour',
			array(
				'label' => 'Site Right Sidebar Link Colour',
				'section' => 'site_colours',
				'settings' => 'site_left_sidebar_link_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_bottom_sidebar_background_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_bottom_sidebar_background_colour',
			array(
				'label' => 'Site Bottom Sidebar Background Colour',
				'section' => 'site_colours',
				'settings' => 'site_bottom_sidebar_background_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_bottom_sidebar_text_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_bottom_sidebar_text_colour',
			array(
				'label' => 'Site Bottom Sidebar Text Colour',
				'section' => 'site_colours',
				'settings' => 'site_bottom_sidebar_text_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_bottom_sidebar_link_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_bottom_sidebar_link_colour',
			array(
				'label' => 'Site Bottom Sidebar Link Colour',
				'section' => 'site_colours',
				'settings' => 'site_bottom_sidebar_link_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'pagination_background_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'pagination_background_colour',
			array(
				'label' => 'Pagination Background Colour',
				'section' => 'site_colours',
				'settings' => 'pagination_background_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'pagination_current_background_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'pagination_current_background_colour',
			array(
				'label' => 'Pagination Current Page Background Colour',
				'section' => 'site_colours',
				'settings' => 'pagination_current_background_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'pagination_link_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'pagination_link_colour',
			array(
				'label' => 'Pagination Link Colour',
				'section' => 'site_colours',
				'settings' => 'pagination_link_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'page_border_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'page_border_colour',
			array(
				'label' => 'Page Circle Border Colour',
				'section' => 'site_colours',
				'settings' => 'page_border_colour'
			)
		)
	);
	
	$wp_customize->add_setting(
		'site_name_border_colour',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_name_border_colour',
			array(
				'label' => 'Site Name Border Colour',
				'section' => 'site_colours',
				'settings' => 'site_name_border_colour'
			)
		)
	);
	
}

function popuppigeon_customize_register_new_background( $wp_customize ) {

	$wp_customize->add_section( 'bkg_theme' , array(
		'title'      => __( 'Site Backgrounds', 'pop-up-pigeon' ),
		'priority'   => 2,
	) );

	$wp_customize->add_setting(
		'bkgsetting',
		array(
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	 
	$wp_customize->add_control(
		new popuppigeonMultiImageBackground( 
			$wp_customize, 
			'bkgsetting', 
			array(
				'label'      => __( 'Multiple Backgrounds', 'pop-up-pigeon' ),
				'section'    => 'bkg_theme',
				'settings'   => 'bkgsetting',
				'priority'   => 1
			)
		)
	);
	
}

function popuppigeon_customize_register_front_page_posts( $wp_customize ) {

	$wp_customize->add_section( 'front_page_posts' , array(
		'title'      => __( 'Front page posts', 'pop-up-pigeon' ),
		'priority'   => 2,
	) );

	$wp_customize->add_setting(
		'front_page_posts_list',
		array(
			'sanitize_callback' => 'popuppigeon_sanitize_text',
		)
	);
	 
	$wp_customize->add_control(
		new popuppigeonCustomFrontPage( 
			$wp_customize, 
			'front_page_posts_list', 
			array(
				'label'      => __( 'Front Page Posts', 'pop-up-pigeon' ),
				'section'    => 'front_page_posts',
				'settings'   => 'front_page_posts_list',
				'priority'   => 1
			)
		)
	);
	
}

function popuppigeon_customize_register( $wp_customize ) {

	popuppigeon_customize_register_new_background( $wp_customize );
	popuppigeon_customize_register_front_page_posts( $wp_customize );
	popuppigeon_customize_register_modify( $wp_customize );
	popuppigeon_customize_register_add_site_colours( $wp_customize );
	popuppigeon_customize_register_page_layout( $wp_customize );
	popuppigeon_customize_register_home_page_layout( $wp_customize );
	popuppigeon_customize_register_fav_icon( $wp_customize );
	popuppigeon_customize_register_article_height( $wp_customize );
	
}
add_action( 'customize_register', 'popuppigeon_customize_register' );


function popuppigeon_customize_preview_js() {
	wp_enqueue_script( 'popuppigeon_customizer', get_template_directory_uri() . '/js/popuppigeon_customiser.js', array( 'customize-preview' ), '20131205', true );
}
add_action( 'customize_preview_init', 'popuppigeon_customize_preview_js' );

require_once( ABSPATH . WPINC . '/class-wp-customize-setting.php' );
require_once( ABSPATH . WPINC . '/class-wp-customize-section.php' );
require_once( ABSPATH . WPINC . '/class-wp-customize-control.php' );
require get_template_directory() . '/inc/custom_backgrounds.php';
require get_template_directory() . '/inc/custom_front_page.php';