<?php
$boxSections[] = array(
	'title' => esc_html__('Content', 'thewriter'),
	'desc' => esc_html__('Change the content section configuration.', 'thewriter'),
	'fields' => array(
		array(
			'id' => 'local_content_styles--padding',
			'type' => 'spacing',
			'mode' => 'padding',
			'title' => esc_html__('Content padding', 'thewriter'),
			'right' => false,
			'left' => false,
			'units' => 'px',
		),

		array(
			'id'=>'local_content--dynamic_area__before',
			'type' => 'select',
			'title' => esc_html__('Dynamic area before content', 'thewriter'),
			'subtitle' => esc_html__('Select the page which content will be loaded and displayed before content.', 'thewriter'),
			'data' => 'pages',
			'default' => '',
		),

		array(
			'id'=>'local_content--dynamic_area__after',
			'type' => 'select',
			'title' => esc_html__('Dynamic area after content', 'thewriter'),
			'subtitle' => esc_html__('Select the page which content will be loaded and displayed after content.', 'thewriter'),
			'data' => 'pages',
			'default' => '',
		),

		array(
			'id' => 'local_general_styles--body_background',
			'type' => 'color',
			'title' => esc_html__('Container backgound-color', 'thewriter'),
			'subtitle' => esc_html__('Pick an container background color to overwrite the default from the theme.', 'thewriter'),
			'transparent' => false,
			'validate' => 'color',
		),
	),
);