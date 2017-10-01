<?php

include "db.php";

$email = $_REQUEST['email'];
$query = "SELECT * FROM Usuario WHERE Email = '$email'";
$result = $conn->query($query);


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  // Checa se a sintaxe do email é válida
    echo "invalido";
} else if($result->num_rows >0){ // Checa se ja tem o email no banco de dados
    echo "invalido";
} else {
    echo "valido";
}

$conn->close();
