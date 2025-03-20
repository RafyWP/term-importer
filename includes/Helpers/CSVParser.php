<?php

namespace RafyCo\TermImporter\Helpers;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Class CSVParser
 *
 * Handles CSV file parsing for importing terms.
 */
class CSVParser {

    /**
     * Reads and parses a CSV file.
     *
     * @param string $file_path Path to the CSV file.
     * @return array Parsed CSV data as an associative array.
     */
    public static function parse( string $file_path ): array {
        $data = [];

        if ( ( $handle = fopen( $file_path, 'r' ) ) !== false ) {
            $headers = fgetcsv( $handle, 1000, ',' );

            if ( ! $headers ) {
                fclose( $handle );
                return [];
            }

            while ( ( $row = fgetcsv( $handle, 1000, ',' ) ) !== false ) {
                $data[] = array_combine( $headers, $row );
            }

            fclose( $handle );
        }

        return $data;
    }

    /**
     * Validates the CSV structure.
     *
     * @param array $csv_data Parsed CSV data.
     * @return bool True if valid, false otherwise.
     */
    public static function validate( array $csv_data ): bool {
        $required_headers = [ 'name', 'slug', 'description' ];

        if ( empty( $csv_data ) || ! isset( $csv_data[0] ) ) {
            return false;
        }

        $csv_headers = array_keys( $csv_data[0] );

        return count( array_intersect( $required_headers, $csv_headers ) ) === count( $required_headers );
    }
}
