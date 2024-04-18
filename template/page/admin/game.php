<div>
    <form method="post" action="/admin/game">
        <input type="number" name="id" id="id" hidden value="<?php echo $formGame->id ?>">
        <label for="player1">player 1</label>
        <select name="player1" id="player1">
            <?php foreach ($users as $user) {
                if ($user->role == Role::player) {
                    ?>
                    <option value="<?php echo $user->id ?>" <?php echo $formGame->player[0]->id == $user->id ? "selected" : "" ?>>
                        <?php echo $user->firstName . " " . $user->lastName ?>
                    </option>
                <?php }
            } ?>
        </select>

        <label for="player2">player 2</label>
        <select name="player2" id="player2">
            <?php foreach ($users as $user) {
                if ($user->role == Role::player) {
                    ?>
                    <option value="<?php echo $user->id ?>" <?php echo $formGame->player[1]->id == $user->id ? "selected" : "" ?>>
                        <?php echo $user->firstName . " " . $user->lastName ?>
                    </option>
                <?php }
            } ?>
        </select>

        <label for="judge">judge</label>
        <select name="judge" id="judge">
            <?php foreach ($users as $user) {
                if ($user->role == Role::judge) {
                    ?>
                    <option value="<?php echo $user->id ?>" <?php echo $formGame->judge->id == $user->id ? "selected" : "" ?>>
                        <?php echo $user->firstName . " " . $user->lastName ?>
                    </option>
                <?php }
            } ?>
        </select>

        <label for="place">place</label>
        <select name="place" id="place">
            <?php foreach ($places as $place) {
                ?>
                <option value="<?php echo $place->id ?>" <?php echo $formGame->place->id == $place->id ? "selected" : "" ?>>
                    <?php echo $place->name ?>
                </option>
            <?php } ?>
        </select>

        <label for="date">date</label>
        <input type="datetime-local" name="date" id="date" value="<?php echo $formGame->date->format("Y-m-d\TH:i") ?>">

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
                        <a href="/admin/game?id=<?php echo $game->id ?>">edit</a>
                        <a href="/admin/game?delete=<?php echo $game->id ?>">delete</a>
                    </td>
                    <td><?php echo $game->player[0]->firstName . " " . $game->player[0]->lastName ?></td>
                    <td><?php echo $game->player[1]->firstName . " " . $game->player[1]->lastName ?></td>
                    <td><?php echo $game->judge->firstName . " " . $game->judge->lastName ?></td>
                    <td><?php echo $game->place->name ?></td>
                    <td><?php echo $game->date->format("Y-m-d H:i") ?></td>
                    <td><?php echo $game->score[0] . "-" . $game->score[1] ?></td>
                </tr>

            <?php } ?>

        </tbody>

    </table>

</div>