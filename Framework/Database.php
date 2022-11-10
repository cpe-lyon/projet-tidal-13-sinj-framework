<?php

namespace Framework;

use PDO;

final class Database
{
    /**
     * Returns a connection to database
     * @return PDO
     */
    public final static function connect(): PDO
    {
        return new PDO(DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT, DB_USER, DB_PASSWORD);
    }

    /**
     * Executes the given query with it's params and return a fetchAll result
     * @param string $queryString
     * @param array $values
     * @return array|false|null
     * @throws \Exception
     */
    public final static function query(string $queryString, array $values = [])
    {
        try {
            $db = Database::connect();

            $statement = $db->prepare($queryString);

            if(!$statement) {
                throw new \Exception('['.$db->errorInfo()[0].'] SQL ' . $db->errorInfo()[2]);
            }

            $statement->execute($values);
            if ($statement->rowCount() > 1) {
                return $statement->fetchAll(PDO::FETCH_ASSOC) ?:null;
            }
            else {
                return $statement->fetch(PDO::FETCH_ASSOC) ?:null;
            }
        }
        catch (\Exception $e) {
            echo $e->getMessage() . "\n";
            throw $e;
        }
    }
}