<div>
    <form method="post" action="/admin/result">      
        <label for="id">game</label>
        <select name="id" id="id">
            <?php foreach ($games as $game) {
                ?>
                <option value="<?php echo $game->id ?>" <?php echo $formGame->id == $game->id ? "selected" : "" ?>>
                    <?php echo $game->player[0]->firstName." ".$game->player[0]->lastName." vs ".$game->player[1]->firstName." ".$game->player[1]->lastName ?>
                </option>
            <?php } ?>
        </select><br/>
        <label for="score1">score</label>
        <input type="number" name="score1" id="score1" value="<?php echo $formGame->score[0] ?>">
        <label for="score2">-</label>
        <input type="number" name="score2" id="score2" value="<?php echo $formGame->score[1] ?>">

        <?php if ($formGame->id == -1) { ?>
            <button type="submit">create</button>
        <?php } else { ?>
            <button type="submit">update</button>
        <?php } ?>

    </form>
    <table>
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">player 1</th>
                <th scope="col">player 2</th>
                <th scope="col">judge</th>
                <th scope="col">place</th>
                <th scope="col">date</th>
                <th scope="col">score</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($games as $game) {
                ?>
                <tr>
                    <td>
                        <a href="/admin/result?id=<?php echo $game->id ?>">edit</a>
                        <a href="/admin/result?delete=<?php echo $game->id ?>">delete</a>
                    </td>
                    <td><?php echo $game->player[0]->firstName." ".$game->player[0]->lastName ?></td>
                    <td><?php echo $game->player[1]->firstName." ".$game->player[1]->lastName ?></td>
                    <td><?php echo $game->judge->firstName." ".$game->judge->lastName ?></td>
                    <td><?php echo $game->place->name ?></td>
                    <td><?php echo $game->date->format("Y-m-d H:i") ?></td>
                    <td><?php echo $game->score[0]."-".$game->score[1] ?></td>
                </tr>

            <?php } ?>

        </tbody>

    </table>

</div>