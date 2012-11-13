/* Project: vd - Date: 20129012 - Author: C2iS.fr > NCH-LGU */

var
//datepicker
    startDate,
    endDate,
    highSeasonStartDate,
    highSeasonEndDate,
    firstSelection = true,
    firstRendering = true,
    startHighSeasonDay = false,
    endHighSeasonDay = false,
    arrivalDay = false,
    departureDay = false,
//resultCrit
    list = $('#results'),                                   //la liste a trier
    items = list.find('.itemResult'),                       //les items de cette liste
    itemsRanged = list.find('[data-ranged="true"]'),        //items dans la range de prix
    itemsFiltered = list.find('[data-filtered="true"]'),    //items repondants aux criteres
    minPrice,                                               //le prix minimum de la liste
    maxPrice,                                               //le prix maximum de la liste
    containerCrit = $('#formSearchRefined'),                //conteneur des criteres
    nbVisible = 10,                                         //nombre d'items visible avant pagination
    nbToShow = 5;                                           //nombre d'items a afficher si pagination existe


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

//navigation
//    var mylist = $('#campingsList')
//    var listitems = mylist.children('li').get();
//    listitems.sort(function(a, b) {
//        return $(a).text().toUpperCase().localeCompare($(b).text().toUpperCase());
//    })
//    $.each(listitems, function(idx, itm) { mylist.append(itm); });
    $('#campingsList').listnav({
        includeNums: false,
        includeOther: false,
//        prefixes: ["le","la","l'","un","une"],
        noMatchText: "Il n'existe aucun camping commençant par cette lettre."
    });


// footer
    // ajust borders height
    if($('#footerInfo').length){
        var maxHeight = 0;
        $('#footerInfo').children('div').each(function(index){
            if ($(this).height() > maxHeight){
                maxHeight = $(this).height();
            }
            if ($('#footerInfo').children('div').length == index+1){
                $('#infoMenu, #infoAbout').css('height',maxHeight);
            }
        });
    }

// datepicker
    if ($('#searchContainer #datepicker').length) {
        var d = new Date(),
            fCurrentDate = formatDate(d),
            currentDate = numDate(fCurrentDate),
            startDate = numDate(fStartDate),
            endDate = numDate(fEndDate),
            highSeasonStartDate = numDate(fHighSeasonStartDate),
            highSeasonEndDate = numDate(fHighSeasonEndDate),
            fSeasonDates = [fStartDate,fEndDate],
            fHighSeasonDates = [fHighSeasonStartDate,fHighSeasonEndDate],
            startDate = numDate(fStartDate),
            arrivalDate,
            departureDate,
            visibleMonths = 7,
            displayMonths = 5;

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

        $('#datepickerCalendar').DatePicker({
            flat: true,
            date: '',
            current: '2013/07/01',
            calendars: visibleMonths,
            mode: 'range',
            starts: 1,
            format:'Y/m/d',
            position: 'right',
            onChange: function(formated, dates){
                //console.log("################################## onChange:  ##################################");
                //console.log(formated);
                //console.log(dates);
                arrivalDate = dates[0];
                departureDate = dates[1];
                //console.log(arrivalDate);
                //console.log(departureDate);
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
                $('#datepickerInput').val('Du ' + selectedDates.join(' au '));
                $('#datepicker input.hidden').each(function(index, value){
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
        $('#datepickerField').bind('click', function(){
            $(this).toggleClass('opened');
            $(this).next('#datepickerCalendar').stop().animate({height: state ? 0 : $('#datepickerCalendar div.datepicker').get(0).offsetHeight}, 500);
            state = !state;
            return false;
        });
        $('#datepickerCalendar .bt').bind('click', function(){
            $('#datepickerCalendar').stop().animate({height: 0}, 500, function(){
                $('#datepickerField').removeClass('opened');
            });
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

            if (currentMonth >= visibleMonths - displayMonths || currentMonth <= 0){
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
        $('#AchatLineaire_isBasseSaison input[type="radio"][name="AchatLineaire[isBasseSaison]"]').bind('click', function(){
            //console.log("---------------------------------- CHANGE LINEAR  ----------------------------------");
            clearDatepicker();
            switchLinear();
        });
        $('#datepickerCalendar div.datepicker').css('position', 'absolute');
        $('#datepickerCalendar div.datepickerContainer').css('margin-left', '-180px');

        var preselectedFDates = new Array(),
            preselectedDates = new Array();
        if ( $("#AchatLineaire_dateDebut").val() != '' && $("#AchatLineaire_dateFin").val() != '' ) {
            $.each($('input.hidden'), function(i, item) {
                //console.log(item.value);

                var fDate = item.value.split("/").reverse().join('/');
                //console.log(fDate);
                preselectedFDates.push(fDate);
                preselectedDates.push(item.value);
            });
            //console.log(preselectedDates);
            $('#datepickerInput').val('Du ' + preselectedDates.join(' au '));
            $('#datepickerCalendar').DatePickerSetDate(preselectedFDates);
        }

        switchLinear();

    }

    if ($('#searchContainerReservation #datepicker').length) {
            var d = new Date(),
                fCurrentDate = formatDate(d),
                currentDate = numDate(fCurrentDate),
                startDate = numDate(fStartDate),
                endDate = numDate(fEndDate),
                arrivalDate,
                departureDate,
                visibleMonths = 7,
                displayMonths = 5;

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

            $('#datepickerCalendar').DatePicker({
                flat: true,
                date: '',
                current: '2013/07/01',
                calendars: visibleMonths,
                mode: 'range',
                starts: 1,
                format:'Y/m/d',
                position: 'right',
                onChange: function(formated, dates){
                    //console.log("################################## onChange:  ##################################");
                    //console.log(formated);
                    //console.log(dates);
                    arrivalDate = dates[0];
                    departureDate = dates[1];
                    //console.log(arrivalDate);
                    //console.log(departureDate);
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
                    $('#datepickerInput').val('Du ' + selectedDates.join(' au '));
                    $('#datepicker input.hidden').each(function(index, value){
                        $(this).val(selectedDates[index]);
                    });
                },
                onRender: function(date) {
        //            //console.log("################################## onRender:  ##################################");

                    var renderDate = date,
                        disabledDate,
                        renderWeekDay = renderDate.getDay(),
                        fRenderDate = formatDate(renderDate),
                        renderDate = numDate(fRenderDate);

        //            //console.log(renderDate);
        //            //console.log(startDate);
        //            //console.log(endDate);
        //            //console.log(renderWeekDay);

                        if ( (renderDate < startDate || renderDate > endDate) || renderWeekDay != 6 ){
        //                    //console.log("DISABLED: " + renderDate);
                            disabledDate = renderDate;
                        }

        //            //console.log(disabledDate);
                    return {
                        disabled: disabledDate != undefined,
                    }
                }
            });

            var state = false;
            $('#datepickerField').bind('click', function(){
                $(this).toggleClass('opened');
                $(this).next('#datepickerCalendar').stop().animate({height: state ? 0 : $('#datepickerCalendar div.datepicker').get(0).offsetHeight}, 500);
                state = !state;
                return false;
            });
            $('#datepickerCalendar .bt').bind('click', function(){
                $('#datepickerCalendar').stop().animate({height: 0}, 500, function(){
                    $('#datepickerField').removeClass('opened');
                });
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

                if (currentMonth >= visibleMonths - displayMonths || currentMonth <= 0){
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
            $('#datepickerCalendar div.datepicker').css('position', 'absolute');
            $('#datepickerCalendar div.datepickerContainer').css('margin-left', '-180px');

            var preselectedFDates = new Array(),
                preselectedDates = new Array();
            if ( $("#AchatLineaire_dateDebut").val() != '' && $("#AchatLineaire_dateFin").val() != '' ) {
                $.each($('input.hidden'), function(i, item) {
                    //console.log(item.value);

                    var fDate = item.value.split("/").reverse().join('/');
                    //console.log(fDate);
                    preselectedFDates.push(fDate);
                    preselectedDates.push(item.value);
                });
                //console.log(preselectedDates);
                $('#datepickerInput').val('Du ' + preselectedDates.join(' au '));
                $('#datepickerCalendar').DatePickerSetDate(preselectedFDates);
            }

            //console.log("################################## switchLinear()  ##################################");
             $('#searchContainer .searchBox').attr('id',linear);
             $('#AchatLineaire_isBasseSaison').attr('class','clear ' + linear);
             var titleText = "Recherche de linéaires";
             var infoText = "La période choisie doit inlure au minimum 1 semaine.";
             var legendText = "haute saison";

             $('#' + linear + ' #datepickerCalendar').find('.datepickerInfo').text(infoText);
             $('#' + linear + ' #datepickerCalendar').find('.datepickerLegend').text(legendText);
             firstRendering = true;

            //console.log("################################## initializeForbiddenDates()  ##################################");
            //console.log(firstRendering);
            var allSaturdays = $('#datepickerCalendar td.datepickerSaturday').not($('td.datepickerNotInMonth'));

            allSaturdays.removeClass('datepickerUnselectable');
            if (firstRendering){
               allSaturdays.each(function(index, value){
                   var td = $(this);
            //            //console.log(endHighSeasonDay);

                   if (linear == "reservation"){
                       var len = allSaturdays.length;
                       if (index >= len - numMinWeeks) {
                           td.addClass('datepickerUnselectable');
                       }

                   }
            //            //console.log(value);
               });
            }

        }

    if ($('#searchBlocDate #datepicker').length) {
        var d = new Date(),
            fCurrentDate = formatDate(d),
            currentDate = numDate(fCurrentDate),
            startDate = numDate(fStartDate),
            endDate = numDate(fEndDate),
            arrivalDate,
            departureDate,
            visibleMonths = 7,
            displayMonths = 2;

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

        $('#datepickerCalendar').DatePicker({
            flat: true,
            date: '',
            current: '2013/07/01',
            calendars: visibleMonths,
            mode: 'range',
            starts: 1,
            format:'Y/m/d',
            position: 'right',
            onChange: function(formated, dates){
                //console.log("################################## onChange:  ##################################");
                //console.log(formated);
                //console.log(dates);
                arrivalDate = dates[0];
                departureDate = dates[1];
                //console.log(arrivalDate);
                //console.log(departureDate);
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
                $('#datepickerInput').val('Du ' + selectedDates.join(' au '));
                $('#datepicker input.hidden').each(function(index, value){
                    $(this).val(selectedDates[index]);
                });
            },
            onRender: function(date) {
                //            //console.log("################################## onRender:  ##################################");

                var renderDate = date,
                    disabledDate,
                    renderWeekDay = renderDate.getDay(),
                    fRenderDate = formatDate(renderDate),
                    renderDate = numDate(fRenderDate);

                //            //console.log(renderDate);
                //            //console.log(startDate);
                //            //console.log(endDate);
                //            //console.log(renderWeekDay);

                if ( (renderDate < startDate || renderDate > endDate) || renderWeekDay != 6 ){
                    //                    //console.log("DISABLED: " + renderDate);
                    disabledDate = renderDate;
                }

                //            //console.log(disabledDate);
                return {
                    disabled: disabledDate != undefined,
                }
            }
        });

        var state = false;
        $('#datepickerField').bind('click', function(){
            $(this).toggleClass('opened');
            $(this).next('#datepickerCalendar').stop().animate({height: state ? 0 : $('#datepickerCalendar div.datepicker').get(0).offsetHeight}, 500);
            state = !state;
            return false;
        });
        $('#datepickerCalendar .bt').bind('click', function(){
            $('#datepickerCalendar').stop().animate({height: 0}, 500, function(){
                $('#datepickerField').removeClass('opened');
            });
            state = !state;
            return false;
        });

        var currentMonth = 0;
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

            if (currentMonth >= visibleMonths - displayMonths || currentMonth <= 0){
                currentButton.addClass('isFading').fadeOut(1000);
            }
            else {
                $('.datepicker>.datepickerGoPrev a, .datepicker>.datepickerGoNext a').removeClass('isFading').fadeIn(1000);
            }

            console.log(currentMonth);
            return false;
        });
        $('.datepickerGoPrev a, .datepickerGoNext a, .datepickerMonth a').bind('click', function(e){
            return false;
        });
        $('#datepickerCalendar div.datepicker').css('position', 'absolute');
        $('#datepickerCalendar div.datepickerContainer').css('margin-left', '-5px');
        $('.datepicker>.datepickerGoPrev a').hide();

        var preselectedFDates = new Array(),
            preselectedDates = new Array();
        if ( $("#AchatLineaire_dateDebut").val() != '' && $("#AchatLineaire_dateFin").val() != '' ) {
            $.each($('input.hidden'), function(i, item) {
                //console.log(item.value);

                var fDate = item.value.split("/").reverse().join('/');
                //console.log(fDate);
                preselectedFDates.push(fDate);
                preselectedDates.push(item.value);
            });
            //console.log(preselectedDates);
            $('#datepickerInput').val('Du ' + preselectedDates.join(' au '));
            $('#datepickerCalendar').DatePickerSetDate(preselectedFDates);
        }

        //console.log("################################## switchLinear()  ##################################");
        $('#searchContainer .searchBox').attr('id',linear);
        $('#AchatLineaire_isBasseSaison').attr('class','clear ' + linear);
        var titleText = "Recherche de linéaires";
        var infoText = "La période choisie doit inlure au minimum 1 semaine.";
        var legendText = "haute saison";

        $('#' + linear + ' #datepickerCalendar').find('.datepickerInfo').text(infoText);
        $('#' + linear + ' #datepickerCalendar').find('.datepickerLegend').text(legendText);
        firstRendering = true;

        //console.log("################################## initializeForbiddenDates()  ##################################");
        //console.log(firstRendering);
        var allSaturdays = $('#datepickerCalendar td.datepickerSaturday').not($('td.datepickerNotInMonth'));

        allSaturdays.removeClass('datepickerUnselectable');
        if (firstRendering){
            allSaturdays.each(function(index, value){
                var td = $(this);
                //            //console.log(endHighSeasonDay);

                if (linear == "reservation"){
                    var len = allSaturdays.length;
                    if (index >= len - numMinWeeks) {
                        td.addClass('datepickerUnselectable');
                    }

                }
                //            //console.log(value);
            });
        }

    }

    $('.sMultSelect').sMultSelect({msgNull: 'Pas de réponse'});
    /*$('.sMultSelectUl').wrap('<div class="tinyScroll" />').before('<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>')
        .wrap('<div class="viewport"><div class="overview"></div></div>');
    $('.tinyScroll').tinyscrollbar();*/

//init Gmap
    if ($('.gmap').length > 0) {
        //consoleLog('map');
        loadGmapScript();
    }

//init Search
    if ($('#searchBlocDate').length > 0) {
        countItem();
        $('#searchBlocDate').find('select').sSelect({ddMaxHeight: '300px'});
        switchSelect();
    }

    if ($('#results').length ){
        initCritResult();
    }
});

/*-- HEADREADY --*/
head.ready(function(){
    if ($('#searchContainer').length) {
        $('#searchText').height($('#searchForm').height());
    }
});

/*--  FUNCTIONS  --*/
function countItem() {
    console.log("################################## countItem()  ##################################");
    $('.spin-bt-down, .spin-bt-up').live('click', function(){
        var $button = $(this);
        var $input = $button.siblings(".spin-tb");
        var oldValue = $input.val();
        if ($button.hasClass('spin-bt-up')) {
            if (oldValue < 10) {
                var newVal = parseFloat(oldValue) + 1;
            }
            else {
                return false
            }
        }
        else {
            if ($input.attr('id') == 'SearchDate_nbAdultes' && oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
            }
            else if ($input.attr('id') == 'SearchDate_nbEnfants' && oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            }
            else {
                return false
            }
        }
        $input.val(newVal);
        return false;
    });
}
var selectNum = 0;
function switchSelect(){
    console.log("################################## switchSelect()  ##################################");
    $('.switchSelect').live('click', function(){
        selectNum = selectNum == 0 ? 1 : 0;
        var $button = $(this);
        var $selects = $button.parent().siblings(".newListSelected");
        console.log($selects);
        var $buttonTitle = selectNum == 0 ? 'Campings' : 'Lieux de séjour';
        $button.attr('title',$buttonTitle);
        if(selectNum) {
            $selects.eq(0).hide();
            $selects.eq(1).show();
        }
        else {
            $selects.eq(1).hide();
            $selects.eq(0).show();
        }
        return false;
    });
    $('#SearchDate_selectContainer2 .newListSelected').eq(1).hide();
}
function openIframePopin(url){
    $.colorbox({href: url, iframe:true, fixed: true, width:'80%', height:'80%', close:"&times;"});
}

/*-----------------------------------------------------------
 DATEPICKER
 -----------------------------------------------------------*/

// reset
function clearDatepicker() {
//    //console.log("################################## clearDatepicker()  ##################################");
    if (!firstSelection){$('#datepickerCalendar td.datepickerSaturday:not(.datepickerUnselectable, .datepickerNotInMonth):eq(0) a').trigger("click");}
    $('#datepickerCalendar').DatePickerClear().DatePickerClear();
    $('#datepicker input').val('');
}

function switchLinear() {
    //console.log("################################## switchLinear()  ##################################");
    var radioValue = $('#AchatLineaire_isBasseSaison input[type="radio"][name="AchatLineaire[isBasseSaison]"]:checked').attr('value') == 1 ? "mini" : "classic";
    $('#searchContainer .searchBox').attr('id',radioValue);
    $('#AchatLineaire_isBasseSaison').attr('class','clear ' + radioValue);
    var alreadyLinear = parseInt($('#AchatLineaire_isBasseSaison').attr('data-already-linear'));
    var titleText = alreadyLinear ? "Recherche de linéaires" : "Recherche de linéaires classiques";
    var infoText = radioValue == "classic" ? "La période choisie doit inclure les 8 semaines de la haute saison." : "La période choisie doit inclure un minimum de 6 semaines.";
    var legendText = "haute saison";
    //console.log(radioValue);
    //console.log(alreadyLinear);
    if (!alreadyLinear){
        $('#AchatLineaire_isBasseSaison').hide();
    }
    else {
        $('#' + radioValue).find('legend').text(titleText);
        $('#AchatLineaire_isBasseSaison').show();
    }
    $('#' + radioValue + ' #datepickerCalendar').find('.datepickerInfo').text(infoText);
    $('#' + radioValue + ' #datepickerCalendar').find('.datepickerLegend').text(legendText);
    linear = radioValue;
    firstRendering = true;
    initializeForbiddenDates();
}

function initializeForbiddenDates() {
    //console.log("################################## initializeForbiddenDates()  ##################################");
    //console.log(firstRendering);
    var allSaturdays = $('#datepickerCalendar td.datepickerSaturday').not($('td.datepickerNotInMonth'));
        startHighSeasonDay = false,
        endHighSeasonDay = false;
    allSaturdays.removeClass('datepickerUnselectable');
    if (firstRendering){
        allSaturdays.each(function(index, value){
            var td = $(this);
//            //console.log(endHighSeasonDay);
            defineHighSeason(td);
            if (endHighSeasonDay && linear == "classic"){
                td.addClass('datepickerUnselectable');
            }

            if (linear == "mini"){
                var len = allSaturdays.length;
                if (index >= len - numMinWeeks) {
                    td.addClass('datepickerUnselectable');
                }

            }
//            //console.log(value);
        });
    }


}

function unselectForbiddenDates(date){
    //console.log("################################## unselectForbiddenDates(dates)  ##################################");
    var selectedDate = numDate(formatDate(date)),
        numWeek = 0,
        allSaturdays = $('#datepickerCalendar td.datepickerSaturday').not($('td.datepickerNotInMonth'));
        startHighSeasonDay = false,
        endHighSeasonDay = false,
        arrivalDay = false,
        departureDay = false;

    allSaturdays.each(function(index, value){
        var td = $(this);
        defineHighSeason(td);

        // ARRIVAL DATE SELECTION
        if (linear == "classic" && firstSelection) {

            if (endHighSeasonDay){
                td.removeClass('datepickerUnselectable');
            }
            else {
                // td HIGH SEASON FIRST DAY
                if ( startHighSeasonDay ){
//                    //console.log("HIGH SEASON FIRST DAY");
                    td.addClass('datepickerUnselectable');
                }
                else {
                    td.addClass('datepickerUnselectable');
                }
            }
//            //console.log(value);
        }
        // DEPARTURE DATE SELECTION
        else if (linear == "classic" && !firstSelection) {

            if (endHighSeasonDay){
                td.addClass('datepickerUnselectable');
            }

            // td HIGH SEASON LAST DAY
            if ( endHighSeasonDay ){
//                //console.log("#2: HIGH SEASON LAST DAY");
                td.addClass("datepickerDisabled");
            }

            // td HIGH SEASON FIRST DAY
            if ( startHighSeasonDay ){
//                //console.log("#2: HIGH SEASON FIRST DAY");
                td.removeClass("datepickerDisabled");
            }

        }

        defineSelectedDates(td);

        // td BEFORE ARRIVAL
        if (!arrivalDay && firstSelection) {
            //console.log("#1: before ARRIVAL");
            td.addClass('datepickerUnselectable');
        }
        else if (!arrivalDay && !firstSelection && !endHighSeasonDay && linear == "clasic") {
            //console.log("#2: before ARRIVAL");
            td.removeClass('datepickerUnselectable');
        }
        else if (!firstSelection && linear == "mini") {
            //console.log("#2: before ARRIVAL");
            td.removeClass('datepickerUnselectable');
            var len = allSaturdays.length;
            if (index >= len - numMinWeeks) {
                td.addClass('datepickerUnselectable');
                //console.log(value);
            }
        }

        // td AFTER ARRIVAL
        else {

            if (linear == "classic" && firstSelection) {
                //console.log("#1: after ARRIVAL");
                if (selectedDate < highSeasonStartDate && !endHighSeasonDay){
                    td.addClass('datepickerUnselectable');
                }
            }
            else if (linear == "classic" && !firstSelection) {
                //console.log("#2: after ARRIVAL");
                if (selectedDate >= highSeasonEndDate && endHighSeasonDay){
                    td.addClass('datepickerUnselectable');
                }
            }
            else if (linear == "mini" && firstSelection) {
                //console.log(numWeek);
                //console.log(numMinWeeks);
                if (numWeek < numMinWeeks){
                    numWeek++;
                    //console.log("after ARRIVAL");
                    td.addClass('datepickerUnselectable');
                }
            }
        }

    });

}

function defineHighSeason(td) {
//    //console.log("################################## defineHighSeason()  ##################################");
    // td HIGH SEASON DEPARTURE DAY
    if ( startHighSeasonDay && td.hasClass('datepickerSpecial') && !td.hasClass('datepickerDisabled') ){
    //console.log("HIGH SEASON LAST DAY");
        endHighSeasonDay = true;
    }
    // td HIGH SEASON ARRIVAL DAY
    else if ( !startHighSeasonDay && td.hasClass('datepickerSpecial') && !td.hasClass('datepickerUnselectable') ){
    //console.log("HIGH SEASON FIRST DAY");
        startHighSeasonDay = true;
    }
}

function defineSelectedDates(td) {
//    //console.log("################################## defineSelectedDates()  ##################################");
    // td ARRIVAL
    if (td.hasClass('datepickerSelected') && firstSelection) {
        //console.log("#1: ARRIVAL DAY");
        td.addClass('arrival');
        arrivalDay = true;
    }
    // td DEPARTURE
    if (td.hasClass('datepickerSelected') && !firstSelection) {
        //console.log("#2: DEPARTURE DAY");
        td.addClass('departure');
        departureDay = true;
    }
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
    }
    $(tView).css({'position':'static'}).animate({'opacity':1}).siblings('.tabs').css({position:'absolute',opacity:'0'});
    if (!load){ $('html, body').animate({scrollTop: 0},0); }
}


/****
 * GMAP FUNCIONS
 */
var map,
    markerBleu,
    markerVert,
    markerFushia,
    shadow,
    shape,
    boxOptions,
    ib;

function loadGmapScript() { // call at the end of the DOM ready
    //consoleLog('map');
    var sGoogleApiKey = 'AIzaSyBaRlrfkxxMWr5zLkbCBJL21MnYNIYIm9I';
    var script = document.createElement("script");
    script.type = "text/javascript";
    script.src = "http://maps.googleapis.com/maps/api/js?key="+sGoogleApiKey+"&sensor=true&callback=loadPluginsGmap";
    document.body.appendChild(script);
}

function loadPluginsGmap() { // call after http://maps.googleapis.com/maps/api/js...
    var script = document.createElement("script");
    script.type = "text/javascript";
    script.src = templatePath+"js/vacancesdirectes/pluginGmap.js"; // call initializeAllGmap() at the end of pluginGmap.js (do a callback)
    document.body.appendChild(script);
}


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
                    var marker = this;

                    if(!marker.content){ //1st click
                        $.ajax({
                            url: this.idCamp,
                            success: function(response){
                                marker.content = response;
                                ib.setContent(response);
                                ib.open(map, marker);
                            }
                        });
                    }else{
                        ib.setContent(marker.content);
                        ib.open(map, marker);
                    }
                });
            }
        }
    }
function initializeAllGmap() {

    // infobox vars
    boxOptions = {
        /*content: ''
         ,*/disableAutoPan: false
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
    ib = new InfoBox(boxOptions);

    // global markers vars
    markerBleu = new google.maps.MarkerImage(templatePath+'images/vacancesdirectes/common/map/markerBleu.png',
        new google.maps.Size(21, 34),
        new google.maps.Point(0,0),
        new google.maps.Point(10, 34));
    markerVert = new google.maps.MarkerImage(templatePath+'images/vacancesdirectes/common/map/markerVert.png',
        new google.maps.Size(21, 34),
        new google.maps.Point(0,0),
        new google.maps.Point(10, 34));
    markerFushia = new google.maps.MarkerImage(templatePath+'images/vacancesdirectes/common/map/markerFushia.png',
        new google.maps.Size(21, 34),
        new google.maps.Point(0,0),
        new google.maps.Point(10, 34));
    shadow = new google.maps.MarkerImage(templatePath+'images/vacancesdirectes/common/map/shadow.png',
        new google.maps.Size(19, 17),
        new google.maps.Point(0,0),
        new google.maps.Point(0, 17));
    shape = {
        coord: [1, 1, 1, 20, 18, 20, 18 , 1],
        type: 'poly'
    };

    proxInit();
    infoInit();
}


/*** FONCTIONS RESULTATS DE RECHERCHE ***/
function initCritResult(){

//variables globales
    if ( $('.formSearchRefined').length ) {
        var nbCritChecked = $('#formSearchRefined input:checked').length;
        $('#nbCrit').text(nbCritChecked);
    }
    if ( $('#results').length ) {
        launchFilters();
    }

    $('.formSearchRefined .searchGlobalSubmit').click(function(e) {
        critSelection();
        displayResults();
        e.preventDefault();
    });

    $('#formSearchRefined input:checkbox').change(function() {
        var nbCritChecked = $('#formSearchRefined input:checked').length;
        $('#nbCrit').text(nbCritChecked);
    });
}

//launcher des filtres
function launchFilters() {

    console.log('/--- launchFilters ---/');

    items.attr('data-filtered', false);

    //attribution min/max pour le range slider
    findMinMaxRange();

    //creation du rangeSlider de prix
    rangeSliderPrice();

    //selection des criteres
    if ( containerCrit.find('input:checked').length ) {
        critSelection();
    }

}

//attribution min/max prix pour le range slider
function findMinMaxRange() {
    var allPrices = [];
    items.each(function() {
        var itemPrice = parseInt($(this).find('.itemResultBottom :checked + label .price').text());
        consoleLog(itemPrice);
        allPrices.push(itemPrice);
        $(this).attr('data-ranged', true);
    });

    //prix min
    Array.min = function(array) {
        return Math.min.apply(Math, array);
    };
    minPrice = Array.min(allPrices);

    //prix max
    Array.max = function(array) {
        return Math.max.apply(Math, array);
    };
    maxPrice = Array.max(allPrices);

    //items dans la range de prix
    items = list.find('[data-ranged="true"]');

    console.log('/--- findMinMaxRange ---/ minPrice = '+minPrice+' - maxPrice = '+maxPrice);
}

//creation du rangeSlider de prix
function rangeSliderPrice() {
    var $range = $("#noUiSlider"),
        minScale = minPrice,
        maxScale = maxPrice,
        minStart = minPrice,
        minStop = maxPrice;

    var initRange = function(){
        $range.empty().noUiSlider('init', {
            'scale'		:		[minScale,maxScale],
            'start'		:		[minStart,minStop],

            change: function(){
                var values = $(this).noUiSlider('value');
                $(this).find('.noUi-lowerHandle .rangeBox').text(values[0] + "€");
                $(this).find('.noUi-upperHandle .rangeBox').text(values[1] + "€");
            },
            end: function(type){
                var values = $(this).noUiSlider('value');
                valueMin = values[0];
                valueMax = values[1];

                items.each(function() {
                    var originPrice = parseInt($(this).find('.itemResultBottom :checked + label .price').text());

                    if ( parseInt(originPrice) >= parseInt(valueMin) && parseInt(originPrice) <= parseInt(valueMax) ) {
                        $(this).attr('data-ranged', true);
                    }else{
                        $(this).attr('data-ranged', false);
                    }
                });
                critSelection();
                displayResults();
                console.log('/--- rangeSliderPrice (event: change) ---/');
            }
        }).find('.noUi-handle div').each(function(index){
                $(this).append('<span class="rangeBox">'+$(this).parent().parent().noUiSlider( 'value' )[index]+'</span>');
            });
    };

    initRange.call();
}

//selection des criteres
function critSelection() {

    //init des tableaux
    var arrayCrit = [];         //tableau des criteres
    var arrayCritPlus = [];     //tableau des criteres cumulatifs

    //remplissage de arrayCrit
    $(containerCrit.find('.contentCrit input:checked')).each(function() {
        arrayCrit.push($(this).attr('id'));
    });

    //remplissage de arrayCritPlus (cumulatifs)
    $(containerCrit.find('.contentCritPlus input:checked')).each(function() {
        arrayCritPlus.push($(this).attr('id'));
    });
    consoleLog(arrayCrit);
    consoleLog(arrayCritPlus);

    //si aucun critere n'est selectionne
    if ( arrayCrit == 0 && arrayCritPlus == 0 ) {
        items.attr('data-filtered', true);
        console.log('aucun critere selectionne');
    }else{
        if ( arrayCrit == 0) {
            console.log('aucun critere selectionner dans arrayCrit');
        }else{
            //boucle de comparaison pour arrayCrit
            items.each(function() {
                console.log('-------------------- UN ITEM (crit) ----------------------');

                var itemToShow = $(this);

                //creation des tableau a comparer (avec les valeurs separer par des virgules)
                var dataCompareCrit = $(this).attr('data-crit').split(',');

                //comparaison des criteres
                jQuery.each(arrayCrit, function(i) {
                    if ( jQuery.inArray(arrayCrit[i], dataCompareCrit) > -1 ) {
                        console.log('critere present : '+this);
                        itemToShow.attr('data-filtered', true);
                        return false; //on sort de la boucle car au moins 1 critere est present
                    }else{
                        itemToShow.attr('data-filtered', false);
                    }
                });

            });
        }

        if ( arrayCritPlus == 0 ) {
            console.log('aucun critere selectionner dans arrayCritPlus');
        }else{
            //boucle de comparaison pour arrayCritPlus

            /*  if ( arrayCritPlus == 0 ) {
             itemsFiltered = items;
             }*/
            itemsFiltered.each(function() {
                console.log('-------------------- UN ITEM (critPlus) ----------------------');

                var itemToShow = $(this);

                //creation des tableau a comparer (avec les valeurs separer par des virgules)
                var dataCompareCritPlus = $(this).attr('data-critPlus').split(',');

                //comparaison des criteresPlus
                jQuery.each(arrayCritPlus, function(i) {
                    if ( jQuery.inArray(arrayCritPlus[i], dataCompareCritPlus) > -1 ) {
                        console.log('critere present : '+this);
                        itemToShow.attr('data-filtered', true);
                    }else{
                        itemToShow.attr('data-filtered', false);
                        console.log('criterePlus non present : '+this);
                        return false; //on sort de la boucle car au moins 1 critere n'est pas present
                    }
                });
            });
        }
    }

    console.log('/--- critSelection ---/');
}

//gestion de l'affichage en fonction des criteres + rangeSlider
function displayResults() {
    var nbItemsDisplayed = 0;

    items.each(function() {
        var dataRanged = $(this).attr('data-ranged');
        var dataFiltered = $(this).attr('data-filtered');

        if ( dataFiltered == 'true' && dataRanged == 'true' ) {
            $(this).fadeIn().next('.disclaim').fadeIn();
            nbItemsDisplayed++;
        }else{
            $(this).fadeOut().next('.disclaim').fadeOut();
        };
    });

    //mise a jour du nombre d'items affiches
    $('#nbListResultats').text(nbItemsDisplayed);

    console.log('/--- displayResults : '+nbItemsDisplayed+' ---/');
}
