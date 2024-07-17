<?php
require __DIR__ . '/../vendor/autoload.php';

$host = "localhost";
$username = "root";
$password = "";
$dbname = "crudphp";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
