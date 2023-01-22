<?php 

require './models/init.php';
if(count($_POST) > 0){
global $connection;
	$info  = [];
	$info['data_type'] = $_POST['data_type'];
    if($_POST['data_type'] == 'read'){
		$lyrixs=new Lyrix();
		$data=$lyrixs->get_lurixs();
		$info['data'] 	=$data;
	}
	else
	if($_POST['data_type'] == 'get-edit-row')
	{
		$id =$_POST['id'];
		
		$gare=new Trains();
		$data=$gare->get_train($id);
		
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
		$id =$_POST['id'];
        $user=new Trains();
		$user->delete_train($id);

	}
	
	if($_POST['data_type'] == 'edit'){
		$id=$_POST['id'];
		/*
		
		die;
		*/
		$voyege=new Trains();
		$voyege->edit_train($_POST);
		$info['data'] 	= "Record was fucking edited!";
        
	}
	

	echo json_encode($info);
}


?>