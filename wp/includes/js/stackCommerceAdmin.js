(function ($) {
    $(document).ready(function () {
        $('.stackCommerceColorPicker').wpColorPicker();

        $(document).ajaxComplete(function () {
            $('.stackCommerceColorPicker').wpColorPicker();
            stackCommerceValidateWidgetSettingsInitial();
            stackCommerceValidateWidgetSettings();
        });


        stackCommerceValidateWidgetSettings();
        stackCommerceValidateWidgetSettingsInitial();

        function stackCommerceValidateWidgetSettings() {


            $('.viewType select').each(function () {
                /* If is horizontal view */
                if ($(this).val() == 2) {
                    $(this).parent().parent().children('.viewDesing').hide();
                    $(this).parent().parent().children('.columnCount').show();
                    $(this).parent().parent().children('.imageWidth').hide();
                    $(this).parent().parent().children('.mediumViewOptions').hide();
                    $(this).parent().parent().children('.hideRibon').show();
                    $(this).parent().parent().children('.hidePrice').show();
                    $(this).parent().parent().children('.hideButton').show();

                }
                /* If vertical view */
                else {
                    $(this).parent().parent().children('.columnCount').hide();
                    $(this).parent().parent().children('.viewDesing').show();
                    $(this).parent().parent().children('.imageWidth').show();
                    $(this).parent().parent().children('.mediumViewOptions').show();
                    var widgetViewDesign = $(this).parent().parent().children('.viewDesing').children("select").val();
                    /* List view grid */
                    if (widgetViewDesign == 1) {
                        $(this).parent().parent().children('.hideRibon').hide();
                        $(this).parent().parent().children('.hidePrice').hide();
                        $(this).parent().parent().children('.hideButton').hide();

                        $(this).parent().parent().children('.imageWidth').hide();
                        $(this).parent().parent().children('.mediumViewOptions').show();
                    }
                    /* List view medium */
                    else if (widgetViewDesign == 2) {
                        $(this).parent().parent().children('.hideRibon').hide();
                        $(this).parent().parent().children('.hidePrice').hide();
                        $(this).parent().parent().children('.hideButton').hide();

                        $(this).parent().parent().children('.imageWidth').show();
                        $(this).parent().parent().children('.imageWidth select').val("50");

                        $(this).parent().parent().children('.mediumViewOptions').show();

                    }
                    /* List view large */
                    else {
                        $(this).parent().parent().children('.hideRibon').show();
                        $(this).parent().parent().children('.hidePrice').show();
                        $(this).parent().parent().children('.hideButton').show();
                        $(this).parent().parent().children('.imageWidth').hide();
                        $(this).parent().parent().children('.mediumViewOptions').hide();
                    }

                }

                if ($(this).val() == 2) {
                    $(this).parent().parent().children('.imageWidth').hide();
                    $(this).parent().parent().children('.mediumViewOptions').hide();
                }
            });


            $(".hideLink input").each(function () {
                if ($(this).is(':checked')) {
                    $(this).parent().parent().children('.linkOption').hide();
                } else {
                    $(this).parent().parent().children('.linkOption').show();
                }
            });
        }

        function stackCommerceValidateWidgetSettingsInitial() {

            $('.viewDesing select').change(function () {
                stackCommerceValidateWidgetSettings();
            });

            $('.viewType select').change(function () {
                stackCommerceValidateWidgetSettings();
            });

            $(".hideLink input").change(function () {
                stackCommerceValidateWidgetSettings();
            });
        }
    });

})(jQuery);