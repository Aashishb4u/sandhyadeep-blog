<?php
Redux::setSection( $theme_options, array(
	'id' => 'main_sec_content',
	'title' => esc_html__('Content', 'thewriter'),
	'icon' => 'el el-align-left',
) );

Redux::setSection( $theme_options, array(
	'id' => 'sec_content',
	'title' => esc_html__('Content settings', 'thewriter'),
	'subsection' => true,
	'fields' => array(
		array(
			'id'=>'content--dynamic_area__before',
			'type' => 'select',
			'title' => esc_html__('Dynamic area before content', 'thewriter'),
			'subtitle' => esc_html__('Select the page which content will be loaded and displayed before content.', 'thewriter'),
			'data' => 'pages',
			'default' => '',
		),

		array(
			'id'=>'content--dynamic_area__after',
			'type' => 'select',
			'title' => esc_html__('Dynamic area after content', 'thewriter'),
			'subtitle' => esc_html__('Select the page which content will be loaded and displayed after content.', 'thewriter'),
			'data' => 'pages',
			'default' => '',
		),
	)
) );

Redux::setSection( $theme_options, array(
	'id' => 'sec_content_styles',
	'title' => esc_html__('Content styles', 'thewriter'),
	'subsection' => true,
	'fields' => array(
		array(
			'id' => 'content_styles--border',
			'type' => 'border',
			'title' => esc_html__('Content border', 'thewriter'),
			'subtitle' => esc_html__('Select a custom border to be applied in the content.', 'thewriter'),
			'all' => false,
			'left' => false,
			'right' => false,
		),

		array(
			'id' => 'content_styles--padding',
			'type' => 'spacing',
			'mode' => 'padding',
			'title' => esc_html__('Content padding', 'thewriter'),
			'right' => false,
			'left' => false,
			'units' => 'px',
			'default' => array(
				'padding-top' => '60px',
    			'units' => 'px', 
			),
		),
	)
) );
