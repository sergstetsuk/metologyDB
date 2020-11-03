<?php

include "../models/statusRepository.php";

$config = include("../db/config.php");
//$db = new PDO($config["db"], $config["username"], $config["password"]);
$db = new PDO("sqlite:../db/register.sqlite");
$status = new statusRepository($db);


switch($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        $result = $status->getAll();
        break;
}

header("Content-Type: application/json");
echo json_encode($result);
?>
