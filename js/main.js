$(document).ready(function () {

    $("#btn-add-amigo").on("click", function () {
        $.ajax({
            url: "php/adicionaAmigo.php",
            type: 'post',
            data: {
                email: $("#input-add-amigo").val()
            }
        })
            .done(function (msg) {
                if (msg == "valido") {
                    alert("Amigo encontrado");
                } else if (msg == "invalido") {
                    alert("Amigo nao encontrado.");
                } else if (msg == "" || msg.empty()) {
                    alert("Erro, tente novamente.");
                }
            })
            .fail(function (jqXHR, textStatus, msg) {
                alert("Erro");
            });


    });


    var vol = 100;

    $('#audio')[0].volume = vol / 100.0;

    audio.volume = vol / 100.0;


    $('#myonoffswitch').on('click', function () {

        if ($('#myonoffswitch').is(':checked')) {

            audio.play();

            audio.currentTime = 0;

        }

        else {

            audio.pause();

            audio.currentTime = 0;

        }

    });

    $('#opt-log').button('toggle');

    $('.btn-home').css('background-color', '#000066');

    $('.nav-pills a').click(function (e) {

        e.preventDefault();

        // $('.nav-pills a').css('background-color','black');
        $('.nav-pills a').addClass('barra');
        $('.nav-pills a').removeClass('active')

        //$(this).css('background-color','#000066');
        $(this).addClass('active');
        $(this).tab('show')

    });

    $('[data-toggle="tooltip"]').tooltip();


    $('#myModal').modal('show');

    $('.btn-perfil').click(function () {

        $('.perfil').show();

        $('.home').hide();

        $('.inventario').hide();

        $('.loja').hide();

    });

    $('.btn-inventario').click(function () {

        $('.inventario').show();

        $('.home').hide();

        $('.perfil').hide();

        $('.loja').hide();

    });

    $('.btn-loja').click(function () {

        $('.loja').show();

        $('.home').hide();

        $('.perfil').hide();

        $('.inventario').hide();

    });

    $('.btn-home').click(function () {

        $('.home').show();

        $('.loja').hide();

        $('.perfil').hide();

        $('.inventario').hide();


    });

    $('.btn-mostrar').click(function () {

        $('.carousel').carousel('pause');
        console.log($('.btn-mostrar').closest('.active').find('h3').html());


    });

    $('#opt-log').click(function () {
        $('label').removeClass('selected');
        $(this).addClass('selected');
    });

});

