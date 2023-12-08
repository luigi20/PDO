<?php
require_once("interface/IBookRepository.php");
class BookRepository extends Book implements IBookRepository {
    public function findById($Iid){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM books WHERE book_id = :ID", array(
            ":ID"=>$Iid
        ));
        if (count($results) > 0) {
            $row = $results[0];
            $this->setBookId($row['book_id']);
            $this->setName($row['name']);
            $this->setCategory($row['category']);
        }
    }

    public function getAll(){
        $sql = new Sql();
        return $sql->select("SELECT * FROM books");
    }

    public function create($Obook)
    {
        $sql = new Sql();
        return $sql->create($Obook);
    }

    public function update($Obook)
    {
        $sql = new Sql();
        return $sql->update($Obook);
    }

    public function delete($Iid)
    {
        $sql = new Sql();
        return $sql->delete($Iid);
    }

    public function __toString(){
        return json_encode(array(
            "book_id"=>$this->getBookId(),
            "name"=>$this->getName(),
            "category"=>$this->getCategory(),
        ));
    }
}
?>