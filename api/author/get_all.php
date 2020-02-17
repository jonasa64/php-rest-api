<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once '../../config/Database.php';
include_once '../../model/Author.php';

$database = new Database();
$db = $database->getConnection();

$author = new Author($db);

$result = $author->getAll();

$totalRow = $result->rowCount();

if($totalRow >0){
    $author_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        //extract($row);
        $author_item = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'latest_book' => $row['latest_book']
        );

        array_push($author_arr, $author_item);
    }
  echo  json_encode($author_arr);
}else{
   echo json_encode(array("message" => "no author found"));
}