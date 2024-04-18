<?php ?>
<header>
    <h1 style="padding-left: 10px"> Le tournois octogone</h1>
    <nav>
        <a class="navItem" href="/">Accueil</a>
        <a class="navItem" href="/game">Game</a>
        <a class="navItem" href="joueur.php">Joueur</a>
        <a class="navItem" href="stade.php">Stade</a>
        <a class="navItem" href="commentateur.php">Commentateur</a>
        <div style="flex-grow:1"></div>
        <?php if (DbConnection::isUserAdmin()) { ?>

            <a class="navItem" href="/admin">admin panel</a>
            <a class="navItem" href="/logout">logout</a>
        <?php } else { ?>
            <a class="navItem" href="/login">login</a>
        <?php } ?>
    </nav>
</header>