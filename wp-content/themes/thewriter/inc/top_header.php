<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');

$menu = ThewriterOptions::get('top_header--menu');
$menu_at_left = ThewriterOptions::get('top_header--menu_left');
$menu_container_classes = 'mods_el visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block text-center';

?>

<div class=" main-h-top">
	<div class="container">
		<div class="row __inline">
			<?php if (ThewriterOptions::get('top_header--left_cols_sm')) { ?>
				<div class="col-sm-<?php echo absint(ThewriterOptions::get('top_header--left_cols_sm')); ?> __inline"><div>
					<div class="mods text-center text-left-sm">
						<?php ThewriterModules::text('top_header', false, false); ?>
						<span class="mods_el __separator hidden-xs"></span>
						<?php if ($menu && $menu_at_left) {
							if (has_nav_menu('top_header')) {
								wp_nav_menu( array(
									'theme_location' => 'top_header',
									'menu' => ThewriterOptions::get('menu--top_header'),
									'menu_class' => 'top-h-menu js--scroll-nav mods_el-menu',
									'container' => 'nav',
									'container_class' => $menu_container_classes,
									'echo' => false,
									'depth' => 1,
								) );
							} else {
								echo '<div class="' . esc_attr($menu_container_classes) . '"><div class="mods_el-menu">' . esc_html__('Assign a menu at Appearance > Menus', 'thewriter') . '</div></div>';
							}
						} ?>
					</div>
				</div></div>
			<?php } ?>
			<?php if (ThewriterOptions::get('top_header--right_cols_sm')) { ?>
				<div class="col-sm-<?php echo absint(ThewriterOptions::get('top_header--right_cols_sm')); ?> __inline"><div>
					<div class="mods text-center text-right-sm">
						<?php if ($menu && !$menu_at_left) { ?>
							<?php
							if (has_nav_menu('top_header')) {
								wp_nav_menu( array(
									'theme_location' => 'top_header',
									'menu' => ThewriterOptions::get('menu--top_header'),
									'menu_class' => 'top-h-menu js--scroll-nav mods_el-menu',
									'container' => 'nav',
									'container_class' => $menu_container_classes,
									'echo' => false,
									'depth' => 1,
								) );
							} else {
								echo '<div class="' . esc_attr($menu_container_classes) . '"><div class="mods_el-menu">' . esc_html__('Assign a menu at Appearance > Menus', 'thewriter') . '</div></div>';
							}
							?>
							<span class="mods_el __separator hidden-xs"></span>
						<?php } ?>

						<?php ThewriterModules::icon_lwa('top_header', false); ?>

						<?php ThewriterModules::icon_minicart('top_header', false); ?>

						<?php ThewriterModules::icon_search('top_header', false); ?>

						<?php ThewriterModules::icon_social('top_header', false); ?>

						<?php ThewriterModules::icon_currency('top_header', false); ?>

						<?php ThewriterModules::icon_language_flags('top_header', false); ?>
					</div>
				</div></div>
			<?php } ?>
		</div>
	</div>
</div>
