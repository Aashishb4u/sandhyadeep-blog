<?php
$redux_social_links = array();
foreach (self::$social_icons as $id => $icon_and_name) {
	$redux_social_links[] = array(
		'id' => 'social--' . $id,
		'type' => 'text',
		'title' => $icon_and_name,
	);
}

Redux::setSection( $theme_options, array(
	'id' => 'sec_social',
	'title' => esc_html__('Social links', 'thewriter'),
	'icon' => 'el el-bullhorn',
	'fields' => $redux_social_links,
) );
