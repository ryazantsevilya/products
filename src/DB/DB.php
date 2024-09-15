<?php

namespace App\DB;

use PDOStatement;

class DB 
{
    private static DBConnection $DBconnection;

    public static function setConnection(DBConnection $DBconnection): void
    {
        static::$DBconnection = $DBconnection;
    }

    public static function get(string $query): PDOStatement
    {
        return static::$DBconnection->getConnection()->prepare($query);
    }

    public static function store(string $query): PDOStatement
    {
        return static::$DBconnection->getConnection()->prepare($query);
    }
}
