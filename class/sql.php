<?php

class Sql extends PDO {
  private $conn;

  public function __construct()
  {
    $this->conn = new PDO("mysql:host=localhost;dbname=dbphp7","root","root");
  }

  private function setParams($statment,$parameters){
    foreach($parameters as $key => $value){
      $this->setParam($statment,$key,$value);
    }
  }

  private function setParam($statment,$key,$value){
    $statment->bindParam($key,$value);
  }

  public function queryWithParams($rawQuery,$params = array()){
    $stmt = $this->conn->prepare($rawQuery);
    $this->setParams($stmt,$params);
    $stmt->execute();
    return $stmt;
  }

  public function select($rawQuery,$params = array()){
    $stmt = $this->queryWithParams($rawQuery, $params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function create ($book){
    $stmt = $this->conn->prepare("INSERT INTO books (name, category) VALUES (:name, :category)");
    $Sname = $book->getName();
    $Scategory= $book->getCategory();
    $stmt->bindParam(':name', $Sname);
    $stmt->bindParam(':category', $Scategory);
    $stmt->execute();
    $book->setBookId($this->conn->lastInsertId());
    return $book;
  }

  public function update ($book){
    $stmt = $this->conn->prepare("UPDATE books SET name = :name, category = :category WHERE idbooks = :id");
    $Ibook_id = $book->getBookId();
    $Sname = $book->getName();
    $Scategory= $book->getCategory();
    $stmt->bindParam(':id', $Ibook_id);
    $stmt->bindParam(':name', $Sname);
    $stmt->bindParam(':category', $Scategory);
    $stmt->execute();
    return $book;
  }

  public function delete ($Iid){
    $stmt = $this->conn->prepare("DELETE FROM books WHERE idbooks = :id");
    $stmt->bindParam(':id', $Iid);
    $stmt->execute();
  }

  public function setData($data){
  $Sbook = new Book();
  $Sbook->setBookId($data['book_id']);
  $Sbook->setName($data['name']);
  $Sbook->setCategory($data['category']);
}
}

?>