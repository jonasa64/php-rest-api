<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../model/Author.php';

$database = new Database();
$db = $database->getConnection();

$author = new Author($db);

$data = json_decode(file_get_contents('php://input'));

$author->id = $data->id;

$author->name = $data->name;
$author->latest_book = $data->latest_book;

if($author->update()){
    echo json_encode(array('message' => 'author updated'));
} else {
    echo json_encode(array('message' => 'author not updated'));
}

