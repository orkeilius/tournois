<?php
session_start();
include_once "model/utils/dbConnection.php";

$db = DbConnection::getConnection();

$url = trim($_GET["url"],"/");

ob_start()
?>

<head>
    <?php include_once "template/head.php"; ?>
</head>

<body>
    <?php
    include_once "template/header.php";
    switch ($url) {
        case 'login':
            include_once "controller/login.php";
            break;
        case 'logout':
            include_once "controller/logout.php";
            break;
        case 'admin':
        case 'admin/user':
            if(DbConnection::isUserAdmin()){
                include_once "controller/admin/user.php";
                break;
            }
        default:
            include_once "controller/home.php";
            break;
    }
    ;
    ?>
</body>

<?php $content = ob_get_flush();