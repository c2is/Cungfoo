/**-----------------------------------------------------------
    Project: VACANCES DIRECTES CE
    Date :  11/10/12
    Author: C2iS - NCH
    Summary : FRONT FUNCTIONS & INITS RESALYS
-----------------------------------------------------------*/

/* variables */



// DOM Ready
$(function() {
    if(parentExists()){
    resize_myframe();
    }
});

// Gestion du console.log (évite le bug sur ie si la console n'est pas ouverte)
function consoleLog (data) {
    if(window.console && console.log )
        console.log(data);
}

function parentExists() {
    return (parent.location == window.location)? false : true;
}

function resize_myframe() {
    //var height = $('html').height();
    var height = $('body').height();
    height += 50;
    window.parent.document.getElementById('frameResalys').style.height = height + 'px';
    //consoleLog(height);
}
