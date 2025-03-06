<?php 
$post_format = get_post_format();
if (is_sticky() || $post_format == 'image') {
	the_title( '<header><h3 class="post-masonry_h"><a href="' . esc_url(get_permalink()) . '" class="post-grid_lk" rel="bookmark">', '</a></h3></header>' ); 
} else {
	the_title( '<header><h2 class="post-masonry_h"><a href="' . esc_url(get_permalink()) . '" class="post-grid_lk" rel="bookmark">', '</a></h2></header>' ); 
}
?>

