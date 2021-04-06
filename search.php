
<?php 
include ("classes/autoload.php");
include ("head.php");
include("header.php");

$login= new Login();
$user_data=$login->check_login($_SESSION['mybook_userid']);

if (isset($_GET['find'])){
    $find = addslashes($_GET['find']);
    $sql= "select *from users where first_name like '%$find%' || last_name like '%$find%' limit 20";
    $DB= new Database();
    $results= $DB->read($sql);
}
?>


<br>
<!-- cover area-->
<div style = "width: 800px; margin:auto;min-height:400px"> 
  
<!--below cver area-->
  <div style="display :flex;">

    <!--posts area-->
    <div class="post">
      <div class="post-area">
        <?php 
            $User=new User();
            if(is_array($results)){
              foreach($results as $key => $row){
                  $FRIEND_ROW = $User->get_user($row['userid']);
                  include("user.php");
              }
            }else{
              echo "no result were found";
            }
        ?>
        <br style= "clear:both;">
      </div>
    </div>
  </div>
</div>
