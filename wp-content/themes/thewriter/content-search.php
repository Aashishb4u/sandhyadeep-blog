<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

$post_type = get_post_type();
$classes = 'post-masonry __standard';
?>

<article id="post-<?php the_ID(); ?>" <?php //post_class('search-el'); ?> <?php post_class( $classes ); ?>>
	<?php if (has_post_thumbnail() && wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium')[0] != '') { ?>
		<a href="<?php echo esc_url(get_permalink())?>" class="post-masonry_img-lk">
			<img class="post-masonry_img" src="<?php
			$attachment_image_src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
			echo esc_url($attachment_image_src[0]);
		?>">
		</a>
	<?php } ?>

	<div class="post-masonry_desc-w">
		<div class="post-masonry_cat search_cat post_cat_h">
			<?php if ($post_type == 'post') { ?>
				<?php esc_html_e('Post', 'thewriter'); ?>
			<?php } elseif ($post_type == 'page') { ?>
				<?php esc_html_e('Page', 'thewriter'); ?>
			<?php } elseif ($post_type == 'product') { ?>
				<?php esc_html_e('Product', 'thewriter'); ?>
			<?php } ?>
		</div>
		<?php the_title( '<header><h2 class="post-masonry_h"><a href="' . esc_url(get_permalink()) . '" class="post-grid_lk" rel="bookmark">', '</a></h2></header>' ); ?>

		<div class="post-masonry_desc">
			<?php if ($post_type == 'post') { ?>
				<?php the_excerpt(); ?>
			<?php } else { ?>
				<p><?php the_excerpt(); ?><p>
			<?php }?>
		</div>

		<?php if ($post_type == 'post') { ?>
			<?php ThewriterHelpers::search_meta(); ?>
		<?php } ?>
	</div>
</article>
