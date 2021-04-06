<div id="post">
    <div>
        <?php 
            $image="images/user_male.jpg";
            if ($ROW_USER['gender']=='Female'){
                $image="images/user_female.jpg";
            }

            $image_class= new Image();
            if (file_exists($ROW_USER['profile_image'])){
                $image= $image_class->get_thumb_profile($ROW_USER['profile_image']); 
            }
        ?>

        <img src="<?php echo $image; ?>" class="img-delete-post">
    </div>

    <div style = "width:100%;">
        <div class="delete-post">
      
        <?php 
            // html escaping
            echo  htmlspecialchars( $ROW_USER['first_name'])." ".htmlspecialchars($ROW_USER['last_name'])  ; 
       
            if ($ROW['is_profile_image'])
            {
                $pronoun= "his";
                if($ROW_USER['gender']=="Female")
                {
                    $pronoun="her";
                }
                echo "<span style ='font-weight:normal;color:#aaa;'> updated  $pronoun profile image </span>";
            }

            if ($ROW['is_cover_image'])
            {
                $pronoun= "his";
                if($ROW_USER['gender']=="Female")
                {
                    $pronoun="her";
                }
                echo "<span style ='font-weight:normal;color:#aaa;'> updated  $pronoun cover image </span>";
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
        <br>       
    </div>
</div>