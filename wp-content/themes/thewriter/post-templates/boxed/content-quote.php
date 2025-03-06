<div class="post-boxed_content-all">
	<div class="post-boxed_quote_overlay_hover"></div>

	<?php get_template_part( 'post-templates/boxed/part', 'category' ); ?>

	<div class="post-boxed_desc-w">

		<div class="post-boxed_icon">
			<i class="icon_left-quote" aria-hidden="true">&ldquo;</i>
		</div>

		<blockquote class="post-boxed_desc">
			<?php the_content(); ?>
		</blockquote>

		<?php the_title( '<cite class="post-boxed_h">', '</cite>' ); ?>

	</div>

	<div class="post-grid_top_part">
		<div class="row">
			<div class="col-xs-12">
				<?php get_template_part( 'post-templates/boxed/part', 'meta' ); ?>
			</div>
		</div>
	</div>
</div>