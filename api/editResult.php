<?php
session_start();
include("../module/dbTools.php");
if (getUserAccess() != 0) {
    header("Location: /");
    return;
}

# 
$options = array(
    "game" => FILTER_VALIDATE_INT,
    "score1" => FILTER_VALIDATE_INT,
    "score2" => FILTER_VALIDATE_INT
);

$result = filter_input_array(INPUT_POST, $options);
if (in_array('', $result, true) or in_array(NULL, $result, true)) {
    header("Location: /edit.php?error=valeurs%20invalide");
    return;
}

#check if already exist
$query = $db->prepare("SELECT * FROM `game` WHERE `id`=?");
$query->bindParam(1, $result["game"]);
$query->execute();
$old =  $query->fetch();
if ($old["done"] == 1) {
    header("Location: /edit.php?error=Le%20resultat%20existe%20déjà");
    return;
}
var_dump($result);
$query = $db->prepare("UPDATE `game` SET `done`=1,`score1`=?,`score2`=? WHERE id = ?");
$query->bindParam(1, $result["score1"]);
$query->bindParam(2, $result["score2"]);
$query->bindParam(3, $result["game"]);
$query->execute();
$result =  $query->fetch();
header("Location: /edit.php?info=resulta%20ajouté%20avec%20succès");
