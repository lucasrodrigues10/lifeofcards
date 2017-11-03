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

$IDcarta = array();


$b = rtrim($NomeGeneral, "  "); // Remove ultimo espaço do nome carta
$b = ltrim($b, " "); // Remove primeiro espaço do nome carta
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

?>