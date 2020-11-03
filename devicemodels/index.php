<?php

include "../models/devicemodelsRepository.php";

$config = include("../db/config.php");
//$db = new PDO($config["db"], $config["username"], $config["password"]);
$db = new PDO("sqlite:../db/register.sqlite");
$devicemodels = new devicemodelsRepository($db);


switch($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        $result = $devicemodels->getAll();
        break;
}

header("Content-Type: application/json");
echo json_encode($result);
?>
