<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');


class ThewriterTheme {


	private static $_instance = null;

	protected static $theme = null;

	protected static $theme_prefix = null;

	protected static $theme_dir = null;

	protected static $theme_options = null;

	protected static $social_icons = null;

	protected static $theme_uri = null;


	private function __construct() {
		self::$theme = wp_get_theme();

		self::$theme_prefix = strtolower(self::$theme->get('Name'));

		self::$theme_dir = get_template_directory();
		self::$theme_uri = get_template_directory_uri();

		self::$theme_options = self::$theme_prefix . '_options';

		self::$social_icons = array(
			// don't forget to add brand colors in CSS
			'link'          => '<i class="fa fa-lg fa-fw fa-link"></i> &nbsp; ' . esc_attr__('Custom Link', 'thewriter'),
			'envelope'      => '<i class="fa fa-lg fa-fw fa-envelope"></i> &nbsp; ' . esc_attr__('Mail', 'thewriter'),
			'facebook'      => '<i class="fa fa-lg fa-fw fa-facebook"></i> &nbsp; ' . esc_attr__('Facebook', 'thewriter'),
			'twitter'       => '<i class="fa fa-lg fa-fw fa-twitter"></i> &nbsp; ' . esc_attr__('Twitter', 'thewriter'),
			'instagram'     => '<i class="fa fa-lg fa-fw fa-instagram"></i> &nbsp; ' . esc_attr__('Instagram', 'thewriter'),
			'vk'            => '<i class="fa fa-lg fa-fw fa-vk"></i> &nbsp; ' . esc_attr__('VK', 'thewriter'),
			'pinterest'     => '<i class="fa fa-lg fa-fw fa-pinterest"></i> &nbsp; ' . esc_attr__('Pinterest', 'thewriter'),
			'linkedin'      => '<i class="fa fa-lg fa-fw fa-linkedin"></i> &nbsp; ' . esc_attr__('LinkedIn', 'thewriter'),
			'dribbble'      => '<i class="fa fa-lg fa-fw fa-dribbble"></i> &nbsp; ' . esc_attr__('Dribbble', 'thewriter'),
			'behance'       => '<i class="fa fa-lg fa-fw fa-behance"></i> &nbsp; ' . esc_attr__('Behance', 'thewriter'),
			'google-plus'   => '<i class="fa fa-lg fa-fw fa-google-plus"></i> &nbsp; ' . esc_attr__('Google+', 'thewriter'),
			'youtube'       => '<i class="fa fa-lg fa-fw fa-youtube"></i> &nbsp; ' . esc_attr__('YouTube', 'thewriter'),
			'vimeo-square'  => '<i class="fa fa-lg fa-fw fa-vimeo-square"></i> &nbsp; ' . esc_attr__('Vimeo', 'thewriter'),
			'flickr'        => '<i class="fa fa-lg fa-fw fa-flickr"></i> &nbsp; ' . esc_attr__('Flickr', 'thewriter'),
			'tumblr'        => '<i class="fa fa-lg fa-fw fa-tumblr"></i> &nbsp; ' . esc_attr__('Tumblr', 'thewriter'),
			'foursquare'    => '<i class="fa fa-lg fa-fw fa-foursquare"></i> &nbsp; ' . esc_attr__('FourSquare', 'thewriter'),
			'wordpress'     => '<i class="fa fa-lg fa-fw fa-wordpress"></i> &nbsp; ' . esc_attr__('WordPress', 'thewriter'),
			'stumbleupon'   => '<i class="fa fa-lg fa-fw fa-stumbleupon"></i> &nbsp; ' . esc_attr__('StumbleUpon', 'thewriter'),
			'soundcloud'    => '<i class="fa fa-lg fa-fw fa-soundcloud"></i> &nbsp; ' . esc_attr__('SoundCloud', 'thewriter'),
			'vine'          => '<i class="fa fa-lg fa-fw fa-vine"></i> &nbsp; ' . esc_attr__('Vine', 'thewriter'),
			'skype'         => '<i class="fa fa-lg fa-fw fa-skype"></i> &nbsp; ' . esc_attr__('Skype', 'thewriter'),
			'github'        => '<i class="fa fa-lg fa-fw fa-github"></i> &nbsp; ' . esc_attr__('GitHub', 'thewriter'),
			'bitbucket'     => '<i class="fa fa-lg fa-fw fa-bitbucket"></i> &nbsp; ' . esc_attr__('Bitbucket', 'thewriter'),
			'twitch'        => '<i class="fa fa-lg fa-fw fa-twitch"></i> &nbsp; ' . esc_attr__('Twitch', 'thewriter'),
			'weibo'         => '<i class="fa fa-lg fa-fw fa-weibo"></i> &nbsp; ' . esc_attr__('Weibo', 'thewriter'),
			'tencent-weibo' => '<i class="fa fa-lg fa-fw fa-tencent-weibo"></i> &nbsp; ' . esc_attr__('Tecent Weibo', 'thewriter'),
			'renren'        => '<i class="fa fa-lg fa-fw fa-renren"></i> &nbsp; ' . esc_attr__('RenRen', 'thewriter'),
			'xing'          => '<i class="fa fa-lg fa-fw fa-xing"></i> &nbsp; ' . esc_attr__('Xing', 'thewriter'),
		);
	}


	public static function init() {
		if(is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}


	protected static function get_option($option, $local_prefix = true) {
		if (empty($option)) {
			return false;
		}

		// @todo delete this
		if (isset($_GET[self::$theme_prefix . '--' . $option])) {
			$value = $_GET[self::$theme_prefix . '--' . $option];
			if (is_array($value)) {
				$value = array_map('strip_tags', $value);
				return $value;
			}
			return strip_tags($value);
		}

		global $thewriter_options;
		if(!isset($thewriter_options)) {
			return false;
		}
		$options = $thewriter_options;

		$value = false;

		if (isset($options[$option]) && $options[$option] != '') {
			$value = $options[$option];
		}

		$post_type = get_post_type();
		$single_option_name = 'single_'.$post_type.'--'.$option;
		$archive_option_name = $post_type.'s--'.$option;
		$search_option_name = 'search--'.$option;

		if (is_singular()) {

			if (isset($options[$single_option_name])) {
				$_value = $options[$single_option_name];

				if (is_array($_value)) {
					unset($_value['media']);
					unset($_value['google']);
					unset($_value['border-style']);
					foreach ($_value as $key => $item) {
						if ($item != '' && $item != 'px') {
							$value[$key] = $item;
						}
					}
					return $value;
				}

				if ($_value != '' && $_value != null) {
					$value = $_value;
				}
			}

			if (function_exists('redux_post_meta')) {
				$prefix = '';
				if ($local_prefix) {
					$prefix = 'local_';
				}
				$metaboxes = redux_post_meta(self::$theme_options, get_the_ID());
				if (isset($metaboxes[$prefix . $option])) {
					$_value = $metaboxes[$prefix . $option];

					if (is_array($_value)) {
						unset($_value['media']);
						unset($_value['google']);
						unset($_value['border-style']);
						foreach ($_value as $key => $item) {
							if ($item != '' && $item != 'px') {
								$value[$key] = $item;
							}
						}
						return $value;
					}

					if ($_value != '' && $_value != null) {
						$value = $_value;
					}
				}
			}

		} elseif (!is_search() && isset($options[$archive_option_name])) {

			$_value = $options[$archive_option_name];

			if (is_array($_value)) {
				unset($_value['media']);
				unset($_value['google']);
				foreach ($_value as $key => $item) {
					if ($item != '') {
						$value[$key] = $item;
					}
				}
				return $value;
			}

			if ($_value != '' && $_value != null) {
				$value = $_value;
			}

		} elseif (is_search() && isset($melinda_options[$search_option_name])) {

			$_value = $options[$search_option_name];

			if (is_array($_value)) {
				unset($_value['media']);
				unset($_value['google']);
				foreach ($_value as $key => $item) {
					if ($item != '') {
						$value[$key] = $item;
					}
				}
				return $value;
			}

			if ($_value != '' && $_value != null) {
				$value = $_value;
			}

		}

		return $value;
	}


	protected static function get_image_sizes($size = '') {
		global $_wp_additional_image_sizes;

		$sizes = array();
		$intermediate_image_sizes = get_intermediate_image_sizes();

		// Create the full array with sizes and crop info
		foreach($intermediate_image_sizes as $_size) {
			if (in_array($_size, array('thumbnail', 'medium', 'large'))) {
				$sizes[$_size] = array(
					'width'  => get_option($_size . '_size_w'),
					'height' => get_option($_size . '_size_h'),
					'crop'   => (bool) get_option($_size . '_crop'),
				);
			} elseif (isset($_wp_additional_image_sizes[$_size])) {
				$sizes[$_size] = array(
					'width'  => $_wp_additional_image_sizes[$_size]['width'],
					'height' => $_wp_additional_image_sizes[$_size]['height'],
					'crop'   => $_wp_additional_image_sizes[$_size]['crop']
				);
			}
		}

		// Get only 1 size if found
		if ($size) {
			if (isset($sizes[$size])) {
				return $sizes[$size];
			} else {
				return false;
			}
		}

		return $sizes;
	}


	protected static function get_image_size_names() {
		$size_names = array();
		$sizes = self::get_image_sizes();
		$names = apply_filters( 'image_size_names_choose', array(
			'thumbnail' => esc_html__('Thumbnail', 'thewriter'),
			'medium'    => esc_html__('Medium', 'thewriter'),
			'large'     => esc_html__('Large', 'thewriter'),
			'full'      => esc_html__('Full Size', 'thewriter'),
			'1536x1536' => esc_html__('1536x1536', 'thewriter'),
			'2048x2048' => esc_html__('2048x2048', 'thewriter'),
		) );

		$size_names['full'] = $names['full'];

		foreach ($sizes as $id => $size) {
			$size_names[$id] = $names[$id] . ' ' . $size['width'] . '×' . $size['height'];
		}

		return $size_names;
	}


}

ThewriterTheme::init();