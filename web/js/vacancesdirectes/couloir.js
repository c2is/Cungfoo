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


    if($('#reservationContener.detail').length){

        // radio buttons
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

        // datepickers
        $(".anOccupant").each(function(index,value){
            var datepickerId = "#" + $(this).find('.control_date').attr('id');
            $(datepickerId).datepicker({
                changeMonth: true,
                changeYear: true
            });
        })
        $('#reservation_content_date_creation_').datepicker({
            changeMonth: true,
            changeYear: true
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
