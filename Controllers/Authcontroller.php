<?php
require_once '../../Models/user.php';
require_once '../../Models/admin.php';
require_once '../../Controllers/DBcontroller.php';
require_once '../../vendor/functions.php';
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
      if($result['role']==2){
      $_SESSION['user']['id']=$result['id'];
      $_SESSION['user']['name']=$result['name'];
      $_SESSION['user']['image']=$result['image'];
      $_SESSION['user']['role']=$result['role'];
      $_SESSION['user']['error']=$this->db->error_messages;
      $_SESSION['user']['success']=$this->db->success_messages;
      header("location: ../index.php");

      }
      elseif($result['role']==1){
        $host_id=$_SESSION['host']['id']=$result['id'];
        $_SESSION['host']['name']=$result['name'];
        $_SESSION['host']['image']=$result['image'];
        $_SESSION['host']['role']=$result['role'];
        $query2="SELECT * FROM `host_listings` WHERE `host_id`=$host_id";
        $result2=$this->db->search($query2);

        if($result2){
          header("location: ../index.php");
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
            $allskills=implode(',', $user->skills);
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

      


public function login_admin(admins $admin){
$this->db=new DBcontroller;
  if($this->db->openconnection()){

    $query="SELECT * FROM `admins` WHERE email='$admin->email'";
    $result=$this->db->search($query);
    if(empty($result)){
      echo"Wrong email or password";
      die;
      return false;
  }else{
    if(password_verify($admin->password,$result['password'])){
      session_start();
      $_SESSION['admin']['id']=$result['id'];
      $_SESSION['admin']['name']=$result['name'];
      $_SESSION['admin']['image']=$result['image'];
      $_SESSION['admin']['error']=$this->db->error_messages;
      $_SESSION['admin']['success']=$this->db->success_messages;
      header("location: ../admin/admin_dashboard.php");
      return true;

  }
  }  

  }
  return false;
}



public function auth($role1=null,$role2=null){
if((isset($_SESSION['host'])&&$_SESSION['host']['role']==$role1)|| (isset($_SESSION['user'])&&$_SESSION['user']['role']==$role2)){

}
else{
header("Location:").baseurl("error403.php");
}
}


public function update_user_info($preferences ,$skills,$user_id){
$this->db=new DBcontroller;
  if($this->db->openconnection()){
$query="UPDATE `users` SET `skills`='$skills',`preferences`='$preferences' WHERE id=$user_id";
$result=$this->db->update($query);
if($result){
$this->db->success_messages= "Information updated successfuly";
}else{
  $this->db->error_messages="error happened try again later";
}
header("Location:").baseurl("Traveler/traveler-profile.php");

  }
}

}



?>