<?php

namespace Framework;

use PDO;

final class Database
{
    public final static function connect(): PDO
    {
        return new PDO(DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT, DB_USER, DB_PASSWORD);
    }
}