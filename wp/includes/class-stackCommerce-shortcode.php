<?php
function stackCommerce_shortcode($atts, $content = null)
{
    /* Include js script on the shortcode construction */
    wp_enqueue_script('stackCommerce-lib',  'https://widgets.stackcommerce.com/deal-feed/stackCommerceWidget-v2.min.js', array('jquery'), null, true);


    global $stackCommerceWidget_settings;




    /* Get shortcode settings object */
    $stackCommerce_shortcode_settings = get_option('stackCommerce_shortcode');

    $defaults = array(
        'see_all_deals_text' => 'See all deals',
        'item_title_size' => "14",
        'sc_per_page' => "2",
        'shortcode_hide_price' => "1",
        'shortcode_hide_discount' => "1",
        'column_count' => "3",
        'shortcode_hide_button' => "0"
    );

    $stackCommerce_shortcode_settings = wp_parse_args($stackCommerce_shortcode_settings, $defaults);

    $stackCommerce_general_settings = get_option('stackCommerceWidget_general_options');
    $URL_affiliate = $stackCommerce_general_settings['affiliateID'];

    $item_title_size = $stackCommerce_shortcode_settings['shortcode_product_text_size'];
    $shortcode_title_size = $stackCommerce_shortcode_settings['shortcode_text_size'];

    $layoutClass = "col3";
    if ($atts['layout'] != NULL) {
        $layoutClass = "col" . $atts['layout'];
    }

    $shortcodeTitle = $stackCommerce_shortcode_settings['shortcodeTitle'];

    /* Shortcode parameter for sorting , if no value is provided defaults to best sellers */
    $shortcodeSort = $atts['sort'];
    if ($shortcodeSort == NULL) {
        $shortcodeSort = "best_sellers";
    }

    if ($stackCommerce_general_settings['open_new_tab'] == "on") {
        $stackCommerceLinkTarget = "target='_blank'";
    } else {
        $stackCommerceLinkTarget = "";
    }
    

    if ($atts['count'] != "") {
        $stackCommerceShortcode_count = $atts['count'];
    }
    return '<div class="stackCommerceInlineDisplayWrap">
        <div class="stackCommerceInlineDisplayHeader">
            <div class="stackCommerceInlineHeaderText" style="font-size: ' . $shortcode_title_size . 'px">' . $shortcodeTitle . '</div>
        </div>
   <div data-sc-widget="vertical"
             data-sc-publisher-id="' . $stackCommerce_general_settings['publisherID'] . '"
             data-sc-sort="' . $shortcodeSort . '"
             data-sc-per-page="' . $stackCommerceShortcode_count . '"
             data-sc-header-color="#FF3131"
             data-sc-widget-title="shortcode-display"
             data-sc-hide-price="' . $stackCommerce_shortcode_settings['shortcode_hide_price'] . '"
             data-sc-hide-ribon="' . $stackCommerce_shortcode_settings['shortcode_hide_discount'] . '"
             data-sc-hide-button="' . $stackCommerce_shortcode_settings['shortcode_hide_button'] . '"
             data-sc-open-new-tab="' . $stackCommerce_general_settings['open_new_tab'] . '"
             data-sc-utm="' . $stackCommerce_general_settings['utm_source'] . '"
             data-sc-affiliate-id="' . $URL_affiliate . '"
             data-sc-utm-additional="' . $stackCommerce_general_settings['additional_url_params'] . '"

             data-sc-title-sizes="' . $item_title_size . '"
             class="stackCommerceWidgetSidebar stackCommerceShortcode stackCommerceHeightFix ' . $layoutClass . '"
             >
        </div>
        </div>';
}

add_shortcode('stackCommerce', 'stackCommerce_shortcode');