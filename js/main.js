$(document).ready(function() {
    $('.nav-pills a').click(function(e) {
        e.preventDefault()
        $(this).tab('show')
    })
    $('#myModal').modal('show');
    $('.btn-jogar').click(function() {
        $('.jogar').show();
        $('.home').hide();
        $('.perfil').hide();
        $('.inventario').hide();
        $('.loja').hide();
    });
    $('.btn-perfil').click(function() {
        $('.perfil').show();
        $('.home').hide();
        $('.jogar').hide();
        $('.inventario').hide();
        $('.loja').hide();
    });
    $('.btn-inventario').click(function() {
        $('.inventario').show();
        $('.home').hide();
        $('.jogar').hide();
        $('.perfil').hide();
        $('.loja').hide();
    });
    $('.btn-loja').click(function() {
        $('.loja').show();
        $('.home').hide();
        $('.jogar').hide();
        $('.perfil').hide();
        $('.inventario').hide();
    });
    $('.btn-home').click(function() {
        $('.home').show();
        $('.loja').hide();
        $('.jogar').hide();
        $('.perfil').hide();
        $('.inventario').hide();
    });
});
