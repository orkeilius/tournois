<link rel="stylesheet" href="/style/game.css">
<section>
    <?php
    foreach ($games as $user) {
        if ($user->score[0] == $user->score[1]) {
            $color1 = '#666666';
            $color2 = '#666666';
        } else {
            if ($user->score[0] < $user->score[1]) {
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
                    <?php echo $user->player[0]->firstName . ' ' . $user->player[0]->lastName; ?>
                </p>
            </div>
            <div class="left" style="border-color:<?php echo $color1; ?>"></div>
            <h3>
                <?php if (in_array(null, $user->score)) {
                    echo $user->date->format("Y-m-d H:i");
                } else {
                    echo $user->score[0] . '-' . $user->score[1];
                } ?>
            </h3>
            <div class="right" style="border-color:<?php echo $color2; ?>"></div>
            <div class=name style="background : <?php echo $color2; ?>">
                <p>
                    <?php echo $user->player[1]->firstName . ' ' . $user->player[1]->lastName; ?>
                </p>
            </div>


        </div>
        <div class="underline">
            <p><?php echo $user->judge->firstName . ' ' . $user->judge->lastName ?></p>


            <?php if (!in_array(null, $user->score)) { ?>
                <p>
                    <?php echo $user->date->format("Y-m-d H:i"); ?>
                </p>
            <?php } ?>
            <p><?php echo $user->place->name; ?></p>
        </div>


        <?php
    }
    ?>

</section>