
<?php 

if($_SERVER['REQUEST_METHOD']=="POST"){
    if(count($_POST) > 0){
        require './models/init.php';
        $user=new User();
        $errors=$user->login($_POST);
    }
}


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
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <div class="form-field">
        <h2>Login</h2>
        <?php if(isset($errors) && is_array($errors) && count($errors) > 0):?>
            <div>
                <?php foreach($errors as $error):?>
                <div  class="alert alert-danger"><?=$error?><br></div>
                <?php endforeach;?>
            </div>
        <?php endif;?>
        <style>
            .hidden{
                display:none;
            }
        </style>
        <div>
            <div class="alert alert-danger error_message-email hidden"></div>
            <div class="alert alert-danger error_message-password hidden"></div>
        </div>
        <form method="POST" onsubmit="return validateForm()">
            <div class="field">
                <i class='bx bx-envelope'></i>
                <input type="email" name="email" id="email" placeholder="email"/>
                
            </div>
            
            <div class="field">
                <i class='bx bx-lock-alt' ></i>
                <input type="password" name="password" id="password" placeholder="........."/>
            </div>
            <div class="field">
               <button type="submit">Login</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="assets/js/index.js"></script>
</body>

<script>
    function validateForm() {
    let email = document.getElementById("email");
    let password = document.getElementById("password");
    let reg_exp = /^[^ ]+@[a-z]+\.[a-z]{2,3}$/;
    if (email.value == "" || !email.value.match(reg_exp)) {
        // console.log("Invalid email address");
        event.preventDefault();
        document.querySelector(".error_message-email").innerHTML =
            "*Invalid email address";
        
        document.querySelector(".error_message-email").style.color = "red";
        document.querySelector(".error_message-email").classList.remove('hidden')
        //return false;
    } else {
        document.querySelector(".error_message-email").innerHTML = "";
        document.querySelector(".error_message-email").classList.add('hidden')
    }
    if (password.value == "" || password.value.length < 8) {
        // console.log("Invalid password");
        event.preventDefault();
        document.querySelector(".error_message-password").innerHTML =
            "*Invalid password";
        document.querySelector(".error_message-password").style.color = "red";
        document.querySelector(".error_message-password").classList.remove('hidden')
        return false;
    } else {
        document.querySelector(".error_message-password").innerHTML = "";
        document.querySelector(".error_message-password").classList.remove(
            'hidden')
    }
    return true;
}
</script>
</html>