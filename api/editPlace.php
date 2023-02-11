<?php
session_start();
include("../module/dbTools.php");
if (getUserAccess() != 0) {
    header("Location: /");
    return;
}

# 
$options = array(
    "name" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    "description" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    "operation" => FILTER_VALIDATE_INT
);

$result = filter_input_array(INPUT_POST, $options);
if (($result["operation"] == 2) and $result["name"] == "") {
    header("Location: /edit.php?error=valeurs&nbsp;invalid");
    return;
} elseif (($result["operation"] != 2) and in_array('', $result, true)) {
    header("Location: /edit.php?error=valeurs&nbsp;invalid");
    return;
}

#check if already exist
$query = $db->prepare("SELECT * FROM `place` WHERE `name`=?");
$query->bindParam(1, $result["name"]);
$query->execute();
$old =  $query->fetch();
if ($old != false) {
    if ($result["operation"] == 0) {
        header("Location: /edit.php?error=Le&nbsp;stade&nbsp;existe&nbsp;déjà");
        return;
    } else {
        $query = $db->prepare("DELETE FROM `place` WHERE `name`=?");
        $query->bindParam(1, $result["name"]);
        $query->execute();
    }
}
if ($result["operation"] == 2) {
    header("Location: /edit.php?info=stade&nbsp;supprimée&nbsp;avec&nbsp;succès");
    return;
}
var_dump($result);
$query = $db->prepare("INSERT INTO `place`(`Id`, `name`, `description`) VALUES (NULL,?,?);");
$query->bindParam(1, $result["name"]);
$query->bindParam(2, $result["description"]);
$query->execute();
$result =  $query->fetch();
header("Location: /edit.php?info=Stade&nbsp;crée&nbsp;avec&nbsp;succès");