<?php session_start();
include 'module/dbTools.php';


if (getUserAccess() != 0) {
    header("Location: /");
    return;
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php include 'module/head.php'; ?>
    <link rel="stylesheet" href="style/tab.css">
</head>

<body>
    <?php include 'module/header.php'; 
    if(isset($_GET["error"])){ ?>
        <button class="toast error">
            <?php echo $_GET["error"] ?> 
        </button>
    <?php }  else if(isset($_GET["info"]))  { ?>
        <button class="toast info">
            <?php echo $_GET["info"] ?> 
        </button>
    <?php } ?>


    <section>
        <div class="tab">
            <button class="tablinks" onclick="changeTab(event, 'match')">Ajouter un match</button>
            <button class="tablinks" onclick="changeTab(event, 'resultat')">Ajouter un resultat</button>
            <button class="tablinks" onclick="changeTab(event, 'joueur')">Ajouter un joueur</button>
            <button class="tablinks" onclick="changeTab(event, 'stade')">Ajouter un stade</button>
            <button class="tablinks" onclick="changeTab(event, 'commentateur')">Ajouter un commentateur</button>
        </div>

        <div id="match" class="tabcontent">
            <h3>Ajouter un match</h3>
            <form action="api/editGame.php" method="post">
                <label for="date">jour</label><br>
                <input name="date" type="date"><br>
                <label for="player1">joueurs </label><br>
                <select name="player1" require>
                    <?php
                    $query = $db->prepare('SELECT * FROM `player`');
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($results as $elem) {
                        echo "<option value='" .
                            $elem['id'] .
                            "'>" .
                            $elem['firstName'] .
                            ' ' .
                            $elem['lastName'] .
                            '</option>';
                    }
                    1;
                    ?>
                </select>
                <select name="player2" require>
                    <?php
                    foreach ($results as $elem) {
                        echo "<option value='" .
                            $elem['id'] .
                            "'>" .
                            $elem['firstName'] .
                            ' ' .
                            $elem['lastName'] .
                            '</option>';
                    }
                    1;
                    ?>
                </select><br>
                <label for="commentator">commentateur</label><br>
                <select name="commentator">
                    <?php
                    $query = $db->prepare('SELECT * FROM `commentator`');
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($results as $elem) {
                        echo "<option value='" .
                            $elem['id'] .
                            "'>" .
                            $elem['firstName'] .
                            ' ' .
                            $elem['lastName'] .
                            '</option>';
                    }
                    ?>
                </select><br>
                <label for="place">stade</label><br>
                <select name="place">
                    <?php
                    $query = $db->prepare('SELECT * FROM `place`');
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($results as $elem) {
                        echo "<option value='" .
                            $elem['id'] .
                            "'>" .
                            $elem['name'] .
                            '</option>';
                    }
                    ?>
                </select><br>
                <label for="operation">opération</label><br />
                <select name="operation">
                    <option value="0">ajouter</option>
                    <option value="1">modifier</option>
                    <option value="2">supprimer</option>
                </select>
                <input type="submit" value="envoyer">

            </form>
        </div>
        
        <div id="resultat" class="tabcontent">
            <h3>Ajouter un resultat</h3>
            <form action="api/editResult.php" method="post">
            <label for="game">match</label><br /> 
            <select name="game" require>
                    <?php
                    $query = $db->prepare('SELECT game.id as id, p1.firstName as p1_first, p1.lastName as p1_last, 
                                           p2.firstName as p2_first, p2.lastName as p2_last 
                                           FROM `game` 
                                           LEFT JOIN `player` p1 ON(game.player1 = p1.id) 
                                           LEFt JOIN `player` p2 ON(game.player2 = p2.id)
                                           where game.done = 0
                    ');
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($results as $elem) {
                        echo "<option value='" .
                            $elem['id'] .
                            "' > " .
                            $elem['p1_last'] . " " . $elem['p1_first'] .
                            " vs " .
                            $elem['p2_last'] . " " . $elem['p2_first'] . 
                            '</option>';
                    };
                    ?>
                </select><br>
                <label for="game">score</label><br /> 
                <input name="score1" type="number" placeholder="score du joueur 1" require>
                <input name="score2" type="number" placeholder="score du joueur 2" require><br>
                <input type="submit" value="envoyer">
            </form>
        </div>

        <div id="joueur" class="tabcontent">
            <h3>Ajouter un joueur</h3>
            <form action="api/editPlayer.php" method="post">
                <input name="lastName" type="text" placeholder="nom" require>
                <input name="firstName" type="text" placeholder="prenom" require><br>
                <input name="country" type="text" placeholder="pays"><br>
                <label for="operation">opération</label><br />
                <select name="operation">
                    <option value="0">ajouter</option>
                    <option value="1">modifier</option>
                    <option value="2">supprimer</option>
                </select>
                <input type="submit" value="envoyer">
            </form>
        </div>

        <div id="stade" class="tabcontent">
            <h3>Ajouter un stade</h3>
            <form action="api/editPlace.php" method="post">
                <input name="name" type="text" placeholder="nom" require><br>
                <input name="description" type="text" placeholder="description"><br>
                <label for="operation">opération</label><br />
                <select name="operation">
                    <option value="0">ajouter</option>
                    <option value="1">modifier</option>
                    <option value="2">supprimer</option>
                </select>
                <input type="submit" value="envoyer">
            </form>
        </div>
        <div id="commentateur" class="tabcontent">
            <h3>Ajouter un commentateur</h3>
            <form action="api/editCommentator.php" method="post">
                <input name="lastName" type="text" placeholder="nom" require>
                <input name="firstName" type="text" placeholder="prenom" require><br>
                <input name="description" type="text" placeholder="description"><br>
                <label for="operation">opération</label><br />
                <select name="operation">
                    <option value="0">ajouter</option>
                    <option value="1">modifier</option>
                    <option value="2">supprimer</option>
                </select>
                <input type="submit" value="envoyer">
            </form>
        </div>
    </section>
</body>
<style>

</style>
<script>
    function changeTab(evt, cityName) {
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the link that opened the tab
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 1; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
</script>