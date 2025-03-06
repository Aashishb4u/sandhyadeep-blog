<?php if (ThewriterHelpers::is_categorized_blog()) { ?>
	<div class="single_post_cat_h"><?php the_category(', '); ?></div>
<?php } ?>
<header class="post-single-h-w">
	<?php the_title( '<h1 class="post-single-h">', '</h1>' ); ?>
</header>

<div class="post-single-date">
	<time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date()); ?></time>
	<span class="post-author_name">
		<?php esc_html_e(' by ', 'thewriter'); the_author();?>
	</span>
</div>
