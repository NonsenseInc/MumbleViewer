(function ($) {
    var isResizing = false;

    function _fillContainingElement(el) {
        var siblingHeight = 0;
        el = $(el);

        if (!$(el).is(':visible'))
            return;

        el.siblings(':visible').each(function () {
            siblingHeight += $(this).height();
        });

        var containerHeight = el.parent().height();

        var newHeight = containerHeight - siblingHeight;
        if (newHeight < 0)
            newHeight = 0;

        var aNumber = 0;
        aNumber = parseInt(el.css('border-top-width'), 10);
        if (!isNaN(aNumber))
            newHeight -= aNumber;
        aNumber = parseInt(el.css('border-bottom-width'), 10);
        if (!isNaN(aNumber))
            newHeight -= aNumber;
        aNumber = parseInt(el.css('margin-top'), 10);
        if (!isNaN(aNumber))
            newHeight -= aNumber;
        aNumber = parseInt(el.css('margin-bottom'), 10);
        if (!isNaN(aNumber))
            newHeight -= aNumber;
        aNumber = parseInt(el.css('padding-top'), 10);
        if (!isNaN(aNumber))
            newHeight -= aNumber;
        aNumber = parseInt(el.css('padding-bottom'), 10);
        if (!isNaN(aNumber))
            newHeight -= aNumber;

        //fire resize() incase there are other handlers.
        //We're already preventing our handler from running again with isResizing.
        el.height(newHeight).resize();
    };

    $.fillContainingElement = function (el) {
        if (isResizing)
            return;
        isResizing = true;

        $(el).not(document).not(window).each(function () {
            _fillContainingElement(this);
        });

        isResizing = false;
    };

    $.fn.fillContainingElement = function () {
        $.fillContainingElement(this);
    };
})(jQuery);