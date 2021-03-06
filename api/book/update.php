<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../model/Book.php';

$database = new Database();
$db = $database->getConnection();

$book = new Book($db);


$data = json_decode(file_get_contents('php://input'));

$book->id = $data->id;

$book->title = $data->title;
$book->total_pages = $data->total_pages;
$book->genre = $data->genre;
$book->author_id = $data->author_id;

if($book->update()){
    echo json_encode(array('message' => 'book updated'));
} else {
    echo json_encode(array('message' => 'book not updated'));
}