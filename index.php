<?php
session_start();
require_once("config.php");
require_once("repositories/bookRepository.php");
$book_repository = new BookRepository();
//$user_repository->findById(1);
//$userList = $user_repository->getAll();
//$Onew_book = new Book("","O Senhor dos Aneis","fantasia");
//$Ocreate_book = $book_repository->create($Onew_book);
//var_dump($Ocreate_book);
//$Onew_book = new Book("10","Narnia","fantasia");
//$Ocreate_book = $book_repository->update($Onew_book);
// $book_repository->delete(10);
//echo $Ocreate_book;

//É só descomentar as linhas de cima ou se prefirir ver com as linhas de baixo e só mudar algumas coisas em relação aos verbos http e os metodos da classe
if($_SERVER["REQUEST_METHOD"]=="POST"){
  if (isset($_POST['name']) && isset($_POST['category'])) {
    $Sname = $_POST['name'];
    $Scategory = $_POST['category'];
    $Onew_book = new Book("","O Senhor dos Aneis","fantasia");
    $book_repository->create($Onew_book);
  } else {
      echo "Por favor, preencha todos os campos obrigatórios.";
  }
}
?>