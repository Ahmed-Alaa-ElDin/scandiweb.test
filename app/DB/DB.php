<?php

require __DIR__ . "/../../vendor/autoload.php";

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$dsn = "mysql:host=127.0.0.1;dbname:scandiweb-project";
$user = "root";
$pass = "Ahme@1234";

var_dump($_ENV['DB_NAME']);
try {
    $pdo = new PDO($dsn,$user,$pass);
} catch (PDOException $e) {
    echo $e;
}
