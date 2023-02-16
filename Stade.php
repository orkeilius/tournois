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
    <section>
        <?php $query = $db->prepare("SELECT * FROM `place`");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $elem) { ?>
            <div>
            <h3><?php echo $elem["name"] ?></h3>
            <p><?php echo $elem["description"] ?></p>
        </div>
        <?php } ?>

    </section>
</body>