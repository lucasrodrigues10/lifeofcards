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
    <!-- deixar jquery em cima pra não bugar o phaser-->
    <script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
    
   <!-- Phaser -->
    <script src="https://cdn.jsdelivr.net/npm/phaser-ce@2.8.3/build/phaser.js"></script>
    <script src="../js/functions.js"></script>
    <script type="text/javascript" src="jogo.js"></script>
    <script src="../js/HealthBar.standalone.js"></script>

   

    <!--Icones do google -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


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
            height: 60%;
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
        <a id="terminar-jogada" href="#" onclick="trocaTurno()">Terminar jogada</a>
    </div>
    <div style="background-color: green;width: 30%" id="right">
        <?php
		include "php/db.php";
		$deckId = $_POST['deckID']; 
			$query = "SELECT Cartas.IDcarta, Cartas.`arquivo.sprite`, Cartas.Ataque, Cartas.Vida, Cartas.Descricao, Cartas.Nome, Cartas_Deck.QtdeCartas FROM Cartas 
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
					$deck[$i][2] = $row["Ataque"];
					$deck[$i][3] = $row["Vida"];
					$deck[$i][4] = $row["Descricao"];
    				$deck[$i][5] = $row["Nome"];
					while($qtd > 1)
					{
						$i++;
						$deck[$i][0] = $row["IDcarta"];
						$deck[$i][1] = $row["arquivo.sprite"];
    					$deck[$i][2] = $row["Ataque"];
    					$deck[$i][3] = $row["Vida"];
    					$deck[$i][4] = $row["Descricao"];
    					$deck[$i][5] = $row["Nome"];
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
                <div class="carta" alt="<?php echo $a ?>">
                      <img style="height:100%;width:100%"
    				  src="../img/cartas/<?php echo $deck[$a][1] ?> ">
                </div>
	        </div>
    		<?php 
    		}
    		?>
		  </div>
        </div>
        	<?php 
    		for($a=0;$a<5;$a++)
    		{?>
        <div class="info <?php echo $a?>" style="display:none">
 	        <div class="nome" style="Height:5%">
                <p style="text-align: left; font-weight: bold;"> <?php echo $deck[$a][5] ?> </p>
            </div>
            
            <div class="descricao" style="Height:35%;border:1px solid black;margin: 2%;padding:2%;">
                <p style="text-align: left"><?php echo $deck[$a][4] ?></p>
            </div>

            <div class="stats" style="Height:5%;padding-right:2%;">
                <p style="text-align: right"><?php echo $deck[$a][2] ?>
                    / <?php echo $deck[$a][3] ?></p>
            </div>	
        </div>
            <?php 
    		}
    		?>
        <!-- <img src="/img/banner-mc.jpg" class="img-fluid" alt="Responsive image"> -->
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
</body>
<!-- Fullscreen script -->
<script type="text/javascript" src="../js/fullscreen.js"></script>

<script type="text/javascript">
$(document).ready(function () {
    $('.carta').click(function () {
        var a = $(this).attr("alt");
     	$('.info').hide();
 	    $('.'+a).show();
    });

});

document.body.addEventListener
    (
        'touchmove',
        function (e) {
            e.preventDefault();
        }
    );
</script>

</html>