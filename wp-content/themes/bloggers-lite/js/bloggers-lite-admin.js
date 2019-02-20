(function ($) {
    "use strict";
    $(function () {
        $(document).ready(function () {
            if ($('#customize-control-blog_page_design select').val() == 'blog_designer_lite') {
                $('li#customize-control-blog_page_content_from').hide();
                $('li#customize-control-blog_content_length').hide();
                $('li#customize-control-blog_content_read_more_text').hide();
                $('li#customize-control-enable_categories_blog').hide();
                $('li#customize-control-enable_date_blog').hide();
                $('li#customize-control-enable_tags_blog').hide();
                $('li#customize-control-enable_author_blog').hide();
                $('li#customize-control-enable_comments_blog').hide();
            } else {
                $('li#customize-control-blog_page_content_from').show();
                $('li#customize-control-blog_content_length').show();
                $('li#customize-control-blog_content_read_more_text').show();
                $('li#customize-control-enable_categories_blog').show();
                $('li#customize-control-enable_date_blog').show();
                $('li#customize-control-enable_tags_blog').show();
                $('li#customize-control-enable_author_blog').show();
            }
            $('#customize-control-blog_page_design select').change(function () {
                if ($(this).val() == 'blog_designer_lite') {
                    $('li#customize-control-blog_page_content_from').hide();
                    $('li#customize-control-blog_content_length').hide();
                    $('li#customize-control-blog_content_read_more_text').hide();
                    $('li#customize-control-enable_categories_blog').hide();
                    $('li#customize-control-enable_date_blog').hide();
                    $('li#customize-control-enable_tags_blog').hide();
                    $('li#customize-control-enable_author_blog').hide();
                    $('li#customize-control-enable_comments_blog').hide();
                } else {
                    $('li#customize-control-blog_page_content_from').show();
                    $('li#customize-control-blog_content_length').show();
                    $('li#customize-control-blog_content_read_more_text').show();
                    $('li#customize-control-enable_categories_blog').show();
                    $('li#customize-control-enable_date_blog').show();
                    $('li#customize-control-enable_tags_blog').show();
                    $('li#customize-control-enable_author_blog').show();
                }
            });
            if ($('#customize-control-blog_page_content_from select').val() == 'from_excerpt') {
                $('li#customize-control-blog_content_length').hide();
                $('li#customize-control-blog_content_read_more_text').hide();
            } else {
                $('#customize-control-blog_content_length').show();
                $('#customize-control-blog_content_read_more_text').show();
            }
            $('#customize-control-blog_page_content_from select').change(function () {
                if ($(this).val() == 'from_excerpt') {
                    $('li#customize-control-blog_content_length').hide();
                    $('li#customize-control-blog_content_read_more_text').hide();
                } else {
                    $('#customize-control-blog_content_length').show();
                    $('#customize-control-blog_content_read_more_text').show();
                }
            });
            $('#customize-control-blog_content_length input[type="text"]').keypress(function (evt) {
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                {
                    return false;
                } else
                {
                    return true;
                }
            });
            /* Licence Page Version and Update history. */
            $('.sol-theme-info-block .sol-theme-info-heading').click(function () {
                if ($(this).parent('div.sol-theme-info-block').hasClass('closed')) {
                    $(this).parent('div.sol-theme-info-block').removeClass('closed');
                } else {
                    $(this).parent('div.sol-theme-info-block').addClass('closed');
                }
            });
        });
    });
})(jQuery)