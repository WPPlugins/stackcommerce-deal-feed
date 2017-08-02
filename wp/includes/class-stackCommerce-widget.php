<?php

// Creating the widget
class WP_Widget_stackCommerceWidget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
        // Base ID of your widget
            'stackCommerce_widget',

            // Widget name will appear in UI
            __('StackCommerce Deal Feed', 'stackCommerce_widget_domain'),

            // Widget description
            array('description' => __('StackCommerce widget for displaying deals from stackCommerce.com', 'stackCommerce_widget_domain'),)
        );
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget($args, $instance)
    {

        /* Local version if you need it */
        //  wp_enqueue_script('stackCommerce-lib',  STACKCOMMERCE__PLUGIN_URL . '/js/stackCommerceWidget.min.js', array(), null, true);


        wp_enqueue_script('stackCommerce-lib',  'https://widgets.stackcommerce.com/deal-feed/stackCommerceWidget-v2.min.js', array('jquery'), null, true);



        global $stackCommerceWidget_settings;
        $stackCommerce_general_settings = get_option('stackCommerceWidget_general_options');

        $defaults = array(
            'see_all_deals_text' => 'See all deals',
            'item_title_size' => "14",
            'sc_per_page' => "2",
            'hide_price' => "1",
            'hide_ribon' => "1",
            'column_count' => "3"
        );

        $instance = wp_parse_args($instance, $defaults);

        $title = apply_filters('title', $instance['title']);
        $widget_title = $instance['widget_title'];
        $per_page = $instance['sc_per_page'];
        $sort = $instance['sort'];
        $hide_ribon = $instance['hide_ribon'];
        $hide_button = $instance['hide_button'];
        $see_all_deals_text = $instance['see_all_deals_text'];
        $hide_all_deals_link = $instance['hide_all_deals_link'];
        $view_type = $instance['view_type'];
        $view_design = $instance['view_design'];
        $column_count = $instance['column_count'];
        $hide_price = $instance['hide_price'];
        $image_width = $instance['image_width'];
        $utm_medium_widget = $instance['utm_medium_widget'];
        $item_title_size = $instance['item_title_size'];


        $URL_source = $stackCommerce_general_settings['utm_source'];
        $URL_additional = $stackCommerce_general_settings['additional_url_params'];
        $URL_affiliate = $stackCommerce_general_settings['affiliateID'];
        $medium_item_name = $instance['medium_item_name'];

        $widgetClass = "stackCommerceSeeAllDeals";
        if ($hide_all_deals_link == 1) {
            $widgetClass .= " hideSCElement";
        }

        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];
        // This is where you run the code and display the output
        if (isset($stackCommerceWidget_settings['all_deals_text'])) {
            if ($stackCommerceWidget_settings['all_deals_text'] == "") {
                $stackCommerceWidget_settings['all_deals_text'] = "See all deals";
            }
        }


        if ($stackCommerce_general_settings['open_new_tab'] == "on") {
            $stackCommerceLinkTarget = "target='_blank'";
        } else {
            $stackCommerceLinkTarget = "";
        }
        /* 1 == vertical  */
        $widgetStyleType = "";
        if ($view_type == 1) {
            $widgetStyleType = "vertical" . $view_design;
            if ($view_design == 1) {
                $widgetStyleType .= " stackCommerceHeightFix";

            }
        } else if ($view_type == 2) {
            $widgetStyleType = "stackCommerceShortcode horizontal stackCommerceHeightFix ";
            $widgetStyleType .= " col" . $column_count;
        }



        ?>
        <div class="stackCommerceWidgetSidebar <?php echo $widgetStyleType; ?>"
             data-sc-hide-price="<?php echo $hide_price; ?>"
             data-sc-hide-ribon="<?php echo $hide_ribon; ?>"
             data-sc-hide-button="<?php echo $hide_button; ?>"
             data-sc-column-count="<?php echo $column_count; ?>"
             data-sc-view-design="<?php echo $view_design; ?>"
             data-sc-widget="<?php echo $view_type; ?>"
             data-sc-widget-title="<?php echo $widget_title; ?>"
             data-sc-image-width="<?php echo $image_width; ?>"
             data-sc-publisher-id="<?php echo $stackCommerce_general_settings['publisherID']; ?>"
             data-sc-sort="<?php echo $sort; ?>"
             data-sc-per-page="<?php echo $per_page; ?>"
             data-sc-header-color="#FF3131"
             data-sc-title-sizes="<?php echo $item_title_size; ?>"
             data-sc-open-new-tab="<?php echo $stackCommerce_general_settings['open_new_tab']; ?>"
             data-sc-utm="<?php echo $URL_source; ?>"
             data-sc-utm-medium="<?php echo $utm_medium_widget; ?>"
             data-sc-utm-additional="<?php echo $URL_additional; ?>"
             data-sc-affiliate-id="<?php echo $URL_affiliate; ?>"
             data-sc-medium-item-name="<?php echo $medium_item_name; ?>"
        >
        </div>
        <div class="allDealsLink <?php echo $widgetClass; ?>">
            <a <?php echo $stackCommerceLinkTarget; ?>
                href="#">
                <?php echo $see_all_deals_text; ?>
            </a>
        </div>
        <div class="stackCommerceHelper"></div>
        <?php
        echo $args['after_widget'];
    }

    // Widget Backend
    public function form($t)
    {
        $defaults = array(
            'see_all_deals_text' => 'See all deals',
            'item_title_size' => "14",
            'sc_per_page' => "2",
            'hide_price' => "1",
            'hide_ribon' => "1",
            'column_count' => "3"
        );

        // $t = wp_parse_args($instance, $defaults);
        $t = wp_parse_args($t, $defaults);

        $title = $t['title'];

        $sort = $t['sort'];


        $item_title_size = $t['item_title_size'];
        $per_page = $t['sc_per_page'];
        $widget_title = $t['widget_title'];
        $hide_ribon = $t['hide_ribon'];
        $hide_all_deals_link = $t['hide_all_deals_link'];
        $view_type = $t['view_type'];
        $view_design = $t['view_design'];
        $column_count = $t['column_count'];
        $hide_price = $t['hide_price'];
        $utm_medium_widget = $t['utm_medium_widget'];
        $medium_item_name = $t['medium_item_name'];
        $hide_button = $t['hide_button'];

        if (!isset($t['see_all_deals_text']) || $t['see_all_deals_text'] == "") {
            $see_all_deals_text = "See all deals";
        } else {
            $see_all_deals_text = $t['see_all_deals_text'];
        }

        if (!isset($t['image_width']) || $t['image_width'] == "") {
            $image_width = 50;
        } else {
            $image_width = $t['image_width'];
        }
        ?>

        <!-- Widget title -->
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>"/>
        <div class="widget-field-description">For no header, leave blank.</div>

        </p>
        <!-- Widget name -->
        <p>
            <label for="<?php echo $this->get_field_id('widget_title'); ?>"><?php _e('Widget name:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('widget_title'); ?>"
                   name="<?php echo $this->get_field_name('widget_title'); ?>" type="text"
                   value="<?php echo $widget_title; ?>"/>
        <div class="widget-field-description">Widget name will be used for UTM Content.</div>
        </p>

        <p>
            <!-- Items per page setting-->
            <label
                for="<?php echo $this->get_field_id('sc_per_page'); ?>"><?php _e('Items per page: '); ?>
            </label>
            <select
                class="widefat"
                id="<?php echo $this->get_field_name('sc_per_page'); ?>"
                name="<?php echo $this->get_field_name('sc_per_page'); ?>">
                <?php $selected = $per_page; ?>
                <?php for ($i = 0; $i <= 30; $i++): ?>
                    <option value="<?php echo $i; ?>" <?php selected($selected, $i); ?>>
                        <?php echo $i; ?>
                    </option>
                <?php endfor; ?>
            </select>
        </p>

        <!-- Sorting setting -->
        <p>
            <label
                for="<?php echo $this->get_field_id('sort'); ?>"><?php _e('Sorting: '); ?>
            </label>
            <select
                class="widefat"
                id="<?php echo $this->get_field_name('sort'); ?>"
                name="<?php echo $this->get_field_name('sort'); ?>">
                <?php $selected = $sort ?>
                <option value="best_sellers" <?php selected($selected, 'best_sellers'); ?>>
                    Best Sellers
                </option>
                <option value="newest" <?php selected($selected, 'newest'); ?>>
                    Newest
                </option>
                <option value="ending_soonest" <?php selected($selected, 'ending_soonest'); ?>>
                    Ending soonest
                </option>
            </select>
        </p>

        <!-- See all deal links Part -->
        <p class="hideLink">
            <input
                type="checkbox"
                name="<?php echo $this->get_field_name('hide_all_deals_link'); ?>"
                id="<?php echo $this->get_field_id('hide_all_deals_link'); ?>"
                value="1" <?php checked(1 == esc_attr($hide_all_deals_link)); ?> />
            <label
                for="<?php echo $this->get_field_id('hide_all_deals_link'); ?>"><?php _e('Hide see all deals link'); ?>
            </label>

        </p>

        <!-- See all deals link -->
        <p class="linkOption2 linkOption">
            <label
                for="<?php echo $this->get_field_id('see_all_deals_text'); ?>"><?php _e('See all deals link text:'); ?></label>
            <input class="widefat seeAllDealsLink seeAllDeals"
                   id="<?php echo $this->get_field_id('see_all_deals_text'); ?>"
                   name="<?php echo $this->get_field_name('see_all_deals_text'); ?>" type="text"
                   value="<?php echo esc_attr($see_all_deals_text); ?>"/>
        </p>


        <!-- Appearance settings -->

        <!-- View type-->
        <p class="viewType">
            <label
                for="<?php echo $this->get_field_id('view_type'); ?>"><?php _e('View type: '); ?>
            </label>
            <select
                class="widefat"
                id="<?php echo $this->get_field_name('view_type'); ?>"
                name="<?php echo $this->get_field_name('view_type'); ?>">
                <?php $selected = $view_type ?>
                <option value="1" <?php selected($selected, '1'); ?>>
                    Vertical
                </option>
                <option value="2" <?php selected($selected, '2'); ?>>
                    Horizontal
                </option>
            </select>
        </p>
        <!-- View design -->
        <p class="viewDesing hideHorizontal">
            <label
                for="<?php echo $this->get_field_id('view_design'); ?>"><?php _e('View design: '); ?>
            </label>
            <select
                class="widefat"
                id="<?php echo $this->get_field_name('view_design'); ?>"
                name="<?php echo $this->get_field_name('view_design'); ?>">
                <?php $selected = $view_design ?>
                <option value="1" <?php selected($selected, '1'); ?>>
                    List View Grid
                </option>
                <option value="2" <?php selected($selected, '2'); ?>>
                    List View Medium
                </option>
                <option value="3" <?php selected($selected, '3'); ?>>
                    List View Large
                </option>
            </select>
        </p>

        <!-- Hide discount ribon -->
        <p class="hideRibon hideView1 hideView2">
            <input
                type="checkbox"
                name="<?php echo $this->get_field_name('hide_ribon'); ?>"
                id="<?php echo $this->get_field_id('hide_ribon'); ?>"
                value="1" <?php checked(1 == esc_attr($hide_ribon)); ?> />
            <label
                for="<?php echo $this->get_field_id('hide_ribon'); ?>"><?php _e('Hide discount ribbon'); ?>
            </label>
        </p>

        <!-- Hide price ribon -->
        <p class="hidePrice hideView1 hideView2">
            <input
                type="checkbox"
                name="<?php echo $this->get_field_name('hide_price'); ?>"
                id="<?php echo $this->get_field_id('hide_price'); ?>"
                value="1" <?php checked(1 == esc_attr($hide_price)); ?> />
            <label for="<?php echo $this->get_field_id('hide_price'); ?>"><?php _e('Hide price'); ?>
            </label>
        </p>

        <!-- Hide buy now button -->
        <p class="hideButton hideView1 hideView2">
            <input
                type="checkbox"
                name="<?php echo $this->get_field_name('hide_button'); ?>"
                id="<?php echo $this->get_field_id('hide_button'); ?>"
                value="1" <?php checked(1 == esc_attr($hide_button)); ?> />
            <label
                for="<?php echo $this->get_field_id('hide_button'); ?>"><?php _e('Hide buy button'); ?>
            </label>
        </p>

        <!-- See all deals link -->
        <p class="imageWidth">
            <label
                for="<?php echo $this->get_field_id('image_width'); ?>"><?php _e('Image width:'); ?></label>

            <select
                class="widefat"
                id="<?php echo $this->get_field_name('image_width'); ?>"
                name="<?php echo $this->get_field_name('image_width'); ?>">
                <?php $selected = $image_width; ?>
                <?php for ($i = 0; $i <= 100; $i++): ?>
                    <option value="<?php echo $i; ?>" <?php selected($selected, $i); ?>>
                        <?php echo $i; ?>%
                    </option>
                <?php endfor; ?>
            </select>
        </p>

        <!-- Column count -->
        <p class="columnCount">
            <!-- Items per page setting-->
            <label
                for="<?php echo $this->get_field_id('column_count'); ?>"><?php _e('Column count: '); ?>
            </label>
            <select
                class="widefat"
                id="<?php echo $this->get_field_name('column_count'); ?>"
                name="<?php echo $this->get_field_name('column_count'); ?>">
                <?php $selected = $column_count; ?>
                <?php for ($i = 0; $i <= 12; $i++): ?>
                    <option value="<?php echo $i; ?>" <?php selected($selected, $i); ?>><?php echo $i; ?>
                    </option>
                <?php endfor; ?>
            </select>
        </p>

        <p class="titleSize">
            <!-- Items per page setting-->
            <label
                for="<?php echo $this->get_field_id('item_title_size'); ?>"><?php _e('Items title size: '); ?>
            </label>
            <select
                class="widefat"
                id="<?php echo $this->get_field_name('item_title_size'); ?>"
                name="<?php echo $this->get_field_name('item_title_size'); ?>">
                <?php $selected = $item_title_size; ?>
                <?php for ($i = 10; $i <= 51; $i++): ?>
                    <option value="<?php echo $i; ?>" <?php selected($selected, $i); ?>><?php echo $i; ?>px</option>
                <?php endfor; ?>
            </select>
        </p>

        <p class="mediumViewOptions">
            <!-- Items per page setting-->
            <label
                for="<?php echo $this->get_field_id('medium_item_name'); ?>"><?php _e('Display options: '); ?>
            </label>
            <select
                class="widefat"
                id="<?php echo $this->get_field_name('medium_item_name'); ?>"
                name="<?php echo $this->get_field_name('medium_item_name'); ?>">
                <?php $selected = $medium_item_name; ?>
                <option value="1" <?php selected($selected, 1); ?>>Show only product title</option>
                <option value="2" <?php selected($selected, 2); ?>>Show price</option>
                <option value="3" <?php selected($selected, 3); ?>>Show % discount</option>
            </select>
        </p>
        <?php
    }

    // Updating widget replacing old instances with new
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['widget_title'] = (!empty($new_instance['widget_title'])) ? strip_tags($new_instance['widget_title']) : '';
        $instance['sc_per_page'] = (!empty($new_instance['sc_per_page'])) ? strip_tags($new_instance['sc_per_page']) : '';
        $instance['sort'] = (!empty($new_instance['sort'])) ? strip_tags($new_instance['sort']) : '';
        $instance['hide_ribon'] = (!empty($new_instance['hide_ribon'])) ? strip_tags($new_instance['hide_ribon']) : '';
        $instance['see_all_deals_link'] = (!empty($new_instance['see_all_deals_link'])) ? strip_tags($new_instance['see_all_deals_link']) : '';
        $instance['see_all_deals_text'] = (!empty($new_instance['see_all_deals_text'])) ? strip_tags($new_instance['see_all_deals_text']) : '';
        $instance['hide_all_deals_link'] = (!empty($new_instance['hide_all_deals_link'])) ? strip_tags($new_instance['hide_all_deals_link']) : '';
        $instance['view_type'] = (!empty($new_instance['view_type'])) ? strip_tags($new_instance['view_type']) : '';
        $instance['view_design'] = (!empty($new_instance['view_design'])) ? strip_tags($new_instance['view_design']) : '';
        $instance['column_count'] = (!empty($new_instance['column_count'])) ? strip_tags($new_instance['column_count']) : '';
        $instance['hide_price'] = (!empty($new_instance['hide_price'])) ? strip_tags($new_instance['hide_price']) : '';
        $instance['image_width'] = (!empty($new_instance['image_width'])) ? strip_tags($new_instance['image_width']) : '';
        $instance['utm_medium_widget'] = (!empty($new_instance['utm_medium_widget'])) ? strip_tags($new_instance['utm_medium_widget']) : '';
        $instance['item_title_size'] = (!empty($new_instance['item_title_size'])) ? strip_tags($new_instance['item_title_size']) : '';
        $instance['medium_item_name'] = (!empty($new_instance['medium_item_name'])) ? strip_tags($new_instance['medium_item_name']) : '';
        $instance['hide_button'] = (!empty($new_instance['hide_button'])) ? strip_tags($new_instance['hide_button']) : '';
        return $instance;
    }
} // Class stackCommerceWidget ends here


// Register and load the widget
function stackCommerce_load_widget()
{
    register_widget('WP_Widget_stackCommerceWidget');
}

add_action('widgets_init', 'stackCommerce_load_widget');