<?php


class Author
{
public $id;
public $name;
public $latest_book;

private $conn;
private $table = 'authors';

    /**
     * Author constructor.
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

        $this->id = htmlspecialchars(strip_tags($this->id) );

        $stmt->bindParam(':id', $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->latest_book = $row['latest_book'];
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
    $query = 'update ' . $this->table . ' set name = :name, latest_book = :latest_book where id = :id';

    $stmt = $this->conn->prepare($query);

    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->latest_book = htmlspecialchars(strip_tags($this->latest_book));
    $this->id = htmlspecialchars(strip_tags(strip_tags($this->id)));

    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':latest_book', $this->latest_book);
    $stmt->bindParam(':id', $this->id);

    if($stmt->execute()){
        return true;
    }
        printf("Error: %s.\n", $stmt->error);
    return false;

    }

    public function create(){
        $query = 'insert into ' .$this->table. '(name, latest_book)values(:name , :latest_book)';

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->latest_book = htmlspecialchars(strip_tags($this->latest_book));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':latest_book', $this->latest_book);

        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }



}