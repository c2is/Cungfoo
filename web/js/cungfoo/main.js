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
    $("input[id$='_image'], input[id$='_description'], input[id$='_keywords']").addClass('span9');
});

