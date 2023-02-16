<?php
session_start();
include("../module/dbTools.php");
if (getUserAccess() != 0) {
    header("Location: /");
    return;
}

# 
$options = array(
    "date" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    "player1" => FILTER_VALIDATE_INT,
    "player2" => FILTER_VALIDATE_INT,
    "commentator" => FILTER_VALIDATE_INT,
    "place" => FILTER_VALIDATE_INT,
    "operation" => FILTER_VALIDATE_INT
);

$result = filter_input_array(INPUT_POST, $options);
if (($result["operation"] == 2) and ($result["player1"] == "" or $result["player2"] == "")) {
    header("Location: /edit.php?error=valeurs&nbsp;invalid");
    return;
} elseif (($result["operation"] != 2) and (in_array('', $result, true) or in_array(NULL, $result, true))) {
    header("Location: /edit.php?error=valeurs&nbsp;invalid");
    return;
}

#check if already exist
$query = $db->prepare("SELECT * FROM `game` WHERE `player1`=? AND `player2`=?");
$query->bindParam(1, $result["player1"]);
$query->bindParam(2, $result["player2"]);
$query->execute();
$old =  $query->fetch();
if ($old != false) {
    if ($result["operation"] == 0) {
        header("Location: /edit.php?error=Le&nbsp;match&nbsp;existe&nbsp;déjà");
        return;
    } else {
        $query = $db->prepare("DELETE FROM `player` WHERE `player1`=? AND `player2`=?");
        $query->bindParam(1, $result["player1"]);
        $query->bindParam(2, $result["player2"]);
        $query->execute();
    }
}
if ($result["operation"] == 2) {
    header("Location: /edit.php?info=match&nbsp;supprimée&nbsp;avec&nbsp;succès");
    return;
}
$query = $db->prepare("INSERT INTO `game`(`id`, `DATE`, `score1`, `score2`, `done`, `player1`,`player2`, `place`, `commentator`) VALUES (NULL,?,0,0,0,?,?,?,?)");
$query->bindParam(1, $result["date"]);
$query->bindParam(2, $result["player1"]);
$query->bindParam(3, $result["player2"]);
$query->bindParam(4, $result["place"]);
$query->bindParam(5, $result["commentator"]);
$query->execute();
$result =  $query->fetch();
header("Location: /edit.php?info=match&nbsp;crée&nbsp;avec&nbsp;succès");
