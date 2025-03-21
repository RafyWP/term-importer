<?php
/**
 * Plugin Name:       Term Importer Lite
 * Plugin URI:        https://rafy.com.br/project/term-importer/
 * Description:       Easily import terms into any custom taxonomy in WordPress using a simple CSV file. Save time, streamline your workflow, and manage taxonomies effortlessly—no manual input needed!
 * Version:           2.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Rafy Co.
 * Author URI:        https://rafy.com.br/
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       term-importer
 * Domain Path:       /languages
 * Update URI:        https://github.com/RafyWP/term-importer/tree/master
 *
 * @package           RafyCo\TermImporter
 * @author            Rafy Co.
 * @copyright         2025 Rafy Co.
 * @license           GPL-2.0-or-later
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Ensure Composer's autoload is available.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    require_once __DIR__ . '/vendor/autoload.php';
}

/**
 * Initialize the plugin.
 */
function term_importer_initialize() {
    if ( class_exists( \RafyCo\TermImporter\Core\TermImporter::class ) ) {
        \RafyCo\TermImporter\Core\TermImporter::init();
    }
}
add_action( 'plugins_loaded', 'term_importer_initialize', 10 );

if ( ! class_exists( \RafyCo\TermImporter\Core\Deactivator::class ) ) {
    require_once plugin_dir_path( __FILE__ ) . 'includes/Core/Deactivator.php';
}

register_deactivation_hook(
    __FILE__,
    [ \RafyCo\TermImporter\Core\Deactivator::class, 'deactivate' ]
);
