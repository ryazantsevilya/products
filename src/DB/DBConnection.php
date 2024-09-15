<?php

namespace App\DB;

use PDO;

class DBConnection
{
    private PDO $pdo;

    public function __construct(string $URI, string $user, $password)
    {
        $this->pdo = new PDO($URI, $user, $password);
    }

    public function getConnection(): PDO
    {
        return $this->pdo;
    }
}
