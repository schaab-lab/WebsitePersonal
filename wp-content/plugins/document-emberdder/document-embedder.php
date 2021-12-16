<?php 
/*
 * Plugin Name: Document Embedder
 * Plugin URI:  http://documentembedder.com/
 * Description: Embed Any document easily in wordpress such as word, excel, powerpoint, pdf and more
 * Version:     1.7.6
 * Author:      bPlugins LLC
 * Author URI:  http://bplugins.com
 * License:     GPLv3
 * Text Domain:  ppv
 * Domain Path:  /languages
 */

function ppv_load_textdomain() {
    load_plugin_textdomain( 'document-emberdder', false, dirname( __FILE__ ) . "/languages" );
}

add_action( "plugins_loaded", 'ppv_load_textdomain' );

/*Some Set-up*/
define('PPV_VER', '1.7.6'); 
define('PPV_PLUGIN_DIR', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' ); 
define('PPV_IMPORT', '1.0.0'); 


require_once(__DIR__.'/upgrade.php');

use PPV\Services\Import;

//Remove post update massage and link
function ppv_updated_messages( $messages ) {
 $messages['ppt_viewer'][1] = __('Updated ');
return $messages;
}
add_filter('post_updated_messages','ppv_updated_messages');
			
// After activation redirect
register_activation_hook(__FILE__, 'ppv_plugin_activate');
add_action('admin_init', 'ppv_plugin_redirect');

function ppv_plugin_activate() {
    add_option('ppv_plugin_do_activation_redirect', true);
}

function ppv_plugin_redirect() {
    if (get_option('ppv_plugin_do_activation_redirect', false)) {
        delete_option('ppv_plugin_do_activation_redirect');
        wp_redirect('edit.php?post_type=ppt_viewer&page=ppv_howto');
    }

    if(get_option('ppv_import', '0') < PPV_IMPORT){
        Import::import();
        update_option('ppv_import', PPV_IMPORT);
    }
}

add_action('init', function(){
    Import::import();
    // echo PPV_PRO_PLUGIN;
});