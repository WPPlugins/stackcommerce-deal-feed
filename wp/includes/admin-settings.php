<?php

// Layout the admin settings page.
function stackCommerceWidget_settings_page()
{
    /* Don't delete this function, this is for disabling double top level pages */
}

// Create admin menu item
function stackCommerceWidget_add_menu_item()
{
    add_menu_page('stackCommerce', 'StackCommerce', 'disable', 'stackCommerceWidget-options', 'stackCommerceWidget_settings_page', plugin_dir_url(__FILE__) . "/img/SC_logoIcon.png");
    add_submenu_page('stackCommerceWidget-options', 'General settings', 'General Settings', 'manage_options', 'stackCommerce_general_settings', 'stackCommerceGeneralSettingsPage');
    add_submenu_page('stackCommerceWidget-options', 'Styling settings', 'Styling settings', 'manage_options', 'stackCommerce_style_settings', 'stackCommerceStyleSettingsPage');
    add_submenu_page('stackCommerceWidget-options', 'Shortcode settings', 'Shortcode Settings', 'manage_options', 'stackCommerce_shortcode_settings', 'stackCommerceShortcodeSettingsPage');
}

add_action('admin_menu', 'stackCommerceWidget_add_menu_item');


// Create our settings in the WP options table.
function stackCommerceWidget_register_settings()
{
    $stackCommerce_general_options = get_option('stackCommerceWidget_general_options'); // Retrieve plugin options from the database

    /* General options group */
    register_setting('stackCommerceWidget_general_settings', 'stackCommerceWidget_general_options', 'stackCommerce_general_validate');
    add_settings_section(
        'general_options_section',                            // Name of the section
        'StackCommerce general settings',                // Title of the section, displayed on the options page
        'stackCommerce_general_callback',        // Callback function for displaying information
        'stackCommerce_general_page'                            // Page ID for the options page
    );

    add_settings_field(                        // Set whether author info is pulled from post meta or global user data
        'publisherID',                            // Field ID
        'Publisher ID',        // Field title, displayed to the left of the field on the options page
        'stackCommerce_generalSection_callback',        // Callback function to display the field
        'stackCommerce_general_page',                        // Page ID for the options page
        'general_options_section'                            // Settings section in which to display the field
    );

    add_settings_field(                        // Set whether author info is pulled from post meta or global user data
        'open_new_tab',                            // Field ID
        'Open all deals in new tab',        // Field title, displayed to the left of the field on the options page
        'stackCommerce_general_section_open_new_tab_callback',        // Callback function to display the field
        'stackCommerce_general_page',                        // Page ID for the options page
        'general_options_section'                            // Settings section in which to display the field
    );

    add_settings_field(                        // Set whether author info is pulled from post meta or global user data
        'utm_source',                            // Field ID
        'UTM Source',        // Field title, displayed to the left of the field on the options page
        'stackCommerce_general_section_utm_source_callback',        // Callback function to display the field
        'stackCommerce_general_page',                        // Page ID for the options page
        'general_options_section'                            // Settings section in which to display the field
    );


    add_settings_field(                        // Set whether author info is pulled from post meta or global user data
        'additional_url_params',                            // Field ID
        'Additional URL parameters',        // Field title, displayed to the left of the field on the options page
        'stackCommerce_general_section_additional_url_params_callback',        // Callback function to display the field
        'stackCommerce_general_page',                        // Page ID for the options page
        'general_options_section'                            // Settings section in which to display the field
    );

    if($stackCommerce_general_options['publisherID'] == 1 || $stackCommerce_general_options['publisherID'] == 126) {
        add_settings_field(                        // Set whether author info is pulled from post meta or global user data
            'affiliateID',                            // Field ID
            'Affiliate ID',        // Field title, displayed to the left of the field on the options page
            'stackCommerce_general_section_affiliate_callback',        // Callback function to display the field
            'stackCommerce_general_page',                        // Page ID for the options page
            'general_options_section'                            // Settings section in which to display the field
        );
    }


    /* Shortcode options group */

    register_setting('stackCommere_shortcode_options', 'stackCommerce_shortcode', 'stackCommerce_shortcode_validate'); // Register the settings group and specify validation and database locations

    add_settings_section(
        'shortcode_options_section',                            // Name of the section
        'Stack Commerce shortcode settings',                // Title of the section, displayed on the options page
        'stackCommerce_shortcode_callback',        // Callback function for displaying information
        'stackCommerce_shortcode_page'                            // Page ID for the options page
    );

    add_settings_field(                        // Set whether author info is pulled from post meta or global user data
        'shortcodeTitle',                            // Field ID
        'Shortcode section title',        // Field title, displayed to the left of the field on the options page
        'stackCommerce_shortcodeSection_callback',        // Callback function to display the field
        'stackCommerce_shortcode_page',                        // Page ID for the options page
        'shortcode_options_section'                            // Settings section in which to display the field
    );

    add_settings_field(                        // Set whether author info is pulled from post meta or global user data
        'shortcode_text_size',                        // Field ID
        'Shortcode header text size',    // Field title, displayed to the left of the field on the options page
        'stackCommerce_shortcode_section_text_size_callback',    // Callback function to display the field
        'stackCommerce_shortcode_page',                        // Page ID for the options page
        'shortcode_options_section'                            // Settings section in which to display the field
    );

    add_settings_field(                        // Set whether author info is pulled from post meta or global user data
        'shortcode_product_text_size',                        // Field ID
        'Shortcode product title size',    // Field title, displayed to the left of the field on the options page
        'stackCommerce_shortcode_section_product_text_size_callback',    // Callback function to display the field
        'stackCommerce_shortcode_page',                        // Page ID for the options page
        'shortcode_options_section'                            // Settings section in which to display the field
    );

    add_settings_field(                        // Set whether author info is pulled from post meta or global user data
        'shortcode_hide_price',                        // Field ID
        'Hide price in shortcode display?',    // Field title, displayed to the left of the field on the options page
        'stackCommerce_shortcode_section_hide_price_callback',    // Callback function to display the field
        'stackCommerce_shortcode_page',                        // Page ID for the options page
        'shortcode_options_section'                            // Settings section in which to display the field
    );

    add_settings_field(                        // Set whether author info is pulled from post meta or global user data
        'shortcode_hide_discount',                        // Field ID
        'Hide discount ribbon in shortcode display?',    // Field title, displayed to the left of the field on the options page
        'stackCommerce_shortcode_section_hide_discount_callback',    // Callback function to display the field
        'stackCommerce_shortcode_page',                        // Page ID for the options page
        'shortcode_options_section'                            // Settings section in which to display the field
    );

    add_settings_field(                        // Set whether author info is pulled from post meta or global user data
        'shortcode_hide_button',                        // Field ID
        'Hide buy button in shortcode display?',    // Field title, displayed to the left of the field on the options page
        'stackCommerce_shortcode_section_hide_button_callback',    // Callback function to display the field
        'stackCommerce_shortcode_page',                        // Page ID for the options page
        'shortcode_options_section'                            // Settings section in which to display the field
    );

    register_setting('stackCommerceWidget_settings_group', 'stackCommerceWidget_settings');

}


add_action('admin_init', 'stackCommerceWidget_register_settings');

function stackCommerceWidget_custom_wp_admin_style()
{
    wp_register_style('stackCommerceWidget_wp_admin_css', plugin_dir_url(__FILE__) . '/css/stackCommerceAdmin.css', false, '1.0.0');
    wp_register_style('stackCommerceWidget_wp_admin_css_preview', plugin_dir_url(__FILE__) . '/css/stackCommerceWidget.css', false, '1.0.0');
    wp_enqueue_style('stackCommerceWidget_wp_admin_css_preview');
    wp_enqueue_style('stackCommerceWidget_wp_admin_css');

}

add_action('admin_enqueue_scripts', 'stackCommerceWidget_custom_wp_admin_style');