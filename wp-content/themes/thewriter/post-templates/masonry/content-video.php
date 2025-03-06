

<?php if (is_sticky()) { ?>

	<div class="post-masonry_sticky-inner">
			
<?php ThewriterPostFormats::video(); ?>
		<div class="post-masonry_desc-w">
			<?php get_template_part( 'post-templates/masonry/part', 'category' ); ?>
			<?php get_template_part( 'post-templates/masonry/part', 'header' ); ?>
			<div class="post-masonry_top_part">
				<div class="row">
					<div class="col-xs-12">
						<span class="post-masonry_author"><?php the_author(); ?></span>
						<?php get_template_part( 'post-templates/masonry/part', 'date' ); ?>
					</div>
				</div>
			</div>
			<div class="post-masonry_desc">
				<?php echo apply_filters( 'the_excerpt', ThewriterPostFormats::esc(get_the_excerpt()) ); ?>
			</div>
		</div>
		<div class="post-masonry_bottom_part">
			<div class="row">
				<div class="col-xs-6">
					<div class="post-masonry_btn-w">
						<a href="<?php echo esc_url(get_permalink()); ?>" class="fbq-sm-button">
							<?php esc_html_e('Continue', 'thewriter'); ?>
						</a>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="post-masonry_share_container text_right">
						<span class="post-share_txt">
							<?php esc_html_e('Share:', 'thewriter'); ?>
						</span>
						<?php ThewriterModules::share_icons(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } else {?>
<?php ThewriterPostFormats::video(); ?>

<div class="post-masonry_desc-w">

	<?php get_template_part( 'post-templates/masonry/part', 'category' ); ?>

	<?php get_template_part( 'post-templates/masonry/part', 'header' ); ?>


	<div class="post-masonry_desc">
		<?php echo apply_filters( 'the_content', ThewriterPostFormats::esc() ); ?>
	</div>

</div>
<div class="post-masonry_top_part">
	<div class="row">
		<div class="col-xs-12">
			<span class="post-masonry_author"><?php the_author(); ?></span>
			<?php get_template_part( 'post-templates/masonry/part', 'date' ); ?>
		</div>
	</div>
</div>
<?php }?>
