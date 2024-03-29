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

    if ( $('form').length ){
        function hideError(){
            $('.errors > p.errorMessage').fadeOut(500, function(){
                $(this).remove();
            });
        }
        $('form input, form select, form .selectedTxt, form textarea').on('click', function(){
            hideError();
        });
        $('form input').on('keyup', function(){
            hideError();
        });
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

    // [TODO] A activer => LGU : script pour lancement popin out-of-session
    if ($('#pageContener').length) {
//        setTimeout( 'parent.$.colorbox({href:"#fiveMinutes", top:"10%", overlayClose: false, escKey: false, className: "fiveM", inline:true, width:500});',1000/**60*5*/);
        setTimeout( "$('#refresh_layer', window.parent.document).show()",1000*60*10);
    }

    if ( $('#footerContener').length ){
        $('#footerContener').find('#BackLink').click( function(){
            history.go(-1);
        });
    }
});

head.ready(function(){

    // positionne le bloc prix en 1er sur l'étape 1 du couloir
    if($('#yourStay').length  && $('#contentContener').hasClass('detail') ){
        //$('#reservationContener form').prepend($('#yourStay'));
        $('#promoContener').before($('#stayOptions'));
    }


    if($('#reservation').length){

        // convertit les <span> des checkbox en <label> pour rendre le texte cliquable
        if($('#stayOptions').find('.control_checkbox').length){
            enableClickOnLabel($('#stayOptions').find('.control_checkbox'));
        }
        if($('#accomodationOptions').find('.control_checkbox').length){
            enableClickOnLabel($('#accomodationOptions').find('.control_checkbox'));
        }

        // égalise la hauteur des choix de paiement de l'étape 1 du couloir
        if ( $('#financialContener .radioDesc').length > 1 ){
			setTimeout("$('#financialContener .radioDesc').equalizeHeights();", 10);
        }

    }

    /*if($('#greyBoxes').length){
        $('#greyBoxes').waypoint('sticky');
    }*/



    // radio buttons
    var checked;
    if($('#authentication').length){

        if(checked != undefined){
            $('#returningCustomerYes').click();
        }
        else{
            toggleAccountType();
        }

        $('.authenticationChoice').click(function(e){
            toggleAccountType();
        });

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

$('.goto').click(function(e) {
    e.preventDefault();
    scrollToHash(this.hash);
    return false;
});

var iCurrentScrollTop = 0;
var iScrollSpeed = 1000;
function scrollToHash(sHash, fCallback){
    //console.log("##################### scrollToHash(hash,f) #####################");
    var oAnchor = $(sHash);
    var targetOffset = $(oAnchor).offset().top + $('#frameResalys', window.parent.document).offset().top;
    var bodyelem = $('html,body', window.parent.document);
    var scrolled = false;
    iScrollSpeed = Math.abs(iCurrentScrollTop - targetOffset);
    if ( iScrollSpeed > 1000) { iScrollSpeed = 1000; }
    bodyelem.animate({scrollTop: targetOffset-20},iScrollSpeed,function(){
        if ( !scrolled && $.isFunction(fCallback) ){ // to correct the double callback of the scrollToHash function (scroll on html AND body)
            //console.log("------ scrollToTop() CALLBACK ------");
            scrolled = true;
            fCallback();
        }
        else {
            scrolled = false;
        }
    });
}

function toggleAccountType(){
    if($('#returningCustomerYes').is(':checked')) {
        checked = true;
        $('#existingCustomerLayer').show();
        $('#newCustomerLayer').hide();
    }
    else if($('#returningCustomerNo').is(':checked')) {
        checked = false;
        $('#existingCustomerLayer').hide();
        $('#newCustomerLayer').show();
    }
    resize_myframe();
}

$.fn.showError = function(sMessage) {
    //console.log(this);
    //console.log(sMessage);
    if ( !this.parent().hasClass('errors') ) {
        this.wrap('<div class="errors">');
    }
    this.after('<p class="errorMessage">'+sMessage+'</p>');
};

$.fn.equalizeHeights = function() {

    var maxHeight = this.map(function(i,e) {
        return $(e).height();
    }).get();

    return this.height( Math.max.apply(this, maxHeight) );
};

function resize_myframe() {
    var hFrame = $('body').height();
    //console.log(hFrame);
    hFrame += 70;
    $('#frameResalys', window.parent.document).css({height:hFrame+'px'});
//    window.parent.document.getElementById('frameResalys').style.height = height + 'px';
    //console.log(height);
}

function enableClickOnLabel(checkboxes){
    checkboxes.each(function(i,v){
        if ( $(this).parent().next().hasClass('optionLabel') ){
            var checkbox = $(this);
            var labelCheckbox =checkbox.parent().next();
            labelCheckbox.wrapInner('<label />');
            labelCheckbox = labelCheckbox.children('label');
            var forId;
            if (checkbox.attr('id') == undefined){
                if(checkbox.parents('#stayOptions').length){
                    forId = 'stayOption'+i;
                }
                else if(checkbox.parents('#accomodationOptions').length){
                    forId = 'accomodationOption'+i;
                }
            }
            else{
                forId = checkbox.attr('id');
            }
            checkbox.attr('id',forId);
            labelCheckbox.attr('for',forId)
        }
    });
}
