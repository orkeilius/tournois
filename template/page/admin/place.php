<div>
    <form method="post" action="/admin/place">
        <input type="number" name="id" id="id" hidden value="<?php echo $formPlace->id ?>">
        <label for="name">name</label>
        <input type="text" name="name" id="name" value="<?php echo $formPlace->name ?>">
        <label for="description">description</label>
        <input type="text" name="description" id="description" value="<?php echo $formPlace->description ?>">
        <?php if ($formPlace->id == -1) { ?>
            <button type="submit">create</button>
        <?php } else { ?>
            <button type="submit">update</button>
        <?php } ?>

    </form>
    <table>
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">name</th>
                <th scope="col">description</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($places as $place) {
                ?>
                <tr>
                    <td>
                        <a href="/admin/place?id=<?php echo $place->id ?>">edit</a>
                        <a href="/admin/place?delete=<?php echo $place->id ?>">delete</a>
                    </td>
                    <td><?php echo $place->name ?></td>
                    <td><?php echo $place->description ?></td>
                </tr>

            <?php } ?>

        </tbody>

    </table>

</div>