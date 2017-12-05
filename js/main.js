$(document).ready(function () {

    $("#btn-add-amigo").on("click", function () {
        $.ajax({
            url: "php/adicionaAmigo.php",
            type: 'post',
            data: {
                amigo: $("#input-add-amigo").val()
            }
        })
            .done(function (msg) {
                if (msg == "valido") {
                    location.reload();
                } else if (msg == "invalido") {
                    alert("Amigo nao encontrado.");
                } else if (msg == "") {
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
    
    $('.btn-editar').click(function () {
 
         $('.field').show();
         
         $('.btn-editar').hide();
         
         $('.btn-enviar').show();
     });
     
     $('.btn-enviar').click(function () {
         
     var idad = $('#idade').val();
     var loc = $('#local').val();
     var sex = $('#sexo').val();
     var idu = $('#id').val();
      $.ajax({
             type: "POST",
             url: '/pages/php/editardados.php',
             data: 
             { 
                 idade: idad,
                 local: loc,
                 sexo: sex,
                 id: idu
                 
             },
             success: function(data) {
              /*  location.reload();
                $(document).ready(function () {
                    $('.home').hide();
                    $('.inventario').hide();
                    $('.loja').hide();
                    $('.perfil').show();
                });*/
 	           // console.log(data);
             }
         });
 
         $('.field').hide();
         
         $('.btn-editar').show();
         
         $('.btn-enviar').hide();
     });
     
     
     
     $('.img-avatar').click(function () {
         $('.escolhido').removeClass('escolhido');
         
         $(this).addClass('escolhido');
        //console.log(this);
     });
     
     
    $('.salvar-avatar').click(function () {
         
     var a = $('.escolhido').attr("alt");
 	            console.log(a);
     var idu = $('.escolhido').attr("value");
     console.log(idu);
      $.ajax({
             type: "POST",
             url: '/pages/php/editaravatar.php',
             data: 
             { 
                 nome: a,
                 id: idu
             },
             success: function(data) {
                location.reload();
               /* $(document).ready(function () {
                    $('.home').hide();
                    $('.inventario').hide();
                    $('.loja').hide();
                    $('.perfil').show();
                });*/
 	            console.log(data);
             }
         });
     });

        
    $('.btn-mostrar').click(function () {
        $('.carousel').carousel('pause');
        //console.log($('.btn-mostrar').closest('.active').find('h3').html());
        var x = $('.btn-mostrar').closest('.active').find('h3').html();
         $.ajax({
             type: "POST",
             url: '/pages/php/mostrarcartas.php',
             data: 
             { 
                 nome: x
             },
             success: function(data) {
                 $('#collapseExample').html(data);
             }
         });
        if($('.collapse').hasClass('show'))
        {
            $('.carta').hide();
        }
        
    });
    
    $('.btn-danger').click(function () { 
        var x = $('.btn-mostrar').closest('.active').find('h3').html();
		var y = $('.moedas').attr("alt");
		var z = $('.preco_certo').attr("alt");
		var idu = $('.btn-danger').attr("value");
			 $.ajax({
				 type: "POST",
				 url: '/pages/php/comprarpacote.php',
				 data: 
				 { 
					 nome: x,
					 id: idu
				 },
				 success: function(data) {
				 if(y-z>0)
				 {
				    $('.moedas').html('Suas Moedas: ');
				    $('.moedas').append(y-z);
	                $('.moedas').attr("alt", y-z);
    				$('.moedas').append(` <img src="../img/icon/coin.svg" alt="moeda" class="icone">`);
    	            $('.moedas').attr("alt", y-z);
				 }
                 $('#pacote').html(data);
				 }
			 });
    });

    $('#opt-log').click(function () {
        $('label').removeClass('selected');
        $(this).addClass('selected');
    });

});