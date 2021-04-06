<?php 

include ("classes/autoload.php");

$login= new Login();
 $user_data=$login->check_login($_SESSION['mybook_userid']);
 $USER= $user_data;//capital USER is current user.

if (isset($_GET['id']) && is_numeric($_GET['id']))
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
        $post = new Post();
        $id=$user_data['userid'];
        $result= $post->create_post($id,$_POST,$_FILES);

        if ($result==""){
                // redirect the same page:
                header("Location:index.php");
                die();
        }else{
                echo '<div style ="text-align:center;font-size:12px;color:white;background-color:grey;">';     
                echo "The following errors occured: <br><br>";
                echo $result ; 
                echo '</div>';
        }   
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
        <link rel="icon" href="res/img/logo.ico">
        <link  href="res/myCss.css?ver=<?php echo time(); ?>" rel="stylesheet">
        <title>FindFriend</title>
</head>

<body>
   <br>
   <?php include("header.php"); ?>
        <!-- cover area-->
        <div class="cover">

                <!--below cver area-->
                <div class="below-cover">
                        <!--friends area-->
                        <div style = "min-height:400px;flex:1;">
                        <!--timeline_picture-->
                        <!--friends_bar-->
                                <div id= "friends_bar">
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
                                        <a href="profile.php" style="text-decoration:none;">
                                                <?php echo $user_data['first_name']."<br>".$user_data['last_name'];?>
                                        </a>
                                </div>
                        </div>
                <!--posts area-->
                <div class="post">
                        <div class="post-area">
                                <form method="POST" action="" enctype= "multipart/form-data">                               
                                        <textarea name = "post" placeholder ="whats on your mind ?"name="" id="" cols="30" ROWs="5"></textarea>
                                        <input type="file"name="file">
                                        <input type="submit"name="" id="post_button"value="post" style= margin-top:15px;>
                                </form>
                                <br>
                        </div>
                 <!-- post_bar-->
                        <div id= "post_bar">
                        <?php 
                                $DB =new Database();
                                $user_class= new User();
                                $image_class= new Image();

                                // $posts=false;
                                $followers = $user_class->get_following($_SESSION['mybook_userid'],"user");
                
                                $follower_ids=false;
                                if(is_array($followers)){
                                        $follower_ids= array_column($followers,"userid");
                                        $follower_ids=implode("','" , $follower_ids);
                
                                }
        
                
                                if($follower_ids){
                                        $my_userid=$_SESSION['mybook_userid'];
                                        $sql= "select * from posts where userid ='$my_userid' || userid in('".$follower_ids."') order by id desc limit 30";
                                        $posts = $DB->read($sql);
                                }else{
                                        echo"your follower have no! ";
                                }

                                if (isset($posts)&& $posts){
                                        foreach($posts as $ROW){
                                                $user= new User();
                                                $ROW_USER = $user->get_user($ROW['userid']);
                                                include ('post.php');
                                        }
                                }
                        ?> 
                        </div>
                </div>
        </div>
</div>

<?php
include("footer.php");
?>