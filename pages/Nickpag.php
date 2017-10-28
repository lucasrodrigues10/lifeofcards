<?php
	session_start();

    

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <!--CSS do projeto -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body class="full">
    <div class="container">
        <div class="jumbotron">
            <div class="container">
                <div class="col-md-12 text-center">
                    <h3> Opa, vimos que é sua primeira vez aqui! Escolha seu nickname!</h3>
                </div>
                <!-- Formulario para registro -->
                <form role="form" action="php/Nickreg.php" method="post" id="form-reg">
                    <div class="form-group">
                        <input class="form-control" placeholder="Nickname" name="nickname" required> </div>
                    <div class="row">
                        <div class="col-sm-12" style="text-align: center;">
                            <button type="submit" class="btn btn-danger btn-lg" id="bot-reg" value="Submit" name="submit">Entrar no Jogo</button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
    </div>
    <!--JQuery, Javascript para Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="../js/login.js"></script>
</body>

</html>