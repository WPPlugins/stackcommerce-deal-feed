<?php

function stackCommerce_load_custom_wp_admin_style()
{
    wp_enqueue_style('wp-color-picker');
    wp_register_style('custom_wp_admin_css', plugin_dir_url(__FILE__) . 'css/stackCommerceAdmin.css', false, '1.0.0');
    wp_enqueue_script('my_custom_script', plugin_dir_url(__FILE__) . 'js/stackCommerceAdmin.js', array('wp-color-picker'), '1.0.6');
    wp_enqueue_style('custom_wp_admin_css');
}


add_action('admin_enqueue_scripts', 'stackCommerce_load_custom_wp_admin_style');

// Include this plugin's public JS & CSS files on posts.
function stackCommerceWidget_load_scripts_styles()
{
    global $stackCommerceWidget_settings;

    wp_enqueue_style(
        'custom-style',
        STACKCOMMERCE__PLUGIN_URL . 'wp/includes/css/custom_script.css'
    );

    $defaults = array(
        'button_color' => '#2db500',
        'box_background' => "#f7f7f7",
        'button_text_color' => '#ffffff'
    );

    $stackCommerceWidget_settings = wp_parse_args($stackCommerceWidget_settings, $defaults);

    if (isset($stackCommerceWidget_settings['hide_discount'])) {
        if ($stackCommerceWidget_settings['hide_discount'] == 1) {
            $stackCommerceWidget_settings['hide_discount'] = "none";

        } else {
            $stackCommerceWidget_settings['hide_discount'] = "block";
        }

        if ($stackCommerceWidget_settings['hide_all_deals'] == 1) {
            $stackCommerceWidget_settings['hide_all_deals'] = "none";

        } else {
            $stackCommerceWidget_settings['hide_all_deals'] = "block";
        }
    } else {
        $stackCommerceWidget_settings['hide_discount'] = "block";
    }

    if(!isset($stackCommerceWidget_settings['hide_all_deals'])) {
        $stackCommerceWidget_settings['hide_all_deals'] = "block";
    }

    if(!isset($stackCommerceWidget_settings['header_text_size'])) {
        $stackCommerceWidget_settings['header_text_size'] = "40";
    }


    $custom_css = "
                .stackCommerceWidgetSidebar .singlestackCommerceItem .stackCommerceItemPrice{
                        background: {$stackCommerceWidget_settings['button_color']};
                        color: {$stackCommerceWidget_settings['button_text_color']};
                }
                .stackCommerceWidgetSidebar .singlestackCommerceItem {
                    background: {$stackCommerceWidget_settings['box_background']};
                }
                .stackCommerceWidgetSidebar .singlestackCommerceItem .singlestackCommerceItemDiscount {
                    background: {$stackCommerceWidget_settings['ribon_background']};
                    color: {$stackCommerceWidget_settings['ribon_text']};
                    display: {$stackCommerceWidget_settings['hide_discount']};
                }
                .stackCommerceSeeAllDeals {
                    display: {$stackCommerceWidget_settings['hide_all_deals']};
                }
                .stackCommerceInlineDisplayHeader .stackCommerceInlineHeaderText {
                    font-size: {$stackCommerceWidget_settings['header_text_size']}px;
                }
                .singlestackCommerceItem {
                    background: {$stackCommerceWidget_settings['box_background']};
                }
                {$stackCommerceWidget_settings['custom_css']}";
    wp_add_inline_style('custom-style', $custom_css);

}

add_action('wp_enqueue_scripts', 'stackCommerceWidget_load_scripts_styles');