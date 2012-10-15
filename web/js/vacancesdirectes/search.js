$(function() {
    $('#AchatLineaire_pays').bind('change', function() {
        var code = $(this).val();

        $.getJSON(getRegionsByPays + '?code=' + code, function(choices) {
            var select = $('#AchatLineaire_region');

            reloadSearchSelect(select, choices, "Région");
            select.resetSS();
        });

        $.getJSON(getCampingsByPays + '?code=' + code, function(choices) {
            reloadSearchSelect($('#AchatLineaire_campings'), choices);
        });
    });

    $('#AchatLineaire_region').bind('change', function() {
        var code = $(this).val();

        $.getJSON(getCampingsByRegion + '?code=' + code, function(choices) {
            reloadSearchSelect($('#AchatLineaire_campings'), choices);
        });
    });

    function reloadSearchSelect(select, choices, empty) {
        var selectedItem = select.val();
        var options = '';

        if (empty != undefined)
        {
            options = '<option value="">' + empty + '</option>'
        }

        $.each(choices, function() {
            if (selectedItem == this.id)
            {
                options += '<option selected="selected" value="' + this.code + '">' + this.name + '</option>';
            }
            else
            {
                options += '<option value="' + this.code + '">' + this.name + '</option>';
            }
        });

        select.children().remove();
        select.html(options);
    }
});
