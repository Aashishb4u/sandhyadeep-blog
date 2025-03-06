<?php $ar_current_post_content = ThewriterPostFormats::link(); ?>



<div class="post-masonry_icon">
	<span class="icon-link"></span>
</div>

	<div class="post-masonry_quote_overlay_hover">
	</div>
<div class="post-masonry_desc-w">

	<blockquote class="post-masonry_desc">
		<?php get_template_part( 'post-templates/masonry/part', 'category' ); ?>
		<a href="<?php echo esc_url($ar_current_post_content['link']); ?>" class="post-masonry_lk" rel="bookmark" title="<?php the_title(); ?>"><?php echo esc_url($ar_current_post_content['link']); ?></a>
	</blockquote>

	<?php the_title( '<cite class="post-masonry_h">', '</cite>' ); ?>
</div>
<div class="post-masonry_top_part">
	<div class="row">
		<div class="col-xs-12">
			<span class="post-masonry_author"><?php the_author(); ?></span>
			<?php get_template_part( 'post-templates/masonry/part', 'date' ); ?>
		</div>
	</div>
</div>
