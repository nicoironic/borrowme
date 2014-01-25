/**
 * Created by NPag-ong on 1/25/14.
 */
$( document ).ready(function() {
    $('ul.mode li a.status').click(function() {
        $('input#mode').val($(this).attr('mode'));

        $(this).parents('form').submit();
    });
});
