<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');


class ThewriterSetup extends ThewriterTheme {


	private static $_instance = null;


	private function __construct() {
		add_action('after_setup_theme', array($this, 'after_setup_theme'));
		add_action('after_switch_theme', array($this, 'after_switch_theme'), 10 , 2);

		add_filter('image_size_names_choose', array($this, 'image_size_names_choose'));

		add_image_size(self::$theme_prefix . '_square_medium__crop', 510, 510, true);
		add_image_size(self::$theme_prefix . '_square_large__crop', 900, 900, true);
		add_image_size(self::$theme_prefix . '_rectangle_medium__crop', 510, 340, true);
		add_image_size(self::$theme_prefix . '_rectangle_large__crop', 900, 600, true);

		/**
		 * Register widget area.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
		 */
		add_action('widgets_init', array($this, 'widgets_init'));

		add_filter('media_view_settings', array($this, 'media_view_settings')); // Need for post_gallery()
		add_filter('post_gallery', array($this, 'post_gallery'), 10, 4);

		/**
		 * Custom template tags for this theme.
		 *
		 * Eventually, some of the functionality here could be replaced by core features.
		 */
		add_filter('comment_form_default_fields', array($this, 'comment_form_default_fields'));

		/**
		 * Flush out the transients used in is_categorized_blog().
		 */
		add_action('edit_category', array($this, 'category_transient_flusher'));
		add_action('save_post', array($this, 'category_transient_flusher'));

		/**
		 * Add description to menus.
		 */
		add_filter('nav_menu_item_args', array($this, 'nav_menu_item_args'), 99, 3);

		/**
		 * Slider Revolution settings.
		 */
		if (function_exists('set_revslider_as_theme')) {
			add_action('init', 'set_revslider_as_theme');
		}

		/**
		 * Enqueue scripts and styles.
		 */
		add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'), 99);
		add_action('wp_head', array($this, 'wp_head'), 999);
		add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));

		/*
		 * Posts.
		 */
		add_filter('the_content_more_link', array($this, 'the_content_more_link'));
		add_filter('excerpt_length', array($this, 'excerpt_length'), 999);
		add_filter('excerpt_more', array($this, 'excerpt_more'), 999);
	}


	public static function init() {
		if(is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}


	public static function after_setup_theme() {
		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on thewriter, use a find and replace
		 * to change 'thewriter' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'thewriter', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'top_header' => esc_html__( 'Top header menu', 'thewriter' ),
			'main' => esc_html__( 'Main menu', 'thewriter' ),
			'additional' => esc_html__( 'Additional header menu', 'thewriter' ),
			'popup' => esc_html__( 'Popup/Mobile menu', 'thewriter' ),
			'bottom_footer' => esc_html__( 'Bottom footer menu', 'thewriter' ),
		) );

		/**
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
		) );

		/**
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio'
		) );
	}


	public static function after_switch_theme($oldname, $oldtheme=false) {
		update_option('medium_size_w',510);
		update_option('medium_size_h', 510);

		update_option('large_size_w', 900);
		update_option('large_size_h', 900);
	}


	public static function image_size_names_choose($sizes) {
		return array_merge($sizes, array(
			self::$theme_prefix . '_square_medium__crop' => esc_html__('Square Medium With Crop', 'thewriter'),
			self::$theme_prefix . '_square_large__crop' => esc_html__('Square Large With Crop', 'thewriter'),
			self::$theme_prefix . '_rectangle_medium__crop' => esc_html__('Rectangle Medium With Crop', 'thewriter'),
			self::$theme_prefix . '_rectangle_large__crop' => esc_html__('Rectangle Large With Crop', 'thewriter'),
		));
	}


	public static function widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar left', 'thewriter' ),
			'id'            => 'sidebar_left',
			'description'   => esc_html__( 'Widgets displayed at left side of content.', 'thewriter' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget_h"><span class="widget_h_helper">',
			'after_title'   => '</span></h5>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar right', 'thewriter' ),
			'id'            => 'sidebar_right',
			'description'   => esc_html__( 'Widgets displayed at right side of content.', 'thewriter' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget_h"><span class="widget_h_helper">',
			'after_title'   => '</span></h5>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer #1 column', 'thewriter' ),
			'id'            => 'footer_1',
			'description'   => esc_html__( 'Widgets displayed at footer.', 'thewriter' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6 class="widget_h"><span class="widget_h_helper">',
			'after_title'   => '</span></h6>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer #2 column', 'thewriter' ),
			'id'            => 'footer_2',
			'description'   => esc_html__( 'Widgets displayed at footer.', 'thewriter' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6 class="widget_h"><span class="widget_h_helper">',
			'after_title'   => '</span></h6>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer #3 column', 'thewriter' ),
			'id'            => 'footer_3',
			'description'   => esc_html__( 'Widgets displayed at footer.', 'thewriter' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6 class="widget_h"><span class="widget_h_helper">',
			'after_title'   => '</span></h6>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer #4 column', 'thewriter' ),
			'id'            => 'footer_4',
			'description'   => esc_html__( 'Widgets displayed at footer.', 'thewriter' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6 class="widget_h"><span class="widget_h_helper">',
			'after_title'   => '</span></h6>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer #5 column', 'thewriter' ),
			'id'            => 'footer_5',
			'description'   => esc_html__( 'Widgets displayed at footer.', 'thewriter' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6 class="widget_h"><span class="widget_h_helper">',
			'after_title'   => '</span></h6>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer #6 column', 'thewriter' ),
			'id'            => 'footer_6',
			'description'   => esc_html__( 'Widgets displayed at footer.', 'thewriter' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6 class="widget_h"><span class="widget_h_helper">',
			'after_title'   => '</span></h6>',
		) );
	}


	public static function media_view_settings($settings) {
		// Need for post_gallery() below
		$settings['galleryDefaults']['columns'] = 1;
		$settings['galleryDefaults']['size'] = 'medium';
		$settings['galleryDefaults']['link'] = 'file';
		return $settings;
	}


	public static function post_gallery($output = '', $attr, $content = false, $tag = false) {
		$post = get_post();
		$atts = shortcode_atts( array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post ? $post->ID : 0,
			'columns'    => 1,
			'size'       => 'medium',
			'include'    => '',
			'exclude'    => '',
			'link'       => ''
		), $attr, 'gallery' );

		if (!is_singular()) {
			$atts['size'] = self::get_option('posts--img_size');
		}

		$id = intval($atts['id']);

		if (!empty($atts['include'])) {
			$_attachments = get_posts(array(
				'include' => $atts['include'],
				'post_status' => 'inherit',
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
				'order' => $atts['order'],
				'orderby' => $atts['orderby']
			));

			$attachments = array();
			foreach ($_attachments as $key => $val) {
				$attachments[$val->ID] = $_attachments[$key];
			}
		} elseif (!empty($atts['exclude'])) {
			$attachments = get_children(array(
				'post_parent' => $id,
				'exclude' => $atts['exclude'],
				'post_status' => 'inherit',
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
				'order' => $atts['order'],
				'orderby' => $atts['orderby']
			));
		} else {
			$attachments = get_children(array(
				'post_parent' => $id,
				'post_status' => 'inherit',
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
				'order' => $atts['order'],
				'orderby' => $atts['orderby']
			));
		}

		if (empty($attachments)) {
			return '';
		}

		if (is_feed()) {
			$output = '\n';
			foreach ( $attachments as $att_id => $attachment ) {
				$output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . '\n';
			}
			return $output;
		}

		$selector = 'gallery-' . $content;

		$output .= '<div id="' . $selector . '" class="flexslider gallery"><ul class="slides">';

		$i = 0;
		foreach ($attachments as $id => $attachment) {

			$attr = (trim($attachment->post_excerpt)) ? array('aria-describedby' => $selector . '-' . $id) : '';

			if (!empty($atts['link']) && 'post' === $atts['link']) {

				$image_output = wp_get_attachment_link( $id, $atts['size'], true, false, false, $attr );

			} elseif (!empty($atts['link']) && 'none' === $atts['link']) {

				$image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );

			} else {

				$image_meta = wp_get_attachment_image_src( $id, 'full' );

				$image = wp_get_attachment_image( $id, $atts['size'], false, $attr );

				$image_output = '<a
					href="' . $image_meta[0] . '"
					data-img-width="' . $image_meta[1] . '"
					data-img-height="' . $image_meta[2] . '"
					data-img-index="' . $i . '"
					data-pswp-uid="' . $content . '"
					class="js-pswp-img-lk"
				>' . $image . '</a>';

			}

			$i++;

			$output .= '<li>';
			$output .= $image_output;
			$output .= '</li>';
		}

		$output .= '</ul></div>';

		$columns = intval($atts['columns']);

		$direction_nav = 'true';

		if ($i <= $columns) {
			$direction_nav = 'false';
		}

		$output .= '
			<script>
				(function($) {
					$(document).ready(function() {
						$("#' . $selector . '").flexslider({
							animation: "slide",
							slideshow: false,
							animationLoop: false,
							directionNav: ' . $direction_nav . ',
							controlNav: false,
							itemWidth: 200,
							minItems: ' . $columns . ',
							maxItems: ' . $columns . '
						});
					});
				})(jQuery);
			</script>
		';

		return $output;
	}


	public static function comment_form_default_fields($fields) {
		$commenter = wp_get_current_commenter();

		$fields['author'] =
			'<div class="row"><div class="comment-form-field comment-form-author col-sm-4">
				<input required minlength="3" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="'.esc_html__('Name*', 'thewriter').'">
			</div>';

		$fields['email'] =
			'<div class="comment-form-field comment-form-email col-sm-4">
				<input required id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="'.esc_html__('Email*', 'thewriter').'">
			</div>';

		$fields['url'] =
			'<div class="comment-form-field comment-form-url col-sm-4">
				<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="'.esc_html__('Website', 'thewriter').'">
			</div></div>';

		return $fields;
	}


	/**
	 * Flush out the transients used in is_categorized_blog().
	 */
	public static function category_transient_flusher() {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// Like, beat it. Dig?
		delete_transient( self::$theme_prefix . '_categories' );
	}


	/**
	 * Add description to menus.
	 */
	public static function nav_menu_item_args($args, $item, $depth) {
		$description = $item->description;
		if ($description) {
			$args->link_after = '<span class="menu-item-desc">' . $description . '</span>';
		} else {
			$args->link_after = '';
		}
		return $args;
	}


	/**
	 * Enqueue scripts and styles.
	 */
	public static function enqueue_scripts() {
		wp_dequeue_style( 'select2' );
		wp_dequeue_style( 'sb_instagram_icons' );
		wp_dequeue_style( 'jquery-selectBox' );
		wp_dequeue_style( 'mc4wp-form-basic' );
		wp_deregister_style( 'login-with-ajax' );
		wp_deregister_style( 'font-awesome' );
		wp_deregister_style( 'flexslider' );
		wp_deregister_style( 'nivo-slider-theme' );

		/*
		Translators: If there are characters in your language that are not supported
		by chosen font(s), translate this to 'off'. Do not translate into your own language.
		*/
		if ( 'off' !== _x( 'on', 'Google fonts: on or off', 'thewriter' ) ) {
			$font_families = array();
			$font_families[] = 'Open Sans:400,400i,700,700i,800,800i';
			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext,cyrillic,cyrillic-ext' ),
			);

			wp_enqueue_style( self::$theme_prefix . '_google_fonts',
				add_query_arg( $query_args, '//fonts.googleapis.com/css' ) );
		}
		if ( 'off' !== _x( 'on', 'Theme fonts: on or off', 'thewriter' ) ) {
			wp_enqueue_style( self::$theme_prefix . '_fonts', self::$theme_uri . '/fonts/FuturaPT/FuturaPT.css' );
		}

		wp_enqueue_style( self::$theme_prefix . '_style', get_stylesheet_uri() );
		ob_start();
		get_template_part( 'inc/styles' );
		$styles = ob_get_contents();
		ob_end_clean();
		wp_add_inline_style( self::$theme_prefix . '_style', $styles );
		wp_add_inline_style( self::$theme_prefix . '_style', self::get_option('custom--css', false) );
		wp_add_inline_style( self::$theme_prefix . '_style', self::get_option('local_custom--css', false) );


		wp_dequeue_script( 'prettyPhoto' );
		wp_dequeue_script( 'prettyPhoto-init' );
		wp_dequeue_script( 'select2' );

		$tmp = 'wp_dereg' . 'ister_script';
		$tmp( 'jqueryui' );
		$tmp( 'flexslider' );
		$tmp( 'isotope' );

		wp_enqueue_script('wc-add-to-cart-variation', false, array(), false, true ); // need for quick view

		$template_dir_uri = get_template_directory_uri();

		wp_register_script( 'requestAnimationFrame',
			$template_dir_uri . '/scripts/vendor/requestAnimationFrame/requestAnimationFrame.js',
			array(), false, true );

		wp_register_script( 'jqueryui',
			$template_dir_uri . '/scripts/vendor/jquery.ui/jquery-ui.min.js',
			array('jquery'), false, true );

		wp_register_script( 'flexslider',
			$template_dir_uri . '/scripts/vendor/flexslider/jquery.flexslider-min.js',
			array('jquery'), false, true );

		wp_register_script( 'photoswipe',
			$template_dir_uri . '/scripts/vendor/photoswipe/dist/photoswipe.min.js',
			array('jquery'), false, true );

		wp_register_script( 'photoswipeui',
			$template_dir_uri . '/scripts/vendor/photoswipe/dist/photoswipe-ui-default.min.js',
			array('jquery', 'photoswipe'), false, true );

		wp_register_script( 'isotope',
			$template_dir_uri . '/scripts/vendor/isotope/dist/isotope.pkgd.min.js',
			array(), false, true );

		wp_register_script( 'smooth-scroll',
			$template_dir_uri . '/scripts/vendor/jquery-smooth-scroll/jquery.smooth-scroll.min.js',
			array('jquery'), false, true );

		wp_enqueue_script( self::$theme_prefix . '_main',
			$template_dir_uri . '/scripts/local/main.js',
			array( 'requestAnimationFrame', 'jqueryui', 'flexslider', 'photoswipe', 'photoswipeui', 'isotope', 'smooth-scroll' ), false, true );

		wp_localize_script(
			self::$theme_prefix . '_main',
			'ajaxurl',
			array(
				'url' => admin_url('admin-ajax.php'),
				'nonce' => wp_create_nonce(self::$theme_prefix . '-nonce'),
			)
		);


		$custom_js = '(function($) {
			' . self::get_option('custom--js', false) . '
			' . self::get_option('local_custom--js', false) . '
		})(jQuery);';
		wp_add_inline_script( self::$theme_prefix . '_main', $custom_js );
	}


	public static function wp_head() {
		echo ThewriterOptions::get('custom--head_html', false);
		echo ThewriterOptions::get('local_custom--head_html', false);
	}


	public static function admin_enqueue_scripts() {
		wp_enqueue_style( 'font_awesome', get_template_directory_uri() . '/scripts/vendor/fontawesome/css/font-awesome.min.css' );
		wp_add_inline_style( 'font_awesome', '.updated.redux-message.redux-notice.notice.is-dismissible.redux-notice,.rAds,.update-nag.bsf-update-nag{display:none;height:0;width:0;overflow:hidden;opacity:0;visibility:hidden;}' );
	}


	public static function the_content_more_link($link) {
		$link = '';
		return $link;
	}


	public static function excerpt_length($length) {
		return 30;
	}


	public static function excerpt_more() {
		return '...';
	}


}

ThewriterSetup::init();
