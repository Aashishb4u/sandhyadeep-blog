<div class="js--search-form js--show-me search-form">
	<a href="#" class="js--search-form-hide">
		<span class="search-form-close">
			<span class="search-form-close-elem-1"></span>
			<span class="search-form-close-elem-2"></span>
		</span>
	</a>
	<div class="popup-menu-popup_bg"></div>
	<form
		role="search"
		method="get"
		action="<?php echo esc_url(home_url('/')); ?>"
		class="js-search-form"
	>
		<input
			class="search-form_it js--focus-me"
			type="search"
			value="<?php echo get_search_query(); ?>"
			name="s"
			placeholder="Search"
			size="40"
		><button
			class="search-form_button"
			type="submit"
			value="<?php esc_html_e('Search', 'thewriter'); ?>"
		><span class="feather-search xbig"></span><span class="search-text"><?php esc_html_e( 'Search', 'thewriter' ); ?></span></button>
	</form>
	<div class="logo-url"><?php ThewriterHelpers::get_logo('light'); ?></div>
</div>