<?php
require './models/init.php';
if(!isset($_SESSION['id'])){
    header('Location:login.php');
}


$name="";
if(isset($_SESSION['name'])){
    $username=$_SESSION['name'];
} 

$user=new User();
$count_user=$user->admin_count();

//
$lurix=new Lyrix();
$count_lurix=$lurix->lurix_count();


$lurix=new Lyrix();
$count_lurixx=$lurix->song_name_count();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <div class="dashboard">
        <div class="navbar__dash">
            <div class="logo">
                <img src="https://seeklogo.com/images/M/mugiwara-logo-303FD55C54-seeklogo.com.png" alt="logo"/>
            </div>
            <div class="links">
               <div class="profile">
                <img src="https://image.winudf.com/v2/image/Y29tLmJhbGVmb290Lk1vbmtleURMdWZmeVdhbGxwYXBlcl9zY3JlZW5fMF8xNTI0NTE5MTEwXzAyOA/screen-0.jpg?fakeurl=1&type=.webp" alt=""/>
               </div>
               <div class="logout-user">
                <a href="logout.php">Log-Out</a>
               </div>
            </div>
        </div>
        <div class="body__dash">
            <div class="statistiques">
                <div class="box-statistiq box-1">
                    <div class="info">
                        <h2>Total Admin</h2>
                        <p><?= $count_user?></p>
                    </div>
                    <div class="icon">
                        <i class='bx bx-user icon-user'></i>
                    </div>
                </div>
                <div class="box-statistiq box-2">
                    <div class="info">
                        <h2>Total Admin</h2>
                        <p><?=$count_lurix?></p>
                    </div>
                    <div class="icon">
                        <i class='bx bx-pen icon-titre'></i>
                    </div>
                </div>
                <div class="box-statistiq box-3">
                    <div class="info">
                        <h2>Total Artiste</h2>
                        <p><?=$count_lurixx?></p>
                    </div>
                    <div class="icon">
                        <i class='bx bx-group icon-artiste'></i>
                    </div>
                </div>
            </div>
            <div class="my-3 d-flex mx-2" style="padding: 5px 2.5%;">
                <button  onclick="addModal.show()" style="width: 60px;height:30px" class="border-0 btn btn-primary py-4 text-md px-5 pointer-event d-flex justify-content-center align-items-center">Add</button>
                <div class="form-outline mx-3 position-relative">
                    <i class='bx bx-search position-absolute' style="top:25%;left: 5px;font-size: 18px;color:rgb(197, 197, 200)" ></i>
                    <input type="search" onkeyup="showHint(this.value)" id="form1" class="form-control py-2 px-4" placeholder="Search" aria-label="Search" />
                </div>
                <select class="form-select" oninput='getState(event)'>
                    <option value="date">Sort By Date</option>
                    <option value="name">Sort By song Name</option>
                    <option value="title">Sort By song Title</option>

                </select>
            </div>
            <div class="cards-musique my-3 d-flex justify-content-center" style="flex-wrap: wrap;" >
                
            </div>
        </div>
    </div>
    <div class="modal fade" id="add-new-modal" tabindex="-1" aria-labelledby="add-new-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content add-new-modals">
            <div class="modal-header">
              <h5 class="modal-title" id="add-new-modalLabel" >Add new Lyrics</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form  class="js-add-user-form" onsubmit="add(event)">
            <div class="modal-body">
                    
            </div>
                    <div class="modal-footer">
                    
                    </div>
                    <div class="btns d-flex">
                    <button type="button" class="btn btn-secondary mx-1" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn_add btn-sm  mx-1 btn btn-success rounded-circle d-flex justify-content-center align-items-center" style="width: 25px;height:25px" >+</button>
                    <button type="button" class="btn_remove btn-sm  mx-1 btn btn-danger rounded-circle d-flex justify-content-center align-items-center" style="width: 25px;height:25px">-</button>
                    <button type="submit" class="btn submit-save  mx-1 btn-primary" data-bs-dismiss="modal">Save</button>
                    </div>
                    
            </form>
          </div>
        </div>
    </div>
    <div class="modal fade" id="edit-new-modal" tabindex="-1" aria-labelledby="edit-new-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="edit-new-modalLabel" >Edit Lyrics</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" class="js-edit-user-form" onsubmit="edit(event)">
            <div class="modal-body">
                    <div class="mt-2">
                    <input type="hidden" id="id" name="id"/>
                    <label for="name" class="form-label">Titre</label>
                    <input  type="text" class="form-control" id="title" name="name" placeholder="Name" required>
                    </div>
                    <div class="mt-2">
                    <label for="quantity" class="form-label">Auther Name</label>
                    <input  type="text" class="form-control" id="auther" name="auther"  required>
                    </div>
                    <div class="mt-2">
                        <textarea   id="words" name="description" class="form-control">
            
                        </textarea>
                    </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                    </div>
            </form>
          </div>
        </div>
    </div>
    <div class="modal fade" id="show-new-modal" tabindex="-1" aria-labelledby="show-new-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="show-new-modalLabel" >Show Lyrics</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="js-show-user-form">
            <div class="modal-body">
                    <div class="mt-2">
                    <label for="name" class="form-label">Titre</label>
                    <input disabled  type="text" class="form-control" id="title-show" name="name" placeholder="Name" required>
                    </div>
                    <div class="mt-2">
                    <label for="quantity" class="form-label">Auther Name</label>
                    <input disabled  type="text" class="form-control" id="auther-show" name="auther"  required>
                    </div>
                    <div class="mt-2">
                        <textarea disabled   id="words-show" name="description" class="form-control">
            
                        </textarea>
                    </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
            </form>
          </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="assets/js/index.js"></script>
    <script type="text/javascript">
        const addModal = new bootstrap.Modal('#add-new-modal', {});
        const editModal = new bootstrap.Modal('#edit-new-modal', {});
        const showModal = new bootstrap.Modal('#show-new-modal', {});
        
        let container=document.querySelector('.add-new-modals')
        let counters=0;
        let form=document.querySelector('.add-new-modals form')
        let modal_body=document.querySelector('.add-new-modals form .modal-body')
        //console.log(counters)
        send_data([], 'read')
        function send_data(arr, type){
            var forms = new FormData();
           for(let i=0;i<arr.length;i++){
                for(key in arr[i]){
                    forms.append(key,arr[i][key])
                }
            }
            forms.append('data_type',type);
            var ajax = new XMLHttpRequest();
            ajax.addEventListener('readystatechange',function(){
            if(ajax.readyState == 4){
                if(ajax.status == 200){
                handle_result(ajax.responseText);
                }else{
                alert("an error occured");
                }
            }
            });
            ajax.open('post','music_ajax.php',true);
            ajax.send(forms);
	    }
        ////////////////////////////////////////////////////////////
        function handle_result(result){
            console.log('messi')
            var obj = JSON.parse(result);
            console.log(obj)
            
            if(typeof obj == 'object'){
                if(obj.data_type == 'read'){
                    let tbody = document.querySelector(".cards-musique");
                    let str = "";
                    if(typeof obj.data == 'object'){
                        for (var i = 0; i < obj.data.length; i++) {
                        let row = obj.data[i];
                        //console.log('bitch')
                        //console.log(row)
                        str += `
                            <div class="card" style="width: 18rem;background-color: transparent;border: none;margin-bottom: 10px;">
                            <div style="width: 95%;background-color: rgb(220, 220, 222);margin: auto;">
                            <div class="card-body">
                                <h5 class="card-title">${row.singer}</h5>
                                <p class="card-text">${row.song_name}</p>
                                <span class="card-text">${row.date_created}</span>
                                <div class="d-flex gap-2">
                                    <button onclick="editModal.show();getId(${row.id})" style="width: 30px;height:30px" class="border-0 btn btn-sm btn-success rounded-circle pointer-event d-flex justify-content-center align-items-center"><i style="font-weight: bold;" class='bx bx-edit-alt' ></i></button>
                                    <button onclick="deleteId(${row.id})" style="width: 30px;height:30px" class="border-0 btn btn-sm btn-danger rounded-circle pointer-event d-flex justify-content-center align-items-center"><i style="font-weight: bold;" class='bx bx-x'></i></button>
                                    <button onclick="showModal.show();show(${row.id})" style="width: 30px;height:30px" class="border-0 btn btn-sm btn-warning rounded-circle pointer-event d-flex justify-content-center align-items-center"><i style="font-weight: bold;color:#fff;" class='bx bx-show-alt'></i></button>
                                </div>
                                </div>
                            </div>
                            </div>
                        `;
                        }
                        tbody.innerHTML = str;
                    }else{str = "<tr><td>No records found!</td></tr>";}
                        
                }else
                if(obj.data_type == 'add'){
                alert(obj.data);
                send_data([],'read');
                }else
                if(obj.data_type == 'update')
                {
                    alert(obj.data);
                    send_data([],'read');
                }else
                if(obj.data_type == 'delete')
                {
                    alert(obj.data);
                    send_data([],'read');
                }else
                if(obj.data_type == 'get-edit'){
                let row = obj.data;
                if(typeof row == 'object'){
                    let myModal = document.querySelector("#edit-new-modal");
                    myModal.querySelector('#title').value=row.singer
                    myModal.querySelector('#auther').value=row.song_name
                    myModal.querySelector('#words').value=row.words 
                    myModal.querySelector('#id').value=row.id  
                }
                
                }
                else
                if(obj.data_type == 'show'){
                let row = obj.data;
                if(typeof row == 'object'){
                    let myModal = document.querySelector("#show-new-modal");
                    myModal.querySelector('#title-show').value=row.singer
                    myModal.querySelector('#auther-show').value=row.song_name
                    myModal.querySelector('#words-show').value=row.words  
                }
                
                
                }
                else
                if(obj.data_type == 'sorting'){
                    let tbody = document.querySelector(".cards-musique");
                    let str = "";
                    if(typeof obj.data == 'object'){
                        for (var i = 0; i < obj.data.length; i++) {
                        let row = obj.data[i];
                        //console.log('bitch')
                        //console.log(row)
                        str += `
                            <div class="card" style="width: 18rem;background-color: transparent;border: none;margin-bottom: 10px;">
                            <div style="width: 95%;background-color: rgb(220, 220, 222);margin: auto;">
                            <div class="card-body">
                                <h5 class="card-title">${row.singer}</h5>
                                <p class="card-text">${row.song_name}</p>
                                <span class="card-text">${row.date_created}</span>
                                <div class="d-flex gap-2">
                                    <button onclick="editModal.show();getId(${row.id})" style="width: 30px;height:30px" class="border-0 btn btn-sm btn-success rounded-circle pointer-event d-flex justify-content-center align-items-center"><i style="font-weight: bold;" class='bx bx-edit-alt' ></i></button>
                                    <button onclick="deleteId(${row.id})" style="width: 30px;height:30px" class="border-0 btn btn-sm btn-danger rounded-circle pointer-event d-flex justify-content-center align-items-center"><i style="font-weight: bold;" class='bx bx-x'></i></button>
                                    <button onclick="showModal.show();show(${row.id})" style="width: 30px;height:30px" class="border-0 btn btn-sm btn-warning rounded-circle pointer-event d-flex justify-content-center align-items-center"><i style="font-weight: bold;color:#fff;" class='bx bx-show-alt'></i></button>
                                </div>
                                </div>
                            </div>
                            </div>
                        `;
                        }
                        tbody.innerHTML = str;
                    }else{str = "<tr><td>No records found!</td></tr>";}
                    
                }
                else
                if(obj.data_type == 'search'){
                    let tbody = document.querySelector(".cards-musique");
                    let str = "";
                    if(typeof obj.data == 'object'){
                        for (var i = 0; i < obj.data.length; i++) {
                        let row = obj.data[i];
                        //console.log('bitch')
                        //console.log(row)
                        str += `
                            <div class="card" style="width: 18rem;background-color: transparent;border: none;margin-bottom: 10px;">
                            <div style="width: 95%;background-color: rgb(220, 220, 222);margin: auto;">
                            <div class="card-body">
                                <h5 class="card-title">${row.singer}</h5>
                                <p class="card-text">${row.song_name}</p>
                                <span class="card-text">${row.date_created}</span>
                                <div class="d-flex gap-2">
                                    <button onclick="editModal.show();getId(${row.id})" style="width: 30px;height:30px" class="border-0 btn btn-sm btn-success rounded-circle pointer-event d-flex justify-content-center align-items-center"><i style="font-weight: bold;" class='bx bx-edit-alt' ></i></button>
                                    <button onclick="deleteId(${row.id})" style="width: 30px;height:30px" class="border-0 btn btn-sm btn-danger rounded-circle pointer-event d-flex justify-content-center align-items-center"><i style="font-weight: bold;" class='bx bx-x'></i></button>
                                    <button onclick="showModal.show();show(${row.id})" style="width: 30px;height:30px" class="border-0 btn btn-sm btn-warning rounded-circle pointer-event d-flex justify-content-center align-items-center"><i style="font-weight: bold;color:#fff;" class='bx bx-show-alt'></i></button>
                                </div>
                                </div>
                            </div>
                            </div>
                        `;
                        }
                        tbody.innerHTML = str;
                    }else{str = "<tr><td>No records found!</td></tr>";}
                    
                }
            }
	    }
        ////////////////////////////////////////////////////////////
        function create(){
            let label_auther=document.createElement('label')
            label_auther.setAttribute('for','song_name')
            label_auther.setAttribute('class','form-label')
            label_auther.textContent=`Name-${counters}`
            let input_auther=document.createElement('input')
            input_auther.setAttribute('name','song_name')
            input_auther.setAttribute('class','form-control')
            input_auther.setAttribute('id',`song_name_${counters}`)
            let content_div_one=document.createElement('div')
            content_div_one.setAttribute('class','mt-2')
            content_div_one.append(label_auther)
            content_div_one.append(input_auther)


            let label_titre=document.createElement('label')
            label_titre.setAttribute('for','singer')
            label_titre.setAttribute('class','form-label')
            label_titre.textContent=`Titre-${counters}`
            let input_titre=document.createElement('input')
            input_titre.setAttribute('name','singer')
            input_titre.setAttribute('class','form-control')
            input_titre.setAttribute('id',`singer_${counters}`)
            let content_div_two=document.createElement('div')
            content_div_two.setAttribute('class','mt-2')
            content_div_two.append(label_titre)
            content_div_two.append(input_titre)


            let textarea_words=document.createElement('textarea')
            textarea_words.setAttribute('name','words')
            textarea_words.setAttribute('class','form-control')
            textarea_words.setAttribute('id',`words_${counters}`)
            let content_div_three=document.createElement('div')
            content_div_three.setAttribute('class','mt-2')
            content_div_three.append(textarea_words)
            content_div_three.append(textarea_words)
            //let img=document.createElement('input')
            //img.setAttribute('name','img')
            //img.setAttribute('id',`img`)
            //img.setAttribute('type',`file`)



            let div_field=document.createElement('div')
            div_field.setAttribute('class','field_content')

            div_field.append(content_div_one)
            div_field.append(content_div_two)
            div_field.append(content_div_three)
            modal_body.append(div_field)
        }
        create()


        document.querySelector('.btn_add').addEventListener('click',function(){
            counters++
            create()
        })



        document.querySelector('.btn_remove').addEventListener('click',function(){
            document.querySelectorAll(`.field_content`)[counters].remove()
            counters--
        })


        
        //console.log(counters)

        function add(e){
            let data=[]
            e.preventDefault()
            let fields_div=document.querySelectorAll('.add-new-modals .field_content')
            //console.log(fields_div)
            fields_div.forEach((item,index)=>{
                let title=item.querySelector(`#singer_${index}`).value 
                let name=item.querySelector(`#song_name_${index}`).value 
                let words=item.querySelector(`#words_${index}`).value 
                let obj={}
                obj['singer_'+index]=title 
                obj['song_name_'+index]=name
                obj['words_'+index]=words
                data.push(obj)
            })
            send_data(data,'add')
        }
        function getId(id){
            let data_id=[]
            let obj={
                id:id 
            }
            data_id.push(obj)
            send_data(data_id,'get-edit');
    
	    }
        function show(id){
            let data_id=[]
            let obj={
                id:id 
            }
            data_id.push(obj)
            send_data(data_id,'show');
    
	    }
        function deleteId(id){
            let data_id=[]
            let obj={
                id:id 
            }
            data_id.push(obj)
            send_data(data_id,'delete');
    
	    }
        function edit(e){
            e.preventDefault()
            let data_edits=[]
            let edit_modal=document.querySelector('#edit-new-modal')
            let title=edit_modal.querySelector(`#title`).value 
            let name=edit_modal.querySelector(`#auther`).value 
            let words=edit_modal.querySelector(`#words`).value 
            let id=edit_modal.querySelector(`#id`).value 
            id=parseInt(id);
            let obj={}
            obj['singer']=title 
            obj['song_name']=name
            obj['words']=words
            obj['id']=id
            data_edits.push(obj)
            send_data(data_edits,'update')
        }

        function getState(e){
            
            let data_sort=[]
            let obj={
                sort:e.target.value 
            }
            data_sort.push(obj)
            send_data(data_sort,'sorting');
        }

        function showHint(value){
            console.log(value)
            let data_search=[] 
            let obj={
                value:value 
            }
            data_search.push(obj)
            send_data(data_search,'search');
        }




    </script>


</body>
</html>