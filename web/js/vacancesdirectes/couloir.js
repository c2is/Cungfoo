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
            thisMonth = d.getMonth()+1,
            thisDay = d.getDate(),
            fThisMonth = ((''+thisMonth).length<2 ? '0' : '') + thisMonth,
            fThisDay = ((''+thisDay).length<2 ? '0' : '') + thisDay,
            birthdayDate = fThisDay + '/' + fThisMonth + '/' + thisYear;

        console.log(birthdayDate);

        $('#reservation_content_date_creation').DatePicker({
            flat: false,
            format:'d/m/Y',
//            date: $('#inputDate').val(),
            date: '',
            current: birthdayDate,
            calendars: 1,
            starts: 1,
            view: 'years',
//            onBeforeShow: function(){
//                $('#reservation_content_date_creation').DatePickerSetDate($('#reservation_content_date_creation').val(), true);
//            },
            onChange: function(formated, dates){
                console.log(formated)
                if(!isNaN(formated.split('/').join(''))){
                    $('#reservation_content_date_creation').val(formated);
                    $('#reservation_content_date_creation').DatePickerHide();
                }
            }

        });
    }

    // radio buttons
    if($('#reservationContener.detail').length){
        var checked;
        if($('#authentication').length){
            $('.authenticationChoice').click(function(e){
                resize_myframe();
            });
            if(checked != undefined){
                $('#returningCustomerYes').trigger("click");

            }
            else{
                if($('#returningCustomerYes').is(':checked')) {
                    checked = true
                    $('#existingCustomerLayer').show();
                    $('#newCustomerLayer').hide();
                }
                else if($('#returningCustomerNo').is(':checked')) {
                    checked = false;
                    $('#existingCustomerLayer').hide();
                    $('#newCustomerLayer').show();
                }
            }
        }
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
