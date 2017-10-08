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
    <ul class="nav nav-pills nav-justified nav-top">
    <li class="nav-item">
        <a class="nav-link btn-home " href="#" onclick="Cor1()">Temática 1</a>
    </li>
    <li class="nav-item">
        <a class="nav-link btn-perfil " href="#" onclick="Cor2()">Temática 2</a>
    </li>
    <li class="nav-item">
        <a class="nav-link btn-inventario " href="#" onclick="Cor3()">Temática 3</a>
    </li>
    <li class="nav-item">
        <a class="nav-link btn-loja " href="#" onclick="Cor4()">Neutros</a>
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
    <div class="container w-25 fixed-top fixed-right mr-1 mt-5">
        <div class="span4">
            <div class="col-lg-6 col-md-7 col-xs-12 thumb ">
                <h3>Cartas Selecionadas</h3>
            </div>
            <div class="col-lg-6 col-md-7 col-xs-12 thumb ">
                <h5 class="nome-carta">Carta5678909</h5>
            </div>
            <div class="col-lg-6 col-md-7 col-xs-12 thumb ">
                <h5 class="nome-carta">Carta2</h5>
            </div>
            <div class="col-lg-6 col-md-7 col-xs-12 thumb ">
                <h5 class="nome-carta">Carta3</h5>
            </div>
            <div class="col-lg-6 col-md-7 col-xs-12 thumb ">
                <h5 class="nome-carta">Carta4</h5>
            </div>
            <div class="col-lg-6 col-md-7 col-xs-12 thumb ">
                <h5 class="nome-carta">Carta5</h5>
            </div>
            <div class="col-lg-6 col-md-7 col-xs-12 thumb ">
                <h5 class="nome-carta">Carta6</h5>
            </div>
            <div class="col-lg-6 col-md-7 col-xs-12 thumb ">
                <h5 class="nome-carta">Carta2</h5>
            </div>
            <div class="col-lg-6 col-md-7 col-xs-12 thumb ">
                <h5 class="nome-carta">Carta3</h5>
            </div>
            <div class="col-lg-6 col-md-7 col-xs-12 thumb ">
                <h5 class="nome-carta">Carta4</h5>
            </div>
            <div class="col-lg-6 col-md-7 col-xs-12 thumb ">
                <h5 class="nome-carta">Carta5</h5>
            </div>
            <div class="col-lg-6 col-md-7 col-xs-12 thumb ">
                <h5 class="nome-carta">Carta6</h5>
            </div>
            <div class="col-lg-6 col-md-7 col-xs-12 thumb ">
                <h5 class="nome-carta">Carta2</h5>
            </div>
            <div class="col-lg-6 col-md-7 col-xs-12 thumb ">
                <h5 class="nome-carta">Carta3</h5>
            </div>
            <div class="col-lg-6 col-md-7 col-xs-12 thumb ">
                <h5 class="nome-carta">Carta4</h5>
            </div>
            <div class="col-lg-6 col-md-7 col-xs-12 thumb ">
                <h5 class="nome-carta">Carta5</h5>
            </div>
            <div class="col-lg-6 col-md-7 col-xs-12 thumb ">
                <h5 class="nome-carta">Carta6</h5>
            </div>
                        <div class="col-lg-6 col-md-7 col-xs-12 thumb ">
                <h5 class="nome-carta">Carta2</h5>
            </div>
            <div class="col-lg-6 col-md-7 col-xs-12 thumb ">
                <h5 class="nome-carta">Carta3</h5>
            </div>
            <div class="col-lg-6 col-md-7 col-xs-12 thumb ">
                <h5 class="nome-carta">Carta4</h5>
            </div>
            <div class="col-lg-6 col-md-7 col-xs-12 thumb ">
                <h5 class="nome-carta">Carta5</h5>
            </div>
            <div class="col-lg-6 col-md-7 col-xs-12 thumb ">
                <h3>Cartas no deck:</h3>
            </div>
            <div class="col-lg-6 col-md-7 col-xs-12 thumb ">
                <h5 class="nome-carta">6/20</h5>
            </div>
        </div>
    </div>

<!-- Temática 1 -->
<div class="container home my-2 ">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-6 thumb ">
                <a href="www.uol.com.br"><img class="img-fluid img-thumbnail " src="../img/deck/angel.jpg"></a>
                <p class="text-center nome-carta ">Carta1</p>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb ">
                <img class="img-fluid img-thumbnail " src="../img/deck/angel.jpg">
                <p class="text-center nome-carta ">Carta1</p>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb ">
                <img class="img-fluid img-thumbnail " src="../img/deck/angel.jpg">
                <p class="text-center nome-carta ">Carta1</p>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb ">
                <a href="www.uol.com.br"><img class="img-fluid img-thumbnail " src="../img/deck/angel.jpg"></a>
                <p class="text-center nome-carta ">Carta1</p>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb ">
                <img class="img-fluid img-thumbnail " src="../img/deck/angel.jpg">
                <p class="text-center nome-carta ">Carta1</p>
            </div>       
        </div>
    </div>
</div>
<!--Temática 2 -->
<div class="container perfil my-2 ">
     <div class="container">
        <div class="row ">
            <div class="col-lg-3 col-md-4 col-xs-6 thumb ">
                <img class="img-fluid img-thumbnail " src="../img/deck/angel.jpg">
            </div>       
        </div>
    </div>
            
</div>
<!--Temática 3-->
<div class="container inventario my-2 ">
    <div class="container">
        <div class="row ">
            <div class="col-lg-3 col-md-4 col-xs-6 thumb ">
                <img class="img-fluid img-thumbnail " src="../img/deck/angel.jpg">
            </div>       
        </div>
    </div>
</div>
<!-- neutros -->
<div class="container loja my-2 ">
    <div class="container">
        <div class="row ">
            <div class="col-lg-3 col-md-4 col-xs-6 thumb ">
                <img class="img-fluid img-thumbnail " src="../img/deck/angel.jpg">
            </div>       
        </div>
    </div>
</div>
    
<div class="d-flex justify-content-center">
    <button type="button" class="btn btn-primary btn-lg">Salvar Deck</button>
    <button type="button" class="btn btn-primary btn-lg">Nomear Deck</button>
</div>
    
   <!--Footer -->
<nav class="navbar fixed-bottom navbar-light bg-faded nav-bottom ">
    <div class="row justify-content-between ">
        <div class="col ">
            <!--Botão Página Inicial -->
            <button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"><i
                        class="material-icons ">settings</i></button>
            <button class="btn btn-primary" onclick="window.location='main.php'"><i class="material-icons ">keyboard_arrow_left</i></button>
        </div>
        <div class="col text-center ">
            <!--Botão Página Inicial -->
            <p class="nome-jogador " style="display: inline"> <?= $nickname ?> </p>
            <!--Botão para logout com um modal para confirmar -->
            <button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm"><i
                        class="material-icons ">exit_to_app</i></button>
        </div>
        <div class="col text-right ">

            <button class="btn btn-primary" href="javascript:void(0)" onclick="toggleFullScreen()">
                <i class="material-icons" id="btn-fullscreen">fullscreen</i>
            </button>

        </div>
    </div>
</nav>
<script>
    function Cor1(){ document.getElementById("body").className = "tem1"; }
    function Cor2(){ document.getElementById("body").className = "tem2"; }   
    function Cor3(){ document.getElementById("body").className = "tem3"; }
    function Cor4(){ document.getElementById("body").className = "tem4"; }        
</script>
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
<!-- Geral script from site -->
<script src="../js/main.js "></script>
<!-- Fullscreen script -->
<script type="text/javascript" src="../js/fullscreen.js"></script>
    </body>
</html>
