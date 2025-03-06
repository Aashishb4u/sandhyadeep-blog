<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');


class ThewriterModules extends ThewriterTheme {


	public static function get_count($section = 'header') {
		$count = 0;
		if (self::get_option($section . '--text')) $count++;
		if (self::get_option($section . '--social')) $count++;
		if (self::get_option($section . '--wpml_currency')) $count++;
		if (self::get_option($section . '--wpml_lang')) $count++;
		return $count;
	}


	public static function text($section = 'header', $large_text = true, $hide_on_screen_xs = true) {
		if (self::get_option($section . '--text')) { ?>
			<div class="
				mods_el
				<?php if ($hide_on_screen_xs) { ?>hidden-xs<?php } ?>
			"><div class="
				mods_el-tx
			"><?php echo wp_kses(self::get_option($section . '--text_content'), 'post'); ?></div></div>
			<?php
			if ($hide_on_screen_xs) { ?><span class="mods_el hidden-xs __separator"></span><?php }
			else if ($section == 'header') { ?><br><?php }
		}
	}


	public static function icon_social($section = 'header', $large_icon = true, $hide_on_screen_xs = true) {
		if (self::get_option($section . '--social')) {
			$social_links = self::get_option($section . '--social_links');
			foreach ($social_links as $key => $social_link) {
				if ($social_link) {
				?>
				<a
					href="<?php echo esc_url(self::get_option('social--' . $key)); ?>"
					target="_blank"
					class="mods_el<?php if ($hide_on_screen_xs) { ?> hidden-xs<?php } ?>"
				><span class="mods_el-ic"><i class="fa <?php if ($large_icon) echo 'fa-lg'; ?> fa-<?php echo esc_attr($key); ?>"></i></span></a>
				<?php
				}
			}
			if ($hide_on_screen_xs) { ?><span class="mods_el hidden-xs __separator"></span><?php }
		}
	}

	public static function icon_lwa($section = 'header', $large_icon = true) {
		if (self::get_option($section . '--login_ajax') && function_exists('login_with_ajax')) {
			if (function_exists('bp_loggedin_user_link')) {
				$profile_link = bp_loggedin_user_link();
			} else {
				$profile_link = trailingslashit(get_admin_url()) . 'profile.php';
			}
			?>
			<div class="mods_el"><div class="lwa-w">
				<a href="<?php echo esc_url($profile_link); ?>" class="js--show-next"><span class="mods_el-ic"><span class="feather-head header-icons <?php if ($large_icon) echo 'xbig'; ?>"></span></span></a>
				<?php login_with_ajax( array( 'profile_link' => 1 ) ); ?>
			</div></div>
			<?php
		}
	}

	public static function icon_currency($section = 'header', $hide_on_screen_xs = true) {
		if (self::get_option($section . '--wpml_currency')) {
			if ($hide_on_screen_xs) { ?><span class="mods_el hidden-xs __separator"></span><?php }
			?>
			<div class="mods_el<?php if ($hide_on_screen_xs) { ?> hidden-xs<?php } ?>"><?php do_action('currency_switcher', array('format' => '%symbol%', 'switcher_style' => 'list', 'orientation' => 'horizontal')); ?></div>
			<?php
		}
	}


	public static function icon_language_flags($section = 'header', $hide_on_screen_xs = true) {
		if (self::get_option($section . '--wpml_lang') && function_exists('icl_get_languages')) {
			$languages = icl_get_languages('skip_missing=0&orderby=code');
			if (!empty($languages)) {
				if ($hide_on_screen_xs) { ?><span class="mods_el hidden-xs __separator"></span><?php }
				foreach ($languages as $language) {
					?>
					<div class="mods_el<?php if ($hide_on_screen_xs) { ?> hidden-xs<?php } ?>"><?php
					if (!$language['active']) echo '<a href="' . esc_url($language['url']) . '">';
					?><img src="<?php echo esc_url($language['country_flag_url']); ?>" alt="<?php echo esc_attr($language['language_code']); ?>" width="18" height="12"> <?php
					if (!$language['active']) echo '</a>';
					?></div>
					<?php
				}
			}
		}
	}


	public static function icon_search($section = 'header', $large_icon = true) {
		if (self::get_option($section . '--search')) {
			?>
			<div class="mods_el">
				<div class="search-form-popup-w js--focus-w">
					<a href="#" class="js--search-icon-menu js--scroll-disable search_hide">
						<span class="mods_el-ic">
							<span class="feather-search header-icons <?php if ($large_icon) echo 'xbig'; ?>"></span>
						</span>
					</a>
					<?php get_search_form(); ?>
				</div>
			</div>
			<?php
		}
	}


	public static function icon_popup_menu($large_icon = true, $hide_on_screen_lg = true) {
		?>
		<span class="mods_el hidden-xs<?php if ($hide_on_screen_lg) { ?> hidden-lg<?php } ?> __separator"></span>
		<div class="mods_el<?php if ($hide_on_screen_lg) { ?> hidden-lg<?php } ?>">
			<div class="popup-menu-mod">
				<a href="#" class="js--popup-icon-menu js--scroll-disable popup_hide">
					<span class="mods_el-ic">
						<span class="icon-menu-container">
							<span class="icon-menu-first"></span>
							<span class="icon-menu-second"></span>
							<span class="icon-menu-third"></span>
						</span>
					</span>
				</a>
				<div class="popup-menu-popup js--show-me js-popup-menu-popup">
					<div class="popup-menu-popup_bg"></div>
					<span class="vertical-helper"></span>
					<nav class="popup-menu-w">
						<a href=""></a>
						<?php
							if (has_nav_menu('popup')) {
								wp_nav_menu( array(
									'theme_location' => 'popup',
									'menu' => self::get_option('menu--popup'),
									'menu_class' => 'popup-menu js-popup-menu',
									'container' => '',
								) );
							} else {
								esc_html_e('Assign a menu at Appearance > Menus', 'thewriter');
							}
						?>
					</nav>
				</div>
			</div>
		</div>
		<?php
	}


	public static function icon_mobile($section = 'header', $large_icon = true) {
		if (self::get_count($section)) {
			?>
			<div class="mods_el hidden-sm hidden-md hidden-lg"><div class="mobile-mod-w">
				<a href="#" class="js--show-next"><span class="mods_el-ic"><span class="icon-plus <?php if ($large_icon) echo 'xbig'; ?>"></span></span></a>
				<div class="mobile-mod js--show-me">
					<?php self::text($section, $large_icon, false); ?>

					<?php self::icon_social($section, $large_icon, false); ?>

					<?php self::icon_currency($section, false); ?>

					<?php self::icon_language_flags($section, false); ?>
				</div>
			</div></div>
			<?php
		}
	}


	public static function share_tooltip($tooltip_align_left = false) {
		global $post;

		$image = '';
		if (has_post_thumbnail($post->ID)) {
			$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'shop_single');
			$image = esc_attr(urlencode($image[0]));
		}

		$link = esc_attr(urlencode(get_permalink()));
		$title = esc_attr(urlencode(get_the_title()));

		if (is_singular(array('product'))) {
			$share = esc_html__('Share this product', 'thewriter');
		} elseif (is_singular('post')) {
			$share = esc_html__('Share this post', 'thewriter');
		} else {
			$share = esc_html__('Share this page', 'thewriter'); 
		}

		$tooltip_class_mod = '';
		if ($tooltip_align_left) {
			$tooltip_class_mod = '__left';
		}
		?>
		<div class="share">
		</div>
		<?php
	}


	public static function share_buttons() {
		global $post;

		$image = '';
		if (has_post_thumbnail($post->ID)) {
			$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'shop_single');
			$image = esc_attr(urlencode($image[0]));
		}

		$link = esc_attr(urlencode(get_permalink()));
		$title = esc_attr(urlencode(get_the_title()));
		?>
		<div class="social-content">
		</div>
		<?php
	}


	public static function share_icons() {
		global $post;

		$image = '';
		if (has_post_thumbnail($post->ID)) {
			$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'shop_single');
			$image = esc_attr(urlencode($image[0]));
		}

		$link = esc_attr(urlencode(get_permalink()));
		$title = esc_attr(urlencode(get_the_title()));
		?>
		<ul class="share-small">
		</ul>
		<?php
	}


}
