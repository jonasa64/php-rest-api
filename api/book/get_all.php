<?php
include_once '../../config/Database.php';
include_once '../../model/Book.php';

$database = new Database();
$db = $database->getConnection();

$book = new Book($db);

$result = $book->getAll();

$totalRow = $result->rowCount();

if($totalRow >0){
    $book_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        //extract($row);
        $book_item = array(
            'id' => $row['id'],
            'title' => $row['title'],
            'total_pages' => $row['total_pages'],
            'genre' => $row['genre'],
            'author_id' => $row['author_id']
        );

        array_push($book_arr, $book_item);
    }
    echo  json_encode($book_arr);
}else{
    echo json_encode(array("message" => "no books found"));
}
