<?php
Redux::setSection( $theme_options, array(
	'id' => 'sec_search',
	'title' => esc_html__('Search', 'thewriter'),
	'desc' => esc_html__('Change search results templates and configurations.', 'thewriter'),
	'icon' => 'el el-search',
	'fields' => array(
		array(
			'id' => 'search--post_type',
			'type' => 'button_set',
			'title' => esc_html__('Search in post types', 'thewriter'),
			'options' => array(
				'all' => esc_html__('All', 'thewriter'),
				'post' => esc_html__('Only in posts', 'thewriter'),
				'product' => esc_html__('Only in products', 'thewriter'),
			),
			'default' => 'all',
		),

		array(
			'id' => 'search--layout--sidebars',
			'type' => 'image_select',
			'title' => esc_html__( 'Sidebars in search results', 'thewriter' ),
			'subtitle' => esc_html__( 'Select the layout to be used in search results.', 'thewriter' ),
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
			'id' => 'search--layout--content_width',
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
			'id' => 'search--columns',
			'type' => 'slider',
			'title' => esc_html__('Columns', 'thewriter'),
			'subtitle' => esc_html__('Define columns number at shop.', 'thewriter'),
			'default' => '3',
			'min' => '1',
			'step' => '1',
			'max' => '4',
		),

		array(
			'id' => 'search--title_wrapper_section__end',
			'type' => 'section',
			'indent' => false,
		),
	)
) );
