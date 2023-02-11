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
        <div class="center">
            <h2>log in</h2>
            <form class="formCenter" action="api/login.php" method="post">
                <input type="text" class="entry" id="username" name="username" placeholder="username" required><br>
                <input type="password" class="entry" id="password" name="password" placeholder="password" required><br>
                <input type="submit" value="se connecter">
            </form>
        </div>
    </section>
</body>