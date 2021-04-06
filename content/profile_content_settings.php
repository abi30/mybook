<div style = "min-height:400px; width: 100% ; padding : 20px ;padding-right:0px;background-color:white;text-align :center ">
    <div style= "padding :20px; max-width:450px; display: inline-block">

    <form method="POST" action="" enctype= "multipart/form-data">                               
         <br> 
        <?php 
         $settings_class= new Settings();
         $settings = $settings_class->get_settings($_SESSION['mybook_userid']);
        //  $settings_class->save_settings($_POST,$_SESSION['mybook_userid']);
       
        if (is_array($settings)){
            echo "<input value='".htmlspecialchars($settings['first_name'])."' type='text' id = 'text_box' name = 'first_name' placeholder='First name'/>";
            echo "<input value='".htmlspecialchars($settings['last_name'])."'type='text' id = 'text_box' name = 'last_name'placeholder='Last name' />";
            echo "<select name='' id='text_box' style='height:30px;'>
                    <option>".htmlspecialchars($settings['gender'])."</option>
                    <option>Male</option>
                    <option>Female</option>
                </select>";
    
            echo "<input value='".htmlspecialchars($settings['email'])."' type='text' id = 'text_box' name = 'email' placeholder='Email'/>";
            echo "<input value='' type='password' id = 'text_box' name = 'password' placeholder='Rassword'/>";
            echo "<input value='' type='password' id = 'text_box' name = 'password2' placeholder='Rassword2'/>";
            
            echo "<br>About me:<br>
            <textarea  id='text_box' style='height:150px'; name ='about'>".htmlspecialchars($settings['about'])."</textarea>";

            echo '<input type="submit"  name=" " id="post_button"value="Save" style= margin-top:15px;>';
        }
        ?>

       </form>
    </div>
</div>
