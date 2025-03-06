<div class="post-grid_sticky-inner">

	<?php get_template_part( 'post-templates/grid/part', 'img' ); ?>

	<div class="post-grid_desc-w">
		<?php get_template_part( 'post-templates/grid/part', 'category' ); ?>

		<?php get_template_part( 'post-templates/grid/part', 'header' ); ?>
		<div class="post-grid_top_part">
			<div class="row">
				<div class="col-xs-6">
					<?php get_template_part( 'post-templates/grid/part', 'date' ); ?>
					<span class="t-w-post-author_sub-h">
						<?php esc_html_e('by ', 'thewriter')?>
						<?php the_author(); ?>
					</span>
				</div>
				<div class="col-xs-6">
					<div class="text_right">
						<?php get_template_part( 'post-templates/grid/part', 'comments' ); ?>
					</div>
				</div>
			</div>
		</div>

		<div class="post-grid_desc">
			<?php echo apply_filters( 'the_excerpt', ThewriterPostFormats::esc(get_the_excerpt()) ); ?>
		</div>

	</div>
	
	<div class="post-grid_bottom_part">
		<div class="row">
			<div class="col-xs-6">
				<div class="post-grid_btn-w">
					<a href="<?php echo esc_url(get_permalink()); ?>" class="fbq-sm-button">
						<?php esc_html_e('Continue', 'thewriter'); ?>
					</a>
				</div>
			</div>
			<div class="col-xs-6">
				<div class="post-grid_share_container text_right">
					<span class="post-share_txt">
						<?php esc_html_e('Share:', 'thewriter'); ?>
					</span>
					<?php ThewriterModules::share_icons(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
