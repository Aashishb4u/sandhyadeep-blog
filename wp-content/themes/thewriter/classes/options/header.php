<?php
Redux::setSection( $theme_options, array(
	'id' => 'main_sec_header',
	'title' => esc_html__('Header', 'thewriter'),
	'icon' => 'el el-caret-up',
) );

Redux::setSection( $theme_options, array(
	'id' => 'sec_header',
	'title' => esc_html__('Header settings', 'thewriter'),
	'subsection' => true,
	'fields' => array(
		array(
			'id' => 'header',
			'type' => 'switch',
			'title' => esc_html__('Enable header?', 'thewriter'),
			'subtitle' => esc_html__('If on, this layout part will be displayed in website.', 'thewriter'),
			'default' => 1,
		),

		array(
			'id' => 'header--fixed',
			'type' => 'switch',
			'title' => esc_html__('Fixed header', 'thewriter'),
			'subtitle' => esc_html__('If on, the header will be fixed at screen top on page scroll.', 'thewriter'),
			'default' => 1,
		),

		array(
			'id' => 'header--negative_height',
			'type' => 'switch',
			'title' => esc_html__('Negative height', 'thewriter'),
			'subtitle' => esc_html__('If on, header and top header will not have height and background and title wrapper or content will be showed behind it.', 'thewriter'),
			'default' => 0,
		),

		array(
			'id' => 'header--boxed',
			'type' => 'switch',
			'title' => esc_html__('Boxed', 'thewriter'),
			'default' => 0,
		),

		array(
			'id' => 'header--header_width',
			'type' => 'select',
			'title' => esc_html__('Header container type', 'thewriter'),
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
			'id' => 'header--layout',
			'type' => 'image_select',
			'title' => esc_html__('Header layout', 'thewriter'),
			'options' => array(
				'layout1' => array(
					'alt' => 'Logo - Menu and Modules',
					'img' => get_template_directory_uri() . '/images/header-layouts/1.png'
				),
				'layout2' => array(
					'alt' => 'Additional Menu - Logo - Menu and Modules',
					'img' => get_template_directory_uri() . '/images/header-layouts/2.png'
				),
				'layout3' => array(
					'alt' => 'Logo / Menu and Modules',
					'img' => get_template_directory_uri() . '/images/header-layouts/3.png'
				),
				'layout4' => array(
					'alt' => 'Logo - Menu',
					'img' => get_template_directory_uri() . '/images/header-layouts/4.png'
				),
				'layout5' => array(
					'alt' => 'Additional Menu - Logo - Menu',
					'img' => get_template_directory_uri() . '/images/header-layouts/5.png'
				),
				'layout6' => array(
					'alt' => 'Logo / Menu',
					'img' => get_template_directory_uri() . '/images/header-layouts/6.png'
				),
				'layout7' => array(
					'alt' => 'Logo - Modules and Popup Menu',
					'img' => get_template_directory_uri() . '/images/header-layouts/7.png'
				),
				'layout8' => array(
					'alt' => 'Logo - Popup Menu',
					'img' => get_template_directory_uri() . '/images/header-layouts/8.png'
				),
			),
			'default' => 'layout3',
		),

		array(
			'id' => 'header--logo_dark',
			'type' => 'media',
			'title' => esc_html__('Logo (dark)', 'thewriter'),
			'subtitle' => esc_html__('Upload a dark version of logo used in light backgrounds in the header.', 'thewriter'),
			'url' => true,
		),

			array(
				'id' => 'header--logo_dark_retina',
				'type' => 'media',
				'title' => esc_html__('Logo retina (dark)', 'thewriter'),
				'subtitle' => esc_html__('Optional retina version displayed in devices with retina display (high resolution display).', 'thewriter'),
				'desc' => esc_html__('The same logo image but with twice dimensions, e.g. your logo is 100x100, then your retina logo must be 200x200.', 'thewriter'),
				'url' => true,
				'required' => array('header--logo_dark', '!=', null),
			),

		array(
			'id' => 'header--logo_light',
			'type' => 'media',
			'title' => esc_html__('Logo (light)', 'thewriter'),
			'subtitle' => esc_html__('Upload a light version of logo used in dark backgrounds in the header.', 'thewriter'),
			'url' => true,
		),

			array(
				'id' => 'header--logo_light_retina',
				'type' => 'media',
				'title' => esc_html__('Logo retina (light)', 'thewriter'),
				'subtitle' => esc_html__('Optional retina version displayed in devices with retina display (high resolution display).', 'thewriter'),
				'desc' => esc_html__('The same logo image but with twice dimensions, e.g. your logo is 100x100, then your retina logo must be 200x200.', 'thewriter'),
				'url' => true,
				'required' => array('header--logo_light', '!=', null),
			),

		array(
			'id' => 'header--color_scheme',
			'type' => 'select',
			'title' => esc_html__('Color scheme for header', 'thewriter'),
			'options' => array(
				'light' => esc_html__('Light text', 'thewriter'),
				'dark' => esc_html__('Dark text', 'thewriter'),
			),
			'default' => 'dark',
			'validate' => 'not_empty',
		),

		array(
			'id' => 'header--separator',
			'type' => 'switch',
			'title' => esc_html__('Separator between menu and modules', 'thewriter'),
			'default' => 0,
		),

		array(
			'id' => 'header--mobile_menu',
			'type' => 'switch',
			'title' => esc_html__('Mobile menu', 'thewriter'),
			'subtitle' => esc_html__('If on, a mobile menu link will be displayed on mobile devices (smaller than 768px) and main menu will be hided.', 'thewriter'),
			'default' => 1,
		),

		array(
			'id' => 'header--text',
			'type' => 'switch',
			'title' => esc_html__('Text module', 'thewriter'),
			'subtitle' => esc_html__('If on, a rich text module will be displayed.', 'thewriter'),
			'default' => 0,
		),

			array(
				'id' => 'header--text_content',
				'type' => 'editor',
				'title' => esc_html__('Text module content', 'thewriter'),
				'subtitle' => esc_html__('Place any text or shortcode to be displayed in header. Use &lt;i class="thewriter-separator"&gt;&lt;/i&gt; to add a separator in the text. Use &lt;i class="fa fa-home"&gt;&lt;/i&gt; to display Font Awesome icons.', 'thewriter'),
				'default' => '9854-888-021, New York, NY',
				'required' => array('header--text', '=', 1),
			),

		array(
			'id' => 'header--login_ajax',
			'type' => 'switch',
			'title' => esc_html__('Login With Ajax module', 'thewriter'),
			'subtitle' => esc_html__('If on, a Login With Ajax module will be displayed. Requires Login With Ajax plugin activated.', 'thewriter'),
			'default' => 1,
		),

		array(
			'id' => 'header--search',
			'type' => 'switch',
			'title' => esc_html__('Search module', 'thewriter'),
			'subtitle' => esc_html__('If on, a search module will be displayed.', 'thewriter'),
			'default' => 1,
		),

		array(
			'id' => 'header--social',
			'type' => 'switch',
			'title' => esc_html__('Social module', 'thewriter'),
			'subtitle' => esc_html__('If on, a social icon module will be displayed.', 'thewriter'),
			'default' => 0,
		),

			array(
				'id' => 'header--social_links',
				'type' => 'sortable',
				'mode' => 'checkbox',
				'title' => esc_html__('Social links', 'thewriter'),
				'subtitle' => esc_html__('Enable social links to be displayed.', 'thewriter'),
				'options' => self::$social_icons,
				'required' => array('header--social', '=', 1),
			),

		array(
			'id' => 'header--wpml_mods_section',
			'type' => 'section',
			'title' => esc_html__('WPML modules', 'thewriter'),
			'indent' => true,
		),

			array(
				'id' => 'header--wpml_lang',
				'type' => 'switch',
				'title' => esc_html__('WPML language flags', 'thewriter'),
				'subtitle' => esc_html__('If on, the avaliable languages flags will be displayed. Only works with WPML activated.', 'thewriter'),
				'default' => 0,
			),

		array(
			'id' => 'header--wpml_mods_section__end',
			'type' => 'section',
			'indent' => false,
		),
	)
) );

Redux::setSection( $theme_options, array(
	'id' => 'sec_header_styles',
	'title' => esc_html__('Header styles', 'thewriter'),
	'subsection' => true,
	'fields' => array(
		array(
			'id' => 'header_styles--border',
			'type' => 'border',
			'title' => esc_html__('Header border', 'thewriter'),
			'subtitle' => esc_html__('Select a custom border to be applied in the header.', 'thewriter'),
			'all' => false,
			'left' => false,
			'right' => false,
			'color' => false,
		),

		array(
			'id' => 'header_styles--border_color',
			'type' => 'color_rgba',
			'title' => esc_html__('Header border color', 'thewriter'),
			'subtitle' => esc_html__('Select a custom border color to be applied in the header.', 'thewriter'),
			'default' => array(
				'alpha' => 0,
			),
		),


		array(
			'id' => 'header_styles--header_menu-border',
			'type' => 'border',
			'title' => esc_html__('Header menu border', 'thewriter'),
			'subtitle' => esc_html__('Select a custom border to be applied in the header menu.', 'thewriter'),
			'all' => false,
			'bottom' => false,
			'left' => false,
			'right' => false,
			'color' => false,
		),

		array(
			'id' => 'header_styles--header_menu-border_color',
			'type' => 'color_rgba',
			'title' => esc_html__('Header menu border color', 'thewriter'),
			'subtitle' => esc_html__('Select a custom border color to be applied in the header menu.', 'thewriter'),
			'default' => array(
				'alpha' => 0,
			),
		),

		array(
			'id' => 'header_styles--padding',
			'type' => 'spacing',
			'mode' => 'padding',
			'title' => esc_html__('Header padding', 'thewriter'),
			'left' => false,
			'right' => false,
			'units' => 'px',
		),

		array(
			'id' => 'header_styles--logo_padding',
			'type' => 'spacing',
			'mode' => 'padding',
			'title' => esc_html__('Logo padding', 'thewriter'),
			'subtitle' => esc_html__('Select a custom padding to be applied in the logo.', 'thewriter'),
			'left' => false,
			'right' => false,
			'units' => 'px',
		),

		array(
			'id' => 'header_styles--menu_padding',
			'type' => 'spacing',
			'mode' => 'padding',
			'title' => esc_html__('Menu padding', 'thewriter'),
			'subtitle' => esc_html__('Select a custom padding to be applied in the menu.', 'thewriter'),
			'left' => false,
			'right' => false,
			'units' => 'px',
		),

		array(
			'id' => 'header_styles--mods_padding',
			'type' => 'spacing',
			'mode' => 'padding',
			'title' => esc_html__('Modules padding', 'thewriter'),
			'subtitle' => esc_html__('Select a custom padding to be applied in the modules.', 'thewriter'),
			'left' => false,
			'right' => false,
			'units' => 'px',
		),

		array(
			'id' => 'header_styles--additional_menu_padding',
			'type' => 'spacing',
			'mode' => 'padding',
			'title' => esc_html__('Additional menu padding', 'thewriter'),
			'subtitle' => esc_html__('Select a custom padding to be applied in the additional menu.', 'thewriter'),
			'left' => false,
			'right' => false,
			'units' => 'px',
		),

		array(
			'id' => 'header_styles--font',
			'type' => 'typography',
			'title' => esc_html__('Header typography', 'thewriter'),
			'google' => true,
			'font-backup' => true,
			'letter-spacing' => true,
			'text-transform' => true,
			'color' => false,
			'subsets' => true,
			'text-align' => false,
			'all_styles' => true,
		),

		array(
			'id' => 'header_styles--font__custom_family',
			'type' => 'text',
			'title' => esc_html__('Header typography: custom font family', 'thewriter'),
			'subtitle' => esc_html__('You can use here your Typekit fonts.', 'thewriter'),
			'default' => '',
			'placeholder' => '"proxima-nova", Arial, Helvetica, sans-serif',
			'validate' => 'no_html',
		),
	)
) );
