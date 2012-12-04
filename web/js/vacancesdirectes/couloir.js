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

    // selects
    if($('#newCustomerLayer').length){
        $('#newCustomerLayer').find('select').sSelect({ddMaxHeight: '300px'});
        if($('#authentication').length){
            $('.authenticationChoice').click(function(e){
                resize_myframe();
            });
            $('#returningCustomerYes').trigger("click");
        }
    }
    if($('#reservation').length){
        $('.changeOccupantCount').find('select').sSelect({ddMaxHeight: '300px'});
    }
    if($('#financialContener').length){
        $('#client_due_type').find('select').sSelect({ddMaxHeight: '300px'});
    }
    if($('#option').length){
        $('#option').find('select').sSelect({ddMaxHeight: '300px'});
    }
    if($('#customerAreaContener').length){
        $('#customerAreaContener').find('select').sSelect({ddMaxHeight: '300px'});
    }

    // datepickers
    if($('#datepicker').length){
        var d = new Date(),
            thisYear = d.getFullYear(),
            birthdayYear = thisYear-18;

        $('#datepicker').DatePicker({
            flat: true,
            format:'Y/m/d',
            date: $('#inputDate').val(),
            current: birthdayYear,
            calendars: 1,
            starts: 1,
            view: 'years',
            position: 'bottom',
            onBeforeShow: function(){
                $('#inputDate').DatePickerSetDate($('#inputDate').val(), true);
            },
            onChange: function(formated, dates){
                $('#inputDate').val(formated);
                if ($('#closeOnSelect input').attr('checked')) {
                    $('#inputDate').DatePickerHide();
                }
            }
        });
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
    height += 70;
    window.parent.document.getElementById('frameResalys').style.height = height + 'px';
//    consoleLog(height);
}
