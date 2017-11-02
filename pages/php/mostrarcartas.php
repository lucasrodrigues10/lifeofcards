<?php

include "db.php";

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
		
        $nome = ($_POST["nome"]);   
        
        //echo $nome;
    
          $query = "SELECT * FROM Pacote WHERE Nome = '$nome'";
			 $result = $conn->query($query);
			  $row = $result->fetch_assoc();
				  $id = $row["IDpacote"];
			  
				  
          $query = "SELECT * FROM Cartas WHERE IDpacote= '$id'";
            
            $result = $conn->query($query);
}
?>
      
<div class="card card-block" style="color:black;margin:2em auto 4em auto">

            <?php


            $aux2 = 0;
			
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