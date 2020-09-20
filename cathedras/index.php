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
echo "[";
echo "{\"id\":1, \"name\":\"abc1\"},";
echo "{\"id\":2, \"name\":\"abc2\"},";
echo "{\"id\":3, \"name\":\"abc3\"},";
echo "{\"id\":4, \"name\":\"abc4\"}";
echo "]";
/*
 * echo json_encode($result);
 */
?>
