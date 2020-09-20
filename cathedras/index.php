<?php

include "../models/CountryRepository.php";

$config = include("../db/config.php");
//$db = new PDO($config["db"], $config["username"], $config["password"]);
$db = new PDO("sqlite:./register.sqlite");
$cathedras = new CathedraRepository($db);


switch($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        $result = $cathedras->getAll();
        break;
}

header("Content-Type: application/json");
echo json_encode($result);
?>
