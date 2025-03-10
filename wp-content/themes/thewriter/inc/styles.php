<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');

function get_css_font($option) {
	$font = ThewriterOptions::get($option);
	if (!empty($font)) {
		if (!empty($font['font-family']) && !empty($font['font-backup'])) {
			echo 'font-family:' . $font['font-family'] . ', ' . $font['font-backup'] . ';';
		}
		elseif (!empty($font['font-family'])) {
			echo 'font-family:' . $font['font-family'] . ';';
		}
		if (!empty($font['font-weight'])) {
			echo 'font-weight:' . $font['font-weight'] . ';';
		}
		if (!empty($font['font-style'])) {
			echo 'font-style:' . $font['font-style'] . ';';
		}
		if (!empty($font['text-transform'])) {
			echo 'text-transform:' . $font['text-transform'] . ';';
		}
		if (!empty($font['font-size'])) {
			echo 'font-size:' . $font['font-size'] . ';';
		}
		if (!empty($font['line-height'])) {
			echo 'line-height:' . $font['line-height'] . ';';
		}
		if (!empty($font['letter-spacing'])) {
			echo 'letter-spacing:' . $font['letter-spacing'] . ';';
		}
		if (!empty($font['color'])) {
			echo 'color:' . $font['color'] . ';';
		}
	}
	$font_family = ThewriterOptions::get($option . '__custom_family');
	if ($font_family) {
		echo 'font-family:' . $font_family . ';';
	}
}

function get_css_bg($option) {
	$bg = ThewriterOptions::get($option);
	if (!empty($bg)) {
		if (!empty($bg['background-color'])) {
			echo 'background-color:' . $bg['background-color'] . ';';
		}
		if (!empty($bg['background-repeat'])) {
			echo 'background-repeat:' . $bg['background-repeat'] . ';';
		}
		if (!empty($bg['background-size'])) {
			echo 'background-size:' . $bg['background-size'] . ';';
		}
		if (!empty($bg['background-attachment'])) {
			echo 'background-attachment:' . $bg['background-attachment'] . ';';
		}
		if (!empty($bg['background-position'])) {
			echo 'background-position:' . $bg['background-position'] . ';';
		}
		if (!empty($bg['background-image'])) {
			echo 'background-image:url(' . $bg['background-image'] . ');';
		}
	}
}

function get_css_border($option, $top = true, $right = true, $bottom = true, $left = true) {
	$border = ThewriterOptions::get($option);
	$border_color = ThewriterOptions::get($option . '_color');
	if (!empty($border)) {
		echo 'border-top-width:' . (
			$top &&
			!empty($border['border-top']) &&
			$border['border-top'] !== 'px'
			? $border['border-top'] : 0
		) . ';';
		echo 'border-right-width:' . (
			$right &&
			!empty($border['border-right']) &&
			$border['border-right'] !== 'px'
			? $border['border-right'] : 0
		) . ';';
		echo 'border-bottom-width:' . (
			$bottom &&
			!empty($border['border-bottom']) &&
			$border['border-bottom'] !== 'px'
			? $border['border-bottom'] : 0
		) . ';';
		echo 'border-left-width:' . (
			$left &&
			!empty($border['border-left']) &&
			$border['border-left'] !== 'px'
			? $border['border-left'] : 0
		) . ';';
		echo 'border-style:' . (!empty($border['border-style']) ? $border['border-style'] : 'solid') . ';';
		if (!empty($border_color['rgba'])) {
			echo 'border-color:' . $border_color['rgba'] . ';';
		} else {
			echo 'border-color:' . ($border['border-color'] ? $border['border-color'] : 'inherit') . ';';
		}
	}
}

function get_css_padding($option) {
	$padding = ThewriterOptions::get($option);
	if (
		isset($padding['padding-top']) &&
		$padding['padding-top'] !== 'px' &&
		$padding['padding-top'] !== ''
	) {
		echo 'padding-top:' . $padding['padding-top'] . ';';
	}
	if (
		isset($padding['padding-right']) &&
		$padding['padding-right'] !== 'px' &&
		$padding['padding-right'] !== ''
	) {
		echo 'padding-right:' . $padding['padding-right'] . ';';
	}
	if (
		isset($padding['padding-bottom']) &&
		$padding['padding-bottom'] !== 'px' &&
		$padding['padding-bottom'] !== ''
	) {
		echo 'padding-bottom:' . $padding['padding-bottom'] . ';';
	}
	if (
		isset($padding['padding-left']) &&
		$padding['padding-left'] !== 'px' &&
		$padding['padding-left'] !== ''
	) {
		echo 'padding-left:' . $padding['padding-left'] . ';';
	}
}

function get_css_color($option) {
	$color = ThewriterOptions::get($option);
	if (!empty($color)) {
		echo 'color:' . $color . ';';
	}
}

function adjustBrightness($hex, $steps) {
	// Steps should be between -255 and 255. Negative = darker, positive = lighter
	$steps = max(-255, min(255, $steps));

	// Normalize into a six character long hex string
	$hex = str_replace('#', '', $hex);
	if (strlen($hex) == 3) {
		$hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
	}

	// Split into three parts: R, G and B
	$color_parts = str_split($hex, 2);
	$return = '#';

	foreach ($color_parts as $color) {
		$color   = hexdec($color); // Convert to decimal
		$color   = max(0,min(255,$color + $steps)); // Adjust color
		$return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
	}

	return $return;
}

function hex2rgb($hex) {
	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
	$rgb = array($r, $g, $b);
	return implode(",", $rgb);
}


// Body

?>
html {
	<?php
	get_css_bg('general_styles--bg');
	?>
}

body {
	<?php
	get_css_font('general_styles--font');
	?>
}


<?php
$is_font_second = false;

$font = ThewriterOptions::get('general_styles--font_second');
if (
	!empty($font['font-family']) ||
	!empty($font['font-weight']) ||
	!empty($font['font-style']) ||
	!empty($font['font-transform']) ||
	!empty($font['font-size']) ||
	!empty($font['line-height']) ||
	!empty($font['letter-spacing']) ||
	!empty($font['color'])
) {
	$is_font_second = true;
}
$font_family = ThewriterOptions::get('general_styles--font_second__custom_family');
if (!empty($font_family)) {
	$is_font_second = true;
}

if ($is_font_second) {
?>
	blockquote cite,
	label[for],
	input[type='button'],
	input[type='reset'],
	input[type='submit']:not(.fbq-button-invert),
	button,
	.button,
	.fbq-button,
	input[type='button'].__o,
	input[type='reset'].__o,
	input[type='submit'].__o,
	button.__o,
	.button.__o,
	input[type='button'].__light,
	input[type='reset'].__light,
	input[type='submit'].__light,
	button.__light,
	.button.__light,
	.logo_tx,
	.top-h-menu,
	.bottom-f-menu,
	.main-menu,
	.add-menu,
	.main-menu .menu-item-desc,
	.add-menu .menu-item-desc,
	.popup-menu,
	.t-w_sub-h,
	.t-w_desc.__post,
	.t-w-post-category a,
	.t-w-post-author_h,
	.t-w-subcat-el_lk,
	.main-f-top .widget_h,
	.breadcrumb,
	.sidebar .widget_h,
	.widget_calendar caption,
	.widget_tag_cloud a,
	.widget_product_tag_cloud a,
	.widget_price_filter button,
	.widget_layered_nav_filters a,
	.rpwwt-widget .rpwwt-post-date,
	.product_list_widget .quantity,
	.widget_shopping_cart .total strong,
	.minicart .total strong,
	.widget_shopping_cart .total .amount,
	.minicart .total .amount,
	.widget_shopping_cart .button:first-child,
	.minicart .button:first-child,
	.minicart_count,
	.lwa-title-sub,
	.lwa-info li,
	.share_tx,
	.share-alt_btn,
	.search-el_meta,
	.search-el_type,
	.no-results-page_lbl.__404,
	.post-standard_category a,
	.post-standard_btn,
	.post-standard_date,
	.post-standard_comments,
	.post-standard.__quote .post-standard_h,
	.post-standard.__link .post-standard_h,
	.post-standard.__status .post-standard_h,
	.post-boxed_category a,
	.post-boxed_meta,
	.post-boxed.__quote .post-boxed_h,
	.post-boxed.__link .post-boxed_h,
	.post-boxed.__status .post-boxed_h,
	.post-grid_category a,
	.post-grid_meta,
	.post-grid.__quote .post-grid_h,
	.post-grid.__link .post-grid_h,
	.post-grid.__status .post-grid_h,
	.post-masonry_category a,
	.post-masonry_btn,
	.post-masonry_date,
	.post-masonry_comments,
	.post-masonry.__quote .post-masonry_h,
	.post-masonry.__link .post-masonry_h,
	.post-masonry.__status .post-masonry_h,
	.post-masonry.__quote .post-masonry_desc a:hover,
	.post-masonry.__link .post-masonry_desc a:hover,
	.post-masonry.__status .post-masonry_desc a:hover,
	.post-metro_category a,
	.post-metro_date,
	.post-metro.__quote .post-metro_h,
	.post-metro.__link .post-metro_h,
	.post-metro.__status .post-metro_h,
	.post-single-cats,
	.post-single-date,
	.post-single-tags_h,
	.post-single-tags a,
	.post-single-author_h,
	.posts-nav-prev a,
	.posts-nav-next a,
	.post-nav-prev_desc,
	.post-nav-next_desc,
	.comments-h,
	.comment-author,
	.comment-date,
	.comment-reply,
	.comment-reply-title,
	.comment-navigation .nav-previous,
	.comment-navigation .nav-next,
	.amount,
	.price,
	.stock,
	.wc-message_cnt a,
	.add_to_cart_inline .added_to_cart,
	.cat-lst-el_lbl,
	.cat-lst-el_btn-w .added_to_cart,
	.cat-lst-el-btn,
	.cat-lst-el-btn.__quick_view,
	.cat-lst-pagination,
	.product_lbl,
	.product_review-lk,
	.product-variations_h,
	.product-tabs-el_lk,
	.product-comments-h,
	.product-comments-lst-el_author,
	.product-add-comment_lbl,
	.product-additional-info-el_h,
	.product-meta-el_h,
	.product-meta-el_cnt,
	.cart-lst-el_h,
	.cart-coupon_h,
	.cart-coupon_it,
	.cart-totals_h,
	.cart-totals-lst-el_h,
	.cart-el-variation,
	.shipping-calculator-button,
	.cross-sells_h,1
	.checkout-coupon_h,
	.checkout-coupon_it,
	.checkout-billing_h,
	.checkout-shipping_h,
	.checkout-review-order_h,
	.checkout-review-order_cnt th,
	.checkout-review-order_cnt .product-quantity,
	.wc-account_h,
	.wc-account-address_h,
	.wc-account-address_edit,
	.wc-account-address-form_h,
	.wc-account-login_h,
	.wc-account-register_h,
	.wc-account-reset-password_h,
	.wc-account-edit_h,
	.wc-account-login_form_h,
	.wc-account-register_form_h,
	.wc-account-reset-password_form_h,
	.wc-account-edit_form_h,
	.wc-account-login_separator,
	.wc-account-login-tabs_lk,
	.wc-account-edit-password_h,
	.wc-account-orders_h,
	.wc-account-orders-el_h,
	.wc-account-order-card_h,
	.wc-account-order-el_h,
	.wc-account-order-el_cnt,
	.wc-account-order-el_cnt .variation,
	.track-order_h,
	.wc-thankyou-order-received,
	.ninja-forms-form label,
	.vc_progress_bar .vc_general.vc_single_bar .vc_label,
	.uvc-heading .uvc-main-heading h1,
	.uvc-heading .uvc-main-heading h2,
	.uvc-heading .uvc-main-heading h3,
	.uvc-heading .uvc-main-heading h4,
	.uvc-heading .uvc-main-heading h5,
	.uvc-heading .uvc-main-heading h6,
	.uvc-sub-heading,
	.ult-ib-effect-style1 .ult-new-ib-title,
	.flip-box-wrap .flip-box h3,
	.flip-box-wrap .flip_link a,
	.ultb3-title,
	a.ultb3-btn,
	.ult_countdown,
	.wpb_row .wpb_column .wpb_wrapper .ult_countdown,
	.uvc-type-wrap,
	.stats-block .stats-desc,
	.ult_design_1.ult-cs-black .ult_pricing_table .ult_price_link .ult_price_action_button,
	.ult_design_1.ult-cs-red .ult_pricing_table .ult_price_link .ult_price_action_button,
	.ult_design_1.ult-cs-blue .ult_pricing_table .ult_price_link .ult_price_action_button,
	.ult_design_1.ult-cs-yellow .ult_pricing_table .ult_price_link .ult_price_action_button,
	.ult_design_1.ult-cs-green .ult_pricing_table .ult_price_link .ult_price_action_button,
	.ult_design_1.ult-cs-gray .ult_pricing_table .ult_price_link .ult_price_action_button,
	.ult_featured.ult_design_1 .ult_pricing_table:before,
	.ult_design_1 .ult_pricing_heading .cust-subhead,
	.ult_design_1 .ult_price_body_block,
	.ult_design_4 .ult_pricing_table .ult_pricing_heading h3,
	.ult_design_4 .ult_pricing_table .ult_price_link .ult_price_action_button,
	.vc_general.vc_btn3,
	.vc_grid-filter.vc_grid-filter-default > .vc_grid-filter-item,
	.grid-without-img-el_date,
	.grid-without-img-alt-el_date,
	.grid-def-el_category a,
	.grid-def-el_h,
	.grid-def-el_meta,
	.team-member_job,
	.timeline-separator-text .sep-text,
	.timeline-block .timeline-header h3,
	.timeline-header-block .timeline-header h3,
	.dropcaps_1:first-letter,
	.dropcaps_2:first-letter,
	.dropcaps_3:first-letter,
	.dropcaps_4:first-letter,
	.dropcaps_5:first-letter,
	.dropcaps_6:first-letter,
	.dropcaps_7:first-letter,
	.dropcaps_8:first-letter,
	.dropcaps_9:first-letter,
	.dropcaps_1b:first-letter,
	.dropcaps_2b:first-letter,
	.dropcaps_3b:first-letter,
	.dropcaps_4b:first-letter,
	.dropcaps_5b:first-letter,
	.dropcaps_6b:first-letter,
	.dropcaps_7b:first-letter,
	.dropcaps_8b:first-letter,
	.dropcaps_9b:first-letter
	{
		<?php
		get_css_font('general_styles--font_second');
		?>
	}


	@media (min-width: 992px) {
		.wc-message_cnt a {
			<?php
			get_css_font('general_styles--font_second');
			?>
		}
	}
<?php
}


// Accent color

$accent_color = esc_attr(ThewriterOptions::get('general_styles--accent'));

if (!empty($accent_color)) {
	$accent_color_hover = adjustBrightness($accent_color, -33);
?>

	a,
	blockquote:before,
	.main-h-bottom.__dark .mods_el-ic:hover,
	.main-h-bottom.__fixed .mods_el-ic:hover,
	.mobile-mod .mods_el-ic:hover,
	.bottom-f-menu .current-menu-ancestor>a,
	.bottom-f-menu .current-menu-item>a,
	.top-h-menu .current-menu-ancestor>a,
	.top-h-menu .current-menu-item>a,
	.bottom-f-menu a:hover,
	.top-h-menu a:hover,
	.main-h-bottom.__dark .add-menu .menu-item:hover>a,
	.main-h-bottom.__dark .main-menu .menu-item:hover>a,
	.add-menu .current-menu-ancestor>a,
	.add-menu .current-menu-item>a,
	.main-menu .current-menu-ancestor>a,
	.main-menu .current-menu-item>a,
	.popup-menu a.side,
	.main-f-bottom .mods_el-tx a:hover,
	.single_post_cat_h a,
	.search_cat.post_cat_h,
	.widget_archive a:hover,
	.widget_meta a:hover,
	.widget_nav_menu a:hover,
	.widget_pages a:hover,
	.widget_recent_entries a:hover,
	.widget_text a:hover,
	.widget_recent_comments a:hover,
	.widget_product_tag_cloud a,
	.widget_tag_cloud a,
	.widget_product_categories a:hover,
	.widget_product_categories .current-cat a,
	.widget_price_filter button,
	.widget_price_filter button:hover,
	.widget_layered_nav a:hover,
	.widget_layered_nav_filters a:hover,
	.rpwwt-widget ul li a:hover,
	.product_list_widget a:hover,
	.product_list_widget .amount,
	.minicart .total .amount,
	.widget_shopping_cart .total .amount,
	.lwa-info a:hover,
	.share:hover .share_h,
	.widget .search-form_button:hover,
	.no-results-page_lbl,
	.no-results-page_lk,
	.post-standard_category,
	.post-standard_h a:hover,
	.post-standard_btn,
	.post-standard .share-small,
	.post-boxed_category,
	.post-grid.__audio .post-grid_img-lk:after,
	.post-grid.__video .post-grid_img-lk:after,
	.post-boxed.__audio .post-boxed_img-lk:after,
	.post-boxed.__video .post-boxed_img-lk:after,
	.post-masonry_category,
	.post-masonry_h a:hover,
	.post-masonry_btn,
	.post-masonry .share-small,
	.post-boxed.__quote .post-boxed_desc .post_cat_h a:hover,
	.post-boxed.__link .post-boxed_desc .post_cat_h a:hover,
	.post-boxed.__status .post-boxed_desc .post_cat_h a:hover,
	.post-boxed.__quote .post-boxed_desc a:hover,
	.post-boxed.__link .post-boxed_desc a:hover,
	.post-boxed.__status .post-boxed_desc a:hover,
	.post-masonry.__quote .post-masonry_desc a:hover,
	.post-masonry.__link .post-masonry_desc a:hover,
	.post-masonry.__status .post-masonry_desc a:hover,
	.posts-nav-next_ic,
	.posts-nav-prev_ic,
	.posts-nav-next:hover .posts-nav-next_ic,
	.posts-nav-prev:hover .posts-nav-prev_ic,
	.post-nav-prev i,
	.post-nav-next i,
	.post-nav-next_ic,
	.post-nav-prev_ic,
	.post-nav-next:hover .post-nav-next_h,
	.post-nav-prev:hover .post-nav-prev_h,
	#cancel-comment-reply-link:hover,
	.comment-reply-link:hover,
	.comment-reply-link,
	.cat-lst-el_price,
	.cat-lst-pagination a:hover,
	.coub_elem:before,
	.widget_recent_comments a:hover,
	.social-footer a:hover i,
	.post-masonry_top_part .t-w-post-author:hover .post-masonry_author,
	.post-grid_top_part .t-w-post-author:hover .post-masonry_author,
	.nav_pages_links a:hover,
	.bottom_next_link.active .post-nav-next_desc:hover,
	.bottom_prev_link.active .post-nav-prev_desc:hover,
	.main-menu a:hover,
	.main-h-bottom_menu-and-mods .mods_el-ic:hover
	{
		color: <?php echo esc_attr($accent_color); ?>;
	}
	
	.stck_svg .stck {
		fill: <?php echo esc_attr($accent_color); ?>;
	}

	.stats-block .counter_prefix,
	.stats-block .counter_suffix,
	.ac_color 
	{
		color: <?php echo esc_attr($accent_color); ?> !important;
	}


	@media (max-width: 991px) {
		.search-page .search-form_button:hover
		{
			color: <?php echo esc_attr($accent_color); ?>;
		}
	}


	::-moz-selection {
		background-color: <?php echo esc_attr($accent_color); ?>;
	}

	::selection {
		background-color: <?php echo esc_attr($accent_color); ?>;
	}

	.add-menu .sub-menu,
	.main-menu .sub-menu,
	.add-menu .sub-menu .current-menu-ancestor>a,
	.add-menu .sub-menu .current-menu-item>a,
	.add-menu .sub-menu .menu-item:hover>a,
	.main-menu .sub-menu .current-menu-ancestor>a,
	.main-menu .sub-menu .current-menu-item>a,
	.main-menu .sub-menu .menu-item:hover>a,
	.widget_product_tag_cloud a:hover,
	.widget_tag_cloud a:hover,
	.widget_layered_nav_filters a:hover,
	.minicart_count,
	.search-el_type,
	.post-grid.__audio .post-grid_img-lk:after,
	.post-grid.__video .post-grid_img-lk:after ,
	.post-boxed.__audio .post-boxed_img-lk:after,
	.post-boxed.__video .post-boxed_img-lk:after,
	.post-single-tags a:hover,
	.fbq-sm-button:hover,
	.add_to_cart_inline .added_to_cart,
	.add_to_cart_inline .added_to_cart:hover,
	.grid-without-img-alt-el:hover,
	.team-member_soc-lk:hover,
	.coub_elem,
	.coub_elem:before,
	.popup-menu-popup,
	.search-form-popup-w .search-form,
	.uavc-icons .aio-icon:hover,
	.__sticky:before
	{
		background-color: <?php echo esc_attr($accent_color); ?>;
	}

	.button:hover,
	.fbq-button:hover,
	button:hover,
	input[type=button]:hover,
	input[type=reset]:hover,
	input[type=submit]:not(.fbq-button-invert):hover 
	{
		background-color: <?php echo esc_attr($accent_color_hover); ?>;
		border-color: <?php echo esc_attr($accent_color_hover); ?>;
	}

	@keyframes somecssload-thing_maybe_cool_idk {
	    50% {
	        background-color: <?php echo esc_attr($accent_color); ?>;
	    }
	}

	@-o-keyframes somecssload-thing_maybe_cool_idk {
	    50% {
	        background-color: <?php echo esc_attr($accent_color); ?>;
	    }
	}

	@-webkit-keyframes somecssload-thing_maybe_cool_idk {
	    50% {
	        background-color: <?php echo esc_attr($accent_color); ?>;
	    }
	}

	@-moz-keyframes somecssload-thing_maybe_cool_idk {
	    50% {
	        background-color: <?php echo esc_attr($accent_color); ?>;
	    }
	}

	.ac_bg_color 
	{
		background-color: <?php echo esc_attr($accent_color); ?> !important;
	}

	.popup-menu-popup_bg
	{
		background-color: rgba(<?php echo hex2rgb($accent_color); ?>,0.98);
	}

	.uavc-icons .aio-icon:hover,
	.vc_row .uavc-icons .aio-icon:hover,
	{
		background: <?php echo esc_attr($accent_color); ?> !important;
	}

	blockquote,
	.team-member_cnt
	{
		border-top-color: <?php echo esc_attr($accent_color); ?>;
	}

	.ult-cs-black.ult_design_4 .ult_pricing_table,
	.dropcaps_8:first-letter,
	.dropcaps_8b:first-letter
	{
		border-top-color: <?php echo esc_attr($accent_color); ?> !important;
	}

	.vc_grid-filter.vc_grid-filter-default > .vc_grid-filter-item.vc_active,
	.dropcaps_8:first-letter,
	.dropcaps_8b:first-letter,
	.widget_h_helper
	{
		border-bottom-color: <?php echo esc_attr($accent_color); ?>;
	}


	.post-standard.__sticky:before,
	.post-boxed.__sticky:before,
	.post-grid.__sticky:before,
	.post-masonry.__sticky:before,
	.post-metro.__sticky:before,
	.ui-slider .ui-slider-handle,
	.vc_toggle_round.vc_toggle_color_inverted .vc_toggle_icon,
	.vc_tta-accordion.vc_tta-style-outline.vc_tta-shape-square.vc_tta-color-black .vc_tta-controls-icon::before,
	.vc_tta-accordion.vc_tta-style-outline.vc_tta-shape-square.vc_tta-color-black .vc_tta-controls-icon::after,
	.vc_tta-accordion.vc_tta-style-outline.vc_tta-shape-square.vc_tta-color-black .vc_active .vc_tta-panel-heading .vc_tta-controls-icon::before,
	.vc_tta-accordion.vc_tta-style-outline.vc_tta-shape-square.vc_tta-color-black .vc_tta-panel-heading:focus .vc_tta-controls-icon::before,
	.vc_tta-accordion.vc_tta-style-outline.vc_tta-shape-square.vc_tta-color-black .vc_tta-panel-heading:hover .vc_tta-controls-icon::before,
	.vc_tta-accordion.vc_tta-style-outline.vc_tta-shape-square.vc_tta-color-black .vc_active .vc_tta-panel-heading .vc_tta-controls-icon::after,
	.vc_tta-accordion.vc_tta-style-outline.vc_tta-shape-square.vc_tta-color-black .vc_tta-panel-heading:focus .vc_tta-controls-icon::after,
	.vc_tta-accordion.vc_tta-style-outline.vc_tta-shape-square.vc_tta-color-black .vc_tta-panel-heading:hover .vc_tta-controls-icon::after,
	.vc_tta-tabs.vc_tta-style-outline.vc_tta-o-no-fill.vc_tta-color-black .vc_tta-tab.vc_active > a,
	.dropcaps_4:first-letter,
	.dropcaps_4b:first-letter,
	.post-single-tags a:hover,
	input[type='button'],
	input[type='reset'],
	input[type='submit']:not(.fbq-button-invert),
	button,
	.button,
	.fbq-button,
	.cat-lst-el_btn-w .added_to_cart,
	.fbq-sm-button:hover,
	.widget_product_tag_cloud a:hover,
	.product-tabs-el:hover,
	.widget_tag_cloud a:hover,
	.share-small_btn:hover,
	.ui-tabs-active.product-tabs-el,
	.fbq-sm-button-invert,
	.cat-lst-el-btn.__quick_view,
	.fbq-button-invert,
	.wc-message_cnt a
	{
		border-color: <?php echo esc_attr($accent_color); ?>;
	}

	.ac_border_color,
	.fbq-sm-button-invert:hover,
	.cat-lst-el-btn.__quick_view:hover
	{
		border-color: <?php echo esc_attr($accent_color); ?> !important;
	}


	a:hover,
	.widget_price_filter button:hover,
	.posts-nav-prev:hover .posts-nav-prev_ic,
	.posts-nav-next:hover .posts-nav-next_ic,
	.checkout-payment ul label a:hover,
	.sidebar .widget_categories ul li:hover a,
	.__image .post-standard_comments:hover
	{
		color: <?php echo esc_attr($accent_color_hover); ?>;
	}


	.add_to_cart_inline .added_to_cart:hover,
	.vc_toggle_simple .vc_toggle_title:hover .vc_toggle_icon::after,
	.vc_toggle_simple .vc_toggle_title:hover .vc_toggle_icon::before,
	.vc_toggle_round .vc_toggle_title:hover .vc_toggle_icon,
	.vc_toggle_round.vc_toggle_color_inverted .vc_toggle_title:hover .vc_toggle_icon::before,
	.vc_toggle_round.vc_toggle_color_inverted .vc_toggle_title:hover .vc_toggle_icon::after,
	.flip-box-wrap .flip_link a:hover,
	.ult_design_1.ult-cs-black .ult_pricing_table .ult_price_link .ult_price_action_button:hover,
	.ult_design_1.ult-cs-red .ult_pricing_table .ult_price_link .ult_price_action_button:hover,
	.ult_design_1.ult-cs-blue .ult_pricing_table .ult_price_link .ult_price_action_button:hover,
	.ult_design_1.ult-cs-yellow .ult_pricing_table .ult_price_link .ult_price_action_button:hover,
	.ult_design_1.ult-cs-green .ult_pricing_table .ult_price_link .ult_price_action_button:hover,
	.ult_design_1.ult-cs-gray .ult_pricing_table .ult_price_link .ult_price_action_button:hover
	{
		background-color: <?php echo esc_attr($accent_color_hover); ?>;
	}


	.vc_toggle_round.vc_toggle_color_inverted .vc_toggle_title:hover .vc_toggle_icon
	{
		border-color: <?php echo esc_attr($accent_color_hover); ?>;
	}

<?php } ?>

<?php
$logo = '';
$logo = ThewriterOptions::get('header--logo_dark');
$logo_retina = '';
$logo_retina = ThewriterOptions::get('header--logo_dark_retina');
$retina = is_array($logo_retina) && $logo_retina['url'] ? true : false;

$logo_light = '';
$logo_light = ThewriterOptions::get('header--logo_light');
$logo_light_retina = '';
$logo_light_retina = ThewriterOptions::get('header--logo_light_retina');
$retina_light = is_array($logo_light_retina) && $logo_light_retina['url'] ? true : false;

if ((is_array($logo) && $logo['url']) || (is_array($logo_light) && $logo_light['url'])) {
	if($logo_retina){
?>
	<!-- .pace {
		width:<?php //echo esc_attr($logo['width'])+100 ?>px;
		height:<?php //echo esc_attr($logo['height'])+45 ?>px;
		background-image:url(<?php //echo esc_url($logo_retina['url']); ?>);
		background-size: <?php //echo esc_attr($logo['width']) ?>px <?php //echo esc_attr($logo['height']) ?>px;
	} -->
	<?php
	} else {
	?>
		.pace {
			width:<?php echo esc_attr($logo['width'])+100 ?>px;
			height:<?php echo esc_attr($logo['height'])+45 ?>px;
			background-image:url(<?php echo esc_url($logo['url']); ?>);
		}
	<?php
	}
} else {
	?>
		.pace:before {
			content: '<?php bloginfo('name'); ?>';
		}
	<?php
}
?>

<?php
$boxed = ThewriterOptions::get('layout--boxed');
if ($boxed == 'boxed' || $boxed == 'boxed_laterals') {
?>

	@media (min-width: 992px) {
		.main-w {
			margin-left:auto;
			margin-right:auto;
			max-width:992px;
			<?php if ($boxed == 'boxed') { ?>
				margin-top:45px;
				margin-bottom:45px;
			<?php } ?>
		}

		.main-h-bottom.__fixed {
			width:100%!important;
		}

		.main-cnts-w {
			overflow:hidden;
		}
	}

	@media (min-width: 1200px) {
		.main-w {
			max-width:1200px;
		}
	}

	@media (min-width: 1260px) {
		.main-w {
			max-width:1260px;
		}
	}

<?php
} elseif ($boxed == 'bordered') {
	$border = ThewriterOptions::get('layout--border');
	if (!empty($border)) {
?>

	@media (min-width: 992px) {
		.main-w {
			<?php
			echo 'margin-top:' . (
				!empty($border['border-top']) && $border['border-top'] !== 'px'
				? $border['border-top'] : 0) . ';';
			echo 'margin-right:' . (
				!empty($border['border-right']) && $border['border-right'] !== 'px'
				? $border['border-right'] : 0) . ';';
			echo 'margin-bottom:' . (
				!empty($border['border-bottom']) && $border['border-bottom'] !== 'px'
				? $border['border-bottom'] : 0) . ';';
			echo 'margin-left:' . (
				!empty($border['border-left']) && $border['border-left'] !== 'px'
				? $border['border-left'] : 0) . ';';
			?>
		}

		.main-h-bottom.__fixed {
			<?php
			echo 'top:' . (
				!empty($border['border-top']) && $border['border-top'] !== 'px'
				? $border['border-top'] : 0) . ';';
			echo 'left:' . (
				!empty($border['border-left']) && $border['border-left'] !== 'px'
				? $border['border-left'] : 0) . ';';
			echo 'right:' . (
				!empty($border['border-right']) && $border['border-right'] !== 'px'
				? $border['border-right'] : 0) . ';';
			?>
		}

		.main-cnts-w {
			overflow:hidden;
		}

		.post-nav-prev.__fixed {
			<?php
			echo 'left:' . (
				!empty($border['border-left']) && $border['border-left'] !== 'px'
				? $border['border-left'] : 0) . ';';
			?>
		}

		.post-nav-next.__fixed {
			<?php
			echo 'right:' . (
				!empty($border['border-right']) && $border['border-right'] !== 'px'
				? $border['border-right'] : 0) . ';';
			?>
		}

		.vc_row[data-vc-stretch-content] {
			<?php
			echo 'border-left:' . (
				!empty($border['border-left']) && $border['border-left'] !== 'px'
				? $border['border-left'] : 0) . ' solid transparent !important;';
			echo 'border-right:' . (
				!empty($border['border-right']) && $border['border-right'] !== 'px'
				? $border['border-right'] : 0) . ' solid transparent !important;';
			?>
			background-clip:padding-box;
		}

		.main-brd.__top {
			<?php
			get_css_border('layout--border', true, false, false, false);
			?>
		}
		.main-brd.__right {
			<?php
			get_css_border('layout--border', false, true, false, false);
			?>
		}
		.main-brd.__bottom {
			<?php
			get_css_border('layout--border', false, false, true, false);
			?>
		}
		.main-brd.__left {
			<?php
			get_css_border('layout--border', false, false, false, true);
			?>
		}
	}

<?php
	}
}


if (ThewriterOptions::get('header--header_width') == 'compact') {
	?>
	.main-h-bottom > .container {
		max-width:970px;
	}
	<?php
}
elseif (ThewriterOptions::get('header--header_width') == 'expanded') {
	?>
	@media (min-width: 768px) {
		.main-h-bottom > .container {
			width:100%;
			padding-right:30px;
			padding-left:30px;
		}
	}
	@media (min-width: 1200px) {
		.main-h-bottom:not(.__boxed) > .container {
			padding-right:60px;
			padding-left:60px;
		}
	}
	<?php
}



if (ThewriterOptions::get('top_header--header_width') == 'compact') {
	?>
	.main-h-top > .container {
		max-width:970px;
	}
	<?php
} elseif (ThewriterOptions::get('top_header--header_width') == 'expanded' && ThewriterOptions::get('layout--header_width') != 'expanded') {
	?>
	@media (min-width: 768px) {
		.main-h-top > .container {
			width:100%;
			padding-right:30px;
			padding-left:30px;
		}
	}
	@media (min-width: 1200px) {
		.main-h-top > .container {
			padding-right:60px;
			padding-left:60px;
		}
	}
	<?php
}

if (ThewriterOptions::get('layout--content_width') == 'compact') {
	?>
	.main-cnts-w > .container,
	.main-cnts-before > .container,
	.main-cnts-after > .container {
		max-width:970px;
	}
	<?php
}
elseif (ThewriterOptions::get('layout--content_width') == 'expanded') {
	?>
	@media (min-width: 768px) {
		.main-cnts-w > .container,
		.main-cnts-before > .container,
		.main-cnts-after > .container {
			width:100%;
			max-width:1740px;
			padding-right:30px;
			padding-left:30px;
		}
		<?php if (get_post_type() == 'post' && ThewriterOptions::get('posts--view') == 'metro') { ?>
			.blog .main-cnts-w > .container,
			.archive .main-cnts-w > .container {
				max-width:none;
			}
		<?php } ?>
	}
	@media (min-width: 1200px) {
		.main-cnts-w > .container,
		.main-cnts-before > .container,
		.main-cnts-after > .container {
			padding-right:60px;
			padding-left:60px;
		}
	}
	<?php
}

if (ThewriterOptions::get('layout--footer_width') == 'compact') {
	?>
	.main-f-top > .container,
	.main-f-bottom > .container {
		max-width:970px;
	}
	<?php
}
elseif (ThewriterOptions::get('layout--footer_width') == 'expanded') {
	?>
	@media (min-width: 768px) {
		.main-f-top > .container,
		.main-f-bottom > .container {
			width:100%;
			max-width:1740px;
			padding-right:30px;
			padding-left:30px;
		}
	}
	@media (min-width: 1200px) {
		.main-f-top > .container,
		.main-f-bottom > .container {
			padding-right:60px;
			padding-left:60px;
		}
	}
	<?php
}


// Top header styles

if (ThewriterOptions::get('top_header')) {
?>

	.main-h-top {
		<?php
		get_css_border('top_header_styles--border');

		get_css_padding('top_header_styles--padding');

		get_css_bg('top_header_styles--bg');
		?>
	}

	.main-h-top .mods_el-tx,
	.main-h-top .mods_el-menu,
	.main-h-top .mods_el-ic {
		<?php
		get_css_font('top_header_styles--font');
		?>
	}

<?php
}


// Header styles

if (ThewriterOptions::get('header')) {
?>

	.main-h-bottom-w {
		<?php
		get_css_border('header_styles--border');

		get_css_padding('header_styles--padding');
		?>
	}
	
	@media (min-width:768px) {
		.__layout3 .main-h-bottom_menu-and-mods {
			<?php
			get_css_border('header_styles--header_menu-border');
			?>
		}
	}

	.main-h-bottom:not(.__fixed) .mods-w.__with_separator:before {
		<?php
		$border_color = ThewriterOptions::get('header_styles--header_menu-border_color');
		if (!empty($border_color['rgba'])) {
			echo 'border-color:' . $border_color['rgba'] . ';';
		}
		?>
	}

	.main-h-bottom:not(.__fixed) .logo-w {
		<?php
		get_css_padding('header_styles--logo_padding');
		?>
	}

	.main-h-bottom:not(.__fixed) .mods {
		<?php
		get_css_padding('header_styles--mods_padding');
		?>
	}

	.main-h-bottom:not(.__fixed) .main-menu-w {
		<?php
		get_css_padding('header_styles--menu_padding');
		?>
	}

	.main-h-bottom:not(.__fixed) .add-menu-w {
		<?php
		get_css_padding('header_styles--additional_menu_padding');
		?>
	}

	.logo-w,
	.main-menu,
	.add-menu,
	.popup-menu,
	.mobile-menu,
	.main-h-bottom .mods_el-tx,
	.main-h-bottom .mods_el-ic {
		<?php
		get_css_font('header_styles--font');
		?>
	}

<?php
}


// Title wrapper styles

if (ThewriterHelpers::is_title_wrapper() && have_posts()) {
?>

	.t-w {
		<?php
		get_css_border('title_wrapper_styles--border');

		get_css_padding('title_wrapper_styles--padding');

		echo 'text-align:' . ThewriterOptions::get('title_wrapper_styles--align') . ';';
		?>
	}

	.t-w_bg {
		<?php
		get_css_bg('title_wrapper_styles--bg');
		?>
	}

	.breadcrumb {
		<?php
		get_css_font('title_wrapper_styles--font_breadcrumb');
		?>
	}

	.t-w_sub-h,
	.t-w_subcat {
		<?php
		$sub_header_color = ThewriterOptions::get('title_wrapper_styles--font_title');
		if (!empty($sub_header_color['color'])) {
			echo 'color:' . $sub_header_color['color'] . ';';
		}
		?>
	}

	.t-w_h {
		<?php
		get_css_font('title_wrapper_styles--font_title');
		?>
	}

	.t-w_desc {
		<?php
		get_css_font('title_wrapper_styles--font_desc');
		?>
	}

	@media (min-width: 768px) {
		.t-w_desc {
			<?php
			echo 'margin-' . ThewriterOptions::get('title_wrapper_styles--align') . ':0;';
			?>
		}
	}

<?php
}


// Content styles

?>
.main-cnts-w {
	<?php
	get_css_border('content_styles--border');

	get_css_padding('content_styles--padding');
	?>
}

.single-post .main-cnts-w {
	<?php
	get_css_padding('content_styles--padding');
	?>
}
<?php


// Footer styles

if (ThewriterOptions::get('footer')) {
?>

	.main-f-top {
		<?php
		get_css_border('footer_styles--border');

		get_css_padding('footer_styles--padding');

		get_css_bg('footer_styles--bg');

		get_css_font('footer_styles--font');
		?>
	}

	.main-f-top .widget_h,
	.main-f-top .widget .fa,
	.rpwwt-widget ul li a {
		<?php
		get_css_font('footer_styles--font_widget');
		?>
	}

<?php
}


// Bottom footer styles

if (ThewriterOptions::get('bottom_footer')) {
?>

	.main-f-bottom {
		<?php
		get_css_border('bottom_footer_styles--border');

		get_css_padding('bottom_footer_styles--padding');

		get_css_bg('bottom_footer_styles--bg');
		?>
	}

	.main-f-bottom .mods_el-tx,
	.main-f-bottom .mods_el-menu,
	.main-f-bottom .mods_el-ic {
		<?php
		get_css_font('bottom_footer_styles--font');
		?>
	}

<?php
}

// Archive body background for blocks

$post_view = ThewriterOptions::get('posts--view');
if ( $post_view == 'blocks' ) {
?>
	.archive .main-cnts-w {
		background-color: #f3f4f6;
	}
<?php
}

// Body bg

$accent_body_color = esc_attr(ThewriterOptions::get('general_styles--body_background'));

if ($accent_body_color) {
?>

	body .main-cnts-w {
		background-color: <?php echo esc_attr($accent_body_color) ?>;
	}

<?php
}

// layout3 padding-bottom @media < 1200

$header__layout = ThewriterOptions::get('header--layout');

if ($header__layout == 'layout3'){
	$header__arr_paddings = ThewriterOptions::get('header_styles--padding' );
	$header__padd_top = (isset($header__arr_paddings['padding-top']) && !empty($header__arr_paddings['padding-top']) ? intval($header__arr_paddings['padding-top']) : '20');
	?>
	@media (max-width:1200px){
		.__layout3-helper {
			padding-bottom: <?php echo esc_attr($header__padd_top); ?>px !important;
		}
	}
	<?php
}

?>

