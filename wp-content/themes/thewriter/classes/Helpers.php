<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');


class ThewriterHelpers extends ThewriterTheme {


	public static function get_image_sizes($size = '') {
		return parent::get_image_sizes($size);
	}


	public static function get_image_size_names() {
		return parent::get_image_size_names();
	}


	public static function get_intermediate_size_image_src($file, $width, $height, $crop = false) {
		if ($width || $height) {
			$editor = wp_get_image_editor($file);

			if (is_wp_error($editor) || is_wp_error($editor->resize($width, $height, $crop)))
				return false;

			$resized_file = $editor->save();

			if (!is_wp_error($resized_file) && $resized_file) {
				$upload_dir = wp_upload_dir();
				return str_replace($upload_dir['basedir'], $upload_dir['baseurl'], $resized_file['path']);
			}
		}
		return false;
	}


	public static function get_social_icons() {
		return self::$social_icons;
	}


	public static function get_logo($logo_theme = '') {

		$logo = '';
		$logo = self::get_option('header--logo_dark');
		$logo_retina = '';
		$logo_retina = self::get_option('header--logo_dark_retina');
		$retina = is_array($logo_retina) && $logo_retina['url'] ? true : false;

		$logo_light = '';
		$logo_light = self::get_option('header--logo_light');
		$logo_light_retina = '';
		$logo_light_retina = self::get_option('header--logo_light_retina');
		$retina_light = is_array($logo_light_retina) && $logo_light_retina['url'] ? true : false;

		if ($logo_theme == 'dark') {?>

			<div class="logo-w __dark" style="width:<?php echo esc_attr($logo['width']); ?>px">
				<a href="<?php echo esc_url(home_url('/')); ?>">
					<img class="logo <?php if ($retina) { ?>__not-retina<?php } ?>" alt="<?php bloginfo('name'); ?>" src="<?php echo esc_url($logo['url']); ?>">
					<?php if ($retina) {
						?><img class="logo __retina" alt="<?php bloginfo('name'); ?>" src="<?php echo esc_url($logo_retina['url']); ?>"><?php
					} ?>
				</a>
			</div>

		<?php } else if ($logo_theme == 'light') { ?>

			<div class="logo-w __light" style="width:<?php echo esc_attr($logo_light['width']); ?>px">
				<a href="<?php echo esc_url(home_url('/')); ?>">
					<img class="logo <?php if ($retina_light) { ?>__not-retina<?php } ?>" alt="<?php bloginfo('name'); ?>" src="<?php echo esc_url($logo_light['url']); ?>">
					<?php if ($retina_light) {
						?><img class="logo __retina" alt="<?php bloginfo('name'); ?>" src="<?php echo esc_url($logo_light_retina['url']); ?>"><?php
					} ?>
				</a>
			</div>

		<?php } else {

			if ((is_array($logo) && $logo['url']) && (is_array($logo_light) && $logo_light['url'])) { ?>
				<div class="logo-w __dark __display-block" style="width:<?php echo esc_attr($logo['width']); ?>px">
					<a href="<?php echo esc_url(home_url('/')); ?>">
						<img class="logo <?php if ($retina) { ?>__not-retina<?php } ?>" alt="<?php bloginfo('name'); ?>" src="<?php echo esc_url($logo['url']); ?>">
						<?php if ($retina) {
							?><img class="logo __retina" alt="<?php bloginfo('name'); ?>" src="<?php echo esc_url($logo_retina['url']); ?>"><?php
						} ?>
					</a>
				</div>
				<div class="logo-w __light __display-none" style="width:<?php echo esc_attr($logo_light['width']); ?>px">
					<a href="<?php echo esc_url(home_url('/')); ?>">
						<img class="logo <?php if ($retina_light) { ?>__not-retina<?php } ?>" alt="<?php bloginfo('name'); ?>" src="<?php echo esc_url($logo_light['url']); ?>">
						<?php if ($retina_light) {
							?><img class="logo __retina" alt="<?php bloginfo('name'); ?>" src="<?php echo esc_url($logo_light_retina['url']); ?>"><?php
						} ?>
					</a>
				</div>
			<?php } else if (is_array($logo) && $logo['url']) { ?>
				<div class="logo-w __display-block" style="width:<?php echo esc_attr($logo['width']); ?>px">
					<a href="<?php echo esc_url(home_url('/')); ?>">
						<img class="logo <?php if ($retina) { ?>__not-retina<?php } ?>" alt="<?php bloginfo('name'); ?>" src="<?php echo esc_url($logo['url']); ?>">
						<?php if ($retina) {
							?><img class="logo __retina" alt="<?php bloginfo('name'); ?>" src="<?php echo esc_url($logo_retina['url']); ?>"><?php
						} ?>
					</a>
				</div>
			<?php } else if (is_array($logo_light) && $logo_light['url']) { ?>
				<div class="logo-w __display-block" style="width:<?php echo esc_attr($logo_light['width']); ?>px">
					<a href="<?php echo esc_url(home_url('/')); ?>">
						<img class="logo <?php if ($retina_light) { ?>__not-retina<?php } ?>" alt="<?php bloginfo('name'); ?>" src="<?php echo esc_url($logo_light['url']); ?>">
						<?php if ($retina_light) {
							?><img class="logo __retina" alt="<?php bloginfo('name'); ?>" src="<?php echo esc_url($logo_light_retina['url']); ?>"><?php
						} ?>
					</a>
				</div>
			<?php } else { ?>
				<div class="logo-w __dark" style="width:<?php echo esc_attr($logo['width']); ?>px">
					<a href="<?php echo esc_url(home_url('/')); ?>">
						<img class="logo <?php if ($retina) { ?>__not-retina<?php } ?>" alt="<?php bloginfo('name'); ?>" src="<?php echo get_template_directory_uri() . '/images/thewriter.png'?>">
					</a>
				</div>
				<!-- <div class="logo-w">
					<a href="<?php // echo esc_url(home_url('/')); ?>" class="logo_tx"><?php // bloginfo('name'); ?></a>
				</div> -->
				<?php
			}

		}

	}


	public static function is_negative_header() {
		// DO NOT USE IN LOOP OR AFTER LOOP
		if (
			(get_post_type() == 'product' && (is_singular() || (!is_singular() && !self::is_title_wrapper()))) ||
			(function_exists('is_account_page') && is_account_page() && !is_user_logged_in()) ||
			(!is_home() && get_post_type() == 'post' && !self::is_title_wrapper()) ||
			!self::get_option('header--negative_height') ||
			is_404() ||
			!have_posts()
		) {
			return false;
		}
		return true;
	}


	public static function is_title_wrapper() {
		if (
			is_404() ||
			is_singular(array('product')) ||
			(function_exists('is_account_page') && is_account_page() && !is_user_logged_in())
		) {
			return false;
		}
		return self::get_option('title_wrapper');
	}


	public static function is_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( self::$theme_prefix . '_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'fields' => 'ids',
				'hide_empty' => 1,

				// We only need to know if there is more than one category.
				'number' => 2,
			) );

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( self::$theme_prefix . '_categories', $all_the_cool_cats );
		}

		if (
			$all_the_cool_cats > 1 &&
			(
				(self::get_option('posts--categories') && !is_single()) ||
				(self::get_option('single_post--categories') && is_single())
			)
		) {
			// This blog has more than 1 category so is_categorized_blog() should return true.
			return true;
		} else {
			// This blog has only 1 category so is_categorized_blog() should return false.
			return false;
		}
	}


	public static function get_sidebar_location() {
		$sidebar_location = self::get_option('layout--sidebars');
		if (
			is_404() ||
			$sidebar_location == 'without' ||
			($sidebar_location == 'left' && !is_active_sidebar('sidebar_left')) ||
			($sidebar_location == 'right' && !is_active_sidebar('sidebar_right')) ||
			(
				($sidebar_location == 'both' || $sidebar_location == 'both_left' || $sidebar_location == 'both_right') &&
				(!is_active_sidebar('sidebar_left') || !is_active_sidebar('sidebar_right'))
			)
		) {
			return false;
		}
		return $sidebar_location;
	}


	public static function get_responsive_column_classes($columns = 1, $loop = false) {

		$classes = array();

		if ( self::get_option('layout--content_width') == 'expanded' ) {

			if ($columns == 1) {
				$classes[] = 'col-xs-12';
			} elseif ($columns == 2) {
				$classes[] = 'col-xs-12 col-md-6 col-xxl-4';
				if ($loop !== false && $loop % 2 == 0) { $classes[] = 'first-md'; }
				if ($loop !== false && $loop % 3 == 0) { $classes[] = 'first-xxl'; }
			} elseif ($columns == 3) {
				$classes[] = 'col-xs-12 col-sm-6 col-md-4 col-xxl-3';
				if ($loop !== false && $loop % 2 == 0) { $classes[] = 'first-sm'; }
				if ($loop !== false && $loop % 3 == 0) { $classes[] = 'first-md'; }
				if ($loop !== false && $loop % 4 == 0) { $classes[] = 'first-xxl'; }
			} elseif ($columns == 4) {
				$classes[] = 'col-xs-12 col-sm-4 col-md-3 col-xxl-2';
				if ($loop !== false && $loop % 3 == 0) { $classes[] = 'first-sm'; }
				if ($loop !== false && $loop % 4 == 0) { $classes[] = 'first-md'; }
				if ($loop !== false && $loop % 6 == 0) { $classes[] = 'first-xxl'; }
			} else {
				$classes[] = 'col-xs-6 col-sm-3 col-md-2';
				if ($loop !== false && $loop % 4 == 0) { $classes[] = 'first-sm'; }
				if ($loop !== false && $loop % 6 == 0) { $classes[] = 'first-md'; }
			}

		} else {

			if ($columns == 1) {
				$classes[] = 'col-xs-12';
			} elseif ($columns == 2) {
				$classes[] = 'col-xs-12 col-md-6';
				if ($loop !== false && $loop % 2 == 0) { $classes[] = 'first-md first-xxl'; }
			} elseif ($columns == 3) {
				$classes[] = 'col-xs-12 col-sm-6 col-md-4';
				if ($loop !== false && $loop % 2 == 0) { $classes[] = 'first-sm'; }
				if ($loop !== false && $loop % 3 == 0) { $classes[] = 'first-md first-xxl'; }
			} else {
				$classes[] = 'col-xs-6 col-sm-4 col-md-3';
				if ($loop !== false && $loop % 4 == 0) { $classes[] = 'first-sm'; }
				if ($loop !== false && $loop % 6 == 0) { $classes[] = 'first-md first-xxl'; }
			}

		}

		return $classes;

	}


	public static function get_dynamic_area($id) {
		if($id) {
			global $post;
			$old_post = $post;
			$post = get_post($id);
			if ($post) {
				echo '<div class="container">';
				echo apply_filters('the_content', $post->post_content);
				echo '</div>';

				// Display custom row CSS by VC
				$vc_styles = get_post_meta($id , '_wpb_shortcodes_custom_css', true);
				if($vc_styles !== '') {
					echo '<style>' . $vc_styles .'</style>';
				}
			}
			$post = $old_post;
		}
	}


	public static function comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;

		if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) { ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<div class="comment-body">
				<?php esc_html_e( 'Pingback:', 'thewriter' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( 'Edit', 'thewriter' ), '<span class="edit-link">', '</span>' ); ?>
			</div>

		<?php } else { ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
				<div class="clearfix">
					<div class="comment-avatar-w">
						<div class="comment-avatar"><?php echo get_avatar( $comment, 70 ); ?></div>
					</div>
					<div class="comment-content-w">
						<footer class="comment-meta">
							<div class="vcard">

								<h6 class="fn comment-author"><?php echo get_comment_author_link(); ?></h6>
								<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" class="comment-date">
									<time datetime="<?php comment_time( 'c' ); ?>">
										<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'thewriter' ), get_comment_date(), get_comment_time() ); ?>
									</time>
									<?php edit_comment_link( esc_html__('Edit', 'thewriter') ); ?>
								</a>

							</div><!-- .comment-author -->

							<?php if ( '0' == $comment->comment_approved ) { ?>
							<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'thewriter' ); ?></p>
							<?php } ?>
						</footer><!-- .comment-meta -->

						<div class="comment-content">
							<?php comment_text(); ?>
						</div><!-- .comment-content -->
						<?php
							comment_reply_link( array_merge( $args, array(
								'add_below' => 'div-comment',
								'depth'	 => $depth,
								'max_depth' => $args['max_depth'],
								'before'	=> '<div class="comment-reply">',
								'after'	 => '</div>',
								'reply_text'=> esc_html__('leave reply', 'thewriter'),
							) ) );
						?>
					</div>
				</div>
			</article>

		<?php
		}
	}


	public static function posts_navigation($post_type = 'posts') {
		if ( $GLOBALS['wp_query']->max_num_pages < 2 || !self::get_option($post_type . '--nav')) {
			return;
		}
		?>
		<nav class="navigation posts-nav" role="navigation">
			<ul class="posts-nav-lst">
				<?php if (get_next_posts_link()) { ?>
					<li class="posts-nav-prev"><?php
						next_posts_link('<span class="post-nav-prev_desc fbq-sm-button"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>' . esc_html__(' Older posts', 'thewriter') . '</span>');
					?></li>
				<?php } ?>
				<?php if (get_previous_posts_link()) { ?>
					<li class="posts-nav-next"><?php
						previous_posts_link('<span class="post-nav-next_desc fbq-sm-button">' . esc_html__('Newer posts ', 'thewriter') . '<i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>');
					?></li>
				<?php } ?>
			</ul>
		</nav>
		<?php
	}


	public static function post_navigation($fixed = false) {
		$classes = '';

		if ($fixed) {
			$prev = get_previous_post_link(
				'<li class="post-nav-prev __fixed">%link</li>',
				'<i class="feather-arrow-left" aria-hidden="true"></i><div class="footer__prev-post"><span class="post-nav-prev_desc">' . esc_html__(' Previous reading', 'thewriter') . '</span><span class="post-nav-prev_h">%title</span></div>'
			);
			$next = get_next_post_link(
				'<li class="post-nav-next __fixed">%link</li>',
				'</span><i class="feather-arrow-right" aria-hidden="true"></i><div class="footer__next-post"><span class="post-nav-next_desc">' . esc_html__('Next reading ', 'thewriter') . '</span><span class="post-nav-next_h">%title</span></div>'
			);
			$classes = '__fixed';
		} else {
			$prev = get_previous_post_link(
				'<li class="post-nav-prev">%link</li>',
				'<i class="feather-arrow-left" aria-hidden="true"></i><div class="footer__prev-post"><span class="post-nav-prev_desc">' . esc_html__(' Previous reading', 'thewriter') . '</span><span class="post-nav-prev_h">%title</span></div>'
			);
			$next = get_next_post_link(
				'<li class="post-nav-next">%link</li>',
				'</span><i class="feather-arrow-right" aria-hidden="true"></i><div class="footer__next-post"><span class="post-nav-next_desc">' . esc_html__('Next reading ', 'thewriter') . '</span><span class="post-nav-next_h">%title</span></div>'
			);
		}

		if (!$next && !$prev) {
			return;
		}
		?>
		<nav class="navigation post-nav <?php echo esc_attr($classes); ?>" role="navigation">
			<ul class="post-nav-lst">
				<?php echo wp_kses($prev, 'post'); ?>
				<?php echo wp_kses($next, 'post'); ?>
			</ul>
		</nav>
		<?php
	}


	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	public static function search_meta() {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

		$time_string = sprintf( $time_string,
			esc_attr(get_the_date('c')),
			esc_html(get_the_date())
		);

		$posted_on = sprintf(_x( 'On %s', 'post date', 'thewriter' ), $time_string);

		$byline = sprintf(
			_x( 'by %s', 'post author', 'thewriter' ),
			'<span class="author vcard">' . esc_html(get_the_author()) . '</span>'
		);

		echo '<a href="' . esc_url(get_permalink()) . '" class="posted-on"><span class="post-masonry_date">' . $posted_on . '</span></a> <span class="post-masonry_date"> ' . $byline . '</span>';
	}


}

// ThewriterHelpers::init();
