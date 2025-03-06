<?php
if (has_post_thumbnail()) {
	$image = wp_get_attachment_image_src( get_post_thumbnail_id(), ThewriterOptions::get('posts--img_size') );
	?><div class="post-extended_img-w"><a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark" class="post-extended_img" style="background-image:url(<?php echo esc_url($image[0]); ?>)"></a></div><?php
}
?>
