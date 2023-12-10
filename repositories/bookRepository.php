<?php
require_once("interface/IBookRepository.php");
class BookRepository extends Book implements IBookRepository {
    public function findById($Iid){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM books WHERE idbooks = :ID", array(
            ":ID"=>$Iid
        ));
        if (count($results) > 0) {
            $row = $results[0];
            $Obook = new Book($row['idbooks'],$row['name'],$row['category']);
            return $Obook;
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
        $result = $this->findById($Obook->getBookId());
        if (isset($result)) {
         $sql = new Sql();
         return $sql->update($Obook);
        }else{
          echo 'Livro inexistente';
        }
    }

    public function delete($Iid)
    {
        $result = $this->findById($Iid);
        if (isset($result)) {
            $sql = new Sql();
            return $sql->delete($Iid);
        }else{
            echo 'Livro inexistente';
        }
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