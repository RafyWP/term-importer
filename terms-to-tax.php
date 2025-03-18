<?php
/**
 * Plugin Name:       TermsToTax: Terms Importer for WordPress Custom Taxonomies
 * Plugin URI:        https://rafy.com.br/
 * Description:       Imports terms from a CSV file into custom taxonomies in WordPress.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Rafy Co.
 * Author URI:        https://rafy.com.br/
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       terms-to-tax
 * Domain Path:       /languages
 * Update URI:        https://rafy.com.br/terms-to-tax/
 *
 * @package           RafyCo\TermsToTax
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
function terms_to_tax_initialize() {
    if ( class_exists( 'RafyCo\\TermsToTax\\Core\\TermsToTax' ) ) {
        RafyCo\TermsToTax\Core\TermsToTax::init();
    }
}
add_action( 'plugins_loaded', 'terms_to_tax_initialize' );
