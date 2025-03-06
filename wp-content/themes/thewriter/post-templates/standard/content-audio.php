<?php ThewriterPostFormats::audio(); ?>

<div class="post-standard_desc-w">
	<?php get_template_part( 'post-templates/standard/part', 'category' ); ?>

	<?php get_template_part( 'post-templates/standard/part', 'header' ); ?>


	<div class="text_center">
		<span><?php esc_html_e('on ', 'thewriter'); ?></span>
		<?php get_template_part( 'post-templates/standard/part', 'date' ); ?>
	</div>

	<div class="post-standard_desc">
		<?php echo apply_filters( 'the_excerpt', ThewriterPostFormats::esc(get_the_excerpt()) ); ?>
	</div>

	<div class="post-standard_bottom_part">
		<div class="row">
			<div class="col-xs-12">
				<div class="post-standard_btn-w">
					<a href="<?php echo esc_url(get_permalink()); ?>" class="fbq-sm-button"><?php esc_html_e('Continue reading', 'thewriter'); ?></a>
				</div>
			</div>
		</div>
	</div>
</div>
