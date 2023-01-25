<?php 

class Lyrix{
    private $errors=array();
    public function add_lurix($singer,$song_name,$words){
        $DB=new Database();
        $arr=false;
        $arr['singer']=$singer;
        $arr['song_name']=$song_name;
        $arr['words']=$words;
        $arr['date_created']=date("Y-m-d H:i:s");
        $query= "INSERT INTO lyricss (singer,song_name,words,date_created) 
            values (:singer,:song_name,:words,:date_created)";
        $result=$DB->write($query,$arr);
    }
   
    public function get_lurixs($order){
        $DB=new Database();
        $query="SELECT * FROM lyricss $order";
        $arr=[];
        $result=$DB->read($query,$arr);
        
        if(is_array($result)){
            return $result;
        }
        return false;
    }
    
    public function get_lurix($id){
        $DB=new Database();
        $arr=false;
        $arr['id']=$id;
        $query="SELECT * FROM  lyricss WHERE id=:id LIMIT 1";
        $result=$DB->read($query,$arr);
        if(is_array($result)){
            return $result[0];
        }
        return false;
    }
    public function edit_lyrix($data){
       $DB=new Database();
       $arr['id']=$data['id'];
       $arr['singer']=$data['singer'];
       $arr['song_name']=$data['song_name'];
       $arr['words']=$data['words'];
       $query="UPDATE lyricss SET singer=:singer , song_name=:song_name, words=:words WHERE id=:id ";
       $DB->write($query,$arr);
    }
    public function delete_lurix($id){
        $DB = new Database();
		$query = "delete from lyricss where id = '$id' limit 1";
		$DB->write($query);
    }
    public function lurix_count(){
        $query="SELECT * FROM lyricss";
        $DB=new Database();
        $data=array();
        $result=$DB->read($query,$data);
        if($result){
            $count=count($result);
        }else{
            $count=0;
        }


        return $count;
    }
    public function song_name_count(){
        $query="SELECT DISTINCT song_name FROM lyricss";
        $DB=new Database();
        $data=array();
        $result=$DB->read($query,$data);
        if($result){
            $count=count($result);
        }else{
            $count=0;
        }

        return $count;
    }
    public function search_lurix($value){

        $query="SELECT *  FROM lyricss WHERE song_name LIKE :song_name OR singer LIKE :song_name";
        $DB=new Database();
        $data=array();
        $data['song_name']=$value;
        $result=$DB->read($query,$data);
        if(is_array($result)){
            return $result; 
        }
        return false;
    }
    
}


?>