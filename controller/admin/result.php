<?php
require_once "model/data/game.php";
require_once "model/data/user.php";
require_once "model/data/place.php";

function run()
{
    handlePostRequest();
    handleGetRequest();
    $games = Game::getAllGame();
    $formGame = getRequestedGame($games);

    $elemTemplate = "template/page/admin/result.php";
    require_once "template/page/admin.php";
}

function getRequestedGame($games): Game
{
    $out = new Game(
        array(
            new User("", "", "", "", "player"),
            new User("", "", "", "", "player")
        ),
        new User("", "", "", "", "judge"),
        new Place("", ""),
        new DateTime(),
    );

    if (isset($_GET["id"])) {
        $target = intval($_GET["id"]);
        foreach ($games as $game) {
            if ($game->id == $target) {
                $out = $game;
                break;
            }
        }
    }
    return $out;
}

function handlePostRequest()
{
    $options = array(
        "score1" => FILTER_VALIDATE_INT,
        "score2" => FILTER_VALIDATE_INT,
        "id" => FILTER_VALIDATE_INT,
    );

    $result = filter_input_array(INPUT_POST, $options);

    if ($result == null) {
        return;
    }

    try {
        $game = Game::getGameById($result["id"]);
        $game->setScore(array($result["score1"], $result["score2"]));
        $game->save();
    } catch (Exception $e) {
        header("Location: /admin/result?error=invalide%20values");
    }


}

function handleGetRequest()
{
    // if (!isset($_GET["delete"])) {
    //     return;
    // }
    // $options = ["delete" => FILTER_VALIDATE_INT];
    // $result = filter_input_array(INPUT_GET, $options);
    // if ($result == null) {
    //     return;
    // }
    // if (in_array(null, $result, true)) {
    //     header("Location: /admin/game?error=invalide%20values");
    // }
    // Game::deleteGameById($result["delete"]);
}

run();