<?php

function login()
{
    if (!isset($_POST["username"])) {
        return;
    }
    if (!isset($_POST["password"])) {
        return;
    }
    
    $db = DbConnection::getConnection();
    $query = $db->prepare("SELECT * FROM `admin` WHERE `user` = ?;");
    $query->bindParam(1, htmlspecialchars($_POST["username"]));
    $query->execute();
    $result = $query->fetch();
    if (password_verify(htmlspecialchars($_POST["password"]), $result["password"])) {
        $_SESSION["user"] = $result["user"];
        header("Location: admin");
    } else {
        header("Location: login/?error=login");
    }
}
login();

include_once "template/page/login.php";






