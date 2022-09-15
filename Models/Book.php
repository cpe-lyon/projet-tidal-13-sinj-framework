<?php

namespace Models;

use Framework\Model;

class Book extends Model
{
    public static string $table = 'books';

    public string $name;
}