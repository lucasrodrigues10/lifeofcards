<?php

$NomeCarta = array();
$QtdeCarta = array();


$NomeCarta = $_POST['carta'];

$QtdeCarta = $_POST['QtdeCarta'];

print_r($_POST);

echo implode(", ", $NomeCarta);
echo implode(", ", $QtdeCarta);

?>