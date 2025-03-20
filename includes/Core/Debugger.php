<?php

namespace RafyCo\TermImporter\Core;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Class Debugger
 *
 * Provides debugging functionality for the plugin.
 */
class Debugger {

    /**
     * Logs a message to the WordPress debug log.
     *
     * @param string $message The message to log.
     * @param array  $context Optional. Additional context.
     * @return void
     */
    public static function log( string $message, array $context = [] ): void {
        if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
            $log_message = '[TermImporter] ' . $message;
            
            // Append context only if it is not empty
            if ( ! empty( $context ) ) {
                $log_message .= ' ' . print_r( $context, true );
            }

            error_log( $log_message );
        }
    }
}
