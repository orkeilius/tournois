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
    $users = User::getAllUser();
    $places = Place::getAllPlace();

    $elemTemplate = "template/page/admin/game.php";
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
        "player1" => FILTER_VALIDATE_INT,
        "player2" => FILTER_VALIDATE_INT,
        "judge" => FILTER_VALIDATE_INT,
        "place" => FILTER_VALIDATE_INT,
        "date" => HTML_SPECIALCHARS,
        "id" => FILTER_VALIDATE_INT,
    );

    $result = filter_input_array(INPUT_POST, $options);

    if ($result == null) {
        return;
    }
    $date = DateTime::createFromFormat("Y-m-d\TH:i", $result["date"]);
    if (in_array("", $result) or $date === false) {
        header("Location: /admin/game?error=invalide%20values");
        return;
    }

    $game = new Game(
        array(
            User::getUserById($result["player1"]),
            User::getUserById($result["player2"])
        ),
        User::getUserById($result["judge"]),
        Place::getPlaceById($result["place"]),
        $date,
        $result["id"]
    );
    $game->save();

}

function handleGetRequest()
{
    if (!isset($_GET["delete"])) {
        return;
    }
    $options = ["delete" => FILTER_VALIDATE_INT];
    $result = filter_input_array(INPUT_GET, $options);
    if ($result == null) {
        return;
    }
    if (in_array(null, $result, true)) {
        header("Location: /admin/game?error=invalide%20values");
    }
    Game::deleteGameById($result["delete"]);
}

run();