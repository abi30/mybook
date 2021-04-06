<?php 
class Signup{

    private $error='';

    //------------------ evaluate function -------------------//
    public function evaluate($data){
        // $data is a array foreach loop go through the array 
        foreach($data as $key => $value){

            if (empty($value)){
                $this->error .= $key." is empty!<br>";
            }

            if ($key=="email"){
                // Email Validation Using Regular Expression in PHP
                $regex='/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/';
                $regex2="/^([a-zA-Z\d\._]+@+[a-zA-Z\d\._]+\.[a-zA-Z\d\.]{2,})$/";
                $regex3="/^([\w\-]+\@[\w\-]+\.[\w\-]+)/";
                if(!preg_match($regex2,$value)){
                    $this->error =  $this->error."Invalid email Address!<br>";
                }   
            }

            if ($key=="first_name"){
                // Email Validation Using Regular Expression in PHP with function->>preg_match()
                $regex='/^([a-zA-Z]{2,})$/';
                if (is_numeric($value)){
                    $this->error =  $this->error."first name can not be a number!<br>";
                } 
                 else if (strstr($value," ") || !preg_match($regex,$value)){
                    //check the space with function->>strstr()
                    $this->error =  $this->error."first name must be contained alphabets(A-Z) & no space!<br>";
                }    
            }


            if ($key=="last_name"){
                // Email Validation Using Regular Expression in PHP with function->>preg_match()
                $regex1='/^([a-zA-Z]{2,})$/';
                if(is_numeric($value)){
                    $this->error =  $this->error."last name can not be anumber !<br>";
                }
                else if (strstr($value," ") || !preg_match($regex,$value)){
                //check the space with function->>strstr()
                    $this->error =  $this->error."last name must be contained alphabets(A-Z) & no space!<br>";
                }     
            }
        }
        
        if ($this->error ==''){
            //no error
            $this->create_user($data);
        }
        else{
            return $this->error;
        }
    }


    //------------------ create_user function -------------------//
    public function create_user($data){

        // first later alphabet with function ->>> ucfirst();
        $first_name= ucfirst($data['first_name']) ;
        $last_name=ucfirst($data['last_name']) ;
        $gender= $data['gender'];
        $email= $data['email'];
        $password= hash(sha1,$data['password']);
        //$password2= hash(sha1,$data['password']);
       
        //create these url_address
        $url_address= strtolower($first_name).".".strtolower($last_name);
        $userid= $this->create_userid();

        $sql="insert into users 
        (userid,first_name,last_name,gender,email,password,url_address,user_status) 
        values 
        ('$userid','$first_name','$last_name','$gender','$email','$password','$url_address',1)";
        
        $DB = new Database();
        $DB->save($sql);
    }


    //------------------ create_userid function -------------------//
    // create userid to use mt_rand() function.
    private function create_userid(){
        $length = mt_rand(4,19);
        $number="";
        for($i=0; $i<$length; $i++){
            $new_rand= mt_rand(0,9);
            $number= $number.$new_rand;
        }
        return $number;
    }

}
?>