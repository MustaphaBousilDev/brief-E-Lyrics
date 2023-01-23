<?php 
class User{
    private $errors=array();
    public function login($POST){
        $DB=new Database();
        $data=array();
        #echo "one";
        $data['email']=trim($POST['email']);
        $data['password']=trim($POST['password']);
        if(empty($data['email']) || !preg_match("/^[a-zA-Z]+@[a-zA-Z]+.[a-zA-Z]+$/",$data['email'])){
            $this->errors[]="Please valid your email";
        }
        if(empty($data['password'])){
            $this->errors[]="please valid your password";
        }
        if(count($this->errors)==0){
            //$data['password']=hash('sha1',$data['password']);
            $query="SELECT * FROM users WHERE email=:email AND password=:password LIMIT 1";
            $result=$DB->read($query,$data);
            if(is_array($result)){
                $result=$result[0];
                $_SESSION['id']=$result['id'];
                $_SESSION['name']=$result['name'];
                //$_SESSION['photo']=$result['img'];
                $_SESSION['email']=$result['email'];
                header('Location:index.php');
                die;
            }
            $this->errors[]="Wrong Email or Password";
        }
        return $this->errors;
    }
    public function logout(){
        if(isset($_SESSION['name'])){
            session_unset();
            session_destroy();
         }
         header('Location:login.php');
         die;
    }
    public function admin_count(){
        $query="SELECT * FROM users";
        $DB=new Database();
        $data=array();
        $result=$DB->read($query,$data);
        $count=count($result);

        return $count;
    }

}








?>