<?php
require_once "model/data/user.php";


function run()
{
    handlePostRequest();
    handleGetRequest();
    $users = UserRepository::getAllUser();
    $formUser = getRequestedUser($users);

    $elemTemplate = "template/page/admin/user.php";
    require_once "template/page/admin.php";
}

function getRequestedUser($users): User
{
    $out = new User("", "", "", "", "player");

    if (isset($_GET["id"])) {
        $target = intval($_GET["id"]);
        foreach ($users as $user) {
            if ($user->id == $target) {
                $out = $user;
                break;
            }
        }
    }
    return $out;
}

function handlePostRequest()
{
    $options = array(
        "firstName" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        "lastName" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        "country" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        "description" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        "role" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        "id" => FILTER_VALIDATE_INT,
    );

    $result = filter_input_array(INPUT_POST, $options);

    if ($result == null) {
        return;
    }
    if (in_array(null, $result, true)) {
        header("Location: /admin/user?error=valeurs%20invalide");
    }

    $user = new User($result["firstName"], $result["lastName"], $result["country"], $result["description"], $result["role"], $result["id"]);
    UserRepository::saveUser($user);

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
        header("Location: /admin/user?error=valeurs%20invalide");
    }
    UserRepository::deleteUserById($result["delete"]);
}

run();