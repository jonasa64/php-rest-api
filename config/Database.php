<?php


class Database
{
private $host = 'localhost';
private $dbname = 'author';
private $dnuser = 'root';
private  $dbpass = '';
private $conn;

public function getConnection(){
    $this->conn = null;
    try {

            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname='. $this->dbname , $this->dnuser, $this->dbpass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch (PDOException $exception){
        echo $exception->getMessage();

    }
    return $this->conn;
}



}