<?php 

require './models/init.php';
if(count($_POST) > 0){
global $connection;
	$info  = [];
	$info['data_type'] = $_POST['data_type'];
    if($_POST['data_type'] == 'read'){
		$lyrixs=new Lyrix();
        $order="ORDER BY id DESC";
		$data=$lyrixs->get_lurixs($order);
		$info['data'] 	=$data;
	}
    else if($_POST['data_type'] == 'sorting'){
        $sort=$_POST['sort'];
        $lyrixs=new Lyrix();
        $order="ORDER BY id DESC";
        if($sort=='name'){
            $order="ORDER BY song_name ASC";
        }else if($sort=="date"){
            $order="ORDER by date_created ASC";
        }else if ($sort=="title"){
            $order="ORDER by singer DESC";
        }
		$data=$lyrixs->get_lurixs($order);
		$info['data'] 	=$data;
    }
    else if($_POST['data_type'] == 'search'){
        $search="%".$_POST['value']."%";
        $lyrixs=new Lyrix();
        
		$data=$lyrixs->search_lurix($search);
		$info['data'] 	=$data;
    }
	else
	if($_POST['data_type'] == 'get-edit' || $_POST['data_type'] == 'show')
	{
		$id =(int)$_POST['id'];
        $lyrixs=new Lyrix();
		$data=$lyrixs->get_lurix($id);
		//$gare=new Trains();
		//$data=$gare->get_train($id);
        $info['data'] 	= $data;
	}
	else if($_POST['data_type'] == 'add'){
        
        for($i=0;$i<((sizeof($_POST) - 1) / 3);$i++){
            $singer_once="singer_".$i;
            $singer=$_POST[$singer_once];
            $song_one="song_name_".($i);
            $song=$_POST[$song_one];
            $words_once="words_".($i);
            $words=$_POST[$words_once];
            $lyrixs=new Lyrix();
            $result=$lyrixs->add_lurix($singer,$song,$words);

        }
		$info['data'] =	$_POST['song_name_0'];
        
        //$data=$gares->add_train($_POST);
        

        
	}
	else if($_POST['data_type'] == 'delete'){
        $id=$_POST['id'];
		$lyrixs=new Lyrix();
        $result=$lyrixs->delete_lurix($id);
		$info['data'] 	= "Record was  deleted";
	}
	
	if($_POST['data_type'] == 'update'){
		$id=$_POST['id'];
		$lyrixs=new Lyrix();
        $result=$lyrixs->edit_lyrix($_POST);
		$info['data'] 	= "Record was  edited!";
        
	}
	

	echo json_encode($info);
}


?>