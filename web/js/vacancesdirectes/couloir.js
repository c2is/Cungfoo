/**-----------------------------------------------------------
 Project: VACANCES DIRECTES CE
 Date :  11/10/12
 Author: C2iS - NCH
 Summary : FRONT FUNCTIONS & INITS RESALYS
 -----------------------------------------------------------*/

/* variables */

// DOM Ready
$(function() {
    if(parentExists()){
        resize_myframe();
    }

    // selects
    if($('#newCustomerLayer').length){
        $('#newCustomerLayer').show().find('select').sSelect({ddMaxHeight: '300px'});
    }
    if($('#reservation').length){
        $('.changeOccupantCount').find('select').sSelect({ddMaxHeight: '300px'});
    }
    if($('#financialContener').length){
        $('#client_due_type').find('select').sSelect({ddMaxHeight: '300px'});
    }
    if($('#option').length){
        $('#option').find('select').sSelect({ddMaxHeight: '300px'});
    }
    if($('#paiement').length){
        $('#paiement').find('select').sSelect({ddMaxHeight: '300px'});
    }
    if($('#customerAreaContener').length){
        $('#customerAreaContener').find('select').sSelect({ddMaxHeight: '300px'});
    }

});

head.ready(function(){

    // positionne le bloc prix en 1er sur l'étape 1 du couloir
    if($('#yourStay').length){
        if($('.error').length){
            $('.error').after($('#yourStay'));
        }
        else {
            $('#reservation').prepend($('#yourStay'));
        }
    }

        // radio buttons
        var checked;
        if($('#authentication').length){
            $('.authenticationChoice').click(function(e){
                resize_myframe();
            });
            if(checked != undefined){
                $('#returningCustomerYes').trigger("click");
            }
            else{
                if($('#returningCustomerYes').is(':checked')) {
                    checked = true
                    $('#existingCustomerLayer').show();
                    $('#newCustomerLayer').hide();
                }
                else if($('#returningCustomerNo').is(':checked')) {
                    checked = false;
                    $('#existingCustomerLayer').hide();
                    $('#newCustomerLayer').show();
                }
            }
        }

        // selects
        $('.selectedTxt').click(function(){

            if ( !$(this).parent().hasClass('newListSelFocus') ){
                var selectWidth = $(this).parent().width();
                $(this).next('.SSContainerDivWrapper').show();
                var selectUlWidth = $(this).next('.SSContainerDivWrapper').width();
                  //console.log(selectWidth);
                  //console.log(selectUlWidth);
                  //console.log( $(this).next('.SSContainerDivWrapper').hasClass('maxHeight') );
                  //console.log( !$(this).next('.SSContainerDivWrapper').hasClass('minWidth') );
                  //console.log( selectUlWidth >= selectWidth );
                if ( $(this).next('.SSContainerDivWrapper').hasClass('maxHeight') && !$(this).next('.SSContainerDivWrapper').hasClass('minWidth') && selectUlWidth >= selectWidth ){

                    $(this).next('.SSContainerDivWrapper').css({
                        minWidth: selectUlWidth + 33
                    });
                    $(this).next('.SSContainerDivWrapper').addClass('minWidth')
                }
                else if ( $(this).next('.SSContainerDivWrapper').hasClass('minWidth') ){
                    return false;
                }
            }

        });

    if($('#contentContener.detail').length){
        // datepickers
        var d = new Date();
        var y = d.getFullYear();
        var onBlurAction;

//        $('.occupantHeader[style*="adult"]').parent('.anOccupant').addClass('adult');
//        $('.occupantHeader[style*="child"]').parent('.anOccupant').addClass('child');
        $(".anOccupant").find('.control_date').attr('readonly','readonly')
            .on('focus',function(e){
                $(this).attr('onblur','');
                $(this).datepicker( "option", "disabled" );
                //console.log($(this).attr('onblur'));
            });

        $(".anOccupant").each(function(index,value){
            var datepickerInput = $(this).find('.control_date');
            onBlurAction = datepickerInput.attr('onblur');

            function beforeShow(){
                //console.log("CLICK");
                //console.log(datepickerInput.attr('onblur'));
                onBlurAction = onBlurAction.replace(';;',';').replace('if( !checkFutureDate( this ) ) return false; ','');
                if(onBlurAction.substring(0, 1) == ';'){
                    onBlurAction = onBlurAction.substring(1, onBlurAction.length - 1);
                }
            }
            function onSelect(){
                //console.log("SELECT");
                //console.log(this);
                datepickerInput.attr('onblur',onBlurAction);
                //console.log(this);
                eval(onBlurAction);
            }

            if ($(this).hasClass('adult')){
                datepickerInput.datepicker({
                    changeMonth: true,
                    changeYear: true,
                    yearRange: "1900:+0",
                    defaultDate: datepickerInput.val(),
                    maxDate: "-13y",
                    showOn: "both",
                    beforeShow: beforeShow,
                    onSelect: onSelect
                    });
                var defaultDate = datepickerInput.datepicker( "option", "defaultDate" );
                var maxDate = datepickerInput.datepicker( "option", "maxDate" );
                //console.log(defaultDate);
                //console.log(maxDate);
            }
            else if ($(this).hasClass('child')){
                datepickerInput.datepicker({
                    changeMonth: true,
                    changeYear: true,
                    yearRange: "-13:+0",
                    defaultDate: datepickerInput.val(),
                    minDate: "-13y +1d",
                    maxDate: "Y",
                    showOn: "both",
                    beforeShow: beforeShow,
                    onSelect: onSelect
                });
            }
            else {
                datepickerInput.datepicker({
                    changeMonth: true,
                    changeYear: true,
                    yearRange: "1900:+0",
                    maxDate: "y",
                    showOn: "both",
                    beforeShow: beforeShow,
                    onSelect: onSelect
                });
            }


        });


    }

    if ($('#contentContener.summary').length || $('#contentContener.editAccount').length){
        // datepickers
        var d = new Date();
        var y = d.getFullYear();

        $('#address').find('.control_date').datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "1900:2000",
            defaultDate: new Date(y-18, 1 - 1, 1),
            maxDate: "-18Y",
            showOn: "button"
        });
    }

    if($('#newCustomerLayer').length){
        $('#customerLogin input').keypress(function(e) {
            if(e.which == 32) {
                e.preventDefault();
            }
        }).blur(function(e) {
            $(this).val($(this).val().replace(/ /g,''));
        });
    }

    if($('#existingCustomerLayer').length){
        $('#existing_customer_login').keypress(function(e) {
            if(e.which == 32) {
                e.preventDefault();
            }
        }).blur(function(e) {
                $(this).val($(this).val().replace(/ /g,''));
            });
    }

});

// Gestion du console.log (évite le bug sur ie si la console n'est pas ouverte)
function consoleLog (data) {
    if(window.console && console.log )
        console.log(data);
}

function parentExists() {
    return (parent.location == window.location)? false : true;
}

function resize_myframe() {
    //var height = $('html').height();
    var height = $('body').height();
    height += 70;
    window.parent.document.getElementById('frameResalys').style.height = height + 'px';
    //console.log(height);
}
