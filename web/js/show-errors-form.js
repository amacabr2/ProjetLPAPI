(function ($) {

    $li = $('form fieldset span ul li');
    $li.parent().css({
        'list-style': 'none',
    });
    $li.addClass('alert alert-danger');

})(jQuery);