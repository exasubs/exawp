(function ($) {
    "use strict";
    $(document).ready(function ($) {
        $(document).on("click", ".upload_image_button", function (event) {
            event.preventDefault();
            var This = $(this);
            var inputText = $(this).prev();
            var frame;
            if (frame) {
                frame.open();
                return;
            }
            frame = wp.media({
                library: {type: 'image'},
                multiple: false
            });
            frame.on('select', function () {
                var attachment = frame.state().get('selection').first().toJSON();
                if (inputText != undefined && inputText != '') {
                    inputText.val(attachment.url);
                    This.parent().next('.back_img_div').empty().hide().append('<img src="' + attachment.url + '" alt="" style="max-width:250px;"/><br><a class="remove-image" title="' + js_strings.remove_image + '">' + js_strings.remove + '</a>');
                    This.parent().next('.back_img_div').show('slow');
                    $("a.remove-image").click(function () {
                        $(this).parent().prev().find('.custom_media_url').val('');
                        $(this).parent().empty();
                        $(this).hide('slow');
                        return false;
                    });
                }
            });
            frame.open();
        });
        $("a.remove-image").click(function (e) {
            e.preventDefault();
            $(this).parent().prev().find('.custom_media_url').val('');
            $(this).parent().empty();
            $(this).hide('slow');
        });
        $(document).on('widget-updated', function (e, widget) {
            $("a.remove-image").click(function (e) {
                e.preventDefault();
                $(this).parent().prev().find('.custom_media_url').val('');
                $(this).parent().empty();
                $(this).hide('slow');
            });
        });
    });
})(jQuery);