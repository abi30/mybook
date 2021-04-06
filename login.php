<?php 
session_start();
include ("classes/connect.class.php");
include ("classes/login.class.php");
include ("head.php");
    
$email="";
$password="";
 
if($_SERVER['REQUEST_METHOD']=='POST'){
     $login= new login ();
     $result= $login->evaluate($_POST); 
 
     if ($result !=''){
          echo '<div style ="text-align:center;font-size:12px;color:white;background-color:grey;">';     
          echo "The following errors occured: <br><br>";
          echo $result ; 
          echo '</div>'; 
     } else{
          header("Location:profile.php");
      die();
     }
     // after POST fetch the data input filds
     $email=$_POST['email'];
     $password=$_POST['password'];
}
?>
<div  id ="bar">
     <div style="font-size:40px;">Mybook</div>
     <div id="login_button"> <a href="signup.php"> Signup </a> </div>
</div>

<div id = "bar2">
     <form action="" method="POST">
          log in to mybook <br><br>
          <input name="email" value="<?php echo $email ;?>" type="text"id="text"placeholder="Email" ><br><br>
          <input name="password" value="<?php echo $password ;?>" type="password"id="text"placeholder="password"><br><br>
          <input type="submit" id="button" value = "log in">
          <br><br><br>
     </form>
</div>

<?php
include ("footer.php");
?>