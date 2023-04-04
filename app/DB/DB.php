<?php

namespace App\DB;

use PDO;
use PDOException;

class DB
{
    private PDO $pdo;

    public function __construct(private array $config)
    {
        $defaultOptions = [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        $dsn = "mysql:dbname=" . $config['dbName']  . ";host=" . $config['dbHost'];

        try {
            $this->pdo = new PDO($dsn, $config['dbUser'], $config['dbPassword'], $config['options'] ?? $defaultOptions);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function __call(string $name, array $arguments)
    {
        return call_user_func_array([$this->pdo, $name], $arguments);
    }
}
