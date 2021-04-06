<?php 
  include ("classes/connect.class.php");
  include ("classes/signup.class.php");
  // before POST      
  $first_name="";
  $last_name="";
  $gender="";
  $email="";
  $password="";
  $password2="";

  if ($_SERVER['REQUEST_METHOD']=='POST'){
     $signup= new signup ();
     $result= $signup->evaluate($_POST); 
     
     if ($result !=''){
        echo '<div style ="text-align:center;font-size:12px;color:white;background-color:grey;">';     
        echo "The following errors occured: <br><br>";
        echo $result ; 
        echo '</div>'; 
      } else{
          header("Location:login.php");
          die();
      }
   
     // after POST fetch the data input filds
     $first_name=$_POST['first_name'];
     $last_name=$_POST['last_name'];
     $gender=$_POST['gender'];
     $email=$_POST['email'];
  }
?>

<!doctype html>
<html lang="en">
  <head>

    <!--Required meta tags-->
    <meta charset="utf-8">
    <meta id="viewport" content="width=device-width, initial-scale=1">  
    <!--Bootstrap CSS-->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link  href="res/signup.css?ver=<?php echo time(); ?>" rel="stylesheet">
    <title>mybook | signup </title>
    <link rel="icon" href="res/img/logo.ico">
  </head>
  
  <body style= "font-family:tahoma;background-color:#e9ebee; ">

   <div  id ="bar">
      <div style="font-size:40px;">mybook</div>
        <div id="signup_button"> <a href="login.php">log in</a> </div>
   </div>

   <div id = "bar2">
     Sign up to mybook <br><br>
        <form method = "POST"action="">
            <input value="<?php echo $first_name;?>" name="first_name" type="text"id="text"placeholder="Firstname" ><br><br>
            <input value="<?php echo $last_name;?>"name="last_name"type="text"id="text"placeholder="Lastname" ><br><br>

            <span style ="font-weight:normal;">Gender:</span><br>
            <select name="gender" id="text">
                <option><?php echo $gender;?></option>
                <option>Male</option>
                <option>Female</option>
            </select>

            <br><br>

            <input  value="<?php echo $email;?>" name="email" type="text"id="text"placeholder="Email" ><br><br>

            <input name="password"type="password"id="text"placeholder="password"><br><br>
            <input name="password2"type="password"id="text"placeholder="Retype password"><br><br>

            <input type="submit" id="button" value = "Sign up">
            <br><br><br>
       </form>
   </div> 
<?php
include ("footer.php");
?>
