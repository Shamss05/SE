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
      echo "wrong email or password";
      return false;
  }else{
    if(password_verify($user->password,$result['password'])){
      session_start();
      $_SESSION['id']=$result['id'];
      $_SESSION['name']=$result['name'];
      $_SESSION['role']=$result['role'];
      header("location: ../index.html");
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