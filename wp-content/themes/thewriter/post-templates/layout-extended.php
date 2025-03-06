<?php 
$post_format = get_post_format();
$classes = 'post-boxed extended __standard';
?>
<div class="col-sm-4">
	<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
		<?php get_template_part( 'post-templates/extended/content', $post_format ); ?>
	</article>
</div>