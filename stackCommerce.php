<?php
/**
 * Plugin Name: StackCommerce Deal Feed
 * Plugin URI: https://wordpress.org/plugins/stackcommerce-deal-feed/
 * Description: The StackCommerce Deal Feed is the best way to surface curated and relevant tech & lifestyle deals in front of your readers.
 * Version: 1.1.6
 * Author: StackCommerce, Inc
 * Author URI: https://stackcommerce.com
 */
// Get plugin settings from the WP options table.


define( 'STACKCOMMERCE__PLUGIN_URL', plugin_dir_url( __FILE__ ) );

$stackCommerceWidget_settings = get_option( 'stackCommerceWidget_settings');



require plugin_dir_path( __FILE__ ) . 'wp/includes/display-functions.php';
require plugin_dir_path( __FILE__ ) . 'wp/includes/class-stackCommerce-shortcode-settings.php';
require plugin_dir_path( __FILE__ ) . 'wp/includes/partials/part-style-settings.php';
require plugin_dir_path( __FILE__ ) . 'wp/includes/partials/part-general-settings.php';

require plugin_dir_path( __FILE__ ) . 'wp/includes/class-stackCommerce-widget.php';
require plugin_dir_path( __FILE__ ) . 'wp/includes/class-stackCommerce-shortcode.php';
require plugin_dir_path( __FILE__ ) . 'wp/includes/admin-settings.php';
