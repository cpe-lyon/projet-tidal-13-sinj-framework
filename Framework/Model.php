<?php

namespace Framework;

use PDO;

abstract class Model
{
    /**
     * Table name that references this model
     * @var string
     */
    public static string $table;

    /**
     * Inserts the model instance in the database. Returns the new row if the insert was successful, otherwise returns false.
     * @return \stdClass|false|\Exception
     */
    public final function create() {
        try {
            $db = new PDO('pgsql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT, DB_USER, DB_PASSWORD);

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
            return $e;
        }
    }

    public static final function getAll() {
        try {
            $db = new PDO('pgsql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT, DB_USER, DB_PASSWORD);

            $statement = $db->query('SELECT * FROM ' . static::$table);

            return $statement->fetchAll(PDO::FETCH_CLASS, static::class);
        }
        catch (\Exception $e) {
            echo $e->getMessage() . "\n";
            return $e;
        }
    }
}