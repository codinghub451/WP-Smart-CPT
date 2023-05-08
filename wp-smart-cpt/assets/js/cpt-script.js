jQuery(document).ready(function ($) {

    /* Create CPT through AJAX */

    $("#create-cpt").on('click', function (e) {
        // if (e.which == 13) {
        e.preventDefault();
        var cpt_name = $("#cpt-name").val();
        var singular_name = cpt_name.slice(0, -1);
        var selectedIcon = $("#selected-dashicon span").attr('class').split(' ')[1];
        var cpt_regirter_name = cpt_name.toLowerCase().replace(" ", "-");
        console.log(cpt_name);
        console.log(cpt_regirter_name);
        console.log(selectedIcon);
        jQuery.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'create_smart_cpt',
                cpt_name: cpt_name,
                singular_name: singular_name,
                cpt_regirter_name: cpt_regirter_name,
                cpt_icon: selectedIcon,
            },
            success: function (response) {
                /* Handling response from server */

                if (response) {
                    console.log(response);
                    // location.reload();
                }
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        });
        // }
    });

    jQuery('#dashicons-select').on('change', function () {
        var icon = jQuery(this).val();
        jQuery('#selected-dashicon p').html('<span class="dashicons ' + icon + '"></span>');
    });

    // CPT details tab

    // Show the first tab and hide the rest
    $('#tabs-nav li:first-child').addClass('active');
    $('.tab-content').hide();
    $('.tab-content:first').show();

    // Click function
    $('#tabs-nav li').click(function () {
        $('#tabs-nav li').removeClass('active');
        $(this).addClass('active');
        $('.tab-content').hide();

        var activeTab = $(this).find('a').attr('href');
        $(activeTab).fadeIn();
        return false;
    });

    // Delete Cpt

    var data = {
        'action': 'display_custom_post_types'
    };
    $.post(ajaxurl, data, function (response) {
        $('#custom-post-types-list').html(response);
    });

    $(document).on('click', '.delete-cpt', function (e) {
        e.preventDefault();
        var cpt_name = $(this).data('cpt');
        var data = {
            'action': 'delete_custom_post_type',
            'cpt_name': cpt_name,
        };
        $.post(ajaxurl, data, function (response) {
            if (response.success) {
                console.log(response.data);
                location.reload();
            } else {
                console.log(response.data);
            }
        });
    });

});
