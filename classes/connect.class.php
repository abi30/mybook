<?php 
Class Database
{
 
  private $host ="localhost";
  private $username='root';
  private $password='';
  private $db='mybook_db';

  //---------------------connection function ------------------------//
  function connect(){
      $connection= mysqli_connect($this->host,$this->username,$this->password,$this->db);
      return $connection;
  }

  //---------------------read function ------------------------//
  function read($sql){
      $conn= $this->connect();
      $restult= mysqli_query($conn,$sql);

      if (!$restult){
          return false;
      }else{
          $data = false;
          while($row=mysqli_fetch_assoc($restult)){
            $data[]=$row;
          }
        return $data;
      }
  }

//---------------------save function ------------------------//
  function save($sql){
      $conn= $this->connect();
      $restult= mysqli_query($conn,$sql);
      if (!$restult){
          return false;
      }else{
          return true;
      }
  }

}
?>