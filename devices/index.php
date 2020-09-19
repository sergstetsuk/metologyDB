<?php
/*
include "../models/ClientRepository.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$devices = new ClientRepository($db);


switch($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        $result = $devices->getAll(array(
            "name" => $_GET["name"],
            "date" => $_GET["date"],
            "cathedra_id" => intval($_GET["cathedra_id"])
        ));
        break;

    case "POST":
        $result = $devices->insert(array(
            "name" => $_POST["name"],
            "age" => intval($_POST["age"]),
            "date" => $_POST["date"],
            "married" => $_POST["married"] === "true" ? 1 : 0,
            "cathedra_id" => intval($_POST["cathedra_id"])
        ));
        break;

    case "PUT":
        parse_str(file_get_contents("php://input"), $_PUT);

        $result = $devices->update(array(
            "id" => intval($_PUT["id"]),
            "name" => $_PUT["name"],
            "age" => intval($_PUT["age"]),
            "date" => $_PUT["date"],
            "married" => $_PUT["married"] === "true" ? 1 : 0,
            "cathedra_id" => intval($_PUT["cathedra_id"])
        ));
        break;

    case "DELETE":
        parse_str(file_get_contents("php://input"), $_DELETE);

        $result = $devices  ->remove(intval($_DELETE["id"]));
        break;
}


header("Content-Type: application/json");
echo json_encode($result);
 */
?>
