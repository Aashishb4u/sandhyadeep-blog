
<div class="post-masonry_quote_overlay_hover"></div>

<?php get_template_part( 'post-templates/masonry/part', 'category' ); ?>

<div class="post-masonry_desc-w">

	<div class="post-masonry_icon">
		<i class="fa fa-twitter"></i>
	</div>

	<blockquote class="post-masonry_desc">
		<?php //echo apply_filters( 'the_content', ThewriterPostFormats::esc() ); 
			the_content();
		?>
	</blockquote>

</div>

<div class="post-masonry_top_part">
	<div class="row">
		<div class="col-xs-12">
			<?php get_template_part( 'post-templates/masonry/part', 'date' ); ?>
		</div>
	</div>
</div>
