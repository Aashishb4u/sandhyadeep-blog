<?php
$boxSections[] = array(
	'title' => esc_html__('Title wrapper', 'thewriter'),
	'desc' => esc_html__('Change the title wrapper section configuration.', 'thewriter'),
	'fields' => array(
		array(
			'id' => 'local_title_wrapper',
			'type' => 'button_set',
			'title' => esc_html__('Enable this layout part?', 'thewriter'),
			'subtitle' => esc_html__('If on, this layout part will be displayed.', 'thewriter'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),

		array(
			'id' => 'local_title_wrapper--full_height',
			'type' => 'button_set',
			'title' => esc_html__('Full viewport height', 'thewriter'),
			'subtitle' => esc_html__('If on, title wrapper will have same height than viewport/window.', 'thewriter'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),

		array(
			'id' => 'local_title_wrapper--parallax',
			'type' => 'button_set',
			'title' => esc_html__('Parallax', 'thewriter'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),

		array(
			'id' => 'local_title_wrapper--breadcrumb',
			'type' => 'button_set',
			'title' => esc_html__('Breadcrumb', 'thewriter'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),

		array(
			'id' => 'local_title_wrapper--desc',
			'type' => 'button_set',
			'title' => esc_html__('Description after title', 'thewriter'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),

		array(
			'id' => 'local_title_wrapper--sub_title',
			'type' => 'text',
			'title' => esc_html__('Subtitle', 'thewriter'),
			'subtitle' => esc_html__('Subtitle will be displayed above the title.', 'thewriter'),
		),

		array(
			'id' => 'local_title_wrapper--desc_text',
			'type' => 'textarea',
			'title' => esc_html__('Description', 'thewriter'),
			'subtitle' => esc_html__('You can use a, strong, br, em and strong HTML tags. Use this field to display an optional text below main page title.', 'thewriter'),
			'validate' => 'html_custom',
			'allowed_html' => array(
				'a' => array(
					'href' => array(),
					'title' => array(),
					'target' => array(),
				),
				'br' => array(),
				'em' => array(),
				'strong' => array()
			),
		),

		array(
			'id' => 'local_title_wrapper_styles--padding',
			'type' => 'spacing',
			'mode' => 'padding',
			'title' => esc_html__('Title wrapper padding', 'thewriter'),
			'right' => false,
			'left' => false,
			'units' => 'px',
		),

		array(
			'id' => 'local_title_wrapper_styles--font_breadcrumb',
			'type' => 'typography',
			'title' => esc_html__('Breadcrumb typography', 'thewriter'),
			'google' => true,
			'font-backup' => true,
			'letter-spacing' => true,
			'text-transform' => true,
			'subsets' => true,
			'text-align' => false,
			'all_styles' => true,
		),

		array(
			'id' => 'local_title_wrapper_styles--font_breadcrumb__custom_family',
			'type' => 'text',
			'title' => esc_html__('Breadcrumb typography: custom font family', 'thewriter'),
			'subtitle' => esc_html__('You can use here your Typekit fonts.', 'thewriter'),
			'default' => '',
			'placeholder' => '"proxima-nova", Arial, Helvetica, sans-serif',
			'validate' => 'no_html',
		),

		array(
			'id' => 'local_title_wrapper_styles--font_title',
			'type' => 'typography',
			'title' => esc_html__('Title typography', 'thewriter'),
			'google' => true,
			'font-backup' => true,
			'letter-spacing' => true,
			'text-transform' => true,
			'subsets' => true,
			'text-align' => false,
			'all_styles' => true,
		),

		array(
			'id' => 'local_title_wrapper_styles--font_title__custom_family',
			'type' => 'text',
			'title' => esc_html__('Title typography: custom font family', 'thewriter'),
			'subtitle' => esc_html__('You can use here your Typekit fonts.', 'thewriter'),
			'default' => '',
			'placeholder' => '"proxima-nova", Arial, Helvetica, sans-serif',
			'validate' => 'no_html',
		),

		array(
			'id' => 'local_title_wrapper_styles--font_desc',
			'type' => 'typography',
			'title' => esc_html__('Description typography', 'thewriter'),
			'subtitle' => esc_html__('Typography to optional description used in pages.', 'thewriter'),
			'google' => true,
			'font-backup' => true,
			'letter-spacing' => true,
			'text-transform' => true,
			'subsets' => true,
			'text-align' => false,
			'all_styles' => true,
		),

		array(
			'id' => 'local_title_wrapper_styles--font_desc__custom_family',
			'type' => 'text',
			'title' => esc_html__('Description typography: custom font family', 'thewriter'),
			'subtitle' => esc_html__('You can use here your Typekit fonts.', 'thewriter'),
			'default' => '',
			'placeholder' => '"proxima-nova", Arial, Helvetica, sans-serif',
			'validate' => 'no_html',
		),

		array(
			'id' => 'local_title_wrapper_styles--bg',
			'type' => 'background',
			'title' => esc_html__('Title wrapper background', 'thewriter'),
			'subtitle' => esc_html__('Background image will be replaced on background pattern if you chose pattern in the next option.', 'thewriter'),
		),

		array(
			'id' => 'local_title_wrapper_styles--bg_overlay',
			'type' => 'color_rgba',
			'title' => esc_html__('Title wrapper background overlay', 'thewriter'),
			'default' => array(
				'color' => '#181c26',
				'alpha' => 0.5,
			),
		),

		array(
			'id' => 'local_title_wrapper_styles--bg_overlay_pattern',
			'type' => 'button_set',
			'title' => esc_html__('Enable dotted overlay pattern?', 'thewriter'),
			'options' => array(
				'1' => 'On',
				'0' => 'Off',
			),
			'default' => '0',
		),
	),
);