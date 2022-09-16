<?php

namespace Framework;

use PDO;

abstract class Model
{
    /**
     * Database table that references this model
     * @var string
     */
    public static string $table;

    /**
     * Inserts the model instance in the database. Returns the new row if the insert was successful, otherwise returns false.
     * @return \stdClass|false|\Exception
     * @throws \Exception
     */
    public final function create() {
        try {
            $db = Database::connect();

            $fields = '(' . implode(',', array_keys((array)$this)) . ')';
            $values = '';
            foreach ((array)$this as $value) {
                if (is_numeric($value) && !is_string($value)) {
                    $values .= $value . ',';
                }
                else {
                    $values .= "'" . $value . "'";
                }
            }

            $statement = $db->prepare('INSERT INTO ' . $this::$table . $fields . ' VALUES ('.$values.') RETURNING id');

            if ($statement->execute()) {
                $findNewRow = $db->prepare('SELECT * FROM ' . static::$table . ' WHERE id = ?');
                $findNewRow->execute([$db->lastInsertId()]);
                return $findNewRow->fetchObject(static::class);
            }
            else {
                return false;
            }
        }
        catch (\Exception $e) {
            echo $e->getMessage() . "\n";
            throw $e;
        }
    }

    /**
     * Get every row of the table
     * @return array|false
     * @throws \Exception
     */
    public static final function getAll() {
        try {
            $db = Database::connect();

            $statement = $db->query('SELECT * FROM ' . static::$table);

            if(!$statement) {
                throw new \Exception('['.$db->errorInfo()[0].'] SQL ' . $db->errorInfo()[2]);
            }

            return $statement->fetchAll(PDO::FETCH_CLASS, static::class);
        }
        catch (\Exception $e) {
            echo $e->getMessage() . "\n";
            throw $e;
        }
    }

    /**
     * Find row by id
     * @return array|false
     * @throws \Exception
     */
    public static final function find(int $id) {
        try {
            $db = Database::connect();

            $statement = $db->prepare('SELECT * FROM ' . static::$table . ' WHERE id = ?');

            if(!$statement) {
                throw new \Exception('['.$db->errorInfo()[0].'] SQL ' . $db->errorInfo()[2]);
            }

            $statement->execute([$id]);
            return $statement->fetchObject(static::class) ?:null;
        }
        catch (\Exception $e) {
            echo $e->getMessage() . "\n";
            throw $e;
        }
    }
}