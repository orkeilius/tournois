<?php
if(! isset($_GET["error"])){
    $_GET["error"] = NULL;
}
try{
    $db = new PDO('mysql:dbname=tournoi;host=127.0.0.1', "root", "");
} catch(PDOException $e){
    die ("DB Error".$e);
}
function getUserAccess(){
    if (! isset($_SESSION["user"])){
        return 99;
    }
    global $db;
    $query = $db->prepare("SELECT `userAccess` FROM `admin` WHERE `userName` =  ?");
    $query->bindParam(1,$_SESSION["user"]);
    $query->execute();
    $result =  $query->fetch();
    return $result["userAccess"];
}
