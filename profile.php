<?php 

include("classes/autoload.php");
//user data after login.
$login= new Login();
$user_data=$login->check_login($_SESSION['mybook_userid']);
$USER= $user_data;//capital USER is current user.

if(isset($_GET['id']) && is_numeric($_GET['id']))
{
        $profile= new Profile();
        $profile_data=$profile-> get_profile($_GET['id']);
        
        if (is_array($profile_data))
        {
                $user_data=$profile_data[0];      
        }
}
// posting start from here.  
if ($_SERVER['REQUEST_METHOD']=="POST"){
        // collect post 
        if(isset($_POST['first_name'])){
                $settings_class= new Settings();
                $settings_class->save_settings($_POST,$_SESSION['mybook_userid']);
        }else{

                $post = new Post();
                $id = $_SESSION['mybook_userid'];
                $result= $post->create_post($id,$_POST,$_FILES);

                if ($result==""){
                        // redirect the same page:
                        header("Location:profile.php");
                        die();
                }else{
                        echo '<div style ="text-align:center;font-size:12px;color:white;background-color:grey;">';     
                        echo "The following errors occured: <br><br>";
                        echo $result ; 
                        echo '</div>';
                }

        }
}
  
// collect post
$post = new Post();
$id=$user_data['userid'];
$posts= $post->get_posts($id);

// collect friends
$user = new User();
$friends= $user->get_friends($id);
$image_class=new Image(); 
    
?>

<!doctype html>
<html lang="en">
  <head>
    <!--Required meta tags-->
    <meta charset="utf-8">
    <meta id="viewport" content="width=device-width, initial-scale=1">  
    <!--Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="icon" href="res/img/logo.ico">
    <title>FindFriend</title>
    <link  href="res/index.css?ver=<?php echo time(); ?>" rel="stylesheet">
    <link  href="res/profile.css?ver=<?php echo time(); ?>" rel="stylesheet">
  </head>

  <body style= "font-family:tahoma;background-color:#d0d8e4; ">
  <br>
<!--top bar -->
        <!-- ____header.php______ -->
        <?php  include("header.php"); ?>
        <!-- cover area-->
        <div style = "width: 800px; margin:auto;min-height:400px">
                <div style ="background-color :white; text-align:center;color:#405d9b;">
       
                        <!-- cover image  -->
                        <?php 
                                $image="images/cover_image.jpg";
                                if(file_exists($user_data['cover_image']))
                                {
                                        $image=  $image_class->get_thumb_cover($user_data['cover_image']);    
                                }
                        ?>
  
                        <img src="<?php echo $image; ?>" style="width:100%;">

                        <span style="font-size:12px;">
                                <!-- profile image -->
                                <?php 
                                        $image="images/user_male.jpg";
                                        if($user_data["gender"]=="Female")
                                        {
                                                $image="images/user_female.jpg";
                                        }
                        
                                        if(file_exists($user_data['profile_image']))
                                        {
                                                $image= $image_class->get_thumb_profile($user_data['profile_image']);    
                                        }

                                ?>

                                <img id = "profile_pic" src="<?php echo $image; ?>"><br/>

                                <a style="text-decoration:none;color:#f0f;" href="change_profile_image.php?change=profile_pic&id=id=<?php echo $user_data['userid']?>">Change Profile Image </a> |
                                <a style="text-decoration:none;color:#f0f;" href="change_profile_image.php?change=cover&id=<?php echo $user_data['userid']?>">Change Cover</a>
                        </span>
                        <br>
                <div>

                <div style= "font-size:20px;">
                        <a href="profile.php?id=<?php echo $user_data['userid'];?>">
                                <?php echo $user_data['first_name']." ".$user_data['last_name'];?>
                        </a>
                </div>
  

                <div>
                        <?php 
                                $mylikes="" ;
                                if($user_data['likes']>0){
                                        $mylikes="(" .$user_data['likes'] ." Followers)";
                                }
                        ?>

                        <a href="like.php?type=user&id=<?php echo $user_data['userid'] ;?>">
                                <input type="submit"name="" id="post_button"value="Follow <?php echo $mylikes ?>"style= "min-width:150px; margin-right:10px; background-color:#9b409a;">
                        </a>
                </div> 
   
        </div>
                <br>

                <a href="index.php"><div id="menu_buttons">Timeline </div></a>
                <a href="profile.php?section=about&id=<?php echo $user_data['userid']?>"><div id="menu_buttons">About </div></a>
                <a href="profile.php?section=followers&id=<?php echo $user_data['userid']?>"><div id="menu_buttons"> Followers </div></a>
                <a href="profile.php?section=following&id=<?php echo $user_data['userid']?>"><div id="menu_buttons"> Following </div></a>
                <a href="profile.php?section=photos&id=<?php echo $user_data['userid']?>"><div id="menu_buttons">Photos </div></a>
            
                <?php 
                        if($user_data['userid']==$_SESSION['mybook_userid']){
                                echo ' <a href="profile.php?section=messages&id='.$user_data['userid'].'"><div id="menu_buttons">message</div></a>';
                                echo ' <a href="profile.php?section=settings&id='.$user_data['userid'].'"><div id="menu_buttons"> Settings</div></a>';
                        }
                ?>
        </div>
        <!--below cver area-->
        <?php 
                $section= "default";
                if (isset($_GET['section'])){
                        $section= $_GET['section'];
                }
                if($section=="default"){
                        include ("content/profile_content_default.php");
                }elseif($section=="following"){
                        include ("content/profile_content_following.php");
                }elseif($section=="followers"){
                        include ("content/profile_content_followers.php");
                }elseif($section=="about"){
                        include ("content/profile_content_about.php");
                }elseif($section=="settings"){
                        include ("content/profile_content_settings.php");
                }elseif($section=="photos"){
                        include ("content/profile_content_photos.php");
                }elseif($section=="messages"){
                        include ("content/profile_content_messages.php");
                }
        ?>
</div>

<?php
        include ("footer.php");
?>