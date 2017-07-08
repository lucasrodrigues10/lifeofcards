$(document).ready(function() {
    $('#bot-reg').hide();
    $('.form-email').hide();
    $('#opt-reg').click(function() {
        $('#bot-reg').show();
        $('.form-email').show();
        $('#bot-log').hide();
        $('#bot-esq').hide();
    });
    $('#opt-log').click(function() {
        $('#bot-reg').hide();
        $('.form-email').hide();
        $('#bot-log').show();
        $('#bot-esq').show();

    });
});
