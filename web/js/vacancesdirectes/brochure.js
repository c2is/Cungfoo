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
});

head.ready(function(){

    // selects
    if( $('#authentication').length ){
        $('#authentication').find('select').each(function(i,v){
            if ($(this).attr('multiple') == "multiple"){
                $(this).sMultSelect({msgNull: 'Pas de réponse'});
            }
            else{
                if( $(this).is(':disabled') ){
                    $(this).removeAttr('disabled');
                    $(this).sSelect({ddMaxHeight: '300px'});
                    $(this).next('.newListSelected').addClass('newListDisabled').children('.SSContainerDivWrapper').empty();
                }
                else{
                    $(this).sSelect({ddMaxHeight: '300px'});
                }
            }
        });
    }
    if( $('#reservation').length ){
        $('.changeOccupantCount').find('select').sSelect({ddMaxHeight: '300px'});
    }
    if( $('#edit_occupant').length ){
        $('#address').find('select').sSelect({ddMaxHeight: '300px'});
    }

    function getSelected(s){
        if ( s.hasAttribute('selected') ){
            s.children('option').attr('selected','selected');
            s.sSelect({ddMaxHeight: '300px'});
            var selectedOption = $(this).getSetSSValue();
            $(this).getSetSSValue(selectedOption);
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

    // refresh iframe height after .action_buttons click (tab "RESERVATION" of Customer Area)
    $('.action_buttons a').click(function(e){
        var frameHeight = $('html').height();
        var waitFrameData = setInterval(resize_myframe_callback, 50);
        function resize_myframe_callback() {
            var newFrameHeight = $('html').height();
            if ( newFrameHeight != frameHeight ){
                resize_myframe();
                clearInterval(waitFrameData);
            }
        }
//        setTimeout(clearInterval(waitFrameData), 5000);
    });


    // selects
    $('.selectedTxt').click(function(){

        if ( !$(this).parent().hasClass('newListSelFocus') ){
            var selectWidth = $(this).parent().width();
            $(this).next('.SSContainerDivWrapper').show();
            var selectUlWidth = $(this).next('.SSContainerDivWrapper').width();
//                console.log(selectWidth);
//                console.log(selectUlWidth);
//                console.log( $(this).next('.SSContainerDivWrapper').hasClass('maxHeight') );
//                console.log( !$(this).next('.SSContainerDivWrapper').hasClass('minWidth') );
//                console.log( selectUlWidth >= selectWidth );
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


    if($('#contentContener.address').length || $('#contentContener.editOccupant').length){
        // datepickers
        var d = new Date();
        var y = d.getFullYear();
        $("#address").find('.control_date').each(function(index,value){
            var onChangeAction = $(this).attr('onchange');
            onChangeAction = onChangeAction.replace(';;',';');
            if(onChangeAction.substring(0, 1) == ';'){
                onChangeAction = onChangeAction.substring(1, onChangeAction.length - 1);
            }
            function onChange(){
                //console.log(this.value);
                eval(onChangeAction);
            }
            function hideSelects(){
                $('.SSContainerDivWrapper').hide();
            }

//            console.log(onBlurAction);
            $(this).removeAttr('onchange');
            $(this).datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: "1900:2000",
                defaultDate: new Date(y-18, 1 - 1, 1),
                maxDate: "-18Y",
                showOn: "button",
                beforeShow: hideSelects,
                onSelect: onChange
            });
        });

    }
        if($('#contentContener.editReservation').length){

        // datepickers
        var d = new Date();
        var y = d.getFullYear();

        $(".anOccupant").find('.control_date').each(function(index,value){
//            var onChangeAction = $(this).attr('onchange');
//            onChangeAction = onChangeAction.replace(';;',';').replace("if(!checkAndUpdateDateField( this, 'DD/MM/YYYY' )) return false","");
//            if(onChangeAction.substring(0, 1) == ';'){
//                onChangeAction = onChangeAction.substring(1, onChangeAction.length - 1);
//            }
//            function onChange(){
//                console.log(this.value);
//                eval(onChangeAction);
//            }

            var onBlurAction = $(this).attr('onblur');
            onBlurAction = onBlurAction.replace(';;',';').replace("if( !checkFutureDate( this ) ) return false;","");
            if(onBlurAction.substring(0, 1) == ';'){
                onBlurAction = onBlurAction.substring(1, onBlurAction.length - 1);
            }
            function onBlur(){
                console.log(this.value);
                eval(onBlurAction);
            }
//            console.log(onChangeAction);
            console.log(onBlurAction);
//            $(this).removeAttr('onchange');
            $(this).removeAttr('onblur');
            $(this).datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
                yearRange: "1900:2000",
                defaultDate: new Date(y-13, 1 - 1, 1),
                maxDate: "-13Y",
                showOn: "button",
//                onSelect: onChange,
                onClose: onBlur
            });
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
    height += 150;
    window.parent.document.getElementById('frameResalys').style.height = height + 'px';
    consoleLog(height);
}
