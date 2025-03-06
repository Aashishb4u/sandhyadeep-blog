<div class="post-grid_content-all">
	<div class="post-grid_quote_overlay_hover"></div>

	<?php get_template_part( 'post-templates/grid/part', 'category' ); ?>
		
	<div class="post-grid_desc-w">

		<div class="post-grid_icon">
			<i class="icon_left-quote" aria-hidden="true">&ldquo;</i>
		</div>

		<blockquote class="post-grid_desc">
			<?php the_content(); ?>
		</blockquote>

		<?php the_title( '<cite class="post-grid_h">', '</cite>' ); ?>
	</div>

	<div class="post-grid_top_part">
		<div class="row">
			<div class="col-xs-12">
				<?php get_template_part( 'post-templates/grid/part', 'date' ); ?>
			</div>
		</div>
	</div>
</div>