<?php
/**
 * Plugin Name:       CF7 Postmeta Tag por EveraldoDev
 * Plugin URI:        https://everaldo.dev/plugins/
 * Description:       Plugin to custom and improvements WordPress.
 * Version:           0.0.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Everaldo Matias
 * Author URI:        https://everaldo.dev/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://everaldo.dev/plugins/cf7-postmeta-tag
 * Text Domain:       cf7-postmeta-tag
 * Domain Path:       /languages
 */

function cf7_postmeta_tag_plugin_activate() {
    flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'cf7_postmeta_tag_plugin_activate' );

define( 'CF7_POSTMETA_TAG_VERSION', '0.0.3' );
define( 'CF7_POSTMETA_TAG_PATH', plugins_url( '/', __FILE__ ) );

require_once( 'includes/enqueues.php' );
require_once( 'includes/functions.php' );
