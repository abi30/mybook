<?php 
class Post{

private $error="";

//------------------ create_post function -------------------//
public function create_post($userid,$data,$files){

    if (!empty($data['post']) || !empty($files['file']['name']) || isset($data['is_profile_image'])|| isset($data['is_cover_image'])){
        // user can type any kind of charter.
        $myimage="";  
        $has_image=0;
        $is_profile_image=0;
        $is_cover_image=0;

        if (isset($data['is_profile_image'])|| isset($data['is_cover_image']) )
        {
            $myimage=$files;
            $has_image=1;
            if(isset($data['is_cover_image']))
            {
                $is_cover_image=1;
            }
            if(isset($data['is_profile_image']))
            {
                $is_profile_image=1;
            }
        }else{

            if (!empty($files['file']['name']))
            { 
                $folder="uploads/" . $userid . "/"; 
                //create folder 
                if (!file_exists($folder)){
                // file permissions 7777 google it 
                mkdir ($folder,0777,true);
                    //use file_put_contents for security heaker cann't access  file directory
                    // file_put_contents($folder."index.php","");
                }

                $image_class=new Image();

                $myimage=$folder.$image_class->generate_filename(15) .".jpg";
                move_uploaded_file($_FILES['file']['tmp_name'],$myimage);
                $image_class->resize_image($myimage,$myimage,1500,1500);
            
                //$myimage="";  
                $has_image=1;
            }
        }

        $post="";

        if (isset($data['post']))  
        {
            $post = addslashes($data['post']);
        }

        $postid=$this->create_postid();
        $parent=0;

        if (isset($data['parent'])&& is_numeric($data['parent'])){
            $parent=$data['parent'];  
        }

        $sql="insert into posts(userid,postid,post,image,has_image,is_profile_image,is_cover_image,parent) values ('$userid','$postid','$post','$myimage','$has_image','$is_profile_image','$is_cover_image','$parent')";
        $DB = new Database();
        $DB->save($sql);

    }else{
        $this->error .="please type somethings to post !<br>";
    }
    return $this->error;
}


//------------------ edit_post function -------------------//
public function edit_post($data,$files){

if (!empty($data['post']) || !empty($files['file']['name'])){
    // user can type any kind of charter.
    $myimage="";  
    $has_image=0;
   
    if (!empty($files['file']['name']))
    { 
        $folder="uploads/" . $userid . "/"; 
        //create folder 
        if (!file_exists($folder)){
            // file permissions 7777 google it 
            mkdir ($folder,0777,true);
            //use file_put_contents for security heaker cann't access  file directory
            // file_put_contents($folder."index.php","");
        }

        $image_class=new Image();

        $myimage=$folder.$image_class->generate_filename(15) .".jpg";
        move_uploaded_file($_FILES['file']['tmp_name'],$myimage);
        $image_class->resize_image($myimage,$myimage,1500,1500);
           
        $has_image=1;
    }
    

    $post="";

    if (isset($data['post']))
    {
        $post = addslashes($data['post']);
    }
    
    $postid=addslashes($data['postid']);

    if ($has_image)
    {
        $sql="update posts set post = '$post' , image = '$myimage' where postid = '$postid' limit 1 ";
    }else{
            $sql="update posts set post = '$post' where postid = '$postid' limit 1 ";
    }
        
    $DB = new Database();
    $DB->save($sql);
}else{
    $this->error .="please type somethings to post !<br>";
    }
    return $this->error;
}

//------------------ get_post function -------------------//
public function get_posts($id){

    $sql="select * from posts where userid = '$id' order by id desc limit 10";
    $DB = new Database();
    $result= $DB->read($sql);

    if ($result){
        return $result;
    }else{
        return false;
    }

}

//------------------ get_comments function -------------------//
public function get_comments($id){   
   
    $sql="select * from posts where parent ='$id' order by id asc limit 10";
    $DB = new Database();
    $result= $DB->read($sql);

    if ($result){
        return $result;
    }else{
        return false;
    }
}

//------------------ get_one_post function -------------------//
public function get_one_post($postid){

  if (!is_numeric($postid))
    {
        return false;
    }

    $sql="select * from posts where postid = '$postid' limit 1";
    $DB = new Database();
    $result= $DB->read($sql);
    
    if ($result){
        return $result[0];
    }else{
        return false;
    }
    
}

//------------------ delete_post function -------------------//
public function delete_post($postid){

    if (!is_numeric($postid))
    {
        return false;
    }
    $sql="delete from posts where postid = '$postid' limit 1";
    $DB = new Database();
    $DB->save($sql);   
}

//------------------ i_own_post function -------------------//
public function i_own_post($postid,$mybook_userid){

    if (!is_numeric($postid))
    {
        return false;
    }
    $sql="select * from posts where postid = '$postid' limit 1";
    $DB = new Database();
    $result = $DB->read($sql);

    if (is_array($result)){
        if ($result[0]['userid']==$mybook_userid){
            return true;
        }
      }
    return false;
}

//------------------ get_likes function -------------------//
public function get_likes($id,$type)
{   
    $DB=new Database();
    if (is_numeric($id)){
        // get likes deatails
        $sql = "select likes from likes  where  type ='$type' && contentid = '$id' limit 1";
        $result = $DB->read($sql);
        if (is_array($result)){
            $likes= json_decode($result[0]['likes'],true);
            return $likes;
        }
    }
    return false;
}

//------------------ like_post function -------------------//
public function like_post($id,$type,$mybook_userid)
{
    $DB=new Database();
        
    // save likes deatails
    $sql = "select likes from likes  where  type ='$type' && contentid = '$id' limit 1";
    $result = $DB-> read($sql);
    
    if (is_array($result)){

        $likes= json_decode($result[0]['likes'],true);

        $user_ids= array_column($likes,"userid");

        if (!in_array($mybook_userid,$user_ids)){

            $arr['userid']=$mybook_userid;
            $arr['date']=date("Y-m-d H:i:s");

            $likes[]=$arr;
            // javaScript object notation.
            $likes_string = json_encode( $likes);
            $sql = "update likes set likes = '$likes_string' where  type ='$type' && contentid = '$id' limit 1" ;
            $DB-> save($sql);

            //increment the right {$type}s table
            $sql = "update  {$type}s set likes = likes + 1 where {$type}id = '$id' limit 1";
            $DB-> save($sql);
        }else{

            $key= array_search($mybook_userid,$user_ids);
            unset($likes[$key]);

            $likes_string = json_encode( $likes);
            $sql = "update likes set likes = '$likes_string' where  type ='$type' && contentid = '$id' limit 1" ;
            $DB-> save($sql);

                //decrement the right {$type} table
            $sql = "update {$type}s set likes = likes - 1 where {$type}id = '$id' limit 1";
            $DB-> save($sql);
        }  
    }else{
        $arr['userid']=$mybook_userid;
        $arr['date']=date("Y-m-d H:i:s");

        $arr2[]=$arr;

        // javaScript object notation.
        $likes = json_encode( $arr2);
        $sql = "insert into likes (type,contentid,likes)values('$type','$id','$likes')";
        $DB-> save($sql);

            //increment the right table ={$type}
        $sql = "update {$type}s set likes = likes + 1 where {$type}id = '$id' limit 1";
        $DB-> save($sql);
    }
}

//------------------ create_postid function -------------------//
private function create_postid(){
    $length = mt_rand(4,19);
    $number="";
    for($i=0; $i<$length; $i++){
        $new_rand= mt_rand(0,9);
        $number= $number.$new_rand;
    }
    return $number;
}


// __________________________________messages________________________________

//------------------ userList function -------------------//
public function userList()
{
    $from_userid = $_SESSION['mybook_userid'];
    $sql = "select userid, concat(first_name,' ', last_name) as fullname from users where not userid = '$from_userid' ";
    $DB = new Database();
    $result = $DB->read($sql);
    if ($result) {
        return $result;
    } else {
        return false;
    }
}

//------------------ savePersonalMessage function -------------------//
public function savePersonalMessage($data){
    $from_userid = $_SESSION['mybook_userid'];
    $to_userid = $data['to_userid'];
    $message_text = $data['message_details'];
    $sent_dt = date('Y-m-d H:i:s');
    $sql = "INSERT INTO tbl_messages(from_userid,to_userid,message_text,sent_dt) VALUES('$from_userid','$to_userid','$message_text','$sent_dt')"; //exit;
    $DB = new Database();
    $result = $DB->save($sql);
    if($result){
        $_SESSION['alert_type'] = 'success';
        $_SESSION['alert_msg'] = "Message sent successfully.";
    }else{
        $_SESSION['alert_type'] = 'danger';
        $_SESSION['alert_msg'] = "Sorry message not sent.";
    }
    echo "<script>window.location.href='profile.php?section=messages'</script>";
    exit;
}

//------------------ getInboxMessage function -------------------//
public function getInboxMessage(){
    $to_userid = $_SESSION['mybook_userid'];
    $sql = "SELECT t1.*,
            Concat(t2.first_name, ' ', t2.last_name) AS fullname
            FROM   tbl_messages t1
            INNER JOIN users t2
            ON t1.from_userid = t2.userid
            WHERE  t1.to_userid = '$to_userid' 
            ORDER BY t1.id DESC";

    $DB = new Database();
    $result = $DB->read($sql);
    if ($result) {
        return $result;
    } else {
        return false;
    }
}

//------------------ getInboxNewMessage function -------------------//
public function getInboxNewMessage(){
    $to_userid = $_SESSION['mybook_userid'];
    $sql = "SELECT t1.*,
            Concat(t2.first_name, ' ', t2.last_name) AS fullname
            FROM  tbl_messages t1
            INNER JOIN users t2
            ON t1.from_userid = t2.userid
            WHERE  t1.to_userid = '$to_userid' AND read_status=0";

    $DB = new Database();
    $result = $DB->read($sql);
    if(!empty($result)){
        return count($result);
    }else{
        return 0;
    }
}

//------------------ getSentMessage function -------------------//
public function getSentMessage(){
    $from_userid = $_SESSION['mybook_userid'];
    $sql = "SELECT t1.*,
            Concat(t2.first_name, ' ', t2.last_name) AS fullname
            FROM   tbl_messages t1
            INNER JOIN users t2
            ON t1.to_userid = t2.userid
            WHERE  t1.from_userid = '$from_userid' 
            ORDER BY t1.id DESC";


    $DB = new Database();
    $result = $DB->read($sql);
    if ($result) {
        return $result;
    } else {
        return false;
    }
}

//------------------ changeReadStatus function -------------------//
public function changeReadStatus($count_new)
{
    for ($i = 0; $i < count($count_new); $i++) {
        $id = $count_new[$i];
        $sql = "UPDATE tbl_messages SET read_status=1 WHERE id=$id";
        $DB = new Database();
        $DB->save($sql);
    }
}
















}

?>