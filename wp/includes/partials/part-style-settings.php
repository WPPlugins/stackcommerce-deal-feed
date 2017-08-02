<?php function stackCommerceStyleSettingsPage()
{
    global $stackCommerceWidget_settings;
    if($stackCommerceWidget_settings['button_color'] == NULL) {
        $stackCommerceWidget_settings['button_color'] = "#2db500";
    }

    if($stackCommerceWidget_settings['button_text_color'] == NULL) {
        $stackCommerceWidget_settings['button_text_color'] = "#ffffff";
    }

    if($stackCommerceWidget_settings['box_background'] == NULL) {
        $stackCommerceWidget_settings['box_background'] = "#f7f7f7";
    }

    if($stackCommerceWidget_settings['ribon_background'] == NULL) {
        $stackCommerceWidget_settings['ribon_background'] = "#ffd300";
    }
    ?>

    <h2>StackCommerce Deal Feed Styling Settings</h2>
    <?php if (isset($_GET['settings-updated'])) : ?>
        <div id="message" class="updated stackSocialMessage">
            <p><strong><?php _e('Settings saved.') ?></strong></p>
        </div>
    <?php endif; ?>
    <form method="post" action="options.php">
        <?php settings_fields('stackCommerceWidget_settings_group');
        do_settings_sections('stackCommerceWidget_settings_group');
        ?>
        <!-- TODO: add defaults and fallback options for styling -->
        <table class="form-table style-table">
            <tr valign="top">
                <th scope="row"><?php _e('Buy button color', 'sswp'); ?></th>
                <td class="button_color">
                    <!-- TODO: Add input sanitation -->
                    <input id="stackCommerceWidget_settings[button_color]"
                           name="stackCommerceWidget_settings[button_color]"
                           type="text"
                           data-default-color="#2db500"
                           class="stackCommerceColorPicker"
                           value="<?php echo $stackCommerceWidget_settings['button_color']; ?>"
                    />

                    <div class="fieldInformation">
                        <div class="tooltipInfo">
                            Add your description about the field
                        </div>
                    </div>
                </td>
            </tr>

            <tr valign="top" class="button_text_color">
                <th scope="row"><?php _e('Button text color', 'sswp'); ?></th>
                <td>
                    <!-- TODO: Add input sanitation -->
                    <input id="stackCommerceWidget_settings[button_text_color]"
                           name="stackCommerceWidget_settings[button_text_color]"
                           type="text"
                           data-default-color="#ffffff"

                           class="stackCommerceColorPicker"
                           value="<?php echo $stackCommerceWidget_settings['button_text_color']; ?>"
                    />

                    <div class="fieldInformation">
                        <div class="tooltipInfo">
                            Add your description about the field
                        </div>
                    </div>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('Deal box background', 'sswp'); ?></th>
                <td class="box_background">
                    <!-- TODO: Add input sanitation -->
                    <input id="stackCommerceWidget_settings[box_background]"
                           name="stackCommerceWidget_settings[box_background]"
                           type="text"
                           data-default-color="#f7f7f7"

                           class="stackCommerceColorPicker"
                           value="<?php echo $stackCommerceWidget_settings['box_background']; ?>"
                    />

                    <div class="fieldInformation">
                        <div class="tooltipInfo">
                            Add your description about the field
                        </div>
                    </div>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('Discount ribon background', 'sswp'); ?></th>
                <td class="ribon_background">
                    <!-- TODO: Add input sanitation -->
                    <input id="stackCommerceWidget_settings[ribon_background]"
                           name="stackCommerceWidget_settings[ribon_background]"
                           type="text"
                           data-default-color="#ffd300"

                           class="stackCommerceColorPicker"
                           value="<?php echo $stackCommerceWidget_settings['ribon_background']; ?>"
                    />

                    <div class="fieldInformation">
                        <div class="tooltipInfo">
                            Add your description about the field
                        </div>
                    </div>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('Discount ribon text color', 'sswp'); ?></th>
                <td class="ribon_text">
                    <!-- TODO: Add input sanitation -->
                    <input id="stackCommerceWidget_settings[ribon_text]"
                           name="stackCommerceWidget_settings[ribon_text]"
                           type="text"
                           class="stackCommerceColorPicker"
                           value="<?php echo $stackCommerceWidget_settings['ribon_text']; ?>"
                    />

                    <div class="fieldInformation">
                        <div class="tooltipInfo">
                            Add your description about the field
                        </div>
                    </div>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e('Custom css', 'sswp'); ?></th>
                <td class="custom_css_textarea">
                    <!-- TODO: Add input sanitation -->
            <textarea id="stackCommerceWidget_settings[custom_css]"
                      name="stackCommerceWidget_settings[custom_css]"
                      type="number"
                      placeholder="Enter custom css"
            >
                <?php echo $stackCommerceWidget_settings['custom_css']; ?>
            </textarea>
                    <div class="fieldInformation">
                        <div class="tooltipInfo">
                            Use this to override default widget CSS. This is an optional field.
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <div class="submit_stackCommerce_settings">
            <?php submit_button(); ?>
        </div>
    </form>

<?php } ?>