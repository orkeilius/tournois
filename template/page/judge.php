<link rel="stylesheet" href="style/list.css">
<section class="wrapper">
    <?php foreach ($users as $user) {
        if ($user->role == Role::judge) { ?>
            <div>
                <h3><?php echo $user->firstName . " " . $user->lastName." - ".  $user->country ?></h3>
                <p><?php echo $user->description ?></p>
            </div>
        <?php }
    } ?>

</section>