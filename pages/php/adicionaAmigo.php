<?php

include "db.php";
session_start();

$amigo = "raul";

$query = "SELECT * FROM Usuario WHERE Login = '$amigo'";
$result = $conn->query($query);

// Check connection
if ($conn->connect_error) {
    echo "invalido";
} else {
    if ($result->num_rows > 0) {
        echo "valido";
    } else {
        echo "invalido";
    }
}
$conn->close();

