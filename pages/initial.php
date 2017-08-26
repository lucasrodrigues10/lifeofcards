<?php
    require 'php/db.php';
    session_start();
?>
    <!DOCTYPE html>
    <html>

    <head>
        <?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        if (isset($_POST['login'])) { //user logging in

            require 'php/login.php';
            
        }
        
        elseif (isset($_POST['register'])) { //user registering
            
            require 'php/register.php';
            
        }
    }
    ?>
        <link rel="shortcut icon" type="image/x-icon" href="../img/icon/favicon.ico" />
        <title>
            3Life Of Cards
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
                        <div class="btn-group btn-group-lg .btn-group-justified" data-toggle="buttons">
                            <label class="btn btn-primary active " id="opt-log">
                                <input type="radio" name="options" id="option1" autocomplete="off" checked> Entrar
                            </label>
                            <label class="btn btn-primary " id="opt-reg">
                                <input type="radio" name="options" id="option2" autocomplete="off"> Registrar
                            </label>
                        </div>
                    </div>
                    <form action="php/register.php" method="post">
                        <div class="form-group">
                            <input type="email" class="form-control form-email" style="display:none;" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="E-mail" name="email" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Usuário" name="username" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Senha" name="password" required>
                        </div>
                        <div class="row">
                            <div class="col-sm-12" style="text-align: center;">
                                <button type="submit" class="btn btn-danger btn-lg" id="bot-reg" style="display:none;" value="Submit" name="register">Registrar</button>
                            </div>
                        </div>
                        <a href="main.html">
                            <div class="row">
                                <div class="col-sm-12" style="text-align: center">
                                    <button type="submit" class="btn btn-danger btn-lg" id="bot-log" name="login">Entrar</button>
                                </div>
                            </div>
                        </a>
                        <div class="row">
                            <div class="col-sm-12" style="text-align: center">
                                <button type="button" class="btn btn-link" id="bot-esq">Esqueceu a senha?</button>
                            </div>
                        </div>
                    </form>
                    <p id="registro-erro" style="display:none"> Usuário/Email já registrado!</p>
                </div>
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