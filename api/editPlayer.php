<?php
session_start();
include("../module/dbTools.php");
if (getUserAccess() != 0) {
    header("Location: /");
    return;
}

# 
$options = array(
    "firstName" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    "lastName" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    "country" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    "operation" => FILTER_VALIDATE_INT
);

$result = filter_input_array(INPUT_POST, $options);
if (($result["operation"] == 2) and ($result["firstName"] == "" or $result["lastName"] == "")) {
    header("Location: /edit.php?error=valeurs%20invalide");
    return;
} elseif (($result["operation"] != 2) and in_array('', $result, true)) {
    header("Location: /edit.php?error=valeurs%20invalide");
    return;
}

#check if already exist
$query = $db->prepare("SELECT * FROM `player` WHERE `firstName`=? AND `lastName`=?");
$query->bindParam(1, $result["firstName"]);
$query->bindParam(2, $result["lastName"]);
$query->execute();
$old =  $query->fetch();
if ($old != false) {
    if ($result["operation"] == 0) {
        header("Location: /edit.php?error=Le%20joueur%20existe%20déjà");
        return;
    } else {
        $query = $db->prepare("DELETE FROM `player` WHERE `firstName`=? AND `lastName`=?");
        $query->bindParam(1, $result["firstName"]);
        $query->bindParam(2, $result["lastName"]);
        $query->execute();
    }
}
if ($result["operation"] == 2) {
    header("Location: /edit.php?info=Joueur%20supprimée%20avec%20succès");
    return;
} 
$query = $db->prepare("INSERT INTO `player`(`Id`, `firstName`, `lastName`, `country`) VALUES (NULL,?,?,?);");
$query->bindParam(1, $result["firstName"]);
$query->bindParam(2, $result["lastName"]);
$query->bindParam(3, $result["country"]);
$query->execute();
$result =  $query->fetch();
header("Location: /edit.php?info=Joueur%20crée%20avec%20succès");
