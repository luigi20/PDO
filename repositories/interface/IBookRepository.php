<?php
interface IBookRepository {
  public function findById($Iid);
  public function getAll();
  public function __toString();
  public function create($Obook);
  public function update($Obook);
  public function delete($Iid);
}
?>