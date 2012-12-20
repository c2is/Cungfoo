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
        $('#authentication').find('select').sSelect({ddMaxHeight: '300px'});
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


    if($('#contentContener.address').length){

        // datepickers
        var d = new Date();
        var y = d.getFullYear();
        $("#address").each(function(index,value){
            var onChangeAction = $(this).find('.control_date').attr('onchange');
            onChangeAction = onChangeAction.replace(';;',';').replace('if( !checkFutureDate( this ) ) return false; ','');
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
            $(this).find('.control_date').removeAttr('onchange');
            $(this).find('.control_date').datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: "1900:2000",
                defaultDate: new Date(y-18, 1 - 1, 1),
                maxDate: "-18Y",
                showOn: "button",
                beforeShow: hideSelects
//                onClose: onChange
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
    height += 70;
    window.parent.document.getElementById('frameResalys').style.height = height + 'px';
//    consoleLog(height);
}
