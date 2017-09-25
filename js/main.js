$(document).ready(function() {

    $('.nav-pills a').click(function(e) {
        e.preventDefault()
        $(this).tab('show')
    })
    $('[data-toggle="tooltip"]').tooltip();

    $('#myModal').modal('show');
    $('.btn-perfil').click(function() {
        $('.perfil').show();
        $('.home').hide();
        $('.inventario').hide();
        $('.loja').hide();
    });
    $('.btn-inventario').click(function() {
        $('.inventario').show();
        $('.home').hide();
        $('.perfil').hide();
        $('.loja').hide();
    });
    $('.btn-loja').click(function() {
        $('.loja').show();
        $('.home').hide();
        $('.perfil').hide();
        $('.inventario').hide();
    });
    $('.btn-home').click(function() {
        $('.home').show();
        $('.loja').hide();
        $('.perfil').hide();
        $('.inventario').hide();
    });
    $('.btn-fullscreen').click(function() {
        $('body').fullscreen(options);
    });
    $('.btn-mostrar').click(function() {
        $('.carousel').carousel('pause');
    });
});
