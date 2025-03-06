<?php
$boxSections[] = array(
	'title' => esc_html__('Layout', 'thewriter'),
	'desc' => esc_html__('Change the main theme\'s layout and configure it.', 'thewriter'),
	'fields' => array(
		array(
			'id' => 'local_general_styles--accent',
			'type' => 'color',
			'title' => esc_html__('Accent color', 'thewriter'),
			'subtitle' => esc_html__('Pick an accent color to overwrite the default from the theme. Usually used for links and buttons.', 'thewriter'),
			'transparent' => false,
			'validate' => 'color',
		),

		array(
			'id' => 'local_general_styles--body_background',
			'type' => 'color',
			'title' => esc_html__('Container backgound-color', 'thewriter'),
			'subtitle' => esc_html__('Pick an container background color to overwrite the default from the theme.', 'thewriter'),
			'transparent' => false,
			'default' => '#ffffff',
			'validate' => 'color',
		),

		array(
			'id' => 'local_layout--boxed',
			'type' => 'select',
			'title' => esc_html__('Normal or boxed', 'thewriter'),
			'options' => array(
				'normal' => esc_html__('Normal', 'thewriter'),
				'boxed' => esc_html__('Boxed', 'thewriter'),
				'boxed_laterals' => esc_html__('Boxed only lateral margins', 'thewriter'),
				'bordered' => esc_html__('Bordered', 'thewriter'),
			),
			'default' => '',
		),

			array(
				'id' => 'local_layout--border',
				'type' => 'border',
				'title' => esc_html__('Layout border', 'thewriter'),
				'subtitle' => esc_html__('Select a custom border to be applied in the viewport/window.', 'thewriter'),
				'all' => false,
				'style' => false,
			),

		array(
			'id' => 'local_layout--sidebars',
			'type' => 'image_select',
			'title' => esc_html__( 'Sidebars', 'thewriter' ),
			'options' => array(
				'' => array(
					'alt' => 'default',
					'img' => get_template_directory_uri() . '/images/sidebars/def.png'
				),
				'without' => array(
					'alt' => 'without sidebar',
					'img' => get_template_directory_uri() . '/images/sidebars/1c.png'
				),
				'left' => array(
					'alt' => 'sidebar at left',
					'img' => get_template_directory_uri() . '/images/sidebars/2cl.png'
				),
				'right' => array(
					'alt' => 'sidebar at right',
					'img' => get_template_directory_uri() . '/images/sidebars/2cr.png'
				),
				'both' => array(
					'alt' => 'both sidebars',
					'img' => get_template_directory_uri() . '/images/sidebars/3cm.png'
				),
				'both_left' => array(
					'alt' => 'both sidebars at left',
					'img' => get_template_directory_uri() . '/images/sidebars/3cl.png'
				),
				'both_right' => array(
					'alt' => 'both sidebars at right',
					'img' => get_template_directory_uri() . '/images/sidebars/3cr.png'
				)
			),
			'default' => '',
		),

		array(
			'id' => 'local_layout--header_width',
			'type' => 'select',
			'title' => esc_html__('Header container type', 'thewriter'),
			'subtitle' => esc_html__('Define container configuration to be used, it can be normal, expanded or compact.', 'thewriter'),
			'options' => array(
				'expanded' => 'Expanded',
				'normal' => 'Normal',
				'compact' => 'Compact',
			),
			'default' => '',
		),

		array(
			'id' => 'local_layout--content_width',
			'type' => 'select',
			'title' => esc_html__('Content container type', 'thewriter'),
			'subtitle' => esc_html__('Define container configuration to be used, it can be normal, expanded or compact.', 'thewriter'),
			'options' => array(
				'expanded' => 'Expanded',
				'normal' => 'Normal',
				'compact' => 'Compact',
			),
			'default' => '',
		),

		array(
			'id' => 'local_layout--footer_width',
			'type' => 'select',
			'title' => esc_html__('Footer container type', 'thewriter'),
			'subtitle' => esc_html__('Define container configuration to be used, it can be normal, expanded or compact.', 'thewriter'),
			'options' => array(
				'expanded' => 'Expanded',
				'normal' => 'Normal',
				'compact' => 'Compact',
			),
			'default' => '',
		),

		array(
			'id' => 'local_general_styles--bg',
			'type' => 'background',
			'title' => esc_html__('Body background', 'thewriter'),
			'subtitle' => esc_html__('Body background with image, color and other options. Usually visible only when using boxed layout. Background image will be replaced on background pattern if you chose pattern in the next option.', 'thewriter'),
		),
	),
);