/* Project: vd - Date: 20129012 - Author: C2iS.fr > NCH-LGU */

var arrivalDatepicker;
var arrivalAvailableDates ;
var arrivalYear;
var arrivalMonth;
var selectedArrivalMonth;
var arrivalDay;
var arrivalDate;

var departureDatepicker;
var departureAvailableDates;
var departureYear;
var departureMonth;
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

//Focus champ de connexion
    if ($('#username').length > 0) { $("#username").focus(); }


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

    if ($('#tabLocations').length > 0) {
        var oForm = $('.filterBy');
        oForm.find('select').change( function(){
            var sVal1 = $(this).val();
            var sVal2 = $(this).siblings('select').val();
            var nElt = $('.typLocation').length;

            $('.typLocation').each( function() {
                if (sVal1 == "" && sVal2 == "") {
                    $(this).fadeIn();
                } else if (sVal1 == "") {
                    $(this).not('.'+sVal2).hide();
                    $('.'+sVal2).fadeIn();
                } else if (sVal2 == "") {
                    $(this).not('.'+sVal1).hide();
                    $('.'+sVal1).fadeIn();
                } else {
                    $(this).not('.'+sVal1+'.'+sVal2).hide();
                    $('.'+sVal1+'.'+sVal2).fadeIn();
                }
            });

            if ($('.typLocation').not(':visible').length >= nElt) {
                $('.noResultTyp').fadeIn();
            }else{
                $('.noResultTyp').fadeOut();
            }
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

// select
    $('#searchForm').find('select').not($('select[multiple]')).sSelect({ddMaxHeight: '300px'});

// datepicker
    var d = new Date(),
        fCurrentDate = formatDate(d),
        currentDate = numDate(fCurrentDate),
        fStartDate = '2013/04/06',
        fEndDate = '2013/10/26',
        fSeasonDates = [fStartDate,fEndDate],
        fHighSeasonStartDate = '2013/06/29',
        fHighSeasonEndDate = '2013/08/31',
        fHighSeasonDates = [fHighSeasonStartDate,fHighSeasonEndDate],
        startDate = numDate(fStartDate);

    console.log(fSeasonDates);
    console.log(fHighSeasonDates);
    console.log(fCurrentDate);
    console.log(d);

    if (currentDate > startDate){
        fStartDate = fCurrentDate;
    }
    console.log(currentDate);
    console.log(startDate);
    console.log(fStartDate);

    var firstSelection = true,
        miniDepartureDate;

    $('#widgetCalendar').DatePicker({
        flat: true,
        date: '',
        current: '2013/07/01',
        calendars: 5,
        mode: 'range',
        starts: 1,
        format:'Y/m/d',
        position: 'right',
        onBeforeShow: function(){
            console.log("################################## onBeforeShow:  ##################################");

            //            datepicker.DatePickerSetDate(datepicker.val(), true);
        },
        onChange: function(formated, dates){
            console.log("################################## onChange:  ##################################");
            console.log(formated);
            console.log(dates);

            var weekDuration = 1000*60*60*24*7,
                numWeeks = 6,
                selectedDates  = new Array();
            $.each(dates, function(index, value) {
                console.log(index + ": " + value);
                selectedDates.push(writeDate(value));
            });
            if (firstSelection) {
                console.log("1ère sélection : " + selectedDates[0]);
                miniDepartureDate = numDate(formatDate(new Date(dates[0].getTime() + numWeeks*weekDuration)));
                console.log("miniDepartureDate : " + miniDepartureDate);
                unselectForbiddenDates(miniDepartureDate, dates[0]);
                firstSelection = false;
            }
            else {
                console.log("2ème sélection : " + selectedDates[1]);
                firstSelection = true;
            }
            console.log(selectedDates)
            $('#widgetInput').val('Du ' + selectedDates.join(' au '));
            $('#widget input.hidden').each(function(index, value){
                $(this).val(selectedDates[index]);
            });
        },
        onRender: function(date) {
//            console.log("################################## onRender:  ##################################");
            var renderDate = date,
                disabledDate,
                highSeasonDate,
                renderWeekDay = renderDate.getDay(),
                fRenderDate = formatDate(renderDate),
                renderDate = numDate(fRenderDate),
                startDate = numDate(fStartDate),
                endDate = numDate(fEndDate),
                highSeasonStartDate = numDate(fHighSeasonStartDate),
                highSeasonEndDate = numDate(fHighSeasonEndDate);
//            console.log(renderDate);
//            console.log(startDate);
//            console.log(endDate);
//            console.log(renderWeekDay);
                if ( (renderDate < startDate || renderDate > endDate) || renderWeekDay != 6 || renderDate >= highSeasonStartDate && renderDate <= highSeasonEndDate){
//                    console.log("DISABLED: " + renderDate);
                    disabledDate = renderDate;
                }
                if (renderDate >= highSeasonStartDate && renderDate <= highSeasonEndDate){
//                    console.log("HIGH SEASON: " + renderDate);
                    highSeasonDate = renderDate;
                }
//            console.log(disabledDate);
            return {
                disabled: disabledDate != undefined,
                className: highSeasonDate != undefined ? 'datepickerSpecial' : false
            }
        }
    });
    var state = false;
    $('#widgetField').bind('click', function(){
        $(this).toggleClass('opened');
        $(this).next('#widgetCalendar').stop().animate({height: state ? 0 : $('#widgetCalendar div.datepicker').get(0).offsetHeight}, 500);
        state = !state;
        return false;
    });
    $('#linearSwitcher input').bind('click', function(){
//        switchLinear();
    });
    $('#widgetCalendar div.datepicker').css('position', 'absolute');


    $('.sMultSelect').sMultSelect({msgNull: 'Pas de réponse'});
    /*$('.sMultSelectUl').wrap('<div class="tinyScroll" />').before('<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>')
        .wrap('<div class="viewport"><div class="overview"></div></div>');
    $('.tinyScroll').tinyscrollbar();*/
});


/*--  FUNCTIONS  --*/

function openIframePopin(url){
    $.colorbox({href: url, iframe:true, width:'80%', height:'80%', close:"&times;"});
}

// datepicker
/*function switchLinear() {
 var radioValue = $('input[type=radio][name=linearType]:checked').attr('value');
 $('#searchContainer .searchBox').attr('id',radioValue);
 if (radioValue == "classic"){

 }
 else {

 }
 }*/
function unselectForbiddenDates(miniDepartureDate, date){
    console.log(miniDepartureDate);
    console.log(date);
    $('#widgetCalendar td').each(function(index, value){
        if ( $(this).not('.datepickerNotInMonth').hasClass('datepickerSelected') )
        {
            $(this).parents('.datepickerViewDays').find('.datepickerSaturday').each(function(index,value){
                if ($(this).hasClass('datepickerSelected')){
                    return false;
                }
                else {
                    console.log(value);
                    $(this).addClass('datepickerUnselectable');
                }
            });
            $(this).parents('.datepickerViewDays').parent('td').prevAll('td').not('.datepickerSpace').find('.datepickerSaturday').each(function(index,value){
                $(this).addClass('datepickerUnselectable');
            });
        }
    });
}

function formatDate(d){
    var thisYear = d.getFullYear(),
        thisMonth = d.getMonth()+1,
        thisDay = d.getDate(),
        fThisMonth = ((''+thisMonth).length<2 ? '0' : '') + thisMonth,
        fThisDay = ((''+thisDay).length<2 ? '0' : '') + thisDay,
        fThisDate = thisYear + '/' + fThisMonth + '/' + fThisDay;
    return fThisDate;
}

function writeDate(d){
    var thisYear = d.getFullYear(),
        thisMonth = d.getMonth()+1,
        thisDay = d.getDate(),
        fThisMonth = ((''+thisMonth).length<2 ? '0' : '') + thisMonth,
        fThisDay = ((''+thisDay).length<2 ? '0' : '') + thisDay,
        fThisDate = fThisDay + '/' + fThisMonth + '/' + thisYear;
    return fThisDate;
}

function numDate(d){
    var nThisDate = parseInt(d.split('/').join(''),10);
    return nThisDate;
}

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
    console.log("selectedArrivalMonth: " + selectedArrivalMonth);
    console.log("departureMonth: " + departureMonth);
    console.log("selectedDepartureMonth: " + selectedDepartureMonth);
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
        arrivalAvailableDates.each(function() {
            console.log("day: " + parseInt($(this).text(), 10));
            console.log("arrival day: " + parseInt(arrivalDay, 10));
            if ( parseInt($(this).text(), 10) == parseInt(arrivalDay, 10) ){
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

// slider
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



