<?php

include "../models/DeviceRepository.php";

$config = include("../db/config.php");
//$db = new PDO($config["db"], $config["username"], $config["password"]);
$db = new PDO("sqlite:../db/register.sqlite");
$devices = new DeviceRepository($db);


switch($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        $result = $devices->getAll(array(
            "serial" => $_GET["serial"],
            "cathedraid" => intval($_GET["cathedraid"])
        ));
        break;

    case "POST":
        $result = $devices->insert(array(
            "serial" => $_POST["serial"],
            "cathedraid" => intval($_POST["cathedraid"])
        ));
        break;

    case "PUT":
        parse_str(file_get_contents("php://input"), $_PUT);

        $result = $devices->update(array(
            "id" => intval($_PUT["id"]),
            "serial" => $_PUT["serial"],
            "cathedraid" => intval($_PUT["cathedraid"])
        ));
        break;

    case "DELETE":
        parse_str(file_get_contents("php://input"), $_DELETE);

        $result = $devices  ->remove(intval($_DELETE["id"]));
        break;
}


header("Content-Type: application/json");
echo json_encode($result);
?>
