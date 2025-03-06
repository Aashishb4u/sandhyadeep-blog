<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');

$category_image_on_bg = ThewriterOptions::get('title_wrapper--category_image_on_bg');
?>
<div class="
	t-w
	js--t-w
	<?php
	if (ThewriterOptions::get('title_wrapper--full_height')) {?> __full-height<?php }
	if (ThewriterOptions::get('title_wrapper--parallax')) {?> __parallax<?php }
	if ($category_image_on_bg && $category_image_src) {?> __products-subcat<?php }
	?>
">

		<div class="t-w_bg js--t-w-bg"
		<?php if (is_singular('post') && ThewriterOptions::get('title_wrapper--featured_image_on_bg') && has_post_thumbnail()) { ?>
			style="
				background-image:url(<?php
					$attachment_image_src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
					echo esc_url($attachment_image_src[0]);
				?>);
				background-position:center;
				background-size:cover;
			"
		<?php } ?>
		></div>
		<?php if (ThewriterOptions::get('title_wrapper_styles--bg_overlay_pattern')) { ?><div class="t-w_bg-overlay-pattern"></div><?php } ?>
	<div class="t-w_bg-overlay"<?php
	$bg_overlay = ThewriterOptions::get('title_wrapper_styles--bg_overlay');
	if ( isset( $bg_overlay['rgba'] ) ) {
		echo esc_attr(' style="background-color:'. $bg_overlay['rgba'] .'"');
	}
	?>;></div>


	<div class="js--under-main-h"></div>


	<div class="t-w_cnt js--t-w-cnt">
		<div class="container">
		<?php

		// Sub title

		if (ThewriterOptions::get('title_wrapper--sub_title')) {
			?><div class="t-w_sub-h"><?php echo esc_attr(ThewriterOptions::get('title_wrapper--sub_title')); ?></div><?php
		}


		// Title

		?><h1 class="t-w_h"><?php

		if (is_home() && is_front_page()) {

			bloginfo('name');

		} elseif (is_home()) {

			single_post_title();

		} elseif (is_archive()) {

			the_archive_title();

		} elseif (is_search()) {

			printf( esc_html__( 'Search Results for: %s', 'thewriter' ), '<span>' . get_search_query() . '</span>' );

		} elseif (!have_posts()) {

			esc_html_e('Nothing Found', 'thewriter');

		} else {

			the_title();

		}

		?></h1><?php

		// Single post categories

		//if (is_singular('post') && ThewriterHelpers::is_categorized_blog()) {
			?><!--<div class="t-w-post-category"><span><?php //esc_html_e('in ', 'thewriter');?></span><?php //the_category(', '); ?></div>--><?php
		//}


		// Description

		if (ThewriterOptions::get('title_wrapper--desc') && !is_search()) {

			if (is_archive()) {

				the_archive_description( '<div class="t-w_desc">', '</div>' );

			} elseif (is_singular('post')) {

				?><div class="t-w_desc __post"><div class="t-w-post-meta">
					<?php if (ThewriterOptions::get('single_post--author')) { ?>
						<div class="t-w-post-author"><span class="t-w_prefix" data-content=""><?php esc_html_e('by ', 'thewriter');?></span><a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>" class="t-w-post_border"><?php the_author(); ?></a></div>
					<?php } ?>

					<div class="t-w-post-meta_date"><span class="t-w_prefix"><?php esc_html_e('on ', 'thewriter');?></span><a href="<?php echo get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d')); ?>" class="t-w-post_border"><time datetime="<?php echo esc_attr(get_the_date('c')); ?>"> <?php echo get_the_date(); ?></time></a></div>

					<div class="t-w-post-category"><span class="t-w_prefix"><?php esc_html_e('in ', 'thewriter');?></span><?php the_category(' '); ?></div>

				</div></div><?php

			} elseif (is_home() && ThewriterOptions::get('posts--desc') != '') {

				?><div class="t-w_desc"><?php echo wp_kses(ThewriterOptions::get('posts--desc'), 'post'); ?></div><?php

			} elseif (ThewriterOptions::get('local_title_wrapper--desc_text', false) != '') {

				?><div class="t-w_desc"><?php echo wp_kses(ThewriterOptions::get('local_title_wrapper--desc_text', false), 'post'); ?></div><?php

			}

		}


		?>
		</div>
	</div>


	<?php


	// Breadcrumb

	if (ThewriterOptions::get('title_wrapper--breadcrumb') && !is_search() && !is_singular('post')) {

		if (function_exists('yoast_breadcrumb')) {
			yoast_breadcrumb('<nav class="breadcrumb js--scroll-bottom"><div class="container">','</div></nav>');
		}

	}
	?>


</div>
