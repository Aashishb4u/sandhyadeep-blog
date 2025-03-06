<?php $double_width = ThewriterOptions::get_metaboxes_option('local_single_post--double_width'); ?>

<?php get_template_part( 'post-templates/grid/part', 'img' ); ?>

<div class="post-grid_desc-w">
	<?php get_template_part( 'post-templates/grid/part', 'category' ); ?>

	<?php get_template_part( 'post-templates/grid/part', 'header' ); ?>

	<div class="post-grid_desc">
		<?php echo apply_filters( 'the_excerpt', ThewriterPostFormats::esc(get_the_excerpt()) ); ?>
	</div>
</div>
<?php 
	global $content_width_custom;
	if ($content_width_custom) {
		$content_width = $content_width_custom;
	} else {
		$content_width = ThewriterOptions::get('layout--content_width');
	}
?>
<div class="post-grid_top_part <?php if ($content_width == 'expanded') {esc_attr_e('bottom_posts_expanded', 'thewriter');}?>">
	<div class="row">
		<?php 

		if ($content_width == 'expanded') {
		?>
			<div class="col-xs-12">
				<span class="post-masonry_author"><?php the_author(); ?></span>
				<?php get_template_part( 'post-templates/grid/part', 'date' ); ?>
			</div>
		<?php } else {?>
			<div class="col-xs-12">
				<span class="post-masonry_author"><?php the_author(); ?></span>
				<?php get_template_part( 'post-templates/grid/part', 'date' ); ?>
			</div>
		<?php }?>
	</div>
</div>
