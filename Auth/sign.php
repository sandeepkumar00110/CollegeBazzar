<?php

$showAlert = false;
$showError = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include 'partials/_dbconnect.php';
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    $exists = false;
    $sql1 = "Select * from users where username='$username' OR email='$email'";
    $res = mysqli_query($conn, $sql1);
    $num = mysqli_num_rows($res);
    if ($num == 1) {
        $exists = true;
    }

    if (($password == $cpassword) && ($exists == false)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users`(`username`, `email`, `password`) VALUES ('$username','$email','$password')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $showAlert = true;
        }
    } else if ($exists == true) {
        $showError = "Username/Email already exists";
    } else {
        $showError = "Password do not match";
    }
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sigin</title>
    <link rel="stylesheet" href="assets/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,500;0,900;1,100;1,300&family=Sen:wght@400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="">
    <?php require 'partials/css.php'  ?>



</head>

<body>

    <!-- navbar start -->

    <!-- navbar end -->

    <!-- error for sigin page -->
    <?php
    if ($showAlert) {
        echo '<div style="font-family: ui-sans-serif;
       background: linear-gradient(54deg, #113e15, #ffb103fc);
       color:white;
        font-size: xx-large;
        padding: 15px;
        border-radius: 50px;" class="alert alert-success alert-dismissible fade show" role="alert">
             <strong>Success</strong> Your account is created you can login!
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>';
    }
    if ($showError) {
        echo '<div style="font-family: fantasy;
        background: linear-gradient(54deg, #ff1f1f, #ffb103fc);
         font-size: xx-large;
         padding: 15px;
         border-radius: 5px; class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error</strong> ' . $showError . '
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    <!-- end error for sigin page -->


    <div class="center">
        <h1 style>Sign Up</h1>
        <form method="POST">
            <div class="txt_field">
                <input type="text" id='username' name='username' required>
                <span></span>
                <label> Username</label>
            </div>
            <div class="txt_field">
                <input type="email" id='email' name='email' required>
                <span></span>
                <label> Email</label>
            </div>
            <div class="txt_field">
                <input type="password" id='password' name='password' required>
                <span></span>
                <label> Password</label>
            </div>
            <div class="txt_field">
                <input type="password" id='cpassword' name='cpassword' required>
                <span></span>
                <label>Confirm Password</label>
            </div>
            <div class="pass">Forget Password?</div>

            <input type="submit" value="Sign Up">
            <div class="signup_link">
                Already have an Account? <a href="../Auth/login.php">Login</a>
            </div>
        </form>
    </div>

    <!-- <form action="" method="POST">
   <div id="all"> 
  
    <div class="row1">
          <p>Log In</p>
    </div>
    <div class="all1">
       
       <label for="email">Email</label>
        <input type="email" name="email" id="mail" value="email">
       <label for="password">Password</label>
        <input type="password" name="password" id="Password" value="password" >
        <div id="log">
            <button name="submit" id="butn" type="submit">Log In</button>
        </div>
         <div class="lhead">
            <span class="row3">Don't have an account? </span>
            <span class="row3"><a href="siginfinal.php">Register Here</a></span>
            </div>
   
    </div>
    </form>
</div>    -->



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>