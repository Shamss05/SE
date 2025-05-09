<?php
require_once '../../Controllers/DBcontroller.php';
class taskscontroller{
  protected $db;
  public function fetch_tasks(){
    $this->db=new DBcontroller;
    $this->db->openconnection();
    $query_tasks="SELECT * FROM `categories`";
    return $this->db->fetch($query_tasks);
  }

}


?>


