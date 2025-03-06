
<?php if (is_sticky()) { ?>

	<div class="post-masonry_sticky-inner">
			<?php
			if (ThewriterOptions::get('posts--img')) {
				ThewriterPostFormats::image('post-masonry_img');
			}
			?>
		<div class="post-masonry_desc-w">
			<?php get_template_part( 'post-templates/masonry/part', 'category' ); ?>
			<?php get_template_part( 'post-templates/masonry/part', 'header' ); ?>
			<div class="post-masonry_desc">
				<?php echo apply_filters( 'the_excerpt', ThewriterPostFormats::esc(get_the_excerpt()) ); ?>
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
	</div>
<?php } else {?>
<?php
if (ThewriterOptions::get('posts--img')) {
	ThewriterPostFormats::image('post-masonry_img');
}
?>

<div class="post-masonry_desc-w">
	<?php get_template_part( 'post-templates/masonry/part', 'category' ); ?>

	<?php get_template_part( 'post-templates/masonry/part', 'header' ); ?>


	<div class="post-masonry_desc">
		<?php echo apply_filters( 'the_excerpt', ThewriterPostFormats::esc(get_the_excerpt()) ); ?>
	</div>

<?php 
global $content_width_custom;
if ($content_width_custom) {
	$content_width = $content_width_custom;
} else {
	$content_width = ThewriterOptions::get('layout--content_width');
}
?>
</div>
<div class="post-masonry_top_part <?php if ($content_width == 'expanded') {esc_attr_e('bottom_posts_expanded', 'thewriter');}?>">
	<div class="row">
		<?php 
		if ($content_width == 'expanded') {
		?>
			<div class="col-xs-12">
				<span class="post-masonry_author"><?php the_author(); ?></span>
				<?php get_template_part( 'post-templates/masonry/part', 'date' ); ?>
			</div>
		<?php } else {?>
			<div class="col-xs-12">
				<span class="post-masonry_author"><?php the_author(); ?></span>
				<?php get_template_part( 'post-templates/masonry/part', 'date' ); ?>
			</div>
		<?php }?>
	</div>
</div>

	<?php }?>