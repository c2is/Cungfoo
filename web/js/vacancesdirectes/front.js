/* Project: vd - Date: 20129012 - Author: C2iS.fr > NCH-LGU */

var arrivalDatepicker;
var arrivalAvailableDates ;
var arrivalYear;
var arrivalMonth = 4;
var selectedArrivalMonth;
var arrivalDay;
var arrivalDate;

var departureDatepicker;
var departureAvailableDates;
var departureYear;
var departureMonth = 4;
var selectedDepartureMonth;
var departureDay;
var departureDate;
var sameMonth;

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

        oTabs.css({position:'absolute',left:'-999em', top:'-999em'});
        if (oHash != '') {
            setTimeout( function(){
                if ($(oHash).length > 0)
                    $('.tabControls').find('[href='+oHash+']').trigger('click');
                else
                    tabs(tView, false);
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
// datepicker
    $('#datepicker-principal-arrival').Zebra_DatePicker({
        months: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        days: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        lang_clear_date: ['Effacer'],
        format: 'd/m/Y',
        readonly_element: true,
        pair: $('#datepicker-principal-departure'),
        disabled_dates: ['* * * 0,1,2,3,4,5'],
        direction: ['01/04/2013', '30/06/2013'],
        always_visible: $('#datepickerPrincipal')
    });

    $('#datepicker-principal-departure').Zebra_DatePicker({
        months: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        days: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        lang_clear_date: ['Effacer'],
        format: 'd/m/Y',
        readonly_element: true,
        disabled_dates: ['* * * 0,1,2,3,4,5'],
        direction: ['01/09/2013', '15/11/2013'],
        always_visible: $('#datepickerPrincipal')
    });

    $('#datepicker-secondary-arrival').Zebra_DatePicker({
        months: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        days: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        lang_clear_date: ['Effacer'],
        format: 'd/m/Y',
        readonly_element: true,
        pair: $('#datepicker-secondary-departure'),
        disabled_dates: ['* 7,8 *', '* * * 0,1,2,3,4,5'],
        direction: ['06/04/2013', '15/11/2013'],
        always_visible: $('#datepickerSecondary'),
        onChange: function(view, elements) {
            console.log("################################## ARRIVAL / onChange:  ##################################");
            console.log(view);
            console.log(elements);
            var month = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
            arrivalAvailableDates = elements;
            arrivalDatepicker = $('#datepickerSecondary .arrival .dp_daypicker');
            if (view == "days"){
                var currentMonth = arrivalDatepicker.prev('.dp_header').find('.dp_caption').text().split(",")[0];
                console.log("currentMonth: " + currentMonth);
                $.each( month, function(i, n){
                    if (n == currentMonth){
                        arrivalMonth = i + 1;
                    }
                });
                console.log("arrivalMonth: " + arrivalMonth);
                console.log("selectedArrivalMonth: " + selectedArrivalMonth);
                console.log("departureMonth: " + departureMonth);
                console.log("selectedDepartureMonth: " + selectedDepartureMonth);
            }
            if (arrivalMonth > selectedArrivalMonth && arrivalMonth < selectedDepartureMonth){
                console.log("IF MOIS INTERMEDIAIRE");
                arrivalDatepicker.find('td:not(".dp_not_in_month")').addClass('selected-date');
            }
            else if (arrivalMonth == selectedArrivalMonth){
                console.log("IF PREMIER MOIS");
                arrivalDatepicker.find('td:not(".dp_not_in_month")').each(function() {
                    if ( parseInt($(this).text(), 10) >= parseInt(arrivalDay, 10) ){
                        console.log($(this).text());
                        $(this).addClass("selected-date");
                    }
                });
            }
            else if (arrivalMonth == selectedDepartureMonth){
                console.log("IF DERNIER MOIS");
                arrivalDatepicker.find('td:not(".dp_not_in_month")').each(function() {
                    if ( parseInt($(this).text(), 10) <= parseInt(departureDay, 10) ){
                        console.log($(this).text());
                        $(this).addClass("selected-date");
                    }
                });
            }

            console.log("arrival: " + arrivalAvailableDates)
        },
        onSelect: function(fDate, nDate, oDate) {
            console.log("################################## ARRIVAL / onSelect:  ##################################");
            //console.log(fDate);
            //console.log(nDate);
            //console.log(oDate);
            //console.log(oDate.getTime());

            var d = oDate;
//            arrivalYear = d.getFullYear();
//            arrivalMonth = d.getMonth()+1;
//            arrivalMonth = ((''+arrivalMonth).length<2 ? '0' : '') + arrivalMonth;
            arrivalDay = d.getDate();
            arrivalDay = ((''+arrivalDay).length<2 ? '0' : '') + arrivalDay;
            //console.log(departureMonth);
            arrivalDate = arrivalYear + arrivalMonth + arrivalDay;
            arrivalMonth = parseInt(arrivalMonth, 10);
            selectedArrivalMonth = arrivalMonth;
            //console.log("arrivalDate: " + arrivalDate);
            //console.log("departureDate: " + departureDate);

            $('#datepickerSecondary .dp_daypicker td.arrival-date').removeClass('arrival-date');

            //console.log("arrivalDay: " + arrivalDay);
            //console.log("departureDay: " + departureDay);

            sameMonth = true;
            checkMonth(arrivalAvailableDates, arrivalDatepicker);
        }
    });

    $('#datepicker-secondary-departure').Zebra_DatePicker({
        months: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        days: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        lang_clear_date: ['Effacer'],
        format: 'd/m/Y',
        readonly_element: true,
        disabled_dates: ['* 7,8 *', '* * * 0,1,2,3,4,5'],
        direction: ['13/04/2013', '15/11/2013'],
        always_visible: $('#datepickerSecondary'),
        onChange: function(view, elements) {
            console.log('################################## DEPARTURE / onChange: ##################################');
            $('#datepickerSecondary').children().eq(0).addClass('arrival');
            $('#datepickerSecondary').children().eq(1).addClass('departure');
            console.log(view);
            console.log(elements);

            var month = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
            departureDatepicker = $('#datepickerSecondary .departure .dp_daypicker');
            departureAvailableDates = elements;
            if (view == "days"){
                var currentMonth = departureDatepicker.prev('.dp_header').find('.dp_caption').text().split(",")[0];
                console.log("currentMonth: " + currentMonth);
                $.each( month, function(i, n){
                    if (n == currentMonth){
                        departureMonth = i + 1;
                    }
                });
                console.log("departureMonth: " + departureMonth);
                console.log("selectedDepartureMonth: " + selectedDepartureMonth);
            }
            if (departureMonth < selectedDepartureMonth && departureMonth > selectedArrivalMonth && selectedDepartureMonth != undefined){
                console.log("IF MOIS INTERMEDIAIRE");
                departureDatepicker.find('td:not(".dp_not_in_month")').addClass('selected-date');
            }
            else if (departureMonth == selectedDepartureMonth && selectedDepartureMonth != undefined){
                console.log("IF DERNIER MOIS");
                departureDatepicker.find('td:not(".dp_not_in_month")').each(function() {
                    if ( parseInt($(this).text(), 10) <= parseInt(departureDay, 10) ){
                        console.log($(this).text());
                        $(this).addClass("selected-date");
                    }
                });
            }
            else if (departureMonth == selectedArrivalMonth && selectedDepartureMonth != undefined){
                console.log("IF PREMIER MOIS");
                departureDatepicker.find('td:not(".dp_not_in_month")').each(function() {
                    if ( parseInt($(this).text(), 10) >= parseInt(arrivalDay, 10) ){
                        console.log($(this).text());
                        $(this).addClass("selected-date");
                    }
                });
            }
            else if (departureMonth == selectedArrivalMonth){
                console.log("IF PREMIER MOIS");
                departureDatepicker.find('td:not(".dp_not_in_month")').each(function() {
                    if ( parseInt($(this).text(), 10) <= parseInt(arrivalDay, 10) ){
                        console.log("disabled days: " + $(this).text());
                        console.log("disabled class: " + $(this).attr('class'));
                        if ( $(this).hasClass('dp_weekend')){
                            $(this).attr('class', 'dp_weekend_disabled');
                        }
                        console.log("disabled class: " + $(this).attr('class'));
                    }
                });
            }
            console.log("departure: " + departureAvailableDates)
        },
        onSelect: function(fDate, nDate, oDate) {
            console.log("################################## DEPARTURE / onSelect:  ##################################");
            //console.log(fDate);
            //console.log(nDate);
            //console.log(oDate);
            //console.log(oDate.getTime());

            var d = oDate;
//            departureYear = d.getFullYear();
//            departureMonth = d.getMonth()+1;
//            departureMonth = ((''+departureMonth).length<2 ? '0' : '') + departureMonth;
            departureDay = d.getDate();
            departureDay = ((''+departureDay).length<2 ? '0' : '') + departureDay;
            //console.log(departureMonth);
            departureDate = departureYear + departureMonth + departureDay;
            departureMonth = parseInt(departureMonth, 10);
            selectedDepartureMonth = departureMonth;
            //console.log("arrivalDate: " + arrivalDate);
            //console.log("departureDate: " + departureDate);

            //console.log("arrivalDay: " + arrivalDay);
            //console.log("departureDay: " + departureDay);

            checkMonth(departureAvailableDates, departureDatepicker);
        }
    });

});


/*--  FUNCTIONS  --*/
function colorizeRange(arrivalDay,departureDay){
    console.log("////////////////////////////////// colorizeRange()  //////////////////////////////////");
    $('#datepickerSecondary .dp_daypicker td:not(".dp_not_in_month")').each(function() {
//                console.log($(this).text());
        if ($(this).text() == arrivalDay){
            $(this).addClass("arrival-date");
        }
        if ($(this).text() == departureDay){
            $(this).addClass("departure-date");
        }
    });
    console.log("Arrival day: " + parseInt(arrivalDay));
    $('#datepickerSecondary .dp_daypicker td:not(".dp_not_in_month")').each(function() {
//        console.log("day: " + $(this).text());
//        console.log("PARSEINT day: " + parseInt($(this).text(), 10));
        if (sameMonth){
            if (parseInt($(this).text(), 10) >= parseInt(arrivalDay, 10) && parseInt($(this).text(), 10) <= parseInt(departureDay, 10)){
                console.log($(this).text());
                $(this).addClass("selected-date");
            }
        }
        else if(!sameMonth){
            if (parseInt($(this).text(), 10) >= parseInt(arrivalDay, 10) && $(this).parents('.Zebra_DatePicker').hasClass('arrival')){
                console.log($(this).text());
                $(this).addClass("selected-date");
            }
            if (parseInt($(this).text(), 10) <= parseInt(departureDay, 10) && $(this).parents('.Zebra_DatePicker').hasClass('departure')){
                console.log($(this).text());
                $(this).addClass("selected-date");
            }
        }

    });
}

function clearRange(dates){
    console.log("////////////////////////////////// clearRange()  //////////////////////////////////");
    if ($('.selected-date').length){
        $('.selected-date').removeClass('selected-date');
        dates.siblings('.departure-date').removeClass('departure-date');
    }
}

function defineRange(availableDates) {
    console.log("////////////////////////////////// defineRange()  //////////////////////////////////");
    var selectedDate = availableDates.closest('.dp_selected');
    var datepicker = selectedDate.parents('.Zebra_DatePicker');
    if (datepicker.hasClass('arrival')){
        availableDates.closest('.dp_selected').addClass('arrival-date')
        if(selectedDate <= departureDate){
            availableDates.closest('.dp_selected').removeClass("dp_selected");
            return false;
        }
        else {
            console.log('--------------------- DATE D ARRIVEE POSTERIEURE A LA DATE DE DEPART ---------------------');
        }
    }
    else if (datepicker.hasClass('departure')){
        if(selectedDate >= arrivalDate){
            availableDates.siblings('.dp_selected').removeClass("dp_selected");
            return false;
        }
        else {
            console.log('--------------------- DATE DE DEPART ANTERIEURE A LA DATE D ARRIVEE ---------------------');
        }
    }

}

function checkMonth(availableDates, datepicker){
    console.log("////////////////////////////////// checkMonth()  //////////////////////////////////");
    console.log("arrivalMonth: " + arrivalMonth);
    console.log("departureMonth: " + departureMonth);
    if (arrivalMonth < departureMonth && departureMonth != undefined){
        sameMonth = false;
    }
    else if (arrivalMonth > departureMonth && departureMonth != undefined){
        sameMonth = undefined;
    }
    else if (arrivalMonth == departureMonth && departureMonth != undefined){
        sameMonth = true;
    }
    disableDates();
    console.log(sameMonth);
    if (sameMonth != undefined){
        defineRange(availableDates);
        clearRange(datepicker);
        console.log("Arrival day: " + arrivalDay);
        console.log("Departure day: " + departureDay);
        colorizeRange(arrivalDay,departureDay);
    }

}

function disableDates(){
    console.log("////////////////////////////////// disableDates()  //////////////////////////////////");

    if (sameMonth){
        console.log("---------------------------------- same month  ----------------------------------");
        console.log(departureAvailableDates);
        departureAvailableDates.each(function() {
        console.log("day: " + parseInt($(this).text(), 10));
        console.log("arrival day: " + parseInt(arrivalDay, 10));
            if ( parseInt($(this).text(), 10) <= parseInt(arrivalDay, 10) ){
                console.log("disabled days: " + $(this).text());
                console.log("disabled class: " + $(this).attr('class'));
                if ( $(this).hasClass('dp_weekend')){
                    $(this).attr('class', 'dp_weekend_disabled');
                }
                console.log("disabled class: " + $(this).attr('class'));
            }
        });
    }
    if (sameMonth == undefined){
        console.log("---------------------------------- forbidden month  ----------------------------------");
        departureAvailableDates.each(function() {
            if ( $(this).hasClass('dp_weekend') && !$(this).hasClass('selected-date')){
                $(this).attr('class', 'dp_weekend_disabled');
            }
        });
    }

}

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
        slider.fadeIn();
        if (sView == 'tabLocations'){
            $('[name="affPhoto"][value="locations"]').parent('label').trigger('click');
        } else {
            $('[name="affPhoto"][value="all"]').parent('label').trigger('click');
        }
    } else {
        slider.hide();
        if (sView == 'tabProximite') {
            if (!proxMapLoaded) {
                proxInit();
                proxMapLoaded = true;
            }
        } else if (sView == 'tabInfos') {
            if (!infoMapLoaded) {
                infoInit();
                infoMapLoaded = true;
            }
        }
    }
    $(tView).css({'position':'static'}).animate({'opacity':1}).siblings('.tabs').css({position:'absolute',opacity:'0'});
    if (!load){ $('html, body').animate({scrollTop: 0},0); }
}



