<?php
require_once "model/data/game.php";

$games = Game::getAllGame();
require_once "template/page/game.php";