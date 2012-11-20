$(function() {
    $('#SearchDate_destination').bind('change', function() {
        var code = $(this).val();

        $.getJSON(selectVille.byPaysPath + '?code=' + code, function(choices) {
            var select = $('#SearchDate_ville');

            reloadSearchSelect(select, choices, selectVille.emptyValue);
            var display = select.next('div.newListSelected').css('display');
            select.resetSS();
            select.next('div.newListSelected').css('display', display);
        });

        $.getJSON(selectCamping.byPaysPath + '?code=' + code, function(choices) {
            var select = $('#SearchDate_camping');

            reloadSearchSelect(select, choices, selectCamping.emptyValue);
            var display = select.next('div.newListSelected').css('display');
            select.resetSS();
            select.next('div.newListSelected').css('display', display);
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
            if (selectedItem == this.code)
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
