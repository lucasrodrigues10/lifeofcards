<?php
	require_once("system/config.php"); //inlucde, mas não carrega a página se falhar

	if($manutencao){
		echo "Site em manutencao";		
	}else{
		?>
<!DOCTYPE html>
<html>

<head>
  <link rel="shortcut icon" type="image/x-icon" href="img/icon/favicon.ico" />
    <title><?php echo $title.$seperator.$description;?></title>
    <!--Ter todos os simbolos -->
    <meta charset="utf-8">
    <!--Zoom em tablets/mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--Boostrap 4.0 CDN -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
  
</head>

<body class="full">
    <div class="container">
        <div class="jumbotron">
            <div class="container">
                <div class="col-md-12 text-center">
                    <div class="btn-group btn-group-lg .btn-group-justified" data-toggle="buttons">
                        <label class="btn btn-primary active " id="opt-log">
                            <input type="radio" name="options" id="option1" autocomplete="off" checked> Entrax
                        </label>
                        <label class="btn btn-primary " id="opt-reg">
                            <input type="radio" name="options" id="option2" autocomplete="off"> Registrax
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control form-email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="E-mail">
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Usuário">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Senha">
                </div>
                <a href="main.html">
                    <div class="row">
                        <div class="col-sm-12" style="text-align: center">
                            <button type="button" class="btn btn-danger btn-lg" id="bot-log">Entrar</button>
                        </div>
                    </div>
                </a>
                <div class="row">
                    <div class="col-sm-12" style="text-align: center">
                        <button type="button" class="btn btn-danger btn-lg" id="bot-reg">Registrar</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12" style="text-align: center">
                        <button type="button" class="btn btn-link" id="bot-esq">Esqueceu a senha?</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!--JQuery, Javascript para Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="js/login.js"></script>
</body>

</html>

		<?php
	}
?>
