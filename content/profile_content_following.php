<div style = "min-height:400px; width: 100% ; padding : 20px ;padding-right:0px;background-color:white;text-align :center ">
    <div style= "padding:20px;">
        <?php 
       
        $image_class= new Image();
        $post_clss= new Post();
        $user_class= new User();

        $following = $user_class->get_following($user_data['userid'],"user");
       
        if (is_array($following)){

        foreach($following as $follower){

            $FRIEND_ROW = $user_class->get_user($follower['userid']);
            include("user.php");

        }  
        }else{

            
        echo "<h2 style='color:skyblue;'>This User is't following !</h2>";
        }
        ?>

    </div>


</div>