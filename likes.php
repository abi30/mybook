<?php 
include("classes/autoload.php");
include("head.php");
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
$likes=false;
       
$ERROR="";    

if (isset($_GET['id']) && isset($_GET['type']))
{ 
        $likes=$Post->get_likes($_GET['id'],$_GET['type']);
}else
{
        $ERROR="No information post was found!";    
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
                        <?php 
                                $User=new User();
                                if(is_array($likes)){
                                        foreach($likes as $key => $row){
                                                $FRIEND_ROW = $User->get_user($row['userid']);
                                                include("user.php");

                                        }
                                }
                                else{
                                        echo "";
                                }
        
                
                        ?>
                        <br style= "clear:both;">
                        </div>
                </div>
        </div>
</div>

<?php
        include("footer.php");
?>