<?php
/**
 * Term Importer
 * 
 * Easily import terms into any custom taxonomy in WordPress using a simple CSV file. Save time, streamline your workflow, and manage taxonomies effortlessly—no manual input needed!
 * 
 * @link              https://rafy.com.br/project/term-importer/
 * @since             1.0.0
 * @package           RafyCo\TermImporter
 * @author            Rafy Co.
 * @license           GPL-2.0-or-later
 * 
 * @wordpress-plugin
 * Plugin Name:       Term Importer
 * Plugin URI:        https://rafy.com.br/project/term-importer/
 * Description:       Easily import terms into any custom taxonomy in WordPress using a simple CSV file. Save time, streamline your workflow, and manage taxonomies effortlessly—no manual input needed!
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Rafy Co.
 * Author URI:        https://rafy.com.br/
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       term-importer
 * Domain Path:       /languages
 * Update URI:        https://github.com/RafyWP/term-importer/tree/master
 * Network:           true
 */

defined( 'ABSPATH' ) || exit;

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    require_once __DIR__ . '/vendor/autoload.php';
}

/**
 * Initialize the plugin.
 */
function term_importer_initialize() {
    if ( class_exists( 'RafyCo\\TermImporter\\Core\\TermImporter' ) ) {
        RafyCo\TermImporter\Core\TermImporter::init();
    }
}
add_action( 'plugins_loaded', 'term_importer_initialize' );
