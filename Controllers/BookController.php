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

    public function deleteBook(HttpRequest $request) {
        $book = Book::find($request->get('id'));
        return $book->delete();
    }

    public function updateBook(HttpRequest $request) {
        $book = Book::find($request->get('id'));
        $book->name = 'LOL';
        return $book->update();
    }

    public function getAll(HttpRequest $request) {
        return Book::getAll();
    }

    public function find(HttpRequest $request) {
        return Book::find($request->get('id'));
    }
}