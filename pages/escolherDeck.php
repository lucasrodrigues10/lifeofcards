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

        $Descricao_Deck[$i] = $row["Descricao"];

        $Imagem_Deck[$i] = $row["ImagemDeck"];


        //Pega numero de cartas para setar limite 20
        $query2 = "SELECT * FROM Cartas_Deck WHERE IDDeck = '$IDdeck[$i]'";
        $result2 = $conn->query($query2);
        if ($result2->num_rows > 0) {

            while ($row2 = $result2->fetch_assoc()) {
                $QtdeCartas[$i] = $row2["QtdeCartas"];
            }

        }


        $i++;

    }

}


$NovoDeck = -1;

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


$IDproduto = array();

$Tabnum = array();

$IDpromocao = array();

$preco = array();

$preco_certo = array();

$valor = 0;

$query = "SELECT * FROM Loja";

$result = $conn->query($query);

$z = 0;


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

    <!-- Icone do site http://game-icons.net/ -->
    <link rel="shortcut icon" type="image/x-icon" href="../img/icon/logo.ico"/>

    <title>

        Life of Cards

    </title>

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

    <style>
        .checked {
            border: .5rem solid red;
        }
    </style>

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

<!-- adiciona os decks no inventário -->
<div class="row-lg-6 inventario">
    <div class="container inventario my-3">

        <div class="container ">

            <div class="row ">
                <?php
                $j = 0;
                while ($j < $i) { ?>
                    <!-- codigo do lucas -->
                    <?php if (isset($IDdeck[$j]) AND $QtdeCartas[$j] >= 2) { ?>
                        <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                            <img data-deck="<?php echo $IDdeck[$j] ?>"
                                 class="deck-escolhido img-fluid img-thumbnail "
                                 src="../img/cartas/<?php if (isset($Imagem_Deck[$j])) echo($Imagem_Deck[$j]); ?>"
                                 alt=" ">
                            <p class="text-center nome-carta "><?php echo $Nome_Deck[$j]; ?> </p>
                        </div>
                    <?php } ?>
                    <!-- codigo do raul
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb ">

                        <a href="ConstDeck.php?id=<?php echo $IDdeck[$j] ?>">

                            <img class="img-fluid img-thumbnail "

                                 src="../img/cartas/<?php if (isset($Imagem_Deck[$j])) echo($Imagem_Deck[$j]); ?>"
                                 alt=" ">

                        </a>

                        <p class="text-center nome-carta "><?php if (isset($Nome_Deck[$j])) echo($Nome_Deck[$j]); ?>  </p>

                    </div>
                    -->
                    <?php $j++;
                }
                ?>


            </div>

            <hr>

        </div>

        <!-- /.container -->
    </div>
    <!-- Fim da exibição dos decks -->
</div>
<!-- Exibição Botão Criar Deck -->
<div class="row">
    <div class="col text-center" id="deck-jogar">
        <button class="btn btn-primary btn-lg ">Jogar</button>
    </div>
</div>


<!--JQuery, Javascript para Bootstrap -->

<script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>

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
<script type="text/javascript" src="../js/jquery.redirect/jquery.redirect.js"></script>

<script>

    $(document).ready(function () {
        $('.inventario').show();
        var deckChecked;

        $(".deck-escolhido").on('click', (function () {
            $(".deck-escolhido").removeClass("checked");
            $(this).addClass("checked");
            deckChecked = $(this).attr('data-deck');
        }));


        $("#deck-jogar").on('click', (function () {
            $.redirect('jogo.php', {'deckID': deckChecked}, 'post');
        }));
    });
</script>

</body>


</html>