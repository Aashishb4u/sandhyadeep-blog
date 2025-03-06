<div class="post-masonry_quote_overlay_hover"></div>

<?php get_template_part( 'post-templates/masonry/part', 'category' ); ?>

<div class="post-masonry_desc-w">

	<div class="post-masonry_icon">
		<i class="icon_left-quote" aria-hidden="true">&ldquo;</i>
	</div>

	<blockquote class="post-masonry_desc">
		<?php
			the_content();
		?>
	</blockquote>

	<?php the_title( '<cite class="post-masonry_h">', '</cite>' ); ?>
</div>

<div class="post-masonry_top_part">
	<div class="row">
		<div class="col-xs-12">
			<?php get_template_part( 'post-templates/masonry/part', 'date' ); ?>
		</div>
	</div>
</div>