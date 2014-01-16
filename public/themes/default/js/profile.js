/**
 * Created with JetBrains PhpStorm.
 * User: user
 * Date: 1/13/14
 * Time: 8:22 PM
 * To change this template use File | Settings | File Templates.
 */
$( document ).ready(function() {
    $('form input').each(function() {
        $(this).prop('disabled', true);
    });
    $('form textarea').each(function() {
        $(this).prop('disabled', true);
    });

    $("button#enable-edit").toggle(function() {
        $('form input').each(function() {
            $(this).prop('disabled', false);
        });
        $('form textarea').each(function() {
            $(this).prop('disabled', false);
        });
    }, function() {
        $('form input').each(function() {
            $(this).prop('disabled', true);
        });
        $('form textarea').each(function() {
            $(this).prop('disabled', true);
        });
    });
});