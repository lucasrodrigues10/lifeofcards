$(document).ready(function () {
    $("#reg-email").on("change paste keyup", function () {
        $input = $(this).val()
        $.ajax({
            url: "php/email_check.php",
            type: 'post',
            data: {
                email: $("#reg-email").val()
            }
        })
            .done(function (msg) {
                if (msg == "valido") {
                    $("#email-val").show();
                    $("#email-inval").hide();
                } else if (msg == "invalido") {
                    $("#email-val").hide();
                    $("#email-inval").show();
                } else if (msg == "" || msg.empty()) {
                    $("#email-val").show();
                    $("#email-inval").show();
                }

            })
            .fail(function (jqXHR, textStatus, msg) {
                alert("Erro");
            });


    });

    $('#opt-reg').click(function () {
        $('#form-reg').show();
        $('#form-log').hide();
        $('#form-esq').hide();
    });
    $('#opt-log').click(function () {
        $('#form-reg').hide();
        $('#form-log').show();
        $('#form-esq').hide();

    });

    $('#bot-esq').click(function () {
        $('#form-esq').toggle();
    });

})
;
