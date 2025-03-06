<?php
/**
 * The main template file.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header();


$post_type = esc_attr(get_post_type());
$content_width = esc_attr(ThewriterOptions::get('layout--content_width'));

if ($post_type == 'post') {


	global $thewriter_post_loop;
	$thewriter_post_loop = 1;

	$blog_view = ThewriterOptions::get('posts--view');

	$classes = array();
	$classes[] = 'row js--masonry';

	if ($blog_view == 'metro' && $content_width == 'expanded') {
		$classes[] = '__expanded';
	}

	if ($blog_view == 'grid') {
		$classes[] = 'grid-border';
	}
	?>

	<?php if ($blog_view != 'standard' && $blog_view != 'boxed') { ?>
		<div class="<?php echo esc_attr(join(' ', $classes)); ?>">
	<?php } ?>

	<?php if (have_posts()) { ?>

		<?php while (have_posts()) { the_post(); ?>

			<?php get_template_part( 'post-templates/layout', $blog_view ); ?>

		<?php } ?>

	<?php } else { ?>

		<?php get_template_part( 'content', 'none' ); ?>

	<?php } ?>

	<?php if ($blog_view != 'standard' && $blog_view != 'boxed') { ?>
		</div>
	<?php } ?>

	<?php ThewriterHelpers::posts_navigation(); ?>


<?php } else { ?>


	<?php while (have_posts()) { the_post(); ?>

		<article id="<?php echo sanitize_html_class($post_type); ?>-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php the_content(); ?>

			<?php
			wp_link_pages( array(
				'before'      => '<nav class="post-pagination">',
				'after'       => '</nav>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
			?>
		</article>

		<?php
		if ((comments_open() || get_comments_number()) && ThewriterOptions::get('general--page_comments')) {
			comments_template();
		}
		?>

	<?php } // end of the loop. ?>


<?php } ?>


<?php get_footer(); ?>
