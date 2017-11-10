<?php
session_start();
include "db.php";
if (empty($_SESSION["id"])) {
    header("Location: login.php");
}
$id = $_SESSION["id"];
$NomeCarta = array();
$QtdeCarta = array();

$NomeCarta = $_POST['carta'];
$QtdeCarta = $_POST['QtdeCarta'];
$NomeGeneral = $_POST['General'];
$IDdeck = $_POST['DeckID'];
$NomeDeck = $_REQUEST['NomeDeck'];

//Coloca nome do deck no banco

if(isset($NomeDeck)){

    if($IDdeck != -1){
        $query = "UPDATE DeckUsuario SET Nome='$NomeDeck' WHERE IDdeck='$IDdeck'";
        if ($conn->query($query) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
    else{
        $query = "INSERT INTO DeckUsuario (IDusuario, Nome) VALUES ('$id', '$NomeDeck')";
        if ($conn->query($query) === TRUE) {
            echo "Record inserted successfully";
        } else {
            echo "Error inserting record: " . $conn->error;
        }
    }

}

$IDcarta = array();

$b = rtrim($NomeGeneral, "     "); // Remove ultimo espaço do nome carta
$b = ltrim($b, "    "); // Remove primeiro espaço do nome carta

if($IDdeck == -1){
    $IDTemp = array();
        $i = 0;

        $query = "SELECT IDdeck FROM DeckUsuario WHERE IDusuario = '$id'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $IDTemp[$i] = $row["IDdeck"];
                $i++;
            }
        }

        $IDdeck = $IDTemp[$i-1];
}

//Insere General escolhido no banco e recupera o ID do novo deck

if($b == "Ananias"){
    $query = "UPDATE DeckUsuario SET Descricao = 'Deck Criado', ImagemDeck = '10.jpg' WHERE IDdeck = '$IDdeck'";
    if ($conn->query($query) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

if($b == "Jonas"){
    $query = "UPDATE DeckUsuario SET Descricao = 'Deck Criado', ImagemDeck = '11.jpg' WHERE IDdeck = '$IDdeck'";
    if ($conn->query($query) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

if($b == "Mamonas"){
    $query = "UPDATE DeckUsuario SET Descricao = 'Deck Criado', ImagemDeck = '12.jpg' WHERE IDdeck = '$IDdeck'";
    if ($conn->query($query) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

/* Deleta dados anteriores do banco */
$query = "DELETE FROM Cartas_Deck WHERE IDdeck ='$IDdeck'";
if ($conn->query($query) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

/* Adiciona novos dados ao banco */


$query = "SELECT IDcarta FROM Cartas WHERE Nome = '$b'";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $IDGeneral = $row["IDcarta"];
}

$query = "INSERT INTO Cartas_Deck (IDdeck, IDcarta, QtdeCartas) VALUES ('$IDdeck', '$IDGeneral', '1')";
if ($conn->query($query) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

$aux = 0;
$x = sizeof($NomeCarta);

while($aux < $x){
    $b = rtrim($NomeCarta[$aux], "  "); // Remove ultimo espaço do nome carta
    $b = ltrim($b, " "); // Remove primeiro espaço do nome carta
    $query = "SELECT IDcarta FROM Cartas WHERE Nome = '$b'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $IDcarta[$aux] = $row["IDcarta"];
    }
    $aux++;
}

$aux = 0;

while ($aux < $x){
    $query = "INSERT INTO Cartas_Deck (IDdeck, IDcarta, QtdeCartas) VALUES ('$IDdeck', '$IDcarta[$aux]', '$QtdeCarta[$aux]')";
    if ($conn->query($query) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
    $aux++;
}

$conn->close();

?>
<script> location.replace("../ConstDeck.php?id=<?php echo ($IDdeck)?>"); </script>