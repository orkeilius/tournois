<?php session_start();
include('module/dbTools.php');
?>
<!DOCTYPE html>
<html>

<head>
    <?php include("module/head.php") ?>
</head>

<body>
    <?php include("module/header.php"); ?>
    <section>
        <?php $query = $db->prepare("SELECT * FROM `player`");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $elem) {
            echo $elem["firstName"] . " | " . $elem["lastName"] . " | " . $elem["country"] . "<br>";
        }
        1
        ?>

    </section>
</body>