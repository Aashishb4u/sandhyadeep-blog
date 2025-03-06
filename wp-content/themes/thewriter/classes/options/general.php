<?php
Redux::setSection( $theme_options, array(
	'id' => 'main_sec_general',
	'title' => esc_html__('General', 'thewriter'),
	'icon' => 'el el-dashboard',
) );

Redux::setSection( $theme_options, array(
	'id' => 'sec_general',
	'title' => esc_html__('General settings', 'thewriter'),
	'desc' => esc_html__('Configure easily the basic theme\'s settings.', 'thewriter'),
	'subsection' => true,
	'fields' => array(
		array(
			'id' => 'general--page_comments',
			'type' => 'switch',
			'title' => esc_html__('Comments in pages', 'thewriter'),
			'subtitle' => esc_html__('If on, the comment form will be avaliable in all pages.', 'thewriter'),
			'default' => 1,
		),

		array(
			'id' => 'general--responsiveness',
			'type' => 'switch',
			'title' => esc_html__('Responsive layout', 'thewriter'),
			'subtitle' => esc_html__('If on, the website will adapt in smaller devices like tablets or smartphones.', 'thewriter'),
			'default' => 1,
		),

		array(
			'id' => 'general--wp_version',
			'type' => 'switch',
			'title' => esc_html__('Meta tags in head about wordpress version', 'thewriter'),
			'subtitle' => esc_html__('If on, meta tags will be show in all pages.', 'thewriter'),
			'default' => 0,
		),

		array(
			'id' => 'general--wlwmanifest',
			'type' => 'switch',
			'title' => esc_html__('WLW manifest link in head', 'thewriter'),
			'subtitle' => esc_html__('WLW manifest link is the resource file needed to enable tagging support for Windows Live Writer.', 'thewriter'),
			'default' => 0,
		),

		array(
			'id' => 'general--rsd',
			'type' => 'switch',
			'title' => esc_html__('RSD link in head', 'thewriter'),
			'subtitle' => esc_html__('RSD link is used by blog clients, enable if you use blog clients for wordpress.', 'thewriter'),
			'default' => 0,
		),

		array(
			'id' => 'general--preloader',
			'type' => 'switch',
			'title' => esc_html__('Loader effect', 'thewriter'),
			'subtitle' => esc_html__('If on, a loader will appear before loading the page.', 'thewriter'),
			'default' => 0,
		),

		array(
			'id' => 'general--go_to_top',
			'type' => 'switch',
			'title' => esc_html__('"Go to top" button', 'thewriter'),
			'subtitle' => esc_html__('If on, "Go to top" button will be visible at bottom right corner of viewport/window.', 'thewriter'),
			'default' => 0,
		),

		array(
			'id' => 'general--typekit_kit_id',
			'type' => 'text',
			'title' => esc_html__('Typekit Kit ID', 'thewriter'),
			'subtitle' => esc_html__('Define Kit ID, if you want use Typekit fonts.', 'thewriter'),
			'default' => '',
			'validate' => 'no_html',
		),
	)
) );

Redux::setSection( $theme_options, array(
	'id' => 'sec_general_styles',
	'title' => esc_html__('General styles', 'thewriter'),
	'subsection' => true,
	'fields' => array(
		array(
			'id' => 'general_styles--accent',
			'type' => 'color',
			'title' => esc_html__('Accent color', 'thewriter'),
			'subtitle' => esc_html__('Pick an accent color to overwrite the default from the theme. Usually used for links and buttons.', 'thewriter'),
			'transparent' => false,
			'default' => '#e61638',
			'validate' => 'color',
		),

		array(
			'id' => 'general_styles--body_background',
			'type' => 'color',
			'title' => esc_html__('Container backgound-color', 'thewriter'),
			'subtitle' => esc_html__('Pick an container background color to overwrite the default from the theme.', 'thewriter'),
			'transparent' => false,
			'default' => '#ffffff',
			'validate' => 'color',
		),

		array(
			'id' => 'general_styles--font',
			'type' => 'typography',
			'title' => esc_html__('Base font', 'thewriter'),
			'subtitle' => esc_html__('Font used in the content in general, usually overwrite by local layout fonts, but used in paragraphs, lists and others.', 'thewriter'),
			'google' => true,
			'font-backup' => true,
			'letter-spacing' => true,
			'text-transform' => true,
			'subsets' => true,
			'text-align' => false,
			'all_styles' => true,
		),

		array(
			'id' => 'general_styles--font__custom_family',
			'type' => 'text',
			'title' => esc_html__('Base font: custom font family', 'thewriter'),
			'subtitle' => esc_html__('You can use here your Typekit fonts.', 'thewriter'),
			'default' => '',
			'placeholder' => '"Open Sans", Arial, Helvetica, sans-serif',
			'validate' => 'no_html',
		),

		array(
			'id' => 'general_styles--font_second',
			'type' => 'typography',
			'title' => esc_html__('Second font', 'thewriter'),
			'subtitle' => esc_html__('For menus, inputs, buttons, titles and heading elements.', 'thewriter'),
			'google' => true,
			'font-backup' => true,
			'letter-spacing' => true,
			'text-transform' => true,
			'subsets' => true,
			'text-align' => false,
			'all_styles' => true,
		),

		array(
			'id' => 'general_styles--font_second__custom_family',
			'type' => 'text',
			'title' => esc_html__('Second font: custom font family', 'thewriter'),
			'subtitle' => esc_html__('You can use here your Typekit fonts.', 'thewriter'),
			'default' => '',
			'placeholder' => '"Open Sans", Arial, Helvetica, sans-serif',
			'validate' => 'no_html',
		),

		array(
			'id' => 'general_styles--bg',
			'type' => 'background',
			'title' => esc_html__('Body background', 'thewriter'),
			'subtitle' => esc_html__('Body background with image, color and other options. Usually visible only when using boxed layout. Background image will be replaced on background pattern if you chose pattern in the next option.', 'thewriter'),
		),
	)
) );
