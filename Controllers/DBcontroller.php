<?php

class DBcontroller{
  public $error_messages=[];
  public $success_messages=[];
  public $host="localhost";
  public $username="root";
  public $pass="";
  public $dbname="traveling";
  public $connection;

  public function openconnection (){
    $this->connection=new mysqli($this->host,$this->username,$this->pass,$this->dbname);
    if($this->connection->connect_error){
      echo "Error in connection".$this->connection->connect_error; 
      return false;
    }else{
      return true;
    }
  }

  public function closeconnection(){
    if($this->connection){
      $this->connection->close();
    }else{
      echo "connection is not opened";
    }
  }

  public function search($query){
    $result=$this->connection->query($query);
    if(!$result){
      echo "Error:".mysqli_error($this->connection);
      return [];
    }else{
      return $result->fetch_assoc();
    }
  }


  public function insert($query){
    $result=$this->connection->query($query);
    if(!$result){
      echo "Error:".mysqli_error($this->connection);
      return false;
    }else{
      return true;
    }
  }

  

  public function fetch($query){
    return $this->connection->query($query);
  }

    public function update($query){
    $result=$this->connection->query($query);
    if(!$result){
      echo "Error:".mysqli_error($this->connection);
      return false;
    }else{
      return true;
    }
  }


}




?>