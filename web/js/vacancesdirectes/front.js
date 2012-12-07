/* Project: vd - Date: 20129012 - Author: C2iS.fr > NCH-LGU */

var
//datepicker
    startDate,                                              // date de début de saison
    endDate,                                                // date de fin de saison
    highSeasonStartDate,                                    // date de début de haute saison
    highSeasonEndDate,                                      // date de fin de haute saison
    firstSelection = true,                                  // première sélection de dates dans le datepicker
    firstRendering = true,                                  // initialisation du datepicker
    startHighSeasonDay = false,                             // premier jour de la haute saison (lors du parcours de toutes les dates du datepicker)
    endHighSeasonDay = false,                               // dernier jour de la haute saison (lors du parcours de toutes les dates du datepicker)
    arrivalDay = false,                                     // date d'arrivée sélectionnée
    departureDay = false,                                   // date de départ sélectionnée
//switch select of search engine
    selectNum = 0,
//resultCrit
    list = $('#results'),                                   // la liste a trier
    items = list.find('.itemResult'),                       // les items de cette liste
    minPrice,                                               // le prix minimum de la liste
    maxPrice,                                               // le prix maximum de la liste
    containerCrit = $('#formSearchRefined'),                // conteneur des criteres
    nbVisible = 10,                                         // nombre d'items visible avant pagination
    nbToShow = 5,                                           // nombre d'items a afficher si pagination existe
//googlemap
    map,
    markerBleu,
    markerVert,
    markerFushia,
    shadow,
    shape,
    boxOptions,
    ib,
    aMarkers = [];


/*--  DOMREADY  --*/
$(function() {
// ScrollTop onload (mobile) si il n'y a pas d'ancre
    if (/mobile/i.test(navigator.userAgent) && !location.hash) {
        window.scrollTo(0, 1);
    }

// Test html5 form capacties andif do polyfills
    //if (!Modernizr.input.placeholder) { polyfillPlaceholder(); } // html5 placeholder

//
    $('.cover').css({backgroundSize: "cover"});

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
    /*
    $('#campingsList').listnav({
        includeNums: false,
        includeOther: false,
//        prefixes: ["le","la","l'","un","une"],
        noMatchText: "Il n'existe aucun camping commençant par cette lettre."
    });
    */


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

    /*
     *  ############################################################
     *                          HOME SLIDER
     * ############################################################
     */

    var direction;
    var pos;
    if ($('#slider').length){
        $("#slider").carouFredSel({
            auto: {
                play: false,
                delay: 5000,
                timeoutDuration: 5000,
                fx: "scroll",
                easing: "swing",
                onBefore: function(data) {
                    direction = "next";
                    beforeSlide(data);
                },
                onAfter	: function(data) {
                    afterSlide(data);
                }
            },
            direction:"up",
            items: {
                visible: 1
            },
            onCreate: function( data ) {
                redefineSliderButtons();
            },
            scroll: {

            },
            prev: {
                button: "#sliderPrev",
                fx: "scroll",
                easing: "swing",
                onBefore: function(data) {
                    direction = "prev";
                    beforeSlide(data);
                },
                onAfter	: function(data) {
                    afterSlide(data);
                }
            },
            next: {
                button: "#sliderNext",
                fx: "scroll",
                easing: "swing",
                onBefore: function(data) {
                    direction = "next";
                    beforeSlide(data);
                },
                onAfter	: function(data) {
                    afterSlide(data);
                }
            },
            pagination: {
                container: "#sliderPager",
                keys: true,
                fx: "scroll",
                easing: "swing",
                onBefore: function(data) {
                    direction = "page";
                    beforeSlide(data);
                },
                onAfter	: function(data) {
                    afterSlide(data);
                }
            }
    });
        var i = 1;
        $('#slider').children('li').each(function(){
            $(this).attr('data-slide', i);
            i++;
        });
        $('.sliderPhoto').eq(0).animate({
            rotate: '12deg'
        }, {queue: false, duration: 500});

    }

    function beforeSlide(e){
        //consoleLog(e);
        e.items.old.removeClass( "active" );
        if (direction ==  "page"){
            var newSlide = e.items.new.attr('data-slide');
            var oldSlide = e.items.old.attr('data-slide');
            if (newSlide > oldSlide){
                direction = "next";
            } else {
                direction = "prev";
            }
        }

//        $("#sliderPrev, #sliderNext").find('.content').fadeOut(100);
        $('#sliderPrev').animate({left:-125},100);
        $('#sliderNext').animate({right:-125},100);

        $('.sliderBackground').hide();
        $('#sliderBackground').show();
        $('.sliderStain').hide();
        pos = $("#slider").triggerHandler("currentPosition");
        if(direction == "next"){
            e.items.new.find('.sliderPostmark').hide();
            e.items.new.find('.sliderPhoto').show();
            e.items.old.find('.sliderPostmark').fadeOut(300);
            e.items.old.find('.sliderPhoto').fadeOut(500);

            e.items.old.find('.sliderPhoto').animate({
                rotate: '-54deg',
                scale: '0.5'
            }, {queue: false, duration: 500});
            e.items.new.find('.sliderPhoto').rotate('18deg'); // rotates to 0deg
            e.items.new.find('.sliderPhoto').scale('1'); // rotates to 0deg
            e.items.new.find('.sliderPostmark').fadeIn(3000);
        } else {
            e.items.new.find('.sliderPostmark').hide();
            e.items.new.find('.sliderPhoto').hide();
            e.items.new.find('.sliderPostmark').fadeIn(3000);
            e.items.new.find('.sliderPhoto').fadeIn(500);

            e.items.old.find('.sliderPhoto').rotate('12deg'); // rotates to 0deg
            e.items.old.find('.sliderPhoto').scale('01'); // rotates to 0deg
            e.items.new.find('.sliderPhoto').rotate('-108deg');
            e.items.new.find('.sliderPhoto').scale(0);
        }
    }

    function afterSlide(e){
        e.items.new.addClass( "active" );
        $('.sliderBackground').show();
        $('.sliderStain.first').stop().fadeIn(300);
        $('.sliderStain.second').delay(150).fadeIn(300);
        $('#sliderBackground').hide();

        e.items.old.find('.sliderPostmark').hide();
        e.items.old.find('.sliderPhoto').rotate('18deg'); // rotates to 0deg
        e.items.old.find('.sliderPhoto').scale(1); // scales to 100%
        e.items.new.find('.sliderPhoto').animate({
            rotate: '12deg',
            scale: '1'
        }, {queue: false, duration: 500});

        redefineSliderButtons();
    }

    function redefineSliderButtons(){

        //console.log(direction);

        var prevSlideTitle = $("#slider").children('li').last().find('.headline').clone();
        var nextSlideTitle = $("#slider").children('li').eq(1).find('.headline').clone();

        if ($("#slider").children('li').last().find('.sliderStain.second').length){
            var prevSlidePrice = $("#slider").children('li').last().find('.sliderStain.second').children(".content").clone();
            $('#sliderPrev').empty().append(prevSlidePrice).children('.content').prepend(prevSlideTitle);
        }
        else {
            $('#sliderPrev').empty().wrapInner('<div class="content" />').children('.content').prepend(prevSlideTitle);
        }
        if ($("#slider").children('li').eq(1).find('.sliderStain.second').length){
            var nextSlidePrice = $("#slider").children('li').eq(1).find('.sliderStain.second').children(".content").clone();
            $('#sliderNext').empty().append(nextSlidePrice).children('.content').prepend(nextSlideTitle);
        }
        else {
            $('#sliderNext').empty().wrapInner('<div class="content" />').children('.content').prepend(nextSlideTitle);
        }




        $("#sliderPrev").delay(300).animate({left:20},300);
        $("#sliderNext").delay(300).animate({right:20},300);
    }




    /*
     *  ############################################################
     *                          DATEPICKER
     * ############################################################
     */

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
                $('#datepicker input[type=hidden]').each(function(index, value){
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
            $(this).toggleClass('opened').next().toggleClass('opened');
            $(this).next('#datepickerCalendar').stop().css({height: state ? 0 : $('#datepickerCalendar div.datepicker').get(0).offsetHeight});
            state = !state;
            return false;
        });
        $('#datepickerCalendar .bt').bind('click', function(){
            $('#datepickerCalendar').stop().css({height: 0}, function(){
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
                    $('#datepicker input[type=hidden]').each(function(index, value){
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
                        disabled: disabledDate != undefined
                    }
                }
            });

            var state = false;
            $('#datepickerField').bind('click', function(){
                $(this).toggleClass('opened').next().toggleClass('opened');
                $(this).next('#datepickerCalendar').stop().css({height: state ? 0 : $('#datepickerCalendar div.datepicker').get(0).offsetHeight});
                state = !state;
                return false;
            });
            $('#datepickerCalendar .bt').bind('click', function(){
                $('#datepickerCalendar').stop().css({height: 0}, function(){
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
                $.each($('input[type=hidden]'), function(i, item) {
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
            startDate = numDate(fStartDate)
            arrivalDate
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
            mode: 'single',
            starts: 1,
            format:'Y/m/d',
            position: 'right',
            onChange: function(formated, dates){
                //console.log("################################## onChange:  ##################################");
                //console.log(formated);
                //console.log(dates);
                arrivalDate = dates;
                //console.log(arrivalDate);

                var selectedDate,
                    selectedDay;
                firstRendering = false;

                selectedDate = writeDate(arrivalDate);


//                unselectForbiddenDates(arrivalDate);
                firstSelection = false;

                //console.log(selectedDate);
                $('#datepickerInput').val('Du ' + selectedDate);
                $('#datepicker input[type=hidden]').eq(0).val(selectedDate);

                $('#datepickerField').trigger("click");
            },
            onRender: function(date) {
                //console.log("################################## onRender:  ##################################");

                var renderDate = date,
                    disabledDate,
                    renderWeekDay = renderDate.getDay(),
                    fRenderDate = formatDate(renderDate),
                    renderDate = numDate(fRenderDate);

                //            //console.log(renderDate);
                //            //console.log(startDate);
                //            //console.log(endDate);
                //            //console.log(renderWeekDay);

                if ( (renderDate < startDate || renderDate > endDate) || (renderWeekDay != 6 && renderWeekDay != 3) ){
                    //                    //console.log("DISABLED: " + renderDate);
                    disabledDate = renderDate;
                }

                //            //console.log(disabledDate);
                return {
                    disabled: disabledDate != undefined
                }
            }
        });

        var state = false;
        $('#datepickerField').bind('click', function(){
            $(this).toggleClass('opened').next().toggleClass('opened');
            $(this).next('#datepickerCalendar').stop().css({height: state ? 0 : $('#datepickerCalendar div.datepicker').get(0).offsetHeight});
            state = !state;
            return false;
        });
        $('#datepickerCalendar .bt').bind('click', function(){
            $('#datepickerCalendar').stop().css({height: 0}, function(){
                $('#datepickerField').removeClass('opened').next().removeClass('opened');
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

            //console.log(currentMonth);
            return false;
        });
        $('.datepickerGoPrev a, .datepickerGoNext a, .datepickerMonth a').bind('click', function(e){
            return false;
        });
        $('#datepickerCalendar div.datepicker').css('position', 'absolute');
        $('#datepickerCalendar div.datepickerContainer').css('margin-left', '-5px');
        $('.datepicker>.datepickerGoPrev a').hide();

        var preselectedFDate,
            preselectedDate;
        if ( $("#SearchDate_dateDebut").val() != '' ) {
            var fDate = $("#SearchDate_dateDebut").val().split("/").reverse().join('/');
            //console.log(preselectedDates);
            $('#datepickerInput').val($("#SearchDate_dateDebut").val());
            $('#datepickerCalendar').DatePickerSetDate(fDate);
        }


        //console.log("################################## switchLinear()  ##################################");
        $('#searchBlocDate .searchBox').attr('id',linear);

        firstRendering = true;

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
        toggleSearchCriteria();
    }

    if ($('#results').length ){
        initCritResult();
        $('.itemResultRight .bt').click( function(){
            $(this).next('.itemResultPopDest').fadeIn();
        });
        $('.itemResult').mouseleave( function(){
            $(this).find('.itemResultPopDest').fadeOut();
        });
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
    //console.log("################################## countItem()  ##################################");
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

function switchSelect(){
    //console.log("################################## switchSelect()  ##################################");
    if ($('#SearchDate_isCamping').attr('value')){
        selectNum = 1;
        var $button = $('.switchSelect');
        var $selects = $button.parent().siblings(".newListSelected");
        $('.switchSelect').css({backgroundPosition: "0 -270px"});
        $selects.eq(0).hide();
        $selects.eq(1).show();
    }
    $('.switchSelect').live('click', function(){
        selectNum = selectNum == 0 ? 1 : 0;
        var $button = $(this);
        var $selects = $button.parent().siblings(".newListSelected");
        //console.log($selects);
        var $buttonTitle = selectNum == 0 ? 'Campings' : 'Lieux de séjour';
        $button.children('span').text($buttonTitle);
//        $button.attr('title',$buttonTitle);
        if(selectNum) {
            $button.css({backgroundPosition: "0 -270px"});
            $selects.eq(0).hide();
            $selects.eq(1).show();
        }
        else {
            $button.css({backgroundPosition: "0 -54px"});
            $selects.eq(1).hide();
            $selects.eq(0).show();
        }
        $('#SearchDate_isCamping').val(selectNum);
        return false;
    });
    $('#SearchDate_selectContainer2 .newListSelected').eq(1).hide();
}

var toggleState = 0;
function toggleSearchCriteria(){
//    //console.log("################################## toggleSearchCriteria()  ##################################");
    $('.toggleButton').live('click', function(e){
//        //console.log("----------------- toggleSearchCriteria() CLICK -----------------");
        toggleState = toggleState == 0 ? 1 : 0;
        $(this).parents('#searchBloc').toggleClass('opened');
        e.preventDefault();
        var $button = $(this);
        var buttonText = $button.text().replace(toggleState == 0 ? '-' : '+',toggleState == 0 ? '+' : '-');
        $button.html(buttonText);
        var $container = $button.prev();
        $container.stop().toggle();
    });
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



/*
 *  ############################################################
 *                   FICHE CAMPING SLIDER
 * ############################################################
 */

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
function loadGmapScript() { // call at the end of the DOM ready
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
                idCamp: mkr[4],
                filters: mkr[6]
            });
            aMarkers.push(marker);

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

    if ($('#proxMap').length) {
        proxInit();
    }
    if ($('#infoMap').length) {
        infoInit();
    }
    if ($('#resultMap').length) {
        resultInit();
    }
    if ($('#destiMap').length) {
        destiInit();
    }
    if ($('#homeMap').length) {
        homeInit();
    }
}


/*** FONCTIONS RESULTATS DE RECHERCHE ***/
function initCritResult(){
// affichage carte
    if(window.location.hash === '#carte') {
        $('#btMap').addClass('active').siblings('button').removeClass('active');
        $('#resultMap').addClass('active');
    }
    $('.typeAff').find('button').click( function(){
        $(this).addClass('active').siblings('button').removeClass('active');
        if ( $(this).attr('id') == 'btMap' ) {
            $('#resultMap').addClass('active');
        } else {
            $('#resultMap').removeClass('active');
        }
    });

// change on click
    $('.itemResult .linePrice :radio').change( function(){
        var oCheck = $(this);
        oCheck.parents('.linePrice').addClass('checked').siblings().removeClass('checked');
    });

    $('.formSearchRefined .searchGlobalSubmit').click(function(e) {
        critSelection();
        displayResults();
        e.preventDefault();
    });

    $('#formSearchRefined input:checkbox').change(function() {
        var nbCritChecked = $('#formSearchRefined input:checked').length;
        $('#nbCrit').text(nbCritChecked);
    });

    if ( $('.formSearchRefined').length ) {
        var nbCritChecked = $('#formSearchRefined input:checked').length;
        $('#nbCrit').text(nbCritChecked);
    }
    if ( $('#results').length ) {
        launchFilters();
    }

    $('#btPlusResults').click( function() {
        var nextItems = $('#results .nextItem');

        if ( nextItems.length <= nbToShow ) {
            $('#results .nextItem').fadeIn().removeClass('nextItem');
            //nextItems.fadeIn().removeClass('nextItem');
            $(tthis).hide();
        }else if ( nextItems.length > nbToShow ) {
            var nbDisclaim = 0;

            $('#results .nextItem:lt('+nbToShow+')').each(function() {
                if ( $(this).hasClass('disclaim') ) {
                    nbDisclaim++;
                };
            });
            nbToShow = nbToShow+nbDisclaim;
            //console.log('nbDisclaim = ' +nbDisclaim+' et nbToShow = '+nbToShow);

            $('#results .nextItem:lt('+nbToShow+')').fadeIn().removeClass('nextItem');
        }
        //console.log('/--- listPagination : affichage des '+nbToShow+' items suivants ---/');
    });
}

//launcher des filtres
function launchFilters() {
    openCrit();
    items.attr('data-filtered', false);

    //init du nombre de resultats
    var nbResultsItems = items.length;
    $('.nbResult .nb').text(nbResultsItems);

    //identification des items pour le tri par pertinence
    items.each(function(i) {
        $(this).attr('data-pertinenceID', i);
    });

    //attribution min/max pour le range slider
    findMinMaxRange();

    //creation du rangeSlider de prix
    rangeSliderPrice();

    //selection des criteres
    if ( containerCrit.find('input:checked').length ) {
        critSelection();
    };

    //gestion du tri par prix ou pertinence
    orderList();

    //Pagination de la liste de resultats
    listPagination();
}
function openCrit() {
    $('.formSearchRefined .sectionTitle').click(function() {
        $(this).toggleClass('open').next('fieldset').fadeToggle();
    });
}

//attribution min/max prix pour le range slider
function findMinMaxRange() {
    var allPrices = [];
    items.each(function() {
        $(this).find('.linePrice').each( function(){
            var itemPrice = parseInt($(this).find('.stain .price').text());
            allPrices.push(itemPrice);
        });
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

    //console.log('/--- findMinMaxRange ---/ minPrice = '+minPrice+' - maxPrice = '+maxPrice);
}

//creation du rangeSlider de prix
function rangeSliderPrice() {
    var $range = $("#noUiSlider"),
        minScale = minPrice-20,
        maxScale = maxPrice+20,
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
                    $(this).find('.linePrice').each( function(){
                        var originPriceLine = parseInt($(this).find('.stain .price').text());
                        if ( parseInt(originPriceLine) >= parseInt(valueMin) && parseInt(originPriceLine) <= parseInt(valueMax) ) {
                            $(this).addClass('visiblePrice').fadeIn();
                        }else{
                            $(this).removeClass('visiblePrice').fadeOut();
                        }
                    });

                    //$(this).find('.visiblePrice').eq(0).find('label').trigger('focus');
                    var oCheck = $(this).find('.visiblePrice').eq(0).find(':radio');
                    oCheck.attr('checked', "checked");
                    oCheck.parents('.linePrice').addClass('checked').siblings().removeClass('checked');


                    var nbVisiblePrice = $(this).find('.visiblePrice').length;
                    //consoleLog(nbVisiblePrice);
                    if ( nbVisiblePrice > 0 ) {
                        $(this).attr('data-ranged', true);
                    }else{
                        $(this).attr('data-ranged', false);
                    }
                });
                critSelection();
                displayResults();
                //console.log('/--- rangeSliderPrice (event: change) ---/');
            }
        }).find('.noUi-handle div').each(function(index){
            $(this).append('<span class="rangeBox">'+$(this).parent().parent().noUiSlider( 'value' )[index]+' €</span>');
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

    //si aucun critere n'est selectionne
    if ( arrayCrit == 0 && arrayCritPlus == 0 ) {
        items.attr('data-filtered', true);
        items.attr('data-filteredPlus', true);
        //console.log('aucun critere selectionne');
    }else{
        if ( arrayCrit == 0) {
            items.attr('data-filtered', true);
            items.attr('data-filteredPlus', true);
            //console.log('aucun critere selectionner dans arrayCrit');
        }else{
            //boucle de comparaison pour arrayCrit
            items.each(function() {
                //console.log('-------------------- UN ITEM (crit) ----------------------');

                var itemToShow = $(this);

                //creation des tableau a comparer (avec les valeurs separer par des virgules)
                var dataCompareCrit = $(this).attr('data-crit').split(',');

                //comparaison des criteres
                jQuery.each(arrayCrit, function(i) {
                    if ( jQuery.inArray(arrayCrit[i], dataCompareCrit) > -1 ) {
                        //console.log('critere present : '+this);
                        itemToShow.attr('data-filtered', true);
                        return false; //on sort de la boucle car au moins 1 critere est present
                    }else{
                        itemToShow.attr('data-filtered', false);
                    };
                });

            });
        };

        if ( arrayCritPlus == 0 ) {
            items.attr('data-filteredPlus', true);
            //console.log('aucun critere selectionner dans arrayCritPlus');
        }else{
            //boucle de comparaison pour arrayCritPlus
            items.each(function() {
                //console.log('-------------------- UN ITEM (critPlus) ----------------------');

                var itemToShow = $(this);

                //creation des tableau a comparer (avec les valeurs separer par des virgules)
                var dataCompareCritPlus = $(this).attr('data-critPlus').split(',');

                //comparaison des criteresPlus
                jQuery.each(arrayCritPlus, function(i) {
                    if ( jQuery.inArray(arrayCritPlus[i], dataCompareCritPlus) > -1 ) {
                        itemToShow.attr('data-filteredPlus', true);
                    }else{
                        itemToShow.attr('data-filteredPlus', false);
                        //console.log('criterePlus non present : '+this);
                        return false; //on sort de la boucle car au moins 1 critere n'est pas present
                    };
                });
            });
        }
    };

    //console.log('/--- critSelection ---/');
};

//gestion de l'affichage en fonction des criteres + rangeSlider
function displayResults() {
    var nbItemsDisplayed = 0;
    var gMarkers = [];

    items.each(function() {
        var dataRanged = $(this).attr('data-ranged');
        var dataFiltered = $(this).attr('data-filtered');
        var dataFilteredPlus = $(this).attr('data-filteredPlus');

        if ( dataFiltered == 'true' && dataFilteredPlus == 'true' && dataRanged == 'true' ) {
            $(this).fadeIn().next('.disclaim').fadeIn();
            nbItemsDisplayed++;
            var idRsl = $(this).attr('data-id');
            gMarkers.push(idRsl);
        }else{
            $(this).fadeOut().next('.disclaim').fadeOut();
        };

        for ( var i in aMarkers ){
            var marker = aMarkers[i];
            marker.setVisible( $.inArray(marker.idCamp, gMarkers) != -1 ? true : false );
            //consoleLog($.inArray(theme, marker.filters));
            //consoleLog(marker.filters);
        }

    });

    /*$('#mapFilters').find('a')
        .click( function(){
            var theme = this.id;
            //consoleLog(theme);
            for ( var i in aMarkers ){
                var marker = aMarkers[i];
                marker.setVisible( $.inArray(theme, marker.filters) != -1 ? true : false );
                //consoleLog($.inArray(theme, marker.filters));
                //consoleLog(marker.filters);
            }
            $(this).addClass('active').parents('li').siblings('li').children('a').removeClass('active');
            ib.close();
            return false;
        })
        .eq(0).trigger('click');*/

    //gestion de la pagination
    listPagination();

    //mise a jour du nombre d'items affiches
    $('.nbResult .nb').text(nbItemsDisplayed);

    //console.log('/--- displayResults : '+nbItemsDisplayed+' ---/');
};


//gestion du tri par prix ou pertinence
function orderList() {

    $('#results .itemResult .priceFilter').each(function() {
        var thisPrice = parseInt($(this).text());
        $(this).attr('data-prix', thisPrice);
    });

    $('#selectFilter').change(function() {
        var orderType = $('option:selected', this).attr('name');

        switch (orderType) {
            case 'prix_asc' :
                $('#results li.itemResult').tsort('.priceBox .priceFilter', {
                    data: 'prix',
                    order: 'asc'
                });
                //console.log('Cas 1 : prix_asc');
                break;

            case 'prix_desc' :
                $('#results li.itemResult').tsort('.priceBox .priceFilter', {
                    data: 'prix',
                    order: 'desc'
                });
                //console.log('Cas 2 : prix_desc');
                break;
            case 'pertinence' :
                $('#results li.itemResult').tsort({
                    data: 'pertinenceid',
                    order: 'asc'
                });
                //console.log('Cas 2 : pertinence');
                break;
        }

        //on cache les pubs
        $('#results .disclaim').hide();
        //console.log('/--- orderList : Change event ---/');
        return false;
    });
    //console.log('/--- orderList ---/');
};

//pagination liste de resultats
function listPagination() {
    var itemsPagination = $('#results .itemResult');
    var nbResults = itemsPagination.length;
    var btNext = $('#btPlusResults');

    //console.log('nb pagination : '+nbResults);

    if ( nbResults > nbVisible ) {
        $('#btPlusResults').show();

        itemsPagination.each(function(i) {
            $(this).attr('data-num', i);
            if ( $(this).attr('data-num') < nbVisible ) {
                $(this).show();
            }else{
                $(this).hide().addClass('nextItem').next('.disclaim').addClass('nextItem').hide();
            }
        })
        //console.log('/--- listPagination : superieur a '+nbVisible+' ---/');
    }else{
        btNext.hide();
        //console.log('/--- listPagination : inferieur a '+nbVisible+' ---/');
    };


    //contre-propositions
    //contreProp();
};

//contre propositions
/*
function contreProp() {
    var nbContreProp = 0;

    //on compte le nombre de contre-proposition
    items.each(function() {
        if ( $(this).hasClass('isContrePro') ) {
            nbContreProp++;
        };
    });

    if (nbContreProp == 0) {
        $('.contreProp').hide();
    }else{
        $('.contreProp').show();
    };
    //console.log('/--- contreProp ---/');
};*/
