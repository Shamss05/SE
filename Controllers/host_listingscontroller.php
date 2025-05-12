<?php
require_once '../../Controllers/DBcontroller.php';
require_once '../../Models/host_listings.php';
require_once '../../Models/host_images.php';
require_once '../../Models/availability.php';


class host_listingscontroller{
protected $db;
public function savelisting(host_listings $listing){
  $this->db=new DBcontroller;
  if($this->db->openconnection()){
    session_start();
    $host_id=$_SESSION['host']['id'];
      $query = "INSERT INTO host_listings (host_id,title,`description`,accommodation_details,`language_required`,`location`,country,city) 
                VALUES ('$host_id', '$listing->title', '$listing->description', '$listing->accommodation_details','$listing->language_required', '$listing->location','$listing->country','$listing->city' )";
       $result=$this->db->insert($query);
       if($result){
      return $this->db->connection->insert_id;
       }

          if($result){
            $this->db->success_messages[]= "List is Sent to admin for review";
            }else{
             $this->db->error_messages[]="There is an error please try again later";
            }
      
  }

}


public function savephotos(array $files,int $max,int $list_id){
  $this->db=new DBcontroller;
  $this->db->openconnection();
  $uploadDir = 'C:\xampp\htdocs\SE\Views\uploads/';
    if (count($files['name']) > $max) {
        $this->db->error_messages[]="Maximum $max files allowed.";
        return;
    }
     for ($i = 0; $i < count($files['name']); $i++) {
        $originalName = $files['name'][$i];
        $tmpPath = $files['tmp_name'][$i];
      

        // Generate random name
        $newName = rand(100, 1000) . '.' . $originalName;
        $destination = $uploadDir . $newName;
        move_uploaded_file($tmpPath, $destination);
        $this->db->success_messages[]= "Image uploaded successfully";
        $Names[$i]=$newName;

    }
    $listingimage=new host_images;
    $name1=$listingimage->img_1=$Names[0];
    $name2=$listingimage->img_2=$Names[1];
    $name3=$listingimage->img_3=$Names[2];


    $query="INSERT INTO `host_images`(`listing_id`, `img_1`, `img_2`, `img_3`) VALUES ('$list_id','$name1','$name2','$name3')";
  $result= $this->db->insert($query);
  if($result){
    $this->db->success_messages[]= "List added successfully";
  }else{
    $this->db->error_messages[]= "Error try again later";
  }
}

public function saveavalability(availability $avaliable){
  $this->db=new DBcontroller;
  $this->db->openconnection();
  
  
  
  $query="INSERT INTO `availability`(`listing_id`, `start_date`, `end_date`) VALUES ('$avaliable->listing_id','$avaliable->start_date','$avaliable->end_date')";
  $result= $this->db->insert($query);
  if($result){
    echo  "List added successfully";
    die;
  }else{
    echo "Error try again later";
    die;
  }
}


}


?>