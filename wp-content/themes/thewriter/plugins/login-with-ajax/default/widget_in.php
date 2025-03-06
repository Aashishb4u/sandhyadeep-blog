<?php
/*
 * This is the page users will see logged in. 
 * You can edit this, but for upgrade safety you should copy and modify this file into your template folder.
 * The location from within your template folder is plugins/login-with-ajax/ (create these directories if they don't exist)
*/

$user = wp_get_current_user();

?>

<div class="lwa js--show-me">
	<div class="lwa-title-sub __with-avatar __first"><?php echo esc_html__( 'Hi', 'thewriter' ) . " " . $user->display_name; ?></div>
	<div class="avatar lwa-avatar">
		<?php echo get_avatar( $user->ID, $size = '50' ); ?>
	</div>
	<ul class="lwa-info">
		<?php

		//Admin URL
		if ($lwa_data['profile_link']) {
			if (function_exists('bp_loggedin_user_link')) {
				?>
				<li>
					<a href="<?php echo esc_url(bp_loggedin_user_link()); ?>"><span class="feather-folder"></span> <?php esc_html_e('Profile','thewriter') ?></a>
				</li>
				<?php
			} else {
				?>
				<li>
					<a href="<?php echo trailingslashit(get_admin_url()); ?>profile.php"><span class="feather-folder"></span> <?php esc_html_e('Profile','thewriter') ?></a>
				</li>
				<?php
			}
		}

		//Blog Admin
		if (current_user_can('list_users')) {
			?>
			<li>
				<a href="<?php echo esc_url(get_admin_url()); ?>"><span class="feather-cog"></span> <?php esc_html_e('Dashboard', 'thewriter'); ?></a>
			</li>
			<?php
		}

		//Logout URL
		?>
		<li>
			<a id="wp-logout" href="<?php echo esc_url(wp_logout_url()); ?>"><span class="feather-power"></span> <?php esc_html_e('Log Out' ,'thewriter') ?></a>
		</li>
	</ul>
</div>
