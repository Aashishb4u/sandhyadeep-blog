<?php
/**
 * The template for displaying all single posts and attachments.
 */

get_header();

$classes = '';
$sidebar_location = ThewriterHelpers::get_sidebar_location();
$post_format = get_post_format();
if (!$sidebar_location) {
	$classes .= ' __without-sidebar';
}
?>

	<div class="post-single-w <?php echo esc_attr($classes); ?>">
	

		<?php while (have_posts()) { the_post(); ?>
			<?php get_template_part( 'single-templates/content', get_post_format() ); ?>
			<div class="row">
				<div class="col-md-offset-1 col-md-10">
			<?php if (ThewriterOptions::get('single_post--also_like')) {?>
					<div class="alsolikeblock">
						<h3 class="also-like_h">You Might Also Like</h3>
						<div class="row">
							<div class="also_block_helper">
								<?php
									$post_id = get_the_ID();
									$args = array( 
										'numberposts' => 3,
										'exclude' => $post_id,
										'post_type' => 'post',
										'orderby' => 'rand',
										'order' => 'ASC',
										'tax_query' => array(
											array(
												'taxonomy' => 'post_format',
												'field'    => 'slug',
												'terms'    => array(
													'post-format-quote', 'post-format-status'
													),
												'operator' => 'NOT IN'
											)
										) 
									);
									$myposts = get_posts( $args );
									foreach( $myposts as $post ){ setup_postdata($post);
										?>
											<?php get_template_part( 'post-templates/layout', 'extended' ); ?>
										<?php
									}
								?>
								<?php wp_reset_postdata(); ?>
							</div>
						</div>
					</div>
				<?php } else {?>
				</div>	
				<div class="row">
					<div class="col-md-12"><div class="border-separate"></div></div>
				</div>
				<div class="col-md-offset-1 col-md-10">
			<?php }
			if (comments_open() || get_comments_number()) {
				comments_template();
			}
			?>
				</div>
				<div class="row">
					<div class="col-md-12"><div class="border-separate-2"></div></div>
					<div class="col-md-12">
			<?php
			if (ThewriterOptions::get('single_post--nav')) {
				ThewriterHelpers::post_navigation(ThewriterOptions::get('single_post--nav__fixed'));
			}
			?>
					</div>
				<?php if (!$sidebar_location) {?>
				</div>
			</div>
				<?php } else { ?>
				</div>
			</div>
				<?php }?>
		<?php } // end of the loop. ?>

	
	</div>

<?php get_footer(); ?>
