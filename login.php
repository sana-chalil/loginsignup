<?php
if(isset($_POST["submit"])){    // if we click on submit btn in login page then nxt processess will take place
  include "connection.php";
  $username=mysqli_real_escape_string($conn,$_POST['user']);
  $password=mysqli_real_escape_string($conn,$_POST['pass']);
  $sql="select * from users where username='$username'or email='$username'"; //in loginpage there is enter username or email.so check
  $result=mysqli_query($conn,$sql);   //result of query store here
  $row=mysqli_fetch_array($result,MYSQLI_ASSOC);    // fetch result from rows . ie, match usernames or email check 
if($row){
  if(password_verify($password,$row["password"])){ // psswrd veify : convert paswrd to hashed pswrd and compare 2 pswrds if matches,it navigate to welcome.php file
      header("Location:welcome.php");
  }
}
else{
  echo '<script>
  alert("Invalid username/email or password!!!");
  window.location.href="login.php";
  </script>';
  }
}
?>

<!doctype html>
<html lang="en"> <!---->
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
        <h1>Login form</h1>
        <form name="form" action="login.php" method="POST"  enctype="multipart/form-data">
        <label>Enter Username/Email</label>
        <input type="text" id="user" name="user" required ><br><br>
        <label>Enter Password</label>
        <input type="password" id="pass" name="pass" required ><br><br>
        <input type="submit" id="btn" value="Login" name="submit"/> <br><br>
    
</form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>