<?php ?>
<header>
    <h1>Vp enterprise</h1>
    <nav>
        <a class="navItem" href="/">Accueil</a>
        <a class="navItem" href="/">Match</a>
        <a class="navItem" href="/">Joueur</a>
        <a class="navItem" href="/">Stade</a>
        <a class="navItem" href="/">Commentateur</a>
        <div style="flex-grow:1"></div>
        <?php if (getUserAccess() == 0) {
            var_dump($_SESSION); ?>

            <a class="navItem" href="edit.php">edit</a>
            <a class="navItem" href="api/logout.php">logout</a>
        <?php } else { ?>
            <a class="navItem" href="login.php">login</a>
        <?php } ?>
    </nav>
</header>