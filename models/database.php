<?php 

class Database{
    private $host="localhost";
    private $user="root";
    private $pass="";
    private $db_name="lyrics";
    public  function connect(){
        $rel="mysql:host=$this->host;dbname=$this->db_name";
        try{
            $connection=new PDO($rel,$this->user,$this->pass);
        }catch(PDOException $e){
            die($e->getMessage());
        }
        return $connection;
    }

    public function write($query,$data=array()){
        $connection=$this->connect();
        $statement=$connection->prepare($query);
        $result=$statement->execute($data);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function read($query,$data=array()){
        $connection=$this->connect();
        $statement=$connection->prepare($query);
        $result=$statement->execute($data);
        if($result){
            $data=$statement->fetchAll(PDO::FETCH_ASSOC);
            if(is_array($data) && count($data) > 0){
                return $data;
            }
        }
        return false;
    }
}


?>