<?php
require_once '../../Controllers/DBcontroller.php';
require_once '../../Models/host_listings.php';

class host_listingscontroller{
protected $db;
public function savelisting(host_listings $listing){
  $this->db=new DBcontroller;
  if($this->db->openconnection()){
    session_start();
    $host_id=$_SESSION['host']['id'];
      $query = "INSERT INTO host_listings (host_id,title,`description`,accommodation_details,`language_required`,`location`,country,city) 
                VALUES ('$host_id', '$listing->title', '$listing->description', '$listing->accommodation_details','$listing->language_required', '$listing->location','$listing->country','$listing->city' )";
      return $result=$this->db->insert($query);
          if($result){
            $this->db->$success_messages[]= "List is Sent to admin for review";
            }else{
             $this->db->$error_messages[]="There is an error please try again later";
            }
      
  }

}


}


?>