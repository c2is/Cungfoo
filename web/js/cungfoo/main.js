/*
 *  //////////////////////////////////////////////////////////////////////////////////////////////////////////
 *                                              DOM ready
 * ///////////////////////////////////////////////////////////////////////////////////////////////////////////
 */

$(function() {

    $("input[id$='_zip'], input[id$='_zipcode'], input[id$='_capacite'], input[id$='_priority'], input[id$='_age']").addClass('span1');
    $("input[id$='_code'], input[id$='_category'], input[id$='_tel'], input[id$='_phone'], input[id$='_phone1'], input[id$='_phone2'], input[id$='_fax']").addClass('span2');
    $("input[id$='_mail'], input[id$='_email'], input[id$='_website'], input[id$='_city']").addClass('span4');
    $("input[id$='_address'], input[id$='_address1'], input[id$='_address2'], input[id$='_name'], input[id$='_str_date'], input[id$='_subtitle'], input[id$='_slug']").addClass('span6');
    $("input[id$='_image'], input[id$='_description'], input[id$='_keywords'], input[id$='introduction']").addClass('span9');
    $(".widget-datepicker > input").css({
        width:"178px"
    });

    $('.widget-datepicker').datepicker({
        language:'fr'
    });

    $('#crudGroup a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    $('#crudGroup a:first').tab('show');

    if($('#crudGroupContent .alert-error').length > 0){
        var paneId = $('#crudGroupContent .alert-error:first').parents('.tab-pane').attr('id');
        $('#crudGroup a[href="#' + paneId + '"]').tab('show');
    }
    if($('.tab-content .alert-error').length > 0 && $('.tab-content').parent('.tabbable').length){
        var localizedPaneId = $('.tab-content').hasParent('.tabbable').find('.alert-error:first').parents('.tab-pane').attr('id');
        $('.tabbable .nav-tabs a[href="#' + localizedPaneId + '"]').tab('show');
    }

    $('#transGroup .nav-tabs a[href="#' + locale + '"]').tab('show');

    $("select[readonly=readonly] option").not(":selected").attr("disabled", "disabled");

    $("[rel='tooltip']").tooltip({placement: 'right', html: true});

    // gestion edition au double click
    $('#list .line').bind('dblclick', function () {
        window.location.href = $('.edit', this).attr('href');
    });

    // gestion active/desactive depuis la liste du crud
    $('#list .active').bind('click', function() {
        var $this = $(this);

        $.get($this.attr('href'), function(data) {
            var $icon = $('i', $this).removeClass();
            var $line = $this.parent('td').parent('tr');

            if (data.active) {
                $icon.addClass('icon-eye-open');
                $line.removeClass('disabled');
            }
            else {
                $icon.addClass('icon-eye-close');
                $line.addClass('disabled');
            }
        });

        return false;
    });

    // suppression d'un éléments depuis la liste
    $('.actions-item .delete').confirmModal();
});

// Extend jQuery.fn with our new method
jQuery.extend( jQuery.fn, {
    // Name of our method & one argument (the parent selector)
    hasParent: function(p) {
        // Returns a subset of items using jQuery.filter
        return this.filter(function(){
            // Return truthy/falsey based on presence in parent
            return $(p).find(this).length;
        });
    }
});
