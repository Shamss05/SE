<?php
require_once '../../Models/user.php';
require_once '../../Controllers/DBcontroller.php';
class Authcontroller{
protected $db;
public function login(User $user){
$this->db=new DBcontroller;
  if($this->db->openconnection()){

    $query="SELECT * FROM `users` WHERE email='$user->email'";
    $result=$this->db->search($query);
    if(empty($result)){
      $this->db->error_messages[]="Wrong email or password";
      return false;
  }else{
    if(password_verify($user->password,$result['password'])){
      session_start();
      $_SESSION['user']['id']=$result['id'];
      $_SESSION['user']['name']=$result['name'];
      $_SESSION['user']['role']=$result['role'];
      $_SESSION['user']['error']=$this->db->error_messages;
      $_SESSION['user']['success']=$this->db->success_messages;
      if($_SESSION['user']['role']==2){
      header("location: ../index.html");
      }else{
        $host_id=$_SESSION['host']['id']=$result['id'];
        $_SESSION['host']['name']=$result['name'];
        $_SESSION['host']['role']=$result['role'];
        $query2="SELECT * FROM `host_listings` WHERE `host_id`=$host_id";
        $result2=$this->db->search($query2);

        if($result2){
          header("location: ../index.html");
        }else{
                header("location: ../auth/host_details.php");
        }
      }
      return true;

  }
  }

    

  }
  return false;
}

public function register(User $user){
    $this->db = new DBcontroller;
    if($this->db->openconnection()){
        // First check if email already exists
        $checkQuery = "SELECT * FROM `users` WHERE email='$user->email'";
        $existingUser = $this->db->search($checkQuery);
        
        if(!empty($existingUser)){
            echo "Email already exists";
            return false;
        }else{
          if($user->skills=="No skills for host"){
                $allskills=$user->skills;
          }else{
            $allskills="";
            $i=0;
          foreach($user->skills as $skill){
            $i++;
            $allskills=$allskills.$i.$skill;
          }
          }

          $query = "INSERT INTO `users` (name, email, password, Country, image, role, skills, preferences) 
          VALUES ('$user->name', '$user->email', '$user->password', '$user->Country', 
                  '$user->image', '$user->role', '$allskills', '$user->preferences')";
  
          $result = $this->db->insert($query);
 
             if(!$result){
              echo "Registration failed";
              return false;
            }else{
               return true;
            }
}
return false;
}
        }

      

}




?>