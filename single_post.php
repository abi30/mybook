<?php 
include ("classes/autoload.php");
include ("head.php");
include("header.php");

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
        $id = $_SESSION['mybook_userid'];
        $result= $post->create_post($id,$_POST,$_FILES);

        if ($result==""){
                // redirect the same page:
                header("Location:single_post.php?id=$_GET[id]");
                die();
        }else{
                echo '<div style ="text-align:center;font-size:12px;color:white;background-color:grey;">';     
                echo "The following errors occured: <br><br>";
                echo $result ; 
                echo '</div>';
        }
}


$Post=new Post();
$ROW=false;
       
$ERROR="";    
if (isset($_GET['id'])){
        $ROW=$Post->get_one_post($_GET['id']);   
}
else{
        $ERROR="No  post was found!";    
}

?>
<br>
<!-- cover area-->
<div style = "width: 800px; margin:auto;min-height:400px">        
        <!--below cver area-->
        <div style="display :flex;">
                <!--posts area-->
                <div style = "min-height:400px;flex:2.5;padding : 20px ;padding-right:0px;">
                        <div style = "border:solid thin #aaa; padding:10px;background-color:white;">
                
                        <?php 
                                $user=new User();
                                if(is_array($ROW)){
                                        $ROW_USER = $user->get_user($ROW['userid']);
                                        include("post.php");
                                }
                        ?>
                        <br style= "clear:both;">
                        <div style = "border:solid thin #aaa; padding:10px;background-color:white;">
                                <form method="Post" action="" enctype= "multipart/form-data">                               
                                        <textarea name = "post" placeholder ="Post a comment "name="" id="" cols="30" ROWs="5"></textarea>
                                        <input type="hidden" name ="parent" value="<?php echo $ROW['postid'];?> " >
                                        <input type="file"name="file"> 
                                        <input type="submit"name="" id="post_button"value="Post" style= margin-top:5px;>
                                        <br>
                                </form>
                        </div>
                  <?php
                //  commmet error sould be solved ############


                //      var_dump($ROW['postid']);
                //        $comments= $Post->get_comments($ROW['postid']);
                //       if (is_array($comments)){
                //          foreach ($comments as $COMMENT) {
                //                  # code...
                //                  include("comment.php");
                //          }
                
                //  }  
        
          ?>
                        </div>
                </div>
        </div>
</div>
<?php
        include ("footer.php");
?>