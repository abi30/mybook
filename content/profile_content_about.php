
<div style = "min-height:400px; width: 100% ; padding : 20px ;padding-right:0px;background-color:white;text-align :center ">
    <div style= "padding :20px; max-width:450px; display: inline-block">
    <form method="POST" action="" enctype= "multipart/form-data">                               
         <br> 
        <?php 
            $settings_class= new Settings();
            $settings = $settings_class->get_settings($_SESSION['mybook_userid']);
      
            if (is_array($settings)){
                echo "<br>About me:<br>
                <div  id='text_box' style='height:150px; width:300px; border :none'>".htmlspecialchars($settings['about'])."</div>";
            }
        ?>
    </form>
    </div>
</div>
