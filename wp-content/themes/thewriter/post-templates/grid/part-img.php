<?php
$double_width = ThewriterOptions::get_metaboxes_option('local_single_post--double_width');
$post_format = get_post_format();

if (is_sticky() || $double_width || $post_format == 'image') {

	if (has_post_thumbnail()) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id(), ThewriterOptions::get('posts--img_size') );
		?><div class="post-grid_img-w"><a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark" class="post-grid_img" style="background-image:url(<?php echo esc_url($image[0]); ?>)"></a></div><?php
	}

} else { ?>

	<div class="
		post-grid_img-w
		<?php if (has_post_thumbnail()) { ?>
			js--post-grid-with-img
		<?php } else { ?>
			js--post-grid-without-img
		<?php } ?>
	"><a href="<?php echo esc_url(get_permalink()); ?>" class="post-grid_img-lk" rel="bookmark">
	<?php
	if (has_post_thumbnail()) {
		the_post_thumbnail( ThewriterOptions::get('posts--img_size'), array('title' => get_the_title(), 'class' => 'post-grid_img') );
	}
	?>
	</a></div>

<?php } ?>
