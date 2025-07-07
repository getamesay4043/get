<?php
include "conn.php";
if(isset($_POST["submit"])){

$username = $_POST["username"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$class = $_POST["class"];
$password = $_POST["password"];

$sql = 
  "insert into student (username, firstname, lastname, classid, password)
  values ('$username','$firstname','$lastname','$class','$password')";
   
  $conn->query($sql);
  header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>signup student</title>
    <link rel="stylesheet" href="index.css" />
  </head>
  <body>
    <div class="container">
      <div>
        <form action="signupstudent.php" method="post">
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
            <label>class</label>
            <select name="class">
              <option value="1" selected>class1</option>
              <option value="2">class2</option>
              <option value="3">class3</option>
            </select>
          </div>
          <div>
            <label>department</label>
            <select name="department">
              <option value="1" selected>ICT</option>
              <option value="2">Fashion design</option>
              <option value="3">Electro</option>
            </select>
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
        <a href="./index.php">Have an account - Sign in</a>
      </div>
    </div>
  </body>
</html>
