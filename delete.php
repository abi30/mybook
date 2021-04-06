<?php 
include("classes/autoload.php");
include("head.php");
include("header.php");  

$login= new Login();
$user_data=$login->check_login($_SESSION['mybook_userid']);

$post= new Post();
$ERROR="";  
 
if (isset($_GET['id']))
{
        $ROW = $post->get_one_post($_GET['id']);
        if (!$ROW){
                $ERROR="No such post was found!";    
        }else{
                if($ROW['userid'] != $_SESSION['mybook_userid']){
                        $ERROR="Access denied! you can't delete this file!";  
                }
        }

}else{
        $ERROR="No such post was found!";    
}

// if something was posted
if ($_SERVER['REQUEST_METHOD']== "POST") {
        $post->delete_post($_POST['postid']);
        header("Location:profile.php");
        die();
}
?>
<!---------------------------- HTML --------------------------->
<br>
<!-- cover area-->
<div class="cover">
        <!--below cver area-->
        <div class="below-cover">
                <!--posts area-->
                <div class="post">
                        <div class="post-area">
                                <form method = "post" action="">  
                                <?php 
                                        if ($ERROR!=""){
                                                echo $ERROR;
                                        }else{
                                                echo "  Are you sure want to delete this post??<br>";
                                                $user= new User();
                                                $ROW_USER =$user->get_user($ROW['userid']);
                                                include("post_delete.php");
                                                echo " <input type='hidden' name='postid' value='$ROW[postid]'>";
                                                echo "<input type='submit'id='post_button'value='Delete'>";
                                        }
                                ?>
                                <br>
                                </form>
                        </div>
                </div>
        </div>
</div>
<?php
        include("footer.php");
?>