<?php
/*
Plugin Name: Woocommerce Product Labels Lite
Plugin URI: http://woolabels.voodoopress.net
Description: With this  plugin you can insert product images with labels on them. Any type of content can be added.
Version: 1.1
Author: Evgen "EvgenDob" Dobrzhanskiy
Author URI: http://woolabels.voodoopress.net
Stable tag: 1.1
*/

include('modules/meta_box.php');
include('modules/shortcodes.php');
include('modules/functions.php');
include('modules/hooks.php');
include('modules/scripts.php');

register_activation_hook( __FILE__, 'wl_activate' );
function wl_activate() {
	flush_rewrite_rules();
}

function wl_init() {
 $plugin_dir = basename(dirname(__FILE__));
 load_plugin_textdomain( 'wl', false, $plugin_dir );
}
add_action('plugins_loaded', 'wl_init');
add_action('after_setup_theme', 'wl_init');
?>