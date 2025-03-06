<?php
$template_dir = get_template_directory();

require_once $template_dir . '/classes/Theme.php';
require_once $template_dir . '/classes/Setup.php';
require_once $template_dir . '/classes/Options.php';
require_once $template_dir . '/classes/Helpers.php';
require_once $template_dir . '/classes/Modules.php';
require_once $template_dir . '/classes/PostFormats.php';
require_once $template_dir . '/classes/Addons.php';

require_once $template_dir . '/plugins/tgm-plugin-activation/init.php';

function thewriter_enqueue_comment_reply() {
    // on single blog post pages with comments open and threaded comments
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { 
        // enqueue the javascript that performs in-link comment reply fanciness
        wp_enqueue_script( 'comment-reply' ); 
    }
}
// Hook into wp_enqueue_scripts
add_action( 'wp_enqueue_scripts', 'thewriter_enqueue_comment_reply' );

// Init vc addon for grid
add_action( 'vc_before_init', 'vc_before_init_actions' );
function vc_before_init_actions() {
    require_once get_template_directory() . '/vc-addon/VCAddons.php' ;
}

function ocdi_import_files() {
  return array(
    array(
      'import_file_name'             => 'Demo Import 1',
      'categories'                   => array( 'Category 1', 'Category 2' ),
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'classes/options/extensions/wbc_importer/demo-data/Default/content.xml',
      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'classes/options/extensions/wbc_importer/demo-data/Default/widgets.json',
      'local_import_redux'           => array(
        array(
          'file_path'   => trailingslashit( get_template_directory() ) . 'classes/options/extensions/wbc_importer/demo-data/Default/theme-options.json',
          'option_name' => 'thewriter_options',
        ),
      ),
      'import_preview_image_url'     => 'http://thewriter.themes.tvda.pw/wp-content/themes/thewriter/screenshot.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'thewriter' ),
      'preview_url'                  => 'http://thewriter.themes.tvda.pw',
    ),
  );
}
add_filter( 'pt-ocdi/import_files', 'ocdi_import_files' );