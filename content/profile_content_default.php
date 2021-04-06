<div style="display :flex;">
  <!--friends area-->
  <div style = "min-height:400px;flex:1;">
    <div id= "friends_bar">
        Friends <br>          
        <?php 
          if ($friends){
            foreach($friends as $FRIEND_ROW){
              include ('user.php');  
            }   
          }
        ?> 
        <br style="clear:both;">                
    </div>
  </div>
<!--posts area-->
  <div style = "min-height:400px;flex:2.5;padding : 20px ;padding-right:0px;">
    <?php 
    if($user_data['userid']==$_SESSION['mybook_userid']){ 
    echo ' <div style = "border:solid thin #aaa; padding:10px;background-color:white;">
              <form method="POST" action="" enctype= "multipart/form-data">                               
                <textarea name = "post" placeholder ="whats on your mind ?"name="" id="" cols="30" ROWs="5"></textarea>
                <input type="file"name="file">
                <input type="submit"name="" id="post_button"value="post" style= margin-top:15px;>
              <br> 
              </form>
            </div>';
    }
    ?>

  <!-- post_bar-->
  <div id= "post_bar">
  <?php 
    if ($posts){
        foreach($posts as $ROW){
            $user= new User();
            $ROW_USER = $user->get_user($ROW['userid']);
            include ('post.php');
        }    
    }
  ?> 
  <br style ="clear:both;">
  </div>
  </div>
</div>