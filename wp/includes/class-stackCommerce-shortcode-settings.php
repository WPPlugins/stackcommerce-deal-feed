<?php
function stackCommerceShortcodeSettingsPage()
{
    global $stackCommerceWidget_settings;
    ?>

    <form action="options.php" method="post">
        <?php
        settings_fields('stackCommere_shortcode_options');            // Retrieve the fields created for plugin options
        do_settings_sections('stackCommerce_shortcode_page');                // Display the section(s) for the options page
        submit_button();                                    // Form submit button generated by WordPress
        ?>
    </form>
<?php }

function stackCommerce_shortcode_callback()
{
    if (isset($_GET['settings-updated'])) {
        echo '<div id="message" class="updated stackSocialMessage">';
        echo '<p><strong>Settings saved</strong></p></div>';
    }

    echo '<p class="shortcodeInstructions">The shortcode below can be used to put the deal widget directly into one of your posts. The widget can be at the beginning of the post, end of the post, or anywhere in the middle. You can pick the number of columns in the widget as well as the number of deals (which will determine the number of rows). You can choose to show best sellers, newest deals, or ending deals. All these settings can be controlled by modifying this shortcode directly:
</p>
<p>
[stackCommerce layout="2" count="5" sort="best_sellers"][/stackCommerce]
</p>
<p> Below, you will find settings for a header as well as text size.</p>';
}


function stackCommerce_shortcodeSection_callback()
{
    $stackCommerce_shortcode_options = get_option('stackCommerce_shortcode'); // Retrieve plugin options from the database

    echo '<input id="stackCommerceShortCodeTitle" name="stackCommerce_shortcode[shortcodeTitle]" placeholder="Top Deals" type="text" value="' . $stackCommerce_shortcode_options['shortcodeTitle'] . '">'; // Print the input field to the screen
}


function stackCommerce_shortcode_validate($input)
{
    $stackCommerce_shortcode_options = get_option('stackCommerce_shortcode'); // Retrieve existing options values from the database
    if ($input['shortcode_text_size'] == NULL || $input['shortcode_text_size'] == "") {
        $input['shortcode_text_size'] = "33";
    }
    if ($input['shortcode_product_text_size'] == NULL || $input['shortcode_product_text_size'] == "") {
        $input['shortcode_product_text_size'] = "15";
    }


    /* Directly set values that don't require validation */
    $stackCommerce_shortcode_options['shortcodeTitle'] = $input['shortcodeTitle'];
    $stackCommerce_shortcode_options['shortcode_text_size'] = $input['shortcode_text_size'];
    $stackCommerce_shortcode_options['shortcode_product_text_size'] = $input['shortcode_product_text_size'];
    $stackCommerce_shortcode_options['shortcode_hide_discount'] = $input['shortcode_hide_discount'];
    $stackCommerce_shortcode_options['shortcode_hide_price'] = $input['shortcode_hide_price'];
    $stackCommerce_shortcode_options['shortcode_hide_button'] = $input['shortcode_hide_button'];

    return $stackCommerce_shortcode_options; // Send values to database
}


function stackCommerce_shortcode_section_text_size_callback()
{
    $stackCommerce_shortcode_options = get_option('stackCommerce_shortcode'); // Retrieve plugin options from the database
    if ($stackCommerce_shortcode_options['shortcode_text_size'] == NULL || $stackCommerce_shortcode_options['shortcode_text_size'] == "") {
        $stackCommerce_shortcode_options['shortcode_text_size'] = 28;
    }

    // Print the input field to the screen
    echo '<input id="stackCommerceShortCodeTitle" name="stackCommerce_shortcode[shortcode_text_size]" type="text" value="' . $stackCommerce_shortcode_options['shortcode_text_size'] . '">
            <div class="settings-field-description">For no section title, leave blank.</div>';
}

function stackCommerce_shortcode_section_product_text_size_callback()
{
    $stackCommerce_shortcode_options = get_option('stackCommerce_shortcode'); // Retrieve plugin options from the database
    if ($stackCommerce_shortcode_options['shortcode_product_text_size'] == NULL || $stackCommerce_shortcode_options['shortcode_product_text_size'] == "") {
        $stackCommerce_shortcode_options['shortcode_product_text_size'] = 14;
    }
    echo '<input id="stackCommerceShortCodeTitle" name="stackCommerce_shortcode[shortcode_product_text_size]" type="text" value="' . $stackCommerce_shortcode_options['shortcode_product_text_size'] . '">'; // Print the input field to the screen
}

function stackCommerce_shortcode_section_hide_price_callback()
{

    $stackCommerce_shortcode_options = get_option('stackCommerce_shortcode'); // Retrieve plugin options from the database
    if ($stackCommerce_shortcode_options['shortcode_hide_price'] == NULL) {
        $stackCommerce_shortcode_options['shortcode_hide_price'] = 1;
    }
    /* Determine whether the box should be checked based on setting in database */
    if ($stackCommerce_shortcode_options['shortcode_hide_price'] == 1) {
        $checked = 'checked';
    } else {
        $checked = '';
    }

    echo '<input type="hidden" name="stackCommerce_shortcode[shortcode_hide_price]" value="0" />';
    echo '<input id="hidePrice" name="stackCommerce_shortcode[shortcode_hide_price]" value="1" type="checkbox" ' . $checked . '>'; // Print the input field to the screen
}

function stackCommerce_shortcode_section_hide_discount_callback()
{
    $stackCommerce_shortcode_options = get_option('stackCommerce_shortcode'); // Retrieve plugin options from the database
    if ($stackCommerce_shortcode_options['shortcode_hide_discount'] == NULL) {
        $stackCommerce_shortcode_options['shortcode_hide_discount'] = 1;
    }
    /* Determine whether the box should be checked based on setting in database */
    if ($stackCommerce_shortcode_options['shortcode_hide_discount'] == 1) {
        $checked = 'checked';
    } else {
        $checked = '';
    }

    echo '<input type="hidden" name="stackCommerce_shortcode[shortcode_hide_discount]" value="0" />';
    echo '<input id="hideDiscount" name="stackCommerce_shortcode[shortcode_hide_discount]" value="1" type="checkbox" ' . $checked . '>'; // Print the input field to the screen
}

function stackCommerce_shortcode_section_hide_button_callback()
{
    $stackCommerce_shortcode_options = get_option('stackCommerce_shortcode'); // Retrieve plugin options from the database
    if ($stackCommerce_shortcode_options['shortcode_hide_button'] == NULL) {
        $stackCommerce_shortcode_options['shortcode_hide_button'] = 0;
    }
    /* Determine whether the box should be checked based on setting in database */
    if ($stackCommerce_shortcode_options['shortcode_hide_button'] == 1) {
        $checked = 'checked';
    } else {
        $checked = '';
    }

    echo '<input id="hideButton" name="stackCommerce_shortcode[shortcode_hide_button]" value="1" type="checkbox" ' . $checked . '>'; // Print the input field to the screen
}