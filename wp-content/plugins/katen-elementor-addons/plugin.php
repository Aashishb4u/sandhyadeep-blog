<?php
namespace Katen_Elementor_Addons;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Plugin class.
 *
 * The main class that initiates and runs the addon.
 *
 * @since 1.0.0
 */
final class Plugin {

	/**
	 * Addon Version
	 *
	 * @since 1.0.0
	 * @var string The addon version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the addon.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.5.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the addon.
	 */
	const MINIMUM_PHP_VERSION = '7.3';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 * @var \Elementor_Test_Addon\Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 * @return \Elementor_Test_Addon\Plugin An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * Perform some compatibility checks to make sure basic requirements are meet.
	 * If all compatibility checks pass, initialize the functionality.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		if ( $this->is_compatible() ) {
			add_action( 'elementor/init', [ $this, 'init' ] );
		}

	}

	/**
	 * Compatibility Checks
	 *
	 * Checks whether the site meets the addon requirement.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function is_compatible() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return false;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return false;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return false;
		}

		return true;

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'katen' ),
			'<strong>' . esc_html__( 'Katen Elementor Addon', 'katen' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'katen' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'katen' ),
			'<strong>' . esc_html__( 'Katen Elementor Addon', 'katen' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'katen' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'katen' ),
			'<strong>' . esc_html__( 'Katen Elementor Addon', 'katen' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'katen' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Initialize
	 *
	 * Load the addons functionality only after Elementor is initialized.
	 *
	 * Fired by `elementor/init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init() {

		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
		add_action( 'elementor/controls/register', [ $this, 'register_controls' ] );
		add_action( 'elementor/editor/before_enqueue_styles', [ $this, 'enqueue_katen_elementor_icons' ] );

	}

	/**
	 * Register Widgets
	 *
	 * Load widgets files and register new Elementor widgets.
	 *
	 * Fired by `elementor/widgets/register` action hook.
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets( $widgets_manager ) {

		require_once( __DIR__ . '/widgets/post-one.php' );
		require_once( __DIR__ . '/widgets/post-two.php' );
		require_once( __DIR__ . '/widgets/post-three.php' );
		require_once( __DIR__ . '/widgets/post-four.php' );
		require_once( __DIR__ . '/widgets/post-five.php' );
		require_once( __DIR__ . '/widgets/post-six.php' );
		require_once( __DIR__ . '/widgets/post-seven.php' );
		require_once( __DIR__ . '/widgets/post-eight.php' );
		require_once( __DIR__ . '/widgets/post-nine.php' );
		require_once( __DIR__ . '/widgets/post-ten.php' );
		require_once( __DIR__ . '/widgets/post-eleven.php' );
		require_once( __DIR__ . '/widgets/post-twelve.php' );
		require_once( __DIR__ . '/widgets/section-header.php' );
		require_once( __DIR__ . '/widgets/contact-info.php' );

		$widgets_manager->register( new Katen_Post_One() );
		$widgets_manager->register( new Katen_Post_Two() );
		$widgets_manager->register( new Katen_Post_Three() );
		$widgets_manager->register( new Katen_Post_Four() );
		$widgets_manager->register( new Katen_Post_Five() );
		$widgets_manager->register( new Katen_Post_Six() );
		$widgets_manager->register( new Katen_Post_Seven() );
		$widgets_manager->register( new Katen_Post_Eight() );
		$widgets_manager->register( new Katen_Post_Nine() );
		$widgets_manager->register( new Katen_Post_Ten() );
		$widgets_manager->register( new Katen_Post_Eleven() );
		$widgets_manager->register( new Katen_Post_Twelve() );
		$widgets_manager->register( new Katen_Section_Header() );
		$widgets_manager->register( new Katen_Contact_Info() );

	}

	function enqueue_katen_elementor_icons() {

		wp_register_style( 'katen-simple-line-icons', plugins_url( 'css/simple-line-icons.css', __FILE__ ) );

		wp_enqueue_style( 'katen-simple-line-icons' );
	
	}

	/**
	 * Register Controls
	 *
	 * Load controls files and register new Elementor controls.
	 *
	 * Fired by `elementor/controls/register` action hook.
	 *
	 * @param \Elementor\Controls_Manager $controls_manager Elementor controls manager.
	 */
	public function register_controls( $controls_manager ) {

	}

}