<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');
require_once(ABSPATH . '/wp-admin/includes/file.php');
$url = wp_nonce_url('/', 'thewriter-theme-options');

$method = ''; // Leave blank so WP_Filesystem can populate it as necessary.

if ( false === ( $creds = request_filesystem_credentials( esc_url_raw( $url ), $method, false, false, array() ) ) ) {
	return true;
}

if ( ! WP_Filesystem( $creds ) ) {
	request_filesystem_credentials( esc_url_raw( $url ), $method, true, false, array() ); // Setup WP_Filesystem.
	return true;
}


class ThewriterOptions extends ThewriterTheme {


	private static $_instance = null;


	private static $default = array(
		'general--page_comments' => 1,
		'general--responsiveness' => 1,
		'general--wp_version' => 1,
		'general--wlwmanifest' => 1,
		'general--rsd' => 1,
		'content_styles--padding' => array(
			'padding-top' => '60px',
			'units' => 'px', 
		),


		'layout--sidebars' => 'right',
		'layout--header_width' => 'normal',
		'layout--content_width' => 'normal',
		'layout--footer_width' => 'normal',


		'header' => 1,
		'header--layout' => 'layout1',
		'header--color_scheme' => 'dark',
		'header--search' => 1,
		'title_wrapper' => 1,
		'title_wrapper_styles--bg_overlay' => array(
			'color' => '#181c26',
			'alpha' => 0.5,
		),


		'bottom_footer' => 1,
		'bottom_footer--left_cols_sm' => 12,
		'bottom_footer--menu' => 1,
		'bottom_footer--menu_left' => 1,


		'posts--view' => 'standard',
		'posts--img' => 1,
		'posts--nav' => 1,
		'posts--img_size' => 'full',

		'single_post--featured_image' => 1,
		'single_post--tags' => 1,
		'single_post--share' => 1,
		'single_post--author' => 1,
		'single_post--nav' => 1,
	);


	private function __construct() {
		if (!class_exists('Redux')) {
			global ${self::$theme_options};
			${self::$theme_options} = self::$default;
			return;
		}

		add_action('redux/metaboxes/' . self::$theme_options . '/boxes', array($this, 'metaboxes'));
		add_action('redux/extensions/' . self::$theme_options . '/before', array($this, 'extensions'), 0);

		Redux::setArgs(self::$theme_options, $this->settings());

		$this->sections();

		// If Redux is running as a plugin, this will remove the demo notice and links
		add_action('init', array($this, 'remove_demo'));
		add_action('redux/loaded', array($this, 'remove_demo'));

		Redux::init(self::$theme_options);
	}


	public static function init() {
		if(is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}


	private function settings() {
		return array(
			// TYPICAL -> Change these values as you need/desire
			'opt_name'             => self::$theme_options,
			// This is where your data is stored in the database and also becomes your global variable name.
			'display_name'         => self::$theme->get('Name'),
			// Name that appears at the top of your panel
			'display_version'      => self::$theme->get('Version'),
			// Version that appears at the top of your panel
			'menu_type'            => 'menu',
			//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
			'allow_sub_menu'       => true,
			// Show the sections below the admin menu item or not
			'menu_title'           => esc_html__('Theme options', 'thewriter'),
			'page_title'           => esc_html__('Theme options', 'thewriter'),
			// You will need to generate a Google API key to use this feature.
			// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
			'google_api_key'       => 'AIzaSyC9VmAo3humqz45iP6thYhhiKjAPEuN4kQ',
			// Set it you want google fonts to update weekly. A google_api_key value is required.
			'google_update_weekly' => false,
			// Must be defined to add google fonts to the typography module
			//'async_typography'     => false,
			// Use a asynchronous font on the front end or font string
			//'disable_google_fonts_link' => true, // Disable this in case you want to create your own google fonts loader
			'admin_bar'            => true,
			// Show the panel pages on the admin bar
			'admin_bar_icon'       => 'dashicons-portfolio',
			// Choose an icon for the admin bar menu
			'admin_bar_priority'   => 50,
			// Choose an priority for the admin bar menu
			'global_variable'      => '',
			// Set a different name for your global variable other than the opt_name
			'dev_mode'             => false,
			// Show the time the page took to load, etc
			'update_notice'        => false,
			// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
			'customizer'           => true,
			// Enable basic customizer support
			//'open_expanded'     => true, // Allow you to start the panel in an expanded way initially.
			//'disable_save_warn' => true, // Disable the save warning when a user changes a field

			// OPTIONAL -> Give you extra features
			'page_priority'        => null,
			// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
			'page_parent'          => 'themes.php',
			// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
			'page_permissions'     => 'manage_options',
			// Permissions needed to access the options panel.
			'menu_icon'            => '',
			// Specify a custom URL to an icon
			'last_tab'             => '',
			// Force your panel to always open to a specific tab (by id)
			'page_icon'            => 'icon-themes',
			// Icon displayed in the admin panel next to your menu_title
			'page_slug'            => '',
			// Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
			'save_defaults'        => true,
			// On load save the defaults to DB before user clicks save or not
			'default_show'         => false,
			// If true, shows the default value next to each field that is not the default value.
			'default_mark'         => '',
			// What to print by the field's title if the value shown is default. Suggested: *
			'show_import_export'   => true,
			// Shows the Import/Export panel when not used as a field.

			// CAREFUL -> These options are for advanced use only
			'transient_time'       => 60 * MINUTE_IN_SECONDS,
			'output'               => true,
			// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
			'output_tag'           => true,
			// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
			// 'footer_credit'     => '', // Disable the footer credit of Redux. Please leave if you can help it.

			// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
			'database'             => '',
			// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
			'system_info'          => false,
		);
	}


	private function sections() {
		$theme_options = self::$theme_options;

		include self::$theme_dir . '/classes/options/general.php';
		include self::$theme_dir . '/classes/options/layout.php';
		include self::$theme_dir . '/classes/options/top_header.php';
		include self::$theme_dir . '/classes/options/header.php';
		include self::$theme_dir . '/classes/options/title_wrapper.php';
		include self::$theme_dir . '/classes/options/content.php';
		include self::$theme_dir . '/classes/options/footer.php';
		include self::$theme_dir . '/classes/options/bottom_footer.php';

		Redux::setSection( $theme_options, array(
			'id' => 'divide_01',
			'type' => 'divide',
		) );

		include self::$theme_dir . '/classes/options/posts.php';
		include self::$theme_dir . '/classes/options/single_post.php';

		include self::$theme_dir . '/classes/options/search.php';

		Redux::setSection( $theme_options, array(
			'id' => 'divide_02',
			'type' => 'divide',
		) );

		include self::$theme_dir . '/classes/options/social.php';
		include self::$theme_dir . '/classes/options/custom.php';
	}


	public function metaboxes($metaboxes) {
		$boxSections = array();
		$metaboxes = array();

		include self::$theme_dir . '/classes/options/metaboxes/layout.php';
		include self::$theme_dir . '/classes/options/metaboxes/top_header.php';
		include self::$theme_dir . '/classes/options/metaboxes/header.php';
		include self::$theme_dir . '/classes/options/metaboxes/title_wrapper.php';
		include self::$theme_dir . '/classes/options/metaboxes/content.php';
		include self::$theme_dir . '/classes/options/metaboxes/footer.php';
		include self::$theme_dir . '/classes/options/metaboxes/bottom_footer.php';
		include self::$theme_dir . '/classes/options/metaboxes/menus.php';
		include self::$theme_dir . '/classes/options/metaboxes/custom.php';

		$metaboxes[] = array(
			'id' => 'page-theme-options',
			'title' => esc_html__('Theme options', 'thewriter'),
			'post_types' => array('page'),
			'position' => 'normal',
			'priority' => 'high',
			'sections' => $boxSections,
		);

		include self::$theme_dir . '/classes/options/metaboxes/single_post.php';

		$metaboxes[] = array(
			'id' => 'post-theme-options',
			'title' => esc_html__('Theme options', 'thewriter'),
			'post_types' => array('post'),
			'position' => 'normal',
			'priority' => 'high',
			'sections' => $boxSections,
		);

		array_pop($boxSections);
		unset($boxSections[3]); // Title wrapper

		// include self::$theme_dir . '/classes/options/metaboxes/single_product.php';

		// $metaboxes[] = array(
		// 	'id' => 'product-theme-options',
		// 	'title' => esc_html__('Theme options', 'thewriter'),
		// 	'post_types' => array('product'),
		// 	'position' => 'normal',
		// 	'priority' => 'high',
		// 	'sections' => $boxSections,
		// );

		$metaboxes = apply_filters( 'redux_ext__metaboxes_filter', $metaboxes );

		return $metaboxes;
	}


	public function extensions($ReduxFramework) {
		if (class_exists('AirAddons')) {
			$path = WP_CONTENT_DIR.'/plugins/air_addons/';
			$folder = 'metaboxes';
			$extension_class = 'ReduxFramework_Extension_' . $folder;
			if ( ! class_exists( $extension_class ) ) {
				// In case you wanted override your override, hah.
				$class_file = $path . $folder . '/extension_' . $folder . '.php';
				$class_file = apply_filters( 'redux/extension/' . $ReduxFramework->args['opt_name'] . '/' . $folder, $class_file );
				if ( $class_file ) {
					require_once( $class_file );
				}
			}
			if ( ! isset( $ReduxFramework->extensions[ $folder ] ) ) {
				$ReduxFramework->extensions[ $folder ] = new $extension_class( $ReduxFramework );
			}
		}
	}


	// Remove the demo link and the notice of integrated demo from the redux-framework plugin
	public function remove_demo() {
		// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
		if (class_exists('ReduxFrameworkPlugin')) {
			

			// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
			remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
		}
	}


	public static function get($option) {
		return self::get_option($option);
	}


	public static function get_metaboxes_option($option) {
		if (!empty($option) && function_exists('redux_post_meta')) {
			return redux_post_meta(self::$theme_options, get_the_ID(), $option);
		}
		return false;
	}


}

ThewriterOptions::init();