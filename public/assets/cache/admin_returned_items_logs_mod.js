$( document ).ready(function() {
    $('ul.status li a.status').click(function() {
        $('input#the-status').val($(this).attr('status'));

        $(this).parents('form').submit();
    });
});
