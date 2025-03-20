<?php

namespace RafyCo\TermImporter\Core;

use RafyCo\TermImporter\Helpers\CSVParser;
use RafyCo\TermImporter\Exceptions\ImporterException;
use RafyCo\TermImporter\Core\Debugger;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Main plugin class.
 */
class TermImporter {
    
    /**
     * Initializes the plugin.
     *
     * @return void
     */
    public static function init(): void {
        add_action( 'admin_menu', [ self::class, 'add_admin_menu' ] );
        add_action( 'admin_post_term_importer_import', [ self::class, 'handle_import' ] );
    }

    /**
     * Retrieves all registered taxonomies.
     *
     * @return array<string, string> List of taxonomies with their labels.
     */
    private static function get_taxonomies(): array {
        $taxonomies = get_taxonomies( [ 'public' => true ], 'objects' );
        $taxonomy_options = [];

        foreach ( $taxonomies as $taxonomy ) {
            $taxonomy_options[ $taxonomy->name ] = $taxonomy->label;
        }

        return $taxonomy_options;
    }

    /**
     * Adds a menu item to the WordPress admin panel.
     *
     * @return void
     */
    public static function add_admin_menu(): void {
        add_menu_page(
            __( 'Term Importer to Taxonomy', 'term-importer' ),
            __( 'Term Importer', 'term-importer' ),
            'manage_options',
            'term-importer',
            [ self::class, 'render_admin_page' ],
            'dashicons-upload',
            20
        );
    }

    /**
     * Renders the admin settings page.
     *
     * @return void
     */
    public static function render_admin_page(): void {
        $taxonomies = self::get_taxonomies();
        
        // Capture the message parameter
        $message = isset( $_GET['message'] ) ? sanitize_text_field( $_GET['message'] ) : '';

        ?>
        <div class="wrap">
            <h1><?php esc_html_e( 'Term Importer', 'term-importer' ); ?></h1>

            <?php if ( $message === 'success' ) : ?>
                <div class="notice notice-success is-dismissible">
                    <p><?php esc_html_e( 'Terms imported successfully!', 'term-importer' ); ?></p>
                </div>
            <?php elseif ( $message === 'error' && isset( $_GET['error'] ) ) : ?>
                <div class="notice notice-error is-dismissible">
                    <p><?php echo esc_html( urldecode( $_GET['error'] ) ); ?></p>
                </div>
            <?php endif; ?>

            <form method="post" enctype="multipart/form-data" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                <input type="hidden" name="action" value="term_importer_import">
                <?php wp_nonce_field( 'term_importer_import_nonce', 'term_importer_import_nonce_field' ); ?>

                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row">
                                <label for="taxonomy"><?php esc_html_e( 'Select Taxonomy:', 'term-importer' ); ?></label>
                            </th>
                            <td>
                                <select name="taxonomy" id="taxonomy" class="regular-text" required>
                                    <?php foreach ( $taxonomies as $slug => $label ) : ?>
                                        <option value="<?php echo esc_attr( $slug ); ?>"><?php echo esc_html( $label ); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <p class="description"><?php esc_html_e( 'Choose the taxonomy where the terms will be imported.', 'term-importer' ); ?></p>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <label for="terms_csv"><?php esc_html_e( 'Upload CSV File:', 'term-importer' ); ?></label>
                            </th>
                            <td>
                                <input type="file" name="terms_csv" id="terms_csv" accept=".csv" required>
                                <p class="description"><?php esc_html_e( 'Upload a CSV file containing the terms you want to import.', 'term-importer' ); ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <?php submit_button( __( 'Import Terms', 'term-importer' ) ); ?>
            </form>
        </div>
        <?php
    }

    /**
     * Handles the CSV import.
     *
     * @return void
     */
    public static function handle_import(): void {
        try {
            if ( ! isset( $_POST['term_importer_import_nonce_field'] ) ||
                 ! wp_verify_nonce( $_POST['term_importer_import_nonce_field'], 'term_importer_import_nonce' ) ) {
                throw new ImporterException( __( 'Security check failed', 'term-importer' ) );
            }

            if ( ! current_user_can( 'manage_options' ) ) {
                throw new ImporterException( __( 'You do not have permission to perform this action.', 'term-importer' ) );
            }

            if ( empty( $_POST['taxonomy'] ) || empty( $_FILES['terms_csv']['tmp_name'] ) ) {
                throw new ImporterException( __( 'Please select a taxonomy and upload a CSV file.', 'term-importer' ) );
            }

            $taxonomy = sanitize_text_field( $_POST['taxonomy'] );

            // Ensure the selected taxonomy exists.
            $available_taxonomies = self::get_taxonomies();
            if ( ! array_key_exists( $taxonomy, $available_taxonomies ) ) {
                throw new ImporterException( __( 'Invalid taxonomy selected.', 'term-importer' ) );
            }

            // Parse CSV file
            $csv_data = CSVParser::parse( $_FILES['terms_csv']['tmp_name'] );

            if ( ! CSVParser::validate( $csv_data ) ) {
                throw new ImporterException( __( 'Invalid CSV format. Ensure it contains "name", "slug", and "description" columns.', 'term-importer' ) );
            }

            // Insert Terms
            foreach ( $csv_data as $row ) {
                $term_name        = sanitize_text_field( $row['name'] );
                $term_slug        = sanitize_title( $row['slug'] );
                $term_description = sanitize_textarea_field( $row['description'] );

                $result = wp_insert_term(
                    $term_name,
                    $taxonomy,
                    [
                        'slug'        => $term_slug,
                        'description' => $term_description,
                    ]
                );

                if ( is_wp_error( $result ) ) {
                    throw new ImporterException( sprintf( __( 'Could not add the term "%s". It may already exist, have a conflicting slug, contain invalid characters, or be missing required fields.', 'term-importer' ), $term_name ) );
                }
            }

            // Get the referring admin page or fallback to default settings page
            $redirect_url = wp_get_referer() ? wp_get_referer() : admin_url( 'admin.php?page=term-importer' );

            // Add success message
            $redirect_url = add_query_arg( 'message', 'success', $redirect_url );

            // Redirect back
            wp_redirect( esc_url_raw( $redirect_url ) );
            exit;

        } catch ( ImporterException $e ) {
            $e->log(); // Log the error using Debugger

            // Display the error message in WordPress
            wp_die(
                '<h1>' . esc_html__( 'Import Error', 'term-importer' ) . '</h1>' .
                '<p>' . esc_html( $e->getMessage() ) . '</p>',
                esc_html__( 'Error Importing Terms', 'term-importer' ),
                [
                    'back_link' => true
                ]
            );
        }
    }
}
