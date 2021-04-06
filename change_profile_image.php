<?php 
include ("classes/autoload.php");
include("head.php");
include("header.php");

$login= new Login();
$user_data=$login->check_login($_SESSION['mybook_userid']);

if ($_SERVER['REQUEST_METHOD']=="POST"){

     if (isset($_FILES['file']['name'])&& $_FILES['file']['name']!=""){
   
        if ($_FILES['file']['type']=="image/jpeg" || $_FILES['file']['type']=="image/png"){

                $allowed_size=(1024*1024)* 7;
 
                if ($_FILES['file']['size'] < $allowed_size){
                        //every thing okey...
                       
                        $folder="uploads/".$user_data['userid'] ."/"; 
                        //create folder 
                        
                        if (!file_exists($folder)){
                                // file permissions 7777 google it 
                                mkdir ($folder,0777,true);
                        }

                        $image=new Image();

                        $filename=$folder.$image->generate_filename(15).".jpg";
                        move_uploaded_file($_FILES['file']['tmp_name'],$filename);
                        $change='profile';
                
                        // check for mode
                        if(isset($_GET["change"])){
                                $change=$_GET["change"];
                        }

                        if ($change=="cover"){
                                if (file_exists($user_data['cover_image']))
                                {
                                        unlink($user_data['covr_image']);
                                }
                                $image->resize_image($filename,$filename,1500,1500);
                        }else
                        {
                                if (file_exists($user_data['profile_image']))
                                {
                                        unlink($user_data['profile_image']);
                                }
                                $image->resize_image($filename,$filename,1500,1500);
                        }
                
                        if (file_exists($filename)){

                                $userid=$user_data['userid'];
                     
                                if ($change=="cover"){
                                        $sql = "update users set cover_image = '$filename' where userid = '$userid' limit 1";
                                        $_POST['is_cover_image']=1;
                                }else{
                                        $sql = "update users set profile_image = '$filename' where userid = '$userid' limit 1";
                                        $_POST['is_profile_image']=1;
                                }

                                $DB = new Database();
                                $DB->save($sql);

                                // create a post
                                $post = new Post();
                                $post->create_post($userid,$_POST,$filename);
                                
                                header("Location:profile.php");
                                die();
                        }

                        }else{
                                echo '<div style ="text-align:center;font-size:12px;color:white;background-color:grey;">';     
                                echo "The following errors occured: <br><br>";
                                echo  "only  imagees size 7MB! or lower are allowed!" ; 
                                echo '</div>';
                        }
                }else{

                        echo '<div style ="text-align:center;font-size:12px;color:white;background-color:grey;">';     
                        echo "The following errors occured: <br><br>";
                        echo  "only  image of jpeg or png type!" ; 
                        echo '</div>';
                }

        }else{

                echo '<div style ="text-align:center;font-size:12px;color:white;background-color:grey;">';     
                echo "The following errors occured: <br><br>";
                echo  "please add a valid image" ; 
                echo '</div>';
        }
}
 ?>
<br>
<!--------------------------- HTML ----------------------------> 
<!-- cover area-->
<div class="cover">
     <!--below cver area-->
     <div class="below-cover">
          <!--posts area-->
          <div class="post">
                <form method="post" enctype="multipart/form-data">
                <div class="post-area">
                        <input type="file" name="file"><br>
                        <input type="submit"name="" id="post_button"value="change">
                        <br>
                        <div style= "text-align:center;">
                        <br><br>
                        <?php
                                $change='profile';

                                if(isset($_GET["change"])&&  ($_GET["change"]=="cover"))
                                {
                                        $change="cover";
                                        echo "<img src ='$user_data[cover_image]' style= 'max-width:500px'>";
                                }else{
                                        echo "<img src ='$user_data[profile_image]' style= 'max-width:500px'>";
                                }
                        ?>
                        </div>
                </div>
                </form>
          </div>
     </div>
</div>


