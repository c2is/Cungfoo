/*
 *  //////////////////////////////////////////////////////////////////////////////////////////////////////////
 *                                              DOM ready
 * ///////////////////////////////////////////////////////////////////////////////////////////////////////////
 */
$.fn.datepicker.dates = []
$.fn.datepicker.dates['fr'] = {
    days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
    daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
    daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"],
    months: ["Janvier", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
    monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    today: "Today"
};

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
        weekStart: 1
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

    //via http://ivaynberg.github.com/select2/#documentation
    //$("select[multiple='multiple']").select2({
    //    placeholder: "Select a State",
    //    allowClear: true,
    //});
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

