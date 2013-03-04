$(document).ready(function() {

    $.event.props.push("dataTransfer");

    var medias = [];

    $(".portfolio-popin-btn").bind('click', function(e) {
        e.preventDefault();

        var $this = $(this);
        if ($this.attr('href').indexOf('#') == 0) {
            $($this.attr('href')).modal('open');
        }
        else {
            $.get($this.attr('href'), function(data) {
                $('#portfolioPopin').remove();
                var $data = $(data);

                // add data attribute field id on modal
                $data.attr('data-field-id', $this.parent('.field-media').children('input').attr('id'));

                // set class on the image to update
                $('.media-to-update').removeClass('media-to-update');
                $this.children('img').addClass('media-to-update');

                // open modal
                $data.modal();
            });
        }
    });

    $('body').delegate("#dragContainer", 'dragenter dragexit dragover', function (e) {
        e.stopPropagation();
        e.preventDefault();
    });

    $('body').delegate("#dragContainer", 'drop', function (e) {
        e.stopPropagation();
        e.preventDefault();

        var files = e.dataTransfer.files;

        $.each(files, function(index, file) {
            var fileReader = new FileReader();

            fileReader.onload = (function(file) {
                return function(e) {
                    var image     = this.result;
                    var mediaData = {name: file.name, value: image};

                    medias.push(mediaData);

                    var data = "data:image/png;base64,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";
                    if (strpos(file.type, 'image') !== false) {
                        data = image;
                    }

                    $.post(defaultPortfolioRoute + 'upload', mediaData, function(json) {
                        jsonObject = JSON.parse(json);
                        $("#droppedFiles").prepend(jsonObject.html);
                    });

                };
            })(files[index]);

            fileReader.readAsDataURL(file);
        });

        $("#droppedFiles").fadeIn();
    });

    $('body').delegate('.media-line .toggle', 'click', function(e) {
        e.stopPropagation();
        e.preventDefault();

        var $this   = $(this);
        var $parent = $this.parent('td').parent('tr');

        $('.toggle', $this.parent('td')).toggle();

        if ($this.hasClass('toggle-on')) {
            $.get($this.attr('href'), function (html) {
                $parent.after(html);
            });
        }
        else if ($this.hasClass('toggle-off')) {
            $('#' + $parent.data('edit')).remove();
        }

        return false;
    });

    $('body').delegate('.portfolio-form', 'submit', function(e) {
        e.stopPropagation();
        e.preventDefault();
        var $this = $(this);

        $.post($this.attr('action'), $this.serialize(), function (json) {
            var jsonObject = JSON.parse(json);
            var $field     = $("#" + $('#portfolioPopin').data('field-id'));
            var $link      = $field.parent('.field-media').children('a');

            // update link if added a new media
            if ($link.children('img').length == 0) {
                $link.attr('href', $link.attr('href') + '/' + jsonObject.id);
            }

            // update media preview
            $field.attr('value', jsonObject.id);
            $link.html('<img class="crud-column-media" src="'+templatePath + jsonObject.object.File+'" />').removeClass('btn');

            // hide modal box
            $('#portfolioPopin').modal('hide');
        });

        return false;
    });

    $('body').delegate('.portfolio-tag-btn', 'click', function (e) {
        e.stopPropagation();
        e.preventDefault();

        var $this = $(this);

        $.post($this.attr('href'), {'tag': $('#' + $this.data('field-id')).val()}, function (json) {
            var jsonObject = JSON.parse(json);

            $('#' + $this.data('field-id')).val('');
            $('#PortfolioMedia_portfolio_tags').append(jsonObject.html);
        });

        return false;
    });
});
