<?php
$name="";
if(isset($_SESSION['name'])){
    $username=$_SESSION['name'];
} 
require './models/init.php';
$user=new User();
$count_user=$user->admin_count();
echo $count_user;
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
                <a href="#">Log-Out</a>
               </div>
            </div>
        </div>
        <div class="body__dash">
            <div class="statistiques">
                <div class="box-statistiq box-1">
                    <div class="info">
                        <h2>Total Admin</h2>
                        <p>40,765</p>
                    </div>
                    <div class="icon">
                        <i class='bx bx-user icon-user'></i>
                    </div>
                </div>
                <div class="box-statistiq box-2">
                    <div class="info">
                        <h2>Total Admin</h2>
                        <p>40,765</p>
                    </div>
                    <div class="icon">
                        <i class='bx bx-pen icon-titre'></i>
                    </div>
                </div>
                <div class="box-statistiq box-3">
                    <div class="info">
                        <h2>Total Artiste</h2>
                        <p>40,765</p>
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
                    <input type="search" id="form1" class="form-control py-2 px-4" placeholder="Search" aria-label="Search" />
                  </div>
            </div>
            <div class="cards-musique my-3 d-flex justify-content-center" style="flex-wrap: wrap;" >
                <div class="card" style="width: 18rem;background-color: transparent;border: none;margin-bottom: 10px;">
                    <div style="width: 95%;background-color: rgb(220, 220, 222);margin: auto;">
                        <img src="https://www.leparisien.fr/resizer/aAoR0NezvoiJtNNP5YKU5cGE3DQ=/932x582/cloudfront-eu-central-1.images.arcpublishing.com/lpguideshopping/NSITFYYHCB7K7ZB5GWEJRPVPJM.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">Title E-Lyrics</h5>
                        <p class="card-text">Mugiwara Luffy</p>
                        <div class="d-flex gap-2">
                            <button onclick="editModal.show()" style="width: 30px;height:30px" class="border-0 btn btn-sm btn-success rounded-circle pointer-event d-flex justify-content-center align-items-center"><i style="font-weight: bold;" class='bx bx-edit-alt' ></i></button>
                            <button style="width: 30px;height:30px" class="border-0 btn btn-sm btn-danger rounded-circle pointer-event d-flex justify-content-center align-items-center"><i style="font-weight: bold;" class='bx bx-x'></i></button>
                            <button onclick="showModal.show()" style="width: 30px;height:30px" class="border-0 btn btn-sm btn-warning rounded-circle pointer-event d-flex justify-content-center align-items-center"><i style="font-weight: bold;color:#fff;" class='bx bx-show-alt'></i></button>
                        </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="modal fade" id="add-new-modal" tabindex="-1" aria-labelledby="add-new-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="add-new-modalLabel" >Add new Lyrics</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" class="js-add-user-form" onsubmit="add__leryx(e)">
            <div class="modal-body">
                  <label class="mt-2 d-block" style="cursor: pointer;text-align: center;">
                      <img src="images/user.png" class="js-add-image mx-auto d-block" style="width:150px;height: 150px;object-fit: cover;">
                      <div class="input-group mb-3">
                        <input id="image"  onchange="display_image(this.files[0])" type="file" class="form-control" id="inputGroupFile01" required hidden>
                      </div>
                      <script>
                          function display_image(file)
                          {
                              let allowed = ['jpg','jpeg','png'];
  
                              let ext = file.name.split(".").pop();
                              
                              if(allowed.includes(ext.toLowerCase()))
                              {
                                  document.querySelector('.js-add-image').src = URL.createObjectURL(file);
                                  image_added = true;
                              }else 
                              {
                                  alert("Only the following image types are allowed:"+ allowed.toString(", "));
                              }
  
                          }
                      </script>
                  </label>
                    <div class="mt-2">
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
                    <button type="button" class="btn-sm btn btn-success rounded-circle d-flex justify-content-center align-items-center" style="width: 25px;height:25px" data-bs-dismiss="modal">+</button>
                    <button type="button" class="btn-sm btn btn-danger rounded-circle d-flex justify-content-center align-items-center" style="width: 25px;height:25px" data-bs-dismiss="modal">-</button>
                    <button type="submit" class="btn btn-primary">Save</button>
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
            <form method="POST" class="js-add-user-form" onsubmit="add_new(event)">
            <div class="modal-body">
                  <label class="mt-2 d-block" style="cursor: pointer;text-align: center;">
                      <img src="images/user.png" class="js-add-image mx-auto d-block" style="width:150px;height: 150px;object-fit: cover;">
                      <div class="input-group mb-3">
                        <input id="image"  onchange="display_image(this.files[0])" type="file" class="form-control" id="inputGroupFile01" required hidden>
                      </div>
                      <script>
                          function display_image(file)
                          {
                              let allowed = ['jpg','jpeg','png'];
  
                              let ext = file.name.split(".").pop();
                              
                              if(allowed.includes(ext.toLowerCase()))
                              {
                                  document.querySelector('.js-add-image').src = URL.createObjectURL(file);
                                  image_added = true;
                              }else 
                              {
                                  alert("Only the following image types are allowed:"+ allowed.toString(", "));
                              }
  
                          }
                      </script>
                  </label>
                    <div class="mt-2">
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
                    <button type="submit" class="btn btn-primary">Save</button>
                    </div>
            </form>
          </div>
        </div>
    </div>
    <div class="modal fade" id="show-new-modal" tabindex="-1" aria-labelledby="show-new-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="add-new-modalLabel" >Show Lyrics</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" class="js-add-user-form" onsubmit="add_new(event)">
            <div class="modal-body">
                  <label class="mt-2 d-block" style="cursor: pointer;text-align: center;">
                      <img src="images/user.png" class="js-add-image mx-auto d-block" style="width:150px;height: 150px;object-fit: cover;">
                      <div class="input-group mb-3">
                        <input id="image"  onchange="display_image(this.files[0])" type="file" class="form-control" id="inputGroupFile01" required hidden>
                      </div>
                      <script>
                          function display_image(file)
                          {
                              let allowed = ['jpg','jpeg','png'];
  
                              let ext = file.name.split(".").pop();
                              
                              if(allowed.includes(ext.toLowerCase()))
                              {
                                  document.querySelector('.js-add-image').src = URL.createObjectURL(file);
                                  image_added = true;
                              }else 
                              {
                                  alert("Only the following image types are allowed:"+ allowed.toString(", "));
                              }
  
                          }
                      </script>
                  </label>
                    <div class="mt-2">
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
                    <button type="submit" class="btn btn-primary">Save</button>
                    </div>
            </form>
          </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="assets/js/index.js"></script>
    <script>
        const addModal = new bootstrap.Modal('#add-new-modal', {});
        const editModal = new bootstrap.Modal('#edit-new-modal', {});
        const showModal = new bootstrap.Modal('#show-new-modal', {});

    </script>


</body>
</html>