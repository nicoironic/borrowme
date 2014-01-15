$( document ).ready(function() {
    $('ul.status li a.status').click(function() {
        $('input#the-status').val($(this).attr('status'));

        $(this).parents('form').submit();
    });
    $('button#search-code-btn').click(function() {
        $(this).parents('form').submit();
    });
    $('input#returned_items_due_date').datepicker({
        dateFormat: 'yy-mm-dd'
    });
});