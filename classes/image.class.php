<?php 

class Image {
//------------------ filename function -------------------//
public function generate_filename($length){

    $array=array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
    $text="";
    for($x=0; $x< $length; $x++){
        $random=rand(0,35);
        $text.=$array[$random];
    }
    return $text;  
}


//------------------ croped image function -------------------//
public function crop_image($original_file_name,$cropped_file_name,$max_width,$max_height){

    if (file_exists($original_file_name)){
            
        $original_image=imagecreatefromjpeg($original_file_name);
        $original_width=imagesx( $original_image);
        $original_height= imagesy($original_image);

        if($original_height>$original_width){

            //make width equal to max width
            $ratio= $max_width/$original_width;

            $new_width=$max_width;
            $new_height=$original_height*$ratio;

        }else{

            //make width equal to max width
            $ratio= $max_height/$original_height;

            $new_height=$max_height;
            $new_width=$original_width*$ratio;

        }
    }


    // adjust incase max width and height are different
    if ($max_width != $max_height){

        if ($max_height > $max_width){

            if ($max_height > $new_height){
                $adjustment=($max_height / $new_height);
            }else{
                $adjustment=($new_height / $max_height);
            }

            $new_width=$new_width * $adjustment;
            $new_height=$new_height * $adjustment;
        }else{

            if ($max_width > $new_width){
                $adjustment=($max_width / $new_width);
            }else{
                $adjustment=($new_width / $max_width);
            }

            $new_width=$new_width * $adjustment;
            $new_height=$new_height * $adjustment;
        }

    }

    $new_image=imagecreatetruecolor($new_width,$new_height);

    // dst_img,src_img,dst_x,dst_y,src_x,scr_y,dst_width,dst_height,src_width,src_height
    imagecopyresampled($new_image, $original_image,0,0,0,0,$new_width,$new_height,$original_width,$original_height);
    
    //we dont need $original_image agine so we can destroy...
    imagedestroy($original_image);
    // crop the image

    if ($max_width != $max_height){

            if ($max_width>$max_height){

                $diff= ($new_height-$max_height);
                if($diff<0){
                    $diff=$diff * -1;
                }

                $y= round($diff/2);
                $x=0;
            }else{

                $diff= ($new_width-$max_width);
                if($diff<0){
                    $diff=$diff * -1;
                }
            
                $x= round($diff/2);
                $y=0;
            }
    
    }else{
        
        if ($new_height>$new_width){

            $diff= ($new_height-$new_width);
            $y= round($diff/2);
            $x=0;
        }else{

            $diff= ($new_width-$new_height);
            $x= round($diff/2);
            $y=0;
        }
    }
    $new_cropped_image=imagecreatetruecolor($max_width,$max_height);

    imagecopyresampled($new_cropped_image,$new_image,0,0,$x,$y,$max_width,$max_height,$max_width,$max_height);
    // save the  resized image 
    imagedestroy($new_image);
    imagejpeg($new_cropped_image,$cropped_file_name,90);
    imagedestroy($new_cropped_image);

}

//------------------ resize image function -------------------//
public function resize_image($original_file_name,$resize_file_name,$max_width,$max_height){
    // resize image
   if (file_exists($original_file_name)){
           
        $original_image=imagecreatefromjpeg($original_file_name);

        $original_width=imagesx( $original_image);
        $original_height= imagesy($original_image);

        if($original_height>$original_width){

           //make width equal to max width
           $ratio= $max_width/$original_width;

           $new_width=$max_width;
           $new_height=$original_height*$ratio;

       }else{

            //make width equal to max width
            $ratio= $max_height/$original_height;

            $new_height=$max_height;
            $new_width=$original_width*$ratio;

       }
    }


    // adjust incase max width and height are different
   if ($max_width != $max_height){

       if ($max_height > $max_width){

            if ($max_height > $new_height){
                $adjustment=($max_height / $new_height);
            }else{
                $adjustment=($new_height / $max_height);
            }
            $new_width=$new_width * $adjustment;
            $new_height=$new_height * $adjustment;

        }else{
            if ($max_width > $new_width){

                $adjustment=($max_width / $new_width);
            }else{
                $adjustment=($new_width / $max_width);
            }
            $new_width=$new_width * $adjustment;
            $new_height=$new_height * $adjustment;
        }
   }
   $new_image=imagecreatetruecolor($new_width,$new_height);
   //  dst_img,src_img,dst_x,dst_y,src_x,scr_y,dst_width,dst_height,src_width,src_height
   imagecopyresampled($new_image, $original_image,0,0,0,0,$new_width,$new_height,$original_width,$original_height);
   //we dont need $original_image agine so we can destroy...
   imagedestroy($original_image);

   imagejpeg($new_image,$resize_file_name,90);
   imagedestroy($new_image);

}

//------------------ create thumbmail for cover image function -------------------//
public function get_thumb_cover($filename){

    $thumbnail= $filename."_cover_thumb.jpg";
    //  if thumbnail file exist then invoke first if condition 
    // otherwise invoke the second if condition.
    if(file_exists($thumbnail))
    {
        return $thumbnail;
    }
    $this->crop_image($filename,$thumbnail,1366,488);

    if (file_exists($thumbnail)){
        return $thumbnail;
    }else {
        return $filenaame;
    }
}

//------------------ create thumbmail for profile image function -------------------//
public function get_thumb_profile($filename){

    $thumbnail= $filename."_profile_thumb.jpg";
    //  if thumbnail file exist then invoke first if condition 
    // otherwise invoke the second if condition.
    if(file_exists($thumbnail))
    {
        return $thumbnail;
    }
    $this->crop_image($filename,$thumbnail,600,600);

    if (file_exists($thumbnail)){
        return $thumbnail;
    }else {
        return $filenaame;

    }
}

//------------------ create thumbmail for post image. function -------------------//
public function get_thumb_post($filename){

    $thumbnail= $filename."_post_thumb.jpg";
    //  if thumbnail file exist then invoke first if condition 
    // otherwise invoke the second if condition.
    if(file_exists($thumbnail))
    {
        return $thumbnail;
    }
    $this->crop_image($filename,$thumbnail,600,600);

    if (file_exists($thumbnail)){
        return $thumbnail;
    }else {
        return $filenaame;
    }
}

}
?>
