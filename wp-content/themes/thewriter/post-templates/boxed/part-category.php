<?php if (ThewriterHelpers::is_categorized_blog()) { ?>
	<div class="post-grid_cat post_cat_h">
		<?php the_category(', '); ?>
	</div>
<?php } ?>
