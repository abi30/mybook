<?php 
class Profile
{
    function get_profile($id)
    {
        //for secure from injection need addslashes method __variable escaping
        $id= addslashes($id);
        $DB= new Database();
        $sql="select * from users where userid = '$id' limit 1";
        //echo $sql;
        return $DB-> read($sql);
    }
}
?>