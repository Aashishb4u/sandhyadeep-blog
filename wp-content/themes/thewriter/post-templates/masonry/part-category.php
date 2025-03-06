<?php if (ThewriterHelpers::is_categorized_blog()) { ?>
	<div class="post-masonry_cat post_cat_h">
		<?php the_category(', '); ?>
	</div>
<?php } ?>
