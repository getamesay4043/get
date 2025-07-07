<?php
$conn = mysqli_connect('localhost','root','','school');
if($conn->connect_error){
  echo "error";
}else{
//   echo "success";
}

if(isset($_POST["submit"])){

$username = $_POST["username"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$department = $_POST["department"];
$password = $_POST["password"];

$sql = 
  "insert into teacher (username, firstname, lastname, departmentid, password)
  values ('$username','$firstname','$lastname','$department','$password')";
  
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
    <title>signup teacher</title>
    <link rel="stylesheet" href="index.css" />
  </head>
  <body>
    <div class="container">
      <div>
        <form action="signupteacher.php" method="post">
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
