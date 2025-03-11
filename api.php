<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "chronobreak";

try {
    $dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT country_code AS country, country_name AS name, capital_city AS city FROM cities";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $cities = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($cities)) {
        echo json_encode(array("message" => "No cities found"));
    } else {
        echo json_encode($cities);
    }
} catch (PDOException $e) {
    echo json_encode(array("message" => "Connection failed: " . $e->getMessage()));
}
?>