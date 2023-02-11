<?php
session_start();
include("../module/dbTools.php");

$query = $db->prepare("SELECT * FROM `admin` WHERE `userName` = ?;");
$query->bindParam(1, htmlspecialchars($_POST["username"]));
$query->execute();
$result = $query->fetch();

if (password_verify(htmlspecialchars($_POST["password"]), $result["userPassword"])) {
    $_SESSION["user"] = $result["userName"];
    header("Location: /");
} else {
    header("Location: /?error=login");
}