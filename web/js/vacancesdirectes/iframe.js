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

    // Gestion du click sur le parent
    if ($('.linkParent').length > 0) { addLinkBlock(); }

    $('.proposalDescriptionDetailsLink').hover( function(){
        var yTop = $(this).offset();
       //consoleLog(yTop.top);

        $(this).parent().next('.proposalDescriptionDetailsPopUp').css({top:yTop.top}).fadeIn();
        $(this).parents('.aProposalBlock').siblings('.aProposalBlock').stop().animate({opacity:.2}, 250);
    }, function(){
        //consoleLog('out');
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

// Gestion du click sur le parent
function addLinkBlock(){
    $('.linkParent').each( function( ) {
        var oElem = $(this).find('.linkBlock'),
            sOnClick = oElem.attr('onclick');
        if(sOnClick)
            $(this).attr('onclick',sOnClick);
        oElem.removeAttr('onclick');

        $(this).css({cursor:'pointer'}).click(function(e) {
            var event = e;
            if (!e)
                event = window.event;
            if (event && event.target != oElem[0]) {
                var sHref = oElem.attr('href'),
                    sTarget = oElem.attr('target')?oElem.attr('target'):'_self';
                //consoleLog(sHref);
                switch (sTarget) {
                    case "_blank":
                        window.open(sHref, '');
                        break;
                    case "_parent":
                        parent.location.href = sHref;
                        break;
                    case "_top":
                        top.location.href = sHref;
                        break;
                    case "_self":
                        document.location.href = sHref;
                        break;
                    default:
                        sTarget.location.href = sHref;
                        break;
                }
            }
        });

    });
}


