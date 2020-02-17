<?php


class Book
{
public $id;
public $title;
public $total_pages;
public $genre;
public $author_id;

private $conn;
private $table = 'books';

    /**
     * Book constructor.
     */
    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function getAll(){
        $query = 'select * from '. $this->table;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function getOne(){
        $query = 'select * from ' . $this->table . ' where id = :id';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->title = $row['title'];
        $this->total_pages = $row['total_pages'];
        $this->genre = $row['genre'];
        $this->author_id = $row['author_id'];



    }

    public  function delete(){
        $query = 'delete from ' . $this->table . ' where id = :id';

        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id) );

        $stmt->bindParam(':id',$this->id);

        if($stmt->execute()){
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function update(){
        $query = 'update ' . $this->table . ' set title = :title, total_pages = :total_pages, genre = :genre, author_id = :author_id where id = :id';

        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->total_pages = htmlspecialchars(strip_tags($this->total_pages));
        $this->genre = htmlspecialchars(strip_tags($this->genre));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->id = htmlspecialchars(strip_tags(strip_tags($this->id)));

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':total_pages', $this->total_pages);
        $stmt->bindParam(':genre', $this->genre);
        $stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;

    }

    public function create(){
        $query = 'insert into ' .$this->table. '(title, total_pages,genre,author_id)values(:title , :total_pages, :genre,:author_id)';

        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->total_pages = htmlspecialchars(strip_tags($this->total_pages));
        $this->genre = htmlspecialchars(strip_tags($this->genre));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':total_pages', $this->total_pages);
        $stmt->bindParam(':genre', $this->genre);
        $stmt->bindParam(':author_id', $this->author_id);

        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }




}