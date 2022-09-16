<?php

use Framework\View;
use Framework\HttpRequest;
use Models\Book;

class BookController
{
    public function createBook(HttpRequest $request) {
        $book = new Book();
        $book->name = $request->get('name');
        return $book->create();
    }

    public function getAll(HttpRequest $request) {;
        return Book::getAll();
    }

    public function find(HttpRequest $request) {;
        return Book::find($request->get('id'));
    }
}