<?php
if(isset($_POST['submit'])){
    include "connection.php";
    $username=mysqli_real_escape_string($conn,$_POST['user']);    //mysqli_real_escape_string : to support special characters in username
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=mysqli_real_escape_string($conn,$_POST['pass']);
    $cpassword=mysqli_real_escape_string($conn,$_POST['cpass']);
   
    $sql="select * from users where username='$username'";
    $result=mysqli_query($conn,$sql);
    $count_user=mysqli_num_rows($result);

    $sql="select * from users where email='$email'";
    $result=mysqli_query($conn,$sql);
    $count_email=mysqli_num_rows($result);
    


    if($count_user==0 & $count_email==0){
        if($password==$cpassword){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "insert into users (username, email, password) values('$username', '$email','$hash')";
        $result = mysqli_query($conn, $sql);
        }
        else{
        echo '<script>
        alert("Password do not match!!!");
        window.location.href = "signup.php";
        </script>';
        }
    }
        else{
        echo '<script>
        alert("User already exists!!!");
        window.location.href="index.php";
        </script>';
        }
    }

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
  <body>
  <?php  
      include "navbar.php"; 
    ?>
    <div id="form">
        <h1>Signup form</h1>
        <form name="form" action="signup.php" method="POST"> <!--since we have to post the values,use post method-->
        <label>Enter Username</label>
        <input type="text" id="user" name="user" required ><br><br>
        <label>Enter Email</label>
        <input type="email" id="email" name="email" required ><br><br>
        <label>Enter Password</label>
        <input type="password" id="pass" name="pass" required ><br><br>
        <label>Retype password</label>
        <input type="password" id="cpass" name="cpass" required ><br><br>
        <input type="submit" id="btn" value="signup" name="submit"/> <br><br>
</form>     

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>