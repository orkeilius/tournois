<?php session_start();
include 'module/dbTools.php';
?>
<!DOCTYPE html>
<html>

<head>
    <?php include 'module/head.php'; ?>
    <link rel="stylesheet" href="style/match.css">
</head>
<style>
    
</style>
<body>
    <?php include 'module/header.php'; ?>
    <section>
        <?php
        $query = $db->prepare("SELECT date,commentator,done,score1,score2 , 
							   p1.firstName as p1_first, p1.lastName as p1_last, 
                               p2.firstName as p2_first, p2.lastName as p2_last, 
                               c.firstName as c_first, c.lastName as c_last, 
                               place.name as place
                               FROM `game` 
                               LEFT JOIN `player` p1 ON(game.player1 = p1.id) 
                               LEFt JOIN `player` p2 ON(game.player2 = p2.id)
                               LEFt JOIN `commentator` c ON(game.commentator = c.id)
                               LEFT JOIN `place` ON(game.place = place.id) 
                               ORDER BY date DESC");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $elem) {
            $elem["date"] = date("d/m/y", strtotime($elem["date"]));
            //var_dump($elem);
            echo '<br/>';
            if ($elem['done'] == false or $elem['score1'] == $elem['score2']) {
                $color1 = '#666666';
                $color2 = '#666666';
            } else {
                if ($elem['score1'] < $elem['score2']) {
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
                    <?php echo $elem['p1_first'] . ' ' . $elem['p1_last']; ?>
                    </p>
                </div>
                <div class="left" style="border-color:<?php echo $color1; ?>"></div>
                <h3>
                    <?php if ($elem['done'] == 0) {
                        echo $elem['date'];
                    } else {
                        echo $elem['score1'] . '-' . $elem['score2'];
                    } ?>
                </h3>
                <div class="right" style="border-color:<?php echo $color2; ?>"></div>
                <div class=name style="background : <?php echo $color2; ?>"> 
                    <p>
                    <?php echo $elem['p2_first'] . ' ' . $elem['p2_last']; ?>
                    </p>
                </div>


            </div>
            <div class="underline">
                <p><?php echo $elem['c_first'] . ' ' . $elem['c_last']; ?></p>
                
                
                <?php if ($elem['done'] == 1) { ?>
                    <p> 
                        <?php echo $elem['date']; ?>
                    </p>
                    <?php } ?>
                <p><?php echo $elem['place']; ?></p>
            </div>
            
            
            <?php
        }
        ?>

    </section>
</body>
