<?php

require_once './class/autoload.php';
require_once './class/Connection.php';


class Base extends Connection{
    
    private $con;
    private $sql;
    private $query;
    
    
 private $num;
    public function __construct() {
        $this->con = self::getInstance();
    }
    
    public static function DB(){
        
        return new Base;
        
    }

    public static function getInstance(){

    $con = new mysqli('localhost',"root","1234","tltube");    
    $con->set_charset("utf8");
    return $con;
    
    }
    
      function fetchAll(){

        $this->query->fetch_row();

        return $this->query;
    }
    
   function query($sql){

         $this->query = $this->con->query($sql);
         return $this;
    }
    
    
    
    function first(){
         $row = mysqli_fetch_assoc($this->query);
         return $row;
    }

    
    
  

  
    
    
}