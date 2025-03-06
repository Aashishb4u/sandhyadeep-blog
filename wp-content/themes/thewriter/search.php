<?php
/**
 * The template for displaying search results pages.
 */

get_header(); ?>

	<?php if (have_posts()) { ?>

		<div class="search-page">
			<p><?php esc_html_e('If you are not happy with the results below please do another search.', 'thewriter'); ?></p>
			<?php get_search_form(); ?>
		</div>

		<div class="row js--masonry">

			<?php
			$classes = ThewriterHelpers::get_responsive_column_classes(ThewriterOptions::get('search--columns'));

			$classes[] = 'animate-on-screen js--animate-on-screen';

			while (have_posts()) { the_post();
			?>

				<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
					<?php get_template_part( 'content', 'search' ); ?>
				</article>

			<?php } ?>

		</div>

		<?php ThewriterHelpers::posts_navigation(); ?>

	<?php } else { ?>

		<?php get_template_part( 'content', 'none' ); ?>

	<?php } ?>

<?php get_footer(); ?>
