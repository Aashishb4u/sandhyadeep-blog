<?php $double_width = ThewriterOptions::get_metaboxes_option('local_single_post--double_width'); ?>

<?php get_template_part( 'post-templates/grid/part', 'img' ); ?>

<a href="<?php echo esc_url(get_permalink()); ?>" class="post-grid_img_overlay_helper">
</a>
<div class="post-grid_img_content_helper">
	<div class="post-grid_desc-w">
		<div class="post-grid_cat_helper">
			<?php get_template_part( 'post-templates/grid/part', 'category' ); ?>
		</div>
		<div class="post-grid_h_helper">
			<?php get_template_part( 'post-templates/grid/part', 'header' ); ?>
		</div>
	</div>
	<div class="post-grid_top_part">
		<div class="row">
			<div class="col-xs-12">
				<span class="post-masonry_author"><?php the_author(); ?></span>
				<?php get_template_part( 'post-templates/grid/part', 'date' ); ?>
			</div>
		</div>
	</div>
</div>