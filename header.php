<?php
$corner_image="images/user_male.jpg";
if(isset($USER)){
  if(file_exists($USER['profile_image'])){
    $image_class=new Image();
    $corner_image= $image_class->get_thumb_profile($USER['profile_image']); 
  }else{
    if($USER['gender']== "Female"){
      $corner_image="images/user_female.jpg";
    }
  }
}
?>
<div id ="blue_bar">
  <form method = "GET" action="search.php">
      <div style="width : 800px;margin:auto;font-size:30px;">
        <a href="index.php" style="color:#d0d8e4;text-decoration:none;">Mybook</a>
        
        <input type="text" id="search_box" name= "find" placeholder = "search of people" >
        
        <a href="profile.php">
          <img src="<?php echo $corner_image ; ?>" style = " width:50px; float:right ;border-radius:2px">
        </a>
      
        <a href="logout.php">
          <span style="font-size:14px;float:right;margin:10px;color:white">logout</span>
        </a>
      </div>
  </form>
</div>