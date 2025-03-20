<?php

namespace RafyCo\TermImporter\Exceptions;

use Exception;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Class ImporterException
 *
 * Custom exception for handling import errors in TermImporter.
 */
class ImporterException extends Exception {

    /**
     * Logs the exception message using Debugger.
     *
     * @return void
     */
    public function log(): void {
        \RafyCo\TermImporter\Core\Debugger::log( $this->getMessage() );
    }
}
