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
    return $stmt->fetchAll();
  }

  public function create($book){
    $rawQuery = "INSERT INTO books (name, category) VALUES (:name, :category)";
    $params = array(':name'=>$book->getName(),':category'=>$book->getCategory());
    $results = $this->select($rawQuery,$params);
    if(count($results) > 0){
      $this->setData($results[0]);
    }
    return $book;
  }

  public function update($Obook){
    $rawQuery = "UPDATE books SET name = :name, category = :category WHERE idbooks = :id";
    $params = array(':id'=>$Obook->getBookId(),':name'=>$Obook->getName(),':category'=>$Obook->getCategory());
    $results = $this->select($rawQuery,$params);
    if(count($results) > 0){
      $this->setData($results[0]);
    }
  }

  public function delete($Iid){
    $rawQueryDelete = "DELETE FROM books WHERE idbooks = :id";
    $params = array(':id'=>$Iid);
    $this->select($rawQueryDelete,$params);
  }

  public function setData($data){
   $Obook = new Book();
   $Obook->setBookId($data['book_id']);
   $Obook->setName($data['name']);
   $Obook->setCategory($data['category']);
   echo $Obook;
 }
}

?>