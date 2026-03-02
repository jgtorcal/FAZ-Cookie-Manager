<?php
/**
 * Standalone scanner bootstrap — run via PHP-CLI when WP-CLI is unavailable.
 *
 * Usage: php run-scan.php /path/to/wordpress 20
 *
 * @package FAZ_Cookie_Manager
 */

if ( php_sapi_name() !== 'cli' ) {
	exit( 'CLI only.' );
}

$abspath = isset( $argv[1] ) ? rtrim( $argv[1], '/' ) . '/' : '';
$mode    = isset( $argv[2] ) ? $argv[2] : '20';

if ( empty( $abspath ) || ! file_exists( $abspath . 'wp-load.php' ) ) {
	fwrite( STDERR, "WordPress not found at: $abspath\n" );
	exit( 1 );
}

// Bootstrap WordPress.
define( 'ABSPATH', $abspath );
define( 'SHORTINIT', false );
require_once $abspath . 'wp-load.php';

$controller = \FazCookie\Admin\Modules\Scanner\Includes\Controller::get_instance();

if ( 'httponly' === $mode ) {
	// Quick httpOnly cookie check on homepage only.
	$controller->run_httponly_check();
	echo "httpOnly check complete.\n";
} else {
	// Full scan.
	$max_pages = absint( $mode );
	$result    = $controller->run_scan( $max_pages );
	echo 'Scan complete: ' . wp_json_encode( $result ) . "\n";
}
