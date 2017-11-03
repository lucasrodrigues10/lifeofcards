<?php
session_start();
include "php/db.php";
if (empty($_SESSION["id"])) {
    header("Location: login.php");
}
$id = $_SESSION["id"];
$DeckID = $_GET["id"];
$query = "SELECT * FROM UsuarioNoJogo WHERE IDusuario = '$id'";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nickname = $row["Nickname"];
    $moedas = $row["Moedas"];
    $exp = $row["Experiencia"];
    $avatar_imagem = $row["img_avatar.arquivo"];
    $vitorias = $row["Vitorias"];
    $derrotas = $row["Derrotas"];
}



/* Fazer queries para recuperar cartas que já estão no deck */

$query = "SELECT * FROM Cartas_Usuario WHERE IDusuario = '$id'";
$result = $conn->query($query);
$aux = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
        $IDcarta[$aux] = $row["IDcarta"];
        $Quantidade[$aux] = $row["Qtde"];
        $aux = $aux+1;
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" type="image/x-icon" href="../img/icon/favicon.ico"/>
        <title>Jogo1</title>
        <!--Ter todos os simbolos -->
        <meta charset="utf-8">
        <!--Zoom em tablets/mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--Boostrap 4.0 CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
              integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <!--Fonte do google -->
        <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Luckiest+Guy" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Rakkas" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Francois+One" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
        <!--Icones do google -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--CSS do projeto -->
        <link rel="stylesheet" type="text/css" href="../css/style.css">

    </head>
    <!--body com background -->
    <body class="tem1" id="body">
        <audio loop id="audio"> <!-- <audio autoplay loop id="audio"> vai comecar tocando -->
            <source src="/others/music.mp3">
        </audio>
        <ul class="nav nav-pills nav-justified nav-top Tematica0">
            <li class="nav-item">
                <a class="nav-link btn-home Tematica1" href="#" onclick="Cor1()">Temática 1</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-perfil Tematica2" href="#" onclick="Cor2()">Temática 2</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-inventario Tematica3" href="#" onclick="Cor3()">Temática 3</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-loja Tematica4" href="#" onclick="Cor4()">Neutros</a>
            </li>
        </ul>
        <ul class="nav nav-pills nav-justified nav-top Postura1">
            <li class="nav-item">
                <a class="nav-link btn-home Tematica1" href="#" onclick="Cor1()">Temática 1</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-loja Tematica4" href="#" onclick="Cor4()">Neutros</a>
            </li>
        </ul>
        <ul class="nav nav-pills nav-justified nav-top Tempo1">
            <li class="nav-item">
                <a class="nav-link btn-perfil Tematica2" href="#" onclick="Cor2()">Temática 2</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-loja Tematica4" href="#" onclick="Cor4()">Neutros</a>
            </li>
        </ul>
        <ul class="nav nav-pills nav-justified nav-top Swarm1">
            <li class="nav-item">
                <a class="nav-link btn-inventario Tematica3" href="#" onclick="Cor3()">Temática 3</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-loja Tematica4" href="#" onclick="Cor4()">Neutros</a>
            </li>
        </ul>
        <!-- modal -->
        <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Deseja sair?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                        <button onclick="location.href = 'php/sair.php';" type="button" class="btn btn-primary">Sim</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Configurações</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid text-center">
                            <div class="row">
                                <div class="col txt-config">Som</div>
                                <div class="col">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox"
                                               id="myonoffswitch">
                                        <label class="onoffswitch-label" for="myonoffswitch">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <!-- Temática 1 -->
                <div class="container Tema1">

                    <div  id="collapseExample">

                        <div class="card card-block" style="color:black;margin:2em auto 4em auto">

                            <?php




                            $aux2 = 0;
                            $cont = 0;
                            $cont1 = 0;

                            while($cont < $aux){

                                $query = "SELECT * FROM Cartas WHERE (IDtema= 1) AND (IDcarta = '$IDcarta[$cont]')";

                                $result = $conn->query($query);

                                if ($result->num_rows > 0) {

                            ?>

                            <div class="row equal" style="height: ;">

                                <?php

                                    while ($row = $result->fetch_assoc()) {

                                        $General[$aux2] = $row["General"];

                                ?>

                                <div class="col-6 col-sm-4 col-md-4 col-xs-4 col-lg d-flex align-items-stretch <?php if($General[$aux2] == 1){?> General Postura<?php } ?> <?php if($General[$aux2] == 0){ ?> Adicionar <?php } ?>">

                                    <div class="carta " style="border:5px solid black;border-radius: 10px;">

                                        <?php

                                        $Nome_Carta[$aux2] = $row["Nome"];

                                        $Descricao_Carta[$aux2] = $row["Descricao"];

                                        $Imagem_Carta[$aux2] = $row["arquivo.sprite"];

                                        $Ataque_Carta[$aux2] = $row["Ataque"];

                                        $Vida_Carta[$aux2] = $row["Vida"];

                                        ?>

                                        <div class="nome Nome" style="Height:5%">

                                            <p style="text-align: left; font-weight: bold;"> <?php echo $Nome_Carta[$aux2] ?> </p>

                                        </div>

                                        <div class="imagem" style="Height:50%;border:1px solid black;margin: 2%;">

                                            <img style="height:100%;width:100%"

                                                 src="../img/cartas/<?php echo $Imagem_Carta[$aux2] ?> ">

                                        </div>

                                        <div class="descricao" style="Height:35%;border:1px solid black;margin: 2%;padding:2%;">

                                            <p style="text-align: left"><?php echo $Descricao_Carta[$aux2] ?></p>

                                        </div>

                                        <div class="stats" style="Height:5%;padding-right:2%;">

                                            <p style="text-align: right"><?php echo $Ataque_Carta[$aux2] ?>

                                                / <?php echo $Vida_Carta[$aux2] ?></p>

                                        </div>


                                    </div>

                                    <?php if ($Quantidade[$cont] > 0){ ?>

                                    <div class="Quantidade">
                                        <p>x<span class="Qtde"><?php echo $Quantidade[$cont] ?></span></p>
                                    </div>

                                    <?php } ?>

                                </div>


                                <?php
                                        $aux2 = $aux2 +1;
                                    }

                                ?>

                            </div>



                            <?php

                                }
                                $cont++;
                            }

                            ?>

                        </div>





                    </div>
                </div>
                <!--Temática 2 -->
                <div class="container Tema2" style="display:none;">
                    <div  id="collapseExample">

                        <div class="card card-block" style="color:black;margin:2em auto 4em auto">

                            <?php




                            $aux2 = 0;

                            $query = "SELECT * FROM Cartas WHERE IDtema= 2";

                            $result = $conn->query($query);

                            if ($result->num_rows > 0) {


                            ?>



                            <div class="row equal" style="height: ;">

                                <?php

                                while ($row = $result->fetch_assoc()) {

                                    $General[$aux2] = $row["General"];

                                ?>

                                <div class="col-6 col-sm-4 col-md-4 col-xs-4 col-lg d-flex align-items-stretch <?php if($General[$aux2] == 1){?> General Tempo<?php } ?> <?php if($General[$aux2] == 0){ ?> Adicionar <?php } ?>">

                                    <div class="carta " style="border:5px solid black;border-radius: 10px;">

                                        <?php

                                    $Nome_Carta[$aux2] = $row["Nome"];

                                    $Descricao_Carta[$aux2] = $row["Descricao"];

                                    $Imagem_Carta[$aux2] = $row["arquivo.sprite"];

                                    $Ataque_Carta[$aux2] = $row["Ataque"];

                                    $Vida_Carta[$aux2] = $row["Vida"];

                                        ?>

                                        <div class="nome Nome" style="Height:5%">

                                            <p style="text-align: left; font-weight: bold;"> <?php echo $Nome_Carta[$aux2] ?> </p>

                                        </div>

                                        <div class="imagem" style="Height:50%;border:1px solid black;margin: 2%;">

                                            <img style="height:100%;width:100%"

                                                 src="../img/cartas/<?php echo $Imagem_Carta[$aux2] ?> ">

                                        </div>

                                        <div class="descricao" style="Height:35%;border:1px solid black;margin: 2%;padding:2%;">

                                            <p style="text-align: left"><?php echo $Descricao_Carta[$aux2] ?></p>

                                        </div>

                                        <div class="stats" style="Height:5%;padding-right:2%;">

                                            <p style="text-align: right"><?php echo $Ataque_Carta[$aux2] ?>

                                                / <?php echo $Vida_Carta[$aux2] ?></p>

                                        </div>


                                    </div>
                                    <div class="Quantidade">
                                        <p>x<span class="Qtde">3</span></p>
                                    </div>

                                </div>


                                <?php
                                            $aux2 = $aux2 +1;
                                }

                                ?>

                            </div>



                            <?php

                            }

                            ?>

                        </div>





                    </div>
                </div>
                <!--Temática 3 -->
                <div class="container Tema3" style="display:none;">
                    <div  id="collapseExample">

                        <div class="card card-block" style="color:black;margin:2em auto 4em auto">

                            <?php




                            $aux2 = 0;

                            $query = "SELECT * FROM Cartas WHERE IDtema= 3";

                            $result = $conn->query($query);

                            if ($result->num_rows > 0) {


                            ?>



                            <div class="row equal" style="height: ;">

                                <?php

                                while ($row = $result->fetch_assoc()) {

                                    $General[$aux2] = $row["General"];

                                ?>

                                <div class="col-6 col-sm-4 col-md-4 col-xs-4 col-lg d-flex align-items-stretch <?php if($General[$aux2] == 1){?> General Swarm<?php } ?> <?php if($General[$aux2] == 0){ ?> Adicionar <?php } ?>">

                                    <div class="carta " style="border:5px solid black;border-radius: 10px;">

                                        <?php

                                    $Nome_Carta[$aux2] = $row["Nome"];

                                    $Descricao_Carta[$aux2] = $row["Descricao"];

                                    $Imagem_Carta[$aux2] = $row["arquivo.sprite"];

                                    $Ataque_Carta[$aux2] = $row["Ataque"];

                                    $Vida_Carta[$aux2] = $row["Vida"];

                                        ?>

                                        <div class="nome Nome" style="Height:5%">

                                            <p style="text-align: left; font-weight: bold;"> <?php echo $Nome_Carta[$aux2] ?> </p>

                                        </div>

                                        <div class="imagem" style="Height:50%;border:1px solid black;margin: 2%;">

                                            <img style="height:100%;width:100%"

                                                 src="../img/cartas/<?php echo $Imagem_Carta[$aux2] ?> ">

                                        </div>

                                        <div class="descricao" style="Height:35%;border:1px solid black;margin: 2%;padding:2%;">

                                            <p style="text-align: left"><?php echo $Descricao_Carta[$aux2] ?></p>

                                        </div>

                                        <div class="stats" style="Height:5%;padding-right:2%;">

                                            <p style="text-align: right"><?php echo $Ataque_Carta[$aux2] ?>

                                                / <?php echo $Vida_Carta[$aux2] ?></p>

                                        </div>


                                    </div>
                                    <div class="Quantidade">
                                        <p>x<span class="Qtde">3</span></p>
                                    </div>

                                </div>


                                <?php
                                            $aux2 = $aux2 +1;
                                }

                                ?>

                            </div>



                            <?php

                            }

                            ?>

                        </div>





                    </div>
                </div>
                <!--Temática 4 -->
                <div class="container Tema4" style="display:none;">
                    <div  id="collapseExample">

                        <div class="card card-block" style="color:black;margin:2em auto 4em auto">

                            <?php




                            $aux2 = 0;

                            $query = "SELECT * FROM Cartas WHERE IDtema= 4";

                            $result = $conn->query($query);

                            if ($result->num_rows > 0) {


                            ?>



                            <div class="row equal" style="height: ;">

                                <?php

                                while ($row = $result->fetch_assoc()) {

                                ?>

                                <div class="col-6 col-sm-4 col-md-4 col-xs-4 col-lg d-flex align-items-stretch Adicionar">

                                    <div class="carta " style="border:5px solid black;border-radius: 10px;">

                                        <?php

                                    $Nome_Carta[$aux2] = $row["Nome"];

                                    $Descricao_Carta[$aux2] = $row["Descricao"];

                                    $Imagem_Carta[$aux2] = $row["arquivo.sprite"];

                                    $Ataque_Carta[$aux2] = $row["Ataque"];

                                    $Vida_Carta[$aux2] = $row["Vida"];

                                        ?>

                                        <div class="nome Nome" style="Height:5%">

                                            <p style="text-align: left; font-weight: bold;"> <?php echo $Nome_Carta[$aux2] ?> </p>

                                        </div>

                                        <div class="imagem" style="Height:50%;border:1px solid black;margin: 2%;">

                                            <img style="height:100%;width:100%"

                                                 src="../img/cartas/<?php echo $Imagem_Carta[$aux2] ?> ">

                                        </div>

                                        <div class="descricao" style="Height:35%;border:1px solid black;margin: 2%;padding:2%;">

                                            <p style="text-align: left"><?php echo $Descricao_Carta[$aux2] ?></p>

                                        </div>

                                        <div class="stats" style="Height:5%;padding-right:2%;">

                                            <p style="text-align: right"><?php echo $Ataque_Carta[$aux2] ?>

                                                / <?php echo $Vida_Carta[$aux2] ?></p>

                                        </div>


                                    </div>
                                    <div class="Quantidade">
                                        <p>x<span class="Qtde">3</span></p>
                                    </div>

                                </div>


                                <?php
                                            $aux2 = $aux2 +1;
                                }

                                ?>

                            </div>



                            <?php

                            }

                            ?>

                        </div>





                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="container">
                    <form role="form" action="php/salve.php" method="post">
                        <div class="col-lg-6 col-md-7 col-xs-12 thumb Generalizado">
                            <h3>General Selecionado</h3>
                        </div>
                        <div class="col-lg-6 col-md-7 col-xs-12 thumb Adicionado">
                            <h3>Cartas Selecionadas</h3>
                        </div>
                        <div class="col-lg-6 col-md-7 col-xs-12 thumb ">
                            <h3>Cartas no deck:</h3>
                        </div>
                        <div class="col-lg-6 col-md-7 col-xs-12 thumb ">
                            <h5 class="nome-carta"><span class="Total">0</span>/20</h5>
                        </div>
                        <div class="col-lg-6 col-md-7 col-xs-12 thumb ">
                            <button type="submit" name="submit" class="btn-fullscreen btn-log">Salvar Deck</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Footer -->
        <nav class="navbar fixed-bottom navbar-light bg-faded nav-bottom ">
            <div class="row justify-content-between ">
                <div class="col ">
                    <!--Botão Página Inicial -->
                    <button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="material-icons ">settings</i></button>
                    <button class="btn btn-primary" onclick="window.location='main.php'"><i class="material-icons ">keyboard_arrow_left</i></button>
                </div>
                <div class="col text-center ">
                    <!--Botão Página Inicial -->
                    <p class="nome-jogador " style="display: inline"> <?= $nickname ?> </p>
                    <!--Botão para logout com um modal para confirmar -->
                    <button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm"><i class="material-icons ">exit_to_app</i></button>
                </div>
                <div class="col text-right ">

                    <button class="btn btn-primary" href="javascript:void(0)" onclick="toggleFullScreen()">
                        <i class="material-icons" id="btn-fullscreen">fullscreen</i>
                    </button>

                </div>
            </div>
        </nav>

        <!--JQuery, Javascript para Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js "
                integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n "
                crossorigin="anonymous "></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js "
                integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb "
                crossorigin="anonymous "></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js "
                integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn "
                crossorigin="anonymous "></script>
        <script>
            function Cor1(){ document.getElementById("body").className = "tem1"; }
            function Cor2(){ document.getElementById("body").className = "tem2"; }   
            function Cor3(){ document.getElementById("body").className = "tem3"; }
            function Cor4(){ document.getElementById("body").className = "tem4"; }
        </script>
        <script>
            $(document).ready(function() {
                var Total = 0;

                $('.Tematica0').show();
                $('.Postura1').hide();
                $('.Tempo1').hide();
                $('.Swarm1').hide();

                $(".Tematica1").click(function(){
                    $(".Tema1").show();
                    $(".Tema2").hide();
                    $(".Tema3").hide();
                    $(".Tema4").hide();
                });
                $(".Tematica2").click(function(){
                    $(".Tema2").show();
                    $(".Tema1").hide();
                    $(".Tema3").hide();
                    $(".Tema4").hide();
                });
                $(".Tematica3").click(function(){
                    $(".Tema3").show();
                    $(".Tema1").hide();
                    $(".Tema2").hide();
                    $(".Tema4").hide();
                });
                $(".Tematica4").click(function(){
                    $(".Tema4").show();
                    $(".Tema1").hide();
                    $(".Tema2").hide();
                    $(".Tema3").hide();
                });

                $(".Postura").click(function(){
                    $(".Postura1").show();
                    $(".Tempo1").hide();
                    $(".Swarm1").hide();
                    $(".Tematica0").hide();
                });
                $(".Tempo").click(function(){
                    $(".Tempo1").show();
                    $(".Postura1").hide();
                    $(".Swarm1").hide();
                    $(".Tematica0").hide();
                });

                $(".Swarm").click(function(){
                    $(".Swarm1").show();
                    $(".Postura1").hide();
                    $(".Tempo2").hide();
                    $(".Tematica0").hide();
                });


                var count = $(".Generalizado div").length;

                if(count === 0){
                    $('.Adicionar').css("color", "gray");
                    $('.carta').css("border-color", "gray");
                }


                //Adiciona General no Deck

                $('.General').click(function() {
                    var Qtde = parseInt($(this).closest("div").find(".Qtde").text());

                    if(count > 0){
                        $(this).click(false);
                    }
                    else{
                        $('.Generalizado').append('<div class="col-lg-6 col-md-7 col-xs-12 Chefao"><h3 class="nome-carta">'+$(this).closest("div").find(".Nome").text()+'</h3></div>');
                        Qtde = Qtde - 1;
                        $(this).closest("div").find(".Qtde").text(Qtde);
                        $('.Total').text(parseInt($('.Total').text()) + 1);
                        count = count + 1 ;
                        $('.General').css("color", "gray");
                        $('.Adicionar').css("color", "black");
                        $('.carta').css("border-color", "black");
                    }
                });


                if(count > 0){
                    $('.General').css("color", "gray");
                    $('.Adicionar').css("color", "black");
                    $('.carta').css("border-color", "black");
                }

                //Adiciona Cartas no Deck

                $('.Adicionar').on("click", function(e) {
                    e.preventDefault();
                    var Nome = $(this).closest("div").find(".Nome").text();
                    var Qtde = parseInt($(this).closest("div").find(".Qtde").text());
                    var Total = parseInt($(".Total").text());
                    var QuantidadeCarta = 0;



                    if(Qtde<1 || count === 0 || Total === 20){
                        $(this).click(false);
                    }
                    else{

                        //Checa se ja tem carta igual adicionada
                        $('.Adicionado').each(function(i){ // Seleciona div adicionado
                            $(this).find(".RemoveCarta").find(".nome-carta").each(function(i){ //Seleciona cada carta no div
                                if($(this).text() === Nome){
                                    QuantidadeCarta = parseInt($(this).closest("div").find(".Amount").text());
                                    QuantidadeCarta = QuantidadeCarta + 1;
                                    var Input = $(this).closest("div").find('.InputQtde');
                                    $(this).closest("div").find(".Amount").text(QuantidadeCarta);
                                    Input.attr('value', QuantidadeCarta); //adiciona valor do input caso quantidade de cartas seja acrescentado
                                }
                            });
                        });

                        //Adiciona carta nova se nao foi adicionada ainda
                        if(isNaN(QuantidadeCarta) || QuantidadeCarta < 1){
                            $('.Adicionado').append('<div class="col-lg-6 col-md-7 col-xs-12 RemoveCarta"><input class="InputNome" type="hidden" name="carta[]" value=""></input><h3 class="nome-carta">'+Nome+'</h3><input class="InputQtde" type="hidden" name="QtdeCarta[]"></input><h3>x<span class="Amount">1</span></h3></div>');
                            
                            //Adiciona valor no input para mandar para a pagina salve.php para adicionar no banco de dados
                            
                            $('.RemoveCarta').each(function(i){
                                var NomeCarta = $(this).find(".nome-carta").text();
                                var InputNome = $(this).find(".InputNome");
                                var InputQtde = $(this).find(".InputQtde");
                                if(!InputNome.val()){
                                    InputNome.attr('value', NomeCarta);
                                    InputQtde.attr('value', 1);
                                }
                            });
                        }


                        Qtde = Qtde - 1;
                        $(this).closest("div").find(".Qtde").text(Qtde);
                        $('.Total').text(parseInt($('.Total').text()) + 1);
                    }
                });    
                $('.Adicionado').on("click", ".RemoveCarta", function(e){
                    e.preventDefault();
                    var NumeroCartas = parseInt($(this).find(".Amount").text());

                    NumeroCartas = NumeroCartas - 1;
                    if(NumeroCartas < 1){
                        $(this).remove();
                    }else{
                        $(this).closest("div").find(".Amount").text(NumeroCartas);
                        $(this).closest("div").find(".InputQtde").attr('value', NumeroCartas); //Atualiza quantidade de cartas no input para enviar no salve.php
                    }
                    var Nome = $(this).find(".nome-carta").text();
                    $('.Total').text(parseInt($('.Total').text()) - 1);
                    $('.Adicionar').each(function(i){
                        if($(this).closest("div").find(".Nome").text() === Nome){
                            var Qtde = parseInt($(this).closest("div").find(".Qtde").text());
                            Qtde = Qtde + 1;
                            $(this).closest("div").find(".Qtde").text(Qtde);
                        }
                    });
                });

            });
        </script>
        <!-- Geral script from site -->
        <script src="../js/main.js "></script>
        <!-- Fullscreen script -->
        <script type="text/javascript" src="../js/fullscreen.js"></script>
    </body>
</html>
