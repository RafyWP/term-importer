<?php
/**
 * Handles plugin deactivation.
 *
 * @package RafyCo\TermImporter\Core
 */

namespace RafyCo\TermImporter\Core;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Deactivator {
    /**
     * Runs on plugin deactivation.
     */
    public static function deactivate() {
        // Ensure is_plugin_active() is available
        if ( ! function_exists( 'is_plugin_active' ) ) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        $premium_plugin_slug = 'term-importer-premium/term-importer-premium.php';

        // Check if Term Importer Premium is active
        if ( is_plugin_active( $premium_plugin_slug ) ) {
            wp_die(
                esc_html__( 'Term Importer Premium requires the Term Importer plugin to be installed and activated.', 'term-importer-premium' ),
                esc_html__( 'Plugin Activation Error', 'term-importer-premium' ),
                [ 'back_link' => true ]
            );
        }
    }
}
