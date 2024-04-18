<?php
require_once "model/data/place.php";


function run()
{
    handlePostRequest();
    handleGetRequest();
    $places = Place::getAllPlace();
    $formPlace = getRequestedPlace($places);

    $elemTemplate = "template/page/admin/place.php";
    require_once "template/page/admin.php";
}

function getRequestedPlace($places): Place
{
    $out = new Place("", "");

    if (isset($_GET["id"])) {
        $target = intval($_GET["id"]);
        foreach ($places as $place) {
            if ($place->id == $target) {
                $out = $place;
                break;
            }
        }
    }
    return $out;
}

function handlePostRequest()
{
    $options = array(
        "name" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        "description" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        "id" => FILTER_VALIDATE_INT,
    );

    $result = filter_input_array(INPUT_POST, $options);

    if ($result == null) {
        return;
    }
    if (in_array("", $result)) {
        header("Location: /admin/place?error=invalide%20values");
        return;
    }

    $place = new Place($result["name"], $result["description"], $result["id"]);
    $place->save();

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
        header("Location: /admin/place?error=invalide%20values");
    }
    Place::deletePlaceById($result["delete"]);
}

run();