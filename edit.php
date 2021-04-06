<?php 
include ("classes/autoload.php");
include ("head.php");
include ("header.php");

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


if (isset ($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "edit.php")){
     $_SESSION['return_to']= $_SERVER['HTTP_REFERER'];
}

// if something was posted
if ($_SERVER['REQUEST_METHOD']== "POST") {
        $post->edit_post($_POST,$_FILES);
        header("Location:".$_SESSION['return_to']);
}

?>
<br>
<!-- cover area-->
<div class="cover">    
        <!--below cver area-->
        <div class="below-cover">
                <!--posts area-->
                <div class="post">
                        <div class="post-area">
                                <form method = "post" action="" enctype= "multipart/form-data">  
                                <?php 
                                        if ($ERROR!=""){
                                                echo $ERROR;
                                        }else{
                                                echo "Edit post <br>";
                                                echo ' <textarea name = "post" placeholder ="whats on your mind ?"name="" id="" cols="30" ROWs="5">'.$ROW['post'].'</textarea>
                                                <input type="file"name="file">';

                                                echo " <input type='hidden' name='postid' value='$ROW[postid]'>";
                                                echo "<input type='submit'id='post_button'value='Save'>";

                                                if (file_exists($ROW['image']))
                                                {
                                                        $image_class=new Image();
                                                        $post_image=$image_class->get_thumb_post($ROW['image']);
                                                        echo "<div style='text-align:center' ><img src = '$post_image' style = 'width:60% '/></div>";
                                                }

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