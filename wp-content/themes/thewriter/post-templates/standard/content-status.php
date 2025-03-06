<div class="post-standard_desc-w">
	<?php get_template_part( 'post-templates/standard/part', 'category' ); ?>

	<div class="post-boxed_desc-w">

		<div class="post-standard_icon">
			<i class="fa fa-twitter"></i>
		</div>

		<blockquote class="post-standard_desc">
			<?php echo apply_filters( 'the_content', ThewriterPostFormats::esc() ); ?>
		</blockquote>

	</div>

	<div class="post-standard_meta">
		<div class="post-meta_date_container">
			<?php get_template_part( 'post-templates/standard/part', 'date' ); ?>
		</div>
	</div>
</div>
