<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');


class ThewriterAddons extends ThewriterTheme {


	private static $_instance = null;


	private function __construct() {
		// We safely integrate with VC with this hook
		if (!defined('WPB_VC_VERSION')) {
			return;
		}

		if (function_exists('visual_composer')) {
			add_action('init', array($this, 'disable_vc_meta'), 100);
		}

		add_action('vc_before_init', array($this, 'settings'));

		add_action('init', array($this, 'integrate_with_vc'));
		add_action('init', array($this, 'vc_custom_grid_mapping2'));

		// Use this when creating a shortcode addon
		$add_shrtcd = 'add_' . 'shortcode';
		$add_shrtcd('thewriter_vc_team_member', array($this, 'render_vc_team_member'));
	}


	public static function init() {
		if(is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}


	public function disable_vc_meta() {
		remove_action('wp_head', array(visual_composer(), 'addMetaData'));
	}


	public function settings() {
		vc_set_as_theme(true);
		vc_set_default_editor_post_types(array(
			'page',
			'product',
		));
	}

	public function vc_custom_grid_mapping2() {
		 

		// Map the block with vc_map()
		vc_map( 
			array(
				'name' 				=> __( 'Posts (Only for demo. Please use default WP blog and Theme Options > Blog)', 'thewriter' ),
				'base' 				=> 'vc_custom_grid',
				'content_element' 	=> true,
				'icon' 				=> get_template_directory_uri() .'/vc-addon/img/vc-icon.png',
				'description' 		=> __( 'Show post with VC and one of grid styles', 'thewriter' ),
				'category' 			=> __( 'Thewriter', 'thewriter' ),
				'params' 			=> array(
					array(
						'type' 			=> 'dropdown',
						'heading' 		=> __( 'Select type', 'thewriter' ),
						'param_name' 	=> 'element_type',
						'value' 		=> array(
							__( 'Posts', 'thewriter' ) 		=> 'posts',
							__( 'Pagination', 'thewriter' ) 	=> 'pagination',
						),
						'std' 			=> '',
					),
					array(
						'type' 			=> 'textfield',
						'heading' 		=> __( 'Total items for addon', 'thewriter' ),
						'param_name' 	=> 'max_items',
						'value' 		=> 10,
						// default value
						// 'param_holder_class' 	=> 'vc_not-for-custom',
						'description' 	=> __( 'Count of display posts in this addon', 'thewriter' ),
						'dependency' 	=> array(
							'element' 		=> 'element_type',
							'value' 		=> 'posts',
						),
					),
					array(
						'type' 				=> 'dropdown',
						'heading' 			=> __( 'Columns numbers (Minimal)', 'thewriter' ),
						'param_name' 		=> 'col_numbers',
						'value' 			=> array(
							__( 'Default', 'thewriter' ) 	=> 'default',
							__( '1 Column', 'thewriter' ) 	=> 'col-sm-12 col-xs-12',
							__( '2 Columns', 'thewriter' ) 	=> 'col-sm-6 col-xs-12',
							__( '3 Columns', 'thewriter' ) 	=> 'col-sm-4 col-xs-12',
							__( '4 Columns', 'thewriter' ) 	=> 'col-sm-3 col-xs-12',
							__( '6 Columns', 'thewriter' ) 	=> 'col-sm-2 col-xs-12',
							__( '12 Columns', 'thewriter' ) 	=> 'col-sm-1 col-xs-12',
						),
						'edit_field_class' 	=> 'vc_col-sm-12',
						'description' 		=> __( 'Select min number of columns.', 'thewriter' ),
						'dependency' 		=> array(
							'element' 			=> 'element_type',
							'value' 			=> 'posts',
						),
					),
					array(
						'type' 				=> 'dropdown',
						'heading' 			=> __( 'Columns numbers (for Tablet)', 'thewriter' ),
						'param_name' 		=> 'col_numbers_md',
						'value' 			=> array(
							__( 'Default', 'thewriter' ) 	=> 'default',
							__( '1 Column', 'thewriter' ) 	=> 'col-md-12',
							__( '2 Columns', 'thewriter' ) 	=> 'col-md-6',
							__( '3 Columns', 'thewriter' ) 	=> 'col-md-4',
							__( '4 Columns', 'thewriter' ) 	=> 'col-md-3',
							__( '6 Columns', 'thewriter' ) 	=> 'col-md-2',
							__( '12 Columns', 'thewriter' ) 	=> 'col-md-1',
						),
						'edit_field_class' 	=> 'vc_col-sm-6',
						'description' 		=> __( 'Select number of columns for screen with width more than 768px.', 'thewriter' ),
						'dependency' 		=> array(
							'element' 			=> 'col_numbers',
							'value_not_equal_to' 			=> 'default',
						),
					),
					array(
						'type' 				=> 'dropdown',
						'heading' 			=> __( 'Columns numbers (for Laptop)', 'thewriter' ),
						'param_name' 		=> 'col_numbers_xl',
						'value' 			=> array(
							__( 'Default', 'thewriter' ) 	=> 'default',
							__( '1 Column', 'thewriter' ) 	=> 'col-xl-12',
							__( '2 Columns', 'thewriter' ) 	=> 'col-xl-6',
							__( '3 Columns', 'thewriter' ) 	=> 'col-xl-4',
							__( '4 Columns', 'thewriter' ) 	=> 'col-xl-3',
							__( '6 Columns', 'thewriter' ) 	=> 'col-xl-2',
							__( '12 Columns', 'thewriter' ) 	=> 'col-xl-1',
						),
						'edit_field_class' 	=> 'vc_col-sm-6',
						'description' 		=> __( 'Select number of columns for screen with width more than 992px.', 'thewriter' ),
						'dependency' 		=> array(
							'element' 			=> 'col_numbers',
							'value_not_equal_to' 			=> 'default',
						),
					),
					array(
						'type' 				=> 'dropdown',
						'heading' 			=> __( 'Columns numbers (for Desktop)', 'thewriter' ),
						'param_name' 		=> 'col_numbers_xxl',
						'value' 			=> array(
							__( 'Default', 'thewriter' ) 	=> 'default',
							__( '1 Column', 'thewriter' ) 	=> 'col-xxl-12',
							__( '2 Columns', 'thewriter' ) 	=> 'col-xxl-6',
							__( '3 Columns', 'thewriter' ) 	=> 'col-xxl-4',
							__( '4 Columns', 'thewriter' ) 	=> 'col-xxl-3',
							__( '6 Columns', 'thewriter' ) 	=> 'col-xxl-2',
							__( '12 Columns', 'thewriter' ) 	=> 'col-xxl-1',
						),
						'edit_field_class' 	=> 'vc_col-sm-6',
						'description' 		=> __( 'Select number of columns for screen with width more than 1200px.', 'thewriter' ),
						'dependency' 		=> array(
							'element' 			=> 'col_numbers',
							'value_not_equal_to' 			=> 'default',
						),
					),
					array(
						'type' 				=> 'dropdown',
						'heading' 			=> __( 'Columns numbers (for Large Screen Displays)', 'thewriter' ),
						'param_name' 		=> 'col_numbers_xxxl',
						'value' 			=> array(
							__( 'Default', 'thewriter' ) 	=> 'default',
							__( '1 Column', 'thewriter' ) 	=> 'col-xxxl-12',
							__( '2 Columns', 'thewriter' ) 	=> 'col-xxxl-6',
							__( '3 Columns', 'thewriter' ) 	=> 'col-xxxl-4',
							__( '4 Columns', 'thewriter' ) 	=> 'col-xxxl-3',
							__( '6 Columns', 'thewriter' ) 	=> 'col-xxxl-2',
							__( '12 Columns', 'thewriter' ) 	=> 'col-xxxl-1',
						),
						'edit_field_class' 	=> 'vc_col-sm-6',
						'description' 		=> __( 'Select number of columns for screen with width more than 1920px.', 'thewriter' ),
						'dependency' 		=> array(
							'element' 			=> 'col_numbers',
							'value_not_equal_to' 			=> 'default',
						),
					),
					array(
						'type' 			=> 'textfield',
						'heading' 		=> __( 'Margin for column', 'thewriter' ),
						'param_name' 	=> 'col_margin',
						'value' 		=> '',
						// default value
						// 'param_holder_class' 	=> 'vc_not-for-custom',
						'description' 	=> __( 'Set margin for columns.', 'thewriter' ),
						'dependency' 	=> array(
							'element' 		=> 'element_type',
							'value' 		=> 'posts',
						),
					),
					array(
						'type' 			=> 'textfield',
						'heading' 		=> __( 'Padding for column', 'thewriter' ),
						'param_name' 	=> 'col_padding',
						'value' 		=> '',
						// default value
						// 'param_holder_class' 	=> 'vc_not-for-custom',
						'description' 	=> __( 'Set padding for columns.', 'thewriter' ),
						'dependency' 	=> array(
							'element' 		=> 'element_type',
							'value' 		=> 'posts',
						),
					),
					array(
						'type' 			=> 'textfield',
						'heading' 		=> __( 'Height for column', 'thewriter' ),
						'param_name' 	=> 'col_height',
						'value' 		=> '',
						// default value
						// 'param_holder_class' 	=> 'vc_not-for-custom',
						'description' 	=> __( 'Set height for columns(Default is 290px)', 'thewriter' ),
						'dependency' 		=> array(
							'element' 			=> 'element_type',
							'value' 			=> 'posts',
						),
					),
					array(
						'type' 			=> 'textfield',
						'heading' 		=> __( 'Offset', 'thewriter' ),
						'param_name' 	=> 'offset',
						'value' 		=> '',
						// default value
						// 'param_holder_class' 	=> 'vc_not-for-custom',
						'description' 	=> __( 'Set offset of the posts.', 'thewriter' ),
						'dependency' 	=> array(
							'element' 		=> 'element_type',
							'value' 		=> 'posts',
						),
					),
					array(
						'type' 				=> 'dropdown',
						'heading' 			=> __( 'Display Style', 'thewriter' ),
						'param_name' 		=> 'style',
						'value' 			=> array(
							__( 'Show all', 'thewriter' ) 	=> 'all',
							__( 'Pagination', 'thewriter' ) 	=> 'pagination',
						),
						'edit_field_class' 	=> 'vc_col-sm-6',
						'description' 		=> __( 'Select display style for grid.', 'thewriter' ),
						'dependency' 		=> array(
							'element' 			=> 'element_type',
							'value' 			=> 'posts',
						),
					),
					array(
						'type' 				=> 'textfield',
						'heading' 			=> __( 'Items per page', 'thewriter' ),
						'param_name' 		=> 'items_per_page',
						'description' 		=> __( 'Number of items to show per page.', 'thewriter' ),
						'value' 			=> '10',
						'edit_field_class' 	=> 'vc_col-sm-6',
						'dependency' 		=> array(
							'element' 			=> 'style',
							'value' 			=> 'pagination',
						),
					),
					array(
						'type' 			=> 'dropdown',
						'heading' 		=> __( 'Order by', 'thewriter' ),
						'param_name' 	=> 'orderby',
						'value' 		=> array(
							__( 'Date', 'thewriter' ) 				=> 'date',
							__( 'Order by post ID', 'thewriter' ) 	=> 'ID',
							__( 'Random order', 'thewriter' ) 		=> 'rand',
							__( 'Last modified date', 'thewriter' ) 	=> 'modified',
							__( 'Number of comments', 'thewriter' ) 	=> 'comment_count',
						),
						'description' 	=> __( 'Select order type.', 'thewriter' ),
						'group' 		=> __( 'Data Settings', 'thewriter' ),
						// 'param_holder_class' 	=> 'vc_grid-data-type-not-ids',
						'dependency' 		=> array(
							'element' 			=> 'element_type',
							'value' 			=> 'posts',
						),
					),
					array(
						'type' 			=> 'dropdown',
						'heading' 		=> __( 'Sort order', 'thewriter' ),
						'param_name' 	=> 'order',
						'group' 		=> __( 'Data Settings', 'thewriter' ),
						'value' 		=> array(
							__( 'Descending', 'thewriter' ) 	=> 'DESC',
							__( 'Ascending', 'thewriter' ) 	=> 'ASC',
						),
						// 'param_holder_class' 	=> 'vc_grid-data-type-not-ids',
						'description' 	=> __( 'Select sorting order.', 'thewriter' ),
						'dependency' 	=> array(
							'element' 		=> 'element_type',
							'value' 		=> 'posts',
						),
					),
					array(
						'type' 			=> 'checkbox',
						"admin_label" 	=> true,
						'heading' 		=> __( 'Post format exclude', 'thewriter' ),
						'param_name' 	=> 'post_format_exclude',
						'group' 		=> __( 'Data Settings', 'thewriter' ),
						'value' 		=> array(
							__( 'Gallery', 'thewriter' ) 	=> 'post-format-gallery',
							__( 'Link', 'thewriter' ) 		=> 'post-format-link',
							__( 'Image', 'thewriter' ) 		=> 'post-format-image',
							__( 'Quote', 'thewriter' ) 		=> 'post-format-quote',
							__( 'Video', 'thewriter' ) 		=> 'post-format-video',
							__( 'Audio', 'thewriter' ) 		=> 'post-format-audio',
							__( 'Aside', 'thewriter' ) 		=> 'post-format-aside',
							__( 'Chat', 'thewriter' ) 		=> 'post-format-chat',
							__( 'Status', 'thewriter' ) 		=> 'post-format-status',
							__( 'Standard', 'thewriter' ) 	=> 'post-format-standard'
						),
						'settings' 		=> array(
							'multiple' 		=> true,
						),
						'std' 			=> '',
						'description' 	=> __( 'Exclude one or multiple posts format.', 'thewriter' ),
					),
					array(
						'type' 			=> 'dropdown',
						'heading' 		=> __( 'Post show template', 'thewriter' ),
						'param_name' 	=> 'custom_grid',
						'value' 		=> array(
							__( 'Standard', 'thewriter' ) 	=> 'standard',
							__( 'Grid', 'thewriter' ) 		=> 'grid',
							__( 'Masonry', 'thewriter' ) 	=> 'masonry',
							__( 'Blocks', 'thewriter' ) 		=> 'blocks',
							__( 'Boxed', 'thewriter' ) 		=> 'boxed',
						),
						'std' 			=> '',
						'description' 	=> __( 'Select template for posts.', 'thewriter' ),
						'group' 		=> __( 'Item Design', 'thewriter' ),
						'dependency' 	=> array(
							'element' 		=> 'element_type',
							'value' 		=> 'posts',
						),
					),
					array(
						'type' 			=> 'textfield',
						'heading' 		=> __( 'Extra class name', 'thewriter' ),
						'param_name' 	=> 'el_class',
						'description' 	=> __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'thewriter' ),
						'dependency' 	=> array(
							'element' 		=> 'element_type',
							'value' 		=> 'posts',
						),
					),
					array(
						'type' 			=> 'css_editor',
						'heading' 		=> __( 'CSS box', 'thewriter' ),
						'param_name' 	=> 'css',
						'group' 		=> __( 'Design Options', 'thewriter' ),
						'dependency' 	=> array(
							'element' 		=> 'element_type',
							'value' 		=> 'posts',
						),
					),

				)
			)
		);
		
	}

	public function integrate_with_vc() {
		/*
		 * Add your Visual Composer logic here.
		 * Lets call vc_map function to "register" our custom shortcode within Visual Composer interface.
		 *
		 * More info: http://kb.wpbakery.com/index.php?title=Vc_map
		 */

		$size_names = array_flip(self::get_image_size_names());

		vc_map( array(
			'name' => esc_html__('Team Member', 'thewriter'),
			'base' => 'thewriter_vc_team_member',
			'content_element' => true,
			'category' => 'Thewriter',
			'description' => esc_html__('Display a team member with effects, description and social icons', 'thewriter'),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Name', 'thewriter'),
					'param_name' => 'title',
					'admin_label' => true,
					'description' => esc_html__('Type your team member name.', 'thewriter'),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Job Title', 'thewriter'),
					'param_name' => 'job',
					'description' => esc_html__('Type your team member job title, e.g. Manager.', 'thewriter'),
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__('Photo', 'thewriter'),
					'param_name' => 'img',
					'value' => '',
					'description' => esc_html__('Upload or select a photo from media gallery.', 'thewriter'),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__('Photo size', 'thewriter'),
					'param_name' => 'img_size',
					'value' => $size_names,
					'dependency' => array(
						'element' => 'img',
						'not_empty' => true,
					),
				),
				array(
					'type' => 'textarea_html',
					'heading' => esc_html__('Description', 'thewriter'),
					'param_name' => 'content',
					'value' => '',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__('Text Position', 'thewriter'),
					'param_name' => 'txt_position',
					'value' => array(
						esc_html__('Text and social links after photo', 'thewriter') => '',
						esc_html__('Text and social links on second slide (on hover)', 'thewriter') => '__card __anim_1',
						esc_html__('Text on first slide, social links on second (on hover)', 'thewriter') => '__card __anim_2',
					),
					'std' => '',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__('Text Vertical Alignment', 'thewriter'),
					'param_name' => 'txt_vertical_align',
					'value' => array(
						esc_html__('Top', 'thewriter') => '__top',
						esc_html__('Middle', 'thewriter') => '__middle',
						esc_html__('Bottom', 'thewriter') => '__bottom',
					),
					'std' => '__middle',
					'dependency' => array(
						'element' => 'txt_position',
						'not_empty' => true,
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__('Text Alignment', 'thewriter'),
					'param_name' => 'txt_align',
					'value' => array(
						esc_html__('Center', 'thewriter') => 'text-center',
						esc_html__('Left', 'thewriter') => 'text-left',
						esc_html__('Right', 'thewriter') => 'text-right',
					),
					'std' => 'text-center',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__('Color scheme', 'thewriter'),
					'param_name' => 'color_scheme',
					'value' => array(
						esc_html__('Light', 'thewriter') => '__light',
						esc_html__('Dark', 'thewriter') => '__dark',
					),
					'std' => '__light',
					'dependency' => array(
						'element' => 'txt_position',
						'is_empty' => true,
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Boxed', 'thewriter'),
					'param_name' => 'boxed',
					'value' => array( esc_html__('Yes', 'thewriter') => '__boxed' ),
					'dependency' => array(
						'element' => 'txt_position',
						'is_empty' => true,
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Scale photo on hover', 'thewriter'),
					'param_name' => 'img_scale',
					'value' => array( esc_html__('Yes', 'thewriter') => '__scale' ),
					'dependency' => array(
						'element' => 'txt_position',
						'not_empty' => true,
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__('Filter for photo on hover', 'thewriter'),
					'param_name' => 'img_filter',
					'value' => array(
						'Disable' => '',
						'Grayscale (color to gray)' => '__gray',
						'Grayscale (gray to color)' => '__color',
					),
					'std' => '',
					'dependency' => array(
						'element' => 'txt_position',
						'not_empty' => true,
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__('Overlay', 'thewriter'),
					'param_name' => 'img_overlay',
					'value' => array(
						esc_html__('Disable', 'thewriter') => '',
						esc_html__('First Slide', 'thewriter') => '__overlay',
						esc_html__('Second Slide (on hover)', 'thewriter') => '__on-hover',
						esc_html__('Both Slides', 'thewriter') => '__both',
						esc_html__('Gradient On First Slide', 'thewriter') => '__gradient',
						esc_html__('Gradient On Second Slide (on hover)', 'thewriter') => '__gradient-on-hover',
						esc_html__('Gradient On Both Slides', 'thewriter') => '__gradient-both',
					),
					'std' => '',
					'dependency' => array(
						'element' => 'txt_position',
						'not_empty' => true,
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__('Overlay Color', 'thewriter'),
					'param_name' => 'img_overlay_color',
					'dependency' => array(
						'element' => 'img_overlay',
						'not_empty' => true,
					),
				),
				array(
					'type' => 'vc_grid_id',
					'param_name' => 'grid_id',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Extra class name', 'thewriter'),
					'param_name' => 'ex_class',
					'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'thewriter'),
				),
				array(
					'type' => 'css_editor',
					'heading' => esc_html__('CSS box', 'thewriter'),
					'param_name' => 'css',
					'group' => esc_html__('Design Options', 'thewriter'),
				),
			),
		) );

		$vc_social_links = array();
		$vc_social_links[] = array(
			'type' => 'checkbox',
			'heading' => esc_html__('Use brand colors', 'thewriter'),
			'param_name' => 'brand_colors',
			'group' => esc_html__('Social links', 'thewriter'),
		);
		foreach (self::$social_icons as $id => $icon_and_name) {
			$vc_social_links[] = array(
				'type' => 'textfield',
				'heading' => $icon_and_name,
				'param_name' => $id,
				'group' => esc_html__('Social links', 'thewriter'),
			);
		}
		vc_add_params( 'thewriter_vc_team_member', $vc_social_links );
	}


	/*
	 * Shortcode logic how it should be rendered
	 */
	public function render_vc_team_member($atts, $content = null) {
		$default_social_links = array();
		foreach (self::$social_icons as $id => $icon_and_name) {
			$default_social_links[$id] = '';
		}

		$default_atts = array_merge( array(
			'title' => '',
			'job' => '',
			'img' => '',
			'img_size' => 'full',
			'color_scheme' => '__light',
			'boxed' => '',
			'txt_position' => '',
			'txt_vertical_align' => '__middle',
			'txt_align' => 'text-center',
			'img_scale' => '',
			'img_filter' => '',
			'img_overlay' => '',
			'img_overlay_color' => '',
			'grid_id' => false,
			'ex_class' => false,
			'css' => false,
			'brand_colors' => false,
		), $default_social_links );

		$atts = shortcode_atts( $default_atts, $atts );

		ob_start();
		include $theme_dir . '/plugins/js_composer/templates/team_member.php';
		$output = ob_get_contents();
		ob_get_clean();

		return $output;
	}


}

ThewriterAddons::init();
