<?php $ar_current_post_content = ThewriterPostFormats::link(); ?>

<div class="post-boxed_icon">
	<span class="icon-link"></span>
</div>
<div class="post-boxed_quote_overlay_hover">
</div>


<div class="post-boxed_desc-w">

	<blockquote class="post-boxed_desc">
		<?php get_template_part( 'post-templates/boxed/part', 'category' ); ?>
		<a href="<?php echo esc_url($ar_current_post_content['link']); ?>" class="post-boxed_lk" rel="bookmark" title="<?php the_title(); ?>"><?php echo esc_url($ar_current_post_content['link']); ?></a>
	</blockquote>

	<?php the_title( '<cite class="post-boxed_h">', '</cite>' ); ?>

	<div class="post-grid_top_part">
		<div class="row">
			<div class="col-xs-12">
				<span class="post-masonry_author"><?php the_author(); ?></span>
				<?php get_template_part( 'post-templates/boxed/part', 'meta' ); ?>
			</div>
		</div>
	</div>
	
</div>