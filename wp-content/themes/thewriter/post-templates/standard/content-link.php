<?php $ar_current_post_content = ThewriterPostFormats::link(); ?>


<div class="post-standard_desc-w">
	<?php get_template_part( 'post-templates/standard/part', 'category' ); ?>

	<div class="post-standard_icon"><span class="icon-link"></span></div>

	<blockquote class="post-standard_desc"><a href="<?php echo esc_url($ar_current_post_content['link']); ?>" class="post-standard_lk" rel="bookmark" title="<?php the_title(); ?>"><?php echo esc_url($ar_current_post_content['link']); ?></a></blockquote>

	<?php the_title( '<cite class="post-standard_h">', '</cite>' ); ?>

	<div class="post-standard_meta">
		<div class="post-meta_date_container">
			<?php get_template_part( 'post-templates/standard/part', 'date' ); ?>
		</div>
		<div class="post-meta_comments_container">
			<?php get_template_part( 'post-templates/standard/part', 'comments' ); ?>
		</div>
	</div>
</div>
