<?php
$boxSections[] = array(
	'title' => esc_html__('Footer', 'thewriter'),
	'desc' => esc_html__('Change the footer section configuration.', 'thewriter'),
	'fields' => array(
		array(
			'id' => 'local_footer',
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
			'id' => 'local_footer--fixed',
			'type' => 'button_set',
			'title' => esc_html__('Fixed footer', 'thewriter'),
			'subtitle' => esc_html__('If on, footer and bottom footer will be fixed at screen bottom on page scroll.', 'thewriter'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),
	),
);