<?php $double_width = ThewriterOptions::get_metaboxes_option('local_single_post--double_width'); ?>

<?php
if (has_post_thumbnail()) {
	$image = wp_get_attachment_image_src( get_post_thumbnail_id(), ThewriterOptions::get('posts--img_size') );
	?><div class="post-masonry_img-w"><a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark" class="post-masonry_img" style="background-image:url(<?php echo esc_url($image[0]); ?>)"></a></div><?php
}
?>

<a href="<?php echo esc_url(get_permalink()); ?>" class="post-grid_img_overlay_helper">
</a>
<div class="post-grid_img_content_helper">
	<div class="post-masonry_desc-w  post-masonry_desc-w_blocks">
		<div class="post-masonry_cat_helper">
			<?php get_template_part( 'post-templates/masonry/part', 'category' ); ?>
		</div>
		<div class="post-masonry_h_helper">
			<?php get_template_part( 'post-templates/masonry/part', 'header' ); ?>
		</div>
	</div>
</div>
<div class="post-masonry_top_part">
	<div class="row">
		<div class="col-xs-12">
			<span class="post-masonry_author"><?php the_author(); ?></span>
			<?php get_template_part( 'post-templates/masonry/part', 'date' ); ?>
		</div>
	</div>
</div>