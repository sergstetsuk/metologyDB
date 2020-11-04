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
            "cathedraid" => intval($_GET["cathedraid"]),
            "typeid" => intval($_GET["typeid"]),
            "modelid" => intval($_GET["modelid"]),
            "datemanufacture" => $_GET["datemanufacture"],
            "dateaccept" => $_GET["dateaccept"],
            "statusid" => intval($_GET["statusid"]),
            "lastverify" => $_GET["lastverify"],
            "nextverify" => $_GET["nextverify"]
        ));
        break;

    case "POST":
        $result = $devices->insert(array(
            "serial" => $_POST["serial"],
            "statusid" => intval($_POST["statusid"]),
            "cathedraid" => intval($_POST["cathedraid"])
        ));
        break;

    case "PUT":
        parse_str(file_get_contents("php://input"), $_PUT);

        $result = $devices->update(array(
            "id" => intval($_PUT["id"]),
            "serial" => $_PUT["serial"],
            "statusid" => intval($_PUT["statusid"]),
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
