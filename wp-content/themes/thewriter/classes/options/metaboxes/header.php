<?php
$boxSections[] = array(
	'title' => esc_html__('Header', 'thewriter'),
	'desc' => esc_html__('Change the header section configuration.', 'thewriter'),
	'fields' => array(
		array(
			'id' => 'local_header',
			'type' => 'button_set',
			'title' => esc_html__('Enable header?', 'thewriter'),
			'subtitle' => esc_html__('If on, this layout part will be displayed in website.', 'thewriter'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),

		array(
			'id' => 'local_header--fixed',
			'type' => 'button_set',
			'title' => esc_html__('Fixed header', 'thewriter'),
			'subtitle' => esc_html__('If on, the header will be fixed at screen top on page scroll.', 'thewriter'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),

		array(
			'id' => 'local_header--negative_height',
			'type' => 'button_set',
			'title' => esc_html__('Negative height', 'thewriter'),
			'subtitle' => esc_html__('If on, header and top header will not have height and background and title wrapper or content will be showed behind it.', 'thewriter'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),

		array(
			'id' => 'local_header--boxed',
			'type' => 'button_set',
			'title' => esc_html__('Boxed', 'thewriter'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),

		array(
			'id' => 'local_header--layout',
			'type' => 'image_select',
			'title' => esc_html__('Header layout', 'thewriter'),
			'options' => array(
				'' => array(
					'alt' => 'default',
					'img' => get_template_directory_uri() . '/images/sidebars/def.png'
				),
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
			'default' => '',
		),

		array(
			'id' => 'local_header--color_scheme',
			'type' => 'select',
			'title' => esc_html__('Color scheme for header', 'thewriter'),
			'options' => array(
				'light' => esc_html__('Light text', 'thewriter'),
				'dark' => esc_html__('Dark text', 'thewriter'),
			),
			'default' => '',
		),

		array(
			'id' => 'local_header--separator',
			'type' => 'button_set',
			'title' => esc_html__('Separator between menu and modules', 'thewriter'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),

		array(
			'id' => 'local_header--mobile_menu',
			'type' => 'button_set',
			'title' => esc_html__('Mobile menu', 'thewriter'),
			'subtitle' => esc_html__('If on, a mobile menu link will be displayed on mobile devices (smaller than 768px) and main menu will be hided.', 'thewriter'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),

		array(
			'id' => 'local_header--text',
			'type' => 'button_set',
			'title' => esc_html__('Text module', 'thewriter'),
			'subtitle' => esc_html__('If on, a rich text module will be displayed.', 'thewriter'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),

			array(
				'id' => 'local_header--text_content',
				'type' => 'editor',
				'title' => esc_html__('Text module content', 'thewriter'),
				'subtitle' => esc_html__('Place any text or shortcode to be displayed in header. Use &lt;i class="thewriter-separator"&gt;&lt;/i&gt; to add a separator in the text. Use &lt;i class="fa fa-home"&gt;&lt;/i&gt; to display Font Awesome icons.', 'thewriter'),
				'default' => '',
				'required' => array('local_header--text', '=', 1),
			),

		array(
			'id' => 'local_header--login_ajax',
			'type' => 'button_set',
			'title' => esc_html__('Login With Ajax', 'thewriter'),
			'subtitle' => esc_html__('If on, a Login With Ajax module will be displayed. Requires Login With Ajax plugin activated.', 'thewriter'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),

		array(
			'id' => 'local_header--search',
			'type' => 'button_set',
			'title' => esc_html__('Search', 'thewriter'),
			'subtitle' => esc_html__('If on, a search module will be displayed.', 'thewriter'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),

		array(
			'id' => 'local_header--social',
			'type' => 'button_set',
			'title' => esc_html__('Social module', 'thewriter'),
			'subtitle' => esc_html__('If on, a social icon module will be displayed.', 'thewriter'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),

		array(
			'id' => 'local_header_styles--border',
			'type' => 'border',
			'title' => esc_html__('Header border', 'thewriter'),
			'subtitle' => esc_html__('Select a custom border to be applied in the header.', 'thewriter'),
			'all' => false,
			'left' => false,
			'right' => false,
			'style' => false,
			'color' => false,
		),

		array(
			'id' => 'local_header_styles--font',
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
			'id' => 'local_header_styles--font__custom_family',
			'type' => 'text',
			'title' => esc_html__('Header typography: custom font family', 'thewriter'),
			'subtitle' => esc_html__('You can use here your Typekit fonts.', 'thewriter'),
			'default' => '',
			'placeholder' => '"proxima-nova", Arial, Helvetica, sans-serif',
			'validate' => 'no_html',
		),
	),
);