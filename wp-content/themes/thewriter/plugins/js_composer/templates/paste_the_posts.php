<?php

// don't load directly
if (!defined('ABSPATH')) die('-1');

$meta_options 			= get_option( 'thewriter__post_list_metabox' );
$post_id 				= get_the_ID();
$meta_posts_per_page 	= ( isset($meta_options[ $post_id ]['items_per_page']) ? $meta_options[ $post_id ]['items_per_page'] : '999' );

//var_dump($meta_options);

$content_width 			= esc_attr( ThewriterOptions::get( 'layout--content_width' ) );
$format_exclude 		= explode( ',', $atts['post_format_exclude'] );
$paged 					= ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
// $ignore_sticky_posts 	= ( $atts['ignore_sticky'] == 'Yes' ) ? true : false;
$ignore_sticky_posts 	= false;

if ( $atts['element_type'] == 'pagination' ) {
	$meta_posts_per_page_offset = $meta_options[ $post_id ]['items_per_page_with_offset'];
	$args_pagination = array( 
		'post_type' 			=> 'post',
		'posts_per_page' 		=> $meta_posts_per_page_offset,
		'paged' 				=> $paged - 1,
		'ignore_sticky_posts' 	=> $ignore_sticky_posts,
		'tax_query' 			=> array(
			array(
				'taxonomy' 	=> 'post_format',
				'field' 	=> 'slug',
				'terms' 	=> $format_exclude,
				'operator' 	=> 'NOT IN'
			)
		)
	);
	$query_pagination = new WP_Query( $args_pagination );

	$pages 		= '';
	$range 		= 2;
	$showitems 	= ( $range * 2 ) + 1;

	global $thewriter_cst_nav_paged;
	if ( empty( $thewriter_cst_nav_paged ) ) {
		$thewriter_cst_nav_paged = 1;
	}

	if ( $pages == '' ) {
		$pages = $query_pagination->max_num_pages;
		if ( ! $pages ) {
			$pages = 1;
		}
	}
	?>
	<nav class="navigation posts-nav" role="navigation">
		<div class="pagination-block">
			<div class="bottom_next_link <?php if ( $paged < $pages ) { ?>active<?php } ?>">
				<?php 
				if ( $paged < $pages ) {
					next_posts_link( '<span class="post-nav-next_desc"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></span>', $query_pagination->max_num_pages );
				} else {
					?>
					<span class="post-nav-next_desc">
						<i class="fa fa-long-arrow-left" aria-hidden="true"></i>
					</span>
					<?php
				}
				?>
			</div>
		</div>
		<div class="pagination-block">
			<div class="bottom_prev_link text-right <?php if ( get_previous_posts_link() ) { ?>active<?php } ?>">
				<?php 
					if ( get_previous_posts_link() ) {
						previous_posts_link( '<span class="post-nav-prev_desc"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>' );
					} else {
						?>
						<span class="post-nav-prev_desc">
							<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
						</span>
						<?php
					}
				?>
			</div>
		</div>
	</nav>
	<?php
} else {

$posts_per_addon = esc_attr( $atts['max_items'] );
// query for posts
$args = array( 
	'post_type' 			=> 'post',
	'orderby' 				=> $atts['orderby'],
	'order' 				=> $atts['order'],
	'posts_per_page' 		=> $posts_per_addon,
	'paged' 				=> $paged,
	'ignore_sticky_posts' 	=> $ignore_sticky_posts,
	'tax_query' 			=> array(
		array(
			'taxonomy' 	=> 'post_format',
			'field' 	=> 'slug',
			'terms' 	=> $format_exclude,
			'operator' 	=> 'NOT IN'
		)
	)
);

// if ( $atts['style'] == 'pagination' ) {
// 	$args_pagination = $args;
// 	$args_pagination['posts_per_page'] = $posts_per_addon + $atts['offset'];
// 	$query_pagination = new WP_Query( $args_pagination );
// }

$posts_count = 0;
if ( $atts['style'] == 'pagination' ) {
	if ( $paged * $posts_per_addon > $atts['max_items'] ) {
		$posts_count = $atts['max_items'] - $posts_per_addon;
	}
}
// if ( $atts['offset'] ) {
	global $offset_fat;
	global $postspp;
	global $mnp;
	global $pc;
	$pc 		= 0;

	$offset_fat = $atts['offset'];
	
	// $postspp 	= $meta_posts_per_page;
	$postspp 	= $meta_posts_per_page;
	$mnp 		= $atts['max_items'];
	// $mnp = $meta_posts_per_page;

	if ( $posts_count != 0 ) {
		$pc = $atts['max_items'];
	}
	add_action( 'pre_get_posts', 'myprefix_query_offset', 1 );
	if ( ! function_exists( 'myprefix_query_offset' ) ) { 
		function myprefix_query_offset( &$the_query ) {

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
				if ( $the_query->query_vars['paged'] === 1 ) {
					$page_offset = $offset;
				} else {
					$page_offset = ( ( $ppp + 1 ) * ( $the_query->query_vars['paged'] - 1 ) ) + $offset;
				}
				global $pc;
				if ( $pc != 0 ) {
					$the_query->set( 'posts_per_page', $pc );
				}
				//Apply adjust page offset
				$the_query->set( 'offset', $page_offset );

			} else {

				//This is the first page. Just use the offset...
				$the_query->set( 'offset', $offset );

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
	if ( ! ThewriterHelpers::get_sidebar_location() ) {
		$thewriter_sidebar_location_custom = 'none';
	} else {
		$thewriter_sidebar_location_custom = ThewriterHelpers::get_sidebar_location();
	}
	global $thewriter_custom_post_margin;
	if ( $atts['col_margin'] || $atts['col_margin'] == 0 ) {
		$thewriter_custom_post_margin = $atts['col_margin'];
	} else {
		$thewriter_custom_post_margin = 'none';
	}
	global $thewriter_custom_post_padding;
	if ( $atts['col_padding'] || $atts['col_padding'] == 0 ) {
		$thewriter_custom_post_padding = $atts['col_padding'];
	} else {
		$thewriter_custom_post_padding = 'none';
	}
	global $thewriter_custom_post_height;
	if ( $atts['col_height'] || $atts['col_height'] == 0 ) {
		$thewriter_custom_post_height = $atts['col_height'];
	} else {
		$thewriter_custom_post_height = 'none';
	}
	global $thewriter_custom_post_cols;
	if ( $atts['col_numbers'] != 'default' ) {
		$thewriter_custom_post_cols = $atts['col_numbers'];
		if ($atts['col_numbers_md']) {
			$thewriter_custom_post_cols .= ' ' . $atts['col_numbers_md'];
		}
		if ($atts['col_numbers_xl']) {
			$thewriter_custom_post_cols .= ' ' . $atts['col_numbers_xl'];
		}
		if ($atts['col_numbers_xxl']) {
			$thewriter_custom_post_cols .= ' ' . $atts['col_numbers_xxl'];
		}
		if ($atts['col_numbers_xxxl']) {
			$thewriter_custom_post_cols .= ' ' . $atts['col_numbers_xxxl'];
		}
	} else {
		$thewriter_custom_post_cols = 'none';
	}

	$classes 	= array();
	$classes[] 	= 'row js--masonry';
	if ( $blog_view == 'metro' && $content_width == 'expanded' ) {
		$classes[] = '__expanded';
	}
	if ( $blog_view != 'standard' ) {
		?>
		<div class="<?php echo esc_attr( join( ' ', $classes ) ); ?>">
		<?php 
	}
	$pfstd = '';
	foreach ( $format_exclude as $key => $pf ) {
		if ( $pf == 'post-format-standard' ) {
			$pfstd = 'Y';
		}
	}
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			if ( $pfstd == 'Y' ) {
				if ( ! get_post_format() ) {
					continue;
				}
			}
			get_template_part( 'post-templates/layout', $blog_view );  
		}
		wp_reset_postdata();
		$post = $old_post;
	} else {
		// get_template_part( 'content', 'none' );
	}
	if ( $blog_view != 'standard' ) {
		?>
		</div>
		<?php
	}

	unset( $thewriter_custom_post_margin );
	unset( $thewriter_custom_post_padding );
	unset( $thewriter_custom_post_height );
	unset( $thewriter_custom_post_cols );
	unset( $thewriter_custom_style );
	unset( $thewriter_custom_color_scheme );

}


