/* Project: vd - Date: 20129012 - Author: C2iS.fr > NCH-LGU */

var oWindow = $('windows'),
    oHtml = $('html'),
    oBody = $('body'),
    scrollElem = $('html', 'body');


$(function() { //domReady
// ScrollTop onload (mobile) si il n'y a pas d'ancre
    if(/mobile/i.test(navigator.userAgent) && !location.hash){
        window.scrollTo(0, 1);
    }
	
// Test log exe front.js
    consoleLog('Execution front.js : ok');

// Test html5 form capacties andif do polyfills
    if(!Modernizr.input.placeholder){ polyfillPlaceholder(); } // html5 placeholder

// Gestion du click sur le parent
    if($('.linkParent').length > 0) { addLinkBlock(); }
// init Sliders
    if( $('.slider').length > 0 ){ slider(); }
// init tabs navigation
    if( $('.tabControls').length > 0){
        var oTabControls = $('.tabControls'),
            oTabs = $('.tabs'),
            oTabLink = oTabControls.find('a'),
            tView = oTabControls.find('a.active').attr('href');
        oTabs.hide().css({'visibility':'visible'});
        tabs(tView);
        oTabLink.click( function(e){
            var tTabs = $(this),
                tView = $(this).attr('href');
            oTabLink.removeClass('active');
            tTabs.addClass('active');
            tabs(tView);
            e.preventDefault();
        });
    }
// triggerClick
    $('.triggerClick').click( function(){
        var oTarget = $(this).attr('data-triggerLink');
        var targetOffset = $(oTarget).offset().top;
        $('[href='+oTarget+']').trigger('click');
        $('html, body').animate({scrollTop: targetOffset},400);
        return false;
    });
// scroll to anchor
    $('.goto').click(function(e){
        e.preventDefault();
        var oAnchor = this.hash;
        var targetOffset = $(oAnchor).offset().top;
        consoleLog(targetOffset);
        $('html, body').animate({scrollTop: targetOffset},400);
        return false;
    });
// popins
    //$(".popin").colorbox();
    $(".popinVideo").colorbox({iframe:true, innerWidth:960, innerHeight:540, close:"&times;"});
    //$(".popin360").colorbox();
    $(".popinInline").colorbox({inline:true, width:"75%"});

});

function slider(){
    var slider = $('.slider');
    slider.each( function(){
        consoleLog('a slider found');
        var btLeft = '<button class="prev">&lt;</button>',
            btRight = '<button class="next">&gt;</button>',
            btns = btLeft + btRight;
        $(this).append(btns).find('.slide').carouFredSel({
            circular: true,
            infinite: true,
            auto: false/*,
            scroll: {
                //fx: 'crossfade'
            }*/
        });
        $('.prev').live('click', function() {
            slider.find('.slide').trigger("prev", 1);
        });
        $('.next').live('click', function() {
            slider.find('.slide').trigger("next", 1);
        });
        $('[name="affPhoto"]').change( function(){
            var nVal = $(this).val();
            consoleLog(nVal);
            if( nVal == "all"){
                slider.find('img').not(':visible').fadeIn();
                slider.find('.slide').trigger("configuration",["items.filter",":visible"]);
            }else{
                slider.find('.'+nVal).fadeIn();
                slider.find('img').not('.'+nVal).hide();
                slider.find('.slide').trigger("configuration",["items.filter",":visible"]);
            }
        });
    });
}
function tabs(tView){
    $('.tabs').slideUp();
    $(tView).slideDown();
}




