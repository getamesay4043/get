<?php
include "conn.php";
session_start();
$studentid = $_SESSION["studentid"];
$teacherid = $_SESSION["teacherid"];
$role = $_SESSION["role"];

if(isset($_POST["submit"])){
$username = $_POST["username"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$password = $_POST["password"];

if($role === 'student'){
$sql = "update student set username = '$username', firstname = '$firstname', lastname = '$lastname', password = '$password' where studentid = '$studentid'";
if($conn -> query($sql) === true){
  // echo "success";
}else{
  echo "error" .$conn -> error;
  
}
}
if($role === 'teacher'){
$sql = "update teacher set username = '$username', firstname = '$firstname', lastname = '$lastname', password = '$password' where teacherid = '$teacherid'";
if($conn -> query($sql) === true){
  // echo "success";
}else{
  echo "error" .$conn -> error;
  
}
}
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>update info</title>
    <link rel="stylesheet" href="index.css" />
  </head>
  <body>
    <div class="container">
      <div>
        <form action="updateinfo.php" method="post">
          <div>
            <label>username</label>
            <input type="text" name="username" />
          </div>
          <div>
            <label>firstname</label>
            <input type="text" name="firstname" />
          </div>
          <div>
            <label>lastname</label>
            <input type="text" name="lastname" />
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
    </div>
  </body>
</html>
