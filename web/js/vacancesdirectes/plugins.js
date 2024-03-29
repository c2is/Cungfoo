/* Project: vd - Date: 20129012 - Author: C2iS.fr > NCH-LGU */
/* JS PLUGINS */

// Gestion du console.log (évite le bug sur ie si la console n'est pas ouverte)
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



/*
 *	jQuery carouFredSel 6.0.3 - Copyright (c) 2012 Fred Heusschen - www.frebsite.nl
 *	Dual licensed under the MIT and GPL licenses
 */
(function($){function sc_setScroll(a,b){return{anims:[],duration:a,orgDuration:a,easing:b,startTime:getTime()}}function sc_startScroll(a){if(is_object(a.pre)){sc_startScroll(a.pre)}for(var b=0,c=a.anims.length;b<c;b++){var d=a.anims[b];if(!d){continue}if(d[3]){d[0].stop()}d[0].animate(d[1],{complete:d[2],duration:a.duration,easing:a.easing})}if(is_object(a.post)){sc_startScroll(a.post)}}function sc_stopScroll(a,b){if(!is_boolean(b)){b=true}if(is_object(a.pre)){sc_stopScroll(a.pre,b)}for(var c=0,d=a.anims.length;c<d;c++){var e=a.anims[c];e[0].stop(true);if(b){e[0].css(e[1]);if(is_function(e[2])){e[2]()}}}if(is_object(a.post)){sc_stopScroll(a.post,b)}}function sc_afterScroll(a,b,c){if(b){b.remove()}switch(c.fx){case"fade":case"crossfade":case"cover-fade":case"uncover-fade":a.css("filter","");break}}function sc_fireCallbacks(a,b,c,d,e){if(b[c]){b[c].call(a,d)}if(e[c].length){for(var f=0,g=e[c].length;f<g;f++){e[c][f].call(a,d)}}return[]}function sc_fireQueue(a,b,c){if(b.length){a.trigger(cf_e(b[0][0],c),b[0][1]);b.shift()}return b}function sc_hideHiddenItems(a){a.each(function(){var a=$(this);a.data("_cfs_isHidden",a.is(":hidden")).hide()})}function sc_showHiddenItems(a){if(a){a.each(function(){var a=$(this);if(!a.data("_cfs_isHidden")){a.show()}})}}function sc_clearTimers(a){if(a.auto){clearTimeout(a.auto)}if(a.progress){clearInterval(a.progress)}return a}function sc_mapCallbackArguments(a,b,c,d,e,f,g){return{width:g.width,height:g.height,items:{old:a,skipped:b,"new":c,visible:c},scroll:{items:d,direction:e,duration:f}}}function sc_getDuration(a,b,c,d){var e=a.duration;if(a.fx=="none"){return 0}if(e=="auto"){e=b.scroll.duration/b.scroll.items*c}else if(e<10){e=d/e}if(e<1){return 0}if(a.fx=="fade"){e=e/2}return Math.round(e)}function nv_showNavi(a,b,c){var d=is_number(a.items.minimum)?a.items.minimum:a.items.visible+1;if(b=="show"||b=="hide"){var e=b}else if(d>b){debug(c,"Not enough items ("+b+" total, "+d+" needed): Hiding navigation.");var e="hide"}else{var e="show"}var f=e=="show"?"removeClass":"addClass",g=cf_c("hidden",c);if(a.auto.button){a.auto.button[e]()[f](g)}if(a.prev.button){a.prev.button[e]()[f](g)}if(a.next.button){a.next.button[e]()[f](g)}if(a.pagination.container){a.pagination.container[e]()[f](g)}}function nv_enableNavi(a,b,c){if(a.circular||a.infinite)return;var d=b=="removeClass"||b=="addClass"?b:false,e=cf_c("disabled",c);if(a.auto.button&&d){a.auto.button[d](e)}if(a.prev.button){var f=d||b==0?"addClass":"removeClass";a.prev.button[f](e)}if(a.next.button){var f=d||b==a.items.visible?"addClass":"removeClass";a.next.button[f](e)}}function go_getObject(a,b){if(is_function(b)){b=b.call(a)}else if(is_undefined(b)){b={}}return b}function go_getItemsObject(a,b){b=go_getObject(a,b);if(is_number(b)){b={visible:b}}else if(b=="variable"){b={visible:b,width:b,height:b}}else if(!is_object(b)){b={}}return b}function go_getScrollObject(a,b){b=go_getObject(a,b);if(is_number(b)){if(b<=50){b={items:b}}else{b={duration:b}}}else if(is_string(b)){b={easing:b}}else if(!is_object(b)){b={}}return b}function go_getNaviObject(a,b){b=go_getObject(a,b);if(is_string(b)){var c=cf_getKeyCode(b);if(c==-1){b=$(b)}else{b=c}}return b}function go_getAutoObject(a,b){b=go_getNaviObject(a,b);if(is_jquery(b)){b={button:b}}else if(is_boolean(b)){b={play:b}}else if(is_number(b)){b={timeoutDuration:b}}if(b.progress){if(is_string(b.progress)||is_jquery(b.progress)){b.progress={bar:b.progress}}}return b}function go_complementAutoObject(a,b){if(is_function(b.button)){b.button=b.button.call(a)}if(is_string(b.button)){b.button=$(b.button)}if(!is_boolean(b.play)){b.play=true}if(!is_number(b.delay)){b.delay=0}if(is_undefined(b.pauseOnEvent)){b.pauseOnEvent=true}if(!is_boolean(b.pauseOnResize)){b.pauseOnResize=true}if(!is_number(b.timeoutDuration)){b.timeoutDuration=b.duration<10?2500:b.duration*5}if(b.progress){if(is_function(b.progress.bar)){b.progress.bar=b.progress.bar.call(a)}if(is_string(b.progress.bar)){b.progress.bar=$(b.progress.bar)}if(b.progress.bar){if(!is_function(b.progress.updater)){b.progress.updater=$.fn.carouFredSel.progressbarUpdater}if(!is_number(b.progress.interval)){b.progress.interval=50}}else{b.progress=false}}return b}function go_getPrevNextObject(a,b){b=go_getNaviObject(a,b);if(is_jquery(b)){b={button:b}}else if(is_number(b)){b={key:b}}return b}function go_complementPrevNextObject(a,b){if(is_function(b.button)){b.button=b.button.call(a)}if(is_string(b.button)){b.button=$(b.button)}if(is_string(b.key)){b.key=cf_getKeyCode(b.key)}return b}function go_getPaginationObject(a,b){b=go_getNaviObject(a,b);if(is_jquery(b)){b={container:b}}else if(is_boolean(b)){b={keys:b}}return b}function go_complementPaginationObject(a,b){if(is_function(b.container)){b.container=b.container.call(a)}if(is_string(b.container)){b.container=$(b.container)}if(!is_number(b.items)){b.items=false}if(!is_boolean(b.keys)){b.keys=false}if(!is_function(b.anchorBuilder)&&!is_false(b.anchorBuilder)){b.anchorBuilder=$.fn.carouFredSel.pageAnchorBuilder}if(!is_number(b.deviation)){b.deviation=0}return b}function go_getSwipeObject(a,b){if(is_function(b)){b=b.call(a)}if(is_undefined(b)){b={onTouch:false}}if(is_true(b)){b={onTouch:b}}else if(is_number(b)){b={items:b}}return b}function go_complementSwipeObject(a,b){if(!is_boolean(b.onTouch)){b.onTouch=true}if(!is_boolean(b.onMouse)){b.onMouse=false}if(!is_object(b.options)){b.options={}}if(!is_boolean(b.options.triggerOnTouchEnd)){b.options.triggerOnTouchEnd=false}return b}function go_getMousewheelObject(a,b){if(is_function(b)){b=b.call(a)}if(is_true(b)){b={}}else if(is_number(b)){b={items:b}}else if(is_undefined(b)){b=false}return b}function go_complementMousewheelObject(a,b){return b}function gn_getItemIndex(a,b,c,d,e){if(is_string(a)){a=$(a,e)}if(is_object(a)){a=$(a,e)}if(is_jquery(a)){a=e.children().index(a);if(!is_boolean(c)){c=false}}else{if(!is_boolean(c)){c=true}}if(!is_number(a)){a=0}if(!is_number(b)){b=0}if(c){a+=d.first}a+=b;if(d.total>0){while(a>=d.total){a-=d.total}while(a<0){a+=d.total}}return a}function gn_getVisibleItemsPrev(a,b,c){var d=0,e=0;for(var f=c;f>=0;f--){var g=a.eq(f);d+=g.is(":visible")?g[b.d["outerWidth"]](true):0;if(d>b.maxDimension){return e}if(f==0){f=a.length}e++}}function gn_getVisibleItemsPrevFilter(a,b,c){return gn_getItemsPrevFilter(a,b.items.filter,b.items.visibleConf.org,c)}function gn_getScrollItemsPrevFilter(a,b,c,d){return gn_getItemsPrevFilter(a,b.items.filter,d,c)}function gn_getItemsPrevFilter(a,b,c,d){var e=0,f=0;for(var g=d,h=a.length;g>=0;g--){f++;if(f==h){return f}var i=a.eq(g);if(i.is(b)){e++;if(e==c){return f}}if(g==0){g=h}}}function gn_getVisibleOrg(a,b){return b.items.visibleConf.org||a.children().slice(0,b.items.visible).filter(b.items.filter).length}function gn_getVisibleItemsNext(a,b,c){var d=0,e=0;for(var f=c,g=a.length-1;f<=g;f++){var h=a.eq(f);d+=h.is(":visible")?h[b.d["outerWidth"]](true):0;if(d>b.maxDimension){return e}e++;if(e==g+1){return e}if(f==g){f=-1}}}function gn_getVisibleItemsNextTestCircular(a,b,c,d){var e=gn_getVisibleItemsNext(a,b,c);if(!b.circular){if(c+e>d){e=d-c}}return e}function gn_getVisibleItemsNextFilter(a,b,c){return gn_getItemsNextFilter(a,b.items.filter,b.items.visibleConf.org,c,b.circular)}function gn_getScrollItemsNextFilter(a,b,c,d){return gn_getItemsNextFilter(a,b.items.filter,d+1,c,b.circular)-1}function gn_getItemsNextFilter(a,b,c,d,e){var f=0,g=0;for(var h=d,i=a.length-1;h<=i;h++){g++;if(g>=i){return g}var j=a.eq(h);if(j.is(b)){f++;if(f==c){return g}}if(h==i){h=-1}}}function gi_getCurrentItems(a,b){return a.slice(0,b.items.visible)}function gi_getOldItemsPrev(a,b,c){return a.slice(c,b.items.visibleConf.old+c)}function gi_getNewItemsPrev(a,b){return a.slice(0,b.items.visible)}function gi_getOldItemsNext(a,b){return a.slice(0,b.items.visibleConf.old)}function gi_getNewItemsNext(a,b,c){return a.slice(c,b.items.visible+c)}function sz_storeMargin(a,b,c){if(b.usePadding){if(!is_string(c)){c="_cfs_origCssMargin"}a.each(function(){var a=$(this),e=parseInt(a.css(b.d["marginRight"]),10);if(!is_number(e)){e=0}a.data(c,e)})}}function sz_resetMargin(a,b,c){if(b.usePadding){var d=is_boolean(c)?c:false;if(!is_number(c)){c=0}sz_storeMargin(a,b,"_cfs_tempCssMargin");a.each(function(){var a=$(this);a.css(b.d["marginRight"],d?a.data("_cfs_tempCssMargin"):c+a.data("_cfs_origCssMargin"))})}}function sz_storeSizes(a,b){if(b.responsive){a.each(function(){var a=$(this),b=in_mapCss(a,["width","height"]);a.data("_cfs_origCssSizes",b)})}}function sz_setResponsiveSizes(a,b){var c=a.items.visible,d=a.items[a.d["width"]],e=a[a.d["height"]],f=is_percentage(e);b.each(function(){var b=$(this),c=d-ms_getPaddingBorderMargin(b,a,"Width");b[a.d["width"]](c);if(f){b[a.d["height"]](ms_getPercentage(c,e))}})}function sz_setSizes(a,b){var c=a.parent(),d=a.children(),e=gi_getCurrentItems(d,b),f=cf_mapWrapperSizes(ms_getSizes(e,b,true),b,false);c.css(f);if(b.usePadding){var g=b.padding,h=g[b.d[1]];if(b.align&&h<0){h=0}var i=e.last();i.css(b.d["marginRight"],i.data("_cfs_origCssMargin")+h);a.css(b.d["top"],g[b.d[0]]);a.css(b.d["left"],g[b.d[3]])}a.css(b.d["width"],f[b.d["width"]]+ms_getTotalSize(d,b,"width")*2);a.css(b.d["height"],ms_getLargestSize(d,b,"height"));return f}function ms_getSizes(a,b,c){return[ms_getTotalSize(a,b,"width",c),ms_getLargestSize(a,b,"height",c)]}function ms_getLargestSize(a,b,c,d){if(!is_boolean(d)){d=false}if(is_number(b[b.d[c]])&&d){return b[b.d[c]]}if(is_number(b.items[b.d[c]])){return b.items[b.d[c]]}c=c.toLowerCase().indexOf("width")>-1?"outerWidth":"outerHeight";return ms_getTrueLargestSize(a,b,c)}function ms_getTrueLargestSize(a,b,c){var d=0;for(var e=0,f=a.length;e<f;e++){var g=a.eq(e);var h=g.is(":visible")?g[b.d[c]](true):0;if(d<h){d=h}}return d}function ms_getTotalSize(a,b,c,d){if(!is_boolean(d)){d=false}if(is_number(b[b.d[c]])&&d){return b[b.d[c]]}if(is_number(b.items[b.d[c]])){return b.items[b.d[c]]*a.length}var e=c.toLowerCase().indexOf("width")>-1?"outerWidth":"outerHeight",f=0;for(var g=0,h=a.length;g<h;g++){var i=a.eq(g);f+=i.is(":visible")?i[b.d[e]](true):0}return f}function ms_getParentSize(a,b,c){var d=a.is(":visible");if(d){a.hide()}var e=a.parent()[b.d[c]]();if(d){a.show()}return e}function ms_getMaxDimension(a,b){return is_number(a[a.d["width"]])?a[a.d["width"]]:b}function ms_hasVariableSizes(a,b,c){var d=false,e=false;for(var f=0,g=a.length;f<g;f++){var h=a.eq(f);var i=h.is(":visible")?h[b.d[c]](true):0;if(d===false){d=i}else if(d!=i){e=true}if(d==0){e=true}}return e}function ms_getPaddingBorderMargin(a,b,c){return a[b.d["outer"+c]](true)-a[b.d[c.toLowerCase()]]()}function ms_getPercentage(a,b){if(is_percentage(b)){b=parseInt(b.slice(0,-1),10);if(!is_number(b)){return a}a*=b/100}return a}function cf_e(a,b,c,d,e){if(!is_boolean(c)){c=true}if(!is_boolean(d)){d=true}if(!is_boolean(e)){e=false}if(c){a=b.events.prefix+a}if(d){a=a+"."+b.events.namespace}if(d&&e){a+=b.serialNumber}return a}function cf_c(a,b){return is_string(b.classnames[a])?b.classnames[a]:a}function cf_mapWrapperSizes(a,b,c){if(!is_boolean(c)){c=true}var d=b.usePadding&&c?b.padding:[0,0,0,0];var e={};e[b.d["width"]]=a[0]+d[1]+d[3];e[b.d["height"]]=a[1]+d[0]+d[2];return e}function cf_sortParams(a,b){var c=[];for(var d=0,e=a.length;d<e;d++){for(var f=0,g=b.length;f<g;f++){if(b[f].indexOf(typeof a[d])>-1&&is_undefined(c[f])){c[f]=a[d];break}}}return c}function cf_getPadding(a){if(is_undefined(a)){return[0,0,0,0]}if(is_number(a)){return[a,a,a,a]}if(is_string(a)){a=a.split("px").join("").split("em").join("").split(" ")}if(!is_array(a)){return[0,0,0,0]}for(var b=0;b<4;b++){a[b]=parseInt(a[b],10)}switch(a.length){case 0:return[0,0,0,0];case 1:return[a[0],a[0],a[0],a[0]];case 2:return[a[0],a[1],a[0],a[1]];case 3:return[a[0],a[1],a[2],a[1]];default:return[a[0],a[1],a[2],a[3]]}}function cf_getAlignPadding(a,b){var c=is_number(b[b.d["width"]])?Math.ceil(b[b.d["width"]]-ms_getTotalSize(a,b,"width")):0;switch(b.align){case"left":return[0,c];case"right":return[c,0];case"center":default:return[Math.ceil(c/2),Math.floor(c/2)]}}function cf_getDimensions(a){var b=[["width","innerWidth","outerWidth","height","innerHeight","outerHeight","left","top","marginRight",0,1,2,3],["height","innerHeight","outerHeight","width","innerWidth","outerWidth","top","left","marginBottom",3,2,1,0]];var c=b[0].length,d=a.direction=="right"||a.direction=="left"?0:1;var e={};for(var f=0;f<c;f++){e[b[0][f]]=b[d][f]}return e}function cf_getAdjust(a,b,c,d){var e=a;if(is_function(c)){e=c.call(d,e)}else if(is_string(c)){var f=c.split("+"),g=c.split("-");if(g.length>f.length){var h=true,i=g[0],j=g[1]}else{var h=false,i=f[0],j=f[1]}switch(i){case"even":e=a%2==1?a-1:a;break;case"odd":e=a%2==0?a-1:a;break;default:e=a;break}j=parseInt(j,10);if(is_number(j)){if(h){j=-j}e+=j}}if(!is_number(e)||e<1){e=1}return e}function cf_getItemsAdjust(a,b,c,d){return cf_getItemAdjustMinMax(cf_getAdjust(a,b,c,d),b.items.visibleConf)}function cf_getItemAdjustMinMax(a,b){if(is_number(b.min)&&a<b.min){a=b.min}if(is_number(b.max)&&a>b.max){a=b.max}if(a<1){a=1}return a}function cf_getSynchArr(a){if(!is_array(a)){a=[[a]]}if(!is_array(a[0])){a=[a]}for(var b=0,c=a.length;b<c;b++){if(is_string(a[b][0])){a[b][0]=$(a[b][0])}if(!is_boolean(a[b][1])){a[b][1]=true}if(!is_boolean(a[b][2])){a[b][2]=true}if(!is_number(a[b][3])){a[b][3]=0}}return a}function cf_getKeyCode(a){if(a=="right"){return 39}if(a=="left"){return 37}if(a=="up"){return 38}if(a=="down"){return 40}return-1}function cf_setCookie(a,b,c){if(a){var d=b.triggerHandler(cf_e("currentPosition",c));$.fn.carouFredSel.cookie.set(a,d)}}function cf_getCookie(a){var b=$.fn.carouFredSel.cookie.get(a);return b==""?0:b}function in_mapCss(a,b){var c={},d;for(var e=0,f=b.length;e<f;e++){d=b[e];c[d]=a.css(d)}return c}function in_complementItems(a,b,c,d){if(!is_object(a.visibleConf)){a.visibleConf={}}if(!is_object(a.sizesConf)){a.sizesConf={}}if(a.start==0&&is_number(d)){a.start=d}if(is_object(a.visible)){a.visibleConf.min=a.visible.min;a.visibleConf.max=a.visible.max;a.visible=false}else if(is_string(a.visible)){if(a.visible=="variable"){a.visibleConf.variable=true}else{a.visibleConf.adjust=a.visible}a.visible=false}else if(is_function(a.visible)){a.visibleConf.adjust=a.visible;a.visible=false}if(!is_string(a.filter)){a.filter=c.filter(":hidden").length>0?":visible":"*"}if(!a[b.d["width"]]){if(b.responsive){debug(true,"Set a "+b.d["width"]+" for the items!");a[b.d["width"]]=ms_getTrueLargestSize(c,b,"outerWidth")}else{a[b.d["width"]]=ms_hasVariableSizes(c,b,"outerWidth")?"variable":c[b.d["outerWidth"]](true)}}if(!a[b.d["height"]]){a[b.d["height"]]=ms_hasVariableSizes(c,b,"outerHeight")?"variable":c[b.d["outerHeight"]](true)}a.sizesConf.width=a.width;a.sizesConf.height=a.height;return a}function in_complementVisibleItems(a,b){if(a.items[a.d["width"]]=="variable"){a.items.visibleConf.variable=true}if(!a.items.visibleConf.variable){if(is_number(a[a.d["width"]])){a.items.visible=Math.floor(a[a.d["width"]]/a.items[a.d["width"]])}else{a.items.visible=Math.floor(b/a.items[a.d["width"]]);a[a.d["width"]]=a.items.visible*a.items[a.d["width"]];if(!a.items.visibleConf.adjust){a.align=false}}if(a.items.visible=="Infinity"||a.items.visible<1){debug(true,'Not a valid number of visible items: Set to "variable".');a.items.visibleConf.variable=true}}return a}function in_complementPrimarySize(a,b,c){if(a=="auto"){a=ms_getTrueLargestSize(c,b,"outerWidth")}return a}function in_complementSecondarySize(a,b,c){if(a=="auto"){a=ms_getTrueLargestSize(c,b,"outerHeight")}if(!a){a=b.items[b.d["height"]]}return a}function in_getAlignPadding(a,b){var c=cf_getAlignPadding(gi_getCurrentItems(b,a),a);a.padding[a.d[1]]=c[1];a.padding[a.d[3]]=c[0];return a}function in_getResponsiveValues(a,b,c){var d=cf_getItemAdjustMinMax(Math.ceil(a[a.d["width"]]/a.items[a.d["width"]]),a.items.visibleConf);if(d>b.length){d=b.length}var e=Math.floor(a[a.d["width"]]/d);a.items.visible=d;a.items[a.d["width"]]=e;a[a.d["width"]]=d*e;return a}function bt_pauseOnHoverConfig(a){if(is_string(a)){var b=a.indexOf("immediate")>-1?true:false,c=a.indexOf("resume")>-1?true:false}else{var b=c=false}return[b,c]}function bt_mousesheelNumber(a){return is_number(a)?a:null}function is_null(a){return a===null}function is_undefined(a){return is_null(a)||typeof a=="undefined"||a===""||a==="undefined"}function is_array(a){return a instanceof Array}function is_jquery(a){return a instanceof jQuery}function is_object(a){return(a instanceof Object||typeof a=="object")&&!is_null(a)&&!is_jquery(a)&&!is_array(a)}function is_number(a){return(a instanceof Number||typeof a=="number")&&!isNaN(a)}function is_string(a){return(a instanceof String||typeof a=="string")&&!is_undefined(a)&&!is_true(a)&&!is_false(a)}function is_function(a){return a instanceof Function||typeof a=="function"}function is_boolean(a){return a instanceof Boolean||typeof a=="boolean"||is_true(a)||is_false(a)}function is_true(a){return a===true||a==="true"}function is_false(a){return a===false||a==="false"}function is_percentage(a){return is_string(a)&&a.slice(-1)=="%"}function getTime(){return(new Date).getTime()}function deprecated(a,b){debug(true,a+" is DEPRECATED, support for it will be removed. Use "+b+" instead.")}function debug(a,b){if(is_object(a)){var c=" ("+a.selector+")";a=a.debug}else{var c=""}if(!a){return false}if(is_string(b)){b="carouFredSel"+c+": "+b}else{b=["carouFredSel"+c+":",b]}if(window.console&&window.console.log){window.console.log(b)}return false}if($.fn.carouFredSel){return}$.fn.caroufredsel=$.fn.carouFredSel=function(options,configs){if(this.length==0){debug(true,'No element found for "'+this.selector+'".');return this}if(this.length>1){return this.each(function(){$(this).carouFredSel(options,configs)})}var $cfs=this,$tt0=this[0],starting_position=false;if($cfs.data("_cfs_isCarousel")){starting_position=$cfs.triggerHandler("_cfs_triggerEvent","currentPosition");$cfs.trigger("_cfs_triggerEvent",["destroy",true])}$cfs._cfs_init=function(a,b,c){a=go_getObject($tt0,a);a.items=go_getItemsObject($tt0,a.items);a.scroll=go_getScrollObject($tt0,a.scroll);a.auto=go_getAutoObject($tt0,a.auto);a.prev=go_getPrevNextObject($tt0,a.prev);a.next=go_getPrevNextObject($tt0,a.next);a.pagination=go_getPaginationObject($tt0,a.pagination);a.swipe=go_getSwipeObject($tt0,a.swipe);a.mousewheel=go_getMousewheelObject($tt0,a.mousewheel);if(b){opts_orig=$.extend(true,{},$.fn.carouFredSel.defaults,a)}opts=$.extend(true,{},$.fn.carouFredSel.defaults,a);opts.d=cf_getDimensions(opts);crsl.direction=opts.direction=="up"||opts.direction=="left"?"next":"prev";var d=$cfs.children(),e=ms_getParentSize($wrp,opts,"width");if(is_true(opts.cookie)){opts.cookie="caroufredsel_cookie_"+conf.serialNumber}opts.maxDimension=ms_getMaxDimension(opts,e);opts.items=in_complementItems(opts.items,opts,d,c);opts[opts.d["width"]]=in_complementPrimarySize(opts[opts.d["width"]],opts,d);opts[opts.d["height"]]=in_complementSecondarySize(opts[opts.d["height"]],opts,d);if(opts.responsive){if(!is_percentage(opts[opts.d["width"]])){opts[opts.d["width"]]="100%"}}if(is_percentage(opts[opts.d["width"]])){crsl.upDateOnWindowResize=true;crsl.primarySizePercentage=opts[opts.d["width"]];opts[opts.d["width"]]=ms_getPercentage(e,crsl.primarySizePercentage);if(!opts.items.visible){opts.items.visibleConf.variable=true}}if(opts.responsive){opts.usePadding=false;opts.padding=[0,0,0,0];opts.align=false;opts.items.visibleConf.variable=false}else{if(!opts.items.visible){opts=in_complementVisibleItems(opts,e)}if(!opts[opts.d["width"]]){if(!opts.items.visibleConf.variable&&is_number(opts.items[opts.d["width"]])&&opts.items.filter=="*"){opts[opts.d["width"]]=opts.items.visible*opts.items[opts.d["width"]];opts.align=false}else{opts[opts.d["width"]]="variable"}}if(is_undefined(opts.align)){opts.align=is_number(opts[opts.d["width"]])?"center":false}if(opts.items.visibleConf.variable){opts.items.visible=gn_getVisibleItemsNext(d,opts,0)}}if(opts.items.filter!="*"&&!opts.items.visibleConf.variable){opts.items.visibleConf.org=opts.items.visible;opts.items.visible=gn_getVisibleItemsNextFilter(d,opts,0)}opts.items.visible=cf_getItemsAdjust(opts.items.visible,opts,opts.items.visibleConf.adjust,$tt0);opts.items.visibleConf.old=opts.items.visible;if(opts.responsive){if(!opts.items.visibleConf.min){opts.items.visibleConf.min=opts.items.visible}if(!opts.items.visibleConf.max){opts.items.visibleConf.max=opts.items.visible}opts=in_getResponsiveValues(opts,d,e)}else{opts.padding=cf_getPadding(opts.padding);if(opts.align=="top"){opts.align="left"}else if(opts.align=="bottom"){opts.align="right"}switch(opts.align){case"center":case"left":case"right":if(opts[opts.d["width"]]!="variable"){opts=in_getAlignPadding(opts,d);opts.usePadding=true}break;default:opts.align=false;opts.usePadding=opts.padding[0]==0&&opts.padding[1]==0&&opts.padding[2]==0&&opts.padding[3]==0?false:true;break}}if(!is_number(opts.scroll.duration)){opts.scroll.duration=500}if(is_undefined(opts.scroll.items)){opts.scroll.items=opts.responsive||opts.items.visibleConf.variable||opts.items.filter!="*"?"visible":opts.items.visible}opts.auto=$.extend(true,{},opts.scroll,opts.auto);opts.prev=$.extend(true,{},opts.scroll,opts.prev);opts.next=$.extend(true,{},opts.scroll,opts.next);opts.pagination=$.extend(true,{},opts.scroll,opts.pagination);opts.auto=go_complementAutoObject($tt0,opts.auto);opts.prev=go_complementPrevNextObject($tt0,opts.prev);opts.next=go_complementPrevNextObject($tt0,opts.next);opts.pagination=go_complementPaginationObject($tt0,opts.pagination);opts.swipe=go_complementSwipeObject($tt0,opts.swipe);opts.mousewheel=go_complementMousewheelObject($tt0,opts.mousewheel);if(opts.synchronise){opts.synchronise=cf_getSynchArr(opts.synchronise)}if(opts.auto.onPauseStart){opts.auto.onTimeoutStart=opts.auto.onPauseStart;deprecated("auto.onPauseStart","auto.onTimeoutStart")}if(opts.auto.onPausePause){opts.auto.onTimeoutPause=opts.auto.onPausePause;deprecated("auto.onPausePause","auto.onTimeoutPause")}if(opts.auto.onPauseEnd){opts.auto.onTimeoutEnd=opts.auto.onPauseEnd;deprecated("auto.onPauseEnd","auto.onTimeoutEnd")}if(opts.auto.pauseDuration){opts.auto.timeoutDuration=opts.auto.pauseDuration;deprecated("auto.pauseDuration","auto.timeoutDuration")}};$cfs._cfs_build=function(){$cfs.data("_cfs_isCarousel",true);var a=$cfs.children(),b=in_mapCss($cfs,["textAlign","float","position","top","right","bottom","left","zIndex","width","height","marginTop","marginRight","marginBottom","marginLeft"]),c="relative";switch(b.position){case"absolute":case"fixed":c=b.position;break}$wrp.css(b).css({overflow:"hidden",position:c});$cfs.data("_cfs_origCss",b).css({textAlign:"left","float":"none",position:"absolute",top:0,right:"auto",bottom:"auto",left:0,zIndex:1,marginTop:0,marginRight:0,marginBottom:0,marginLeft:0});sz_storeMargin(a,opts);sz_storeSizes(a,opts);if(opts.responsive){sz_setResponsiveSizes(opts,a)}};$cfs._cfs_bind_events=function(){$cfs._cfs_unbind_events();$cfs.bind(cf_e("stop",conf),function(a,b){a.stopPropagation();if(!crsl.isStopped){if(opts.auto.button){opts.auto.button.addClass(cf_c("stopped",conf))}}crsl.isStopped=true;if(opts.auto.play){opts.auto.play=false;$cfs.trigger(cf_e("pause",conf),b)}return true});$cfs.bind(cf_e("finish",conf),function(a){a.stopPropagation();if(crsl.isScrolling){sc_stopScroll(scrl)}return true});$cfs.bind(cf_e("pause",conf),function(a,b,c){a.stopPropagation();tmrs=sc_clearTimers(tmrs);if(b&&crsl.isScrolling){scrl.isStopped=true;var d=getTime()-scrl.startTime;scrl.duration-=d;if(scrl.pre){scrl.pre.duration-=d}if(scrl.post){scrl.post.duration-=d}sc_stopScroll(scrl,false)}if(!crsl.isPaused&&!crsl.isScrolling){if(c){tmrs.timePassed+=getTime()-tmrs.startTime}}if(!crsl.isPaused){if(opts.auto.button){opts.auto.button.addClass(cf_c("paused",conf))}}crsl.isPaused=true;if(opts.auto.onTimeoutPause){var e=opts.auto.timeoutDuration-tmrs.timePassed,f=100-Math.ceil(e*100/opts.auto.timeoutDuration);opts.auto.onTimeoutPause.call($tt0,f,e)}return true});$cfs.bind(cf_e("play",conf),function(a,b,c,d){a.stopPropagation();tmrs=sc_clearTimers(tmrs);var e=[b,c,d],f=["string","number","boolean"],g=cf_sortParams(e,f);b=g[0];c=g[1];d=g[2];if(b!="prev"&&b!="next"){b=crsl.direction}if(!is_number(c)){c=0}if(!is_boolean(d)){d=false}if(d){crsl.isStopped=false;opts.auto.play=true}if(!opts.auto.play){a.stopImmediatePropagation();return debug(conf,"Carousel stopped: Not scrolling.")}if(crsl.isPaused){if(opts.auto.button){opts.auto.button.removeClass(cf_c("stopped",conf));opts.auto.button.removeClass(cf_c("paused",conf))}}crsl.isPaused=false;tmrs.startTime=getTime();var h=opts.auto.timeoutDuration+c;dur2=h-tmrs.timePassed;perc=100-Math.ceil(dur2*100/h);if(opts.auto.progress){tmrs.progress=setInterval(function(){var a=getTime()-tmrs.startTime+tmrs.timePassed,b=Math.ceil(a*100/h);opts.auto.progress.updater.call(opts.auto.progress.bar[0],b)},opts.auto.progress.interval)}tmrs.auto=setTimeout(function(){if(opts.auto.progress){opts.auto.progress.updater.call(opts.auto.progress.bar[0],100)}if(opts.auto.onTimeoutEnd){opts.auto.onTimeoutEnd.call($tt0,perc,dur2)}if(crsl.isScrolling){$cfs.trigger(cf_e("play",conf),b)}else{$cfs.trigger(cf_e(b,conf),opts.auto)}},dur2);if(opts.auto.onTimeoutStart){opts.auto.onTimeoutStart.call($tt0,perc,dur2)}return true});$cfs.bind(cf_e("resume",conf),function(a){a.stopPropagation();if(scrl.isStopped){scrl.isStopped=false;crsl.isPaused=false;crsl.isScrolling=true;scrl.startTime=getTime();sc_startScroll(scrl)}else{$cfs.trigger(cf_e("play",conf))}return true});$cfs.bind(cf_e("prev",conf)+" "+cf_e("next",conf),function(a,b,c,d,e){a.stopPropagation();if(crsl.isStopped||$cfs.is(":hidden")){a.stopImmediatePropagation();return debug(conf,"Carousel stopped or hidden: Not scrolling.")}var f=is_number(opts.items.minimum)?opts.items.minimum:opts.items.visible+1;if(f>itms.total){a.stopImmediatePropagation();return debug(conf,"Not enough items ("+itms.total+" total, "+f+" needed): Not scrolling.")}var g=[b,c,d,e],h=["object","number/string","function","boolean"],i=cf_sortParams(g,h);b=i[0];c=i[1];d=i[2];e=i[3];var j=a.type.slice(conf.events.prefix.length);if(!is_object(b)){b={}}if(is_function(d)){b.onAfter=d}if(is_boolean(e)){b.queue=e}b=$.extend(true,{},opts[j],b);if(b.conditions&&!b.conditions.call($tt0,j)){a.stopImmediatePropagation();return debug(conf,'Callback "conditions" returned false.')}if(!is_number(c)){if(opts.items.filter!="*"){c="visible"}else{var k=[c,b.items,opts[j].items];for(var i=0,l=k.length;i<l;i++){if(is_number(k[i])||k[i]=="page"||k[i]=="visible"){c=k[i];break}}}switch(c){case"page":a.stopImmediatePropagation();return $cfs.triggerHandler(cf_e(j+"Page",conf),[b,d]);break;case"visible":if(!opts.items.visibleConf.variable&&opts.items.filter=="*"){c=opts.items.visible}break}}if(scrl.isStopped){$cfs.trigger(cf_e("resume",conf));$cfs.trigger(cf_e("queue",conf),[j,[b,c,d]]);a.stopImmediatePropagation();return debug(conf,"Carousel resumed scrolling.")}if(b.duration>0){if(crsl.isScrolling){if(b.queue){$cfs.trigger(cf_e("queue",conf),[j,[b,c,d]])}a.stopImmediatePropagation();return debug(conf,"Carousel currently scrolling.")}}tmrs.timePassed=0;$cfs.trigger(cf_e("slide_"+j,conf),[b,c]);if(opts.synchronise){var m=opts.synchronise,n=[b,c];for(var o=0,l=m.length;o<l;o++){var p=j;if(!m[o][2]){p=p=="prev"?"next":"prev"}if(!m[o][1]){n[0]=m[o][0].triggerHandler("_cfs_triggerEvent",["configuration",p])}n[1]=c+m[o][3];m[o][0].trigger("_cfs_triggerEvent",["slide_"+p,n])}}return true});$cfs.bind(cf_e("slide_prev",conf),function(a,b,c){a.stopPropagation();var d=$cfs.children();if(!opts.circular){if(itms.first==0){if(opts.infinite){$cfs.trigger(cf_e("next",conf),itms.total-1)}return a.stopImmediatePropagation()}}sz_resetMargin(d,opts);if(!is_number(c)){if(opts.items.visibleConf.variable){c=gn_getVisibleItemsPrev(d,opts,itms.total-1)}else if(opts.items.filter!="*"){var e=is_number(b.items)?b.items:gn_getVisibleOrg($cfs,opts);c=gn_getScrollItemsPrevFilter(d,opts,itms.total-1,e)}else{c=opts.items.visible}c=cf_getAdjust(c,opts,b.items,$tt0)}if(!opts.circular){if(itms.total-c<itms.first){c=itms.total-itms.first}}opts.items.visibleConf.old=opts.items.visible;if(opts.items.visibleConf.variable){var f=gn_getVisibleItemsNext(d,opts,itms.total-c);if(opts.items.visible+c<=f&&c<itms.total){c++;f=gn_getVisibleItemsNext(d,opts,itms.total-c)}opts.items.visible=cf_getItemsAdjust(f,opts,opts.items.visibleConf.adjust,$tt0)}else if(opts.items.filter!="*"){var f=gn_getVisibleItemsNextFilter(d,opts,itms.total-c);opts.items.visible=cf_getItemsAdjust(f,opts,opts.items.visibleConf.adjust,$tt0)}sz_resetMargin(d,opts,true);if(c==0){a.stopImmediatePropagation();return debug(conf,"0 items to scroll: Not scrolling.")}debug(conf,"Scrolling "+c+" items backward.");itms.first+=c;while(itms.first>=itms.total){itms.first-=itms.total}if(!opts.circular){if(itms.first==0&&b.onEnd){b.onEnd.call($tt0,"prev")}if(!opts.infinite){nv_enableNavi(opts,itms.first,conf)}}$cfs.children().slice(itms.total-c,itms.total).prependTo($cfs);if(itms.total<opts.items.visible+c){$cfs.children().slice(0,opts.items.visible+c-itms.total).clone(true).appendTo($cfs)}var d=$cfs.children(),g=gi_getOldItemsPrev(d,opts,c),h=gi_getNewItemsPrev(d,opts),i=d.eq(c-1),j=g.last(),k=h.last();sz_resetMargin(d,opts);var l=0,m=0;if(opts.align){var n=cf_getAlignPadding(h,opts);l=n[0];m=n[1]}var o=l<0?opts.padding[opts.d[3]]:0;var p=false,q=$();if(opts.items.visible<c){q=d.slice(opts.items.visibleConf.old,c);if(b.fx=="directscroll"){var r=opts.items[opts.d["width"]];p=q;i=k;sc_hideHiddenItems(p);opts.items[opts.d["width"]]="variable"}}var s=false,t=ms_getTotalSize(d.slice(0,c),opts,"width"),u=cf_mapWrapperSizes(ms_getSizes(h,opts,true),opts,!opts.usePadding),v=0,w={},x={},y={},z={},A={},B={},C={},D=sc_getDuration(b,opts,c,t);switch(b.fx){case"cover":case"cover-fade":v=ms_getTotalSize(d.slice(0,opts.items.visible),opts,"width");break}if(p){opts.items[opts.d["width"]]=r}sz_resetMargin(d,opts,true);if(m>=0){sz_resetMargin(j,opts,opts.padding[opts.d[1]])}if(l>=0){sz_resetMargin(i,opts,opts.padding[opts.d[3]])}if(opts.align){opts.padding[opts.d[1]]=m;opts.padding[opts.d[3]]=l}B[opts.d["left"]]=-(t-o);C[opts.d["left"]]=-(v-o);x[opts.d["left"]]=u[opts.d["width"]];var E=function(){},F=function(){},G=function(){},H=function(){},I=function(){},J=function(){},K=function(){},L=function(){},M=function(){},N=function(){},O=function(){};switch(b.fx){case"crossfade":case"cover":case"cover-fade":case"uncover":case"uncover-fade":s=$cfs.clone(true).appendTo($wrp);break}switch(b.fx){case"crossfade":case"uncover":case"uncover-fade":s.children().slice(0,c).remove();s.children().slice(opts.items.visibleConf.old).remove();break;case"cover":case"cover-fade":s.children().slice(opts.items.visible).remove();s.css(C);break}$cfs.css(B);scrl=sc_setScroll(D,b.easing);w[opts.d["left"]]=opts.usePadding?opts.padding[opts.d[3]]:0;if(opts[opts.d["width"]]=="variable"||opts[opts.d["height"]]=="variable"){E=function(){$wrp.css(u)};F=function(){scrl.anims.push([$wrp,u])}}if(opts.usePadding){if(k.not(i).length){y[opts.d["marginRight"]]=i.data("_cfs_origCssMargin");if(l<0){i.css(y)}else{K=function(){i.css(y)};L=function(){scrl.anims.push([i,y])}}}switch(b.fx){case"cover":case"cover-fade":s.children().eq(c-1).css(y);break}if(k.not(j).length){z[opts.d["marginRight"]]=j.data("_cfs_origCssMargin");G=function(){j.css(z)};H=function(){scrl.anims.push([j,z])}}if(m>=0){A[opts.d["marginRight"]]=k.data("_cfs_origCssMargin")+opts.padding[opts.d[1]];I=function(){k.css(A)};J=function(){scrl.anims.push([k,A])}}}O=function(){$cfs.css(w)};var P=opts.items.visible+c-itms.total;N=function(){if(P>0){$cfs.children().slice(itms.total).remove();g=$($cfs.children().slice(itms.total-(opts.items.visible-P)).get().concat($cfs.children().slice(0,P).get()))}sc_showHiddenItems(p);if(opts.usePadding){var a=$cfs.children().eq(opts.items.visible+c-1);a.css(opts.d["marginRight"],a.data("_cfs_origCssMargin"))}};var Q=sc_mapCallbackArguments(g,q,h,c,"prev",D,u);M=function(){sc_afterScroll($cfs,s,b);crsl.isScrolling=false;clbk.onAfter=sc_fireCallbacks($tt0,b,"onAfter",Q,clbk);queu=sc_fireQueue($cfs,queu,conf);if(!crsl.isPaused){$cfs.trigger(cf_e("play",conf))}};crsl.isScrolling=true;tmrs=sc_clearTimers(tmrs);clbk.onBefore=sc_fireCallbacks($tt0,b,"onBefore",Q,clbk);switch(b.fx){case"none":$cfs.css(w);E();G();I();K();O();N();M();break;case"fade":scrl.anims.push([$cfs,{opacity:0},function(){E();G();I();K();O();N();scrl=sc_setScroll(D,b.easing);scrl.anims.push([$cfs,{opacity:1},M]);sc_startScroll(scrl)}]);break;case"crossfade":$cfs.css({opacity:0});scrl.anims.push([s,{opacity:0}]);scrl.anims.push([$cfs,{opacity:1},M]);F();G();I();K();O();N();break;case"cover":scrl.anims.push([s,w,function(){G();I();K();O();N();M()}]);F();break;case"cover-fade":scrl.anims.push([$cfs,{opacity:0}]);scrl.anims.push([s,w,function(){$cfs.css({opacity:1});G();I();K();O();N();M()}]);F();break;case"uncover":scrl.anims.push([s,x,M]);F();G();I();K();O();N();break;case"uncover-fade":$cfs.css({opacity:0});scrl.anims.push([$cfs,{opacity:1}]);scrl.anims.push([s,x,M]);F();G();I();K();O();N();break;default:scrl.anims.push([$cfs,w,function(){N();M()}]);F();H();J();L();break}sc_startScroll(scrl);cf_setCookie(opts.cookie,$cfs,conf);$cfs.trigger(cf_e("updatePageStatus",conf),[false,u]);return true});$cfs.bind(cf_e("slide_next",conf),function(a,b,c){a.stopPropagation();var d=$cfs.children();if(!opts.circular){if(itms.first==opts.items.visible){if(opts.infinite){$cfs.trigger(cf_e("prev",conf),itms.total-1)}return a.stopImmediatePropagation()}}sz_resetMargin(d,opts);if(!is_number(c)){if(opts.items.filter!="*"){var e=is_number(b.items)?b.items:gn_getVisibleOrg($cfs,opts);c=gn_getScrollItemsNextFilter(d,opts,0,e)}else{c=opts.items.visible}c=cf_getAdjust(c,opts,b.items,$tt0)}var f=itms.first==0?itms.total:itms.first;if(!opts.circular){if(opts.items.visibleConf.variable){var g=gn_getVisibleItemsNext(d,opts,c),e=gn_getVisibleItemsPrev(d,opts,f-1)}else{var g=opts.items.visible,e=opts.items.visible}if(c+g>f){c=f-e}}opts.items.visibleConf.old=opts.items.visible;if(opts.items.visibleConf.variable){var g=gn_getVisibleItemsNextTestCircular(d,opts,c,f);while(opts.items.visible-c>=g&&c<itms.total){c++;g=gn_getVisibleItemsNextTestCircular(d,opts,c,f)}opts.items.visible=cf_getItemsAdjust(g,opts,opts.items.visibleConf.adjust,$tt0)}else if(opts.items.filter!="*"){var g=gn_getVisibleItemsNextFilter(d,opts,c);opts.items.visible=cf_getItemsAdjust(g,opts,opts.items.visibleConf.adjust,$tt0)}sz_resetMargin(d,opts,true);if(c==0){a.stopImmediatePropagation();return debug(conf,"0 items to scroll: Not scrolling.")}debug(conf,"Scrolling "+c+" items forward.");itms.first-=c;while(itms.first<0){itms.first+=itms.total}if(!opts.circular){if(itms.first==opts.items.visible&&b.onEnd){b.onEnd.call($tt0,"next")}if(!opts.infinite){nv_enableNavi(opts,itms.first,conf)}}if(itms.total<opts.items.visible+c){$cfs.children().slice(0,opts.items.visible+c-itms.total).clone(true).appendTo($cfs)}var d=$cfs.children(),h=gi_getOldItemsNext(d,opts),i=gi_getNewItemsNext(d,opts,c),j=d.eq(c-1),k=h.last(),l=i.last();sz_resetMargin(d,opts);var m=0,n=0;if(opts.align){var o=cf_getAlignPadding(i,opts);m=o[0];n=o[1]}var p=false,q=$();if(opts.items.visibleConf.old<c){q=d.slice(opts.items.visibleConf.old,c);if(b.fx=="directscroll"){var r=opts.items[opts.d["width"]];p=q;j=k;sc_hideHiddenItems(p);opts.items[opts.d["width"]]="variable"}}var s=false,t=ms_getTotalSize(d.slice(0,c),opts,"width"),u=cf_mapWrapperSizes(ms_getSizes(i,opts,true),opts,!opts.usePadding),v=0,w={},x={},y={},z={},A={},B=sc_getDuration(b,opts,c,t);switch(b.fx){case"uncover":case"uncover-fade":v=ms_getTotalSize(d.slice(0,opts.items.visibleConf.old),opts,"width");break}if(p){opts.items[opts.d["width"]]=r}if(opts.align){if(opts.padding[opts.d[1]]<0){opts.padding[opts.d[1]]=0}}sz_resetMargin(d,opts,true);sz_resetMargin(k,opts,opts.padding[opts.d[1]]);if(opts.align){opts.padding[opts.d[1]]=n;opts.padding[opts.d[3]]=m}A[opts.d["left"]]=opts.usePadding?opts.padding[opts.d[3]]:0;var C=function(){},D=function(){},E=function(){},F=function(){},G=function(){},H=function(){},I=function(){},J=function(){},K=function(){};switch(b.fx){case"crossfade":case"cover":case"cover-fade":case"uncover":case"uncover-fade":s=$cfs.clone(true).appendTo($wrp);s.children().slice(opts.items.visibleConf.old).remove();break}switch(b.fx){case"crossfade":case"cover":case"cover-fade":s.css("zIndex",0);break}scrl=sc_setScroll(B,b.easing);w[opts.d["left"]]=-t;x[opts.d["left"]]=-v;if(m<0){w[opts.d["left"]]+=m}if(opts[opts.d["width"]]=="variable"||opts[opts.d["height"]]=="variable"){C=function(){$wrp.css(u)};D=function(){scrl.anims.push([$wrp,u])}}if(opts.usePadding){var L=l.data("_cfs_origCssMargin");if(n>=0){L+=opts.padding[opts.d[1]]}l.css(opts.d["marginRight"],L);if(j.not(k).length){z[opts.d["marginRight"]]=k.data("_cfs_origCssMargin")}E=function(){k.css(z)};F=function(){scrl.anims.push([k,z])};var M=j.data("_cfs_origCssMargin");if(m>0){M+=opts.padding[opts.d[3]]}y[opts.d["marginRight"]]=M;G=function(){j.css(y)};H=function(){scrl.anims.push([j,y])}}K=function(){$cfs.css(A)};var N=opts.items.visible+c-itms.total;J=function(){if(N>0){$cfs.children().slice(itms.total).remove()}var a=$cfs.children().slice(0,c).appendTo($cfs).last();if(N>0){i=gi_getCurrentItems(d,opts)}sc_showHiddenItems(p);if(opts.usePadding){if(itms.total<opts.items.visible+c){var b=$cfs.children().eq(opts.items.visible-1);b.css(opts.d["marginRight"],b.data("_cfs_origCssMargin")+opts.padding[opts.d[3]])}a.css(opts.d["marginRight"],a.data("_cfs_origCssMargin"))}};var O=sc_mapCallbackArguments(h,q,i,c,"next",B,u);I=function(){sc_afterScroll($cfs,s,b);crsl.isScrolling=false;clbk.onAfter=sc_fireCallbacks($tt0,b,"onAfter",O,clbk);queu=sc_fireQueue($cfs,queu,conf);if(!crsl.isPaused){$cfs.trigger(cf_e("play",conf))}};crsl.isScrolling=true;tmrs=sc_clearTimers(tmrs);clbk.onBefore=sc_fireCallbacks($tt0,b,"onBefore",O,clbk);switch(b.fx){case"none":$cfs.css(w);C();E();G();K();J();I();break;case"fade":scrl.anims.push([$cfs,{opacity:0},function(){C();E();G();K();J();scrl=sc_setScroll(B,b.easing);scrl.anims.push([$cfs,{opacity:1},I]);sc_startScroll(scrl)}]);break;case"crossfade":$cfs.css({opacity:0});scrl.anims.push([s,{opacity:0}]);scrl.anims.push([$cfs,{opacity:1},I]);D();E();G();K();J();break;case"cover":$cfs.css(opts.d["left"],$wrp[opts.d["width"]]());scrl.anims.push([$cfs,A,I]);D();E();G();J();break;case"cover-fade":$cfs.css(opts.d["left"],$wrp[opts.d["width"]]());scrl.anims.push([s,{opacity:0}]);scrl.anims.push([$cfs,A,I]);D();E();G();J();break;case"uncover":scrl.anims.push([s,x,I]);D();E();G();K();J();break;case"uncover-fade":$cfs.css({opacity:0});scrl.anims.push([$cfs,{opacity:1}]);scrl.anims.push([s,x,I]);D();E();G();K();J();break;default:scrl.anims.push([$cfs,w,function(){K();J();I()}]);D();F();H();break}sc_startScroll(scrl);cf_setCookie(opts.cookie,$cfs,conf);$cfs.trigger(cf_e("updatePageStatus",conf),[false,u]);return true});$cfs.bind(cf_e("slideTo",conf),function(a,b,c,d,e,f,g){a.stopPropagation();var h=[b,c,d,e,f,g],i=["string/number/object","number","boolean","object","string","function"],j=cf_sortParams(h,i);e=j[3];f=j[4];g=j[5];b=gn_getItemIndex(j[0],j[1],j[2],itms,$cfs);if(b==0){return false}if(!is_object(e)){e=false}if(crsl.isScrolling){if(!is_object(e)||e.duration>0){return false}}if(f!="prev"&&f!="next"){if(opts.circular){f=b<=itms.total/2?"next":"prev"}else{f=itms.first==0||itms.first>b?"next":"prev"}}if(f=="prev"){b=itms.total-b}$cfs.trigger(cf_e(f,conf),[e,b,g]);return true});$cfs.bind(cf_e("prevPage",conf),function(a,b,c){a.stopPropagation();var d=$cfs.triggerHandler(cf_e("currentPage",conf));return $cfs.triggerHandler(cf_e("slideToPage",conf),[d-1,b,"prev",c])});$cfs.bind(cf_e("nextPage",conf),function(a,b,c){a.stopPropagation();var d=$cfs.triggerHandler(cf_e("currentPage",conf));return $cfs.triggerHandler(cf_e("slideToPage",conf),[d+1,b,"next",c])});$cfs.bind(cf_e("slideToPage",conf),function(a,b,c,d,e){a.stopPropagation();if(!is_number(b)){b=$cfs.triggerHandler(cf_e("currentPage",conf))}var f=opts.pagination.items||opts.items.visible,g=Math.ceil(itms.total/f)-1;if(b<0){b=g}if(b>g){b=0}return $cfs.triggerHandler(cf_e("slideTo",conf),[b*f,0,true,c,d,e])});$cfs.bind(cf_e("jumpToStart",conf),function(a,b){a.stopPropagation();if(b){b=gn_getItemIndex(b,0,true,itms,$cfs)}else{b=0}b+=itms.first;if(b!=0){if(items.total>0){while(b>itms.total){b-=itms.total}}$cfs.prepend($cfs.children().slice(b,itms.total))}return true});$cfs.bind(cf_e("synchronise",conf),function(a,b){a.stopPropagation();if(b){b=cf_getSynchArr(b)}else if(opts.synchronise){b=opts.synchronise}else{return debug(conf,"No carousel to synchronise.")}var c=$cfs.triggerHandler(cf_e("currentPosition",conf)),d=true;for(var e=0,f=b.length;e<f;e++){if(!b[e][0].triggerHandler(cf_e("slideTo",conf),[c,b[e][3],true])){d=false}}return d});$cfs.bind(cf_e("queue",conf),function(a,b,c){a.stopPropagation();if(is_function(b)){b.call($tt0,queu)}else if(is_array(b)){queu=b}else if(!is_undefined(b)){queu.push([b,c])}return queu});$cfs.bind(cf_e("insertItem",conf),function(a,b,c,d,e){a.stopPropagation();var f=[b,c,d,e],g=["string/object","string/number/object","boolean","number"],h=cf_sortParams(f,g);b=h[0];c=h[1];d=h[2];e=h[3];if(is_object(b)&&!is_jquery(b)){b=$(b)}else if(is_string(b)){b=$(b)}if(!is_jquery(b)||b.length==0){return debug(conf,"Not a valid object.")}if(is_undefined(c)){c="end"}sz_storeMargin(b,opts);sz_storeSizes(b,opts);var i=c,j="before";if(c=="end"){if(d){if(itms.first==0){c=itms.total-1;j="after"}else{c=itms.first;itms.first+=b.length}if(c<0){c=0}}else{c=itms.total-1;j="after"}}else{c=gn_getItemIndex(c,e,d,itms,$cfs)}if(i!="end"&&!d){if(c<itms.first){itms.first+=b.length}}if(itms.first>=itms.total){itms.first-=itms.total}var k=$cfs.children().eq(c);if(k.length){k[j](b)}else{$cfs.append(b)}itms.total=$cfs.children().length;$cfs.trigger(cf_e("updateSizes",conf));$cfs.trigger(cf_e("linkAnchors",conf));return true});$cfs.bind(cf_e("removeItem",conf),function(a,b,c,d){a.stopPropagation();var e=[b,c,d],f=["string/number/object","boolean","number"],g=cf_sortParams(e,f);b=g[0];c=g[1];d=g[2];var h=false;if(b instanceof $&&b.length>1){i=$();b.each(function(a,b){var e=$cfs.trigger(cf_e("removeItem",conf),[$(this),c,d]);if(e)i=i.add(e)});return i}if(is_undefined(b)||b=="end"){i=$cfs.children().last()}else{b=gn_getItemIndex(b,d,c,itms,$cfs);var i=$cfs.children().eq(b);if(i.length){if(b<itms.first)itms.first-=i.length}}if(i&&i.length){i.detach();itms.total=$cfs.children().length;$cfs.trigger(cf_e("updateSizes",conf))}return i});$cfs.bind(cf_e("onBefore",conf)+" "+cf_e("onAfter",conf),function(a,b){a.stopPropagation();var c=a.type.slice(conf.events.prefix.length);if(is_array(b)){clbk[c]=b}if(is_function(b)){clbk[c].push(b)}return clbk[c]});$cfs.bind(cf_e("currentPosition",conf),function(a,b){a.stopPropagation();if(itms.first==0){var c=0}else{var c=itms.total-itms.first}if(is_function(b)){b.call($tt0,c)}return c});$cfs.bind(cf_e("currentPage",conf),function(a,b){a.stopPropagation();var c=opts.pagination.items||opts.items.visible,d=Math.ceil(itms.total/c-1),e;if(itms.first==0){e=0}else if(itms.first<itms.total%c){e=0}else if(itms.first==c&&!opts.circular){e=d}else{e=Math.round((itms.total-itms.first)/c)}if(e<0){e=0}if(e>d){e=d}if(is_function(b)){b.call($tt0,e)}return e});$cfs.bind(cf_e("currentVisible",conf),function(a,b){a.stopPropagation();var c=gi_getCurrentItems($cfs.children(),opts);if(is_function(b)){b.call($tt0,c)}return c});$cfs.bind(cf_e("slice",conf),function(a,b,c,d){a.stopPropagation();if(itms.total==0){return false}var e=[b,c,d],f=["number","number","function"],g=cf_sortParams(e,f);b=is_number(g[0])?g[0]:0;c=is_number(g[1])?g[1]:itms.total;d=g[2];b+=itms.first;c+=itms.first;if(items.total>0){while(b>itms.total){b-=itms.total}while(c>itms.total){c-=itms.total}while(b<0){b+=itms.total}while(c<0){c+=itms.total}}var h=$cfs.children(),i;if(c>b){i=h.slice(b,c)}else{i=$(h.slice(b,itms.total).get().concat(h.slice(0,c).get()))}if(is_function(d)){d.call($tt0,i)}return i});$cfs.bind(cf_e("isPaused",conf)+" "+cf_e("isStopped",conf)+" "+cf_e("isScrolling",conf),function(a,b){a.stopPropagation();var c=a.type.slice(conf.events.prefix.length),d=crsl[c];if(is_function(b)){b.call($tt0,d)}return d});$cfs.bind(cf_e("configuration",conf),function(e,a,b,c){e.stopPropagation();var reInit=false;if(is_function(a)){a.call($tt0,opts)}else if(is_object(a)){opts_orig=$.extend(true,{},opts_orig,a);if(b!==false)reInit=true;else opts=$.extend(true,{},opts,a)}else if(!is_undefined(a)){if(is_function(b)){var val=eval("opts."+a);if(is_undefined(val)){val=""}b.call($tt0,val)}else if(!is_undefined(b)){if(typeof c!=="boolean")c=true;eval("opts_orig."+a+" = b");if(c!==false)reInit=true;else eval("opts."+a+" = b")}else{return eval("opts."+a)}}if(reInit){sz_resetMargin($cfs.children(),opts);$cfs._cfs_init(opts_orig);$cfs._cfs_bind_buttons();var sz=sz_setSizes($cfs,opts);$cfs.trigger(cf_e("updatePageStatus",conf),[true,sz])}return opts});$cfs.bind(cf_e("linkAnchors",conf),function(a,b,c){a.stopPropagation();if(is_undefined(b)){b=$("body")}else if(is_string(b)){b=$(b)}if(!is_jquery(b)||b.length==0){return debug(conf,"Not a valid object.")}if(!is_string(c)){c="a.caroufredsel"}b.find(c).each(function(){var a=this.hash||"";if(a.length>0&&$cfs.children().index($(a))!=-1){$(this).unbind("click").click(function(b){b.preventDefault();$cfs.trigger(cf_e("slideTo",conf),a)})}});return true});$cfs.bind(cf_e("updatePageStatus",conf),function(a,b,c){a.stopPropagation();if(!opts.pagination.container){return}var d=opts.pagination.items||opts.items.visible,e=Math.ceil(itms.total/d);if(b){if(opts.pagination.anchorBuilder){opts.pagination.container.children().remove();opts.pagination.container.each(function(){for(var a=0;a<e;a++){var b=$cfs.children().eq(gn_getItemIndex(a*d,0,true,itms,$cfs));$(this).append(opts.pagination.anchorBuilder.call(b[0],a+1))}})}opts.pagination.container.each(function(){$(this).children().unbind(opts.pagination.event).each(function(a){$(this).bind(opts.pagination.event,function(b){b.preventDefault();$cfs.trigger(cf_e("slideTo",conf),[a*d,-opts.pagination.deviation,true,opts.pagination])})})})}var f=$cfs.triggerHandler(cf_e("currentPage",conf))+opts.pagination.deviation;if(f>=e){f=0}if(f<0){f=e-1}opts.pagination.container.each(function(){$(this).children().removeClass(cf_c("selected",conf)).eq(f).addClass(cf_c("selected",conf))});return true});$cfs.bind(cf_e("updateSizes",conf),function(a){var b=opts.items.visible,c=$cfs.children(),d=ms_getParentSize($wrp,opts,"width");itms.total=c.length;opts.maxDimension=ms_getMaxDimension(opts,d);if(crsl.primarySizePercentage){opts[opts.d["width"]]=ms_getPercentage(d,crsl.primarySizePercentage)}if(opts.responsive){opts.items.width=opts.items.sizesConf.width;opts.items.height=opts.items.sizesConf.height;opts=in_getResponsiveValues(opts,c,d);b=opts.items.visible;sz_setResponsiveSizes(opts,c)}else if(opts.items.visibleConf.variable){b=gn_getVisibleItemsNext(c,opts,0)}else if(opts.items.filter!="*"){b=gn_getVisibleItemsNextFilter(c,opts,0)}if(!opts.circular&&itms.first!=0&&b>itms.first){if(opts.items.visibleConf.variable){var e=gn_getVisibleItemsPrev(c,opts,itms.first)-itms.first}else if(opts.items.filter!="*"){var e=gn_getVisibleItemsPrevFilter(c,opts,itms.first)-itms.first}else{var e=opts.items.visible-itms.first}debug(conf,"Preventing non-circular: sliding "+e+" items backward.");$cfs.trigger(cf_e("prev",conf),e)}opts.items.visible=cf_getItemsAdjust(b,opts,opts.items.visibleConf.adjust,$tt0);opts.items.visibleConf.old=opts.items.visible;opts=in_getAlignPadding(opts,c);var f=sz_setSizes($cfs,opts);$cfs.trigger(cf_e("updatePageStatus",conf),[true,f]);nv_showNavi(opts,itms.total,conf);nv_enableNavi(opts,itms.first,conf);return f});$cfs.bind(cf_e("destroy",conf),function(a,b){a.stopPropagation();tmrs=sc_clearTimers(tmrs);$cfs.data("_cfs_isCarousel",false);$cfs.trigger(cf_e("finish",conf));if(b){$cfs.trigger(cf_e("jumpToStart",conf))}sz_resetMargin($cfs.children(),opts);if(opts.responsive){$cfs.children().each(function(){$(this).css($(this).data("_cfs_origCssSizes"))})}$cfs.css($cfs.data("_cfs_origCss"));$cfs._cfs_unbind_events();$cfs._cfs_unbind_buttons();$wrp.replaceWith($cfs);return true});$cfs.bind(cf_e("debug",conf),function(a){debug(conf,"Carousel width: "+opts.width);debug(conf,"Carousel height: "+opts.height);debug(conf,"Item widths: "+opts.items.width);debug(conf,"Item heights: "+opts.items.height);debug(conf,"Number of items visible: "+opts.items.visible);if(opts.auto.play){debug(conf,"Number of items scrolled automatically: "+opts.auto.items)}if(opts.prev.button){debug(conf,"Number of items scrolled backward: "+opts.prev.items)}if(opts.next.button){debug(conf,"Number of items scrolled forward: "+opts.next.items)}return conf.debug});$cfs.bind("_cfs_triggerEvent",function(a,b,c){a.stopPropagation();return $cfs.triggerHandler(cf_e(b,conf),c)})};$cfs._cfs_unbind_events=function(){$cfs.unbind(cf_e("",conf));$cfs.unbind(cf_e("",conf,false));$cfs.unbind("_cfs_triggerEvent")};$cfs._cfs_bind_buttons=function(){$cfs._cfs_unbind_buttons();nv_showNavi(opts,itms.total,conf);nv_enableNavi(opts,itms.first,conf);if(opts.auto.pauseOnHover){var a=bt_pauseOnHoverConfig(opts.auto.pauseOnHover);$wrp.bind(cf_e("mouseenter",conf,false),function(){$cfs.trigger(cf_e("pause",conf),a)}).bind(cf_e("mouseleave",conf,false),function(){$cfs.trigger(cf_e("resume",conf))})}if(opts.auto.button){opts.auto.button.bind(cf_e(opts.auto.event,conf,false),function(a){a.preventDefault();var b=false,c=null;if(crsl.isPaused){b="play"}else if(opts.auto.pauseOnEvent){b="pause";c=bt_pauseOnHoverConfig(opts.auto.pauseOnEvent)}if(b){$cfs.trigger(cf_e(b,conf),c)}})}if(opts.prev.button){opts.prev.button.bind(cf_e(opts.prev.event,conf,false),function(a){a.preventDefault();$cfs.trigger(cf_e("prev",conf))});if(opts.prev.pauseOnHover){var a=bt_pauseOnHoverConfig(opts.prev.pauseOnHover);opts.prev.button.bind(cf_e("mouseenter",conf,false),function(){$cfs.trigger(cf_e("pause",conf),a)}).bind(cf_e("mouseleave",conf,false),function(){$cfs.trigger(cf_e("resume",conf))})}}if(opts.next.button){opts.next.button.bind(cf_e(opts.next.event,conf,false),function(a){a.preventDefault();$cfs.trigger(cf_e("next",conf))});if(opts.next.pauseOnHover){var a=bt_pauseOnHoverConfig(opts.next.pauseOnHover);opts.next.button.bind(cf_e("mouseenter",conf,false),function(){$cfs.trigger(cf_e("pause",conf),a)}).bind(cf_e("mouseleave",conf,false),function(){$cfs.trigger(cf_e("resume",conf))})}}if(opts.pagination.container){if(opts.pagination.pauseOnHover){var a=bt_pauseOnHoverConfig(opts.pagination.pauseOnHover);opts.pagination.container.bind(cf_e("mouseenter",conf,false),function(){$cfs.trigger(cf_e("pause",conf),a)}).bind(cf_e("mouseleave",conf,false),function(){$cfs.trigger(cf_e("resume",conf))})}}if(opts.prev.key||opts.next.key){$(document).bind(cf_e("keyup",conf,false,true,true),function(a){var b=a.keyCode;if(b==opts.next.key){a.preventDefault();$cfs.trigger(cf_e("next",conf))}if(b==opts.prev.key){a.preventDefault();$cfs.trigger(cf_e("prev",conf))}})}if(opts.pagination.keys){$(document).bind(cf_e("keyup",conf,false,true,true),function(a){var b=a.keyCode;if(b>=49&&b<58){b=(b-49)*opts.items.visible;if(b<=itms.total){a.preventDefault();$cfs.trigger(cf_e("slideTo",conf),[b,0,true,opts.pagination])}}})}if(opts.prev.wipe||opts.next.wipe){deprecated("the touchwipe-plugin","the touchSwipe-plugin");if($.fn.touchwipe){var b=opts.prev.wipe?function(){$cfs.trigger(cf_e("prev",conf))}:null,c=opts.next.wipe?function(){$cfs.trigger(cf_e("next",conf))}:null;if(c||c){if(!crsl.touchwipe){crsl.touchwipe=true;var d={min_move_x:30,min_move_y:30,preventDefaultEvents:true};switch(opts.direction){case"up":case"down":d.wipeUp=b;d.wipeDown=c;break;default:d.wipeLeft=c;d.wipeRight=b}$wrp.touchwipe(d)}}}}if($.fn.swipe){var e="ontouchstart"in window;if(e&&opts.swipe.onTouch||!e&&opts.swipe.onMouse){var f=$.extend(true,{},opts.prev,opts.swipe),g=$.extend(true,{},opts.next,opts.swipe),h=function(){$cfs.trigger(cf_e("prev",conf),[f])},i=function(){$cfs.trigger(cf_e("next",conf),[g])};switch(opts.direction){case"up":case"down":opts.swipe.options.swipeUp=i;opts.swipe.options.swipeDown=h;break;default:opts.swipe.options.swipeLeft=i;opts.swipe.options.swipeRight=h}if(crsl.swipe){$cfs.swipe("destroy")}$wrp.swipe(opts.swipe.options);$wrp.css("cursor","move");crsl.swipe=true}}if($.fn.mousewheel){if(opts.prev.mousewheel){deprecated("The prev.mousewheel option","the mousewheel configuration object");opts.prev.mousewheel=null;opts.mousewheel={items:bt_mousesheelNumber(opts.prev.mousewheel)}}if(opts.next.mousewheel){deprecated("The next.mousewheel option","the mousewheel configuration object");opts.next.mousewheel=null;opts.mousewheel={items:bt_mousesheelNumber(opts.next.mousewheel)}}if(opts.mousewheel){var j=$.extend(true,{},opts.prev,opts.mousewheel),k=$.extend(true,{},opts.next,opts.mousewheel);if(crsl.mousewheel){$wrp.unbind(cf_e("mousewheel",conf,false))}$wrp.bind(cf_e("mousewheel",conf,false),function(a,b){a.preventDefault();if(b>0){$cfs.trigger(cf_e("prev",conf),[j])}else{$cfs.trigger(cf_e("next",conf),[k])}});crsl.mousewheel=true}}if(opts.auto.play){$cfs.trigger(cf_e("play",conf),opts.auto.delay)}if(crsl.upDateOnWindowResize){var l=$(window),m=0,n=0;l.bind(cf_e("resize",conf,false,true,true),function(a){var b=l.width(),c=l.height();if(b!=m||c!=n){$cfs.trigger(cf_e("finish",conf));if(opts.auto.pauseOnResize&&!crsl.isPaused){$cfs.trigger(cf_e("play",conf))}sz_resetMargin($cfs.children(),opts);$cfs.trigger(cf_e("updateSizes",conf));m=b;n=c}})}};$cfs._cfs_unbind_buttons=function(){var a=cf_e("",conf),b=cf_e("",conf,false);ns3=cf_e("",conf,false,true,true);$(document).unbind(ns3);$(window).unbind(ns3);$wrp.unbind(b);if(opts.auto.button){opts.auto.button.unbind(b)}if(opts.prev.button){opts.prev.button.unbind(b)}if(opts.next.button){opts.next.button.unbind(b)}if(opts.pagination.container){opts.pagination.container.unbind(b);if(opts.pagination.anchorBuilder){opts.pagination.container.children().remove()}}if(crsl.swipe){$cfs.swipe("destroy");$wrp.css("cursor","default");crsl.swipe=false}if(crsl.mousewheel){crsl.mousewheel=false}nv_showNavi(opts,"hide",conf);nv_enableNavi(opts,"removeClass",conf)};if(is_boolean(configs)){configs={debug:configs}}var crsl={direction:"next",isPaused:true,isScrolling:false,isStopped:false,mousewheel:false,swipe:false},itms={total:$cfs.children().length,first:0},tmrs={auto:null,progress:null,startTime:getTime(),timePassed:0},scrl={isStopped:false,duration:0,startTime:0,easing:"",anims:[]},clbk={onBefore:[],onAfter:[]},queu=[],conf=$.extend(true,{},$.fn.carouFredSel.configs,configs),opts={},opts_orig=$.extend(true,{},options),$wrp=$cfs.wrap("<"+conf.wrapper.element+' class="'+conf.wrapper.classname+'" />').parent();conf.selector=$cfs.selector;conf.serialNumber=$.fn.carouFredSel.serialNumber++;$cfs._cfs_init(opts_orig,true,starting_position);$cfs._cfs_build();$cfs._cfs_bind_events();$cfs._cfs_bind_buttons();if(is_array(opts.items.start)){var start_arr=opts.items.start}else{var start_arr=[];if(opts.items.start!=0){start_arr.push(opts.items.start)}}if(opts.cookie){start_arr.unshift(parseInt(cf_getCookie(opts.cookie),10))}if(start_arr.length>0){for(var a=0,l=start_arr.length;a<l;a++){var s=start_arr[a];if(s==0){continue}if(s===true){s=window.location.hash;if(s.length<1){continue}}else if(s==="random"){s=Math.floor(Math.random()*itms.total)}if($cfs.triggerHandler(cf_e("slideTo",conf),[s,0,true,{fx:"none"}])){break}}}var siz=sz_setSizes($cfs,opts),itm=gi_getCurrentItems($cfs.children(),opts);if(opts.onCreate){opts.onCreate.call($tt0,{width:siz.width,height:siz.height,items:itm})}$cfs.trigger(cf_e("updatePageStatus",conf),[true,siz]);$cfs.trigger(cf_e("linkAnchors",conf));if(conf.debug){$cfs.trigger(cf_e("debug",conf))}return $cfs};$.fn.carouFredSel.serialNumber=1;$.fn.carouFredSel.defaults={synchronise:false,infinite:true,circular:true,responsive:false,direction:"left",items:{start:0},scroll:{easing:"swing",duration:500,pauseOnHover:false,event:"click",queue:false}};$.fn.carouFredSel.configs={debug:false,events:{prefix:"",namespace:"cfs"},wrapper:{element:"div",classname:"caroufredsel_wrapper"},classnames:{}};$.fn.carouFredSel.pageAnchorBuilder=function(a){return'<a href="#"><span>'+a+"</span></a>"};$.fn.carouFredSel.progressbarUpdater=function(a){$(this).css("width",a+"%")};$.fn.carouFredSel.cookie={get:function(a){a+="=";var b=document.cookie.split(";");for(var c=0,d=b.length;c<d;c++){var e=b[c];while(e.charAt(0)==" "){e=e.slice(1)}if(e.indexOf(a)==0){return e.slice(a.length)}}return 0},set:function(a,b,c){var d="";if(c){var e=new Date;e.setTime(e.getTime()+c*24*60*60*1e3);d="; expires="+e.toGMTString()}document.cookie=a+"="+b+d+"; path=/"},remove:function(a){$.fn.carouFredSel.cookie.set(a,"",-1)}};$.extend($.easing,{quadratic:function(a){var b=a*a;return a*(-b*a+4*b-6*a+4)},cubic:function(a){return a*(4*a*a-9*a+6)},elastic:function(a){var b=a*a;return a*(33*b*b-106*b*a+126*b-67*a+15)}})})(jQuery);

/*  ColorBox v1.3.20.1 - jQuery lightbox plugin
 *  (c) 2011 Jack Moore - jacklmoore.com
 *  License: http://www.opensource.org/licenses/mit-license.php
 */
(function(a,b,c){function Z(c,d,e){var g=b.createElement(c);if(d){g.id=f+d}if(e){g.style.cssText=e}return a(g)}function $(a){var b=y.length,c=(Q+a)%b;return c<0?b+c:c}function _(a,b){return Math.round((/%/.test(a)?(b==="x"?bb():cb())/100:1)*parseInt(a,10))}function ab(a){return K.photo||/\.(gif|png|jp(e|g|eg)|bmp|ico)((#|\?).*)?$/i.test(a)}function bb(){return c.innerWidth||z.width()}function cb(){return c.innerHeight||z.height()}function db(){var b,c=a.data(P,e);if(c==null){K=a.extend({},d);if(console&&console.log){console.log("Error: cboxElement missing settings object")}}else{K=a.extend({},c)}for(b in K){if(a.isFunction(K[b])&&b.slice(0,2)!=="on"){K[b]=K[b].call(P)}}K.rel=K.rel||P.rel||a(P).data("rel")||"nofollow";K.href=K.href||a(P).attr("href");K.title=K.title||P.title;if(typeof K.href==="string"){K.href=a.trim(K.href)}}function eb(b,c){a.event.trigger(b);if(c){c.call(P)}}function fb(){var a,b=f+"Slideshow_",c="click."+f,d,e,g;if(K.slideshow&&y[1]){d=function(){F.html(K.slideshowStop).unbind(c).bind(j,function(){if(K.loop||y[Q+1]){a=setTimeout(W.next,K.slideshowSpeed)}}).bind(i,function(){clearTimeout(a)}).one(c+" "+k,e);r.removeClass(b+"off").addClass(b+"on");a=setTimeout(W.next,K.slideshowSpeed)};e=function(){clearTimeout(a);F.html(K.slideshowStart).unbind([j,i,k,c].join(" ")).one(c,function(){W.next();d()});r.removeClass(b+"on").addClass(b+"off")};if(K.slideshowAuto){d()}else{e()}}else{r.removeClass(b+"off "+b+"on")}}function gb(b){if(!U){P=b;db();y=a(P);Q=0;if(K.rel!=="nofollow"){y=a("."+g).filter(function(){var b=a.data(this,e),c;if(b){c=a(this).data("rel")||b.rel||this.rel}return c===K.rel});Q=y.index(P);if(Q===-1){y=y.add(P);Q=y.length-1}}if(!S){S=T=true;r.show();if(K.returnFocus){a(P).blur().one(l,function(){a(this).focus()})}q.css({opacity:+K.opacity,cursor:K.overlayClose?"pointer":"auto"}).show();K.w=_(K.initialWidth,"x");K.h=_(K.initialHeight,"y");W.position();if(o){z.bind("resize."+p+" scroll."+p,function(){q.css({width:bb(),height:cb(),top:z.scrollTop(),left:z.scrollLeft()})}).trigger("resize."+p)}eb(h,K.onOpen);J.add(D).hide();I.html(K.close).show()}W.load(true)}}function hb(){if(!r&&b.body){Y=false;z=a(c);r=Z(X).attr({id:e,"class":n?f+(o?"IE6":"IE"):""}).hide();q=Z(X,"Overlay",o?"position:absolute":"").hide();C=Z(X,"LoadingOverlay").add(Z(X,"LoadingGraphic"));s=Z(X,"Wrapper");t=Z(X,"Content").append(A=Z(X,"LoadedContent","width:0; height:0; overflow:hidden"),D=Z(X,"Title"),E=Z(X,"Current"),G=Z(X,"Next"),H=Z(X,"Previous"),F=Z(X,"Slideshow").bind(h,fb),I=Z(X,"Close"));s.append(Z(X).append(Z(X,"TopLeft"),u=Z(X,"TopCenter"),Z(X,"TopRight")),Z(X,false,"clear:left").append(v=Z(X,"MiddleLeft"),t,w=Z(X,"MiddleRight")),Z(X,false,"clear:left").append(Z(X,"BottomLeft"),x=Z(X,"BottomCenter"),Z(X,"BottomRight"))).find("div div").css({"float":"left"});B=Z(X,false,"position:absolute; width:9999px; visibility:hidden; display:none");J=G.add(H).add(E).add(F);a(b.body).append(q,r.append(s,B))}}function ib(){if(r){if(!Y){Y=true;L=u.height()+x.height()+t.outerHeight(true)-t.height();M=v.width()+w.width()+t.outerWidth(true)-t.width();N=A.outerHeight(true);O=A.outerWidth(true);r.css({"padding-bottom":L,"padding-right":M});G.click(function(){W.next()});H.click(function(){W.prev()});I.click(function(){W.close()});q.click(function(){if(K.overlayClose){W.close()}});a(b).bind("keydown."+f,function(a){var b=a.keyCode;if(S&&K.escKey&&b===27){a.preventDefault();W.close()}if(S&&K.arrowKey&&y[1]){if(b===37){a.preventDefault();H.click()}else if(b===39){a.preventDefault();G.click()}}});a("."+g,b).live("click",function(a){if(!(a.which>1||a.shiftKey||a.altKey||a.metaKey)){a.preventDefault();gb(this)}})}return true}return false}var d={transition:"elastic",speed:300,width:false,initialWidth:"600",innerWidth:false,maxWidth:false,height:false,initialHeight:"450",innerHeight:false,maxHeight:false,scalePhotos:true,scrolling:true,inline:false,html:false,iframe:false,fastIframe:true,photo:false,href:false,title:false,rel:false,opacity:.9,preloading:true,current:"image {current} of {total}",previous:"previous",next:"next",close:"close",xhrError:"This content failed to load.",imgError:"This image failed to load.",open:false,returnFocus:true,reposition:true,loop:true,slideshow:false,slideshowAuto:true,slideshowSpeed:2500,slideshowStart:"start slideshow",slideshowStop:"stop slideshow",onOpen:false,onLoad:false,onComplete:false,onCleanup:false,onClosed:false,overlayClose:true,escKey:true,arrowKey:true,top:false,bottom:false,left:false,right:false,fixed:false,data:undefined},e="colorbox",f="cbox",g=f+"Element",h=f+"_open",i=f+"_load",j=f+"_complete",k=f+"_cleanup",l=f+"_closed",m=f+"_purge",n=!a.support.opacity&&!a.support.style,o=n&&!c.XMLHttpRequest,p=f+"_IE6",q,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X="div",Y;if(a.colorbox){return}a(hb);W=a.fn[e]=a[e]=function(b,c){var f=this;b=b||{};hb();if(ib()){if(!f[0]){if(f.selector){return f}f=a("<a/>");b.open=true}if(c){b.onComplete=c}f.each(function(){a.data(this,e,a.extend({},a.data(this,e)||d,b))}).addClass(g);if(a.isFunction(b.open)&&b.open.call(f)||b.open){gb(f[0])}}return f};W.position=function(a,b){function j(a){u[0].style.width=x[0].style.width=t[0].style.width=a.style.width;t[0].style.height=v[0].style.height=w[0].style.height=a.style.height}var c,d=0,e=0,g=r.offset(),h,i;z.unbind("resize."+f);r.css({top:-9e4,left:-9e4});h=z.scrollTop();i=z.scrollLeft();if(K.fixed&&!o){g.top-=h;g.left-=i;r.css({position:"fixed"})}else{d=h;e=i;r.css({position:"absolute"})}if(K.right!==false){e+=Math.max(bb()-K.w-O-M-_(K.right,"x"),0)}else if(K.left!==false){e+=_(K.left,"x")}else{e+=Math.round(Math.max(bb()-K.w-O-M,0)/2)}if(K.bottom!==false){d+=Math.max(cb()-K.h-N-L-_(K.bottom,"y"),0)}else if(K.top!==false){d+=_(K.top,"y")}else{d+=Math.round(Math.max(cb()-K.h-N-L,0)/2)}r.css({top:g.top,left:g.left});a=r.width()===K.w+O&&r.height()===K.h+N?0:a||0;s[0].style.width=s[0].style.height="9999px";c={width:K.w+O,height:K.h+N,top:d,left:e};if(a===0){r.css(c)}r.dequeue().animate(c,{duration:a,complete:function(){j(this);T=false;s[0].style.width=K.w+O+M+"px";s[0].style.height=K.h+N+L+"px";if(K.reposition){setTimeout(function(){z.bind("resize."+f,W.position)},1)}if(b){b()}},step:function(){j(this)}})};W.resize=function(a){if(S){a=a||{};if(a.width){K.w=_(a.width,"x")-O-M}if(a.innerWidth){K.w=_(a.innerWidth,"x")}A.css({width:K.w});if(a.height){K.h=_(a.height,"y")-N-L}if(a.innerHeight){K.h=_(a.innerHeight,"y")}if(!a.innerHeight&&!a.height){A.css({height:"auto"});K.h=A.height()}A.css({height:K.h});W.position(K.transition==="none"?0:K.speed)}};W.prep=function(b){function g(){K.w=K.w||A.width();K.w=K.mw&&K.mw<K.w?K.mw:K.w;return K.w}function h(){K.h=K.h||A.height();K.h=K.mh&&K.mh<K.h?K.mh:K.h;return K.h}if(!S){return}var c,d=K.transition==="none"?0:K.speed;A.remove();A=Z(X,"LoadedContent").append(b);A.hide().appendTo(B.show()).css({width:g(),overflow:K.scrolling?"auto":"hidden"}).css({height:h()}).prependTo(t);B.hide();a(R).css({"float":"none"});if(o){a("select").not(r.find("select")).filter(function(){return this.style.visibility!=="hidden"}).css({visibility:"hidden"}).one(k,function(){this.style.visibility="inherit"})}c=function(){function s(){if(n){r[0].style.removeAttribute("filter")}}var b,c,g=y.length,h,i="frameBorder",k="allowTransparency",l,o,p,q;if(!S){return}l=function(){clearTimeout(V);C.detach().hide();eb(j,K.onComplete)};if(n){if(R){A.fadeIn(100)}}D.html(K.title).add(A).show();if(g>1){if(typeof K.current==="string"){E.html(K.current.replace("{current}",Q+1).replace("{total}",g)).show()}G[K.loop||Q<g-1?"show":"hide"]().html(K.next);H[K.loop||Q?"show":"hide"]().html(K.previous);if(K.slideshow){F.show()}if(K.preloading){b=[$(-1),$(1)];while(c=y[b.pop()]){q=a.data(c,e);if(q&&q.href){o=q.href;if(a.isFunction(o)){o=o.call(c)}}else{o=c.href}if(ab(o)){p=new Image;p.src=o}}}}else{J.hide()}if(K.iframe){h=Z("iframe")[0];if(i in h){h[i]=0}if(k in h){h[k]="true"}h.name=f+ +(new Date);if(K.fastIframe){l()}else{a(h).one("load",l)}h.src=K.href;if(!K.scrolling){h.scrolling="no"}a(h).addClass(f+"Iframe").appendTo(A).one(m,function(){h.src="//about:blank"})}else{l()}if(K.transition==="fade"){r.fadeTo(d,1,s)}else{s()}};if(K.transition==="fade"){r.fadeTo(d,0,function(){W.position(0,c)})}else{W.position(d,c)}};W.load=function(b){var c,d,e=W.prep;T=true;R=false;P=y[Q];if(!b){db()}eb(m);eb(i,K.onLoad);K.h=K.height?_(K.height,"y")-N-L:K.innerHeight&&_(K.innerHeight,"y");K.w=K.width?_(K.width,"x")-O-M:K.innerWidth&&_(K.innerWidth,"x");K.mw=K.w;K.mh=K.h;if(K.maxWidth){K.mw=_(K.maxWidth,"x")-O-M;K.mw=K.w&&K.w<K.mw?K.w:K.mw}if(K.maxHeight){K.mh=_(K.maxHeight,"y")-N-L;K.mh=K.h&&K.h<K.mh?K.h:K.mh}c=K.href;V=setTimeout(function(){C.show().appendTo(t)},100);if(K.inline){Z(X).hide().insertBefore(a(c)[0]).one(m,function(){a(this).replaceWith(A.children())});e(a(c))}else if(K.iframe){e(" ")}else if(K.html){e(K.html)}else if(ab(c)){a(R=new Image).addClass(f+"Photo").error(function(){K.title=false;e(Z(X,"Error").html(K.imgError))}).load(function(){var a;R.onload=null;if(K.scalePhotos){d=function(){R.height-=R.height*a;R.width-=R.width*a};if(K.mw&&R.width>K.mw){a=(R.width-K.mw)/R.width;d()}if(K.mh&&R.height>K.mh){a=(R.height-K.mh)/R.height;d()}}if(K.h){R.style.marginTop=Math.max(K.h-R.height,0)/2+"px"}if(y[1]&&(K.loop||y[Q+1])){R.style.cursor="pointer";R.onclick=function(){W.next()}}if(n){R.style.msInterpolationMode="bicubic"}setTimeout(function(){e(R)},1)});setTimeout(function(){R.src=c},1)}else if(c){B.load(c,K.data,function(b,c,d){e(c==="error"?Z(X,"Error").html(K.xhrError):a(this).contents())})}};W.next=function(){if(!T&&y[1]&&(K.loop||y[Q+1])){Q=$(1);W.load()}};W.prev=function(){if(!T&&y[1]&&(K.loop||Q)){Q=$(-1);W.load()}};W.close=function(){if(S&&!U){U=true;S=false;eb(k,K.onCleanup);z.unbind("."+f+" ."+p);q.fadeTo(200,0);r.stop().fadeTo(300,0,function(){r.add(q).css({opacity:1,cursor:"auto"}).hide();eb(m);A.remove();setTimeout(function(){U=false;eb(l,K.onClosed)},1)})}};W.remove=function(){a([]).add(r).add(q).remove();r=null;a("."+g).removeData(e).removeClass(g).die()};W.element=function(){return a(P)};W.settings=d})(jQuery,document,this);

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
                    optionClass = $(item).attr('class'),
                    isDisabled = $(item).is(':disabled');

                //add one class to item
                if (optionClass == undefined) optionClass = ''
                else  optionClass = ' class="' + optionClass + '"'

                if (!isDisabled && !$(item).parents().is(':disabled')) {
                    //add first letter of each word to array
                    keys.push(option.charAt(0).toLowerCase());
                }
                container.append($('<li' + optionClass + '><a'+(isDisabled ? ' class="newListItemDisabled"' : '')+' href="JavaScript:void(0);">'+option+'</a></li>').data({
                    'key' : key,
                    'selected' : $(item).is(':selected')
                }));
            }

            $input.children().each(function(){
                if ($(this).is('option')){
                    var optionClass;
                    if ($(this).attr('class') != undefined){
                        if (!$newUl.hasClass('optGroup')){
                            $newUl.addClass('optGroup');
                        }
                        $(this).parents('ul.newList').addClass('optGroup');
                        optionClass = $(this).attr('class');
                    }
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
                    $containerDivWrapper.addClass('maxHeight');
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

/* stylish multiple select - LGU */
(function($){
    $.fn.extend({
        resetMultSelect: function(){
            $this = $(this);
            $this.next().remove();
            $this.unbind('.sMultSelect').sMultSelect();
        }
    });

    $.fn.sMultSelect = function(options){
        return this.each(function(){
            var defaults = {
                msgNull:    'No result'
            };

            var opts = $.extend(defaults, options),
                $mul = $(this);

            $(this).data('ssOpts',options);

            // creation du nouvel objet sous forme de liste <ul>
            var origId = $mul.attr('id'),
                $newMul = $('<ul id="'+origId+'Ul" class="sMultSelectUl"></ul>'),
                $newMulLi;
            // insertion de ce nouvel objet
            $mul.after($newMul);

            // function de creation de elements <li> correspondant aux <option>
            function addMulItem(item, container) {
                var text = $(item).text(),
                    val = $(item).val(),
                    cSelected = "";

                // si une <option> a l'attribut [selected]
                if ($(item).attr('selected')) {
                    cSelected = "selected";
                }
                // insertion des <li> dans la liste <ul>
                container.append(
                    $('<li data-val="'+val+'" class="'+cSelected+'">'+text+'</li>')
                );
            }
            // lancement de la function de creation des <li>
            if ($mul.is(':empty')){
                $newMul.html('<li style="font-style:italic;padding:2px 5px;">'+opts.msgNull+'</li>');
            }else{
                $mul.children('option').each(function(){
                    addMulItem(this, $newMul);
                });
            }


            // declaration de la var correspondant aux nouveaux elements <li>
            $newMulLi = $newMul.find('li');
            // action au clic sur un element <li>
            $newMulLi.click( function(){
                var link = $(this),
                    val = $(this).attr('data-val'),
                    nSel = $mul.find('[value="'+val+'"]');
                // si l'<option> a l'attribut [selected]
                if (nSel.is(':selected')){
                    link.removeClass('selected');
                    nSel.removeAttr('selected');
                } else {
                    link.addClass('selected');
                    nSel.attr('selected', 'selected');
                }
            });
        });
    };
})(jQuery);

/*
 * Tiny Scrollbar
 * http://www.baijs.nl/tinyscrollbar/
 *
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.opensource.org/licenses/gpl-2.0.php
 *
 * Date: 13 / 08 / 2012
 * @version 1.81
 * @author Maarten Baijs
 *
 */
( function( $ )
{

    $.tiny = $.tiny || { };

    $.tiny.scrollbar = {
        options: {
            axis         : 'y'    // vertical or horizontal scrollbar? ( x || y ).
            ,   wheel        : 40     // how many pixels must the mouswheel scroll at a time.
            ,   scroll       : true   // enable or disable the mousewheel.
            ,   lockscroll   : true   // return scrollwheel to browser if there is no more content.
            ,   size         : 'auto' // set the size of the scrollbar to auto or a fixed number.
            ,   sizethumb    : 'auto' // set the size of the thumb to auto or a fixed number.
            ,   invertscroll : false  // Enable mobile invert style scrolling
        }
    };

    $.fn.tinyscrollbar = function( params )
    {
        var options = $.extend( {}, $.tiny.scrollbar.options, params );

        this.each( function()
        {
            $( this ).data('tsb', new Scrollbar( $( this ), options ) );
        });

        return this;
    };

    $.fn.tinyscrollbar_update = function(sScroll)
    {
        return $( this ).data( 'tsb' ).update( sScroll );
    };

    function Scrollbar( root, options )
    {
        var oSelf       = this
            ,   oWrapper    = root
            ,   oViewport   = { obj: $( '.viewport', root ) }
            ,   oContent    = { obj: $( '.overview', root ) }
            ,   oScrollbar  = { obj: $( '.scrollbar', root ) }
            ,   oTrack      = { obj: $( '.track', oScrollbar.obj ) }
            ,   oThumb      = { obj: $( '.thumb', oScrollbar.obj ) }
            ,   sAxis       = options.axis === 'x'
            ,   sDirection  = sAxis ? 'left' : 'top'
            ,   sSize       = sAxis ? 'Width' : 'Height'
            ,   iScroll     = 0
            ,   iPosition   = { start: 0, now: 0 }
            ,   iMouse      = {}
            ,   touchEvents = 'ontouchstart' in document.documentElement
            ;

        function initialize()
        {
            oSelf.update();
            setEvents();

            return oSelf;
        }

        this.update = function( sScroll )
        {
            oViewport[ options.axis ] = oViewport.obj[0][ 'offset'+ sSize ];
            oContent[ options.axis ]  = oContent.obj[0][ 'scroll'+ sSize ];
            oContent.ratio            = oViewport[ options.axis ] / oContent[ options.axis ];

            oScrollbar.obj.toggleClass( 'disable', oContent.ratio >= 1 );

            oTrack[ options.axis ] = options.size === 'auto' ? oViewport[ options.axis ] : options.size;
            oThumb[ options.axis ] = Math.min( oTrack[ options.axis ], Math.max( 0, ( options.sizethumb === 'auto' ? ( oTrack[ options.axis ] * oContent.ratio ) : options.sizethumb ) ) );

            oScrollbar.ratio = options.sizethumb === 'auto' ? ( oContent[ options.axis ] / oTrack[ options.axis ] ) : ( oContent[ options.axis ] - oViewport[ options.axis ] ) / ( oTrack[ options.axis ] - oThumb[ options.axis ] );

            iScroll = ( sScroll === 'relative' && oContent.ratio <= 1 ) ? Math.min( ( oContent[ options.axis ] - oViewport[ options.axis ] ), Math.max( 0, iScroll )) : 0;
            iScroll = ( sScroll === 'bottom' && oContent.ratio <= 1 ) ? ( oContent[ options.axis ] - oViewport[ options.axis ] ) : isNaN( parseInt( sScroll, 10 ) ) ? iScroll : parseInt( sScroll, 10 );

            setSize();
        };

        function setSize()
        {
            var sCssSize = sSize.toLowerCase();

            oThumb.obj.css( sDirection, iScroll / oScrollbar.ratio );
            oContent.obj.css( sDirection, -iScroll );
            iMouse.start = oThumb.obj.offset()[ sDirection ];

            oScrollbar.obj.css( sCssSize, oTrack[ options.axis ] );
            oTrack.obj.css( sCssSize, oTrack[ options.axis ] );
            oThumb.obj.css( sCssSize, oThumb[ options.axis ] );
        }

        function setEvents()
        {
            if( ! touchEvents )
            {
                oThumb.obj.bind( 'mousedown', start );
                oTrack.obj.bind( 'mouseup', drag );
            }
            else
            {
                oViewport.obj[0].ontouchstart = function( event )
                {
                    if( 1 === event.touches.length )
                    {
                        start( event.touches[ 0 ] );
                        event.stopPropagation();
                    }
                };
            }

            if( options.scroll && window.addEventListener )
            {
                oWrapper[0].addEventListener( 'DOMMouseScroll', wheel, false );
                oWrapper[0].addEventListener( 'mousewheel', wheel, false );
            }
            else if( options.scroll )
            {
                oWrapper[0].onmousewheel = wheel;
            }
        }

        function start( event )
        {
            $( "body" ).addClass( "noSelect" );

            var oThumbDir   = parseInt( oThumb.obj.css( sDirection ), 10 );
            iMouse.start    = sAxis ? event.pageX : event.pageY;
            iPosition.start = oThumbDir == 'auto' ? 0 : oThumbDir;

            if( ! touchEvents )
            {
                $( document ).bind( 'mousemove', drag );
                $( document ).bind( 'mouseup', end );
                oThumb.obj.bind( 'mouseup', end );
            }
            else
            {
                document.ontouchmove = function( event )
                {
                    event.preventDefault();
                    drag( event.touches[ 0 ] );
                };
                document.ontouchend = end;
            }
        }

        function wheel( event )
        {
            if( oContent.ratio < 1 )
            {
                var oEvent = event || window.event
                    ,   iDelta = oEvent.wheelDelta ? oEvent.wheelDelta / 120 : -oEvent.detail / 3
                    ;

                iScroll -= iDelta * options.wheel;
                iScroll = Math.min( ( oContent[ options.axis ] - oViewport[ options.axis ] ), Math.max( 0, iScroll ));

                oThumb.obj.css( sDirection, iScroll / oScrollbar.ratio );
                oContent.obj.css( sDirection, -iScroll );

                if( options.lockscroll || ( iScroll !== ( oContent[ options.axis ] - oViewport[ options.axis ] ) && iScroll !== 0 ) )
                {
                    oEvent = $.event.fix( oEvent );
                    oEvent.preventDefault();
                }
            }
        }

        function drag( event )
        {
            if( oContent.ratio < 1 )
            {
                if( options.invertscroll && touchEvents )
                {
                    iPosition.now = Math.min( ( oTrack[ options.axis ] - oThumb[ options.axis ] ), Math.max( 0, ( iPosition.start + ( iMouse.start - ( sAxis ? event.pageX : event.pageY ) ))));
                }
                else
                {
                    iPosition.now = Math.min( ( oTrack[ options.axis ] - oThumb[ options.axis ] ), Math.max( 0, ( iPosition.start + ( ( sAxis ? event.pageX : event.pageY ) - iMouse.start))));
                }

                iScroll = iPosition.now * oScrollbar.ratio;
                oContent.obj.css( sDirection, -iScroll );
                oThumb.obj.css( sDirection, iPosition.now );
            }
        }

        function end()
        {
            $( "body" ).removeClass( "noSelect" );
            $( document ).unbind( 'mousemove', drag );
            $( document ).unbind( 'mouseup', end );
            oThumb.obj.unbind( 'mouseup', end );
            document.ontouchmove = document.ontouchend = null;
        }

        return initialize();
    }

}(jQuery));

/**
 *
 * Date picker
 * Author: Stefan Petre www.eyecon.ro
 *
 * Dual licensed under the MIT and GPL licenses
 *
 */
(function ($) {
    var datepickerInfo = "";
    var datepickerLegend = "";
    var DatePicker = function () {
        var	ids = {},
            views = {
                years: 'datepickerViewYears',
                moths: 'datepickerViewMonths',
                days: 'datepickerViewDays'
            },
            tpl = {
                wrapper: '<div class="datepicker"><div class="datepickerBorderT" /><div class="datepickerBorderB" /><div class="datepickerBorderL" /><div class="datepickerBorderR" /><div class="datepickerBorderTL" /><div class="datepickerBorderTR" /><div class="datepickerBorderBL" /><div class="datepickerBorderBR" /><div class="datepickerGoPrev"><a href="#"><span>&#9664;</span></a></div><div class="datepickerContainer"><table cellspacing="0" cellpadding="0"><tbody><tr></tr></tbody></table></div><div class="datepickerGoNext"><a href="#"><span>&#9654;</span></a></div><span class="datepickerInfo">' + datepickerInfo + '</span><span class="datepickerLegend">' + datepickerLegend + '</span><button class="bt fushia small">Appliquer</button></div>',
                head: [
                    '<td>',
                    '<table cellspacing="0" cellpadding="0">',
                    '<thead>',
                    '<tr>',
                    '<th class="datepickerGoPrev"><a href="#"><span><%=prev%></span></a></th>',
                    '<th colspan="8" class="datepickerMonth"><a href="#"><span></span></a></th>',
                    '<th class="datepickerGoNext"><a href="#"><span><%=next%></span></a></th>',
                    '</tr>',
                    '<tr class="datepickerDoW">',
                    //'<th><span><%=week%></span></th>',
                    '<th><span><%=day1%></span></th>',
                    '<th><span><%=day2%></span></th>',
                    '<th><span><%=day3%></span></th>',
                    '<th><span><%=day4%></span></th>',
                    '<th><span><%=day5%></span></th>',
                    '<th><span><%=day6%></span></th>',
                    '<th><span><%=day7%></span></th>',
                    '</tr>',
                    '</thead>',
                    '</table>',
                    '</td>'
                ],
                space : '<td class="datepickerSpace"><div></div></td>',
                days: [
                    '<tbody class="datepickerDays">',
                    '<tr>',
                    '<th class="datepickerWeek"><a href="#"><span><%=weeks[0].week%></span></a></th>',
                    '<td class="<%=weeks[0].days[0].classname%>"><a href="#"><span><%=weeks[0].days[0].text%></span></a></td>',
                    '<td class="<%=weeks[0].days[1].classname%>"><a href="#"><span><%=weeks[0].days[1].text%></span></a></td>',
                    '<td class="<%=weeks[0].days[2].classname%>"><a href="#"><span><%=weeks[0].days[2].text%></span></a></td>',
                    '<td class="<%=weeks[0].days[3].classname%>"><a href="#"><span><%=weeks[0].days[3].text%></span></a></td>',
                    '<td class="<%=weeks[0].days[4].classname%>"><a href="#"><span><%=weeks[0].days[4].text%></span></a></td>',
                    '<td class="<%=weeks[0].days[5].classname%>"><a href="#"><span><%=weeks[0].days[5].text%></span></a></td>',
                    '<td class="<%=weeks[0].days[6].classname%>"><a href="#"><span><%=weeks[0].days[6].text%></span></a></td>',
                    '</tr>',
                    '<tr>',
                    '<th class="datepickerWeek"><a href="#"><span><%=weeks[1].week%></span></a></th>',
                    '<td class="<%=weeks[1].days[0].classname%>"><a href="#"><span><%=weeks[1].days[0].text%></span></a></td>',
                    '<td class="<%=weeks[1].days[1].classname%>"><a href="#"><span><%=weeks[1].days[1].text%></span></a></td>',
                    '<td class="<%=weeks[1].days[2].classname%>"><a href="#"><span><%=weeks[1].days[2].text%></span></a></td>',
                    '<td class="<%=weeks[1].days[3].classname%>"><a href="#"><span><%=weeks[1].days[3].text%></span></a></td>',
                    '<td class="<%=weeks[1].days[4].classname%>"><a href="#"><span><%=weeks[1].days[4].text%></span></a></td>',
                    '<td class="<%=weeks[1].days[5].classname%>"><a href="#"><span><%=weeks[1].days[5].text%></span></a></td>',
                    '<td class="<%=weeks[1].days[6].classname%>"><a href="#"><span><%=weeks[1].days[6].text%></span></a></td>',
                    '</tr>',
                    '<tr>',
                    '<th class="datepickerWeek"><a href="#"><span><%=weeks[2].week%></span></a></th>',
                    '<td class="<%=weeks[2].days[0].classname%>"><a href="#"><span><%=weeks[2].days[0].text%></span></a></td>',
                    '<td class="<%=weeks[2].days[1].classname%>"><a href="#"><span><%=weeks[2].days[1].text%></span></a></td>',
                    '<td class="<%=weeks[2].days[2].classname%>"><a href="#"><span><%=weeks[2].days[2].text%></span></a></td>',
                    '<td class="<%=weeks[2].days[3].classname%>"><a href="#"><span><%=weeks[2].days[3].text%></span></a></td>',
                    '<td class="<%=weeks[2].days[4].classname%>"><a href="#"><span><%=weeks[2].days[4].text%></span></a></td>',
                    '<td class="<%=weeks[2].days[5].classname%>"><a href="#"><span><%=weeks[2].days[5].text%></span></a></td>',
                    '<td class="<%=weeks[2].days[6].classname%>"><a href="#"><span><%=weeks[2].days[6].text%></span></a></td>',
                    '</tr>',
                    '<tr>',
                    '<th class="datepickerWeek"><a href="#"><span><%=weeks[3].week%></span></a></th>',
                    '<td class="<%=weeks[3].days[0].classname%>"><a href="#"><span><%=weeks[3].days[0].text%></span></a></td>',
                    '<td class="<%=weeks[3].days[1].classname%>"><a href="#"><span><%=weeks[3].days[1].text%></span></a></td>',
                    '<td class="<%=weeks[3].days[2].classname%>"><a href="#"><span><%=weeks[3].days[2].text%></span></a></td>',
                    '<td class="<%=weeks[3].days[3].classname%>"><a href="#"><span><%=weeks[3].days[3].text%></span></a></td>',
                    '<td class="<%=weeks[3].days[4].classname%>"><a href="#"><span><%=weeks[3].days[4].text%></span></a></td>',
                    '<td class="<%=weeks[3].days[5].classname%>"><a href="#"><span><%=weeks[3].days[5].text%></span></a></td>',
                    '<td class="<%=weeks[3].days[6].classname%>"><a href="#"><span><%=weeks[3].days[6].text%></span></a></td>',
                    '</tr>',
                    '<tr>',
                    '<th class="datepickerWeek"><a href="#"><span><%=weeks[4].week%></span></a></th>',
                    '<td class="<%=weeks[4].days[0].classname%>"><a href="#"><span><%=weeks[4].days[0].text%></span></a></td>',
                    '<td class="<%=weeks[4].days[1].classname%>"><a href="#"><span><%=weeks[4].days[1].text%></span></a></td>',
                    '<td class="<%=weeks[4].days[2].classname%>"><a href="#"><span><%=weeks[4].days[2].text%></span></a></td>',
                    '<td class="<%=weeks[4].days[3].classname%>"><a href="#"><span><%=weeks[4].days[3].text%></span></a></td>',
                    '<td class="<%=weeks[4].days[4].classname%>"><a href="#"><span><%=weeks[4].days[4].text%></span></a></td>',
                    '<td class="<%=weeks[4].days[5].classname%>"><a href="#"><span><%=weeks[4].days[5].text%></span></a></td>',
                    '<td class="<%=weeks[4].days[6].classname%>"><a href="#"><span><%=weeks[4].days[6].text%></span></a></td>',
                    '</tr>',
                    '<tr>',
                    '<th class="datepickerWeek"><a href="#"><span><%=weeks[5].week%></span></a></th>',
                    '<td class="<%=weeks[5].days[0].classname%>"><a href="#"><span><%=weeks[5].days[0].text%></span></a></td>',
                    '<td class="<%=weeks[5].days[1].classname%>"><a href="#"><span><%=weeks[5].days[1].text%></span></a></td>',
                    '<td class="<%=weeks[5].days[2].classname%>"><a href="#"><span><%=weeks[5].days[2].text%></span></a></td>',
                    '<td class="<%=weeks[5].days[3].classname%>"><a href="#"><span><%=weeks[5].days[3].text%></span></a></td>',
                    '<td class="<%=weeks[5].days[4].classname%>"><a href="#"><span><%=weeks[5].days[4].text%></span></a></td>',
                    '<td class="<%=weeks[5].days[5].classname%>"><a href="#"><span><%=weeks[5].days[5].text%></span></a></td>',
                    '<td class="<%=weeks[5].days[6].classname%>"><a href="#"><span><%=weeks[5].days[6].text%></span></a></td>',
                    '</tr>',
                    '</tbody>'
                ],
                months: [
                    '<tbody class="<%=className%>">',
                    '<tr>',
                    '<td colspan="2"><a href="#"><span><%=data[0]%></span></a></td>',
                    '<td colspan="2"><a href="#"><span><%=data[1]%></span></a></td>',
                    '<td colspan="2"><a href="#"><span><%=data[2]%></span></a></td>',
                    '<td colspan="2"><a href="#"><span><%=data[3]%></span></a></td>',
                    '</tr>',
                    '<tr>',
                    '<td colspan="2"><a href="#"><span><%=data[4]%></span></a></td>',
                    '<td colspan="2"><a href="#"><span><%=data[5]%></span></a></td>',
                    '<td colspan="2"><a href="#"><span><%=data[6]%></span></a></td>',
                    '<td colspan="2"><a href="#"><span><%=data[7]%></span></a></td>',
                    '</tr>',
                    '<tr>',
                    '<td colspan="2"><a href="#"><span><%=data[8]%></span></a></td>',
                    '<td colspan="2"><a href="#"><span><%=data[9]%></span></a></td>',
                    '<td colspan="2"><a href="#"><span><%=data[10]%></span></a></td>',
                    '<td colspan="2"><a href="#"><span><%=data[11]%></span></a></td>',
                    '</tr>',
                    '</tbody>'
                ]
            },
            defaults = {
                flat: false,
                starts: 1,
                prev: '&#9664;',
                next: '&#9654;',
                lastSel: false,
                mode: 'single',
                view: 'days',
                calendars: 1,
                format: 'Y-m-d',
                position: 'bottom',
                eventName: 'click',
                onRender: function(){return {};},
                onChange: function(){return true;},
                onShow: function(){return true;},
                onBeforeShow: function(){return true;},
                onHide: function(){return true;},
                locale: {
                    days: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'],
                    daysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                    daysMin: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa', 'Di'],
                    months: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                    monthsShort: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jui', 'Jui', 'Aoû', 'Sepe', 'Oct', 'Nov', 'Déc'],
                    weekMin: 'Se'
                }
            },
            fill = function(el) {
                var options = $(el).data('datepicker');
                var cal = $(el);
                var currentCal = Math.floor(options.calendars/2), date, data, dow, month, cnt = 0, week, days, indic, indic2, html, tblCal;
                cal.find('td>table tbody').remove();
                for (var i = 0; i < options.calendars; i++) {
                    date = new Date(options.current);
                    date.addMonths(-currentCal + i);
                    tblCal = cal.find('table').eq(i+1);
                    switch (tblCal[0].className) {
                        case 'datepickerViewDays':
                            dow = formatDate(date, 'B, Y');
                            break;
                        case 'datepickerViewMonths':
                            dow = date.getFullYear();
                            break;
                        case 'datepickerViewYears':
                            dow = (date.getFullYear()-6) + ' - ' + (date.getFullYear()+5);
                            break;
                    }
                    tblCal.find('thead tr:first th:eq(1) span').text(dow);
                    dow = date.getFullYear()-6;
                    data = {
                        data: [],
                        className: 'datepickerYears'
                    }
                    for ( var j = 0; j < 12; j++) {
                        data.data.push(dow + j);
                    }
                    html = tmpl(tpl.months.join(''), data);
                    date.setDate(1);
                    data = {weeks:[], test: 10};
                    month = date.getMonth();
                    var dow = (date.getDay() - options.starts) % 7;
                    date.addDays(-(dow + (dow < 0 ? 7 : 0)));
                    week = -1;
                    cnt = 0;
                    while (cnt < 42) {
                        indic = parseInt(cnt/7,10);
                        indic2 = cnt%7;
                        if (!data.weeks[indic]) {
                            week = date.getWeekNumber();
                            data.weeks[indic] = {
                                week: week,
                                days: []
                            };
                        }
                        data.weeks[indic].days[indic2] = {
                            text: date.getDate(),
                            classname: []
                        };
                        if (month != date.getMonth()) {
                            data.weeks[indic].days[indic2].classname.push('datepickerNotInMonth');
                        }
                        if (date.getDay() == 0) {
                            data.weeks[indic].days[indic2].classname.push('datepickerSunday');
                        }
                        if (date.getDay() == 6) {
                            data.weeks[indic].days[indic2].classname.push('datepickerSaturday');
                        }
                        var fromUser = options.onRender(date);
                        var val = date.valueOf();
                        if (fromUser.selected || options.date == val || $.inArray(val, options.date) > -1 || (options.mode == 'range' && val >= options.date[0] && val <= options.date[1])) {
                            data.weeks[indic].days[indic2].classname.push('datepickerSelected');
                        }
                        if (fromUser.disabled) {
                            data.weeks[indic].days[indic2].classname.push('datepickerDisabled');
                            data.weeks[indic].days[indic2].classname.push('datepickerUnselectable');
                        }
                        if (fromUser.className) {
                            data.weeks[indic].days[indic2].classname.push(fromUser.className);
                        }
                        data.weeks[indic].days[indic2].classname = data.weeks[indic].days[indic2].classname.join(' ');
                        cnt++;
                        date.addDays(1);
                    }
                    html = tmpl(tpl.days.join(''), data) + html;
                    data = {
                        data: options.locale.monthsShort,
                        className: 'datepickerMonths'
                    };
                    html = tmpl(tpl.months.join(''), data) + html;
                    tblCal.append(html);
                }
            },
            parseDate = function (date, format) {
                if (date.constructor == Date) {
                    return new Date(date);
                }
                var parts = date.split(/\W+/);
                var against = format.split(/\W+/), d, m, y, h, min, now = new Date();
                for (var i = 0; i < parts.length; i++) {
                    switch (against[i]) {
                        case 'd':
                        case 'e':
                            d = parseInt(parts[i],10);
                            break;
                        case 'm':
                            m = parseInt(parts[i], 10)-1;
                            break;
                        case 'Y':
                        case 'y':
                            y = parseInt(parts[i], 10);
                            y += y > 100 ? 0 : (y < 29 ? 2000 : 1900);
                            break;
                        case 'H':
                        case 'I':
                        case 'k':
                        case 'l':
                            h = parseInt(parts[i], 10);
                            break;
                        case 'P':
                        case 'p':
                            if (/pm/i.test(parts[i]) && h < 12) {
                                h += 12;
                            } else if (/am/i.test(parts[i]) && h >= 12) {
                                h -= 12;
                            }
                            break;
                        case 'M':
                            min = parseInt(parts[i], 10);
                            break;
                    }
                }
                return new Date(
                    y === undefined ? now.getFullYear() : y,
                    m === undefined ? now.getMonth() : m,
                    d === undefined ? now.getDate() : d,
                    h === undefined ? now.getHours() : h,
                    min === undefined ? now.getMinutes() : min,
                    0
                );
            },
            formatDate = function(date, format) {
                var m = date.getMonth();
                var d = date.getDate();
                var y = date.getFullYear();
                var wn = date.getWeekNumber();
                var w = date.getDay();
                var s = {};
                var hr = date.getHours();
                var pm = (hr >= 12);
                var ir = (pm) ? (hr - 12) : hr;
                var dy = date.getDayOfYear();
                if (ir == 0) {
                    ir = 12;
                }
                var min = date.getMinutes();
                var sec = date.getSeconds();
                var parts = format.split(''), part;
                for ( var i = 0; i < parts.length; i++ ) {
                    part = parts[i];
                    switch (parts[i]) {
                        case 'a':
                            part = date.getDayName();
                            break;
                        case 'A':
                            part = date.getDayName(true);
                            break;
                        case 'b':
                            part = date.getMonthName();
                            break;
                        case 'B':
                            part = date.getMonthName(true);
                            break;
                        case 'C':
                            part = 1 + Math.floor(y / 100);
                            break;
                        case 'd':
                            part = (d < 10) ? ("0" + d) : d;
                            break;
                        case 'e':
                            part = d;
                            break;
                        case 'H':
                            part = (hr < 10) ? ("0" + hr) : hr;
                            break;
                        case 'I':
                            part = (ir < 10) ? ("0" + ir) : ir;
                            break;
                        case 'j':
                            part = (dy < 100) ? ((dy < 10) ? ("00" + dy) : ("0" + dy)) : dy;
                            break;
                        case 'k':
                            part = hr;
                            break;
                        case 'l':
                            part = ir;
                            break;
                        case 'm':
                            part = (m < 9) ? ("0" + (1+m)) : (1+m);
                            break;
                        case 'M':
                            part = (min < 10) ? ("0" + min) : min;
                            break;
                        case 'p':
                        case 'P':
                            part = pm ? "PM" : "AM";
                            break;
                        case 's':
                            part = Math.floor(date.getTime() / 1000);
                            break;
                        case 'S':
                            part = (sec < 10) ? ("0" + sec) : sec;
                            break;
                        case 'u':
                            part = w + 1;
                            break;
                        case 'w':
                            part = w;
                            break;
                        case 'y':
                            part = ('' + y).substr(2, 2);
                            break;
                        case 'Y':
                            part = y;
                            break;
                    }
                    parts[i] = part;
                }
                return parts.join('');
            },
            extendDate = function(options) {
                if (Date.prototype.tempDate) {
                    return;
                }
                Date.prototype.tempDate = null;
                Date.prototype.months = options.months;
                Date.prototype.monthsShort = options.monthsShort;
                Date.prototype.days = options.days;
                Date.prototype.daysShort = options.daysShort;
                Date.prototype.getMonthName = function(fullName) {
                    return this[fullName ? 'months' : 'monthsShort'][this.getMonth()];
                };
                Date.prototype.getDayName = function(fullName) {
                    return this[fullName ? 'days' : 'daysShort'][this.getDay()];
                };
                Date.prototype.addDays = function (n) {
                    this.setDate(this.getDate() + n);
                    this.tempDate = this.getDate();
                };
                Date.prototype.addMonths = function (n) {
                    if (this.tempDate == null) {
                        this.tempDate = this.getDate();
                    }
                    this.setDate(1);
                    this.setMonth(this.getMonth() + n);
                    this.setDate(Math.min(this.tempDate, this.getMaxDays()));
                };
                Date.prototype.addYears = function (n) {
                    if (this.tempDate == null) {
                        this.tempDate = this.getDate();
                    }
                    this.setDate(1);
                    this.setFullYear(this.getFullYear() + n);
                    this.setDate(Math.min(this.tempDate, this.getMaxDays()));
                };
                Date.prototype.getMaxDays = function() {
                    var tmpDate = new Date(Date.parse(this)),
                        d = 28, m;
                    m = tmpDate.getMonth();
                    d = 28;
                    while (tmpDate.getMonth() == m) {
                        d ++;
                        tmpDate.setDate(d);
                    }
                    return d - 1;
                };
                Date.prototype.getFirstDay = function() {
                    var tmpDate = new Date(Date.parse(this));
                    tmpDate.setDate(1);
                    return tmpDate.getDay();
                };
                Date.prototype.getWeekNumber = function() {
                    var tempDate = new Date(this);
                    tempDate.setDate(tempDate.getDate() - (tempDate.getDay() + 6) % 7 + 3);
                    var dms = tempDate.valueOf();
                    tempDate.setMonth(0);
                    tempDate.setDate(4);
                    return Math.round((dms - tempDate.valueOf()) / (604800000)) + 1;
                };
                Date.prototype.getDayOfYear = function() {
                    var now = new Date(this.getFullYear(), this.getMonth(), this.getDate(), 0, 0, 0);
                    var then = new Date(this.getFullYear(), 0, 0, 0, 0, 0);
                    var time = now - then;
                    return Math.floor(time / 24*60*60*1000);
                };
            },
            layout = function (el) {
                var options = $(el).data('datepicker');
                var cal = $('#' + options.id);
                if (!options.extraHeight) {
                    var divs = $(el).find('div');
                    options.extraHeight = divs.get(0).offsetHeight + divs.get(1).offsetHeight;
                    options.extraWidth = divs.get(2).offsetWidth + divs.get(3).offsetWidth;
                }
                var tbl = cal.find('table:first').get(0);
                var width = tbl.offsetWidth;
                var height = tbl.offsetHeight;
                cal.css({
                    width: width + options.extraWidth + 'px',
                    height: height + options.extraHeight + 'px'
                }).find('div.datepickerContainer').css({
                        width: width + 'px',
                        height: height + 'px'
                    });
            },
            click = function(ev) {
                if ($(ev.target).is('span')) {
                    ev.target = ev.target.parentNode;
                }
                var el = $(ev.target);
                if (el.is('a')) {
                    ev.target.blur();
                    if ( (el.hasClass('datepickerDisabled')) || (el.hasClass('datepickerUnselectable')) ) {
                        return false;
                    }
                    var options = $(this).data('datepicker');
                    var parentEl = el.parent();
                    var tblEl = parentEl.parent().parent().parent();
                    var tblIndex = $('table', this).index(tblEl.get(0)) - 1;
                    var tmp = new Date(options.current);
                    var changed = false;
                    var fillIt = false;
                    if (parentEl.is('th')) {
                        if (parentEl.hasClass('datepickerWeek') && options.mode == 'range' && !parentEl.next().hasClass('datepickerDisabled') && !parentEl.next().hasClass('datepickerUnselectable')) {
                            var val = parseInt(parentEl.next().text(), 10);
                            tmp.addMonths(tblIndex - Math.floor(options.calendars/2));
                            if (parentEl.next().hasClass('datepickerNotInMonth')) {
                                tmp.addMonths(val > 15 ? -1 : 1);
                            }
                            tmp.setDate(val);
                            options.date[0] = (tmp.setHours(0,0,0,0)).valueOf();
                            tmp.setHours(23,59,59,0);
                            tmp.addDays(6);
                            options.date[1] = tmp.valueOf();
                            fillIt = true;
                            changed = true;
                            options.lastSel = false;
                        } else if (parentEl.hasClass('datepickerMonth')) {
                            tmp.addMonths(tblIndex - Math.floor(options.calendars/2));
                            switch (tblEl.get(0).className) {
                                case 'datepickerViewDays':
                                    tblEl.get(0).className = 'datepickerViewMonths';
                                    el.find('span').text(tmp.getFullYear());
                                    break;
                                case 'datepickerViewMonths':
                                    tblEl.get(0).className = 'datepickerViewYears';
                                    el.find('span').text((tmp.getFullYear()-6) + ' - ' + (tmp.getFullYear()+5));
                                    break;
                                case 'datepickerViewYears':
                                    tblEl.get(0).className = 'datepickerViewDays';
                                    el.find('span').text(formatDate(tmp, 'B, Y'));
                                    break;
                            }
                        } else if (parentEl.parent().parent().is('thead')) {
                            switch (tblEl.get(0).className) {
                                case 'datepickerViewDays':
                                    options.current.addMonths(parentEl.hasClass('datepickerGoPrev') ? -1 : 1);
                                    break;
                                case 'datepickerViewMonths':
                                    options.current.addYears(parentEl.hasClass('datepickerGoPrev') ? -1 : 1);
                                    break;
                                case 'datepickerViewYears':
                                    options.current.addYears(parentEl.hasClass('datepickerGoPrev') ? -12 : 12);
                                    break;
                            }
                            fillIt = true;
                        }
                    } else if (parentEl.is('td') && !parentEl.hasClass('datepickerDisabled') && !parentEl.hasClass('datepickerUnselectable')) {
                        switch (tblEl.get(0).className) {
                            case 'datepickerViewMonths':
                                options.current.setMonth(tblEl.find('tbody.datepickerMonths td').index(parentEl));
                                options.current.setFullYear(parseInt(tblEl.find('thead th.datepickerMonth span').text(), 10));
                                options.current.addMonths(Math.floor(options.calendars/2) - tblIndex);
                                tblEl.get(0).className = 'datepickerViewDays';
                                break;
                            case 'datepickerViewYears':
                                options.current.setFullYear(parseInt(el.text(), 10));
                                tblEl.get(0).className = 'datepickerViewMonths';
                                break;
                            default:
                                var val = parseInt(el.text(), 10);
                                tmp.addMonths(tblIndex - Math.floor(options.calendars/2));
                                if (parentEl.hasClass('datepickerNotInMonth')) {
                                    tmp.addMonths(val > 15 ? -1 : 1);
                                }
                                tmp.setDate(val);
                                switch (options.mode) {
                                    case 'multiple':
                                        val = (tmp.setHours(0,0,0,0)).valueOf();
                                        if ($.inArray(val, options.date) > -1) {
                                            $.each(options.date, function(nr, dat){
                                                if (dat == val) {
                                                    options.date.splice(nr,1);
                                                    return false;
                                                }
                                            });
                                        } else {
                                            options.date.push(val);
                                        }
                                        break;
                                    case 'range':
                                        if (!options.lastSel) {
                                            options.date[0] = (tmp.setHours(0,0,0,0)).valueOf();
                                        }
                                        val = (tmp.setHours(23,59,59,0)).valueOf();
                                        if (val < options.date[0]) {
                                            options.date[1] = options.date[0] + 86399000;
                                            options.date[0] = val - 86399000;
                                        } else {
                                            options.date[1] = val;
                                        }
                                        options.lastSel = !options.lastSel;
                                        break;
                                    default:
                                        options.date = tmp.valueOf();
                                        break;
                                }
                                break;
                        }
                        fillIt = true;
                        changed = true;
                    }
                    if (fillIt) {
                        fill(this);
                    }
                    if (changed) {
                        options.onChange.apply(this, prepareDate(options));
                    }
                }
                return false;
            },
            prepareDate = function (options) {
                var tmp;
                if (options.mode == 'single') {
                    tmp = new Date(options.date);
                    return [formatDate(tmp, options.format), tmp, options.el];
                } else {
                    tmp = [[],[], options.el];
                    $.each(options.date, function(nr, val){
                        var date = new Date(val);
                        tmp[0].push(formatDate(date, options.format));
                        tmp[1].push(date);
                    });
                    return tmp;
                }
            },
            getViewport = function () {
                var m = document.compatMode == 'CSS1Compat';
                return {
                    l : window.pageXOffset || (m ? document.documentElement.scrollLeft : document.body.scrollLeft),
                    t : window.pageYOffset || (m ? document.documentElement.scrollTop : document.body.scrollTop),
                    w : window.innerWidth || (m ? document.documentElement.clientWidth : document.body.clientWidth),
                    h : window.innerHeight || (m ? document.documentElement.clientHeight : document.body.clientHeight)
                };
            },
            isChildOf = function(parentEl, el, container) {
                if (parentEl == el) {
                    return true;
                }
                if (parentEl.contains) {
                    return parentEl.contains(el);
                }
                if ( parentEl.compareDocumentPosition ) {
                    return !!(parentEl.compareDocumentPosition(el) & 16);
                }
                var prEl = el.parentNode;
                while(prEl && prEl != container) {
                    if (prEl == parentEl)
                        return true;
                    prEl = prEl.parentNode;
                }
                return false;
            },
            show = function (ev) {
                var cal = $('#' + $(this).data('datepickerId'));
                if (!cal.is(':visible')) {
                    var calEl = cal.get(0);
                    fill(calEl);
                    var options = cal.data('datepicker');
                    options.onBeforeShow.apply(this, [cal.get(0)]);
                    var pos = $(this).offset();
                    var viewPort = getViewport();
                    var top = pos.top;
                    var left = pos.left;
                    var oldDisplay = $.curCSS(calEl, 'display');
                    cal.css({
                        visibility: 'hidden',
                        display: 'block'
                    });
                    layout(calEl);
                    switch (options.position){
                        case 'top':
                            top -= calEl.offsetHeight;
                            break;
                        case 'left':
                            left -= calEl.offsetWidth;
                            break;
                        case 'right':
                            left += this.offsetWidth;
                            break;
                        case 'bottom':
                            top += this.offsetHeight;
                            break;
                    }
                    if (top + calEl.offsetHeight > viewPort.t + viewPort.h) {
                        top = pos.top  - calEl.offsetHeight;
                    }
                    if (top < viewPort.t) {
                        top = pos.top + this.offsetHeight + calEl.offsetHeight;
                    }
                    if (left + calEl.offsetWidth > viewPort.l + viewPort.w) {
                        left = pos.left - calEl.offsetWidth;
                    }
                    if (left < viewPort.l) {
                        left = pos.left + this.offsetWidth
                    }
                    cal.css({
                        visibility: 'visible',
                        display: 'block',
                        top: top + 'px',
                        left: left + 'px'
                    });
                    if (options.onShow.apply(this, [cal.get(0)]) != false) {
                        cal.show();
                    }
                    $(document).bind('mousedown', {cal: cal, trigger: this}, hide);
                }
                return false;
            },
            hide = function (ev) {
                if (ev.target != ev.data.trigger && !isChildOf(ev.data.cal.get(0), ev.target, ev.data.cal.get(0))) {
                    if (ev.data.cal.data('datepicker').onHide.apply(this, [ev.data.cal.get(0)]) != false) {
                        ev.data.cal.hide();
                    }
                    $(document).unbind('mousedown', hide);
                }
            };
        return {
            init: function(options){
                options = $.extend({}, defaults, options||{});
                extendDate(options.locale);
                options.calendars = Math.max(1, parseInt(options.calendars,10)||1);
                options.mode = /single|multiple|range/.test(options.mode) ? options.mode : 'single';
                return this.each(function(){
                    if (!$(this).data('datepicker')) {
                        options.el = this;
                        if (options.date.constructor == String) {
                            options.date = parseDate(options.date, options.format);
                            options.date.setHours(0,0,0,0);
                        }
                        if (options.mode != 'single') {
                            if (options.date.constructor != Array) {
                                options.date = [options.date.valueOf()];
                                if (options.mode == 'range') {
                                    options.date.push(((new Date(options.date[0])).setHours(23,59,59,0)).valueOf());
                                }
                            } else {
                                for (var i = 0; i < options.date.length; i++) {
                                    options.date[i] = (parseDate(options.date[i], options.format).setHours(0,0,0,0)).valueOf();
                                }
                                if (options.mode == 'range') {
                                    options.date[1] = ((new Date(options.date[1])).setHours(23,59,59,0)).valueOf();
                                }
                            }
                        } else {
                            options.date = options.date.valueOf();
                        }
                        if (!options.current) {
                            options.current = new Date();
                        } else {
                            options.current = parseDate(options.current, options.format);
                        }
                        options.current.setDate(1);
                        options.current.setHours(0,0,0,0);
                        var id = 'datepicker_' + parseInt(Math.random() * 1000), cnt;
                        options.id = id;
                        $(this).data('datepickerId', options.id);
                        var cal = $(tpl.wrapper).attr('id', id).bind('click', click).data('datepicker', options);
                        if (options.className) {
                            cal.addClass(options.className);
                        }
                        var html = '';
                        for (var i = 0; i < options.calendars; i++) {
                            cnt = options.starts;
                            if (i > 0) {
                                html += tpl.space;
                            }
                            html += tmpl(tpl.head.join(''), {
                                week: options.locale.weekMin,
                                prev: options.prev,
                                next: options.next,
                                day1: options.locale.daysMin[(cnt++)%7],
                                day2: options.locale.daysMin[(cnt++)%7],
                                day3: options.locale.daysMin[(cnt++)%7],
                                day4: options.locale.daysMin[(cnt++)%7],
                                day5: options.locale.daysMin[(cnt++)%7],
                                day6: options.locale.daysMin[(cnt++)%7],
                                day7: options.locale.daysMin[(cnt++)%7]
                            });
                        }
                        cal
                            .find('tr:first').append(html)
                            .find('table').addClass(views[options.view]);
                        fill(cal.get(0));
                        if (options.flat) {
                            cal.appendTo(this).show().css('position', 'relative');
                            layout(cal.get(0));
                        } else {
                            cal.appendTo(document.body);
                            $(this).bind(options.eventName, show);
                        }
                    }
                });
            },
            showPicker: function() {
                return this.each( function () {
                    if ($(this).data('datepickerId')) {
                        show.apply(this);
                    }
                });
            },
            hidePicker: function() {
                return this.each( function () {
                    if ($(this).data('datepickerId')) {
                        $('#' + $(this).data('datepickerId')).hide();
                    }
                });
            },
            setDate: function(date, shiftTo){
                return this.each(function(){
                    if ($(this).data('datepickerId')) {
                        var cal = $('#' + $(this).data('datepickerId'));
                        var options = cal.data('datepicker');
                        options.date = date;
                        if (options.date.constructor == String) {
                            options.date = parseDate(options.date, options.format);
                            options.date.setHours(0,0,0,0);
                        }
                        if (options.mode != 'single') {
                            if (options.date.constructor != Array) {
                                options.date = [options.date.valueOf()];
                                if (options.mode == 'range') {
                                    options.date.push(((new Date(options.date[0])).setHours(23,59,59,0)).valueOf());
                                }
                            } else {
                                for (var i = 0; i < options.date.length; i++) {
                                    options.date[i] = (parseDate(options.date[i], options.format).setHours(0,0,0,0)).valueOf();
                                }
                                if (options.mode == 'range') {
                                    options.date[1] = ((new Date(options.date[1])).setHours(23,59,59,0)).valueOf();
                                }
                            }
                        } else {
                            options.date = options.date.valueOf();
                        }
                        if (shiftTo) {
                            options.current = new Date (options.mode != 'single' ? options.date[0] : options.date);
                        }
                        fill(cal.get(0));
                    }
                });
            },
            getDate: function(formated) {
                if (this.size() > 0) {
                    return prepareDate($('#' + $(this).data('datepickerId')).data('datepicker'))[formated ? 0 : 1];
                }
            },
            clear: function(){
                return this.each(function(){
                    if ($(this).data('datepickerId')) {
                        var cal = $('#' + $(this).data('datepickerId'));
                        var options = cal.data('datepicker');
                        if (options.mode != 'single') {
                            options.date = [];
                            fill(cal.get(0));
                        }
                    }
                });
            },
            fixLayout: function(){
                return this.each(function(){
                    if ($(this).data('datepickerId')) {
                        var cal = $('#' + $(this).data('datepickerId'));
                        var options = cal.data('datepicker');
                        if (options.flat) {
                            layout(cal.get(0));
                        }
                    }
                });
            }
        };
    }();
    $.fn.extend({
        DatePicker: DatePicker.init,
        DatePickerHide: DatePicker.hidePicker,
        DatePickerShow: DatePicker.showPicker,
        DatePickerSetDate: DatePicker.setDate,
        DatePickerGetDate: DatePicker.getDate,
        DatePickerClear: DatePicker.clear,
        DatePickerLayout: DatePicker.fixLayout
    });
})(jQuery);

(function(){
    var cache = {};

    this.tmpl = function tmpl(str, data){
        // Figure out if we're getting a template, or if we need to
        // load the template - and be sure to cache the result.
        var fn = !/\W/.test(str) ?
            cache[str] = cache[str] ||
                tmpl(document.getElementById(str).innerHTML) :

            // Generate a reusable function that will serve as a template
            // generator (and which will be cached).
            new Function("obj",
                "var p=[],print=function(){p.push.apply(p,arguments);};" +

                    // Introduce the data as local variables using with(){}
                    "with(obj){p.push('" +

                    // Convert the template into pure JavaScript
                    str
                        .replace(/[\r\t\n]/g, " ")
                        .split("<%").join("\t")
                        .replace(/((^|%>)[^\t]*)'/g, "$1\r")
                        .replace(/\t=(.*?)%>/g, "',$1,'")
                        .split("\t").join("');")
                        .split("%>").join("p.push('")
                        .split("\r").join("\\'")
                    + "');}return p.join('');");

        // Provide some basic currying to the user
        return data ? fn( data ) : fn;
    };
})();

/*
 ---
 name: Fx.TextMorph.js
 description: Creates a text with predetermined form.
 authors: Nicolas de Marqué
 requires:
 core/1.2.4:
 provides: [TextMorph]
 license: MIT-style license
 version: 1.0.0
 ...


var TextMorph = function(element, options){
    this.options= {
        draw : null,
        functions : null,
        functionRight : null,
        functionLeft : null,
        lineHeight : null,
        width : null,
        height : null,
        debug : false,
        backgroundcolor : null,
        first : true,
        shy : true
    };
    this.initialize = function(element, options){
        this.subject = this.subject || this;
        this.setOptions(options);
        this.element = element;

        if (!this.options.width)
            this.options.width = $(this.element).width();
        if (!this.options.height)
            this.options.height = $(this.element).height();
        if (this.options.draw != null){
            this.options.functionRight = eval("this."+this.options.draw);
            this.options.functionLeft = eval("this."+this.options.draw);
        }
        if((typeof eval(this.options.functions))=="function"){
            this.options.functionRight=this.options.functions;
            this.options.functionLeft=this.options.functions;
        };
        if ((typeof eval(this.options.functionRight))!="function")
            this.options.functionRight = this.circle;
        if ((typeof eval(this.options.functionLeft))!="function")
            this.options.functionLeft = this.circle;

        if (!this.options.lineHeight)
            this.options.lineHeight = parseFloat($(this.element).css('line-height'), 10);

        this.width =this.options.width;
        this.height=this.options.height;
        this.functionRight = this.options.functionRight || this.circle;
        this.functionLeft  = this.options.functionLeft || this.circle;
        this.lineHeight = this.options.lineHeight;
        this.debug = this.options.debug;
        this.backgroundcolor = this.options.backgroundcolor;
        this.shy = this.options.shy;
        this.changeOrigin();
        this.placeContent();
        this.drawForm();
        //For chrome compatibility
        this.firstChild[0].previousSibling.parentNode.removeChild(this.firstChild[0].previousSibling)
    }
    this.changeOrigin = function() {
        $(this.element).css({'width': this.width + 'px'});
        $(this.element).css({'height': this.height + 'px'});
        $(this.element).css({'overflow': 'hidden'});
    };
    this.placeContent = function() {
        divfloat = $("<div></div>").css( {
            'float' : 'left'
        }).addClass("floatie");
        divclear = $("<div></div>").css( {
            'clear' : 'both'
        }).addClass("floatie");
        var div = $("<div></div>").css( {
            'margin-top':'-' + (this.height-this.lineHeight) + 'px'
        }).addClass("content");
        while (this.element.hasChildNodes()) {
            $(div).append(this.element.removeChild(this.element.firstChild));
        }
        if(this.shy)this.simplyShy(div);
        this.firstChild = div;
        divfloat.append(div);
        $(this.element).append(divfloat);
        $(this.element).append(divclear);
    };
    this.drawForm = function() {
        var y = this.height;
        var inc=0;
        while (y > 0) {
            this.y=parseFloat(y, 10)
            var widthLeft = jQuery.map([this], this.functionLeft);
            var widthRight = jQuery.map([this],  this.functionRight);
            this.makeDivs(widthLeft, widthRight);
            y -= this.lineHeight;
            inc++;
        }
        ;
    };
    this.makeDivs = function(widthLeft, widthRight) {
        var debugcolor="";
        if(this.debug)debugcolor="black";
        if(this.backgroundcolor)debugcolor=this.backgroundcolor;
        $(this.firstChild).before( $("<div></div>").css( {
            'background' : debugcolor,
            'float': 'left',
            'width' : widthLeft+"px",
            'height': this.lineHeight+"px"
        }).addClass("floatLeft"));
        $(this.firstChild).before( $("<div></div>").css( {
            'background' : debugcolor,
            'float':'right',
            'width': widthRight+"px",
            'height': this.lineHeight+"px"
        }).addClass("floatRight"));
        $(this.firstChild).before( $("<div></div>").css( {
            'clear':'both'
        }));
    };
    this.pregReplace = function(pattern, replacement, subject, limit) {
        // parameter limit is optional (default value is -1)
        // paramater pattern is a string type
        // ex: pregReplace("/Hello/i","Hi",strtoreplace)
        if (typeof limit == "undefined")
            limit = -1;
        if (subject.match(eval(pattern))) {
            if (limit == -1) { // no limit
                return subject.replace(eval(pattern + "g"), replacement);
            } else {
                for (x = 0; x < limit; x++) {
                    subject = subject.replace(eval(pattern), replacement);
                }
                return subject;
            }
        } else {
            return subject;
        }
    };
    this.diamond = function(obj){

        var y=(obj.height-obj.y)/obj.height
        if(obj.y>obj.height/2)
            return obj.width/2-y*obj.width
        else
            return y*obj.width-obj.width/2
    };
    this.trapeze = function(obj){
        var y=(obj.height-obj.y)/obj.height
        return (1-y)*obj.width/4;
    };
    this.trianglebottom = function(obj){
        var y=(obj.height-obj.y)/obj.height
        return y*obj.width/2;
    };
    this.triangletop = function(obj){
        var y=(obj.height-obj.y)/obj.height
        return (1-y)*obj.width/2;
    };
    this.fir = function(obj) {
        var y = (obj.y - obj.height) * -1;
        var coeff = obj.height * 10 / 100;
        var etape = y % coeff;
        if (y >= 0 && y < 10 / 100 * obj.height) {
            return 50 / 100 * obj.width - (y) * (y) / 2 / (coeff);
        }
        if (y >= 10 / 100 * obj.height && y < 20 / 100 * obj.height) {
            return 47 / 100 * obj.width - (y - 10 / 100 * obj.width)
                * (y - 10 / 100 * obj.width) / (coeff);
        }
        if (y >= 10 / 100 * obj.height && y < 35 / 100 * obj.height) {
            return 40 / 100 * obj.width - (y - 20 / 100 * obj.width)
                * (y - 20 / 100 * obj.width) / (coeff * 2);
        }
        if (y >= 35 / 100 * obj.height && y < 55 / 100 * obj.height) {
            return 35 / 100 * obj.width - (y - 35 / 100 * obj.width)
                * (y - 35 / 100 * obj.width) / (coeff * 2);
        }
        if (y >= 55 / 100 * obj.height && y < 80 / 100 * obj.height) {
            return 30 / 100 * obj.width - (y - 50 / 100 * obj.width)
                * (y - 50 / 100 * obj.width) / (coeff * 2.7);
        }
        if (y >= 80 / 100 * obj.height) {
            return 40 / 100 * obj.width;
        }
    }
    this.circle = function(obj) {
        //alert("circle"+y)
        var r = Math.min(obj.height, obj.width) / 2;
        var cx = obj.width / 2;
        var cy = obj.height / 2;
        if(obj.y>=(cy+r) || obj.y<(cy-r))return obj.width/2;
        var result = Math.abs(Math.round(cx
            - Math.sqrt(
            Math.abs(
                Math.pow(r, 2) - Math.pow(obj.y - cy, 2)
            )
        )
        ));
        return result;
        // return (x - a)² + (y - b)² = r²
    }
    this.simplyShy = function(element) {
        var replacements = "$1\u00ad$2";
        var patterns = "/\([aeiéèäâêïöouyAEIOUY][bcdfghjklmnpqrstvwxzBCDFGHJKLMNPQRSTVWXZ]\)\([bcdfghjklmnpqrstvwxzBCDFGHJKLMNPQRSTVWXZ]\)/";
        element.text(this.pregReplace(patterns, replacements, element
            .text()));
        patterns = "/\([aeiéèäâêïöouyAEIOUY]\)\([bcdfghjklmnpqrstvwxzBCDFGHJKLMNPQRSTVWXZ][aeiéèäâêïöouyAEIOUY]\)/";
        element.text(this.pregReplace(patterns, replacements, element
            .text()));
        patterns = "/\([aeiéèäâêïöouyAEIOUY]\)\([aeiéèäâêïöouyAEIOUY]\)/";
        element.text(this.pregReplace(patterns, replacements, element
            .text()));
    };
    this.initialize(element, options);
}

TextMorph.prototype.setOptions = function(options){
    for (var option in options){
        if(typeof options[option]!="function"){
            eval ("this.options."+option+" = '"+options[option]+"'");
        }else{
            if(option=="functionLeft")
                this.options.functionLeft=options[option]
            if(option=="functionRight")
                this.options.functionRight=options[option]
            if(option=="functions")
                this.options.functions=options[option]
        }
    }
};
*/

/*
 *
 * jQuery listnav plugin
 * Copyright (c) 2009 iHwy, Inc.
 * Author: Jack Killpatrick
 *
 * Version 2.1 (08/09/2009)
 * Requires jQuery 1.3.2, jquery 1.2.6 or jquery 1.2.x plus the jquery dimensions plugin
 *
 * Visit http://www.ihwy.com/labs/jquery-listnav-plugin.aspx for more information.
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 *


(function($) {
    $.fn.listnav = function(options) {
        var opts = $.extend({}, $.fn.listnav.defaults, options);
        var letters = ['_', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '-'];
        var firstClick = false;
        opts.prefixes = $.map(opts.prefixes, function(n) { return n.toLowerCase(); });

        return this.each(function() {
            var $wrapper, list, $list, $letters, $letterCount, id;
            id = this.id;
            $wrapper = $('#' + id + '-nav'); // user must abide by the convention: <ul id="myList"> for list and <div id="myList-nav"> for nav wrapper
            $list = $(this);

            var counts = {}, allCount = 0, isAll = true, numCount = 0, prevLetter = '';

            function init() {
                $wrapper.append(createLettersHtml());

                $letters = $('.ln-letters', $wrapper).slice(0, 1); // will always be a single item
                if (opts.showCounts) $letterCount = $('.ln-letter-count', $wrapper).slice(0, 1); // will always be a single item

                addClasses();
                addNoMatchLI();
                if (opts.flagDisabled) addDisabledClass();
                bindHandlers();

                if (!opts.includeAll) $list.show(); // show the list in case the recommendation for includeAll=false was taken

                // remove nav items we don't need
                //
                if (!opts.includeAll) $('.all', $letters).remove();
                if (!opts.includeNums) $('._', $letters).remove();
                if (!opts.includeOther) $('.-', $letters).remove();

                $(':last', $letters).addClass('ln-last'); // allows for styling a case where last item needs right border set (because items before that only have top, left and bottom so that border between items isn't doubled)

                if ($.cookie && (opts.cookieName != null)) {
                    var cookieLetter = $.cookie(opts.cookieName);
                    if (cookieLetter != null) opts.initLetter = cookieLetter;
                }

                // decide what to show first
                //
                if (opts.initLetter != '') {
                    firstClick = true;
                    $('.' + opts.initLetter.toLowerCase(), $letters).slice(0, 1).click(); // click the initLetter if there was one
                }
                else {
                    if (opts.includeAll) $('.all', $letters).addClass('ln-selected'); // showing all: we don't need to click this: the whole list is already loaded
                    else { // ALL link is hidden, click the first letter that will display LI's
                        for (var i = ((opts.includeNums) ? 0 : 1); i < letters.length; i++) {
                            if (counts[letters[i]] > 0) {
                                firstClick = true;
                                $('.' + letters[i], $letters).slice(0, 1).click();
                                break;
                            }
                        }
                    }
                }
            }

            // positions the letter count div above the letter links (so we only have to do it once: after this we just change it's left position via mouseover)
            //
            function setLetterCountTop() {
//                $letterCount.css({ top: $('.a', $letters).slice(0, 1).offset({ margin: false, border: true }).top - $letterCount.outerHeight({ margin: true }) }); // note: don't set top based on '.all': it might not be visible
            }

            // adds a class to each LI that has text content inside of it (ie, inside an <a>, a <div>, nested DOM nodes, etc)
            //
            function addClasses() {
                var str, firstChar, firstWord, spl, $this, hasPrefixes = (opts.prefixes.length > 0);
                $($list).children().each(function() {
                    $this = $(this), firstChar = '', str = $.trim($this.text()).toLowerCase().split("'").join("' ");
                    if (str != '') {
                        if (hasPrefixes) {
                            spl = str.split(' ');
                            if ((spl.length > 1) && ($.inArray(spl[0], opts.prefixes) > -1)) {
                                firstChar = spl[1].charAt(0);
                                addLetterClass(firstChar, $this, true);
                            }
                        }
                        firstChar = str.charAt(0);
                        addLetterClass(firstChar, $this);
                    }
                });
            }

            var prevChar;
            function addLetterClass(firstChar, $el, isPrefix) {
                if (/\W/.test(firstChar)) firstChar = '-'; // not A-Z, a-z or 0-9, so considered "other"
                if (!isNaN(firstChar)) firstChar = '_'; // use '_' if the first char is a number
                $el.addClass('ln-' + firstChar);
                //console.log(prevChar);
                //console.log(firstChar);
                //console.log($el);
                //console.log("isPrefix: " + isPrefix);
                if (counts[firstChar] == undefined) counts[firstChar] = 0;
                if (counts[firstChar] == 0 && (firstChar == 'l' && isPrefix)) {
//                    $el.addClass('ln-first').prepend('<span class="ln-letter">' + firstChar.toUpperCase() + '</span>');
                }
                else if (counts[firstChar] == 0) {
                    $el.addClass('ln-first').prepend('<span class="ln-letter">' + firstChar.toUpperCase() + '</span>');
                }
                if (prevChar != firstChar && prevChar != undefined  && counts[firstChar] == 0) $el.before('<li class="ln-separator" />');
                prevChar = firstChar;
                counts[firstChar]++;
                if (!isPrefix) allCount++;
                else $el.addClass('prefix');
            }

            function addDisabledClass() {
                for (var i = 0; i < letters.length; i++) {
                    if (counts[letters[i]] == undefined) $('.' + letters[i], $letters).addClass('ln-disabled');
                }
            }

            function addNoMatchLI() {
                $list.append('<li class="ln-no-match" style="display:none">' + opts.noMatchText + '</li>');
            }

            function getLetterCount(el) {
                if ($(el).hasClass('all')) return allCount;
                else {
                    var count = counts[$(el).attr('class').split(' ')[0]];
                    return (count != undefined) ? count : 0; // some letters may not have a count in the hash
                }
            }

            function bindHandlers() {

                // sets the top position of the count div in case something above it on the page has resized
                //
                if (opts.showCounts) {
                    $wrapper.mouseover(function() {
                        setLetterCountTop();
                    });
                }

                // mouseover for each letter: shows the count above the letter
                //
                if (opts.showCounts) {
                    $('a', $letters).mouseover(function() {
                        var left = $(this).position().left;
                        var width = ($(this).outerWidth({ margin: true }) - 1) + 'px'; // the -1 is to tweak the width a bit due to a seeming inaccuracy in jquery ui/dimensions outerWidth (same result in FF2 and IE6/7)
                        var count = getLetterCount(this);
                        $letterCount.css({ left: left, width: width }).text(count).show(); // set left position and width of letter count, set count text and show it
                    });

                    // mouseout for each letter: hide the count
                    //
                    $('a', $letters).mouseout(function() {
                        $letterCount.hide();
                    });
                }

                // click handler for letters: shows/hides relevant LI's
                //
                $('a', $letters).click(function() {
                    $('a.ln-selected', $letters).removeClass('ln-selected');

                    var letter = $(this).attr('class').split(' ')[0];

                    if (letter == 'all') {
                        $list.children().show();
                        $list.children('.ln-no-match').hide();
                        isAll = true;
                    } else {
                        if (isAll) {
                            $list.children().hide();
                            isAll = false;
                        } else if (prevLetter != '') $list.children('.ln-' + prevLetter).hide();

                        var count = getLetterCount(this);
                        if (count > 0) {
                            $list.children('.ln-no-match').hide(); // in case it's showing
                            $list.children('.ln-' + letter).show();
                        }
                        else $list.children('.ln-no-match').show();

                        prevLetter = letter;
                    }

                    if ($.cookie && (opts.cookieName != null)) $.cookie(opts.cookieName, letter);


                    $(this).addClass('ln-selected');
                    $(this).blur();
                    if (!firstClick && (opts.onClick != null)) opts.onClick(letter);
                    else firstClick = false;
                    return false;
                });
            }

            // creates the HTML for the letter links
            //
            function createLettersHtml() {
                var html = [];
                for (var i = 1; i < letters.length; i++) {
                    if (html.length == 0) html.push('<a class="all" href="#">ALL</a><a class="_" href="#">0-9</a>');
                    html.push('<a class="' + letters[i] + '" href="#">' + ((letters[i] == '-') ? '...' : letters[i].toUpperCase()) + '</a>');
                }
                return '<div class="ln-letters">' + html.join('') + '</div>' + ((opts.showCounts) ? '<div class="ln-letter-count" style="display:none; position:absolute; top:0; left:0; width:20px;">0</div>' : ''); // the styling for ln-letter-count is to give us a starting point for the element, which will be repositioned when made visible (ie, should not need to be styled by the user)
            }

            init();
        });
    };

    $.fn.listnav.defaults = {
        initLetter: '',
        includeAll: true,
        incudeOther: false,
        includeNums: true,
        flagDisabled: true,
        noMatchText: 'No matching entries',
        showCounts: true,
        cookieName: null,
        onClick: null,
        prefixes: []
    };
})(jQuery);
*/

/** noUislider 2.5.5
 ** No copyrights or licenses. Do what you like. Feel free to share this code, or build upon it.
 ** @author: 		@leongersen
 ** @repository:	https://github.com/leongersen/noUiSlider
 **/
(function(a){a.fn.noUiSlider=function(b,c){function d(a){return a<0}function e(a){return Math.abs(a)}function f(a,b){return Math.round(a/b)*b}function g(a){return jQuery.extend(true,{},a)}var h,i,j,c=c||[],k,l="ontouchstart"in document.documentElement;h={handles:2,connect:true,scale:[0,100],start:[25,75],to:0,handle:0,change:"",end:"",step:false,save:false,click:true};j={scale:function(a,b,c){var f=b[0],g=b[1];if(d(f)){a=a+e(f);g=g+e(f)}else{a=a-f;g=g-f}return a*c/g},deScale:function(a,b,c){var f=b[0],g=b[1];g=d(f)?g+e(f):g-f;return a*g/c+f},connect:function(a){if(a.connect){if(a.handles.length>1){a.connect.css({left:a.low.left(),right:a.slider.innerWidth()-a.up.left()})}else{a.low?a.connect.css({left:a.low.left(),right:0}):a.connect.css({left:0,right:a.slider.innerWidth()-a.up.left()})}}},left:function(){return parseFloat(a(this).css("left"))},call:function(a,b,c){if(typeof a=="function"){a.call(b,c)}},bounce:function(a,b,c,d){var e=false;if(d.is(a.up)){if(a.low&&b<a.low.left()){b=a.low.left();e=true}}else{if(a.up&&b>a.up.left()){b=a.up.left();e=true}}if(b>a.slider.innerWidth()){b=a.slider.innerWidth();e=true}else if(b<0){b=0;e=true}return[b,e]}};i={init:function(){return this.each(function(){var b,d,e;d=a(this).css("position","relative");e=new Object;e.options=a.extend(h,c);b=e.options;typeof b.start=="object"?1:b.start=[b.start];e.slider=d;e.low=a('<div class="noUi-handle noUi-lowerHandle"><div></div></div>');e.up=a('<div class="noUi-handle noUi-upperHandle"><div></div></div>');e.connect=a('<div class="noUi-midBar"></div>');b.connect?e.connect.appendTo(e.slider):e.connect=false;if(b.knobs){b.handles=b.knobs}if(b.handles===1){if(b.connect===true||b.connect==="lower"){e.low=false;e.up=e.up.appendTo(e.slider);e.handles=[e.up]}else if(b.connect==="upper"||!b.connect){e.low=e.low.prependTo(e.slider);e.up=false;e.handles=[e.low]}}else{e.low=e.low.prependTo(e.slider);e.up=e.up.appendTo(e.slider);e.handles=[e.low,e.up]}if(e.low){e.low.left=j.left}if(e.up){e.up.left=j.left}e.slider.children().css("position","absolute");a.each(e.handles,function(c){a(this).css({left:j.scale(b.start[c],e.options.scale,e.slider.innerWidth()),zIndex:c+1}).children().bind(l?"touchstart.noUi":"mousedown.noUi",k.start)});if(b.click){e.slider.click(k.click).find("*:not(.noUi-midBar)").click(k.flse)}j.connect(e);e.options=b;e.slider.data("api",e)})},move:function(){var b,d,e,f,h;b=g(a(this).data("api"));b.options=a.extend(b.options,c);if(b.options.knob){b.options.handle=b.options.knob}f=b.options.handle;f=b.handles[f=="lower"||f==0||typeof f=="undefined"?0:1];d=j.bounce(b,j.scale(b.options.to,b.options.scale,b.slider.innerWidth()),f.left(),f);f.css("left",d[0]);if(f.is(b.up)&&f.left()==0||f.is(b.low)&&f.left()==b.slider.innerWidth()){f.css("zIndex",parseInt(f.css("zIndex"))+2)}if(c.save===true){b.options.scale=c.scale;a(this).data("api",b)}j.connect(b);j.call(b.options.change,b.slider,"move");j.call(b.options.end,b.slider,"move")},value:function(){var b,d,e;e=g(a(this).data("api"));e.options=a.extend(e.options,c);b=e.low?Math.round(j.deScale(e.low.left(),e.options.scale,e.slider.innerWidth())):false;d=e.up?Math.round(j.deScale(e.up.left(),e.options.scale,e.slider.innerWidth())):false;if(c.save){e.options.scale=c.scale;a(this).data("api",e)}return[b,d]},api:function(){return a(this).data("api")},disable:function(){return this.each(function(){a(this).addClass("disabled")})},enable:function(){return this.each(function(){a(this).removeClass("disabled")})}},k={start:function(b){if(!a(this).parent().parent().hasClass("disabled")){b.preventDefault();a("body").bind("selectstart.noUi",k.flse);a(this).addClass("noUi-activeHandle");a(document).bind(l?"touchmove.noUi":"mousemove.noUi",k.move);l?a(this).bind("touchend.noUi",k.end):a(document).bind("mouseup.noUi",k.end)}},move:function(b){var c,f,g,h,i=false,k,l;g=a(".noUi-activeHandle");h=g.parent().parent().data("api");k=g.parent().is(h.low)?h.low:h.up;c=b.pageX-Math.round(h.slider.offset().left);if(isNaN(c)){c=b.originalEvent.touches[0].pageX-Math.round(h.slider.offset().left)}f=k.left();l=j.bounce(h,c,f,k);c=l[0];i=l[1];if(h.options.step&&!i){var m=h.options.scale[0],n=h.options.scale[1];if(d(n)){n=e(m-n);m=0}n=n+ -1*m;var o=j.scale(h.options.step,[0,n],h.slider.innerWidth());if(Math.abs(f-c)>=o){c=c<f?f-o:f+o;i=true}}else{i=true}if(c===f){i=false}if(i){k.css("left",c);if(k.is(h.up)&&k.left()==0||k.is(h.low)&&k.left()==h.slider.innerWidth()){k.css("zIndex",parseInt(k.css("zIndex"))+2)}j.connect(h);j.call(h.options.change,h.slider,"slide")}},end:function(){var b,c;b=a(".noUi-activeHandle");c=b.parent().parent().data("api");a(document).add("body").add(b.removeClass("noUi-activeHandle").parent()).unbind(".noUi");j.call(c.options.end,c.slider,"slide")},click:function(b){if(!a(this).hasClass("disabled")){var c=a(this).data("api");var d=c.options;var e=b.pageX-c.slider.offset().left;e=d.step?f(e,j.scale(d.step,d.scale,c.slider.innerWidth())):e;if(c.low&&c.up){e<(c.low.left()+c.up.left())/2?c.low.css("left",e):c.up.css("left",e)}else{c.handles[0].css("left",e)}j.connect(c);j.call(d.change,c.slider,"click");j.call(d.end,c.slider,"click")}},flse:function(){return false}};if(i[b]){return i[b].apply(this,Array.prototype.slice.call(arguments,1))}else if(typeof b==="object"||!b){return i.init.apply(this,arguments)}else{a.error("No such method: "+b)}}})(jQuery);

/* backgroundSize: A jQuery cssHook adding support for "cover" and "contain" to IE6,7,8 */
(function(e,t,n,r,i){var s=e("<div>")[0],o=/url\(["']?(.*?)["']?\)/,u=[],a={top:0,left:0,bottom:1,right:1,center:.5};if("backgroundSize"in s.style&&!e.debugBGS){return}e.cssHooks.backgroundSize={set:function(t,n){var r=!e.data(t,"bgsImg"),i,s,o;e.data(t,"bgsValue",n);if(r){u.push(t);e.refreshBackgroundDimensions(t,true);s=e("<div>").css({position:"absolute",zIndex:-1,top:0,right:0,left:0,bottom:0,overflow:"hidden"});o=e("<img>").css({position:"absolute"}).appendTo(s),s.prependTo(t);e.data(t,"bgsImg",o[0]);i=(e.css(t,"backgroundPosition")||e.css(t,"backgroundPositionX")+" "+e.css(t,"backgroundPositionY")).split(" ");e.data(t,"bgsPos",[a[i[0]]||parseFloat(i[0])/100,a[i[1]]||parseFloat(i[1])/100]);e.css(t,"zIndex")=="auto"&&(t.style.zIndex=0);e.css(t,"position")=="static"&&(t.style.position="relative");e.refreshBackgroundImage(t)}else{e.refreshBackground(t)}},get:function(t){return e.data(t,"bgsValue")||""}};e.cssHooks.backgroundImage={set:function(t,n){return e.data(t,"bgsImg")?e.refreshBackgroundImage(t,n):n}};e.refreshBackgroundDimensions=function(t,n){var r=e(t),i={width:r.innerWidth(),height:r.innerHeight()},s=e.data(t,"bgsDim"),o=!s||i.width!=s.width||i.height!=s.height;e.data(t,"bgsDim",i);if(o&&!n){e.refreshBackground(t)}};e.refreshBackgroundImage=function(t,n){var r=e.data(t,"bgsImg"),i=(o.exec(n||e.css(t,"backgroundImage"))||[])[1],s=r&&r.src,u=i!=s,a,f;if(u){r.style.height=r.style.width="auto";r.onload=function(){var n={width:r.width,height:r.height};if(n.width==1&&n.height==1){return}e.data(t,"bgsImgDim",n);e.data(t,"bgsConstrain",false);e.refreshBackground(t);r.style.visibility="visible";r.onload=null};r.style.visibility="hidden";r.src=i;if(r.readyState||r.complete){r.src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";r.src=i}t.style.backgroundImage="none"}};e.refreshBackground=function(t){var n=e.data(t,"bgsValue"),i=e.data(t,"bgsDim"),s=e.data(t,"bgsImgDim"),o=e(e.data(t,"bgsImg")),u=e.data(t,"bgsPos"),a=e.data(t,"bgsConstrain"),f,l=i.width/i.height,c=s.width/s.height,h;if(n=="contain"){if(c>l){e.data(t,"bgsConstrain",f="width");h=r.floor((i.height-i.width/c)*u[1]);o.css({top:h});if(f!=a){o.css({width:"100%",height:"auto",left:0})}}else{e.data(t,"bgsConstrain",f="height");h=r.floor((i.width-i.height*c)*u[0]);o.css({left:h});if(f!=a){o.css({height:"100%",width:"auto",top:0})}}}else if(n=="cover"){if(c>l){e.data(t,"bgsConstrain",f="height");h=r.floor((i.height*c-i.width)*u[0]);o.css({left:-h});if(f!=a){o.css({height:"100%",width:"auto",top:0})}}else{e.data(t,"bgsConstrain",f="width");h=r.floor((i.width/c-i.height)*u[1]);o.css({top:-h});if(f!=a){o.css({width:"100%",height:"auto",left:0})}}}};var f=e.event,l,c={_:0},h=0,p,d;l=f.special.throttledresize={setup:function(){e(this).on("resize",l.handler)},teardown:function(){e(this).off("resize",l.handler)},handler:function(t,n){var r=this,i=arguments;p=true;if(!d){e(c).animate(c,{duration:Infinity,step:function(){h++;if(h>l.threshold&&p||n){t.type="throttledresize";f.dispatch.apply(r,i);p=false;h=0}if(h>9){e(c).stop();d=false;h=0}}});d=true}},threshold:1};e(t).on("throttledresize",function(){e(u).each(function(){e.refreshBackgroundDimensions(this)})})})(jQuery,window,document,Math);

/*!
 /**
 * Monkey patch jQuery 1.3.1+ to add support for setting or animating CSS
 * scale and rotation independently.
 * https://github.com/zachstronaut/jquery-animate-css-rotate-scale
 * Released under dual MIT/GPL license just like jQuery.
 * 2009-2012 Zachary Johnson www.zachstronaut.com
 */
(function ($) {
    // Updated 2010.11.06
    // Updated 2012.10.13 - Firefox 16 transform style returns a matrix rather than a string of transform functions.  This broke the features of this jQuery patch in Firefox 16.  It should be possible to parse the matrix for both scale and rotate (especially when scale is the same for both the X and Y axis), however the matrix does have disadvantages such as using its own units and also 45deg being indistinguishable from 45+360deg.  To get around these issues, this patch tracks internally the scale, rotation, and rotation units for any elements that are .scale()'ed, .rotate()'ed, or animated.  The major consequences of this are that 1. the scaled/rotated element will blow away any other transform rules applied to the same element (such as skew or translate), and 2. the scaled/rotated element is unaware of any preset scale or rotation initally set by page CSS rules.  You will have to explicitly set the starting scale/rotation value.

    function initData($el) {
        var _ARS_data = $el.data('_ARS_data');
        if (!_ARS_data) {
            _ARS_data = {
                rotateUnits: 'deg',
                scale: 1,
                rotate: 0
            };

            $el.data('_ARS_data', _ARS_data);
        }

        return _ARS_data;
    }

    function setTransform($el, data) {
        $el.css('transform', 'rotate(' + data.rotate + data.rotateUnits + ') scale(' + data.scale + ',' + data.scale + ')');
    }

    $.fn.rotate = function (val) {
        var $self = $(this), m, data = initData($self);

        if (typeof val == 'undefined') {
            return data.rotate + data.rotateUnits;
        }

        m = val.toString().match(/^(-?\d+(\.\d+)?)(.+)?$/);
        if (m) {
            if (m[3]) {
                data.rotateUnits = m[3];
            }

            data.rotate = m[1];

            setTransform($self, data);
        }

        return this;
    };

    // Note that scale is unitless.
    $.fn.scale = function (val) {
        var $self = $(this), data = initData($self);

        if (typeof val == 'undefined') {
            return data.scale;
        }

        data.scale = val;

        setTransform($self, data);

        return this;
    };

    // fx.cur() must be monkey patched because otherwise it would always
    // return 0 for current rotate and scale values
    var curProxied = $.fx.prototype.cur;
    $.fx.prototype.cur = function () {
        if (this.prop == 'rotate') {
            return parseFloat($(this.elem).rotate());

        } else if (this.prop == 'scale') {
            return parseFloat($(this.elem).scale());
        }

        return curProxied.apply(this, arguments);
    };

    $.fx.step.rotate = function (fx) {
        var data = initData($(fx.elem));
        $(fx.elem).rotate(fx.now + data.rotateUnits);
    };

    $.fx.step.scale = function (fx) {
        $(fx.elem).scale(fx.now);
    };

    /*

     Starting on line 3905 of jquery-1.3.2.js we have this code:

     // We need to compute starting value
     if ( unit != "px" ) {
     self.style[ name ] = (end || 1) + unit;
     start = ((end || 1) / e.cur(true)) * start;
     self.style[ name ] = start + unit;
     }

     This creates a problem where we cannot give units to our custom animation
     because if we do then this code will execute and because self.style[name]
     does not exist where name is our custom animation's name then e.cur(true)
     will likely return zero and create a divide by zero bug which will set
     start to NaN.

     The following monkey patch for animate() gets around this by storing the
     units used in the rotation definition and then stripping the units off.

     */

    var animateProxied = $.fn.animate;
    $.fn.animate = function (prop) {
        if (typeof prop['rotate'] != 'undefined') {
            var $self, data, m = prop['rotate'].toString().match(/^(([+-]=)?(-?\d+(\.\d+)?))(.+)?$/);
            if (m && m[5]) {
                $self = $(this);
                data = initData($self);
                data.rotateUnits = m[5];
            }

            prop['rotate'] = m[1];
        }

        return animateProxied.apply(this, arguments);
    };
})(jQuery);

// Apprise 1.5 by Daniel Raftery
// http://thrivingkings.com/apprise
//
// Button text added by Adam Bezulski
//
function apprise(string,args,callback)
{var default_args={'confirm':false,'verify':false,'input':false,'animate':false,'textOk':'Ok','textCancel':'Cancel','textYes':'Yes','textNo':'No'}
    if(args)
    {for(var index in default_args)
    {if(typeof args[index]=="undefined")args[index]=default_args[index];}}
    var aHeight=$(document).height();var aWidth=$(document).width();$('body').append('<div class="appriseOverlay" id="aOverlay"></div>');$('.appriseOverlay').css('height',aHeight).css('width',aWidth).fadeIn(100);$('body').append('<div class="appriseOuter"></div>');$('.appriseOuter').append('<div class="appriseInner"></div>');$('.appriseInner').append(string);$('.appriseOuter').css("left",($(window).width()-$('.appriseOuter').width())/2+$(window).scrollLeft()+"px");if(args)
{if(args['animate'])
{var aniSpeed=args['animate'];if(isNaN(aniSpeed)){aniSpeed=400;}
    $('.appriseOuter').css('top','-200px').show().animate({top:"100px"},aniSpeed);}
else
{$('.appriseOuter').css('top','100px').fadeIn(200);}}
else
{$('.appriseOuter').css('top','100px').fadeIn(200);}
    if(args)
    {if(args['input'])
    {if(typeof(args['input'])=='string')
    {$('.appriseInner').append('<div class="aInput"><input type="text" class="aTextbox" t="aTextbox" value="'+args['input']+'" /></div>');}
    else
    {$('.appriseInner').append('<div class="aInput"><input type="text" class="aTextbox" t="aTextbox" /></div>');}
        $('.aTextbox').focus();}}
    $('.appriseInner').append('<div class="aButtons"></div>');if(args)
{if(args['confirm']||args['input'])
{$('.aButtons').append('<button value="ok">'+args['textOk']+'</button>');$('.aButtons').append('<button value="cancel">'+args['textCancel']+'</button>');}
else if(args['verify'])
{$('.aButtons').append('<button value="ok">'+args['textYes']+'</button>');$('.aButtons').append('<button value="cancel">'+args['textNo']+'</button>');}
else
{$('.aButtons').append('<button value="ok">'+args['textOk']+'</button>');}}
else
{$('.aButtons').append('<button value="ok">Ok</button>');}
    $(document).keydown(function(e)
    {if($('.appriseOverlay').is(':visible'))
    {if(e.keyCode==13)
    {$('.aButtons > button[value="ok"]').click();}
        if(e.keyCode==27)
        {$('.aButtons > button[value="cancel"]').click();}}});var aText=$('.aTextbox').val();if(!aText){aText=false;}
    $('.aTextbox').keyup(function()
    {aText=$(this).val();});$('.aButtons > button').click(function()
{$('.appriseOverlay').remove();$('.appriseOuter').remove();if(callback)
{var wButton=$(this).attr("value");if(wButton=='ok')
{if(args)
{if(args['input'])
{callback(aText);}
else
{callback(true);}}
else
{callback(true);}}
else if(wButton=='cancel')
{callback(false);}}});}

/*!
 * Readmore.js jQuery plugin
 * Author: @jed_foster
 * Project home: jedfoster.github.io/Readmore.js
 * Licensed under the MIT license
 */

;(function($) {

  var readmore = 'readmore',
      defaults = {
        speed: 100,
        maxHeight: 200,
        moreLink: '<a href="#">Read More</a>',
        lessLink: '<a href="#">Close</a>',

        // callbacks
        beforeToggle: function(){},
        afterToggle: function(){}
      };

  function Readmore( element, options ) {
    this.element = element;

    this.options = $.extend( {}, defaults, options);

    $(this.element).data('max-height', this.options.maxHeight);

    delete(this.options.maxHeight);

    this._defaults = defaults;
    this._name = readmore;

    this.init();
  }

  Readmore.prototype = {

    init: function() {
      var $this = this;

      $(this.element).each(function() {
        var current = $(this),
            maxHeight = (current.css('max-height').replace(/[^-\d\.]/g, '') > current.data('max-height')) ? current.css('max-height').replace(/[^-\d\.]/g, '') : current.data('max-height');

        current.addClass('readmore-js-section');

        if(current.css('max-height') != "none") {
          current.css("max-height", "none");
        }

        current.data("boxHeight", current.outerHeight(true));

        if(current.outerHeight(true) < maxHeight) {
          // The block is shorter than the limit, so there's no need to truncate it.
          return true;
        }
        else {
          current.after($($this.options.moreLink).on('click', function(event) { $this.toggleSlider(this, current, event) }).addClass('readmore-js-toggle'));
        }

        current.data('sliderHeight', maxHeight);

        current.css({height: maxHeight});
      });
    },

    toggleSlider: function(trigger, element, event)
    {
      event.preventDefault();

      var $this = this,
          newHeight = newLink = '',
          more = false,
          sliderHeight = $(element).data('sliderHeight');

      if ($(element).height() == sliderHeight) {
        newHeight = $(element).data().boxHeight + "px";
        newLink = 'lessLink';
        more = true;
      }

      else {
        newHeight = sliderHeight;
        newLink = 'moreLink';
      }

      // Fire beforeToggle callback
      $this.options.beforeToggle(trigger, element, more);

      $(element).animate({"height": newHeight}, {duration: $this.options.speed });

      $(trigger).replaceWith($($this.options[newLink]).on('click', function(event) { $this.toggleSlider(this, element, event) }).addClass('readmore-js-toggle'));

      // Fire afterToggle callback
      $this.options.afterToggle(trigger, element, more);
    }
  };

  $.fn[readmore] = function( options ) {
    var args = arguments;
    if (options === undefined || typeof options === 'object') {
      return this.each(function () {
        if (!$.data(this, 'plugin_' + readmore)) {
          $.data(this, 'plugin_' + readmore, new Readmore( this, options ));
        }
      });
    } else if (typeof options === 'string' && options[0] !== '_' && options !== 'init') {
      return this.each(function () {
        var instance = $.data(this, 'plugin_' + readmore);
        if (instance instanceof Readmore && typeof instance[options] === 'function') {
          instance[options].apply( instance, Array.prototype.slice.call( args, 1 ) );
        }
      });
    }
  }
})(jQuery);

/**** WAYPOINTS ****/
/*
(function(){var v=[].indexOf||function(c){for(var f=0,q=this.length;f<q;f++)if(f in this&&this[f]===c)return f;return-1},u=[].slice;var n=this,r=function(c,f){var q,k,n,l,t,g,j,r;q=c(f);t=0<=v.call(f,"ontouchstart");k={horizontal:{},vertical:{}};n=1;l={};r=1;var s=function(a){var b=this;this.$element=a;this.element=a[0];this.didScroll=this.didResize=!1;this.id="context"+n++;this.oldScroll={x:a.scrollLeft(),y:a.scrollTop()};this.waypoints={horizontal:{},vertical:{}};a.data("waypoints-context-id",this.id);
l[this.id]=this;a.bind("scroll.waypoints",function(){if(!b.didScroll&&!t)return b.didScroll=!0,f.setTimeout(function(){b.doScroll();return b.didScroll=!1},c.waypoints.settings.scrollThrottle)});a.bind("resize.waypoints",function(){if(!b.didResize)return b.didResize=!0,f.setTimeout(function(){c.waypoints("refresh");return b.didResize=!1},c.waypoints.settings.resizeThrottle)})};s.prototype.doScroll=function(){var a,b=this;a={horizontal:{newScroll:this.$element.scrollLeft(),oldScroll:this.oldScroll.x,
forward:"right",backward:"left"},vertical:{newScroll:this.$element.scrollTop(),oldScroll:this.oldScroll.y,forward:"down",backward:"up"}};t&&(!a.vertical.oldScroll||!a.vertical.newScroll)&&c.waypoints("refresh");c.each(a,function(a,d){var h,f,p;p=[];h=(f=d.newScroll>d.oldScroll)?d.forward:d.backward;c.each(b.waypoints[a],function(a,b){var c,e;if(d.oldScroll<(c=b.offset)&&c<=d.newScroll||d.newScroll<(e=b.offset)&&e<=d.oldScroll)return p.push(b)});p.sort(function(a,b){return a.offset-b.offset});f||p.reverse();
return c.each(p,function(a,b){if(b.options.continuous||a===p.length-1)return b.trigger([h])})});return this.oldScroll={x:a.horizontal.newScroll,y:a.vertical.newScroll}};s.prototype.refresh=function(){var a,b,e=this;b=c.isWindow(this.element);a=this.$element.offset();this.doScroll();a={horizontal:{contextOffset:b?0:a.left,contextScroll:b?0:this.oldScroll.x,contextDimension:this.$element.width(),oldScroll:this.oldScroll.x,forward:"right",backward:"left",offsetProp:"left"},vertical:{contextOffset:b?
0:a.top,contextScroll:b?0:this.oldScroll.y,contextDimension:b?c.waypoints("viewportHeight"):this.$element.height(),oldScroll:this.oldScroll.y,forward:"down",backward:"up",offsetProp:"top"}};return c.each(a,function(a,b){return c.each(e.waypoints[a],function(a,e){var d,f,g,j,k;d=e.options.offset;g=e.offset;f=c.isWindow(e.element)?0:e.$element.offset()[b.offsetProp];c.isFunction(d)?d=d.apply(e.element):"string"===typeof d&&(d=parseFloat(d),-1<e.options.offset.indexOf("%")&&(d=Math.ceil(b.contextDimension*
d/100)));e.offset=f-b.contextOffset+b.contextScroll-d;if(!(e.options.onlyOnScroll&&null!=g)&&e.enabled){if(null!==g&&g<(j=b.oldScroll)&&j<=e.offset)return e.trigger([b.backward]);if(null!==g&&g>(k=b.oldScroll)&&k>=e.offset||null===g&&b.oldScroll>=e.offset)return e.trigger([b.forward])}})})};s.prototype.checkEmpty=function(){if(c.isEmptyObject(this.waypoints.horizontal)&&c.isEmptyObject(this.waypoints.vertical))return this.$element.unbind("resize.waypoints scroll.waypoints"),delete l[this.id]};var m=
function(a,b,e){var d;e=c.extend({},c.fn.waypoint.defaults,e);"bottom-in-view"===e.offset&&(e.offset=function(){var a;a=c.waypoints("viewportHeight");c.isWindow(b.element)||(a=b.$element.height());return a-c(this).outerHeight()});this.$element=a;this.element=a[0];this.axis=e.horizontal?"horizontal":"vertical";this.callback=e.handler;this.context=b;this.enabled=e.enabled;this.id="waypoints"+r++;this.offset=null;this.options=e;b.waypoints[this.axis][this.id]=this;k[this.axis][this.id]=this;e=null!=
(d=a.data("waypoints-waypoint-ids"))?d:[];e.push(this.id);a.data("waypoints-waypoint-ids",e)};m.prototype.trigger=function(a){if(this.enabled&&(null!=this.callback&&this.callback.apply(this.element,a),this.options.triggerOnce))return this.destroy()};m.prototype.disable=function(){return this.enabled=!1};m.prototype.enable=function(){this.context.refresh();return this.enabled=!0};m.prototype.destroy=function(){delete k[this.axis][this.id];delete this.context.waypoints[this.axis][this.id];return this.context.checkEmpty()};
m.getWaypointsByElement=function(a){var b;a=c(a).data("waypoints-waypoint-ids");if(!a)return[];b=c.extend({},k.horizontal,k.vertical);return c.map(a,function(a){return b[a]})};j={init:function(a,b){null==b&&(b={});null==b.handler&&(b.handler=a);this.each(function(){var a,d,h;a=c(this);h=null!=(d=b.context)?d:c.fn.waypoint.defaults.context;c.isWindow(h)||(h=a.closest(h));h=c(h);(d=l[h.data("waypoints-context-id")])||(d=new s(h));return new m(a,d,b)});c.waypoints("refresh");return this},disable:function(){return j._invoke(this,
"disable")},enable:function(){return j._invoke(this,"enable")},destroy:function(){return j._invoke(this,"destroy")},prev:function(a,b){return j._traverse.call(this,a,b,function(a,b,c){if(0<b)return a.push(c[b-1])})},next:function(a,b){return j._traverse.call(this,a,b,function(a,b,c){if(b<c.length-1)return a.push(c[b+1])})},_traverse:function(a,b,e){var d,h;null==a&&(a="vertical");null==b&&(b=f);h=g.aggregate(b);d=[];this.each(function(){var b;b=c.inArray(this,h[a]);return e(d,b,h[a])});return this.pushStack(d)},
_invoke:function(a,b){a.each(function(){var a;a=m.getWaypointsByElement(this);return c.each(a,function(a,c){c[b]();return!0})});return this}};c.fn.waypoint=function(){var a,b;b=arguments[0];a=2<=arguments.length?u.call(arguments,1):[];return j[b]?j[b].apply(this,a):c.isFunction(b)?j.init.apply(this,arguments):c.isPlainObject(b)?j.init.apply(this,[null,b]):b?c.error("The "+b+" method does not exist in jQuery Waypoints."):c.error("jQuery Waypoints needs a callback function or handler option.")};c.fn.waypoint.defaults=
{context:f,continuous:!0,enabled:!0,horizontal:!1,offset:0,triggerOnce:!1};g={refresh:function(){return c.each(l,function(a,b){return b.refresh()})},viewportHeight:function(){var a;return null!=(a=f.innerHeight)?a:q.height()},aggregate:function(a){var b,e,d;b=k;a&&(b=null!=(d=l[c(a).data("waypoints-context-id")])?d.waypoints:void 0);if(!b)return[];e={horizontal:[],vertical:[]};c.each(e,function(a,d){c.each(b[a],function(a,b){return d.push(b)});d.sort(function(a,b){return a.offset-b.offset});e[a]=
c.map(d,function(a){return a.element});return e[a]=c.unique(e[a])});return e},above:function(a){null==a&&(a=f);return g._filter(a,"vertical",function(a,c){return c.offset<=a.oldScroll.y})},below:function(a){null==a&&(a=f);return g._filter(a,"vertical",function(a,c){return c.offset>a.oldScroll.y})},left:function(a){null==a&&(a=f);return g._filter(a,"horizontal",function(a,c){return c.offset<=a.oldScroll.x})},right:function(a){null==a&&(a=f);return g._filter(a,"horizontal",function(a,c){return c.offset>
a.oldScroll.x})},enable:function(){return g._invoke("enable")},disable:function(){return g._invoke("disable")},destroy:function(){return g._invoke("destroy")},extendFn:function(a,b){return j[a]=b},_invoke:function(a){var b;b=c.extend({},k.vertical,k.horizontal);return c.each(b,function(b,c){c[a]();return!0})},_filter:function(a,b,e){var d,f;d=l[c(a).data("waypoints-context-id")];if(!d)return[];f=[];c.each(d.waypoints[b],function(a,b){if(e(d,b))return f.push(b)});f.sort(function(a,b){return a.offset-
b.offset});return c.map(f,function(a){return a.element})}};c.waypoints=function(){var a,b;b=arguments[0];a=2<=arguments.length?u.call(arguments,1):[];return g[b]?g[b].apply(null,a):g.aggregate.call(null,b)};c.waypoints.settings={resizeThrottle:100,scrollThrottle:30};return q.load(function(){return c.waypoints("refresh")})};"function"===typeof define&&define.amd?define("waypoints",["jquery"],function(c){return r(c,n)}):r(n.jQuery,n)}).call(this);*/
/**** STICKY ****/
/*
(function(){var b=function(c){var b,e;b={wrapper:'<div class="sticky-wrapper" />',stuckClass:"stuck"};e=function(a,b){a.wrap(b.wrapper);a.each(function(){var a;a=c(this);a.parent().height(a.outerHeight());return!0});return a.parent()};return c.waypoints("extendFn","sticky",function(a){var f,d;a=c.extend({},c.fn.waypoint.defaults,b,a);f=e(this,a);d=a.handler;a.handler=function(b){c(this).children(":first").toggleClass(a.stuckClass,"down"===b||"right"===b);if(null!=d)return d.call(this,b)};f.waypoint(a);
return this})};"function"===typeof define&&define.amd?define(["jquery","waypoints"],b):b(this.jQuery)}).call(this);*/