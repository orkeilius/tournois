<div>
    <form method="post" action="/admin/user">
        <input type="number" name="id" id="id" hidden value="<?php echo $formUser->id ?>">
        <label for="role">role</label>
        <select name="role" id="role">
            <option value="player" <?php echo ($formUser->role != Role::player) ?: "selected" ?>>player</option>
            <option value="judge" <?php echo ($formUser->role != Role::judge) ?: "selected" ?>>judge</option>
        </select>
        <label for="firstName">first name</label>
        <input type="text" name="firstName" id="firstName" value="<?php echo $formUser->firstName ?>">
        <label for="lastName">last name</label>
        <input type="text" name="lastName" id="lastName" value="<?php echo $formUser->lastName ?>">
        <label for="country">country</label>
        <input type="text" name="country" id="country" value="<?php echo $formUser->country ?>">
        <label for="description">description</label>
        <input type="text" name="description" id="description" value="<?php echo $formUser->description ?>">
        <?php if ($formUser->id == -1) { ?>
            <button type="submit">create</button>
        <?php } else { ?>
            <button type="submit">update</button>
        <?php } ?>

    </form>
    <table>
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">role</th>
                <th scope="col">first name</th>
                <th scope="col">last name</th>
                <th scope="col">country</th>
                <th scope="col">description</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) {
                ?>
                <tr>
                    <td>
                        <a href="/admin/user?id=<?php echo $user->id ?>">edit</a>
                        <a href="/admin/user?delete=<?php echo $user->id ?>">delete</a>
                    </td>
                    <td><?php echo $user->role->value ?></td>
                    <td><?php echo $user->firstName ?></td>
                    <td><?php echo $user->lastName ?></td>
                    <td><?php echo $user->country ?></td>
                    <td><?php echo $user->description ?></td>
                </tr>

            <?php } ?>

        </tbody>

    </table>

</div>