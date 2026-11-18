<?php
/**
 * Plugin Name: WordPress MCP Agent
 * Description: Secure WordPress AI development agent with code/content/media/Elementor editing, encrypted backups, rollback, diagnostics, and one-click MCP registration.
 * Version: 0.1.0
 * Author: Jobayer Hossan
 * Requires at least: 6.4
 * Requires PHP: 8.0
 * Update URI: https://github.com/jobayerhossan/wp-mcp-agent
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'WPMCP_AGENT_VERSION', '0.1.0' );
define( 'WPMCP_AGENT_FILE', __FILE__ );
define( 'WPMCP_AGENT_DIR', plugin_dir_path( __FILE__ ) );
define( 'WPMCP_BACKUP_DIR', WP_CONTENT_DIR . '/wp-mcp-backups' );

require_once WPMCP_AGENT_DIR . 'includes/class-wpmcp-auth.php';
require_once WPMCP_AGENT_DIR . 'includes/class-wpmcp-backups.php';
require_once WPMCP_AGENT_DIR . 'includes/class-wpmcp-files.php';
require_once WPMCP_AGENT_DIR . 'includes/class-wpmcp-runtime.php';
require_once WPMCP_AGENT_DIR . 'includes/class-wpmcp-content.php';
require_once WPMCP_AGENT_DIR . 'includes/class-wpmcp-media.php';
require_once WPMCP_AGENT_DIR . 'includes/class-wpmcp-elementor.php';
require_once WPMCP_AGENT_DIR . 'includes/class-wpmcp-rest.php';
require_once WPMCP_AGENT_DIR . 'includes/class-wpmcp-admin.php';

register_activation_hook( __FILE__, function () {
    if ( ! get_option( 'wpmcp_site_id' ) ) {
        update_option( 'wpmcp_site_id', 'site_' . wp_generate_password( 18, false, false ), false );
    }
    if ( ! get_option( 'wpmcp_site_secret' ) ) {
        update_option( 'wpmcp_site_secret', bin2hex( random_bytes( 32 ) ), false );
    }
    if ( ! get_option( 'wpmcp_backup_key' ) ) {
        update_option( 'wpmcp_backup_key', bin2hex( random_bytes( 32 ) ), false );
    }

    WPMCP_Backups::ensure_backup_dir();
} );

add_action( 'plugins_loaded', function () {
    WPMCP_REST::init();

    WPMCP_Admin::init();
} );
