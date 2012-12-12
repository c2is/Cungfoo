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
//    if($('#semainierContener').length){
//        $('#semainierContener').find('select').sSelect({ddMaxHeight: '300px'});
//    }

    $('.proposalDescriptionDetailsLink').hover( function(){
        var yTop = $(this).offset();
        consoleLog(yTop.top);

        $(this).parent().next('.proposalDescriptionDetailsPopUp').css({top:yTop.top}).fadeIn();
        $(this).parents('.aProposalBlock').siblings('.aProposalBlock').stop().animate({opacity:.2}, 250);
    }, function(){
        consoleLog('out');
        $(this).parent().next('.proposalDescriptionDetailsPopUp').fadeOut();
        $(this).parents('.aProposalBlock').siblings('.aProposalBlock').stop().animate({opacity:1}, 250);
    });



});

head.ready(function(){

    if($('.ce').length){

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
    //consoleLog(height);
}
