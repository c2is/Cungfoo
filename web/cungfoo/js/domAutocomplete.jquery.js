(function($){
    if(!$.cungfoo){
        $.cungfoo = new Object();
    };

    $.cungfoo.domAutocomplete = function(el, options)
    {
        var $this = this;

        // Access to jQuery and DOM versions of element
        $this.$el = $(el);
        $this.el = el;

        // List autocomplete
        $this.list = $('<ul class="cungfoo-autocomplete"><li>TEST</li></ul>')

        // Add a reverse reference to the DOM object
        $this.$el.data("cungfoo.domAutocomplete", $this);

        $this.init = function()
        {
            $this.options = $.extend($.cungfoo.domAutocomplete.defaultOptions, options);

            // Override contains selecor for insensitive case
            if ($this.options.case == false)
            {
                jQuery.expr[':'].contains = function(a, i, m) {
                    return jQuery(a).text().toUpperCase()
                        .indexOf(m[3].toUpperCase()) >= 0;
                };
            }

            $this.createList();
            $this.bindElement();

            $(document).click(function() {
                $this.list.hide();
            });

            $this.list.click(function(event) {
                event.stopPropagation();
            });
        };

        // Push the list in the dom
        $this.createList = function()
        {
            $this.$el.after($this.list);
        };

        // Bind keyup event
        $this.bindElement = function()
        {
            $this.$el.bind('keyup', function() {
                $this.list.children("li").remove();
                var element = $this.searchElement($(this).val());
                
                if (element.length == 0)
                {
                    $this.list.hide();
                }
                else
                {
                    element.each(function(key, element) {
                        $this.list.append($('<li></li>').append($(element).clone()));

                        if (key >= $this.options.limit -1)
                        {
                            $this.list.append($('<li><a>...</a></li>'));
                            return false;
                        }
                    });

                    $this.list.show();
                }

            });
        };

        // Search element
        $this.searchElement = function(value)
        {
            if (value == '')
            {
                return [];
            }

            var contains = ':contains("' + value + '")';
            var selector = $this.options.datas.replace(/,/g, contains + ', ') + contains;
            return $(selector);
        };

        // Run initializer
        $this.init();
    };

    // Default options
    $.cungfoo.domAutocomplete.defaultOptions = {
        case:   false,
        limit:  10,
        datas:  'a'
    };

    $.fn.cungfoo_domAutocomplete = function(options){
        return this.each(function(){
            (new $.cungfoo.domAutocomplete(this, options));
        });
    };

})(jQuery);