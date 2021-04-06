<?php
$image_class= new Image();
?>
<div id="post">
    <div>
        <?php 
            $image="images/user_male.jpg";
            if ($ROW_USER['gender']=='Female')
            {
                $image="images/user_female.jpg";
            }
            if (file_exists($ROW_USER['profile_image']))
            {
                $image= $image_class->get_thumb_profile($ROW_USER['profile_image']); 
            }
        ?>

        <img src="<?php echo $image; ?>" style="width:75px;margin-right:4px; border-radius:3px;">
    </div>

    <div style = "width:100%;">
        <div style = "font-weight:bold;color:#405d9b;">
            <?php 
                // html escaping
                echo "<a href = 'profile.php?id=$ROW[userid]'>";
                echo  htmlspecialchars( $ROW_USER['first_name'])." ".htmlspecialchars($ROW_USER['last_name'])  ; 
                echo "</a>";

                if ($ROW['is_profile_image'])
                {
                    $pronoun= "his";
                    if($ROW_USER['gender']=="Female")
                    {
                        $pronoun="her";
                    }
                    echo  "<span style ='font-weight:normal;color:#aaa;'> updated  $pronoun profile image </span>";
                }

                if ($ROW['is_cover_image'])
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
        <?php echo htmlspecialchars( $ROW['post'] ); ?>
        <br><br>

        <?php
            if (file_exists($ROW['image']))
            {
                $post_image=$image_class->get_thumb_post($ROW['image']);
                echo "<img src = '$post_image' style = 'width:90% '/>";
            }

        ?>
        <br><br>

        <?php 
            // likes start with 0 and it is not visuable
            $likes = "";
            $likes= ($ROW['likes']>0) ? "(". $ROW['likes'] .")" : "" ;
        ?>

        <a href="like.php?type=post&id=<?php echo $ROW['postid'];?>">like <?php echo $likes; ?></a> . 
        <a href="single_post.php?id=<?php echo $ROW['postid']; ?>">Comment</a> .
        <span style= "color :#999;">
            <?php echo $ROW['date'] ; ?>
        </span>
        
        <?php 
            if($ROW['has_image'])
            {
                echo "<a href='image_view.php?id=$ROW[postid]'>";
                echo ". View Full Image .";
                echo "</a>";
            }
        ?>
        <span style= "color :#999; float:right">
            <?php 
                $post= new Post();
                if($post->i_own_post($ROW['postid'],$_SESSION['mybook_userid']))
                {
                    echo "
                    <a href='edit.php?id=$ROW[postid]'>
                    Edit
                    </a>. 
                    <a href='delete.php?id=$ROW[postid]' >
                    Delete
                    </a>" ;
                }
            ?>            
        </span>

        <?php 
            $i_liked= false;

            if (isset($_SESSION['mybook_userid'])){
       
                $DB=new Database();               
                $sql = "select likes from likes  where  type ='post' && contentid = '$ROW[postid]' limit 1";
                $result = $DB-> read($sql);
                if (is_array($result)){

                    $likes= json_decode($result[0]['likes'],true);

                    $user_ids= array_column($likes,"userid");

                    if (in_array($_SESSION['mybook_userid'],$user_ids)){
                        $i_liked= true;
                    }
                }
            }
          
            if ($ROW['likes']>0){
                echo "<br/>";
                echo "<a href='likes.php?type=post&id = $ROW[postid]'>";
                if ($ROW['likes']==1){
                    if ($i_liked){
                        echo "<div style= 'text-align :left'> You liked this post</div>";
                    }else{
                        echo "<div style= 'text-align :left'>1 person liked this post</div>";
                    }
                }else{
                    if ($i_liked){
                        $text="others";
                        if($ROW['likes']-1 == 1){
                            $text="other";
                    }
                        echo "<div style= 'text-align :left'> You and ".($ROW['likes']-1)." $text  liked this post</div>";
                    }else{
                        echo "<div style= 'text-align :left'>".$ROW['likes']." other liked this post</div>";
                    }

                }
                echo "</a>";
            }
          ?>
    </div>
</div>
