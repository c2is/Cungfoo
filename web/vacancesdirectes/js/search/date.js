var searchDate = function (currentId, urlVilleFormat, urlCampingFormat) {

    var base = this;

    base.init = function() {
        if (currentId)
        {
            base.updateVillesByDestinationId(currentId);
            base.updateCampingsByDestinationId(currentId);
        }

        base.bindDestinationFormElement();
    }

    base.bindDestinationFormElement = function() {
        $('#SearchDate_destination').bind('change', function() {
            base.updateVillesByDestinationId($(this).val());
            base.updateCampingsByDestinationId($(this).val());
        });
    }

    base.updateVillesByDestinationId = function(id) {
        base.updateGeneric(id, "#SearchDate_ville", urlVilleFormat);
    }

    base.updateCampingsByDestinationId = function(id) {
        base.updateGeneric(id, "#SearchDate_camping", urlCampingFormat);
    }

    base.updateGeneric = function(id, selector, urlFormat) {
        var url = urlFormat.replace("id_destination", id);
        $.getJSON(url, function(json) {
            var selectedItem = $(selector).val();
            var options = '<option value=""></option>';
            $.each(json, function() {
                if (selectedItem == this.id)
                {
                    options += '<option selected="selected" value="' + this.id + '">' + this.name + '</option>';
                }
                else
                {
                    options += '<option value="' + this.id + '">' + this.name + '</option>';
                }
            });
            var elements = $(selector);
            elements.children().remove();
            elements.html(options);
        });
    }

    base.init();

    return base;
};