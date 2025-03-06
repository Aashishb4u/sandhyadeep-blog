<div class="post-grid_content-all">
	<div class="post-grid_quote_overlay_hover"></div>

	<?php get_template_part( 'post-templates/grid/part', 'category' ); ?>
		
	<div class="post-grid_desc-w">

		<div class="post-grid_icon">
			<i class="fa fa-twitter"></i>
		</div>

		<blockquote class="post-grid_desc">
			<?php //echo apply_filters( 'the_content', ThewriterPostFormats::esc() ); 
				the_content();
			?>
		</blockquote>

	</div>
	<div class="post-grid_top_part">
		<div class="row">
			<div class="col-xs-12">
				<?php get_template_part( 'post-templates/grid/part', 'date' ); ?>
			</div>
		</div>
	</div>
</div>