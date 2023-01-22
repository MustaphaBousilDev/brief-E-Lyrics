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
    public function get_gares(){
        $DB=new Database();
        $query="SELECT * FROM gare ORDER BY id DESC";
        $arr=[];
        $result=$DB->read($query,$arr);
        if(is_array($result)){
            return $result;
        }
        return $false;
    }
    public function get_lurixs(){
        $DB=new Database();
        $query="SELECT * FROM lyricss ORDER BY id DESC";
        $arr=[];
        $result=$DB->read($query,$arr);
        
        if(is_array($result)){
            return $result;
        }
        return false;
    }
    
    public function get_train($id){
        $DB=new Database();
        $arr=false;
        $arr['id']=$id;
        $query="SELECT * FROM all_trains WHERE id=:id LIMIT 1";
        $result=$DB->read($query,$arr);
        if(is_array($result)){
            return $result[0];
        }
        return false;
    }
    public function edit_train($data){
       $DB=new Database();
       $arr['id']=$data['id'];
       $arr['name']=$data['name'];
       $arr['gare_id']=$data['gare_id'];
       $query="UPDATE all_trains SET name=:name , gare_id=:gare_id WHERE id=:id ";
       $DB->write($query,$arr);
    }
    public function delete_train($id){
        $DB = new Database();
		$query = "delete from all_trains where id = '$id' limit 1";
		$DB->write($query);
    }
    
}


?>