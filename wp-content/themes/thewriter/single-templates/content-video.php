<main class="main-cnts <?php
	if ($sidebar_location == 'left' || $sidebar_location == 'right') {
		?> col-sm-7 <?php
		if ($expanded_content) { ?>col-xl-8 <?php }
	} elseif ($sidebar_location == 'both' || $sidebar_location == 'both_left' || $sidebar_location == 'both_right') {
		?> col-sm-5 <?php
		if ($expanded_content) { ?>col-xl-7 <?php }
	}
	if ($sidebar_location == 'left' || $sidebar_location == 'both_left') {
		?> pull-right-sm <?php
	}
?>">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="row">

	<div class="col-sm-10 col-sm-offset-1">
		<div class="top-single-img-container">
		<?php $current_post_content = ThewriterPostFormats::video();?>
		</div>
	</div>
	<div class="clear-fix"></div>
	<?php
		$sidebar_location = ThewriterHelpers::get_sidebar_location();
	?>
	<?php
	if ($sidebar_location == 'both') {
		?>
		<aside class="widget-area sidebar __left col-sm-3" role="complementary">
			<?php dynamic_sidebar('sidebar_left'); ?>
		</aside>
		<?php
	}

	if (!ThewriterHelpers::is_title_wrapper()) { ?>
		<div class="col-10 col-sm-10 col-sm-offset-1">
			<div class="post-single-header">
				<?php get_template_part( 'single-templates/part', 'top' ); ?>
			</div>
		</div>
	<?php } ?>

	<div class="col-10 col-sm-10 col-sm-offset-1">
		<div class="post-single-cnt">
			<?php echo apply_filters( 'the_content', $current_post_content ); ?>
		</div>
	</div>

	<?php get_template_part( 'single-templates/part', 'bottom' ); ?>

	<?php if (ThewriterOptions::get('single_post--share')) {
		?><div class="col-md-10 col-sm-offset-1"><?php
			ThewriterModules::share_buttons();
		?></div><?php
	}
	?>

</div>
</article>
