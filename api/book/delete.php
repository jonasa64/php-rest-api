<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../model/Book.php';

$database = new Database();
$db = $database->getConnection();

$book = new Book($db);

$data = json_decode(file_get_contents('php://input'));

$book->id = $data->id;

if($book->delete()){
    echo json_encode(array(
        'message' => 'book delete'
    ));
}else {
    echo json_encode(array(
        'message' => 'book not delete'
    ));
}
