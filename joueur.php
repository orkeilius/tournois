<?php session_start();
include('module/dbTools.php');
?>
<!DOCTYPE html>
<html>

<head>
    <?php include("module/head.php") ?>
    <link rel="stylesheet" href="style/list.css">
</head>

<body>
    <?php include("module/header.php"); ?>
    <section class="wrapper">
        <?php $query = $db->prepare("SELECT * FROM `player`");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $elem) { ?>
            <div>
                <h3><?php echo $elem["firstName"] . " " . $elem["lastName"] ?></h3>
                <p><?php echo $elem["country"] ?></p>
            </div>
            <?php } ?>

    </section>
</body>