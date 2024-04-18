<?php
require_once "model/data/place.php";

$places = Place::getAllPlace();
require_once "template/page/place.php";