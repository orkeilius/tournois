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
        <div class="tab">
            <button class="tablinks" onclick="changeTab(event, 'match')">Ajouter un match</button>
            <button class="tablinks" onclick="changeTab(event, 'joueur')">Ajouter un joueur</button>
            <button class="tablinks" onclick="changeTab(event, 'stade')">Ajouter un stade</button>
            <button class="tablinks" onclick="changeTab(event, 'commentateur')">commentateur</button>
        </div>

        <div id="match" class="tabcontent">
            <h3>Ajouter un match</h3>
            <form>
                <label for="date">jour</label><br>
                <input name="date" type="date">
            </form>
        </div>

        <div id="joueur" class="tabcontent">
            <h3>Ajouter un joueur</h3>
            <form>
                <input name="lastName" type="text" placeholder="nom">
                <input name="firstNale" type="text" placeholder="prenom">
                <input name="contry" type="text" placeholder="pays">
            </form>
        </div>

        <div id="stade" class="tabcontent">
            <h3>Ajouter un stade</h3>
            <form>
                <input name="name" type="text" placeholder="nom">
                <input name="description" type="text" placeholder="description">
            </form>
        </div>
        <div id="commentateur" class="tabcontent">
            <h3>Ajouter un commentateur</h3>
            <form>
                <input name="lastName" type="text" placeholder="nom">
                <input name="firstNale" type="text" placeholder="prenom">
                <input name="description" type="text" placeholder="description">
            </form>
        </div>
    </section>
</body>
<style>
    * {
        box-sizing: border-box
    }

    /* Style the tab */
    .tab {
        float: left;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
        width: 20%;
        height: 300px;
    }

    /* Style the buttons that are used to open the tab content */
    .tab button {
        display: block;
        background-color: inherit;
        color: black;
        padding: 22px 16px;
        width: 100%;
        border: none;
        outline: none;
        text-align: left;
        cursor: pointer;
        transition: 0.3s;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current "tab button" class */
    .tab button.active {
        background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
        float: left;
        padding: 0px 12px;
        border: 1px solid #ccc;
        width: 70%;
        border-left: none;
        height: 300px;
    }
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