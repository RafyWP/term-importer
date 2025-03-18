<?php

namespace RafyCo\TermsToTax\Core;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Debugger class for logging messages.
 */
class Debugger {
    
    /**
     * Logs a message to the WordPress debug log.
     *
     * @param string $message The message to log.
     * @param array  $context Optional. Additional context data.
     * @return void
     */
    public static function log( string $message, array $context = [] ): void {
        if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
            error_log( '[TermsToTax] ' . $message . ' ' . print_r( $context, true ) );
        }
    }
}
