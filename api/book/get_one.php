<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once '../../config/Database.php';
include_once '../../model/Book.php';

$database = new Database();
$db = $database->getConnection();

$book = new Book($db);

$book->id = isset($_GET['id']) ? $_GET['id'] : die();

$book->getOne();

$book_arr = array(
    'id' => $book->id,
    'title' => $book->title,
    'total_pages' => $book->total_pages,
    'genre' => $book->genre,
    'author_id' => $book->author_id
);


print_r(json_encode($book_arr));
