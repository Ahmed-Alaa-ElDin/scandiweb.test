<?php

declare(strict_types=1);

use App\App;

define('VIEW_PATH', __DIR__ . '/views');

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/Routers/routes.php';
require_once __DIR__ . '/app/DB/DB.php';
Dotenv\Dotenv::createImmutable(__DIR__)->load();

(new App(
    $router,
    [
        'uri' => $_SERVER['REQUEST_URI'],
        'method' => $_SERVER['REQUEST_METHOD'],
    ],
    [
        "dbName" => $_ENV['DB_NAME'],
        "dbHost" => $_ENV['DB_HOST'],
        "dbUser" => $_ENV['DB_USER'],
        "dbPassword" => $_ENV['DB_PASSWORD']
    ]
))->run();

// $pdo->beginTransaction();

// try {
//     $newProduct = $pdo->prepare('INSERT INTO `products`(name,sku,price) VALUES (:name,:sku,:price)');
//     $newProduct->execute([
//         ':name' => "Chair",
//         ':sku' => "CCC00kk",
//         ':price' => "12.6",
//     ]);

//     $productId = $pdo->lastInsertId();

//     $newFurniture = $pdo->prepare('INSERT INTO `furniture`(product_id,height,width,length) VALUES (:product_id,:height,:width,:length)');
//     $newFurniture->execute([
//         ':product_id' => (int)$productId,
//         ':height' => "50",
//         ':width' => "50",
//         ':length' => "50",
//     ]);

//     $pdo->commit();
// } catch (\Throwable $th) {
//     if ($pdo->inTransaction()) {
//         $pdo->rollBack();
//         var_dump($pdo->errorInfo());
//         throw $th;
//     }
// }

// foreach ($pdo->query('SELECT * FROM `products`') as $product) {
//     echo "<pre>";
//     print_r($product);
//     echo "</pre>";
// }
