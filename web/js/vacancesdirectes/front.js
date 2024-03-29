/* Project: vd - Date: 20129012 - Author: C2iS.fr > NCH-LGU */

var
//home slider
    direction,
    pos,
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
    firstTime = true,
    list = $('#results'),                                   // la liste a trier
    items = list.find('.itemResult'),                       // les items de cette liste
    minPrice,                                               // le prix minimum de la liste
    maxPrice,                                               // le prix maximum de la liste
    containerCrit = $('#formSearchRefined'),                // conteneur des criteres
    nbToShow = 5,                                           // nombre d'items a afficher si pagination existe
    nbItemsDisplayed = '',
    resultFrom,
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

if(nbVisible == undefined) {
    var nbVisible = 10;                                      // nombre d'items visible avant pagination
}

/*
 *  //////////////////////////////////////////////////////////////////////////////////////////////////////////
 *                                              DOM ready
 * ///////////////////////////////////////////////////////////////////////////////////////////////////////////
 */
$(function() {
// Extend jQuery.fn with our new method
jQuery.extend( jQuery.fn, {
    // Name of our method & one argument (the parent selector)
    hasParent: function(p) {
        // Returns a subset of items using jQuery.filter
        return this.filter(function(){
            // Return truthy/falsey based on presence in parent
            return $(p).find(this).length;
        });
    }
});

// ScrollTop onload (mobile) si il n'y a pas d'ancre
    if (/mobile/i.test(navigator.userAgent) && !location.hash) {
        window.scrollTo(0, 1);
    }

// Test html5 form capacties andif do polyfills
    if (!Modernizr.input.placeholder) { polyfillPlaceholder(); } // html5 placeholder

// Cover IE
    $('.banner').find('.cover').css({backgroundSize: "cover"});
    $('.bgImg').find('.cover').css({backgroundSize: "cover"});

// Gestion du click sur le parent
    if ($('.linkParent').length > 0) { addLinkBlock(); }

// init Sliders
    if ($('.tabCampDiapo .slider').length > 0) { makeSlider(); }
    if ($('#tabSurplace .slider').length > 0) { sliderActivite(); }



// init tabs navigation
    if ($('.tabControls').length > 0) {
        var oHash = window.location.hash,
            oTabControls = $('.tabControls'),
            oTabs = $('.tabs'),
            oTabLink = oTabControls.find('a'),
            tView = oTabControls.find('a.active').attr('href');

        oTabs.css({position:'absolute',left:'-999em', top:'-999em'});
        if (oHash.substring(1,4) == 'tab') {
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

    if ($('form.filterBy').length > 0) {
        var oForm = $('form.filterBy');
        oForm.find('select').change( function(){
            var sVal1 = $(this).val();
            var nbTypes = $('.typLocation').length;
            var nbCampings = $('.itemResult').length;
            var btnMoreResults = $('#btPlusResults');
            var hasMoreResults = btnMoreResults.length > 0;
            var nbSetVisible = 0;

            if (nbTypes) {
                var siblingSelect = $(this).siblings('select');
                var sVal2 = siblingSelect.length > 0 ? siblingSelect.val() : '';

                $('.typLocation').each( function() {
                    $(this).removeClass('nextItem');

                    if (
                        (sVal1 == "" && sVal2 == "") ||
                        (sVal1 == "" && $(this).hasClass(sVal2)) ||
                        (sVal2 == "" && $(this).hasClass(sVal1)) ||
                        ($(this).hasClass(sVal1) && $(this).hasClass(sVal2))
                    ) {
                        if (!hasMoreResults || nbSetVisible < nbToShow) {
                            $(this).fadeIn();
                            nbSetVisible ++;
                        } else {
                            $(this).addClass('nextItem');
                        }
                    } else {
                        $(this).hide();
                    }
                });

                if ($('.typLocation').not(':visible').length >= nbTypes) {
                    $('.noResultTyp').fadeIn();
                }else{
                    $('.noResultTyp').fadeOut();
                }
            } else if (nbCampings) {
                $('.itemResult').each(function() {
                    if (sVal1 == '' || $(this).hasClass(sVal1)) {
                        if (!hasMoreResults || nbSetVisible < nbToShow) {
                            $(this).fadeIn();
                            nbSetVisible ++;
                        } else {
                            $(this).addClass('nextItem');
                        }
                    } else {
                        $(this).hide();
                    }
                });
            }

            if (hasMoreResults && $('.nextItem').length > 0) {
                btnMoreResults.show();
            } else if (hasMoreResults) {
                btnMoreResults.hide();
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
    if ( window.location.hash.length ) {
        scrollToHash(window.location.hash);
    }
    $('.goto').click(function(e) {
        e.preventDefault();
        scrollToHash(this.hash);
        return false;
    });

    function scrollToHash(hash){
        if (hash.match("^#dateCrit")){
            $('select#TopFilter_bon_plans')
                .val(hash)
                .trigger('change');
        }
        if ( $('*[id='+hash.substring(1)+']').length == 0 ){
            return false;
        }
        var oAnchor = hash;
        var targetOffset = $(oAnchor).offset().top;
        var bodyelem;
        var clicked = false;
        var opened = false;
        if ($('#datepickerCalendar.opened').length){
            opened = true;
        }
        if($.browser.safari) bodyelem = $("body")
        else bodyelem = $('html,body');
        bodyelem.animate({scrollTop: targetOffset-10},400,function(){
            if ( oAnchor ==  "#searchBloc" && !clicked && !opened ){
                setTimeout(function() {
                    $('#datepickerField').trigger('click');
                }, 300);
                clicked = true;
            }
        });
    }

// popins
    $(".popinIframe").colorbox({iframe:true, width:'80%', height:'80%', close:"&times;"});
	$(".popinIframeMDP").colorbox({iframe:true, width:'320px', height:'280px', close:"&times;"});
    $(".popinVideo").colorbox({iframe:true, innerWidth:960, innerHeight:540, close:"&times;"});
    //$(".popin360").colorbox();
    $(".popinInline").colorbox({inline:true, width:"75%"});
    $(".popinBP").colorbox({
        inline:true,
        width:"300px",
        close:"&times;",
        onOpen: function(){
            $("#colorbox").addClass("cbBP");
        }
    });


    /*
     *  ############################################################
     *                          HEADER
     * ############################################################
     */

     if ( $('#accountBox').length ) {
         $('#accountBox').css({
             opacity: 1
         }).hide();
         $('#account').click(function(e){
            $(this).next().toggle();
            setZIndex();
         });
         $(document).mousedown(function (e){
             if ( $('#accountBox').has(e.target).length == 0 ){
                 $('#header').css({zIndex:20});
                 $('#accountBox').hide();
             }
         });

         if ( $('#accountBox').find('.errors').css('display') == 'block' ){
             $('#accountBox').show();
             setZIndex();
         }

         $('#username').keypress(function(e) {
             if(e.which == 32) {
                 e.preventDefault();
             }
         });
         $('#accountBox button[type="submit"]').click(function(e) {
             $('#username').val( $('#username').val().replace(/ /g,''));
         });

     }

    function setZIndex(){
        if ( $('#accountBox').is(':visible') ){
            $('#header').css({zIndex:21});

            //Focus champ de connexion
            if ($('#username').length > 0) { $("#username").focus(); }
        }
        else {
            $('#header').css({zIndex:20});
        }
    }

    /*
     *  ############################################################
     *                        NAVIGATION MENU
     * ############################################################
     */

    if ($('#nav').find('.subnav').length > 0){
        var currentLi,
            hoverLi,
            outLi,
            previousHoverLi,
            openTab,
            delayToCloseTab;
        $('#nav .tab').hover(
            function(){
                //console.log("################ OVER ################");
                hoverLi = $(this);
                //console.log($(this).index());

                hoverLi.siblings().each(function(i,v){
                    //console.log( $(this));
                    if ( $(this).hasClass('hover') ){
                        openTab = true;
                        previousHoverLi = $(this);
                    }
                });

                if ( openTab ){
                    //console.log("openTab = TRUE");
                    clearTimeout(delayToCloseTab);
                    if ( previousHoverLi != undefined){
                        previousHoverLi.removeClass('hover').children('.subnav').hide();
                        addBorders(previousHoverLi);
                    }
                }
                else {
                    //console.log("openTab = FALSE");
                }

                hoverLi.siblings().andSelf().each(function(i,v){
                    if( $(this).hasClass('current') ){
                        currentLi = $(this);
                        currentLi.removeClass('current');
                        addBorders(currentLi);
                    }
                })
                hoverLi.addClass('hover').children('.subnav').show();
                if (hoverLi.children('.subnav').is('#deals')){
                    var minContentHeight = $('#dealsMenu').height() + parseInt($('#dealsMenu').css('margin-bottom')) - parseInt($('#dealsContent').children().css('margin-top')) - parseInt($('#dealsContent').children().css('margin-bottom'));
                    $('#dealsContent').children().css({
                        minHeight: minContentHeight
                    });
                }
                removeBorders(hoverLi);
                openTab = true;
            },
            function(){
                //console.log("################ OUT ################");
                outLi = $(this);
                //console.log($(this).index());

                delayToCloseTab = setTimeout(function()
                {
                    outLi.removeClass('hover').children('.subnav').hide();
                    addBorders(outLi);
                    if ( currentLi != undefined ){
                        currentLi.addClass('current');
                        removeBorders(currentLi);
                    }
                    openTab = false;
                }, 200);

            }
        );

        if ( $('#nav .topnav').children('.current').length){
            currentLi = $('#nav .topnav').children('.current');
            removeBorders(currentLi);
        }

        $('#dealsMenu .bp').click(function(){
            //console.log( parseInt($(this).index() + 1));
            $(this).addClass('selected').siblings().removeClass('selected');
            $('#dealsContent').children().hide();
            $('#dealsContent').children('#bp' + parseInt($(this).index() + 1)).show();
        });

        // ajust borders height
        if($('#destinations').length){
            $('#destinations').show();
            var maxHeight = 0;
            $('#destinationsCountry').children('.radiusBox2').each(function(index){
                if ($(this).hasClass('international')){
                    if ($(this).outerHeight() > maxHeight){
                        maxHeight = $(this).outerHeight();
                    }
                    if ($('#destinationsCountry').children('.radiusBox2').length == index+1){
                        $('#destinationsCountry .international').css('height',maxHeight);
                        var destinationsCountryHeight = $('#destinationsCountry').height();
                        $('#destinationsAll ol').height(destinationsCountryHeight - 90);
                        $('#destinations').hide();
                    }
                }
//                else  if ($(this).hasClass('national')){
//                    var numRegions = $('#destinationsCountry .national .region').length;
//                    var penultimateRegion = numRegions - 2;
//                    //console.log(numRegions);
//                    $('#destinationsCountry .national .region').eq(penultimateRegion).filter(':even').children('ul').css({
//                        border: "none"
//                    });
//                }
            });
        }

        if($('#holiday').length && !$('body').hasClass('ie-lte8')){
            $('#holiday').show();
            $("#holidayGallery .polaroid a").each( function(i,v) {
                var rNum = (Math.random()*10)*4;
                if (i % 3 != 0){
                    $(this).rotate(rNum+'deg');
                }
                else{
                    $(this).rotate(-rNum+'deg');
                }
//                $('#holidayGallery .polaroid:nth-child(4n + 1)').css({border:"1px solid red"});
//                $('#holidayGallery .polaroid:nth-child(4n + 2)').css({border:"1px solid green"});
//                $('#holidayGallery .polaroid:nth-child(4n + 3)').css({border:"1px solid yellow"});
//                $('#holidayGallery .polaroid:nth-child(4n)').css({border:"1px solid blue"});
                var x=$(this).parent().position().left;
                var y=$(this).parent().position().top;
                //console.log($(this).parent().position());
                if(y<100 && x<400){
                    $(this).css({top:"+30px",bottom:"-30px"});
                }
                else if(y>200){
                    $(this).css({top:"-30px",bottom:"+30px"});
                }
                if(x<100){
                    $(this).css({left:"+60px",right:"-60px"});
                }
                else if(x<250){
                    $(this).css({left:"+30px",right:"-30px"});
                }
                else if(x<400){
                    $(this).css({left:"-30px",right:"+30px"});
                }
                else if(x>550){
                    $(this).css({left:"-60px",right:"+60px"});
                }
                if(y>100 && 400){
                    $(this).css({left:"0px",right:"0px"});
                }
            });
            var currentDeg;
            var currentZIndex = 0;
            $("#holidayGallery .polaroid a").hover(function(e){
                currentDeg = $(this).rotate();
                currentZIndex++;
                //console.log(currentDeg);

                $(this).css({zIndex:currentZIndex}).animate({
                    rotate: '0deg'
                }, {queue: false, duration: 500});
            },
            function(e){
                $(this).animate({
                    rotate: currentDeg
                }, {queue: false, duration: 500});
            });
            $('#holiday').hide();
        }

    }


    /*
     *  ############################################################
     *                          HOME SLIDER
     * ############################################################
     */

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

        /*
         $('#sliderPrev').hover(
         function () {
         $(this).addClass("hover").animate({
         left: "-=5px"
         },200);
         },
         function () {
         $(this).removeClass("hover").animate({
         left: "+=5px"
         },200);
         }
         );
         $('#sliderNext').hover(
         function () {
         $(this).addClass("hover").animate({
         right: "-=5px"
         },200);
         },
         function () {
         $(this).removeClass("hover").animate({
         right: "+=5px"
         },200);
         }
         );

         $('.slide').mouseover(function(){
         $(this).addClass("hover").find('.sliderPhoto').stop().animate({rotate: '-6deg', scale: '1.1'}, 500);
         }).mouseout(function(){
         $(this).removeClass("hover").find('.sliderPhoto').stop().animate({rotate: '12deg', scale: '1'}, 500);
         });
         */

    }


    /*
     *  ############################################################
     *                          FORMS
     * ############################################################
     */

    // selects
    $('#searchForm').find('select').not('.sMultSelect').sSelect({ddMaxHeight: '300px'});
    $('#annulationForm').find('select').sSelect({ddMaxHeight: '300px'});

    $('.sMultSelect').sMultSelect({msgNull: 'Pas de réponse'});
    /*$('.sMultSelectUl').wrap('<div class="tinyScroll" />').before('<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>')
     .wrap('<div class="viewport"><div class="overview"></div></div>');
     $('.tinyScroll').tinyscrollbar();*/

    // toggle
    if($('.toggleContainer').length > 0){
        $('.toggleContainer > .toggleItem').each(function(i,v){
            $(this).children('.toggleArrow').rotate('90deg');
        });
        $('.toggleItem').click(function(e){
            var togglingItem = $(this);
            togglingItem.siblings().filter(function(i){
                return $(this).hasClass('active');
            }).trigger('click');
            if (!togglingItem.hasClass('active')){
                var alreadyToggledItem = $('.primary .toggleItem.active')
                alreadyToggledItem.next('.toggleContent').hide();
                alreadyToggledItem.removeClass('active').children('.toggleArrow').rotate('0deg');
            }
            togglingItem.toggleClass('active').next('.toggleContent').slideToggle(500, function(){
                if (togglingItem.hasClass('active')){
                    var toggleActiveItemOffset = togglingItem.offset().top - 9;
                    $('html, body').animate({scrollTop: toggleActiveItemOffset},400);
                }
            });
            if (togglingItem.parent('.toggleContainer').length){
                if (togglingItem.hasClass('active')){
                    togglingItem.children('.toggleArrow').animate({rotate: '-=180deg'}, 500);
                }
                else {
                    togglingItem.children('.toggleArrow').animate({rotate: '+=180deg'}, 500);
                }
            }
            else if (togglingItem.parent('.primary').length){
                if (togglingItem.hasClass('active')){
                    togglingItem.children('.toggleArrow').animate({rotate: '-=90deg'}, 500);
                }
                else {
                    togglingItem.children('.toggleArrow').animate({rotate: '+=90deg'}, 500);
                }
            }
        });
    }


    // datepickers

    // CE
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
            rangeYear = fStartDate.split('/')[0],
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
            current: rangeYear+'/07/01',
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
            $('#datepickerCalendar').stop().css({height: 0}).removeClass('opened');
            $('#datepickerField').removeClass('opened');
            $('#datepickerCalendar').removeClass('opened');
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
            rangeYear = fStartDate.split('/')[0],
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
            current: rangeYear+'/07/01',
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
            $('#datepickerCalendar').stop().css({height: 0}).removeClass('opened');
            $('#datepickerField').removeClass('opened');
            $('#datepickerCalendar').removeClass('opened');
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
            $('#datepickerInput').val('Du ' + preselectedDates[0] + ' au ' + preselectedDates[1]);
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

    // indiv
    if ($('#searchBlocDate #datepicker').length) {
        var d = new Date(),
            fCurrentDate = formatDate(d),
            currentDate = numDate(fCurrentDate),
            startDate = numDate(fStartDate),
            endDate = numDate(fEndDate),
            fSeasonDates = [fStartDate,fEndDate],
            highSeasonStartDate = numDate(fHighSeasonStartDate),
            highSeasonEndDate = numDate(fHighSeasonEndDate),
            fHighSeasonDates = [fHighSeasonStartDate,fHighSeasonEndDate],
            arrivalDate,
            displayMonths = 2,
            visibleMonths,
            rangeYear,
            middleRangeMonth;


        //console.log(fSeasonDates);
        //console.log(fHighSeasonDates);
        //console.log(fCurrentDate);
        //console.log(d);
        //console.log(middleRangeMonth);

        if (currentDate > startDate){
            fStartDate = fCurrentDate
        }
        visibleMonths = ( parseInt(fEndDate.split('/')[1],10) - parseInt(fStartDate.split('/')[1],10) ) + 1,
        rangeYear = fStartDate.split('/')[0],
        middleRangeMonth = ((''+Math.floor(parseInt(fStartDate.split('/')[1],10)+(visibleMonths/2))).length<2 ? '0' : '') + Math.floor(parseInt(fStartDate.split('/')[1],10)+(visibleMonths/2));
        //console.log(currentDate);
        //console.log(startDate);
        //console.log(fStartDate);

        $('#datepickerCalendar').DatePicker({
            flat: true,
            date: '',
            current: rangeYear+'/'+middleRangeMonth+'/01',
            calendars: visibleMonths,
            mode: 'single',
            starts: 1,
            format:'Y/m/d',
            position: 'right',
            locale: datepickerLanguage,
            onChange: function(formated, dates){
                //console.log("################################## onChange:  ##################################");
                //console.log(formated);
                //console.log(dates);
                arrivalDate = dates;
                //console.log(arrivalDate);

                var selectedDate,
                    fSelectedDate;
                firstRendering = false;

                fSelectedDate = writeDate(arrivalDate);
                var selectedDate = formated.split('/').join('');
                //console.log(highSeasonStartDate);
                //console.log(highSeasonEndDate);
                if ((selectedDate < highSeasonStartDate) || (selectedDate > highSeasonEndDate)){
                    $('#SearchDate_isBasseSaison').val(1);
                    defineDurationSelect();
                }
                else if ((selectedDate >= highSeasonStartDate) && (selectedDate <= highSeasonEndDate)){
                    $('#SearchDate_isBasseSaison').val(0);
                    defineDurationSelect();
                }

//                unselectForbiddenDates(arrivalDate);
                firstSelection = false;

                //console.log(fSelectedDate);
                //console.log(selectedDate);
                $('#datepickerInput').val(fSelectedDate);
                $('#datepicker input[type=hidden]').eq(0).val(fSelectedDate);

                $('#datepickerField').trigger("click");
            },
            onRender: function(date) {
                //console.log("################################## onRender:  ##################################");

                var renderDate = date,
                    disabledDate,
                    renderWeekDay = renderDate.getDay(),
                    fRenderDate = formatDate(renderDate),
                    renderDate = numDate(fRenderDate);

                //console.log(renderDate);
                //console.log(startDate);
                //console.log(endDate);
                //console.log(renderWeekDay);

                if ( ((renderDate > highSeasonStartDate && renderDate < highSeasonEndDate) && (renderWeekDay != 6 && renderWeekDay != 3)) || (renderDate < startDate || renderDate > endDate) || ((renderDate > startDate && renderDate < endDate) && renderWeekDay == 2) || (renderDate < currentDate) ){
                    //console.log("DISABLED: " + renderDate);
                    disabledDate = renderDate;
                }

                //console.log(disabledDate);
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
            $('#datepickerCalendar').stop().css({height: 0}).removeClass('opened');
            $('#datepickerField').removeClass('opened');
            $('#datepickerCalendar').removeClass('opened');
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
                $('.datepicker>.datepickerGoPrev a, .datepicker>.datepickerGoNext a').removeClass('isFading').fadeIn(500);
            }

            //console.log(currentMonth);
            return false;
        });
        $('.datepickerGoPrev a, .datepickerGoNext a, .datepickerMonth a').bind('click', function(e){
            return false;
        });
        $('#datepickerCalendar div.datepicker').css('position', 'absolute');
//        $('#datepickerCalendar div.datepickerContainer').css('margin-left', '-5px');
        $('.datepicker>.datepickerGoPrev a').hide();

        var preselectedFDate,
            preselectedDate;
        if ( $("#SearchDate_dateDebut").val() != '' ) {
            var fDate = $("#SearchDate_dateDebut").val().split("/").reverse().join('/');
            //console.log(fDate);
            $('#datepickerInput').val($("#SearchDate_dateDebut").val());
            $('#datepickerCalendar').DatePickerSetDate(fDate);
            fDate = $("#SearchDate_dateDebut").val().split("/").reverse().join('');
            if ((fDate < highSeasonStartDate) || (fDate > highSeasonEndDate)){
                $('#SearchDate_isBasseSaison').val(1);
                defineDurationSelect();
            }
            else if ((fDate >= highSeasonStartDate) && (fDate <= highSeasonEndDate)){
                $('#SearchDate_isBasseSaison').val(0);
                defineDurationSelect();
            }
        }


        //console.log("################################## switchLinear()  ##################################");
        $('#searchBlocDate .searchBox').attr('id',linear);

        firstRendering = true;

    }


//init Gmap
    if ($('.gmap').length > 0) {
        //consoleLog('map');
        loadGmapScript();
    }


/*
 *  ############################################################
 *                       SEARCH ENGINE
 * ############################################################
 */

//init Search
    if ($('#searchBloc').length) {
        $('#searchBloc').find('form').submit(function(e){
            e.preventDefault();
            liveSubmit($(this));
        });

        if ($('#searchBlocDate').length) {
            countItem();
            $('#searchBlocDate').find('input.spin-tb').attr('readonly','readonly');
            $('#searchBlocDate').find('select').sSelect({ddMaxHeight: '300px'});
            switchPlaceSelect();
            defineDurationSelect();
            if ( $('body').hasClass('home') ) {
                toggleSearchCriteria();
            }
        }

        function hideError(form){
            if ( form.find('.errors').length ){
                $('.errors').fadeOut(500, function(){
                    $(this).remove();
                });
            }
        }
        $('#searchBlocDate').find('input, select, .selectedTxt, .switchSelect , button, textarea').on('click', function(){
            hideError($('#searchBlocDate'));
        });
        $('#searchBlocDate').on('keyup', function(){
            hideError();
        });

    }


/*
 *  ############################################################
 *                      SEARCH RESULTS
 * ############################################################
 */

    if ($('#results .itemResult').length){
        initCritResult();
        $('.itemResultRight .bt').click( function(){
            $(this).next('.itemResultPopDest').fadeIn();
        });
        $('.itemResult').mouseleave( function(){
            $(this).find('.itemResultPopDest').fadeOut();
        });
        $(".popinRoomType").click( function(e){
            e.preventDefault();
            if ($(this).attr('href').length) {
                var url = $(this).attr('href');
               openPopinRoomType(url);
            }
        });
        // click bt MoreResults
        $('#btPlusResults').click( function() {
            var nextItems = $('.nextItem'),
                nextItemsLength = nextItems.length;

            if ( nextItemsLength <= nbToShow ) {
                $('#results').find('.nextItem').fadeIn().removeClass('nextItem');
                $(this).hide();
            }else if ( nextItemsLength > nbToShow ) {
                $('#results').find('.nextItem:lt('+nbToShow+')').fadeIn().removeClass('nextItem');
            }
        });
    }


});


/*
 *  ############################################################
 *                          FOOTER
 * ############################################################
 */

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

if($('#refresh_layer').length){
    $('#refresh_layer a.bt').click(function(e) {
        e.preventDefault();
        location.reload();
        //history.back();
    });
}


/*
 *  //////////////////////////////////////////////////////////////////////////////////////////////////////////
 *                                              HEAD ready
 * ///////////////////////////////////////////////////////////////////////////////////////////////////////////
 */
head.ready(function(){

    if ($('#searchContainer').length) {
        $('#searchText').height($('#searchForm').height());
    }

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

});





/*
 *  //////////////////////////////////////////////////////////////////////////////////////////////////////////
 *                                              functions
 * ///////////////////////////////////////////////////////////////////////////////////////////////////////////
 */


/*
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
 *                       SEARCH ENGINE
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
 */

// Live submit
function liveSubmit(oForm){
    var sFormName = oForm.attr('name');
    var sDidacticielTitle = oForm.attr('data-didacticiel-title');
    $.ajax({
        type:"POST",
        url:basePath+"index.php/search_engine/validate",
        data: oForm.serialize(),
        dataType:"json",
        beforeSend: function()
        {
            oForm.find('button[type="submit"]').hide().next('.loading').show();
            oForm.children('fieldset').append('');
        },
        error:function(errorText)
        {
            //console.log(errorText);
            //console.log(oForm.serialize());
            oForm.find('button[type="submit"]').show().next('.loading').hide();
            if ( $('#wrap').children('.column.left').children('.error').length == 0 ) {
                $('#wrap').children('.column.left').prepend('<div class="error"></div>');
            }
            $('#wrap').children('.column.left').children('.error').html('<p>' + errorText.responseText + '</p>');
            return false;
        },
        success:function(data)
        {

            $.each(data, function(key,val){
                oForm.find('button[type="submit"]').show().next('.loading').hide();
                if ( key == sFormName) {
                    if (val.success){

                        oForm.unbind('submit').submit();
                        showDidacticielLayer(sDidacticielTitle, getDidacticielContentFromSearch(oForm));
                        return true;
                    }
                    oForm.getErrors(val.errors);
                    return false;
                }

            });
        }
    });
}

// traversing JSON to get errors
$.fn.getErrors = function(errorsData) {
    //console.log(errorsData);
    var submitForm = this;
    $.each(errorsData, function(errorInput,errorMessage){
        var error = '<div class="errors '+errorInput+'">';
        error += '<p>'+errorMessage+'</p>';
        error += '</div>';
        submitForm.children('fieldset').append(error);
    });
}

// (+/-) Button Number Incrementers
function countItem() {
    //console.log("################################## countItem()  ##################################");
    $('.spin-bt-down, .spin-bt-up').live('click', function(){
        var $button = $(this);
        var $input = $button.siblings(".spin-tb");
        var oldValue = $input.val();
        if ($button.hasClass('spin-bt-up')) {
            if (oldValue < 6) {
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

// switch select between CAMPINGS and CITYS
var $placeSelects;
function switchPlaceSelect(){
    //console.log("################################## switchPlaceSelect()  ##################################");
    var $button = $('.switchSelect');
    $placeSelects = $button.parent().siblings(".newListSelected");
    if ($('#SearchDate_isCamping').val() == 1){
        selectNum = 1;
        $('.switchSelect').css({backgroundPosition: "0 -270px"});
        $placeSelects.eq(0).hide();
        $placeSelects.eq(1).show();
    }
    else {
        $placeSelects.eq(1).hide();
    }
    $('.switchSelect').live('click', function(){
        selectNum = selectNum == 0 ? 1 : 0;
        $placeSelects = $button.parent().siblings(".newListSelected");
        var $buttonTitle = selectNum == 0 ? $('#SearchDate_selectContainer2 label[for="SearchDate_camping"]').text() : $('#SearchDate_selectContainer2 label[for="SearchDate_ville"]').text();
        $button.children('span').text($buttonTitle);
//        $button.attr('title',$buttonTitle);
        if(selectNum) {
            $button.css({backgroundPosition: "0 -270px"});
            $placeSelects.eq(0).hide();
            $placeSelects.eq(1).show();
        }
        else {
            $button.css({backgroundPosition: "0 -54px"});
            $placeSelects.eq(1).hide();
            $placeSelects.eq(0).show();
        }
        $('#SearchDate_isCamping').val(selectNum);
        return false;
    });
}

// switch select between LOW SEASON and HIGH SEASON
function defineDurationSelect(){
    //console.log("################################## defineDurationSelect()  ##################################");
    var $durationSelects = $('#SearchDate_selectContainer0').find(".newListSelected");
    if ($('#SearchDate_isBasseSaison').val() == 1){
        $durationSelects.eq(0).hide();
        $durationSelects.eq(1).show();
    }
    else {
        $durationSelects.eq(1).hide();
        $durationSelects.eq(0).show();
    }
}

// toggle search criteria
function toggleSearchCriteria(){
    var toggleSearchCriteriaState = 0;
    //console.log("################################## toggleSearchCriteria()  ##################################");
    $('.toggleButton').live('click', function(e){
        toggleSearchCriteriaState = toggleSearchCriteriaState == 0 ? 1 : 0;
        $(this).parents('#searchBloc').toggleClass('opened');
        e.preventDefault();
        var $button = $(this);
        var buttonText = $button.text().replace(toggleSearchCriteriaState == 0 ? '-' : '+',toggleSearchCriteriaState == 0 ? '+' : '-');
        $button.html(buttonText);
        var $container = $button.prev('.toggleContainer');
        $container.stop().toggle();
    });
}

// wait layer
function showWaitLayer(href){
	var url = window.location.href.split('/');
	var ancienCateg = url[url.length-2];
	var newUrl = href.split('/');
	var newCateg = newUrl[newUrl.length-2];
	
	if(newCateg != ancienCateg)
		$('#please_wait_layer').show();
}

// didacticiel layer
/*
 * Pour référence, cette fonction est appelée dans les fichiers src/VacancesDirectes/View/Menu/bonsPlans.twig et src/VacancesDirectes/View/Form/_search_engine.twig
 * La popin à affichée est présente dans le fichier src/VacancesDirectes/View/footer.twig (id = didacticiel_layer)
 *
 * Params :
 * string title Le contenu HTML à afficher dans le H2 de la popin
 * string content le contenu HTML à afficher dans le p de la popin
 */
function showDidacticielLayer(title, content) {
    $('#didacticiel_layer_content h2').html(title);
    $('#didacticiel_layer_content p').html(content);
    $('#didacticiel_layer').show();
}

/*
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
 *                          POPIN
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
 */

function openPopinRoomType(url){
    //console.log("################################## openPopinType()  ##################################");
    $.colorbox({href:url, inline:true, width:'616px', close:"&times;"});
}
function openPopinIframe(url){
    //console.log("################################## openPopinIframe()  ##################################");
    $.colorbox({href:url, iframe:true, fixed: true, width:'80%', height:'80%', close:"&times;"});
}

function cboxMdP(url) {
    $.colorbox({href:url, iframe:true, fixed: true, width:450, height:250, close:"&times;"});
    return false;
}
function openPopinInline(type){
    //console.log("################################## openPopinInline()  ##################################");
    if ($('*[data-type="' + type + '"]').length > 0){
        $('*[data-type="' + type + '"]').attr('id',type);
        var content = $('*[data-type="' + type + '"]').clone();
        content.find('.h4-like').each(function() {
            $(this).children('a').replaceWith(function () {
                return $(this).text();
            });
        });
        //console.log(content);
        $.colorbox({href:content, inline:true, width:'616px', close:"&times;"});
    }
}

/*
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
 *                      NAVIGATION MENU
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
 */

function addBorders(e){
    e.removeClass('noBorder');
    e.next().removeClass('noBorder');
}
function removeBorders(e){
    e.addClass('noBorder');
    e.next().addClass('noBorder');
}


/*
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
 *                          HOME SLIDER
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
 */

function beforeSlide(e){
    //consoleLog(e);
    e.items.old.removeClass( "active" );
    if (direction ==  "page"){
        var newSlide = e.items.visible.attr('data-slide');
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
        e.items.visible.find('.sliderPostmark').hide();
        e.items.visible.find('.sliderPhoto').show();
        e.items.old.find('.sliderPostmark').fadeOut(300);
        e.items.old.find('.sliderPhoto').fadeOut(500);

        e.items.old.find('.sliderPhoto').animate({
            rotate: '-54deg',
            scale: '0.5'
        }, {queue: false, duration: 500});
        e.items.visible.find('.sliderPhoto').rotate('18deg'); // rotates to 0deg
        e.items.visible.find('.sliderPhoto').scale('1'); // rotates to 0deg
        e.items.visible.find('.sliderPostmark').fadeIn(3000);
    } else {
        e.items.visible.find('.sliderPostmark').hide();
        e.items.visible.find('.sliderPhoto').hide();
        e.items.visible.find('.sliderPostmark').fadeIn(3000);
        e.items.visible.find('.sliderPhoto').fadeIn(500);

        e.items.old.find('.sliderPhoto').rotate('12deg'); // rotates to 0deg
        e.items.old.find('.sliderPhoto').scale('01'); // rotates to 0deg
        e.items.visible.find('.sliderPhoto').rotate('-108deg');
        e.items.visible.find('.sliderPhoto').scale(0);
    }
}

function afterSlide(e){
    e.items.visible.addClass( "active" );
    $('.sliderBackground').show();
    $('.sliderStain.first').stop().fadeIn(300);
    $('.sliderStain.second').delay(150).fadeIn(300);
    $('#sliderBackground').hide();

    e.items.old.find('.sliderPostmark').hide();
    e.items.old.find('.sliderPhoto').rotate('18deg'); // rotates to 0deg
    e.items.old.find('.sliderPhoto').scale(1); // scales to 100%
    e.items.visible.find('.sliderPhoto').animate({
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
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
 *                         DATEPICKER
 * ############################################################
 */

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
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
 *                       FICHE SLIDER
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
 */
function makeSlider(){
    var btLeft = '<button class="prev" onclick="loadSlider(\'prev\');">&lt;</button>',
        btRight = '<button class="next" onclick="loadSlider(\'next\');">&gt;</button>',
        slider = $('.tabCampDiapo').find('.slider'),
        btns = btLeft + btRight;
    slider.append(btns);
    $('[name="affPhoto"]').change( function() {
        var filter = $(this).val();
        if ( $('.caroufredsel_wrapper', slider).length ){
            filterSlider(filter);
        } else {
            loadSlider(filter);
        }
    });
}
function loadSlider(dir){
    var direct = dir,
        slider = $('.tabCampDiapo').find('.slider'),
        aSlider = slider.find('a'),
        btLeft = slider.find('.prev'),
        btRight = slider.find('.next'),
        loader = '<span class="loadingSlider" />';
    slider.append(loader);
    aSlider.replaceWith('<img />');
    btLeft.attr("onclick", 'javascript:_gaq.push([\'_trackEvent\', \'Nav-VD_-_Page_-_Fiche-Camping\', \'Contenu_-_Visionneuse\', \'Clic_-_Bouton-Precedent\']);');
    btRight.attr("onclick", 'javascript:_gaq.push([\'_trackEvent\', \'Nav-VD_-_Page_-_Fiche-Camping\', \'Contenu_-_Visionneuse\', \'Clic_-_Bouton-Suivant\']);');
    sliderPict(direct);

}
jQuery.fn.replaceWith = function(replacement) {
    return this.each (function()     {
        var element = $(this);
        $(this).after(replacement);
        for (var i = 0; i < this.attributes.length; i++) {
            element.next().attr(this.attributes[i].nodeName, this.attributes[i].nodeValue).attr;
            element.next().attr({ src : element.attr('href') }).removeAttr('href');
        }
        element.remove();
    })
}
function sliderPict(dir) {
    var dirSlide = dir,
        slider = $('.tabCampDiapo').find('.slider');
    $('.slide', slider).carouFredSel({
        onCreate: function(){
            slider.find('.loadingSlider').remove();
            filterSlider(dirSlide);
        },
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

    /*$('[name="affPhoto"]').change( function() {
        var nVal = $(this).val();

        //consoleLog(nVal);
        if (nVal == "all") {
            slider.find('img').not(':visible').fadeIn();
            slider.find('.slide').trigger("configuration",["items.filter",":visible"]);
        } else {
            slider.find('.'+nVal).fadeIn();
            slider.find('img').not('.'+nVal).hide();
            slider.find('.slide').trigger("configuration",["items.filter",":visible"]);
        }
    });*/
    /*slider.find('img').each(function() {
        var tip = $(this).attr("alt");
        if (tip != "") {
            $(this).hover( function() {
                $('<div id="littleTIP">'+tip+'</div>').appendTo(slider).fadeIn();
            }, function() {
                $('#littleTIP').fadeOut(function(){
                    $(this).remove();
                });
            });
        }
    });*/
}
function filterSlider(dirSlide){
    var nVal = dirSlide,
        slider = $('.tabCampDiapo').find('.slider');
    if ( nVal == 'prev' || nVal == 'next' ) {
        $('.slide', slider).trigger(nVal, 1);
    } else {
        if (nVal == "all") {
            slider.find('img').not(':visible').fadeIn();
            slider.find('.slide').trigger("configuration",["items.filter",":visible"]);
        } else {
            slider.find('.'+nVal).fadeIn();
            slider.find('img').not('.'+nVal).hide();
            slider.find('.slide').trigger("configuration",["items.filter",":visible"]);
        }
    }
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

    if (sView == 'tabCamp' || sView == 'tabLocations' || sView == 'tabLogement' || sView == 'tabCampings') {
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

    if (sView == 'tabCampings') {
        $('#formSearchRefined').fadeIn();
    } else {
        $('#formSearchRefined').hide();
    }
}


/*
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
 *                          FICHE
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
 */

// ajust borders height
if($('#tabCamp .colSurPlace').length){
    var maxHeight = 0;
    $('#tabCamp .colSurPlace').children('dl').each(function(index){
        if ($(this).height() > maxHeight){
            maxHeight = $(this).height();
        }
        if ($('#tabCamp .colSurPlace').children('dl').length == index+1){
            $('#tabCamp .colSurPlace').children('dl').css('height',maxHeight);
        }
    });
}


/*
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
 *                      GMAP FUNCIONS
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
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
        var titleMkr = mkr[0].replace(/&#039;/g, "'");
        var siteLatLng = new google.maps.LatLng(mkr[1], mkr[2]);
        var marker = new google.maps.Marker({
            position: siteLatLng,
            map: map,
            shadow: shadow,
            icon: mkr[5],
            shape: shape,
            title: titleMkr,
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
        type: 'polynav'
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


/*
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
 *                     SEARCH RESULTS
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
 */

function initCritResult(){

    //we come from the same page
    if ( $('#results').length ){
        $('#dealsContent').find('.linkParent').click( function(){
            var host = window.location.pathname;
            var hrefLink = $(this).find('a').attr('href').split('#')[0];

            if ( host == hrefLink ){
                var hash = window.location.hash;
                var option = hash.split('#')[1];
                $('#TopFilter_bon_plans').val(option);
                launchFilters();
                $('#deals').hide();
                $('#didacticiel_layer').hide();
            }

        });
    }

    if(window.location.hash != '') {
        var hash = window.location.hash;
        if(hash === '#carte') {
            $('#btMap').addClass('active').siblings('button').removeClass('active');
            $('#resultMap').addClass('active');
        }else{
            var option = hash.split('#')[1];
            $('#TopFilter_bon_plans').val(option);
        }
    }

    $('.typeAff').find('button').click( function(){
        $(this).addClass('active').siblings('button').removeClass('active');
        if ( $(this).attr('id') == 'btMap' ) {
            $('#resultMap').addClass('active');
        } else {
            $('#resultMap').removeClass('active');
        }
    });

    //consoleLog(firstTime);
    if (firstTime == true) {
        $('#TopFilter_regions').find('option').each( function(){
            var reg = $(this).attr('value');
            if ( reg != 0 ){
                var regInItems = $("[data-reg="+reg+"]").length;
                //consoleLog(reg + regInItems);
                if ( regInItems == 0 ) { $(this).remove(); }
            }
        });
        firstTime = false;
    }
// init resultat first pass
    items.attr('data-filtered', true)
         .attr('data-filteredPlus', true)
         .attr('data-ranged', true)
         .attr('data-datecrit', true)
         .attr('data-regcrit', true)
        .addClass('itemRanged');

    items.each( function(){
        var critPlus = $(this).attr('data-critplus');
        var critPlusReg = new RegExp("(,)", "g");
        $(this).attr('data-critplus', critPlus.replace(critPlusReg,' '));
    });

// init du nombre de resultats
    /*var nbResultsItems = items.length;
    $('.nbResult .nb').text(nbResultsItems);*/

   /* items.each(function(i) {
        $(this).attr('data-pertinenceID', i);
    });*/

// affichage des filtres
    $('.sectionTitle').not('.open').next('fieldset').fadeToggle();
    openCrit();

// change on click
    $('.itemResult .linePrice :radio').change( function(){
        var oCheck = $(this);
        oCheck.parents('.linePrice').addClass('checked').siblings().removeClass('checked');
    });

// change on click
    var iBox = $('.formSearchRefined').find(':checkbox'),
        iSlcDate = $('#filterTri').find('#TopFilter_bon_plans'),
        iSlcReg = $('#filterTri').find('#TopFilter_regions');

    iBox.change(function() { launchFilters(); });
    iSlcDate.change(function() { launchFilters(); });
    iSlcReg.change(function() { resultFrom = "fromReg"; launchFilters(); });

// First-time launchFilter function
    findMinMaxRange();
}

function openCrit() {
    $('.formSearchRefined .sectionTitle').click(function() {
        $(this).toggleClass('open').next('fieldset').fadeToggle();
    });
}

/* RANGE SLIDER */
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


    if ( minPrice == maxPrice) {
        $('#widgetRange').hide();
    }

    rangeSliderPrice();
    launchFilters();
}

//creation du rangeSlider de prix
function rangeSliderPrice() {
    var $range = $("#noUiSlider"),
        //valueMin,
        //valueMax,
        minScale = minPrice/*-20*/,
        maxScale = maxPrice/*+20*/,
        minStart = minPrice,
        minStop = maxPrice;

    var initRange = function(){
        $range.empty().noUiSlider('init', {
            'scale'		:		[minScale,maxScale],
            'start'		:		[minStart,minStop],

            change: function(){
                var values = $(this).noUiSlider('value');
                $(this).find('.noUi-lowerHandle').next('.rangeBox').text(values[0] + "€");
                $(this).find('.noUi-upperHandle').next('.rangeBox').text(values[1] + "€");
            },
            end: function(){
                var values = $(this).noUiSlider('value');
                items.each(function() {
                    $(this).find('.linePrice').each( function(){
                        var originPriceLine = parseInt($(this).find('.stain .price').text());
                        if ( parseInt(originPriceLine) >= parseInt(values[0]) && parseInt(originPriceLine) <= parseInt(values[1]) ) {
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
                    if ( nbVisiblePrice > 0 ) {
                        $(this).attr('data-ranged', true);
                    }else{
                        //consoleLog('data-ranged');
                        $(this).attr('data-ranged', false);
                    }
                });
                //consoleLog(values);
                noUiSliderRanged(values);
            }
        }).find('.noUi-handle').each(function(index){
            $(this).after('<span class="rangeBox rb'+index+'">'+$(this).parent().noUiSlider( 'value' )[index]+' €</span>');
        });
    };

    initRange.call();
}

function noUiSliderRanged(values){
    items.each(function() {
        $(this).find('.linePrice').each( function(){
            var originPriceLine = parseInt($(this).find('.stain .price').text());
            if ( parseInt(originPriceLine) >= parseInt(values[0]) && parseInt(originPriceLine) <= parseInt(values[1]) ) {
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
        if ( nbVisiblePrice > 0 ) {
            $(this).attr('data-ranged', true);
        }else{
            //consoleLog('data-ranged');
            $(this).attr('data-ranged', false);
        }
    });
    resultFrom = "fromRge";
    launchFilters();
}
function reInitFilter(){
    //consoleLog('In');
    $('#noResult').fadeIn();
    if ( resultFrom == "fromReg" ){
        $('#TopFilter_regions').val('');
        launchFilters();
    }
    if ( resultFrom == "fromRge" ){
        rangeSliderPrice();
        var values = $("#noUiSlider").noUiSlider('value');
        noUiSliderRanged(values);
    }
    resultFrom = "";

}

//selection des criteres
function launchFilters() {
    //remize a zero
    $('.nbResult .nb').css({'opacity':0});

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
                var dataCompareCritPlus = $(this).attr('data-critPlus').split(' ');

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

    if ( $('#TopFilter_bon_plans').length ){
        var dataCritDate = $('#TopFilter_bon_plans').val();
        if ( dataCritDate == '' ) {
            items.each( function(){
                $(this).attr('data-datecrit', true);
            });
        } else {
            items.each( function(){
                var iDateCrit = $(this).attr('data-date');
                if ( iDateCrit == dataCritDate ) {
                    $(this).attr('data-datecrit', true);
                } else {
                    $(this).attr('data-datecrit', false);
                }
            });
        }
    }

    if ( $('#TopFilter_regions').length ){
        var dataCritReg = $('#TopFilter_regions').val();
        if ( dataCritReg == '' ) {
            items.each( function(){
                $(this).attr('data-regcrit', true);
            });
        } else {
            items.each( function(){
                var iRegCrit = $(this).attr('data-reg');
                if ( iRegCrit == dataCritReg ) {
                   $(this).attr('data-regcrit', true);
                } else {
                    $(this).attr('data-regcrit', false);
                }
            });
        }
    }

    //rangeSliderPrice();
    displayResults();
};

//gestion de l'affichage en fonction des criteres + rangeSlider
function displayResults() {
    nbItemsDisplayed = 0;
    //consoleLog('displayResult');

    items.removeClass('itemRanged');
    items.removeClass('nextItem');

    /*var nbItemsDisplayed = 0;*/
    var gMarkers = [];

    items.each(function() {
        var dataRanged = $(this).attr('data-ranged'),
            dataFiltered = $(this).attr('data-filtered'),
            dataFilteredPlus = $(this).attr('data-filteredPlus'),
            dataDated = $(this).attr('data-datecrit'),
            dataReged = $(this).attr('data-regcrit');

        if ( dataFiltered == 'true' && dataFilteredPlus == 'true' && dataRanged == 'true' && dataDated == 'true' && dataReged == 'true' ) {
            $(this).addClass('itemRanged');
            nbItemsDisplayed++;
            //consoleLog(nbItemsDisplayed);
            var idRsl = $(this).attr('data-id');
            gMarkers.push(idRsl);
        }else{
            //var id = $(this).attr('id');
            //$(this).removeClass('itemRanged');
            //consoleLog('none');
        }

        for (var i = 0; i < aMarkers.length; i++) {
            var marker = aMarkers[i];
            marker.setVisible( $.inArray(marker.idCamp, gMarkers) != -1 ? true : false );
        }

    });

    //init de l'affichage du nombre de resultats par critere
    $('.contentCritPlus').find('input').each( function(){
        var rslTypePlus = $(this).attr('id');
        var rslTypeinresultPlus = $(".itemRanged[data-critplus~="+rslTypePlus+"]").length;
        if ( rslTypeinresultPlus == 0 ) {
            $(this).siblings('.nbItem').text('');
            $(this).attr('disabled', true).parent().addClass('disableLabel');
        } else {
            $(this).siblings('.nbItem').text('('+rslTypeinresultPlus+')');
            $(this).attr('disabled', false).parent().removeClass('disableLabel');
        }
    });
    $('.contentCrit').find('input').each( function(){
        var rslType = $(this).attr('id');
        var rslTypeinresult = $('.itemRanged[data-crit='+rslType+']').length;
        if ( rslTypeinresult == 0 ) {
            $(this).siblings('.nbItem').text('');
            $(this).attr('disabled', true).parent().addClass('disableLabel');
        } else {
            $(this).siblings('.nbItem').text('('+rslTypeinresult+')');
            $(this).attr('disabled', false).parent().removeClass('disableLabel');
        }
    });

    // Affichage du nombre de criteres selectionnes
    var nbCritChecked = $('#formSearchRefined input:checked').length;
    $('#nbCrit').text(nbCritChecked);

    //gestion de la pagination
    listPagination();
};


//pagination liste de resultats
function listPagination() {

    if ( nbItemsDisplayed == 0 ) {
        //consoleLog(nbItemsDisplayed);
        reInitFilter();
    } else {
        //Suppression du message d'erreur
        setTimeout( function(){
            //consoleLog('Out');
            $('#noResult').fadeOut()
            resultFrom == "";
        }, 4500);
    }
    $('.nbResult .nb').text(nbItemsDisplayed).animate({'opacity':1});

    var itemsPagination = $('.itemRanged'),
        nbResults = itemsPagination.length,
        btNext = $('#btPlusResults');

    items.hide();
    $('.itemRanged').not(':lt('+nbVisible+')').addClass('nextItem');
    $('.itemRanged:lt('+nbVisible+')').fadeIn();

    if ( nbResults > nbVisible ) {
        $('#btPlusResults').show();
    }else{
        btNext.hide();
    };
}

//gestion du tri par prix ou pertinence
/*function orderList() {

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
}*/

// verifier la presence du tracker GA
function test_analytics(Url) {
    if (window._gat && window._gat._getTracker) {
        _gaq.push(['_link', Url]);
    }
    else {
        window.location= Url;
    }
}
