<?php
session_start();
var_dump($_GET["url"]);
include_once "model/utils/dbConnection.php";

include_once "template/head.php";
include_once "template/header.php";

$db = DbConnection::getConnection();

?>

<body>
    <?php
    switch ($_GET["url"]) {
        case 'login':
            include_once "controller/login.php";
            break;
        case 'logout':
            include_once "controller/logout.php";
            break;

        default:
            include_once "controller/home.php";
            break;
    }
    ;
    ?>
</body>