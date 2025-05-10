<?php
require_once '../../Controllers/DBcontroller.php';
require_once '../../Models/host_listings.php';

class host_listingscontroller{
protected $db;
public function savelisting(host_listings $listing){
  $this->db=new DBcontroller;
  if($this->db->openconnection()){
      $query = "INSERT INTO host_listings (host_id,title,`description`,accommodation_details,`location`,country,city) 
                VALUES ('$listing->host_id', '$listing->title', '$listing->description', '$listing->accommodation_details', '$listing->location','$listing->country','$listing->city' )";
      $result=$this->db->insert($query);
      if($result){
        echo "Registeration complete";
      }else{
        echo "Registeration failed";
      }
      
  }

}
public function getLastId(){
    $this->db=new DBcontroller;
  $this->db->openconnection();
  $result= $this->db->fetch("SELECT id FROM users WHERE role = 1 ORDER BY id DESC LIMIT 1");
  $result=mysqli_fetch_assoc($result);

  if(empty($result)){
    return 0;
  }else{
    return $result['id'];
  }
}

}


?>