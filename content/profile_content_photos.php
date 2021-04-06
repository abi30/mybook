
<div style = "min-height:400px; width: 100% ; padding : 20px ;padding-right:0px;background-color:white;text-align :center ">
    <div style= "padding:20px;">
       
    
        <?php 
        $DB = new Database();
        $sql = "select image,postid from posts where has_image = 1 && userid= $user_data[userid] order by id desc limit 30";
        // && userid = $user_data[userid] oder by id desc limit 30
        $images=$DB->read($sql);

        $image_class= new Image();
        if (is_array($images)){

          
        foreach($images as $image_row){

            echo "<a class='data-fancybox' rel='group' href='".$image_class->get_thumb_post($image_row['image'])."'>
            <img src='".$image_class->get_thumb_post($image_row['image'])."'style='width :150px; margin:6px;'/></a>";
        }  




        }else{
            echo "<h2 style='color:skyblue;'>No IMAGES were found!</h2>";
        }
        ?>

    </div>


</div>





