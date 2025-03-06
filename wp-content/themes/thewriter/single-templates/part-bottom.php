<?php
wp_link_pages( array(
	'before'      => '<nav class="post-pagination">',
	'after'       => '</nav>',
	'link_before' => '<span>',
	'link_after'  => '</span>',
) );
?>

<?php if (get_the_tags() && ThewriterOptions::get('single_post--tags')) { ?>
	<div class="col-12 col-sm-12">
		<div class="post-single-tags">
			<?php the_tags('<h5 class="post-single-tags_h">'. esc_html__('Tags  ', 'thewriter') . '</h5>', ''); ?>
		</div>
	</div>
<?php } ?>
<div class="posted_by">
<div class="row"><?php

	if (ThewriterOptions::get('single_post--author') && get_the_author_meta()) {
		?><div class="col-sm-5 col-md-4 text-left"><a class="t-w-post-author" href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>">
			<span class="t-w-post-author_img"><?php echo get_avatar(get_the_author_meta('email') , 100); ?></span>
			<span class="t-w-post-author_h">
				<span class="t-w-post-author_sub-h"><?php esc_html_e('Posted by', 'thewriter')?></span>
				<br>
				<span class="t-w-post-author_name-bottom"><?php the_author(); ?></span>
			</span>
		</a></div><?php
	}

	

?></div>
</div>