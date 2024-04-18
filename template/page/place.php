<link rel="stylesheet" href="style/list.css">

<section>
    <?php foreach ($places as $place) { ?>
        <div>
            <h3><?php echo $place->name ?></h3>
            <p><?php echo $place->description ?></p>
        </div>
    <?php } ?>

</section>