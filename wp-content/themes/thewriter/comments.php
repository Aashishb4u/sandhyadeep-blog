<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

if ( post_password_required() ) {
	return;
}

?>

<div id="comments" class="comments-w">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-h">
			<?php
			$number_of_comments = get_comments_number();
			printf( _nx( 'Comment', '%s comments', $number_of_comments, 'comments title', 'thewriter' ),
				number_format_i18n( $number_of_comments ));
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h6 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'thewriter' ); ?></h6>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'thewriter' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'thewriter' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ul class="comments-lst">
			<?php wp_list_comments( array('callback' => 'ThewriterHelpers::comment') ); ?>
		</ul><!-- .comment-lst -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h6 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'thewriter' ); ?></h6>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'thewriter' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'thewriter' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'thewriter' ); ?></p>
	<?php endif; ?>

	<?php comment_form( array(
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'comment_field' => '<div class="comment-form-field comment-form-comment">
			<textarea id="comment" name="comment" cols="45" rows="8" required aria-required="true" placeholder="'.esc_html__('Comment*', 'thewriter').'"></textarea>
		</div>',
	)); ?>

</div><!-- #comments -->
