<?php
Redux::setSection( $theme_options, array(
	'id' => 'main_sec_top_header',
	'title' => esc_html__('Top header', 'thewriter'),
	'icon' => 'el el-chevron-up',
) );

Redux::setSection( $theme_options, array(
	'id' => 'sec_top_header',
	'title' => esc_html__('Top header settings', 'thewriter'),
	'subsection' => true,
	'fields' => array(
		array(
			'id' => 'top_header',
			'type' => 'switch',
			'title' => esc_html__('Enable this layout part?', 'thewriter'),
			'subtitle' => esc_html__('If on, this layout part will be displayed.', 'thewriter'),
			'default' => 0,
		),

		array(
			'id' => 'top_header--left_cols_sm',
			'type' => 'slider',
			'title' => esc_html__('Left area columns', 'thewriter'),
			'subtitle' => esc_html__('Define columns number of top header left area.', 'thewriter'),
			'default' => '4',
			'min' => '0',
			'step' => '1',
			'max' => '12',
		),

		array(
			'id' => 'top_header--right_cols_sm',
			'type' => 'slider',
			'title' => esc_html__('Right area columns', 'thewriter'),
			'subtitle' => esc_html__('Define columns number of top header right area.', 'thewriter'),
			'default' => '8',
			'min' => '0',
			'step' => '1',
			'max' => '12',
		),

		array(
			'id' => 'top_header--header_width',
			'type' => 'select',
			'title' => esc_html__('Top header container type', 'thewriter'),
			'subtitle' => esc_html__('Define container configuration to be used, it can be normal, expanded or compact.', 'thewriter'),
			'options' => array(
				'expanded' => 'Expanded',
				'normal' => 'Normal',
				'compact' => 'Compact',
			),
			'default' => 'expanded',
			'validate' => 'not_empty',
		),

		array(
			'id' => 'top_header--menu',
			'type' => 'switch',
			'title' => esc_html__('Menu', 'thewriter'),
			'subtitle' => esc_html__('If on, menu will be displayed.', 'thewriter'),
			'default' => 0,
		),

			array(
				'id' => 'top_header--menu_left',
				'type' => 'switch',
				'title' => esc_html__('Menu at left area', 'thewriter'),
				'subtitle' => esc_html__('If on, menu will display at left area of top header.', 'thewriter'),
				'default' => 0,
				'required' => array('top_header--menu', '=', 1),
			),

		array(
			'id' => 'top_header--login_ajax',
			'type' => 'switch',
			'title' => esc_html__('Login With Ajax module', 'thewriter'),
			'subtitle' => esc_html__('If on, a Login With Ajax module will be displayed. Requires Login With Ajax plugin activated.', 'thewriter'),
			'default' => 1,
		),

		array(
			'id' => 'top_header--search',
			'type' => 'switch',
			'title' => esc_html__('Search module', 'thewriter'),
			'subtitle' => esc_html__('If on, a search module will be displayed.', 'thewriter'),
			'default' => 1,
		),

		array(
			'id' => 'top_header--text',
			'type' => 'switch',
			'title' => esc_html__('Text module', 'thewriter'),
			'subtitle' => esc_html__('If on, a rich text module will be displayed.', 'thewriter'),
			'default' => 0,
		),

			array(
				'id' => 'top_header--text_content',
				'type' => 'editor',
				'title' => esc_html__('Text module content', 'thewriter'),
				'subtitle' => esc_html__('Place any text to be displayed in top header.', 'thewriter'),
				'default' => '9854-888-021 | New York, NY',
				'required' => array('top_header--text', '=', 1),
			),

		array(
			'id' => 'top_header--social',
			'type' => 'switch',
			'title' => esc_html__('Social module', 'thewriter'),
			'subtitle' => esc_html__('If on, a social icon module will be displayed.', 'thewriter'),
			'default' => 0,
		),

			array(
				'id' => 'top_header--social_links',
				'type' => 'sortable',
				'mode' => 'checkbox',
				'title' => esc_html__('Social links', 'thewriter'),
				'subtitle' => esc_html__('Enable social links to be displayed.', 'thewriter'),
				'options' => self::$social_icons,
				'required' => array('top_header--social', '=', 1),
			),

		array(
			'id' => 'top_header--wpml_modules_section',
			'type' => 'section',
			'title' => esc_html__('WPML modules', 'thewriter'),
			'indent' => true,
		),

			array(
				'id' => 'top_header--wpml_lang',
				'type' => 'switch',
				'title' => esc_html__('WPML language flags', 'thewriter'),
				'subtitle' => esc_html__('If on, the avaliable languages flags will be displayed. Only works with WPML activated.', 'thewriter'),
				'default' => 0,
			),

		array(
			'id' => 'top_header--wpml_modules_section__end',
			'type' => 'section',
			'indent' => false,
		),
	)
) );

Redux::setSection( $theme_options, array(
	'id' => 'sec_top_header_styles',
	'title' => esc_html__('Top header styles', 'thewriter'),
	'subsection' => true,
	'fields' => array(
		array(
			'id' => 'top_header_styles--border',
			'type' => 'border',
			'title' => esc_html__('Top header border', 'thewriter'),
			'subtitle' => esc_html__('Select a custom border to be applied in the top header.', 'thewriter'),
			'all' => false,
			'left' => false,
			'right' => false,
		),

		array(
			'id' => 'top_header_styles--padding',
			'type' => 'spacing',
			'mode' => 'padding',
			'title' => esc_html__('Top header padding', 'thewriter'),
			'left' => false,
			'right' => false,
			'units' => 'px',
		),

		array(
			'id' => 'top_header_styles--bg',
			'type' => 'background',
			'title' => esc_html__('Top header background', 'thewriter'),
			'subtitle' => esc_html__('Background image will be replaced on background pattern if you chose pattern in the next option.', 'thewriter'),
		),

		array(
			'id' => 'top_header_styles--font',
			'type' => 'typography',
			'title' => esc_html__('Top header typography', 'thewriter'),
			'google' => true,
			'font-backup' => true,
			'letter-spacing' => true,
			'text-transform' => true,
			'subsets' => true,
			'text-align' => false,
			'all_styles' => true,
		),

		array(
			'id' => 'top_header_styles--font__custom_family',
			'type' => 'text',
			'title' => esc_html__('Top header typography: custom font family', 'thewriter'),
			'subtitle' => esc_html__('You can use here your Typekit fonts.', 'thewriter'),
			'default' => '',
			'placeholder' => '"proxima-nova", Arial, Helvetica, sans-serif',
			'validate' => 'no_html',
		),
	)
) );
