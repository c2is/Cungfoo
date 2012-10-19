/* Project: vd - Date: 20129012 - Author: C2iS.fr > NCH-LGU */

if (!fStartDate){
    var linear ="";
    var fStartDate ="";
    var fEndDate ="";
    var fHighSeasonStartDate ="";
    var fHighSeasonEndDate ="";
}

//datepicker
var startDate = numDate(fStartDate),
    endDate = numDate(fEndDate),
    highSeasonStartDate = numDate(fHighSeasonStartDate),
    highSeasonEndDate = numDate(fHighSeasonEndDate),
    weekDuration = 1000*60*60*24*7,
    firstSelection = true,
    firstRendering = true;

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
        fSeasonDates = [fStartDate,fEndDate],
        fHighSeasonDates = [fHighSeasonStartDate,fHighSeasonEndDate],
        startDate = numDate(fStartDate),
        arrivalDate,
        departureDate;

    //console.log(fSeasonDates);
    //console.log(fHighSeasonDates);
    //console.log(fCurrentDate);
    //console.log(d);

    if (currentDate > startDate){
        fStartDate = fCurrentDate;
    }
    //console.log(currentDate);
    //console.log(startDate);
    //console.log(fStartDate);

    $('#widgetCalendar').DatePicker({
        flat: true,
        date: '',
        current: '2013/07/01',
        calendars: 7,
        mode: 'range',
        starts: 1,
        format:'Y/m/d',
        position: 'right',
        onBeforeShow: function(){
            //console.log("################################## onBeforeShow:  ##################################");

        },
        onShow: function(){
            //console.log("################################## onShow:  ##################################");

        },
        onChange: function(formated, dates){
            //console.log("################################## onChange:  ##################################");
            //console.log(formated);
            //console.log(dates);
            arrivalDate = dates[0];
            departureDate = dates[1];

            var selectedDates  = new Array(),
                selectedDays = new Array();
            firstRendering = false;
            $.each(dates, function(index, value) {
                //console.log(index + ": " + value);
                selectedDates.push(writeDate(value));
                selectedDays.push($(this));
            });
            if (firstSelection) {
                unselectForbiddenDates(arrivalDate);
                firstSelection = false;
            }
            else {
                unselectForbiddenDates(departureDate);
                firstSelection = true;
            }
            //console.log(selectedDates)
            $('#widgetInput').val('Du ' + selectedDates.join(' au '));
            $('#widget input.hidden').each(function(index, value){
                $(this).val(selectedDates[index]);
            });
        },
        onRender: function(date) {
//            //console.log("################################## onRender:  ##################################");

            var renderDate = date,
                disabledDate,
                highSeasonDate,
                renderWeekDay = renderDate.getDay(),
                fRenderDate = formatDate(renderDate),
                renderDate = numDate(fRenderDate);

//            //console.log(renderDate);
//            //console.log(startDate);
//            //console.log(endDate);
//            //console.log(renderWeekDay);

                if ( (renderDate < startDate || renderDate > endDate) || renderWeekDay != 6 || (renderDate > highSeasonStartDate && renderDate < highSeasonEndDate) ){
//                    //console.log("DISABLED: " + renderDate);
                    disabledDate = renderDate;
                }

                if (renderDate >= highSeasonStartDate && renderDate <= highSeasonEndDate){
//                    //console.log("HIGH SEASON: " + renderDate);
                    highSeasonDate = renderDate;
                }

//            //console.log(disabledDate);
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
    var currentMonth = 1;
    $('.datepicker>.datepickerGoPrev a, .datepicker>.datepickerGoNext a').bind('click', function(e){
        //console.log("--- CHANGE MONTH ---");
        var datepicker = $('.datepickerContainer');
        var direction = $(this).parent().hasClass('datepickerGoPrev') ? "+=" : "-=";
        var currentButton = $(this);
        if (currentButton.hasClass('isFading')){
            //console.log("is fading");
            return false;
        }
        currentMonth = direction == "-=" ? currentMonth+1 : currentMonth-1;

        datepicker.animate({
            marginLeft: direction + "175px"
        }, 500);

        if (currentMonth >= 7 - 5 || currentMonth <= 0){
            currentButton.addClass('isFading').fadeOut(1000);
        }
        else {
            $('.datepicker>.datepickerGoPrev a, .datepicker>.datepickerGoNext a').removeClass('isFading').fadeIn(1000);
        }

        //console.log(currentMonth);
        return false;
    });
    $('.datepickerGoPrev a, .datepickerGoNext a, .datepickerMonth a').bind('click', function(e){
        return false;
    });
    $('#linearSwitcher input').bind('click', function(){
        switchLinear();
    });
    $('#widgetCalendar div.datepicker').css('position', 'absolute');
    $('#widgetCalendar div.datepickerContainer').css('margin-left', '-180px');

    initializeForbiddenDates();
    $('#linearSwitcher input[checked=checked]').trigger('click');

    var preselectedDates = new Array();
    if ( $("#AchatLineaire_dateDebut").val() != '' && $("#AchatLineaire_dateFin").val() != '' ) {
        $.each($('input.hidden'), function(i, item) {
            console.log(item.value);
            var fDate = item.value.split("/").reverse().join('/');
            console.log(fDate);
            preselectedDates.push(fDate);
        });
        console.log(preselectedDates);
        $('#widgetCalendar').DatePickerSetDate(preselectedDates);
    }


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
function switchLinear() {
    console.log("################################## switchLinear()  ##################################");
    $('#widgetCalendar').DatePickerClear();
    var radioValue = $('input[type=radio][name=linearType]:checked').attr('value');
    $('#searchContainer .searchBox').attr('id',radioValue);
    $('#linearSwitcher').attr('class','column clear ' + radioValue);
    console.log(linear);
    var legendText = radioValue == "classic" ? "Recherche de linéaires classiques" : "Recherche de linéaires basse saison";
    var infoText = radioValue == "classic" ? "La période en haute saison doit être comprise dans la sélection." : "Un minimum de 6 semaines doit être compris dans la sélection.";
    $('#' + radioValue).find('legend').text(legendText);
    $('#' + radioValue + ' #widgetCalendar').find('.datepickerInfo').text(infoText);
    linear = radioValue;
    firstRendering = true;
    initializeForbiddenDates();
}

function initializeForbiddenDates() {
    console.log(firstRendering);
    var startHighSeasonDay = false,
        endHighSeasonDay = false,
        allSaturdays = $('#widgetCalendar td.datepickerSaturday').not($('td.datepickerNotInMonth'));
    allSaturdays.removeClass('datepickerUnselectable');
    if (firstRendering && linear == "classic"){
        allSaturdays.each(function(index, value){
            // td HIGHT SEASON LAST DAY
            if ( $(this).hasClass('datepickerSpecial') && !$(this).hasClass('datepickerUnselectable') && startHighSeasonDay ){
                //console.log("HIGH SEASON LAST DAY");
                //console.log(value);
                $(this).addClass('datepickerUnselectable');
                endHighSeasonDay = true;
            }
            // td HIGHT SEASON FIRST DAY
            if ( $(this).hasClass('datepickerSpecial') && !$(this).hasClass('datepickerUnselectable') ){
                //console.log("HIGH SEASON FIRST DAY");
                //console.log(value);
                startHighSeasonDay = true;
            }
            if (endHighSeasonDay){
                $(this).addClass('datepickerUnselectable');
            }
            //console.log(value);
        });
    }
    else if (firstRendering && linear == "mini"){
        var len = allSaturdays.length;
        allSaturdays.each(function(index, value){
            if (index >= len - numMiniWeeks) {
                $(this).addClass('datepickerUnselectable');
            }
            //console.log(value);
        });
    }

}

function unselectForbiddenDates(date){
    //console.log("date: " + date);
    //console.log(firstSelection);
    var selectedDate = numDate(formatDate(date)),
        arrivalDay = false,
        departureDay = false,
        startHighSeasonDay = false,
        endHighSeasonDay = false,
        numWeek = 1,
        allSaturdays = $('#widgetCalendar td.datepickerSaturday').not($('td.datepickerNotInMonth')),
        allDaysNotInMonthSelected = $('#widgetCalendar td.datepickerNotInMonth.datepickerSelected');

    allSaturdays.each(function(index, value){

        // td ARRIVAL
        if ($(this).hasClass('datepickerSelected') && firstSelection) {
            //console.log("#1: ARRIVAL DAY");
            //console.log(value);
            $(this).addClass('datepickerUnselectable');
            arrivalDay = true;
        }
        else {

            if (linear == "classic" && firstSelection) {

                // td HIGH SEASON LAST DAY
                if ( $(this).hasClass('datepickerSpecial') && !$(this).hasClass('datepickerUnselectable') && startHighSeasonDay ){
                    //console.log("#1: HIGH SEASON LAST DAY");
                    //console.log(value);
                    $(this).removeClass("datepickerDisabled");
                    endHighSeasonDay = true;
                }

                // td HIGHT SEASON FIRST DAY
                if ( $(this).hasClass('datepickerSpecial') && !$(this).hasClass('datepickerUnselectable') ){
                    //console.log("#1: HIGH SEASON FIRST DAY");
                    //console.log(value);
                    startHighSeasonDay = true;
                }

            }
            else if (linear == "classic" && !firstSelection) {

                // td HIGH SEASON LAST DAY
                if ( $(this).hasClass('datepickerSpecial') && !$(this).hasClass('datepickerUnselectable') && startHighSeasonDay ){
                    //console.log("#2: HIGH SEASON LAST DAY");
                    //console.log(value);
                    $(this).addClass("datepickerDisabled");
                    endHighSeasonDay = true;
                }

                // td HIGHT SEASON FIRST DAY
                if ( $(this).hasClass('datepickerSpecial') && !$(this).hasClass('datepickerUnselectable') && !startHighSeasonDay && !endHighSeasonDay ){
                    //console.log("#2: HIGH SEASON FIRST DAY");
                    //console.log(value);
                    $(this).removeClass("datepickerDisabled");
                    startHighSeasonDay = true;
                }

            }

            // td BEFORE ARRIVAL
            if (!arrivalDay && firstSelection) {
                //console.log("#1: before ARRIVAL");
                $(this).addClass('datepickerUnselectable');
            }
            else if (!arrivalDay && !firstSelection && !endHighSeasonDay) {
                //console.log("#2: before ARRIVAL");
                $(this).removeClass('datepickerUnselectable');
            }

            // td AFTER ARRIVAL
            else {


                if (linear == "classic" && firstSelection) {
                    //console.log("#1: after ARRIVAL");
                    if (selectedDate < highSeasonStartDate && !endHighSeasonDay){
                        $(this).addClass('datepickerUnselectable');
                    }
                }
                else if (linear == "classic" && !firstSelection) {
                    //console.log("#2: after ARRIVAL");
                    if (selectedDate >= highSeasonEndDate && endHighSeasonDay){
                        $(this).addClass('datepickerUnselectable');
                    }
                }
                else if (linear == "mini") {
                    if (numWeek < numMiniWeeks){
                        numWeek++;
                        //console.log("after ARRIVAL");
                        $(this).addClass('datepickerUnselectable');
                    }
                }
            }

        }

    });

//    allDaysNotInMonthSelected.each(function(index, value){
//
//        if (arrivalDay && !firstSelection && departureDay) {
//            $(this).removeClass('datepickerSelected');
//
//        }
//    });

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


/****
 * GMAP FUNCIONS
 */
// global maps vars
var map,
    infowindow = null,
    proxMapLoaded = false,
    infoMapLoaded = false;

// global markers vars
var markerBleu = new google.maps.MarkerImage(templatePath+'images/vacancesdirectes/common/map/markerBleu.png',
    new google.maps.Size(21, 34),
    new google.maps.Point(0,0),
    new google.maps.Point(10, 34));
var markerVert = new google.maps.MarkerImage(templatePath+'images/vacancesdirectes/common/map/markerVert.png',
    new google.maps.Size(21, 34),
    new google.maps.Point(0,0),
    new google.maps.Point(10, 34));
var markerFushia = new google.maps.MarkerImage(templatePath+'images/vacancesdirectes/common/map/markerFushia.png',
    new google.maps.Size(21, 34),
    new google.maps.Point(0,0),
    new google.maps.Point(10, 34));
var shadow = new google.maps.MarkerImage(templatePath+'images/vacancesdirectes/common/map/shadow.png',
    new google.maps.Size(19, 17),
    new google.maps.Point(0,0),
    new google.maps.Point(0, 17));
var shape = {
    coord: [1, 1, 1, 20, 18, 20, 18 , 1],
    type: 'poly'
};

// global function maps
function setMarkers(map, mkrs) {
    for (var i = 0; i < mkrs.length; i++) {
        var mkr = mkrs[i];
        var siteLatLng = new google.maps.LatLng(mkr[1], mkr[2]);
        var marker = new google.maps.Marker({
            position: siteLatLng,
            map: map,
            shadow: shadow,
            icon: mkr[5],
            shape: shape,
            title: mkr[0],
            zIndex: mkr[3],
            idCamp: mkr[4]
        });

        if (marker.idCamp != ''){
            google.maps.event.addListener(marker, "click", function (e) {
                if(!this.content){ //1st click
                    $.ajax({
                        url: 'blocs/smallInfoBox.php?id='+this.idCamp,
                        success: function(response){
                            this.content = response;
                            ib.setContent(response);
                            ib.open(map, marker);
                        }
                    });
                }else{
                    ib.setContent(this.content);
                    ib.open(map, marker);
                }
            });

            // infobox vars
            var boxOptions = {
                content: ''
                ,disableAutoPan: false
                ,maxWidth: 0
                ,pixelOffset: new google.maps.Size(-152, -50)
                ,zIndex: null
                ,closeBoxMargin: "0px 0px 2px 2px"
                ,closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif"
                ,infoBoxClearance: new google.maps.Size(1, 1)
                ,alignBottom: true
                ,pane: "floatPane"
                ,enableEventPropagation: false
            };
            var ib = new InfoBox(boxOptions);
        }
    }
}

