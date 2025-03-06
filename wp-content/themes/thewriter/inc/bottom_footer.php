<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');

$menu = ThewriterOptions::get('bottom_footer--menu');
$menu_at_left = ThewriterOptions::get('bottom_footer--menu_left');

?>
<div class="main-f-bottom">
	<div class="container">
		<div class="row">
			<?php if (ThewriterOptions::get('bottom_footer--left_cols_sm')) { ?>
				<div class="col-sm-<?php echo absint(ThewriterOptions::get('bottom_footer--left_cols_sm')); ?>">
					<div class="
						mods
						text-center
						text-<?php echo esc_attr(ThewriterOptions::get('bottom_footer_styles--first_align')); ?>-sm
					">
						<div class="instagram-feed">
							<?php if ( shortcode_exists( 'instagram-feed' ) ) {
								echo do_shortcode("[instagram-feed]");
							} ?>
						</div>
						<div class="social-footer">
							<?php ThewriterModules::icon_social('bottom_footer', false); ?>
						</div>
						<div class="coop-footer">
							<?php ThewriterModules::text('bottom_footer', false, false); ?>
						</div>
						<span class="mods_el __separator hidden-xs"></span>
						<?php if ($menu && $menu_at_left) {
							if (has_nav_menu('bottom_footer')) {
								wp_nav_menu( array(
									'theme_location' => 'bottom_footer',
									'menu' => ThewriterOptions::get('menu--bottom_footer'),
									'menu_class' => 'bottom-f-menu js--scroll-nav',
									'container' => 'nav',
									'container_class' => 'mods_el',
									'echo' => false,
									'depth' => 1,
								) );
							} else {
								echo '<div class="mods_el">' . esc_html__('Assign a menu at Appearance > Menus', 'thewriter') . '</div>';
							}
						} ?>
					</div>
				</div>
			<?php } ?>
			<?php if (ThewriterOptions::get('bottom_footer--right_cols_sm')) { ?>
				<div class="col-sm-<?php echo absint(ThewriterOptions::get('bottom_footer--right_cols_sm')); ?>">
					<div class="
						mods
						text-center
						text-<?php echo esc_attr(ThewriterOptions::get('bottom_footer_styles--second_align')); ?>-sm
					">
						<?php if ($menu && !$menu_at_left) {
							if (has_nav_menu('bottom_footer')) {
								wp_nav_menu( array(
									'theme_location' => 'bottom_footer',
									'menu' => ThewriterOptions::get('menu--bottom_footer'),
									'menu_class' => 'bottom-f-menu js--scroll-nav',
									'container' => 'nav',
									'container_class' => 'mods_el',
									'echo' => false,
									'depth' => 1,
								) );
							} else {
								echo '<div class="mods_el">' . esc_html__('Assign a menu at Appearance > Menus', 'thewriter') . '</div>';
							}
						} ?>


						<?php ThewriterModules::icon_currency('bottom_footer', false); ?>

						<?php ThewriterModules::icon_language_flags('bottom_footer', false); ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
