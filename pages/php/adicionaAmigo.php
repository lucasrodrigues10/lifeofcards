<?php

include "db.php";
session_start();

$situacao = "invalido";
$amigo = (int)$_REQUEST["amigo"];
$ID = $_SESSION["id"];

$query = "SELECT * FROM UsuarioNoJogo WHERE IDusuario = '$amigo'";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nickname = $row['Nickname'];
    }
}

if ($conn->connect_error) {
    $situacao = "invalido";
} else {
    if ($result->num_rows > 0) {
        $situacao = "valido";
    } else {
        $situacao = "invalido";
    }
}

if ($situacao == "valido") {
    $query = "INSERT INTO Amizades (IDusuario, Nickname) VALUES ('$ID','$nickname');";
    $result = $conn->query($query);
}

echo $situacao;

$conn->close();

