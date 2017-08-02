<?php
//if uninstall not called from WordPress exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
    exit();

$option_name = 'stackCommerceWidget_general_options';
$stackCommerce_shortcode = 'stackCommerce_shortcode';

delete_option( $option_name );
delete_option( $stackCommerce_shortcode );
