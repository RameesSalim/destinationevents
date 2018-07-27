
<?php
class USER
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
 
 
    public function login($uname,$upass)
    {
       try
       {
          $stmt = $this->db->prepare("SELECT * FROM user WHERE username=:uname LIMIT 1");
          $stmt->execute(array(':uname'=>$uname));
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
             if(password_verify($upass, $userRow['password']))
             {
                $_SESSION['user_session'] = $userRow['username'];
                
                $_SESSION['details']=array("name"=>$userRow['name'],"college"=>$userRow['college']);
                $_SESSION['admin']=$userRow['admin'];
                $_SESSION['verify']=$userRow['verify'];
                return true;
             }
             else
             {
                return false;
             }
          }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
 
   public function is_loggedin()
   {
      if(isset($_SESSION['user_session']))
      {
         return true;

      }
   }
 
   public function redirect($url)
   {
       header("Location: $url");
   }
 
   public function logout()
   {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
        header("Location:index.php");
   }
}

/*function signin($user, $pass){


  	$username = mysqli_real_escape_string($db, $user);
   	$password = mysqli_real_escape_string($db, $pass);
  	$sql = "SELECT `username`,`password` FROM `user` WHERE username='".$username."' LIMIT 1 "; 
  	$result = mysqli_query($db, $sql);
  	$id = mysqli_fetch_array($result);
 	 if($id){
  	 	$password_hash = $id['password'];

 	 	 /*$password_hashed = password_hash($password_hash,PASSWORD_BCRYPT);*/
 	 	 /*if(password_verify($password,$password_hash)) {
  	 	 	return true;
  	 	 	$_SESSION['details']=array("name"=>$id['name'],"college"=>$id['college'],"admin"=>$id['admin']);
  	 	 	$_SESSION['username']=$id['username'];

  	 	}
  	} else {
  	 	return false;
  	}
}*/
/*function signup($name,$email,$user,$pass)
{

	try
       {
           	$pass_hashed=password_hash(mysqli_real_escape_string($db,$pass),PASSWORD_DEFAULT);
   
           $stmt = $this->db->prepare("INSERT INTO user(name,user_email,user_pass) VALUES(:uname,:umail,:upass)");
              
           $stmt->bindparam(":uname", $name);
           $stmt->bindparam(":umail", $email);
           $stmt->bindparam(":upass", $pass_hashed);            
           $stmt->execute(); 
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
}
*/



?>