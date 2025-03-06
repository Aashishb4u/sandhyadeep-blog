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
?>

<main class="main-cnts <?php
	if ($sidebar_location == 'left' || $sidebar_location == 'right') {
		?> col-sm-8 <?php
		if ($expanded_content) { ?>col-xl-8 <?php }
	} elseif ($sidebar_location == 'both' || $sidebar_location == 'both_left' || $sidebar_location == 'both_right') {
		?> col-sm-6 <?php
		if ($expanded_content) { ?>col-xl-7 <?php }
	} else {
		?><?php
	}
	if ($sidebar_location == 'left' || $sidebar_location == 'both_left') {
		?> pull-right-sm <?php
	}
?>">

<article id="post-<?php the_ID();?>" <?php post_class(); ?>>
<div class="row">
	<?php
		if (
			has_post_thumbnail() &&
			ThewriterOptions::get('single_post--featured_image') &&
			(!ThewriterHelpers::is_title_wrapper() || !ThewriterOptions::get('title_wrapper--featured_image_on_bg'))
		) {
	?>
	<div class="col-xs-12 col-md-10 col-md-offset-1">
		<div class="top-single-img-container">
			<?php
				the_post_thumbnail( 'large', array('title' => esc_attr(get_the_title()), 'class' => 'post-single-img') );
			?>
		</div>
	</div>
	<?php
		}
	?>
	<div class="col-xs-12 col-md-10 col-md-offset-1">
		<div class="share_helper">
			<?php if (!ThewriterHelpers::is_title_wrapper()) { ?>
				<?php get_template_part( 'single-templates/part', 'top' ); ?>
			<?php } ?>
			<div class="post-single-cnt">
				<?php the_content(); ?>
			</div>

			<?php get_template_part( 'single-templates/part', 'bottom' ); ?>
		</div>
	</div>

</article>
