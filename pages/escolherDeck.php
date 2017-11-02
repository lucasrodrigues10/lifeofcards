

<?php
session_start();
include "php/db.php";


// REMOVIDO TEMPORARIAMENTE PARA FACILITAR Tdesenvolvimento
/*if (empty($_SESSION["id"])) {
    header("Location: login.php");
}
*/

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
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" type="image/x-icon" href="../img/icon/favicon.ico"/>
        <title>Escolha de deck</title>
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
    
    <body class="tem1" id="body"> <!-- reaproveitei o css -->
        <audio loop id="audio"> <!-- <audio autoplay loop id="audio"> vai comecar tocando -->
            <source src="/others/music.mp3">
        </audio>
        <!-- modal para sair do jogo -->
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
        <!-- modal para configurações-->
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
            <div class="col-12">
                <div class="container">
                    
                </div>     
            </div>
        </div>
        
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
    </body>