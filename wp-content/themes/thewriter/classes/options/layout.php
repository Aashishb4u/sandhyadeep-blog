<?php
Redux::setSection( $theme_options, array(
	'id' => 'sec_layout',
	'title' => esc_html__('Layout', 'thewriter'),
	'icon' => 'el el-website',
	'fields' => array(
		array(
			'id' => 'layout--boxed',
			'type' => 'select',
			'title' => esc_html__('Normal or boxed', 'thewriter'),
			'desc' => esc_html__('See that this configuration is valid to the whole website, but you can overwrite it locally in a page, for example.', 'thewriter'),
			'options' => array(
				'normal' => esc_html__('Normal', 'thewriter'),
				'boxed' => esc_html__('Boxed', 'thewriter'),
				'boxed_laterals' => esc_html__('Boxed only lateral margins', 'thewriter'),
				'bordered' => esc_html__('Bordered', 'thewriter'),
			),
			'default' => 'normal',
			'validate' => 'not_empty',
		),

			array(
				'id' => 'layout--border',
				'type' => 'border',
				'title' => esc_html__('Layout border', 'thewriter'),
				'subtitle' => esc_html__('Select a custom border to be applied in the viewport/window.', 'thewriter'),
				'all' => false,
				'style' => false,
				'required' => array('layout--boxed', '=', 'bordered'),
			),

		array(
			'id' => 'layout--sidebars',
			'type' => 'image_select',
			'title' => esc_html__( 'Sidebars', 'thewriter' ),
			'desc' => esc_html__('See that this layout is valid to the whole website, but you can overwrite it locally in a page, for example.', 'thewriter'),
			'options' => array(
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
			'default' => 'without',
		),

		array(
			'id' => 'layout--content_width',
			'type' => 'select',
			'title' => esc_html__('Content container type', 'thewriter'),
			'subtitle' => esc_html__('Define container configuration to be used, it can be normal, expanded or compact.', 'thewriter'),
			'options' => array(
				'expanded' => 'Expanded',
				'normal' => 'Normal',
				'compact' => 'Compact',
			),
			'default' => 'normal',
			'validate' => 'not_empty',
		),

		array(
			'id' => 'layout--footer_width',
			'type' => 'select',
			'title' => esc_html__('Footer container type', 'thewriter'),
			'subtitle' => esc_html__('Define container configuration to be used, it can be normal, expanded or compact.', 'thewriter'),
			'options' => array(
				'expanded' => 'Expanded',
				'normal' => 'Normal',
				'compact' => 'Compact',
			),
			'default' => 'normal',
			'validate' => 'not_empty',
		),
	)
) );
