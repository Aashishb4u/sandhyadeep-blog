<?php
/**
 * The template for displaying 404 pages (not found).
 */

get_header(); ?>

	<div class="error-404 not-found">
		<div class="page-content">
			<div class="no-results-page">
				<p class="no-results-page_lbl __404"><?php esc_attr_e('404', 'thewriter')?></p>
				<h3 class="no-results-page_h"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'thewriter' ); ?></h3>
				<p class="no-results-page_desk"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'thewriter' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		</div>
	</div>

<?php get_footer(); ?>
