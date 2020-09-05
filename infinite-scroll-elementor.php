<?php
/**
 * Plugin Name: Infinite Scroll Elementor
 * Description: Infinite Scroll Elementor pulls the next posts automatically when the reader approaches the bottom of the page.
 * Tags: infinite scroll, load more, pagination, paginate, scroll, infinite, infinity, ajax, posts, products, elementor, woocommerce, facetwp, jetsmartfilters
 * Plugin URI: https://joychetry.com/infinite-scroll-elementor/
 * Version: 2.1.1
 * Author: Joy Chetry
 * Author URI: https://joychetry.com/
 * Text Domain: infinite-scroll-elementor
 */

if ( ! defined( 'ABSPATH' ) ) exit;

final class infinite_scroll_elementor_Final {

	const VERSION = '2.1.1';
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
	const MINIMUM_PHP_VERSION = '5.6';

	public function __construct() {
		// Load translation
		add_action( 'init', array( $this, 'i18n' ) );

		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}
	
	public function i18n() {
		load_plugin_textdomain( 'infinite-scroll-elementor-td' );
	}

	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}

		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( 'includes/validation.php' );
	}

	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'infinite-scroll-elementor-td' ),
			'<strong>' . esc_html__( 'Infinite Scroll Elementor', 'infinite-scroll-elementor-td' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'infinite-scroll-elementor-td' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'infinite-scroll-elementor-td' ),
			'<strong>' . esc_html__( 'Infinite Scroll Elementor', 'infinite-scroll-elementor-td' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'infinite-scroll-elementor-td' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'infinite-scroll-elementor-td' ),
			'<strong>' . esc_html__( 'Infinite Scroll Elementor', 'infinite-scroll-elementor-td' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'infinite-scroll-elementor-td' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
}

new infinite_scroll_elementor_Final();

// Check for updates
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/joychetry/infinite-scroll-elementor',
	__FILE__,
	'infinite-scroll-elementor'
);

//Optional: If you're using a private repository, specify the access token like this:
$myUpdateChecker->setAuthentication('b07d238b25a3bef78ead0fa86bc5cb49ae8839bd');

//Optional: Set the branch that contains the stable release.
$myUpdateChecker->setBranch('master');

include('includes/shortcuts.php');
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'ISE_add_action_links');