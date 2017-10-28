<?php

session_start();

session_destroy();

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

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
          integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <!--CSS do projeto -->

    <link rel="stylesheet" type="text/css" href="../css/style.css">

</head>


<body class="full">

<div class="container">

    <div class="jumbotron" style="background-color:#c9c9c9">
        <h1 class="display-3 text-center">Login Invalido</h1>
        <p class="lead text-center">A senha ou usuario informado nao e valido, tente novamente. </p>
        <p class="lead text-center">
            <a class="btn btn-primary btn-lg" href="login.php" role="button">Voltar</a>
        </p>
    </div>

</div>


<!--JQuery, Javascript para Bootstrap -->

<script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
        integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
        crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
        crossorigin="anonymous"></script>

<script src="../js/login.js"></script>

</body>


</html>