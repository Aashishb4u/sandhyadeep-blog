<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');

$header_layout = ThewriterOptions::get('header--layout');

$mobile_menu = ThewriterOptions::get('header--mobile_menu');

$hide_on_screen_lg = $header_layout == 'layout7' || $header_layout == 'layout8' ? false : true;

ob_start();
$is_logo = ( ThewriterHelpers::get_logo() ? ' __logo_img' : ' __logo_text' );
ob_end_clean();
?>

<div class="main-h-bottom-w <?php echo '__' . esc_attr($header_layout) . '-helper'; echo esc_attr($is_logo); ?>"><div class="
	main-h-bottom
	js--main-h-bottom
	<?php
	echo ' __' . esc_attr(ThewriterOptions::get('header--color_scheme'));
	echo ' __' . esc_attr($header_layout);
	if (ThewriterOptions::get('header--boxed')) { echo ' __boxed'; }
	if (ThewriterOptions::get('header--fixed')) { echo ' js--fixed-header'; }
	?>
"><div class="container"><div class="main-h-bottom-cnt">


	<?php if (
		$header_layout == 'layout2' ||
		$header_layout == 'layout5'
	) { ?>

		<div class="main-h-bottom_add-menu <?php if ($mobile_menu) { echo 'hidden-xs hidden-sm hidden-md'; } ?>">

			<nav class="add-menu-w"><?php
				if (has_nav_menu('additional')) {
					wp_nav_menu( array(
						'theme_location' => 'additional',
						'menu' => ThewriterOptions::get('menu--additional'),
						'menu_class' => 'js--scroll-nav add-menu',
						'container' => '',
					) );
				} else {
					esc_html_e('Assign a menu at Appearance > Menus', 'thewriter');
				}
			?></nav>

		</div>

	<?php } ?>


	<?php if ($header_layout != 'layout2' && $header_layout != 'layout5') { ThewriterHelpers::get_logo(); } ?>


	<div class="main-h-bottom_menu-and-mods<?php echo esc_html(( $header_layout == 'layout8' ? ' main-h-bottom_menu-and-mods_large' : '' ))?>">

		<?php if (
			$header_layout != 'layout4' &&
			$header_layout != 'layout5' &&
			$header_layout != 'layout6'
		) { ?>
			<div class="mods-w<?php
				if ($header_layout == 'layout1' && ThewriterOptions::get('header--separator')) {
					?> __with_separator<?php
				}
			?>">

				<div class="mods">

					<?php if ($header_layout != 'layout8') { ?>

						<?php ThewriterModules::icon_mobile(); ?>

						<?php ThewriterModules::text(); ?>

						<?php ThewriterModules::icon_lwa(); ?>

						<?php ThewriterModules::icon_search(); ?>

						<?php ThewriterModules::icon_social(); ?>

						<?php ThewriterModules::icon_currency(); ?>

						<?php ThewriterModules::icon_language_flags(); ?>

					<?php } ?>

					<?php if ($mobile_menu || $hide_on_screen_lg) { ?>
						<?php ThewriterModules::icon_popup_menu(true, $hide_on_screen_lg); ?>
					<?php } ?>

				</div>

			</div>
		<?php } elseif ($mobile_menu) { ?>
			<div class="mods-w hidden-lg">
				<div class="mods">
					<?php ThewriterModules::icon_popup_menu(); ?>
				</div>
			</div>
		<?php } ?>

		<?php if (
			$header_layout != 'layout7' &&
			$header_layout != 'layout8'
		) { ?>
			<nav class="main-menu-w <?php if ($mobile_menu) { echo 'hidden-xs hidden-sm hidden-md'; } ?>"><?php
				if (has_nav_menu('main')) {
					$main_menu = wp_nav_menu( array(
						'theme_location' => 'main',
						'menu' => ThewriterOptions::get('menu--main'),
						'menu_class' => 'js--scroll-nav main-menu',
						'container' => '',
					) );
				} else {
					esc_html_e('Assign a menu at Appearance > Menus', 'thewriter');
				}
			?></nav>
		<?php } ?>

	</div>


	<?php if ($header_layout == 'layout2' || $header_layout == 'layout5') { ThewriterHelpers::get_logo(); } ?>


</div></div></div></div>
