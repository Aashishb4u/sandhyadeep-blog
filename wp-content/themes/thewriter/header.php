<?php
/**
 * The header for our theme.
 */

$sidebar_location = ThewriterHelpers::get_sidebar_location();

$expanded_content = false;
if (ThewriterOptions::get('layout--content_width') == 'expanded') {
	$expanded_content = true;
}

$body_classes = '';

if (!is_singular() && get_post_type() == 'post' &&
	(ThewriterOptions::get('posts--view') == 'grid' || ThewriterOptions::get('posts--view') == 'boxed')
) {
	add_filter( 'body_class', function( $classes ) {
		return array_merge( $classes, array( '__bg' ) );
	} );
}

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<?php if (ThewriterOptions::get('general--responsiveness')) { ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php } ?>
	<?php
	if (ThewriterOptions::get('general--preloader')) {
		add_filter( 'body_class', function( $classes ) {
		return array_merge( $classes, array( 'preload' ) );
		} );
		// Sorry, this script can't be with wp_enqueue_script, because data attribute is required
		?>
		<script
		data-pace-options='{"ajax":false,"restartOnPushState":false}'
		src="<?php echo get_template_directory_uri(); ?>/scripts/vendor/PACE/pace.min.js"
		></script>
	<?php } ?>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
	<section class="
		main-w
		js--main-w
		<?php echo ' __' . esc_attr(ThewriterOptions::get('layout--boxed')); ?>
	">
		<div class="main-brd __top"></div>
		<div class="main-brd __right"></div>
		<div class="main-brd __bottom"></div>
		<div class="main-brd __left"></div>

		<header>

			<div class="main-h js--main-h <?php if (ThewriterHelpers::is_negative_header()) { echo '__negative'; } ?>">
				<?php
				// Top header

				if (
					ThewriterOptions::get('top_header') &&
					!(function_exists('is_account_page') && is_account_page() && !is_user_logged_in())
				) {
					get_template_part( 'inc/top_header' );
				}


				// Header

				if (ThewriterOptions::get('header')) {
					get_template_part( 'inc/header' );
				}
				?>
			</div>


			<?php
			// Title wrapper

			if ((ThewriterHelpers::is_title_wrapper() && have_posts()) || is_archive()) {
				get_template_part( 'inc/title_wrapper' );
			}
			?>

		</header>

		<div class="main-cnts-before">
			<?php ThewriterHelpers::get_dynamic_area(ThewriterOptions::get('content--dynamic_area__before')); ?>
		</div>

		<div id="main-content" class="main-cnts-w">
			<?php if (!(is_singular(array('product')) && !$sidebar_location)) { ?><div class="container"><?php } ?>
			<?php if ($sidebar_location) { ?><div class="row"><?php } ?>
			<?php if(is_single()):?>
			<?php else:?>
				<?php
				if ($sidebar_location == 'both') {
					?>
					<aside class="widget-area sidebar __left col-sm-3" role="complementary">
						<?php dynamic_sidebar('sidebar_left'); ?>
					</aside>
					<?php
				}
				?>

				<main class="main-cnts <?php
					if ($sidebar_location == 'left' || $sidebar_location == 'right') {
						?> col-sm-8 <?php
						if ($expanded_content) { ?>col-xl-9 <?php }
					} elseif ($sidebar_location == 'both' || $sidebar_location == 'both_left' || $sidebar_location == 'both_right') {
						?> col-sm-6 <?php
						if ($expanded_content) { ?>col-xl-8 <?php }
					}
					if ($sidebar_location == 'left' || $sidebar_location == 'both_left') {
						?> pull-right-sm <?php
					}
				?>">
			<?php endif;?>
