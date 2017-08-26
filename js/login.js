$(document).ready(function() {


    $('#opt-reg').click(function() {
        $('#form-reg').show();
        $('#form-log').hide();
        $('#form-esq').hide();
    });
    $('#opt-log').click(function() {
        $('#form-reg').hide();
        $('#form-log').show();
        $('#form-esq').hide();

    });

    $('#bot-esq').click(function() {
        $('#form-esq').toggle();
    });

});
