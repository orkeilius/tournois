<link rel="stylesheet" href="/style/game.css">
<section>
    <?php
    foreach ($games as $game) {
        if ($game->score[0] == $game->score[1]) {
            $color1 = '#666666';
            $color2 = '#666666';
        } else {
            if ($game->score[0] < $game->score[1]) {
                $color1 = '#EC0B43';
                $color2 = '#00A3FF';
            } else {
                $color2 = '#EC0B43';
                $color1 = '#00A3FF';
            }
        }
        ?>
        <div class="score">
            <div class="name" style="background : <?php echo $color1; ?>">
                <p>
                    <?php echo $game->player[0]->firstName . ' ' . $game->player[0]->lastName; ?>
                </p>
            </div>
            <div class="left" style="border-color:<?php echo $color1; ?>"></div>
            <h3>
                <?php if (in_array(null, $game->score)) {
                    echo $game->date->format("Y-m-d H:i");
                } else {
                    echo $game->score[0] . '-' . $game->score[1];
                } ?>
            </h3>
            <div class="right" style="border-color:<?php echo $color2; ?>"></div>
            <div class=name style="background : <?php echo $color2; ?>">
                <p>
                    <?php echo $game->player[1]->firstName . ' ' . $game->player[1]->lastName; ?>
                </p>
            </div>


        </div>
        <div class="underline">
            <p><?php echo $game->judge->firstName . ' ' . $game->judge->lastName ?></p>


            <?php if (!in_array(null, $game->score)) { ?>
                <p>
                    <?php echo $game->date->format("Y-m-d H:i"); ?>
                </p>
            <?php } ?>
            <p><?php echo $game->place->name; ?></p>
        </div>


        <?php
    }
    ?>

</section>