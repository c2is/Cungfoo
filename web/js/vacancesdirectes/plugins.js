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

/* INFOBOX FOR GMAP*/
/*function InfoBox(opts) {
    google.maps.OverlayView.call(this);
    this.latlng_ = opts.latlng;
    this.map_ = opts.map;
    this.offsetVertical_ = -195;
    this.offsetHorizontal_ = 0;
    this.height_ = 165;
    this.width_ = 266;

    var me = this;
    this.boundsChangedListener_ =
        google.maps.event.addListener(this.map_, "bounds_changed", function() {
            return me.panMap.apply(me);
        });

    this.setMap(this.map_);
}
*//* InfoBox extends GOverlay class from the Google Maps API *//*
InfoBox.prototype = new google.maps.OverlayView();
*//* Creates the DIV representing this InfoBox *//*
InfoBox.prototype.remove = function() {
    if (this.div_) {
        this.div_.parentNode.removeChild(this.div_);
        this.div_ = null;
    }
};
*//* Redraw the Bar based on the current projection and zoom level *//*
InfoBox.prototype.draw = function() {
    this.createElement();
    if (!this.div_) return;
    var pixPosition = this.getProjection().fromLatLngToDivPixel(this.latlng_);
    if (!pixPosition) return;
    this.div_.style.width = this.width_ + "px";
    this.div_.style.left = (pixPosition.x + this.offsetHorizontal_) + "px";
    this.div_.style.height = this.height_ + "px";
    this.div_.style.top = (pixPosition.y + this.offsetVertical_) + "px";
    this.div_.style.display = 'block';
};

InfoBox.prototype.createElement = function() {
    var panes = this.getPanes();
    var div = this.div_;
    if (!div) {
        div = this.div_ = document.createElement("div");
        div.setAttribute("class", "infoMap");

        div.style.background = "#fff";//"url('http://gmaps-samples.googlecode.com/svn/trunk/images/blueinfowindow.gif')";

        var contentDiv = document.createElement("div");
        contentDiv.setAttribute("class", "infoMapInner");
        contentDiv.style.padding = "30px";
        contentDiv.innerHTML = "<b>Hello World!</b>";

        var topDiv = document.createElement("div");
        topDiv.style.textAlign = "right";
        var closeImg = document.createElement("img");
        closeImg.style.width = "32px";
        closeImg.style.height = "32px";
        closeImg.style.cursor = "pointer";
        closeImg.src = ""; //http://gmaps-samples.googlecode.com/svn/trunk/images/closebigger.gif";
        topDiv.appendChild(closeImg);

        function removeInfoBox(ib) {
            return function() {
                ib.setMap(null);
            };
        }

        google.maps.event.addDomListener(closeImg, 'click', removeInfoBox(this));

        div.appendChild(topDiv);
        div.appendChild(contentDiv);
        div.style.display = 'none';
        panes.floatPane.appendChild(div);
        this.panMap();
    } else if (div.parentNode != panes.floatPane) {
        div.parentNode.removeChild(div);
        panes.floatPane.appendChild(div);
    }
}
*//* Pan the map to fit the InfoBox. *//*
InfoBox.prototype.panMap = function() {
    var map = this.map_;
    var bounds = map.getBounds();
    if (!bounds) return;

    var position = this.latlng_;

    var iwWidth = this.width_;
    var iwHeight = this.height_;

    var iwOffsetX = this.offsetHorizontal_;
    var iwOffsetY = this.offsetVertical_;

    var padX = 40;
    var padY = 40;

    var mapDiv = map.getDiv();
    var mapWidth = mapDiv.offsetWidth;
    var mapHeight = mapDiv.offsetHeight;
    var boundsSpan = bounds.toSpan();
    var longSpan = boundsSpan.lng();
    var latSpan = boundsSpan.lat();
    var degPixelX = longSpan / mapWidth;
    var degPixelY = latSpan / mapHeight;

    var mapWestLng = bounds.getSouthWest().lng();
    var mapEastLng = bounds.getNorthEast().lng();
    var mapNorthLat = bounds.getNorthEast().lat();
    var mapSouthLat = bounds.getSouthWest().lat();

    var iwWestLng = position.lng() + (iwOffsetX - padX) * degPixelX;
    var iwEastLng = position.lng() + (iwOffsetX + iwWidth + padX) * degPixelX;
    var iwNorthLat = position.lat() - (iwOffsetY - padY) * degPixelY;
    var iwSouthLat = position.lat() - (iwOffsetY + iwHeight + padY) * degPixelY;

    var shiftLng =
        (iwWestLng < mapWestLng ? mapWestLng - iwWestLng : 0) +
            (iwEastLng > mapEastLng ? mapEastLng - iwEastLng : 0);
    var shiftLat =
        (iwNorthLat > mapNorthLat ? mapNorthLat - iwNorthLat : 0) +
            (iwSouthLat < mapSouthLat ? mapSouthLat - iwSouthLat : 0);

    var center = map.getCenter();

    var centerX = center.lng() - shiftLng;
    var centerY = center.lat() - shiftLat;

    map.setCenter(new google.maps.LatLng(centerY, centerX));

    google.maps.event.removeListener(this.boundsChangedListener_);
    this.boundsChangedListener_ = null;
};*/

/**
 *  Zebra_DatePicker
 *
 *  Zebra_DatePicker is a small, compact and highly configurable date picker plugin for jQuery
 *
 *  Visit {@link http://stefangabos.ro/jquery/zebra-datepicker/} for more information.
 *
 *  For more resources visit {@link http://stefangabos.ro/}
 *
 *  @author     Stefan Gabos <contact@stefangabos.ro>
 *  @version    1.5 (last revision: September 30, 2012)
 *  @copyright  (c) 2011 - 2012 Stefan Gabos
 *  @license    http://www.gnu.org/licenses/lgpl-3.0.txt GNU LESSER GENERAL PUBLIC LICENSE
 *  @package    Zebra_DatePicker
 */
(function(b){b.Zebra_DatePicker=function(S,F){var fa={always_show_clear:!1,always_visible:!1,days:"Sunday Monday Tuesday Wednesday Thursday Friday Saturday".split(" "),direction:0,disabled_dates:!1,first_day_of_week:1,format:"Y-m-d",inside:!0,lang_clear_date:"Clear",months:"January February March April May June July August September October November December".split(" "),offset:[20,-5],pair:!1,readonly_element:!0,show_week_number:!1,start_date:!1,view:"days",weekend_days:[0,6],onSelect:null,onChange:null}, p,m,w,y,z,D,E,G,T,N,V,n,r,x,q,k,O,H,I,U,P,s,t,Q,J,L,Y,Z,$,A,a=this;a.settings={};var u=b(S),ca=function(c){c||(a.settings=b.extend({},fa,F));a.settings.readonly_element&&u.attr("readonly","readonly");var d={days:["d","j"],months:["F","m","M","n","t"],years:["o","Y","y"]},h=!1,f=!1,i=!1;for(type in d)b.each(d[type],function(b,c){-1<a.settings.format.indexOf(c)&&("days"==type?h=!0:"months"==type?f=!0:"years"==type&&(i=!0))});A=h&&f&&i?["years","months","days"]:!h&&f&&i?["years","months"]:!h&&!f&&i? ["years"]:["years","months","days"];-1==b.inArray(a.settings.view,A)&&(a.settings.view=A[A.length-1]);var d=new Date,g=!a.settings.reference_date?u.data("zdp_reference_date")?u.data("zdp_reference_date"):d:a.settings.reference_date,e,j;t=s=void 0;n=g.getMonth();T=d.getMonth();r=g.getFullYear();N=d.getFullYear();x=g.getDate();V=d.getDate();if(!0===a.settings.direction)s=g;else if(!1===a.settings.direction)t=g,L=t.getMonth(),J=t.getFullYear(),Q=t.getDate();else if(!b.isArray(a.settings.direction)&& M(a.settings.direction)&&0<l(a.settings.direction)||b.isArray(a.settings.direction)&&(!0===a.settings.direction[0]||M(a.settings.direction[0])&&0<a.settings.direction[0]||(e=R(a.settings.direction[0])))&&(!1===a.settings.direction[1]||M(a.settings.direction[1])&&0<=a.settings.direction[1]||(j=R(a.settings.direction[1]))))s=e?e:new Date(r,n,x+(!b.isArray(a.settings.direction)?l(a.settings.direction):l(!0===a.settings.direction[0]?0:a.settings.direction[0]))),n=s.getMonth(),r=s.getFullYear(),x=s.getDate(), j&&+j>+s?t=j:!j&&(!1!==a.settings.direction[1]&&b.isArray(a.settings.direction))&&(t=new Date(r,n,x+l(a.settings.direction[1]))),t&&(L=t.getMonth(),J=t.getFullYear(),Q=t.getDate());else if(!b.isArray(a.settings.direction)&&M(a.settings.direction)&&0>l(a.settings.direction)||b.isArray(a.settings.direction)&&(!1===a.settings.direction[0]||M(a.settings.direction[0])&&0>a.settings.direction[0])&&(M(a.settings.direction[1])&&0<=a.settings.direction[1]||(e=R(a.settings.direction[1]))))t=new Date(r,n,x+ (!b.isArray(a.settings.direction)?l(a.settings.direction):l(!1===a.settings.direction[0]?0:a.settings.direction[0]))),L=t.getMonth(),J=t.getFullYear(),Q=t.getDate(),e&&+e<+t?s=e:!e&&b.isArray(a.settings.direction)&&(s=new Date(J,L,Q-l(a.settings.direction[1]))),s&&(n=s.getMonth(),r=s.getFullYear(),x=s.getDate());if(s&&B(r,n,x)){for(;B(r);)s?r++:r--,n=0;for(;B(r,n);)s?n++:n--,11<n?(r++,n=0):0>n&&(r--,n=0),x=1;for(;B(r,n,x);)s?x++:x--;d=new Date(r,n,x);r=d.getFullYear();n=d.getMonth();x=d.getDate()}U= [];b.isArray(a.settings.disabled_dates)&&0<a.settings.disabled_dates.length&&b.each(a.settings.disabled_dates,function(){for(var a=this.split(" "),c=0;4>c;c++){a[c]||(a[c]="*");a[c]=-1<a[c].indexOf(",")?a[c].split(","):Array(a[c]);for(var d=0;d<a[c].length;d++)if(-1<a[c][d].indexOf("-")){var e=a[c][d].match(/^([0-9]+)\-([0-9]+)/);if(null!=e){for(var f=l(e[1]);f<=l(e[2]);f++)-1==b.inArray(f,a[c])&&a[c].push(f+"");a[c].splice(d,1)}}for(d=0;d<a[c].length;d++)a[c][d]=isNaN(l(a[c][d]))?a[c][d]:l(a[c][d])}U.push(a)}); (e=R(u.val()||(a.settings.start_date?a.settings.start_date:"")))&&B(e.getFullYear(),e.getMonth(),e.getDate())&&u.val("");aa(e);if(!a.settings.always_visible){c||(e='<button type="button" class="Zebra_DatePicker_Icon'+("disabled"==u.attr("disabled")?" Zebra_DatePicker_Icon_Disabled":"")+'">Pick a date</button>',w=b(e),a.icon=w,(a.settings.readonly_element?w.add(u):w).bind("click",function(c){c.preventDefault();u.attr("disabled")||("none"!=m.css("display")?a.hide():a.show())}),w.insertAfter(S));a.settings.inside&& w.addClass("Zebra_DatePicker_Icon_Inside");e=u.position();j=u.outerHeight(!1);var d=parseInt(u.css("marginTop"),10)||0,g=u.outerWidth(!1),v=parseInt(u.css("marginLeft"),10)||0,C=w.outerWidth(!0),ba=w.outerHeight(!0);a.settings.inside?w.css({left:e.left+v+g-C,top:e.top+d+(j-ba)/2}):w.css({left:e.left+g,top:e.top+(j-ba)/2})}void 0!=w&&(u.is(":visible")?w.css("display","block"):w.css("display","none"));c||(e='<div class="Zebra_DatePicker"><table class="dp_header"><tr><td class="dp_previous">&laquo;</td><td class="dp_caption">&nbsp;</td><td class="dp_next">&raquo;</td></tr></table><table class="dp_daypicker"></table><table class="dp_monthpicker"></table><table class="dp_yearpicker"></table><table class="dp_footer"><tr><td>'+ a.settings.lang_clear_date+"</td></tr></table></div>",m=b(e),a.datepicker=m,y=b("table.dp_header",m),z=b("table.dp_daypicker",m),D=b("table.dp_monthpicker",m),E=b("table.dp_yearpicker",m),G=b("table.dp_footer",m),a.settings.always_visible?u.attr("disabled")||(a.settings.always_visible.append(m),a.show()):b("body").append(m),m.delegate("td:not(.dp_disabled, .dp_weekend_disabled, .dp_not_in_month, .dp_blocked, .dp_week_number)","mouseover",function(){b(this).addClass("dp_hover")}).delegate("td:not(.dp_disabled, .dp_weekend_disabled, .dp_not_in_month, .dp_blocked, .dp_week_number)", "mouseout",function(){b(this).removeClass("dp_hover")}),c=b("td",y),b.browser.mozilla?c.css("MozUserSelect","none"):b.browser.msie?c.bind("selectstart",function(){return!1}):c.mousedown(function(){return!1}),b(".dp_previous",y).bind("click",function(){b(this).hasClass("dp_blocked")||("months"==p?k--:"years"==p?k-=12:0>--q&&(q=11,k--),K())}),b(".dp_caption",y).bind("click",function(){p="days"==p?-1<b.inArray("months",A)?"months":-1<b.inArray("years",A)?"years":"days":"months"==p?-1<b.inArray("years", A)?"years":-1<b.inArray("days",A)?"days":"months":-1<b.inArray("days",A)?"days":-1<b.inArray("months",A)?"months":"years";K()}),b(".dp_next",y).bind("click",function(){b(this).hasClass("dp_blocked")||("months"==p?k++:"years"==p?k+=12:12==++q&&(q=0,k++),K())}),z.delegate("td:not(.dp_disabled, .dp_weekend_disabled, .dp_not_in_month, .dp_week_number)","click",function(){W(k,q,l(b(this).html()),"days",b(this))}),D.delegate("td:not(.dp_disabled)","click",function(){var c=b(this).attr("class").match(/dp\_month\_([0-9]+)/); q=l(c[1]);-1==b.inArray("days",A)?W(k,q,1,"months",b(this)):(p="days",a.settings.always_visible&&u.val(""),K())}),E.delegate("td:not(.dp_disabled)","click",function(){k=l(b(this).html());-1==b.inArray("months",A)?W(k,1,1,"years",b(this)):(p="months",a.settings.always_visible&&u.val(""),K())}),b("td",G).bind("click",function(c){c.preventDefault();u.val("");a.settings.always_visible||(k=q=I=H=O=null,G.css("display","none"));a.hide()}),a.settings.always_visible||b(document).bind({mousedown:a._mousedown, keyup:a._keyup}),K())};a.hide=function(){a.settings.always_visible||(da("hide"),m.css("display","none"))};a.show=function(){p=a.settings.view;var c=R(u.val()||(a.settings.start_date?a.settings.start_date:""));c?(H=c.getMonth(),q=c.getMonth(),I=c.getFullYear(),k=c.getFullYear(),O=c.getDate(),B(I,H,O)&&(u.val(""),q=n,k=r)):(q=n,k=r);K();if(a.settings.always_visible)m.css("display","block");else{var c=m.outerWidth(),d=m.outerHeight(),h=w.offset().left+a.settings.offset[0],f=w.offset().top-d+a.settings.offset[1], i=b(window).width(),g=b(window).height(),e=b(window).scrollTop(),j=b(window).scrollLeft();h+c>j+i&&(h=j+i-c);h<j&&(h=j);f+d>e+g&&(f=e+g-d);f<e&&(f=e);m.css({left:h,top:f});m.fadeIn(b.browser.msie&&b.browser.version.match(/^[6-8]/)?0:150,"linear");da()}};a.update=function(c){a.original_direction&&(a.original_direction=a.direction);a.settings=b.extend(a.settings,c);ca(!0)};var R=function(c){c+="";if(""!=b.trim(c)){var d;d=a.settings.format.replace(/\s/g,"").replace(/([-.*+?^${}()|[\]\/\\])/g,"\\$1"); for(var h="dDjlNSwFmMnYy".split(""),f=[],i=[],g=0;g<h.length;g++)-1<(position=d.indexOf(h[g]))&&f.push({character:h[g],position:position});f.sort(function(a,c){return a.position-c.position});b.each(f,function(a,c){switch(c.character){case "d":i.push("0[1-9]|[12][0-9]|3[01]");break;case "D":i.push("[a-z]{3}");break;case "j":i.push("[1-9]|[12][0-9]|3[01]");break;case "l":i.push("[a-z]+");break;case "N":i.push("[1-7]");break;case "S":i.push("st|nd|rd|th");break;case "w":i.push("[0-6]");break;case "F":i.push("[a-z]+"); break;case "m":i.push("0[1-9]|1[012]+");break;case "M":i.push("[a-z]{3}");break;case "n":i.push("[1-9]|1[012]");break;case "Y":i.push("[0-9]{4}");break;case "y":i.push("[0-9]{2}")}});if(i.length&&(f.reverse(),b.each(f,function(a,c){d=d.replace(c.character,"("+i[i.length-a-1]+")")}),i=RegExp("^"+d+"$","ig"),segments=i.exec(c.replace(/\s/g,"")))){var e,j,k,m="Sunday Monday Tuesday Wednesday Thursday Friday Saturday".split(" "),q="January February March April May June July August September October November December".split(" "), p,n=!0;f.reverse();b.each(f,function(c,d){if(!n)return!0;switch(d.character){case "m":case "n":j=l(segments[c+1]);break;case "d":case "j":e=l(segments[c+1]);break;case "D":case "l":case "F":case "M":p="D"==d.character||"l"==d.character?a.settings.days:a.settings.months;n=!1;b.each(p,function(a,b){if(n)return!0;if(segments[c+1].toLowerCase()==b.substring(0,"D"==d.character||"M"==d.character?3:b.length).toLowerCase()){switch(d.character){case "D":segments[c+1]=m[a].substring(0,3);break;case "l":segments[c+ 1]=m[a];break;case "F":segments[c+1]=q[a];j=a+1;break;case "M":segments[c+1]=q[a].substring(0,3),j=a+1}n=!0}});break;case "Y":k=l(segments[c+1]);break;case "y":k="19"+l(segments[c+1])}});if(n&&(c=new Date(k,(j||1)-1,e||1),c.getFullYear()==k&&c.getDate()==(e||1)&&c.getMonth()==(j||1)-1))return c}return!1}},ea=function(){var c=(new Date(k,q+1,0)).getDate(),d=(new Date(k,q,1)).getDay(),h=(new Date(k,q,0)).getDate(),d=d-a.settings.first_day_of_week,d=0>d?7+d:d;X(a.settings.months[q]+", "+k);var f="<tr>"; a.settings.show_week_number&&(f+="<th>"+a.settings.show_week_number+"</th>");for(var i=0;7>i;i++)f+="<th>"+a.settings.days[(a.settings.first_day_of_week+i)%7].substr(0,2)+"</th>";f+="</tr><tr>";for(i=0;42>i;i++){0<i&&0==i%7&&(f+="</tr><tr>");if(0==i%7&&a.settings.show_week_number){var g=new Date(k,q,i-d+1),e=new Date(k,0,1),j=e.getDay()-a.settings.first_day_of_week,e=Math.floor((g.getTime()-e.getTime()-6E4*(g.getTimezoneOffset()-e.getTimezoneOffset()))/864E5)+1,j=0<=j?j:j+7;4>j?(j=Math.floor((e+j- 1)/7)+1,52<j+1&&(g.getFullYear(),g=nYear.getDay()-a.settings.first_day_of_week,g=0<=g?g:g+7,j=4>g?1:53)):j=Math.floor((e+j-1)/7);f+='<td class="dp_week_number">'+j+"</td>"}g=i-d+1;i<d?f+='<td class="dp_not_in_month">'+(h-d+i+1)+"</td>":g>c?f+='<td class="dp_not_in_month">'+(g-c)+"</td>":(j=(a.settings.first_day_of_week+i)%7,e="",B(k,q,g)?(e=-1<b.inArray(j,a.settings.weekend_days)?"dp_weekend_disabled":e+" dp_disabled",q==T&&(k==N&&V==g)&&(e+=" dp_disabled_current")):(-1<b.inArray(j,a.settings.weekend_days)&& (e="dp_weekend"),q==H&&(k==I&&O==g)&&(e+=" dp_selected"),q==T&&(k==N&&V==g)&&(e+=" dp_current")),f+="<td"+(""!=e?' class="'+b.trim(e)+'"':"")+">"+v(g,2)+"</td>")}z.html(b(f+"</tr>"));a.settings.always_visible&&(Y=b("td:not(.dp_disabled, .dp_weekend_disabled, .dp_not_in_month, .dp_blocked, .dp_week_number)",z));z.css("display","")},da=function(a){if(b.browser.msie&&b.browser.version.match(/^6/)){if(!P){var d=l(m.css("zIndex"))-1;P=jQuery("<iframe>",{src:'javascript:document.write("")',scrolling:"no", frameborder:0,allowtransparency:"true",css:{zIndex:d,position:"absolute",top:-1E3,left:-1E3,width:m.outerWidth(),height:m.outerHeight(),filter:"progid:DXImageTransform.Microsoft.Alpha(opacity=0)",display:"none"}});b("body").append(P)}switch(a){case "hide":P.css("display","none");break;default:a=m.offset(),P.css({top:a.top,left:a.left,display:"block"})}}},B=function(c,d,h){if(b.isArray(a.settings.direction)||0!==l(a.settings.direction)){var f=l(C(c,"undefined"!=typeof d?v(d,2):"","undefined"!=typeof h? v(h,2):"")),i=(f+"").length;if(8==i&&("undefined"!=typeof s&&f<l(C(r,v(n,2),v(x,2)))||"undefined"!=typeof t&&f>l(C(J,v(L,2),v(Q,2))))||6==i&&("undefined"!=typeof s&&f<l(C(r,v(n,2)))||"undefined"!=typeof t&&f>l(C(J,v(L,2))))||4==i&&("undefined"!=typeof s&&f<r||"undefined"!=typeof t&&f>J))return!0}if(U){"undefined"!=typeof d&&(d+=1);var g=!1;b.each(U,function(){if(!g&&(-1<b.inArray(c,this[2])||-1<b.inArray("*",this[2])))if("undefined"!=typeof d&&-1<b.inArray(d,this[1])||-1<b.inArray("*",this[1]))if("undefined"!= typeof h&&-1<b.inArray(h,this[0])||-1<b.inArray("*",this[0])){if("*"==this[3])return g=!0;var a=(new Date(c,d-1,h)).getDay();if(-1<b.inArray(a,this[3]))return g=!0}});if(g)return!0}return!1},M=function(a){return(a+"").match(/^\-?[0-9]+$/)?!0:!1},X=function(c){b(".dp_caption",y).html(c);if(b.isArray(a.settings.direction)||0!==l(a.settings.direction)){var c=k,d=q,h,f;"days"==p?(f=0>d-1?C(c-1,"11"):C(c,v(d-1,2)),h=11<d+1?C(c+1,"00"):C(c,v(d+1,2))):"months"==p?(f=c-1,h=c+1):"years"==p&&(f=c-7,h=c+7); B(f)?(b(".dp_previous",y).addClass("dp_blocked"),b(".dp_previous",y).removeClass("dp_hover")):b(".dp_previous",y).removeClass("dp_blocked");B(h)?(b(".dp_next",y).addClass("dp_blocked"),b(".dp_next",y).removeClass("dp_hover")):b(".dp_next",y).removeClass("dp_blocked")}},K=function(){if(""==z.text()||"days"==p){if(""==z.text()){a.settings.always_visible||m.css("left",-1E3);m.css({display:"block"});ea();var c=z.outerWidth(),d=z.outerHeight();y.css("width",c);D.css({width:c,height:d});E.css({width:c, height:d});G.css("width",c);m.css({display:"none"})}else ea();D.css("display","none");E.css("display","none")}else if("months"==p){X(k);c="<tr>";for(d=0;12>d;d++){0<d&&0==d%3&&(c+="</tr><tr>");var h="dp_month_"+d;B(k,d)?h+=" dp_disabled":!1!==H&&H==d?h+=" dp_selected":T==d&&N==k&&(h+=" dp_current");c+='<td class="'+b.trim(h)+'">'+a.settings.months[d].substr(0,3)+"</td>"}D.html(b(c+"</tr>"));a.settings.always_visible&&(Z=b("td:not(.dp_disabled)",D));D.css("display","");z.css("display","none");E.css("display", "none")}else if("years"==p){X(k-7+" - "+(k+4));c="<tr>";for(d=0;12>d;d++)0<d&&0==d%3&&(c+="</tr><tr>"),h="",B(k-7+d)?h+=" dp_disabled":I&&I==k-7+d?h+=" dp_selected":N==k-7+d&&(h+=" dp_current"),c+="<td"+(""!=b.trim(h)?' class="'+b.trim(h)+'"':"")+">"+(k-7+d)+"</td>";E.html(b(c+"</tr>"));a.settings.always_visible&&($=b("td:not(.dp_disabled)",E));E.css("display","");z.css("display","none");D.css("display","none")}a.settings.onChange&&("function"==typeof a.settings.onChange&&void 0!=p)&&(c="days"==p? z.find("td:not(.dp_disabled, .dp_weekend_disabled, .dp_not_in_month, .dp_blocked)"):"months"==p?D.find("td:not(.dp_disabled, .dp_weekend_disabled, .dp_not_in_month, .dp_blocked)"):E.find("td:not(.dp_disabled, .dp_weekend_disabled, .dp_not_in_month, .dp_blocked)"),c.each(function(){if("days"==p)b(this).data("date",k+"-"+v(q+1,2)+"-"+v(l(b(this).text()),2));else if("months"==p){var a=b(this).attr("class").match(/dp\_month\_([0-9]+)/);b(this).data("date",k+"-"+v(l(a[1])+1,2))}else b(this).data("date", l(b(this).text()))}),a.settings.onChange(p,c));(a.settings.always_show_clear||a.settings.always_visible||""!=u.val())&&"block"!=G.css("display")?G.css("display",""):G.css("display","none")},W=function(c,b,h,f,i){var g=new Date(c,b,h),f="days"==f?Y:"months"==f?Z:$,e;e="";for(var j=g.getDate(),l=g.getDay(),m=a.settings.days[l],n=g.getMonth()+1,p=a.settings.months[n-1],r=g.getFullYear()+"",s=0;s<a.settings.format.length;s++){var t=a.settings.format.charAt(s);switch(t){case "y":r=r.substr(2);case "Y":e+= r;break;case "m":n=v(n,2);case "n":e+=n;break;case "M":p=p.substr(0,3);case "F":e+=p;break;case "d":j=v(j,2);case "j":e+=j;break;case "D":m=m.substr(0,3);case "l":e+=m;break;case "N":l++;case "w":e+=l;break;case "S":e=1==j%10&&"11"!=j?e+"st":2==j%10&&"12"!=j?e+"nd":3==j%10&&"13"!=j?e+"rd":e+"th";break;default:e+=t}}u.val(e);a.settings.always_visible&&(H=g.getMonth(),q=g.getMonth(),I=g.getFullYear(),k=g.getFullYear(),O=g.getDate(),f.removeClass("dp_selected"),i.addClass("dp_selected"));a.hide();aa(g); if(a.settings.onSelect&&"function"==typeof a.settings.onSelect)a.settings.onSelect(e,c+"-"+v(b+1,2)+"-"+v(h,2),new Date(c,b,h))},C=function(){for(var a="",b=0;b<arguments.length;b++)a+=arguments[b]+"";return a},v=function(a,b){for(a+="";a.length<b;)a="0"+a;return a},l=function(a){return parseInt(a,10)},aa=function(b){if(a.settings.pair)if(!a.settings.pair.data||!a.settings.pair.data("Zebra_DatePicker"))a.settings.pair.data("zdp_reference_date",b);else{var d=a.settings.pair.data("Zebra_DatePicker"); d.update({reference_date:b});d.settings.always_visible&&d.show()}};a._keyup=function(b){("block"==m.css("display")||27==b.which)&&a.hide();return!0};a._mousedown=function(c){if("block"==m.css("display")){if(b(c.target).get(0)===w.get(0))return!0;0==b(c.target).parents().filter(".Zebra_DatePicker").length&&a.hide()}return!0};ca()};b.fn.Zebra_DatePicker=function(S){return this.each(function(){if(void 0!=b(this).data("Zebra_DatePicker")){var F=b(this).data("Zebra_DatePicker");F.icon.remove();F.datepicker.remove(); b(document).unbind("keyup",F._keyup);b(document).unbind("mousedown",F._mousedown)}F=new b.Zebra_DatePicker(this,S);b(this).data("Zebra_DatePicker",F)})}})(jQuery);

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
            // declaration de l'objet
            var $mul = $(this);

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
            $mul.children('option').each(function(){
                addMulItem(this, $newMul);
            });
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


/**
 *
 * Date picker
 * Author: Stefan Petre www.eyecon.ro
 *
 * Dual licensed under the MIT and GPL licenses
 *
 */
/*
 var days = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"],
 months = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
 daysShort = ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim"],
 daysMin = ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa", "Di"],
 monthsShort = ["Jan", "Fév", "Mar", "Avr", "Mai", "Jui", "Jui", "Aoû", "Sepe", "Oct", "Nov", "Déc"],
 console.log(daysShort);
 console.log(daysMin);
 console.log(monthsShort);
 */

(function ($) {
    var DatePicker = function () {
        var	ids = {},
            views = {
                years: 'datepickerViewYears',
                moths: 'datepickerViewMonths',
                days: 'datepickerViewDays'
            },
            tpl = {
                wrapper: '<div class="datepicker"><div class="datepickerBorderT" /><div class="datepickerBorderB" /><div class="datepickerBorderL" /><div class="datepickerBorderR" /><div class="datepickerBorderTL" /><div class="datepickerBorderTR" /><div class="datepickerBorderBL" /><div class="datepickerBorderBR" /><div class="datepickerContainer"><table cellspacing="0" cellpadding="0"><tbody><tr></tr></tbody></table></div></div>',
                head: [
                    '<td>',
                    '<table cellspacing="0" cellpadding="0">',
                    '<thead>',
                    '<tr>',
                    '<th class="datepickerGoPrev"><a href="#"><span><%=prev%></span></a></th>',
                    '<th colspan="6" class="datepickerMonth"><a href="#"><span></span></a></th>',
                    '<th class="datepickerGoNext"><a href="#"><span><%=next%></span></a></th>',
                    '</tr>',
                    '<tr class="datepickerDoW">',
                    '<th><span><%=week%></span></th>',
                    '<th><span><%=day1%></span></th>',
                    '<th><span><%=day2%></span></th>',
                    '<th><span><%=day3%></span></th>',
                    '<th><span><%=day4%></span></th>',
                    '<th><span><%=day5%></span></th>',
                    '<th><span><%=day6%></span></th>',
                    '<th><span><%=day7%></span></th>',
                    '</tr>',
                    '</thead>',
                    '</table></td>'
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
                    days: ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"],
                    daysShort: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim"],
                    daysMin: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa", "Di"],
                    months: ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"],
                    monthsShort: ["janv", "févr", "mars", "avr.", "mai", "juin", "juil", "août", "sept", "oct", "nov", "déc"],
                    weekMin: 'wk'
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
                    if (el.hasClass('datepickerDisabled')) {
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
                        if (parentEl.hasClass('datepickerWeek') && options.mode == 'range' && !parentEl.next().hasClass('datepickerDisabled')) {
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
                    } else if (parentEl.is('td') && !parentEl.hasClass('datepickerDisabled')) {
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
