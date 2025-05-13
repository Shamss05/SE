<?php
require_once '../../Controllers/DBcontroller.php';
require_once '../../Models/stay_request.php';
require_once '../../vendor/functions.php';

class stayrequestcontroller{
protected $db;

public function save_request(stay_request $request){
  $this->db=new DBcontroller;

if($this->db->openconnection()){
session_start();
$query="INSERT INTO `stay_requests`(`traveler_id`, `listing_id`, `message`, `status`, `start_date`, `end_date`) VALUES ('$request->traveler_id','$request->listing_id','$request->message','$request->status','$request->start_date','$request->end_date')";
$result=$this->db->insert($query);
if($result){
echo "added successfully";
die;
}else{
  echo "failed";
  die;
}
}
}

}




?>