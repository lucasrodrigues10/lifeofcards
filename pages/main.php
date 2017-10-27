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

$idade = $row["Nascimento"];

$localizacao = $row["Endereço"];

$sexo = $row["Sexo"];

$email = $row["Email"];


$query = "SELECT * FROM UsuarioNoJogo WHERE IDusuario = '$id'";

$result = $conn->query($query);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();

    $nickname = $row["Nickname"];

    $moedas = $row["Moedas"];

    $exp = $row["Experiencia"];

    $avatar_imagem = $row["img_avatar.arquivo"];

    if ($avatar_imagem == NULL)
        $avatar_imagem = 'cachorro.jpg';
    $vitorias = $row["Vitorias"];

    $derrotas = $row["Derrotas"];

}


$query = "SELECT Nivel FROM Nivel WHERE XPnecessaria > '$exp' LIMIT 1";

$result = $conn->query($query);

$row = $result->fetch_assoc();

$nivel = $row["Nivel"];


if (isset($nickname) && $nickname != null) {

    $modal = strlen($nickname);

}

$IDdeck = array();

$Nome_Deck = array();

$Descricao_Deck = array();

$Imagem_Deck = array();

$i = 0;

$query = "SELECT * FROM DeckUsuario WHERE IDusuario = '$id'";

$result = $conn->query($query);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $IDdeck[$i] = $row["IDdeck"];

        $Nome_Deck[$i] = $row["Nome"];

        $Descricao_Deck[$i] = $row["Descrição"];

        $Imagem_Deck[$i] = $row["ImagemDeck"];

        $i++;

    }

}

$nickname_amigos = array();

$query = "SELECT Nickname FROM Amizades WHERE IDusuario = '$id'";

$result = $conn->query($query);

$k = 0;

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $nickname_amigos[$k] = $row["Nickname"];

        $k++;

    }

}

$query = "SELECT * FROM Noticias WHERE IDnoticia = '1'";

$result = $conn->query($query);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();

    $titulo = $row["Título"];

    $descricao = $row["Descrição"];

    $data = $row["Data"];

}


$IDproduto = array();

$Tabnum = array();

$IDpromocao = array();

$preco = array();

$preco_certo = array();

$valor = 0;

$query = "SELECT * FROM Loja";

$result = $conn->query($query);

$z = 0;

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $IDproduto[$z] = $row["IDproduto"];

        $Tabnum[$z] = $row["TabNum"];

        $IDpromocao[$z] = $row["IDpromocao"];

        $preco[$z] = $row["Preço"];

        $query = "SELECT Valor FROM Promoção WHERE IDpromoção = '$IDpromocao[$z]'";

        $result2 = $conn->query($query);

        if ($result2->num_rows > 0) {

            $row = $result2->fetch_assoc();

            $valor = $row["Valor"];

            $preco_certo[$z] = $preco[$z] * $valor;

        }

        $z++;

    }

}


$a = 0;

$b = 0;

$c = 0;

$d = 0;

$Nome_Carta = array();

$Descricao_Carta = array();

$Imagem_Carta = array();

$Nome_Skin = array();

$Descricao_Skin = array();

$Imagem_Skin = array();

$Nome_Pacote = array();

$Descricao_Pacote = array();

$Imagem_Pacote = array();

while ($a < $z) {

    if ($Tabnum[$a] == 1) {

        $query = "SELECT Nome,Descricao,arquivo.sprite FROM Cartas WHERE IDcarta= '$IDproduto[$a]'";

        $result = $conn->query($query);

        $row = $result->fetch_assoc();

        $Nome_Carta[$b] = $row["Nome"];

        $Descricao_Carta[$b] = $row["Descricao"];

        $Imagem_Carta[$b] = $row["arquivo.sprite"];

        $b++;

    }

    if ($Tabnum[$a] == 2) {

        $query = "SELECT Nome,Descricao,ImagemSkin FROM Skin WHERE IDskin= '$IDproduto[$a]'";

        $result = $conn->query($query);

        $row = $result->fetch_assoc();

        $Nome_Skin[$c] = $row["Nome"];

        $Descricao_Skin[$c] = $row["Descricao"];

        $Imagem_Skin[$c] = $row["ImagemSkin"];

        $c++;

    }

    if ($Tabnum[$a] == 3) {

        $query = "SELECT Nome,Descricao,ImagemPacote FROM Pacote WHERE IDpacote= '$IDproduto[$a]'";

        $result = $conn->query($query);

        $row = $result->fetch_assoc();

        $Nome_Pacote[$d] = $row["Nome"];

        $Descricao_Pacote[$d] = $row["Descricao"];

        $Imagem_Pacote[$d] = $row["ImagemPacote"];

        $d++;

    }

    $a++;

}

$a = 0;

?>

<!DOCTYPE html>

<html>

<head>

    <link rel="shortcut icon" type="image/x-icon" href="../img/icon/favicon.ico"/>

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

<audio loop id="audio"> <!-- <audio autoplay loop id="audio"> vai comecar tocando -->

    <source src="/others/music.mp3">

</audio>

<div class="modal fade" id="teste" role="dialog">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">Edit Data</h4>

            </div>

            <div class="modal-body">

                <div class="fetched-data"><?php if (isset($message)) $message ?></div>

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

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Descartar</button>

                <button type="button" class="btn btn-primary">Salvar</button>

            </div>

        </div>

    </div>

</div>


<!--Barra de navegação de cima -->

<ul class="nav nav-pills nav-justified nav-top barra">

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

<div class="container home my-2">

    <div class="row">

        <div class="col-sm-6 mb-3">

            <div class="card text-center fundo1" style="margin:1em auto; width: 97.3%">

                <div class="card-header fundo2" style="color:white">

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

            <div class="card text-center fundo1" style="margin:1em auto; width: 97.3%;">

                <div class="card-header fundo2" style="color:white">

                    Amigos

                </div>

                <div class="card-block">

                    <div class="container">

                        <?php $l = 0;

                        while ($l < $k) { ?>

                            <div class="row">

                                <div class="col">

                                    <p class="card-text nome-amigos"><?php if (isset($nickname_amigos[$l])) echo($nickname_amigos[$l]); ?></p>

                                </div>
                                <!-- icone online
                                <div class="col">

                                    <i class="material-icons icn-status" data-toggle="tooltip" data-placement="top"

                                       title="online">cloud</i>

                                </div>
                                -->
                                <div class="col">

                                    <button type="button" class="btn btn-primary btn-sm">Jogar</button>

                                </div>

                            </div>

                            <?php $l++;

                        } ?>

                    </div>

                </div>

            </div>

        </div>

        <div class="card mx-3 mb-3 fundo1" style="margin:1em auto; width: 97.3%">

            <div class="card-header text-center fundo2" style=" color:white">

                Notícias

            </div>

            <div class="card-block fundo 2">

                <h4 class="card-title"><?php if (isset($titulo)) echo($titulo); ?></h4>

                <p class="card-text "><?php if (isset($descricao)) echo($descricao); ?> <a href="#"> Clique aqui para

                        vê-la(o).</a></p>

                <div class="card-footer text-muted text-center fundo2" style=" color:white">

                    <p style="color:white;display: inline"><?php if (isset($data)) echo($data); ?></p>

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

                <div class="card text-center fundo1">

                    <img src="../img/avatar/<?php if (isset($avatar_imagem)) echo($avatar_imagem); ?> "

                         class="img-fluid img-thumbnail rounded mx-auto d-block rounded "

                         alt="Responsive image "

                         style="margin-top: 1em">

                    <div class="card-block">

                        <h4 class="card-title nome-jogador"

                            style='color:purple'><?php if (isset($nickname)) echo($nickname); ?></h4>

                    </div>

                    <div class="txt-perfil">

                        <div class='container'>

                            <div class="row">

                                <div class="col text-right">

                                    <p><?php if (isset($nivel)) {

                                            $nivel = $nivel - 1;

                                            echo($nivel);

                                        } ?></p>

                                </div>

                                <div class="col text-left">

                                    <img src="../img/icon/nivel.svg" alt="nivel" class="icone">

                                </div>

                            </div>

                            <div class="row">

                                <div class="col text-right">

                                    <p><?php if (isset($moedas)) echo($moedas); ?></p>

                                </div>

                                <div class="col text-left">

                                    <img src="../img/icon/coin.svg" alt="moeda" class="icone">

                                </div>

                            </div>

                            <div class="row">

                                <div class="col text-right">

                                    <p><?php if (isset($exp)) echo($exp); ?></p>

                                </div>

                                <div class="col text-left">

                                    <img src="../img/icon/xp.png" alt="xp" class="icone">

                                </div>

                            </div>

                        </div>

                        <div class="progress" style="width: 95%;margin:1.2em auto">

                            <div class="progress-bar " role="progressbar" style="width: 25%;height: 3em"

                                 aria-valuenow="25 " aria-valuemin="0 " aria-valuemax="100 "></div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-sm-8 text-center">

                <div class="card txt-info fundo1">

                    <div class="row">

                        <div class="col">

                            <p><img src="../img/icon/vitoria.svg" alt="vitoria"

                                    class="icone"> <?php if (isset($vitorias)) echo($vitorias); ?></p>

                        </div>

                        <div class="col">

                            <p><img src="../img/icon/derrota.svg" alt="vitoria"

                                    class="icone"> <?php if (isset($derrotas)) echo($derrotas); ?></p>

                        </div>

                    </div>

                    <table class="table table-bordered" style="font-size:.7em">

                        <tbody>

                        <tr>

                            <th scope="row" class="text-center">Idade</th>

                            <td>
                                <?php if (isset($idade)) echo($idade); ?>
                                <input style="display:none;" class="field" type="idade" id="idade" name="idade">
                            </td>

                        </tr>

                        <tr>

                            <th scope="row" class="text-center">Localização</th>

                            <td>
                                <?php if (isset($localizacao)) echo($localizacao); ?>
                                <input style="display:none;" class="field" type="local" id="local" name="local">
                            </td>

                        </tr>

                        <tr>

                            <th scope="row" class="text-center">Sexo</th>

                            <td>
                                <?php if (isset($sexo)) echo($sexo); ?>
                                <input style="display:none;" class="field" type="sexo" id="sexo" name="sexo">
                                <input style="display:none" id="id" value= <?php echo $id ?>>
                            </td>

                        </tr>

                        <tr>

                            <th scope="row" class="text-center">Email</th>

                            <td colspan="2"><?php if (isset($email)) echo($email); ?></td>

                        </tr>

                        </tbody>

                    </table>
                    <button type="button" class="btn btn-primary btn-enviar"
                            style="margin:1em auto 1em auto;width: 40%;display:none">

                        Enviar

                        Dados

                    </button>

                    <button type="button" class="btn btn-primary btn-editar"
                            style="margin:1em auto 1em auto;width: 40%">

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

<!-- adiciona os decks no inventário -->

<div class="container inventario my-3">

    <div class="container ">

        <div class="row ">


            <?php

            $j = 0;

            while ($j < $i) { ?>

                <div class="col-lg-3 col-md-4 col-xs-6 thumb ">

                    <a href="ConstDeck.php?id=<?php echo $IDdeck[$j] ?>">

                        <img class="img-fluid img-thumbnail "

                             src="../img/deck/<?php if (isset($Imagem_Deck[$j])) echo($Imagem_Deck[$j]); ?>" alt=" ">

                    </a>

                    <p class="text-center nome-carta "><?php if (isset($Nome_Deck[$j])) echo($Nome_Deck[$j]); ?>  </p>

                </div>

                <?php $j++;

            } ?>


        </div>

        <hr>

    </div>

    <!-- /.container -->

</div>

<div class="container loja mt-3 mb-5">

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

                            <img class="d-block img-fluid img-loja"

                                 src="../img/deck/<?php if (isset($Imagem_Pacote[0])) echo($Imagem_Pacote[0]);

                                 if (isset($Imagem_Skin[0])) echo($Imagem_Skin[0]);

                                 if (isset($Imagem_Carta[0])) echo($Imagem_Carta[0]); ?>"

                                 alt="First slide">

                        </div>

                        <div class="col-sm txt-loja">

                            <div>

                                <h3><?php if (isset($Nome_Pacote[0])) echo($Nome_Pacote[0]);

                                    if (isset($Nome_Skin[0])) echo($Nome_Skin[0]);

                                    if (isset($Nome_Carta[0])) echo($Nome_Carta[0]); ?></h3>

                                <p><?php if (isset($Descricao_Pacote[0])) echo($Descricao_Pacote[0]);

                                    if (isset($Descricao_Skin[0])) echo($Descricao_Skin[0]);

                                    if (isset($Descricao_Carta[0])) echo($Descricao_Carta[0]); ?></p>

                                <p><?php if (isset($preco_certo[0])) echo($preco_certo[0]); ?> <img

                                            src="../img/icon/coin.svg" alt="moeda" class="icone"></p>

                                <button type="button" class="btn btn-primary btn-mostrar" data-toggle="collapse"

                                        data-target="#collapseExample" aria-expanded="false"

                                        aria-controls="collapseExample">Mostrar Cartas

                                </button>

                                <button type="button" class="btn btn-danger">Comprar</button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <?php

            $aux = 1;

            while ($aux < $z) { ?>

                <div class="carousel-item ">

                    <div class="container">

                        <div class="row ">

                            <div class="col-sm">

                                <img class="d-block img-fluid img-loja"

                                     src="../img/deck/<?php if (isset($Imagem_Pacote[$aux])) echo($Imagem_Pacote[$aux]);

                                     if (isset($Imagem_Skin[$aux])) echo($Imagem_Skin[$aux]);

                                     if (isset($Imagem_Carta[$aux])) echo($Imagem_Carta[$aux]); ?>"

                                     alt="First slide">

                            </div>

                            <div class="col-sm txt-loja">

                                <div>

                                    <h3><?php if (isset($Nome_Pacote[$aux])) echo($Nome_Pacote[$aux]);

                                        if (isset($Nome_Skin[$aux])) echo($Nome_Skin[$aux]);

                                        if (isset($Nome_Carta[$aux])) echo($Nome_Carta[$aux]); ?></h3>

                                    <p><?php if (isset($Descricao_Pacote[$aux])) echo($Descricao_Pacote[$aux]);

                                        if (isset($Descricao_Skin[$aux])) echo($Descricao_Skin[$aux]);

                                        if (isset($Descricao_Carta[$aux])) echo($Descricao_Carta[$aux]); ?></p>

                                    <p><?php if (isset($preco_certo[$aux])) echo($preco_certo[$aux]); ?> <img

                                                src="../img/icon/coin.svg" alt="moeda" class="icone">

                                    </p>

                                    <button type="button" class="btn btn-primary btn-mostrar" data-toggle="collapse"

                                            data-target="#collapseExample" aria-expanded="false"

                                            aria-controls="collapseExample">Mostrar Cartas

                                    </button>

                                    <button type="button" class="btn btn-danger">Comprar</button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <?php $aux++;

            } ?>

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

        <div class="card card-block" style="color:black;margin:2em auto 4em auto">

            <?php


            $aux2 = 0;

            $query = "SELECT * FROM Cartas WHERE IDpacote= '$IDproduto[$aux2]'";

            $result = $conn->query($query);

            if ($result->num_rows > 0) {

                ?>


                <div class="row equal" style="height: ;">

                    <?php

                    while ($row = $result->fetch_assoc()) {

                        ?>

                        <div class="col-6 col-sm-4 col-md-4 col-xs-4 col-lg d-flex align-items-stretch">

                            <div class="carta" style="border:5px solid black;border-radius: 10px;">

                                <?php

                                $Nome_Carta[$aux2] = $row["Nome"];

                                $Descricao_Carta[$aux2] = $row["Descricao"];

                                $Imagem_Carta[$aux2] = $row["arquivo.sprite"];

                                $Ataque_Carta[$aux2] = $row["Ataque"];

                                $Vida_Carta[$aux2] = $row["Vida"];

                                ?>

                                <div class="nome" style="Height:5%">

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

                        </div>

                        <?php

                    }

                    ?>

                </div>


                <?php

            }

            ?>

        </div>


    </div>

</div>

<!--Footer -->

<nav class="navbar fixed-bottom navbar-light bg-faded nav-bottom barra">

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


            <button class="btn btn-primary" href="javascript:void(0)" onclick="toggleFullScreen()">

                <i class="material-icons" id="btn-fullscreen">fullscreen</i>

            </button>


        </div>

    </div>

</nav>


<span class="glyphicons-home" aria-hidden="true "></span>


<!--JQuery, Javascript para Bootstrap -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js">
    <
    script
    src = "https://code.jquery.com/jquery-3.1.1.slim.min.js "

    integrity = "sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n "

    crossorigin = "anonymous " ></script>

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