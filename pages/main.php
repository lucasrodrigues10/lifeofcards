<?php
session_start();
include "php/db.php";
if (empty($_SESSION["id"])) {
    header("Location: login.php");
}
$id = $_SESSION["id"];
$query = "SELECT * FROM Usuario WHERE IDusuario = '$id'";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$login = $row["Login"];

$query = "SELECT * FROM UsuarioNoJogo WHERE IDusuario = '$id'";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nickname = $row["Nickname"];
    $moedas = $row["Moedas"];
    $exp = $row["Experiência"];
    $avatar_imagem = $row["img_avatar.arquivo"];
    $vitorias = $row["Vitorias"];
    $derrotas = $row["Derrotas"];
}
if (isset($nickname) && $nickname != null) {
    $modal = strlen($nickname);
}
/*
        POPULAR BANCO DE DADOS ANTES DE ADICIONAR

    $query = "SELECT * FROM Notícias WHERE IDnotícia = '1'"; 
    $result = $conn->query($query); 
    while($row = $result->fetch_assoc()){ 
        $titulo = $row["Título"]; 
        $descricao = $row["Descrição"]; 
        $data = $row["Data"]; 
    } 
    $nickname_amigos = array(); 
    $query = "SELECT Nickname FROM Amizades WHERE IDusuario = '$id'"; 
    $result = $conn->query($query); 
    while($row = $result->fetch_assoc()){ 
        $nickname_amigos = $row["Nickname"]; 
    } 
    $query = "SELECT Nível FROM Nível WHERE XPnecessaria > '$exp' LIMIT 1"; 
    $result = $conn->query($query); 
    $row = $result->fetch_assoc(); 
    $nivel = $row["Nível"]; 
    $query = "SELECT * FROM Usuário WHERE IDusuario = '$id'"; 
    $result = $conn->query($query); 
    while($row = $result->fetch_assoc()){ 
        $idade = $row["Idade"]; 
        $localizacao = $row["Endereço"]; 
        $sexo = $row["Sexo"]; 
        $email = $row["Email"]; 
    } 
    $IDdeck = array(); 
    $Nome_Deck = array(); 
    $Descricao_Deck = array(); 
    $query = "SELECT * FROM Deck usuário WHERE IDusuario = '$id' or IDusuario = '0'"; 
    $result = $conn->query($query); 
    while($row = $result->fetch_assoc()){ 
        $IDdeck[] = $row["IDdeck"]; 
        $Nome_Deck[] = $row["Nome"]; 
        $Descricao_Deck[] = $row["Descrição"]; 
    } 
    $IDproduto = array(); 
    $Tabnum = array(); 
    $IDpromocao = array(); 
    $preco = array(); 
    $preco_certo =  array(); 
    $query = "SELECT * FROM Loja"; 
    $result = $conn->query($query); 
    while($row = $result->fetch_assoc()){ 
        $IDproduto[] = $row["IDproduto"]; 
        $Tabnum[] = $row["TabNum"]; 
        $IDpromocao[] = $row["IDpromocao"]; 
        $preco[] = $row["Preço"]; 
    } 
    $i=0; 
    foreach($IDpromocao as $value){ 
        $query = "SELECT Valor FROM Promoção WHERE IDpromoção = '$value'"; 
        $result = $conn->query($query); 
        $row = $result->fetch_assoc(); 
        $valor = $row["Valor"]; 
        $preco_certo[] = $preco[++$i]*$valor; 
    } 
    $IDcarta_loja = array(); 
    $IDskin_loja = array(); 
    $IDpacote_loja = array(); 
    foreach ($IDproduto as $value){ 
        if($Tabnum == 1){ 
            $IDcarta_loja[] = $value; 
        } 
        if($Tabnum == 2){ 
            $IDskin_loja[] = $value; 
        } 
        if($Tabnum == 3){ 
            $IDpacote_loja[] = $value; 
        } 
    } 
    $Nome_pacote = array(); 
    $Descricao_pacote = array(); 
    $qtdecartas_pacote = array(); 
    $Descricao_carta = array(); 
    foreach ($IDpacote_loja as $value){ 
        $query = "SELECT * FROM Tabela pacote WHERE IDpacote = '$value'"; 
        $result = $conn->query($query); 
        while($row = $result->fetch_assoc()){ 
            $Nome_pacote[] = $row["Nome"]; 
            $Descricao_pacote[] = $row["Descrição"]; 
            $qtdecartas_pacote[] = $row["QtdeCartas/pacote"]; 
        } 
    } 
    foreach ($IDcarta_loja as $value){ 
        $query = "SELECT IDcarta FROM Cartas WHERE IDpacote = '$value'"; 
        $result = $conn->query($query); 
        while($row = $result->fetch_assoc()){ 
            $Descricao_carta[] = $row["Descrição"]; 
        } 
    } 
    */
?>
<style>
    /* custom full-screen styles
    :-webkit-full-screen .main {
        background-color: #ccc;
        font-size: 24px;
        width: 95%;
    }
    :-moz-full-screen .main {
        background-color: #ccc;
        font-size: 24px;
        width: 95%;
    }*/
    :-webkit-full-screen .fs {
        display: none
    }

    :-moz-full-screen .fs {
        display: none
    }

    :-webkit-full-screen .rs {
        display: block
    }

    :-moz-full-screen .rs {
        display: block
    }
</style>
<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" type="image/x-icon" href="img/icon/favicon.ico"/>
    <title>Jogo</title>
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
<body class="full">
<?php if ($modal < 1) { ?>

    <script>
        window.open("nickname.php", "_self");
    </script>

<?php } ?>
<div class="modal fade" id="teste" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Data</h4>
            </div>
            <div class="modal-body">
                <div class="fetched-data"><?php $message ?></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--Modal-->
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
                                       id="myonoffswitch" checked>
                                <label class="onoffswitch-label" for="myonoffswitch">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Descartar</button>
                <button type="button" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </div>
</div>


<!--Barra de navegação de cima -->
<ul class="nav nav-pills nav-justified nav-top">
    <li class="nav-item">
        <a class="nav-link btn-home active" href="#">Início</a>
    </li>
    <li class="nav-item">
        <a class="nav-link btn-perfil" href="#">Perfil</a>
    </li>
    <li class="nav-item">
        <a class="nav-link btn-inventario" href="#">Inventário</a>
    </li>
    <li class="nav-item">
        <a class="nav-link btn-loja" href="#">Loja</a>
    </li>
</ul>
<!--Início -->
<div class="container home my-3">
    <div class="row">
        <div class="col-sm-6">
            <div class="card text-center">
                <div class="card-header">
                    Jogue agora
                </div>
                <div class="card-block">
                    <button type="button" class="btn btn-primary btn-lg btn-block"
                            onclick="window.location='jogo.php'">Ranqueado
                    </button>
                    <button type="button" class="btn btn-secondary btn-lg btn-block"
                            onclick="window.location='jogo.php'">Treino
                    </button>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card text-center">
                <div class="card-header">
                    Amigos
                </div>
                <div class="card-block">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <p class="card-text nome-amigos">Jogador1</p>
                            </div>
                            <div class="col">
                                <i class="material-icons icn-status" data-toggle="tooltip" data-placement="top"
                                   title="online">cloud</i>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-primary btn-sm">Jogar</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="card-text nome-amigos">Jogador2</p>
                            </div>
                            <div class="col">
                                <i class="material-icons icn-status" data-toggle="tooltip" data-placement="top"
                                   title="online">cloud</i>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-primary btn-sm">Jogar</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="card-text nome-amigos">Jogador3</p>
                            </div>
                            <div class="col">
                                <i class="material-icons icn-status" data-toggle="tooltip" data-placement="top"
                                   title="offline" style="color:red">cloud</i>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-primary btn-sm" disabled>Jogar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card" style="margin:1em auto; width: 97.3%;">
            <div class="card-header text-center ">
                Notícias
            </div>
            <div class="card-block ">
                <h4 class="card-title ">Nova carta de ataque</h4>
                <p class="card-text ">Com o novo update foi adicionado a carta espada de ouro com um dos maiores
                    danos. <a href="# "> Clique aqui para vê-la.</a></p>
                <div class="card-footer text-muted text-center ">
                    01/05/2018
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Perfil -->
<div class="container perfil my-3">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="card text-center ">
                    <img src="../img/avatar/gato.jpg "
                         class="img-fluid img-thumbnail rounded mx-auto d-block rounded "
                         alt="Responsive image "
                         style="margin-top: 1em">
                    <div class="card-block">
                        <h4 class="card-title nome-jogador" style='color:purple'><?= $nickname ?></h4>
                    </div>
                    <div class="txt-perfil">
                        <div class='container'>
                            <div class="row">
                                <div class="col text-right">
                                    <p>3</p>
                                </div>
                                <div class="col text-left">
                                    <img src="../img/icon/nivel.svg" alt="nivel" class="icone">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    <p>1000</p>
                                </div>
                                <div class="col text-left">
                                    <img src="../img/icon/coin.svg" alt="moeda" class="icone">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    <p>330</p>
                                </div>
                                <div class="col text-left">
                                    <img src="../img/icon/xp.png" alt="xp" class="icone">
                                </div>
                            </div>
                        </div>
                        <div class="progress" style="width: 95%;margin:1.2em auto">
                            <div class="progress-bar " role="progressbar " style="width: 25%;height: 3em"
                                 aria-valuenow="25 " aria-valuemin="0 " aria-valuemax="100 "></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8 text-center">
                <div class="card txt-info">
                    <div class="row">
                        <div class="col">
                            <p><img src="../img/icon/vitoria.svg" alt="vitoria" class="icone"> 13</p>
                        </div>
                        <div class="col">
                            <p><img src="../img/icon/derrota.svg" alt="vitoria" class="icone"> 20</p>
                        </div>
                    </div>
                    <table class="table table-bordered" style="font-size:.7em">
                        <tbody>
                        <tr>
                            <th scope="row" class="text-center">Idade</th>
                            <td>20</td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center">Localização</th>
                            <td>Brasil</td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center">Sexo</th>
                            <td>Masculino</td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center">Email</th>
                            <td colspan="2">jogadorlegal123@gmail.com</td>
                        </tr>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-primary" style="margin:1em auto 1em auto;width: 40%">
                        Editar
                        Dados
                    </button>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="ct-chart ct-perfect-fourth"></div>
        </div>
    </div>
</div>
<div class="container inventario my-3">
    <div class="container ">
        <div class="row ">
            <div class="col-lg-3 col-md-4 col-xs-6 thumb ">
                <a href="# ">
                    <img class="img-fluid img-thumbnail " src="../img/deck/angel.jpg " alt=" ">
                </a>
                <p class="text-center nome-carta ">Angel of Death</p>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb ">
                <a href="# ">
                    <img class="img-fluid img-thumbnail " src="../img/deck/demon.jpg " alt=" ">
                </a>
                <p class="text-center nome-carta ">Demon of the Dark</p>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb ">
                <a href="# ">
                    <img class="img-fluid img-thumbnail " src="../img/deck/wind.jpg " alt=" ">
                </a>
                <p class="text-center nome-carta ">Hard Wind</p>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb ">
                <a href="# ">
                    <img class="img-fluid img-thumbnail " src="../img/deck/dragao.jpg " alt=" ">
                </a>
                <p class="text-center nome-carta ">Dragon Lord</p>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb ">
                <a href="# ">
                    <img class="img-fluid img-thumbnail " src="../img/deck/fire.jpg " alt=" ">
                </a>
                <p class="text-center nome-carta ">Fear of Fire</p>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb ">
                <a href="# ">
                    <img class="img-fluid img-thumbnail " src="../img/deck/magic.jpg " alt=" ">
                </a>
                <p class="text-center nome-carta ">Invencible Magic </p>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb ">
                <a href="# ">
                    <img class="img-fluid img-thumbnail " src="../img/deck/shield.jpg " alt=" ">
                </a>
                <p class="text-center nome-carta ">Unbreakable Shield </p>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb ">
                <a href="# ">
                    <img class="img-fluid img-thumbnail " src="../img/deck/sword.jpg " alt=" ">
                </a>
                <p class="text-center nome-carta ">Sword of Blood </p>
            </div>
        </div>
        <hr>
    </div>
    <!-- /.container -->
</div>
<div class="container loja my-3">
    <div id="carouselExampleIndicators" class="carousel slide" data-interval="3000" data-pause="hover"
         data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner " role="listbox">
            <div class="carousel-item active ">
                <div class="container">
                    <div class="row ">
                        <div class="col-sm">
                            <img class="d-block img-fluid img-loja" src="../img/deck/viking.jpg"
                                 alt="First slide">
                        </div>
                        <div class="col-sm txt-loja">
                            <div>
                                <h3>Viking Deck</h3>
                                <p>Esse deck possui cartas com muito dano físico e defesa.</p>
                                <p>300 <img src="../img/icon/coin.svg" alt="moeda" class="icone"></p>
                                <button type="button" class="btn btn-info btn-mostrar" data-toggle="collapse"
                                        data-target="#collapseExample" aria-expanded="false"
                                        aria-controls="collapseExample">Mostrar Cartas
                                </button>
                                <button type="button" class="btn btn-danger">Comprar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item ">
                <div class="container">
                    <div class="row ">
                        <div class="col-sm">
                            <img class="d-block img-fluid img-loja" src="../img/deck/eagle.jpg"
                                 alt="First slide">
                        </div>
                        <div class="col-sm txt-loja">
                            <div>
                                <h3>Eagle Deck</h3>
                                <p>Esse deck possui cartas com muito dano físico e defesa.</p>
                                <p>300 <img src="../img/icon/coin.svg" alt="moeda" class="icone">
                                </p>
                                <button type="button" class="btn btn-info btn-mostrar" data-toggle="collapse"
                                        data-target="#collapseExample" aria-expanded="false"
                                        aria-controls="collapseExample">Mostrar Cartas
                                </button>
                                <button type="button" class="btn btn-danger">Comprar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item ">
                <div class="container">
                    <div class="row ">
                        <div class="col-sm">
                            <img class="d-block img-fluid img-loja" src="../img/deck/3eyes.jpg"
                                 alt="First slide">
                        </div>
                        <div class="col-sm txt-loja">
                            <div>
                                <h3>Three Eyes Deck</h3>
                                <p>Esse deck possui cartas com muito dano físico e defesa.</p>
                                <p>300 <img src="../img/icon/coin.svg" alt="moeda" class="icone"></p>
                                <button type="button" class="btn btn-info btn-mostrar" data-toggle="collapse"
                                        data-target="#collapseExample" aria-expanded="false"
                                        aria-controls="collapseExample">Mostrar Cartas
                                </button>
                                <button type="button" class="btn btn-danger">Comprar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="collapse" id="collapseExample">
        <div class="card card-block" style="color:black;margin:1em">
            Foto e descrição das cartas
        </div>
    </div>
</div>

<!--Footer -->
<nav class="navbar fixed-bottom navbar-light bg-faded nav-bottom ">
    <div class="row justify-content-between ">
        <div class="col ">
            <!--Botão Página Inicial -->
            <button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"><i
                        class="material-icons ">settings</i></button>
        </div>
        <div class="col text-center ">
            <!--Botão Página Inicial -->
            <p class="nome-jogador " style="display: inline"> <?= $nickname ?> </p>
            <!--Botão para logout com um modal para confirmar -->
            <button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm"><i
                        class="material-icons ">exit_to_app</i></button>
        </div>
        <div class="col text-right ">

            <button class="btn btn-primary" href="javascript:void(0)" onclick="javascript:toggleFullScreen()">
                <i class="material-icons" id="btn-fullscreen">fullscreen</i>
            </button>

        </div>
    </div>
</nav>
<span class="glyphicons-home" aria-hidden="true "></span>

<!-- Fullscreen script -->
<script type="text/javascript" src="../js/fullscreen.js"></script>

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
<script src="../js/main.js "></script>
<!--Fullscreen JQuery API-->
<script type="text/javascript" src="../js/jquery.fullscreen.min.js">
</script>
</body>

</html>