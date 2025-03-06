<?php if (!post_password_required() && comments_open()) { ?>
	<a href="<?php comments_link(); ?>" class="post-standard_comments">
		<i class="fa fa-comment" aria-hidden="true"></i>
		<span class="post-standard_comments-count"><?php comments_number('Add comment', '1', '%'); ?></span>
	</a>
<?php } ?>