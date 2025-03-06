<?php 
global $sidebar_location_custom;
if ($sidebar_location_custom || $sidebar_location_custom == 'none' ) {
	if($sidebar_location_custom == 'none') {
		$sidebar_location = false;
	} else {
		$sidebar_location = $sidebar_location_custom;
	}
} else {
	$sidebar_location = ThewriterHelpers::get_sidebar_location();
}

if ($sidebar_location) { ?>

	<div class="row post-boxed-inner side-bar">
		<div class="col-xs-12 col-sm-12 col-md-6 col-xl-7 boxed_img_helper">
			<a href="<?php echo esc_url(get_permalink()); ?>" class="post-grid_img_overlay_helper"></a>
			<?php get_template_part( 'post-templates/boxed/part', 'img' ); ?>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-6 col-xl-5 boxed_content_helper">
			<div class="post-boxed_desc-w">
				<?php get_template_part( 'post-templates/boxed/part', 'category' ); ?>

				<?php get_template_part( 'post-templates/boxed/part', 'header' ); ?>

				<div class="post-boxed_desc">
					<?php echo apply_filters( 'the_excerpt', ThewriterPostFormats::esc(get_the_excerpt()) ); ?>
				</div>
			</div>
			<div class="post-boxed_top_part">
				<div class="row">
					<div class="col-xs-12">
						<span class="post-masonry_author"><?php the_author(); ?></span>
						<?php get_template_part( 'post-templates/boxed/part', 'meta' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php } else { ?>

	<div class="row post-boxed-inner">
		<div class="col-xs-12 col-sm-8 boxed_img_helper">
			<a href="<?php echo esc_url(get_permalink()); ?>" class="post-grid_img_overlay_helper"></a>
			<?php get_template_part( 'post-templates/boxed/part', 'img' ); ?>
		</div>
		<div class="col-xs-12 col-sm-4 boxed_content_helper">
			<div class="post-boxed_desc-w">
				<?php get_template_part( 'post-templates/boxed/part', 'category' ); ?>

				<?php get_template_part( 'post-templates/boxed/part', 'header' ); ?>

				<div class="post-boxed_desc">
					<?php echo apply_filters( 'the_excerpt', ThewriterPostFormats::esc(get_the_excerpt()) ); ?>
				</div>
			</div>
			<div class="post-boxed_top_part">
				<div class="row">
					<div class="col-xs-12">
						<span class="post-masonry_author"><?php the_author(); ?></span>
						<?php get_template_part( 'post-templates/boxed/part', 'meta' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php } ?>