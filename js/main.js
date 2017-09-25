$(document).ready(function () {

    //Começa com o som desligado
    audio.pause();
    audio.currentTime = 0;

    var vol = 50;
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

    $('.nav-pills a').click(function (e) {
        e.preventDefault();
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
    });
});
