<?php
require_once '../../Controllers/DBcontroller.php';
class Countrycontroller{
  protected $db;
  public function fetch_counties(){
    $this->db=new DBcontroller;
    $this->db->openconnection();
    $query_contries="SELECT * FROM `country`";
    return $this->db->fetch($query_contries);
  }
  public function fetch_user_data($id){
    $this->db=new DBcontroller;
    $this->db->openconnection();
    $query="SELECT * FROM `user_with_country` WHERE id=$id";
    return $this->db->search($query);
  }

}


?>