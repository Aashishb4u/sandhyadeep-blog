<div class="post-standard_desc-w">
	<?php get_template_part( 'post-templates/standard/part', 'category' ); ?>

	<div class="post-boxed_desc-w">

		<div class="post-standard_icon">
			<i class="icon_left-quote" aria-hidden="true">“</i>
		</div>

		<blockquote class="post-standard_desc">
			<?php echo apply_filters( 'the_content', ThewriterPostFormats::esc() ); ?>
		</blockquote>

		<?php the_title( '<cite class="post-standard_h">', '</cite>' ); ?>

	</div>

	<div class="post-standard_meta">
		<div class="post-meta_date_container">
			<?php get_template_part( 'post-templates/standard/part', 'date' ); ?>
		</div>
	</div>
</div>
