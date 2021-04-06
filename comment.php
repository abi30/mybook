<?php
$image_class= new Image();
?>
<div id="post">
    <div>

        <?php 
            $image="images/user_male.jpg";
            if ($ROW_USER['gender']=='Female'){
                $image="images/user_female.jpg";
            }
            if (file_exists($ROW_USER['profile_image'])){
                $image= $image_class->get_thumb_profile($ROW_USER['profile_image']); 
            }
        ?>

        <img src="<?php echo $image; ?>" style="width:75px;margin-right:4px; border-radius:3px;">
    </div>

    <div class="comment">
        <div class="comment-below">
      
            <?php 
                // html escaping
                echo "<a href = 'profile.php?id=$COMMENT[userid]'>";
                echo  htmlspecialchars( $ROW_USER['first_name'])." ".htmlspecialchars($ROW_USER['last_name'])  ; 
                echo "</a>";
                if ($COMMENT['is_profile_image'])
                {
                    $pronoun= "his";

                    if($ROW_USER['gender']=="Female")
                    {
                        $pronoun="her";
                    }
                    echo  "<span style ='font-weight:normal;color:#aaa;'> updated  $pronoun profile image </span>";
                }

                if ($COMMENT['is_cover_image'])
                {
                    $pronoun= "his";

                    if($ROW_USER['gender']=="Female")
                    {
                        $pronoun="her";
                    }
                    echo  "<span style ='font-weight:normal;color:#aaa;'> updated  $pronoun cover image </span>";
                }
            ?>
        </div>
        <!-- hier start al post  we use htmlspecialchars for avoid the any unexpected user input-->
        <?php echo htmlspecialchars( $COMMENT['post'] ); ?>
        <br><br>

        <?php
            if (file_exists($COMMENT['image']))
            {
                $post_image=$image_class->get_thumb_post($COMMENT['image']);
                echo "<img src = '$post_image' style = 'width:90% '/>";
            }
        ?>
        <br><br>

        <?php 
            // likes start with 0 and it is not visuable
            $likes = "";
            $likes= ($COMMENT['likes']>0) ? "(". $COMMENT['likes'] .")" : "" ;
        ?>

        <a href="like.php?type=post&id=<?php echo $COMMENT['postid'];?>">like <?php echo $likes; ?></a> . 
     
        <span style= "color :#999;">
            <?php echo $COMMENT['date'] ; ?>  
        </span>

        <?php 
          if($COMMENT['has_image']){
                echo "<a href='image_view.php?id=$COMMENT[postid]'>";
                echo ". View Full Image .";
                echo "</a>";
            }
        ?>

        <span class="comment-post">
            <?php 
                $post= new Post();
                if($post->i_own_post($COMMENT['postid'],$_SESSION['mybook_userid']))
                {
                    echo "
                    <a href='edit.php?id=$COMMENT[postid]'>
                    Edit
                    </a>. 
                    <a href='delete.php?id=$COMMENT[postid]' >
                    Delete
                    </a>" ;
                }
          ?>            
        </span>

        <?php 
        
            $i_liked= false;

            if (isset($_SESSION['mybook_userid'])){
       
                $DB=new Database();               
                $sql = "select likes from likes  where  type ='post' && contentid = '$COMMENT[postid]' limit 1";
                $result = $DB-> read($sql);
                if (is_array($result)){

                    $likes= json_decode($result[0]['likes'],true);

                    $user_ids= array_column($likes,"userid");

                    if (in_array($_SESSION['mybook_userid'],$user_ids)){
                        $i_liked= true;
                    }
                }

            }
          
            if ($COMMENT['likes']>0){
                echo "<br/>";
                echo "<a href='likes.php?type=post&id = $COMMENT[postid]'>";
                if ($COMMENT['likes']==1){
                    if ($i_liked){
                        echo "<div style= 'text-align :left'> You liked this post</div>";
                    }else{
                        echo "<div style= 'text-align :left'>1 person liked this post</div>";
                }

                }else{
                    if ($i_liked){
                        $text="others";
                        if($COMMENT['likes']-1 == 1){
                            $text="other";
                        }
                        echo "<div style= 'text-align :left'> You and ".($COMMENT['likes']-1)." $text  liked this post</div>";
                    }else{
                        echo "<div style= 'text-align :left'>".$COMMENT['likes']." other liked this post</div>";
                    }
                }
                echo "</a>";
            }
          ?>
    </div>
</div>
