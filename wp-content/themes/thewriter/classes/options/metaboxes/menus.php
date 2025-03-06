<?php
$boxSections[] = array(
	'title' => esc_html__('Menus', 'thewriter'),
	'desc' => esc_html__('Replace the menus to be displayed in the avaliable areas.', 'thewriter'),
	'fields' => array(
		array(
			'id' => 'local_menu--top_header',
			'type' => 'select',
			'title' => esc_html__('Top header menu', 'thewriter'),
			'desc' => esc_html__('Select a menu to overwrite the top header menu location.', 'thewriter'),
			'data' => 'menus',
			'default' => '',
		),

		array(
			'id' => 'local_menu--main',
			'type' => 'select',
			'title' => esc_html__('Main menu', 'thewriter'),
			'desc' => esc_html__('Select a menu to overwrite the header menu location.', 'thewriter'),
			'data' => 'menus',
			'default' => '',
		),

		array(
			'id' => 'local_menu--additional',
			'type' => 'select',
			'title' => esc_html__('Additional header menu', 'thewriter'),
			'desc' => esc_html__('Select a menu to overwrite the additional header menu location.', 'thewriter'),
			'data' => 'menus',
			'default' => '',
		),

		array(
			'id' => 'local_menu--popup',
			'type' => 'select',
			'title' => esc_html__('Popup menu', 'thewriter'),
			'desc' => esc_html__('Select a menu to overwrite the popup menu location.', 'thewriter'),
			'data' => 'menus',
			'default' => '',
		),

		array(
			'id' => 'local_menu--bottom_footer',
			'type' => 'select',
			'title' => esc_html__('Bottom footer menu', 'thewriter'),
			'desc' => esc_html__('Select a menu to overwrite the bottom footer menu location.', 'thewriter'),
			'data' => 'menus',
			'default' => '',
		),
	),
);