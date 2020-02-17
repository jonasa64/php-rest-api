<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once '../../config/Database.php';
include_once '../../model/Author.php';

$database = new Database();
$db = $database->getConnection();

$author = new Author($db);

$author->id = isset($_GET['id']) ? $_GET['id'] : die();

$author->getOne();

$author_arr = array(
    'id' => $author->id,
    'name' => $author->name,
    'latest_book' => $author->latest_book
);


print_r(json_encode($author_arr));