<?php $ar_current_post_content = ThewriterPostFormats::link(); ?>

	<div class="post-grid_icon">
		<span class="icon-link"></span>
	</div>
	<div class="post-grid_quote_overlay_hover">
	</div>
<div class="post-grid_desc-w">
	

	<blockquote class="post-grid_desc">
		<?php get_template_part( 'post-templates/grid/part', 'category' ); ?>
		<a href="<?php echo esc_url($ar_current_post_content['link']); ?>" class="post-grid_lk" rel="bookmark" title="<?php the_title(); ?>"><?php echo esc_url($ar_current_post_content['link']); ?>
</a>
	</blockquote>

	<?php the_title( '<cite class="post-grid_h">', '</cite>' ); ?>
</div>
<div class="post-grid_top_part">
	<div class="row">
		<div class="col-xs-6">
			<?php get_template_part( 'post-templates/grid/part', 'date' ); ?>
		</div>
		<div class="col-xs-6">
			<div class="text_right">
				<?php get_template_part( 'post-templates/grid/part', 'comments' ); ?>
			</div>
		</div>
	</div>
</div>
