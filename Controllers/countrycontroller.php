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

}


?>