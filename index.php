<?php
session_start();
include "conn.php";
if(isset($_POST["submit"])){
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "select * from student where username='$username' and password='$password'";
  $results = mysqli_query($conn,$sql);
  $row = $results -> fetch_assoc();
  $role = $row["role"];
  if($results -> num_rows > 0){
    $_SESSION["role"] = $role;
    $_SESSION["studentid"] = $row["studentid"];
    $_SESSION["classid"] = $row["classid"];
    $_SESSION["teacherid"] = $row["teacherid"];
    $_SESSION["username"] = $username;

    header("Location:studentdashboard.php");
  } else {
    header("Location:index.php");
  }
  $sql = "select * from teacher where username='$username' and password='$password'";
  $results = mysqli_query($conn,$sql);
  $row = $results -> fetch_assoc();
  $role = $row["role"];
  if($results -> num_rows > 0){
    $_SESSION["role"] = $role;
    $_SESSION["studentid"] = $row["studentid"];
    $_SESSION["teacherid"] = $row["teacherid"];
    $_SESSION["username"] = $username;

    header("Location:teacherdashboard.php");
  }  
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>index page</title>
    <link rel="stylesheet" href="index.css" />
  </head>
  <body>
    <div class="container">
      <div>
        <form action="index.php" method="POST">
          <div>
            <label>username</label>
            <input type="text" name="username" />
          </div>
          <div>
            <label>password</label>
            <input type="text" name="password" />
          </div>
          <div>
            <input type="submit" value="submit" name="submit" />
          </div>
        </form>
      </div>
      <div>
        <a href="./signupteacher.php"> Signup as a teacher</a>
        <span></span>
        <a href="./signupstudent.php"> Sign up as a student</a>
      </div>
    </div>
  </body>
</html>
