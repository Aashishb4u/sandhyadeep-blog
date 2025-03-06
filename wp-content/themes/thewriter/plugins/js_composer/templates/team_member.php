<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');

$css = $atts['css'] ? $atts['css'] : '';
$ex_class = $atts['ex_class'] ? ' ' . str_replace('.', '', $atts['ex_class']) : '';

$container_classes = vc_shortcode_custom_css_class($css, ' ') . $ex_class;

$grid_id = esc_attr(str_replace(':', '_', $atts['grid_id']));
?>

<div class="aero_addons_metabox__wrap">
			<!-- items per page -->
			<div class="thewriter__post_list_metabox__option">
				<label><?php echo __('Items Per Page', 'thewriter'); ?></label><br />
				<input type="number" name="thewriter__post_list_metabox[items_per_page]" value="<?php echo ( isset( $options[ $post_id ]['items_per_page'] ) ? $options[ $post_id ]['items_per_page'] : '10' ) ?>" />
			</div>
			<!-- items per page with max offset -->
			<div class="thewriter__post_list_metabox__option">
				<label><?php echo __('Items Per Page with max offset', 'thewriter'); ?></label><br />
				<input type="number" name="thewriter__post_list_metabox[items_per_page_with_offset]" value="<?php echo ( isset( $options[ $post_id ]['items_per_page_with_offset'] ) ? $options[ $post_id ]['items_per_page_with_offset'] : '10' ) ?>" />
			</div>
		</div>
