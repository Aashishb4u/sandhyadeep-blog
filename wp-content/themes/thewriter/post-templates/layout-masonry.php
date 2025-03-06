<?php
global $thewriter_post_loop;
global $thewriter_custom_post_margin;
global $thewriter_custom_post_padding;
global $thewriter_custom_post_height;
global $thewriter_custom_post_cols;

$post_format = get_post_format();
$classes = 'post-masonry __layout_masonry __' . ($post_format ? $post_format : 'standard') . (wp_is_mobile() ? ' __mobile' : '');

global $thewriter_content_width_custom;
if ($thewriter_content_width_custom) {
	$content_width = esc_attr($thewriter_content_width_custom);
} else {
	$content_width = ThewriterOptions::get('layout--content_width');
}

global $thewriter_sidebar_location_custom;
if ($thewriter_sidebar_location_custom || $thewriter_sidebar_location_custom == 'none' ) {
	if($thewriter_sidebar_location_custom == 'none') {
		$sidebar_location = false;
	} else {
		$sidebar_location = esc_attr($thewriter_sidebar_location_custom);
	}
} else {
	$sidebar_location = ThewriterHelpers::get_sidebar_location();
}

$col_classes = array();
if ($content_width == 'expanded') {
	if ($sidebar_location) {
		$col_classes[] = 'col-xs-12 col-md-6 col-xl-4 col-xxl-3';
	} else {
		$col_classes[] = 'col-xs-12 col-sm-6 col-md-4 col-xl-3 col-xxxl-2';
	}
} elseif ($content_width == 'normal') {
	if ($sidebar_location) {
		$col_classes[] = 'col-xs-12 col-md-6';
	} else {
		$col_classes[] = 'col-xs-12 col-sm-6 col-md-4';
	}
} else {
	$col_classes[] = 'col-xs-12 col-sm-6';
}

if (ThewriterOptions::get('single_post--double_width')) {

    if ($content_width == 'expanded') {
        if ($sidebar_location) {
            $col_classes[] = 'col-xs-12 col-xl-8 col-xxl-6';
        } else {
            $col_classes[] = 'col-xs-12 col-md-8 col-xl-6 col-xxxl-4';
        }
    } elseif ($content_width == 'normal') {
        if ($sidebar_location) {
            $col_classes[] = 'col-xs-12';
        } else {
            $col_classes[] = 'col-xs-12 col-md-8';
        }
    } else {
        $col_classes[] = 'col-xs-12';
    }

}

if($thewriter_custom_post_cols != 'none' && !empty($thewriter_custom_post_cols)) {
	unset($col_classes);
	$col_classes = esc_attr($thewriter_custom_post_cols);?>
	<div class="<?php echo esc_attr($col_classes); ?> animate-on-screen js--animate-on-screen" <?php if($thewriter_custom_post_padding != 'none') {?> style="padding-left: <?php echo esc_attr($thewriter_custom_post_padding)?>px!important; padding-right: <?php echo esc_attr($thewriter_custom_post_padding)?>px!important" <?php }?>>
	<?php 
} else {
?>
	<div class="<?php echo esc_attr(join(' ', $col_classes)); ?> animate-on-screen js--animate-on-screen" <?php if($thewriter_custom_post_padding != 'none') {?> style="padding-left: <?php echo esc_attr($thewriter_custom_post_padding)?>px!important; padding-right: <?php echo esc_attr($thewriter_custom_post_padding)?>px!important" <?php }?>>
<?php 
}

if (is_sticky()) {
	$classes .= ' __sticky';
}
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?> style="<?php if($thewriter_custom_post_margin != 'none') {?> margin: <?php echo esc_attr($thewriter_custom_post_margin)?>px; <?php }?> <?php if($thewriter_custom_post_height != 'none') {?> height: <?php echo esc_attr($thewriter_custom_post_height)?>px!important; <?php }?>">
			<?php get_template_part( 'post-templates/masonry/content', $post_format ); ?>
		</article>
	</div>