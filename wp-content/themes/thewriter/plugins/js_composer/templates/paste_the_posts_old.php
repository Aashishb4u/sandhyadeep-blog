<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');

$content_width = esc_attr(ThewriterOptions::get('layout--content_width'));
$format_exclude = explode(',', $atts['post_format_exclude']);
$posts_per_page = ($atts['style'] == 'pagination') ? $atts['items_per_page'] : $atts['max_items'] ;
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$ignore_sticky_posts = ($atts['ignore_sticky'] == 'Yes') ? true : false;

$args = array( 
	'post_type' => 'post',
	'orderby' => $atts['orderby'],
	'order' => $atts['order'],
	'posts_per_page' => $posts_per_page,
	'paged' => $paged,
	'ignore_sticky_posts' => $ignore_sticky_posts,
	'tax_query' => array(
		array(
			'taxonomy' => 'post_format',
			'field'    => 'slug',
			'terms'    => $format_exclude,
			'operator' => 'NOT IN'
		)
	)
);
$posts_count = 0;
if($atts['style'] == 'pagination') {
	if ($paged*$posts_per_page > $atts['max_items']) {
		$posts_count = $atts['max_items']-$posts_per_page;
	}
}
if ($atts['offset']) {
	global $offset_fat;
	global $postspp;
	global $mnp;
	global $pc;
	$pc = 0;
	$offset_fat = $atts['offset'];
	$postspp = $posts_per_page;
	$mnp = $atts['max_items'];

	if ($posts_count != 0) {
		$pc = $posts_count;
	}
	add_action('pre_get_posts', 'myprefix_query_offset', 1 );
if (!function_exists('myprefix_query_offset')) { 
	function myprefix_query_offset(&$the_query) {

	    //Before anything else, make sure this is the right query...
	    if ( ! $the_query->is_home() ) {
	        return;
	    }

	    //First, define your desired offset...
	    global $offset_fat;
	    $offset = $offset_fat;
	    
	    //Next, determine how many posts per page you want (we'll use WordPress's settings)
		global $postspp;
	    $ppp = $postspp;

	    //Next, detect and handle pagination...
	    if ( $the_query->is_paged ) {

	        //Manually determine page query offset (offset + current page (minus one) x posts per page)
	        $page_offset = $offset + ( ($the_query->query_vars['paged']-1) * $ppp );
			global $pc;
			if ($pc !=0) {
	        	$the_query->set( 'posts_per_page', $pc );
			}
	        //Apply adjust page offset
	        $the_query->set('offset', $page_offset );

	    }
	    else {

	        //This is the first page. Just use the offset...
	        $the_query->set('offset',$offset);

	    }
	}
}
	if ($atts['style'] == 'pagination') {
		add_filter('found_posts', 'myprefix_adjust_offset_pagination', 1, 2 );
		if (!function_exists('myprefix_adjust_offset_pagination')) { 
			function myprefix_adjust_offset_pagination($found_posts, $the_query) {

			    //Define our offset again...
				global $mnp;
				global $pc;
				if ($pc !=0) {
					$mnp = $mnp - $pc;
				}
			    return $found_posts = $mnp;
			}
		}
	}
	else {
		add_filter('found_posts', 'myprefix_adjust_offset_pagination', 1, 2 );

		if (!function_exists('myprefix_adjust_offset_pagination')) { 
			function myprefix_adjust_offset_pagination($found_posts, $the_query) {

			    //Define our offset again...
			    global $offset_fat;
			    $offset = $offset_fat;


			    //Ensure we're modifying the right query object...
			    if ( $the_query->is_home() ) {
			        //Reduce WordPress's found_posts count by the offset... 
			        return $found_posts - $offset;
			    }
			    return $found_posts;
			}
		}
	}
}


$the_query = new WP_Query( $args );



global $thewriter_post_loop;
$thewriter_post_loop = 1;

global $post;
$old_post = $post;

$blog_view = $atts['custom_grid'];

global $thewriter_content_width_custom; 
$thewriter_content_width_custom = ThewriterOptions::get('layout--content_width');
global $thewriter_sidebar_location_custom; 
if (!ThewriterHelpers::get_sidebar_location()) {
	$thewriter_sidebar_location_custom = 'none';
}
else {
	$thewriter_sidebar_location_custom = ThewriterHelpers::get_sidebar_location();
}


$classes = array();
$classes[] = 'row js--masonry';
if ($blog_view == 'grid') {
	$classes[] = 'grid-border';
}
if ($blog_view == 'metro' && $content_width == 'expanded') {
	$classes[] = '__expanded';
}
if ($blog_view != 'standard' && $blog_view != 'boxed') { ?>
	<div class="<?php echo esc_attr(join(' ', $classes)); ?>">
<?php 
}
$pfstd = '';
foreach ($format_exclude as $key => $pf) {
	if ($pf == 'post-format-standard') {
		$pfstd = 'Y';
	}
}
if ($the_query->have_posts()) {
	while ($the_query->have_posts()) {
		$the_query->the_post();
		if ($pfstd == 'Y') {
	        if (!get_post_format()) {
	        	continue;
	        }
	    }
		get_template_part( 'post-templates/layout', $blog_view );  
	}
	wp_reset_postdata();
	$post = $old_post;
} else {
	get_template_part( 'content', 'none' );
}
if ($blog_view != 'standard' && $blog_view != 'boxed') { ?>
	</div>
<?php
}

if($atts['style'] == 'pagination') {?>
	<nav class="navigation posts-nav" role="navigation">
		<ul class="posts-nav-lst">
			<li class="posts-nav-prev"><?php
				next_posts_link('<span class="post-nav-prev_desc fbq-sm-button"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>' . esc_html__(' Older posts', 'thewriter') . '</span>', $the_query->max_num_pages);
			?></li>
			<li class="posts-nav-next"><?php
				previous_posts_link('<span class="post-nav-next_desc fbq-sm-button">' . esc_html__('Newer posts ', 'thewriter') . '<i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>');
				?></li>
		</ul>
	</nav>
<?php
}