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
        
$Post=new Post();
$ROW=false;
       
$ERROR="";    
       
if (isset($_GET['id'])){
        $ROW=$Post->get_one_post($_GET['id']);
}
else{
        $ERROR="No  Image was found!";    
}
?>
<br>
<!------------------------HTML------------------------------>
<!-- cover area-->
<div class="cover">
        <!--below cver area-->
        <div class="below-cover">
                <!--posts area-->
                <div class="post">
                        <div class="post-area">
                                
                                <?php 
                                        $user=new User();
                                        if(is_array($ROW)){
                                                echo "<img src ='$ROW[image]' sytle = 'width:90%' />";
                                        }
        
                                ?>
                                <br style= "clear:both;">
                        </div>

                </div>
        </div>
</div>
<?php
        include ("head.php");
?>