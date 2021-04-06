<?php 
class Login{

private $error='';

//------------------ evaluate function -------------------//
public function evaluate($data){

    // escaping funtion addslashes(). it is a string function.look like "\".  
    $email=addslashes( $data['email']);
    $password= addslashes($data['password']);

    $sql="select * from users where email= '$email' and (user_status =1 or is_admin =1)  limit 1";//return = limit one row 
    //echo $sql;
    $DB = new Database();
    $result = $DB->read($sql);

    if ($result){
        $row = $result[0];

        if ($this->hash_text($password)==$row['password']){
            // create session data.
            $_SESSION['mybook_userid']=$row['userid'];

        }else{
            $this->error.="Wrong email or password!<br>";
        }

    }else{
        $this->error .= "Wrong email or password!<br>";
        }
    return $this->error;   
}

//------------------ hash-text function -------------------//
private function hash_text($text)
{
    $text = hash("sha1",$text);
    return $text;
}

//------------------ evaluate function -------------------//
 public function check_login($id){
    
    if(is_numeric($id)){
        $sql="select * from users where userid ='$id' limit 1";
        
        $DB=new Database();
        $result = $DB->read($sql);

        if ($result){
            $user_data=$result[0];  
            return $user_data;
        }else{
            header("Location:login.php");
            die();
        }   
    }else{
        header("Location:login.php");
        die();
    }

}
}
?>