<?php
$post_format = get_post_format();
$classes = 'post-boxed __' . ($post_format ? $post_format : 'standard') . (wp_is_mobile() ? ' __mobile' : '');

if (is_sticky()) {
	$classes .= ' __sticky';
}

?>

<div class="col-xs-12 animate-on-screen js--animate-on-screen">
	<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
		<?php get_template_part( 'post-templates/boxed/content', $post_format ); ?>
	</article>
</div>
