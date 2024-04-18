<?php
require_once "model/data/user.php";

$users = User::getAllUser();
require_once "template/page/player.php";