<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 */

$sidebar_location = ThewriterHelpers::get_sidebar_location();

$expanded_content = false;
if (ThewriterOptions::get('layout--content_width') == 'expanded') {
	$expanded_content = true;
}

?>

					</main>

					<?php
					if ($sidebar_location == 'left' || $sidebar_location == 'right') {
						?>
						<aside class="widget-area sidebar __<?php echo esc_attr($sidebar_location); ?> col-sm-4 <?php if ($expanded_content) { ?>col-xl-3<?php } ?>" role="complementary">
							<?php dynamic_sidebar('sidebar_' . $sidebar_location); ?>
						</aside>
						<?php
					} elseif ($sidebar_location == 'both') {
						?>
						<aside class="widget-area sidebar __right col-sm-3 <?php if ($expanded_content) { ?>col-xl-2<?php } ?>" role="complementary">
							<?php dynamic_sidebar('sidebar_right'); ?>
						</aside>
						<?php
					} elseif ($sidebar_location == 'both_left') {
						?>
						<aside class="widget-area sidebar __left col-sm-3 <?php if ($expanded_content) { ?>col-xl-2<?php } ?>" role="complementary">
							<?php dynamic_sidebar('sidebar_left'); ?>
						</aside>
						<aside class="widget-area sidebar __left col-sm-3 <?php if ($expanded_content) { ?>col-xl-2<?php } ?>" role="complementary">
							<?php dynamic_sidebar('sidebar_right'); ?>
						</aside>
						<?php
					} elseif ($sidebar_location == 'both_right') {
						?>
						<aside class="widget-area sidebar __right col-sm-3 <?php if ($expanded_content) { ?>col-xl-2<?php } ?>" role="complementary">
							<?php dynamic_sidebar('sidebar_left'); ?>
						</aside>
						<aside class="widget-area sidebar __right col-sm-3 <?php if ($expanded_content) { ?>col-xl-2<?php } ?>" role="complementary">
							<?php dynamic_sidebar('sidebar_right'); ?>
						</aside>
						<?php
					}
					?>
				<?php if ($sidebar_location) { ?></div><?php } ?>
			<?php if (!(is_singular(array('product')) && !$sidebar_location)) { ?></div><?php } ?>
		</div>

		<div class="main-cnts-after">
			<?php ThewriterHelpers::get_dynamic_area(ThewriterOptions::get('content--dynamic_area__after')); ?>
		</div>

		<footer class="
			main-f
			js--main-f
			<?php if (ThewriterOptions::get('footer--fixed')) { echo 'js--main-f-fixed'; } ?>
		"><div class="main-f-inner js--main-f-inner">
			<?php


			// Footer

			if (
				ThewriterOptions::get('footer') &&
				!(function_exists('is_account_page') && is_account_page() && !is_user_logged_in())
			) {
				get_template_part( 'inc/footer' );
			}


			// Bottom footer

			if (
				ThewriterOptions::get('bottom_footer') &&
				!(function_exists('is_account_page') && is_account_page() && !is_user_logged_in())
			) {
				get_template_part( 'inc/bottom_footer' );
			}

			?>
		</div></footer>

		<?php if (ThewriterOptions::get('general--go_to_top')) { ?>
			<a href="#" class="go_to_top js--go_to_top"><span class="icon-arrow-up"></span></a>
		<?php } ?>

		<div class="popup-quick-view js--popup-quick-view">
			<div class="popup-quick-view_loader"><i class="fa fa-spinner fa-pulse fa-3x"></i></div>
			<a href="#" class="popup-menu-popup-close js--popup-quick-view-close"></a>
			<a href="#" class="popup-quick-view_close-bg js--popup-quick-view-close"></a>
			<span class="vertical-helper"></span><div class="popup-quick-view_cnt js--popup-quick-view-cnt"></div>
		</div>
	</section>

	<!-- PhotoSwipe -->
	<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="pswp__bg"></div>
		<div class="pswp__scroll-wrap">
			<div class="pswp__container">
				<div class="pswp__item"></div>
				<div class="pswp__item"></div>
				<div class="pswp__item"></div>
			</div>
			<div class="pswp__ui pswp__ui--hidden">
				<div class="pswp__top-bar">
					<div class="pswp__counter"></div>
					<button class="pswp__button pswp__button--close" title="<?php esc_attr_e('Close (Esc)', 'thewriter')?>"></button>
					<button class="pswp__button pswp__button--fs" title="<?php esc_attr_e('Toggle fullscreen', 'thewriter')?>"></button>
					<button class="pswp__button pswp__button--zoom" title="<?php esc_attr_e('Zoom in/out', 'thewriter')?>"></button>
					<div class="pswp__preloader">
						<div class="pswp__preloader__icn">
							<div class="pswp__preloader__cut">
								<div class="pswp__preloader__donut"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
					<div class="pswp__share-tooltip"></div>
				</div>
				<button class="pswp__button pswp__button--arrow--left" title="<?php esc_attr_e('Previous (arrow left)', 'thewriter')?>">
				</button>
				<button class="pswp__button pswp__button--arrow--right" title="<?php esc_attr_e('Next (arrow right)', 'thewriter')?>">
				</button>
				<div class="pswp__caption">
					<div class="pswp__caption__center"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- End PhotoSwipe -->
	<?php if (ThewriterOptions::get('general--typekit_kit_id')) { ?>
		<script src="https://use.typekit.net/<?php echo esc_attr(ThewriterOptions::get('general--typekit_kit_id')); ?>.js"></script>
		<script>try{Typekit.load({ async: true });}catch(e){}</script>
	<?php } ?>
	<?php wp_footer(); ?>
</body>
</html>
