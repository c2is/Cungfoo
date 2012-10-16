/* Project: vd - Date: 20129012 - Author: C2iS.fr > NCH-LGU */

/*--  DOMREADY  --*/
$(function() {
// Test html5 form capacties andif do polyfills
    if (!Modernizr.input.placeholder) { polyfillPlaceholder(); } // html5 placeholder

// popins
    $(".popinIframe").click( function(e){
        var url = $(this).attr('href');
        parent.openIframePopin(url);
        e.preventDefault();
    });

    //$(".popinIframe").colorbox({iframe:true, width:'80%', height:'80%', close:"&times;"});

    if ($('#homePage .aProposalBlock').length) {
        $('#homePage .aProposalBlock:nth-child(5n)').addClass('aProposalBlockLast');
    }

    $('.sortContener').find('select').sSelect({ddMaxHeight: '300px'});

});


/****
 * PLUGINS
 ****/

function consoleLog (data) {
    if(window.console && console.log )
        console.log(data);
}


function polyfillPlaceholder(){
    var active = document.activeElement;
    $('[placeholder]').focus(function () {
        if ($(this).attr('placeholder') != '' && $(this).val() == $(this).attr('placeholder')) {
            $(this).val('').removeClass('placeholder');
        }
    }).blur(function () {
            if ($(this).attr('placeholder') != '' && ($(this).val() == '' || $(this).val() == $(this).attr('placeholder'))) {
                $(this).val($(this).attr('placeholder')).addClass('placeholder');
            }
        });
    $('[placeholder]').blur();
    $('[placeholder]').parents('form').submit(function() {
        $(this).find('[placeholder]').each(function() {
            if ($(this).val() == $(this).attr('placeholder')) {
                $(this).val('');
            }
        })
    });
    $(active).focus();
}


/**
 * Stylish Select 0.4.9 - jQuery plugin to replace a select drop down box with a stylable unordered list
 * http://github.com/scottdarby/Stylish-Select
 *
 * Requires: jQuery 1.3 or newer
 *
 * Contributions from Justin Beasley: http://www.harvest.org/
 * Anatoly Ressin: http://www.artazor.lv/ Wilfred Hughes: https://github.com/Wilfred
 * Grigory Zarubin: https://github.com/Craigy-
 *
 * Dual licensed under the MIT and GPL licenses.
 */
(function($){
    //add class to html tag
    $('html').addClass('stylish-select');

    //Cross-browser implementation of indexOf from MDN: https://developer.mozilla.org/en/JavaScript/Reference/Global_Objects/Array/indexOf
    if (!Array.prototype.indexOf){
        Array.prototype.indexOf = function(searchElement /*, fromIndex */){
            if (this === void 0 || this === null)
                throw new TypeError();

            var t = Object(this);
            var len = t.length >>> 0;
            if (len === 0)
                return -1;

            var n = 0;
            if (arguments.length > 0){
                n = Number(arguments[1]);
                if (n !== n) // shortcut for verifying if it's NaN
                    n = 0;
                else if (n !== 0 && n !== (1 / 0) && n !== -(1 / 0))
                    n = (n > 0 || -1) * Math.floor(Math.abs(n));
            }

            if (n >= len)
                return -1;

            var k = n >= 0
                ? n
                : Math.max(len - Math.abs(n), 0);

            for (; k < len; k++){
                if (k in t && t[k] === searchElement)
                    return k;
            }
            return -1;
        };
    }

    //utility methods
    $.fn.extend({
        getSetSSValue: function(value){
            if (value){
                //set value and trigger change event
                $(this).val(value).change();
                return this;
            } else {
                return $(this).find(':selected').val();
            }
        },
        //added by Justin Beasley
        resetSS: function(){
            var oldOpts = $(this).data('ssOpts');
            $this = $(this);
            $this.next().remove();
            //unbind all events and redraw
            $this.unbind('.sSelect').sSelect(oldOpts);
        }
    });

    $.fn.sSelect = function(options){
        return this.each(function(){
            var defaults = {
                defaultText:    'Please select',
                animationSpeed: 0, //set speed of dropdown
                ddMaxHeight:    '', //set css max-height value of dropdown
                containerClass: '' //additional classes for container div
            };

            //initial variables
            var opts = $.extend(defaults, options),
                $input = $(this),
                $containerDivText    = $('<div class="selectedTxt"></div>'),
                $containerDiv        = $('<div class="newListSelected ' + opts.containerClass + ($input.is(':disabled') ? ' newListDisabled' : '') + '"></div>'),
                $containerDivWrapper = $('<div class="SSContainerDivWrapper" style="visibility:hidden;"></div>'),
                $newUl               = $('<ul class="newList"></ul>'),
                currentIndex         = -1,
                prevIndex            = -1,
                keys                 = [],
                prevKey              = false,
                prevented            = false,
                $newLi;

            //added by Justin Beasley
            $(this).data('ssOpts',options);

            //build new list
            $containerDiv.insertAfter($input);
            $containerDiv.attr("tabindex", $input.attr("tabindex") || "0");
            $containerDivText.prependTo($containerDiv);
            $newUl.appendTo($containerDiv);
            $newUl.wrap($containerDivWrapper);
            $containerDivWrapper = $newUl.parent();
            $input.hide();

            if($input.is(':disabled')){
                return;
            }

            //added by Justin Beasley (used for lists initialized while hidden)
            $containerDivText.data('ssReRender',!$containerDivText.is(':visible'));

            //add one item to list
            function addItem(item, container) {
                var option = $(item).text(),
                    key = $(item).val(),
                    isDisabled = $(item).is(':disabled');

                if (!isDisabled && !$(item).parents().is(':disabled')) {
                    //add first letter of each word to array
                    keys.push(option.charAt(0).toLowerCase());
                }
                container.append($('<li><a'+(isDisabled ? ' class="newListItemDisabled"' : '')+' href="JavaScript:void(0);">'+option+'</a></li>').data({
                    'key' : key,
                    'selected' : $(item).is(':selected')
                }));
            }

            $input.children().each(function(){
                if ($(this).is('option')){
                    addItem(this, $newUl);
                } else {
                    var optionTitle = $(this).attr('label'),
                        $optGroup = $('<li class="newListOptionTitle ' + ($(this).is(':disabled') ? 'newListOptionDisabled' : '') + '">'+optionTitle+'</li>'),
                        $optGroupList = $('<ul></ul>');

                    $optGroup.appendTo($newUl);
                    $optGroupList.appendTo($optGroup);

                    $(this).children().each(function(){
                        addItem(this, $optGroupList);
                    });
                }
            });

            //cache list items object
            $newLi = $newUl.find('li a:not(.newListItemDisabled)').not(function(){
                return $(this).parents().hasClass('newListOptionDisabled');
            });

            //get selected item from new list (because it doesn't contain disabled options)
            $newLi.each(function(i){
                if ($(this).parent().data('selected')){
                    opts.defaultText = $(this).html();
                    currentIndex = prevIndex = i;
                }
            });

            //get heights of new elements for use later
            var newUlHeight = $newUl.height(),
                containerHeight = $containerDiv.height(),
                newLiLength     = $newLi.length;

            //check if a value is selected
            if (currentIndex != -1){
                navigateList(currentIndex);
            } else {
                //set placeholder text
                $containerDivText.text(opts.defaultText);
            }

            //decide if to place the new list above or below the drop-down
            function newUlPos(){
                var containerPosY = $containerDiv.offset().top,
                    docHeight     = $(window).height(),
                    scrollTop     = $(window).scrollTop();

                //if height of list is greater then max height, set list height to max height value
                if (newUlHeight > parseInt(opts.ddMaxHeight)){
                    newUlHeight = parseInt(opts.ddMaxHeight);
                }

                containerPosY = containerPosY-scrollTop;
                if (containerPosY+newUlHeight >= docHeight){
                    $newUl.css({
                        height: newUlHeight
                    });
                    $containerDivWrapper.css({
                        top:    '-'+newUlHeight+'px',
                        height: newUlHeight
                    });
                    $input.onTop = true;
                } else {
                    $newUl.css({
                        height: newUlHeight
                    });
                    $containerDivWrapper.css({
                        top:     containerHeight+'px',
                        height: newUlHeight
                    });
                    $input.onTop = false;
                }
            }

            //run function on page load
            newUlPos();

            //run function on browser window resize
            $(window).bind('resize.sSelect scroll.sSelect', newUlPos);

            //positioning
            function positionFix(){
                $containerDiv.css('position','relative');
            }

            function positionHideFix(){
                $containerDiv.css(
                    {
                        position: 'static'
                    });
            }

            $containerDivText.bind('click.sSelect',function(event){
                event.stopPropagation();

                //added by Justin Beasley
                if($(this).data('ssReRender')){
                    newUlHeight = $newUl.height('').height();
                    $containerDivWrapper.height('');
                    containerHeight = $containerDiv.height();
                    $(this).data('ssReRender',false);
                    newUlPos();
                }

                //hide all menus apart from this one
                $('.SSContainerDivWrapper')
                    .not($(this).next())
                    .hide()
                    .parent()
                    .css('position', 'static')
                    .removeClass('newListSelFocus');

                //show/hide this menu
                $containerDivWrapper.toggle();
                positionFix();

                //scroll list to selected item
                if(currentIndex == -1) currentIndex = 0;
                try {
                    $newLi.eq(currentIndex).focus();
                } catch(ex) {}
            });

            function closeDropDown(fireChange, resetText){
                if(fireChange == true){
                    prevIndex = currentIndex;
                    $input.change();
                }

                if(resetText == true){
                    currentIndex = prevIndex;
                    navigateList(currentIndex);
                }

                $containerDivWrapper.hide();
                positionHideFix();
            }

            $newLi.bind('click.sSelect',function(e){
                var $clickedLi = $(e.target);

                //update counter
                currentIndex = $newLi.index($clickedLi);

                //remove all hilites, then add hilite to selected item
                prevented = true;
                navigateList(currentIndex, true);
                closeDropDown();
            });

            $newLi.bind('mouseenter.sSelect',
                function(e){
                    var $hoveredLi = $(e.target);
                    $hoveredLi.addClass('newListHover');
                }).bind('mouseleave.sSelect',
                function(e){
                    var $hoveredLi = $(e.target);
                    $hoveredLi.removeClass('newListHover');
                });

            function navigateList(currentIndex, fireChange){
                if(currentIndex == -1){
                    $containerDivText.text(opts.defaultText);
                    $newLi.removeClass('hiLite');
                } else {
                    $newLi.removeClass('hiLite')
                        .eq(currentIndex)
                        .addClass('hiLite');

                    var text = $newLi.eq(currentIndex).text(),
                        val = $newLi.eq(currentIndex).parent().data('key');

                    try {
                        $input.val(val);
                    } catch(ex) {
                        // handle ie6 exception
                        $input[0].selectedIndex = currentIndex;
                    }

                    $containerDivText.text(text);

                    //only fire change event if specified
                    if(fireChange == true){
                        prevIndex = currentIndex;
                        $input.change();
                    }

                    if ($containerDivWrapper.is(':visible')){
                        try {
                            $newLi.eq(currentIndex).focus();
                        } catch(ex) {}
                    }
                }
            }

            $input.bind('change.sSelect',function(event){
                var $targetInput = $(event.target);
                //stop change function from firing
                if (prevented == true){
                    prevented = false;
                    return false;
                }
                var $currentOpt  = $targetInput.find(':selected');
                currentIndex = $targetInput.find('option').index($currentOpt);
                navigateList(currentIndex);
            });

            //handle up and down keys
            function keyPress(element){
                //when keys are pressed
                $(element).unbind('keydown.sSelect').bind('keydown.sSelect',function(e){
                    var keycode = e.which;

                    //prevent change function from firing
                    prevented = true;

                    switch(keycode){
                        case 40: //down
                        case 39: //right
                            incrementList();
                            return false;
                            break;
                        case 38: //up
                        case 37: //left
                            decrementList();
                            return false;
                            break;
                        case 33: //page up
                        case 36: //home
                            gotoFirst();
                            return false;
                            break;
                        case 34: //page down
                        case 35: //end
                            gotoLast();
                            return false;
                            break;
                        case 13: //enter
                        case 27: //esc
                            closeDropDown(true);
                            return false;
                            break;
                        case 9: //tab
                            closeDropDown(true);
                            nextFormElement();
                            return false;
                            break;
                    }

                    //check for keyboard shortcuts
                    keyPressed = String.fromCharCode(keycode).toLowerCase();

                    var currentKeyIndex = keys.indexOf(keyPressed);

                    if (typeof currentKeyIndex != 'undefined'){ //if key code found in array
                        ++currentIndex;
                        currentIndex = keys.indexOf(keyPressed, currentIndex); //search array from current index

                        if (currentIndex == -1 || currentIndex == null || prevKey != keyPressed){
                            // if no entry was found or new key pressed search from start of array
                            currentIndex = keys.indexOf(keyPressed);
                        }

                        navigateList(currentIndex);
                        //store last key pressed
                        prevKey = keyPressed;
                        return false;
                    }
                });
            }

            function incrementList(){
                if (currentIndex < (newLiLength-1)){
                    ++currentIndex;
                    navigateList(currentIndex);
                }
            }

            function decrementList(){
                if (currentIndex > 0){
                    --currentIndex;
                    navigateList(currentIndex);
                }
            }

            function gotoFirst(){
                currentIndex = 0;
                navigateList(currentIndex);
            }

            function gotoLast(){
                currentIndex = newLiLength-1;
                navigateList(currentIndex);
            }

            $containerDiv.bind('click.sSelect',function(e){
                e.stopPropagation();
                keyPress(this);
            });

            $containerDiv.bind('focus.sSelect',function(){
                $(this).addClass('newListSelFocus');
                keyPress(this);
            });

            $containerDiv.bind('blur.sSelect',function(){
                $(this).removeClass('newListSelFocus');
            });

            //hide list on blur
            $(document).bind('click.sSelect',function(){
                $containerDiv.removeClass('newListSelFocus');
                if ($containerDivWrapper.is(':visible')){
                    closeDropDown(false, true);
                } else {
                    closeDropDown(false);
                }
            });

            //select next form element in document
            function nextFormElement() {
                var fields = $('body').find('button,input,textarea,select'),
                    index = fields.index($input);
                if (index > -1 && (index + 1) < fields.length) {
                    fields.eq(index + 1).focus();
                }
                return false;
            }
            // handle focus on original select element
            /* $input.focus(function(){
             $input.next().focus();
             }); */

            //add classes on hover
            $containerDivText.bind('mouseenter.sSelect',
                function(e){
                    var $hoveredTxt = $(e.target);
                    $hoveredTxt.parent().addClass('newListSelHover');
                }).bind('mouseleave.sSelect',
                function(e){
                    var $hoveredTxt = $(e.target);
                    $hoveredTxt.parent().removeClass('newListSelHover');
                });

            //reset left property and hide
            $containerDivWrapper.css({
                left: '0',
                display: 'none',
                visibility: 'visible'
            });

        });

    };

})(jQuery);


/*  ColorBox v1.3.20.1 - jQuery lightbox plugin
 *  (c) 2011 Jack Moore - jacklmoore.com
 *  License: http://www.opensource.org/licenses/mit-license.php
 */
(function(a,b,c){function Z(c,d,e){var g=b.createElement(c);if(d){g.id=f+d}if(e){g.style.cssText=e}return a(g)}function $(a){var b=y.length,c=(Q+a)%b;return c<0?b+c:c}function _(a,b){return Math.round((/%/.test(a)?(b==="x"?bb():cb())/100:1)*parseInt(a,10))}function ab(a){return K.photo||/\.(gif|png|jp(e|g|eg)|bmp|ico)((#|\?).*)?$/i.test(a)}function bb(){return c.innerWidth||z.width()}function cb(){return c.innerHeight||z.height()}function db(){var b,c=a.data(P,e);if(c==null){K=a.extend({},d);if(console&&console.log){console.log("Error: cboxElement missing settings object")}}else{K=a.extend({},c)}for(b in K){if(a.isFunction(K[b])&&b.slice(0,2)!=="on"){K[b]=K[b].call(P)}}K.rel=K.rel||P.rel||a(P).data("rel")||"nofollow";K.href=K.href||a(P).attr("href");K.title=K.title||P.title;if(typeof K.href==="string"){K.href=a.trim(K.href)}}function eb(b,c){a.event.trigger(b);if(c){c.call(P)}}function fb(){var a,b=f+"Slideshow_",c="click."+f,d,e,g;if(K.slideshow&&y[1]){d=function(){F.html(K.slideshowStop).unbind(c).bind(j,function(){if(K.loop||y[Q+1]){a=setTimeout(W.next,K.slideshowSpeed)}}).bind(i,function(){clearTimeout(a)}).one(c+" "+k,e);r.removeClass(b+"off").addClass(b+"on");a=setTimeout(W.next,K.slideshowSpeed)};e=function(){clearTimeout(a);F.html(K.slideshowStart).unbind([j,i,k,c].join(" ")).one(c,function(){W.next();d()});r.removeClass(b+"on").addClass(b+"off")};if(K.slideshowAuto){d()}else{e()}}else{r.removeClass(b+"off "+b+"on")}}function gb(b){if(!U){P=b;db();y=a(P);Q=0;if(K.rel!=="nofollow"){y=a("."+g).filter(function(){var b=a.data(this,e),c;if(b){c=a(this).data("rel")||b.rel||this.rel}return c===K.rel});Q=y.index(P);if(Q===-1){y=y.add(P);Q=y.length-1}}if(!S){S=T=true;r.show();if(K.returnFocus){a(P).blur().one(l,function(){a(this).focus()})}q.css({opacity:+K.opacity,cursor:K.overlayClose?"pointer":"auto"}).show();K.w=_(K.initialWidth,"x");K.h=_(K.initialHeight,"y");W.position();if(o){z.bind("resize."+p+" scroll."+p,function(){q.css({width:bb(),height:cb(),top:z.scrollTop(),left:z.scrollLeft()})}).trigger("resize."+p)}eb(h,K.onOpen);J.add(D).hide();I.html(K.close).show()}W.load(true)}}function hb(){if(!r&&b.body){Y=false;z=a(c);r=Z(X).attr({id:e,"class":n?f+(o?"IE6":"IE"):""}).hide();q=Z(X,"Overlay",o?"position:absolute":"").hide();C=Z(X,"LoadingOverlay").add(Z(X,"LoadingGraphic"));s=Z(X,"Wrapper");t=Z(X,"Content").append(A=Z(X,"LoadedContent","width:0; height:0; overflow:hidden"),D=Z(X,"Title"),E=Z(X,"Current"),G=Z(X,"Next"),H=Z(X,"Previous"),F=Z(X,"Slideshow").bind(h,fb),I=Z(X,"Close"));s.append(Z(X).append(Z(X,"TopLeft"),u=Z(X,"TopCenter"),Z(X,"TopRight")),Z(X,false,"clear:left").append(v=Z(X,"MiddleLeft"),t,w=Z(X,"MiddleRight")),Z(X,false,"clear:left").append(Z(X,"BottomLeft"),x=Z(X,"BottomCenter"),Z(X,"BottomRight"))).find("div div").css({"float":"left"});B=Z(X,false,"position:absolute; width:9999px; visibility:hidden; display:none");J=G.add(H).add(E).add(F);a(b.body).append(q,r.append(s,B))}}function ib(){if(r){if(!Y){Y=true;L=u.height()+x.height()+t.outerHeight(true)-t.height();M=v.width()+w.width()+t.outerWidth(true)-t.width();N=A.outerHeight(true);O=A.outerWidth(true);r.css({"padding-bottom":L,"padding-right":M});G.click(function(){W.next()});H.click(function(){W.prev()});I.click(function(){W.close()});q.click(function(){if(K.overlayClose){W.close()}});a(b).bind("keydown."+f,function(a){var b=a.keyCode;if(S&&K.escKey&&b===27){a.preventDefault();W.close()}if(S&&K.arrowKey&&y[1]){if(b===37){a.preventDefault();H.click()}else if(b===39){a.preventDefault();G.click()}}});a("."+g,b).live("click",function(a){if(!(a.which>1||a.shiftKey||a.altKey||a.metaKey)){a.preventDefault();gb(this)}})}return true}return false}var d={transition:"elastic",speed:300,width:false,initialWidth:"600",innerWidth:false,maxWidth:false,height:false,initialHeight:"450",innerHeight:false,maxHeight:false,scalePhotos:true,scrolling:true,inline:false,html:false,iframe:false,fastIframe:true,photo:false,href:false,title:false,rel:false,opacity:.9,preloading:true,current:"image {current} of {total}",previous:"previous",next:"next",close:"close",xhrError:"This content failed to load.",imgError:"This image failed to load.",open:false,returnFocus:true,reposition:true,loop:true,slideshow:false,slideshowAuto:true,slideshowSpeed:2500,slideshowStart:"start slideshow",slideshowStop:"stop slideshow",onOpen:false,onLoad:false,onComplete:false,onCleanup:false,onClosed:false,overlayClose:true,escKey:true,arrowKey:true,top:false,bottom:false,left:false,right:false,fixed:false,data:undefined},e="colorbox",f="cbox",g=f+"Element",h=f+"_open",i=f+"_load",j=f+"_complete",k=f+"_cleanup",l=f+"_closed",m=f+"_purge",n=!a.support.opacity&&!a.support.style,o=n&&!c.XMLHttpRequest,p=f+"_IE6",q,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X="div",Y;if(a.colorbox){return}a(hb);W=a.fn[e]=a[e]=function(b,c){var f=this;b=b||{};hb();if(ib()){if(!f[0]){if(f.selector){return f}f=a("<a/>");b.open=true}if(c){b.onComplete=c}f.each(function(){a.data(this,e,a.extend({},a.data(this,e)||d,b))}).addClass(g);if(a.isFunction(b.open)&&b.open.call(f)||b.open){gb(f[0])}}return f};W.position=function(a,b){function j(a){u[0].style.width=x[0].style.width=t[0].style.width=a.style.width;t[0].style.height=v[0].style.height=w[0].style.height=a.style.height}var c,d=0,e=0,g=r.offset(),h,i;z.unbind("resize."+f);r.css({top:-9e4,left:-9e4});h=z.scrollTop();i=z.scrollLeft();if(K.fixed&&!o){g.top-=h;g.left-=i;r.css({position:"fixed"})}else{d=h;e=i;r.css({position:"absolute"})}if(K.right!==false){e+=Math.max(bb()-K.w-O-M-_(K.right,"x"),0)}else if(K.left!==false){e+=_(K.left,"x")}else{e+=Math.round(Math.max(bb()-K.w-O-M,0)/2)}if(K.bottom!==false){d+=Math.max(cb()-K.h-N-L-_(K.bottom,"y"),0)}else if(K.top!==false){d+=_(K.top,"y")}else{d+=Math.round(Math.max(cb()-K.h-N-L,0)/2)}r.css({top:g.top,left:g.left});a=r.width()===K.w+O&&r.height()===K.h+N?0:a||0;s[0].style.width=s[0].style.height="9999px";c={width:K.w+O,height:K.h+N,top:d,left:e};if(a===0){r.css(c)}r.dequeue().animate(c,{duration:a,complete:function(){j(this);T=false;s[0].style.width=K.w+O+M+"px";s[0].style.height=K.h+N+L+"px";if(K.reposition){setTimeout(function(){z.bind("resize."+f,W.position)},1)}if(b){b()}},step:function(){j(this)}})};W.resize=function(a){if(S){a=a||{};if(a.width){K.w=_(a.width,"x")-O-M}if(a.innerWidth){K.w=_(a.innerWidth,"x")}A.css({width:K.w});if(a.height){K.h=_(a.height,"y")-N-L}if(a.innerHeight){K.h=_(a.innerHeight,"y")}if(!a.innerHeight&&!a.height){A.css({height:"auto"});K.h=A.height()}A.css({height:K.h});W.position(K.transition==="none"?0:K.speed)}};W.prep=function(b){function g(){K.w=K.w||A.width();K.w=K.mw&&K.mw<K.w?K.mw:K.w;return K.w}function h(){K.h=K.h||A.height();K.h=K.mh&&K.mh<K.h?K.mh:K.h;return K.h}if(!S){return}var c,d=K.transition==="none"?0:K.speed;A.remove();A=Z(X,"LoadedContent").append(b);A.hide().appendTo(B.show()).css({width:g(),overflow:K.scrolling?"auto":"hidden"}).css({height:h()}).prependTo(t);B.hide();a(R).css({"float":"none"});if(o){a("select").not(r.find("select")).filter(function(){return this.style.visibility!=="hidden"}).css({visibility:"hidden"}).one(k,function(){this.style.visibility="inherit"})}c=function(){function s(){if(n){r[0].style.removeAttribute("filter")}}var b,c,g=y.length,h,i="frameBorder",k="allowTransparency",l,o,p,q;if(!S){return}l=function(){clearTimeout(V);C.detach().hide();eb(j,K.onComplete)};if(n){if(R){A.fadeIn(100)}}D.html(K.title).add(A).show();if(g>1){if(typeof K.current==="string"){E.html(K.current.replace("{current}",Q+1).replace("{total}",g)).show()}G[K.loop||Q<g-1?"show":"hide"]().html(K.next);H[K.loop||Q?"show":"hide"]().html(K.previous);if(K.slideshow){F.show()}if(K.preloading){b=[$(-1),$(1)];while(c=y[b.pop()]){q=a.data(c,e);if(q&&q.href){o=q.href;if(a.isFunction(o)){o=o.call(c)}}else{o=c.href}if(ab(o)){p=new Image;p.src=o}}}}else{J.hide()}if(K.iframe){h=Z("iframe")[0];if(i in h){h[i]=0}if(k in h){h[k]="true"}h.name=f+ +(new Date);if(K.fastIframe){l()}else{a(h).one("load",l)}h.src=K.href;if(!K.scrolling){h.scrolling="no"}a(h).addClass(f+"Iframe").appendTo(A).one(m,function(){h.src="//about:blank"})}else{l()}if(K.transition==="fade"){r.fadeTo(d,1,s)}else{s()}};if(K.transition==="fade"){r.fadeTo(d,0,function(){W.position(0,c)})}else{W.position(d,c)}};W.load=function(b){var c,d,e=W.prep;T=true;R=false;P=y[Q];if(!b){db()}eb(m);eb(i,K.onLoad);K.h=K.height?_(K.height,"y")-N-L:K.innerHeight&&_(K.innerHeight,"y");K.w=K.width?_(K.width,"x")-O-M:K.innerWidth&&_(K.innerWidth,"x");K.mw=K.w;K.mh=K.h;if(K.maxWidth){K.mw=_(K.maxWidth,"x")-O-M;K.mw=K.w&&K.w<K.mw?K.w:K.mw}if(K.maxHeight){K.mh=_(K.maxHeight,"y")-N-L;K.mh=K.h&&K.h<K.mh?K.h:K.mh}c=K.href;V=setTimeout(function(){C.show().appendTo(t)},100);if(K.inline){Z(X).hide().insertBefore(a(c)[0]).one(m,function(){a(this).replaceWith(A.children())});e(a(c))}else if(K.iframe){e(" ")}else if(K.html){e(K.html)}else if(ab(c)){a(R=new Image).addClass(f+"Photo").error(function(){K.title=false;e(Z(X,"Error").html(K.imgError))}).load(function(){var a;R.onload=null;if(K.scalePhotos){d=function(){R.height-=R.height*a;R.width-=R.width*a};if(K.mw&&R.width>K.mw){a=(R.width-K.mw)/R.width;d()}if(K.mh&&R.height>K.mh){a=(R.height-K.mh)/R.height;d()}}if(K.h){R.style.marginTop=Math.max(K.h-R.height,0)/2+"px"}if(y[1]&&(K.loop||y[Q+1])){R.style.cursor="pointer";R.onclick=function(){W.next()}}if(n){R.style.msInterpolationMode="bicubic"}setTimeout(function(){e(R)},1)});setTimeout(function(){R.src=c},1)}else if(c){B.load(c,K.data,function(b,c,d){e(c==="error"?Z(X,"Error").html(K.xhrError):a(this).contents())})}};W.next=function(){if(!T&&y[1]&&(K.loop||y[Q+1])){Q=$(1);W.load()}};W.prev=function(){if(!T&&y[1]&&(K.loop||Q)){Q=$(-1);W.load()}};W.close=function(){if(S&&!U){U=true;S=false;eb(k,K.onCleanup);z.unbind("."+f+" ."+p);q.fadeTo(200,0);r.stop().fadeTo(300,0,function(){r.add(q).css({opacity:1,cursor:"auto"}).hide();eb(m);A.remove();setTimeout(function(){U=false;eb(l,K.onClosed)},1)})}};W.remove=function(){a([]).add(r).add(q).remove();r=null;a("."+g).removeData(e).removeClass(g).die()};W.element=function(){return a(P)};W.settings=d})(jQuery,document,this);
