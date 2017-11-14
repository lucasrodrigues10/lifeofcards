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
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="viewport"
          content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, shrink-to-fit=no">


    <!--Boostrap 4.0 CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
          integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <!--Site CSS -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <!-- Jogo CSS -->
    <link rel="stylesheet" type="text/css" href="../css/jogo.css">
    <!--
    <link rel="stylesheet" type="text/css" href="../css/jogo.css">


    <!-- Phaser -->
    <script src="https://cdn.jsdelivr.net/npm/phaser-ce@2.8.3/build/phaser.js"></script>
    <script src="../js/functions.js"></script>
    <script src="../js/HealthBar.standalone.js"></script>
    <script type="text/javascript" src="jogo.js"></script>
    
    
    <!--Icones do google -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>

    <style>
        html, body, #ct, #ct > div {
            height: 100%;
        }

        #ct > div {
            float: left;
        }

        .carta {

        }

        #ct-cartas {
            overflow: scroll;
            height: 40%;
        }
        .carta > img{
            width: 33%;
        }
        #left > button, #right {
            display: block;
            margin: auto;
            width: 40%;
            height: auto;
        }
    </style>
</head>


<body>
<div id="ct">
    <div id="left" style="background-color: red;width: 10%;">
        <button class="btn btn-warning" href="javascript:void(0)" onclick="toggleFullScreen()">
            <i class="material-icons" id="btn-fullscreen">fullscreen</i>
        </button>
    </div>
    <div style="background-color: blue;width: 60%" id="center">    
        <div><a id="terminar-jogada" href="#">Terminar jogada</a> </div>     
    </div>
    <div style="background-color: green;width: 30%" id="right">
        <?php
		include "php/db.php";
		$deckId = $_POST['deckID']; 
			$query = "SELECT Cartas.IDcarta, Cartas.`arquivo.sprite`, Cartas_Deck.QtdeCartas FROM Cartas 
			INNER JOIN Cartas_Deck ON Cartas.IDcarta=Cartas_Deck.IDcarta WHERE Cartas_Deck.IDdeck = '$deckId'";	   
            $result = $conn->query($query);
			$i=0;
			$deck = array();
			if ($result->num_rows > 0) 
			{
			  while($row = $result->fetch_assoc())
			  {
					$qtd = $row["QtdeCartas"];
					$deck[$i][0] = $row["IDcarta"];
					$deck[$i][1] = $row["arquivo.sprite"];
					while($qtd > 1)
					{
						$i++;
						$deck[$i][0] = $row["IDcarta"];
						$deck[$i][1] = $row["arquivo.sprite"];
						$qtd--;
					}
					$i++;
			  }
			}
			shuffle($deck);
			//$x=0;for ($x =0;$x< 20;$x++)	{echo $deck[$x][0];echo ' ';} echo '<br>';
			//$x=0;for ($x =0;$x< 20;$x++)	{echo $deck[$x][1];echo ' ';} echo '<br>';
		?>
        <div id="ct-cartas">
		<div class ="row">
		<?php 
		for($a=0;$a<5;$a++)
		{?>
	<div class="col-sm-5">
            <div class="carta">
                  <img style="height:100%;width:100%"
				  src="../img/cartas/<?php echo $deck[$a][1] ?> ">
            </div>
	  </div>
		<?php 
		}
		?>
		  </div>
        </div>
        <img src="/img/banner-mc.jpg" class="img-fluid" alt="Responsive image" >

    </div>
</div>

<script>
    document.body.addEventListener
    (
        'touchmove',
        function (e) {
            e.preventDefault();
        }
    );
</script>
<!--JQuery, Javascript para Bootstrap -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
        integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
        crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
        crossorigin="anonymous"></script>
</body>
<!-- Fullscreen script -->
<script type="text/javascript" src="../js/fullscreen.js"></script>


</html>