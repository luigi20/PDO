<?php

class Book {
    private $Sbook_id;
    private $Sname;
    private $Scategory;

    public function __construct($Sbook_id = null,$Sname=null,$Scategory=null)
    {
        $this->Sbook_id = $Sbook_id;
        $this->Sname = $Sname;
        $this->Scategory = $Scategory;
    }
    public function getBookId(){
        return $this->Sbook_id;
    }

    public function setBookId($value){
        $this->Sbook_id = $value;
    }

    public function getName(){
        return $this->Sname;
    }

    public function setName($value){
        $this->Sname = $value;
    }

    public function getCategory(){
        return $this->Scategory;
    }

    public function setCategory($value){
        $this->Scategory = $value;
    }
}

?>