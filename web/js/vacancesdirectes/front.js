/* Project: vd - Date: 20129012 - Author: C2iS.fr > NCH-LGU */

/*--  DOMREADY  --*/
$(function() {
// ScrollTop onload (mobile) si il n'y a pas d'ancre
    if (/mobile/i.test(navigator.userAgent) && !location.hash) {
        window.scrollTo(0, 1);
    }

// Test html5 form capacties andif do polyfills
    if (!Modernizr.input.placeholder) { polyfillPlaceholder(); } // html5 placeholder

// Gestion du click sur le parent
    if ($('.linkParent').length > 0) { addLinkBlock(); }

// init Sliders
    if ($('.tabCampDiapo .slider').length > 0) { sliderPict(); }
    if ($('#tabSurplace .slider').length > 0) { sliderActivite(); }

// init tabs navigation
    if ($('.tabControls').length > 0) {
        var oHash = window.location.hash,
            oTabControls = $('.tabControls'),
            oTabs = $('.tabs'),
            oTabLink = oTabControls.find('a'),
            tView = oTabControls.find('a.active').attr('href');
        oTabs.hide().css({'visibility':'visible'});
        if (oHash != '') {
            setTimeout( function(){
                $('.tabControls').find('[href='+oHash+']').trigger('click');

            }, 0);
        } else {
            tabs(tView, false);
        }
        oTabLink.click( function(e) {
            var tTabs = $(this),
                tView = $(this).attr('href');
            oTabLink.removeClass('active');
            tTabs.addClass('active');
            tabs(tView, true);
            var targetOffset = $('.tabControls').offset().top;
            //consoleLog(targetOffset);
            $('html, body').animate({scrollTop: targetOffset},400);
            e.preventDefault();
        });
    }

// triggerClick
    $('.triggerClick').click( function() {
        var oTarget = $(this).attr('data-triggerLink');
        var targetOffset = $(oTarget).offset().top;
        $('.tabControls').find('[href='+oTarget+']').trigger('click');
        return false;
    });

// scroll to anchor
    $('.goto').click(function(e) {
        e.preventDefault();
        var oAnchor = this.hash;
        var targetOffset = $(oAnchor).offset().top;
        //consoleLog(targetOffset);
        $('html, body').animate({scrollTop: targetOffset},400);
        return false;
    });

// popins
    $(".popinIframe").colorbox({iframe:true, width:'80%', height:'80%', close:"&times;"});
    $(".popinVideo").colorbox({iframe:true, innerWidth:960, innerHeight:540, close:"&times;"});
    //$(".popin360").colorbox();
    $(".popinInline").colorbox({inline:true, width:"75%"});

});



/*--  FUNCTIONS  --*/
function sliderPict() {
    var slider = $('.tabCampDiapo').find('.slider'),
        btLeft = '<button class="prev">&lt;</button>',
        btRight = '<button class="next">&gt;</button>',
        btns = btLeft + btRight;
        slider.append(btns);

    $('.slide', slider).carouFredSel({
        circular: true,
        infinite: true,
        prev:{
            button: function() {
                return $(this).parents('.slider').find('.prev');
            }
        },
        next:{
            button: function() {
                return $(this).parents('.slider').find('.next');
            }
        },
        auto: false
    });
    $('[name="affPhoto"]').change( function() {
        var nVal = $(this).val();
        if (nVal == "all") {
            slider.find('img').not(':visible').fadeIn();
            slider.find('.slide').trigger("configuration",["items.filter",":visible"]);
        } else {
            slider.find('.'+nVal).fadeIn();
            slider.find('img').not('.'+nVal).hide();
            slider.find('.slide').trigger("configuration",["items.filter",":visible"]);
        }
    });
    slider.find('img').each(function() {
        var tip = $(this).attr("title");
        $(this).hover( function() {
           $(this).attr('title', '');
           $('<div id="littleTIP">'+tip+'</div>').appendTo(slider).fadeIn();
        }, function() {
           $('#littleTIP').fadeOut(function(){
              $(this).remove();
           });
           $(this).attr('title', tip);
        });
    });
}

function sliderActivite() {
    var slider = $('#tabSurplace').find('.slider'),
        btLeft = '<button class="prev">&lt;</button>',
        btRight = '<button class="next">&gt;</button>',
        btns = btLeft + btRight;
    slider.after(btns);

    $('.slide', slider).carouFredSel({
        circular: false,
        infinite: false,
        prev:{
            button: function() {
                return $(this).parents('.temoignFiche').find('.prev');
            }
        },
        scroll: 1,
        next:{
            button: function() {
                return $(this).parents('.temoignFiche').find('.next');
            }
        },
        auto: false
    });
}

function tabs(tView, load) {
    var sView = tView.split('#')[1],
        slider = $('.tabCampDiapo');

    if (sView == 'tabCamp' || sView == 'tabLocations') {
        if (sView == 'tabLocations'){
            $('[name="affPhoto"][value="locations"]').parent('label').trigger('click');
        } else {
            $('[name="affPhoto"][value="all"]').parent('label').trigger('click');
        }
        slider.slideDown();
        if (!load){ $('html, body').animate({scrollTop: 0},0); }

    } else if (sView == 'tabProximite' || sView == 'tabInfos') {
        slider.slideUp();
        if (mapsLoaded) {
            consoleLog('2');
            google.maps.event.addListenerOnce(map, 'idle', function() {
                google.maps.event.trigger(map, 'resize');
                map.setCenter(point); // be sure to reset the map center as well
            });
        } else {
            consoleLog('1');
            initialize();
            mapsLoaded = true;
        }
    } else {
        slider.slideUp();
    }
    $(tView).slideDown().siblings('.tabs').slideUp();
}




