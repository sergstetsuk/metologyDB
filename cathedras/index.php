<?php
/*
include "../models/CountryRepository.php";

$config = include("../db/config.php");
//$db = new PDO($config["db"], $config["username"], $config["password"]);
$db = new PDO($config["db"]);
$cathedras = new CountryRepository($db);


switch($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        $result = $cathedras->getAll();
        break;
}

 */
header("Content-Type: application/json");
echo "[{\"id\":0, \"name\":\"abc\"}]";
/*
 * echo json_encode($result);
 */
?>
