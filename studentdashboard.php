<?php
session_start(); 
include "conn.php";

$class_id=$_SESSION["classid"];
$sql="SELECT * FROM `teacherclass` WHERE classid='$class_id'";
$result=$conn->query($sql);

if (isset($_POST["logout"])) {
  session_destroy();
  header("Location:index.php");
  exit;

}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>teacher's dashboard</title>
    <link rel="stylesheet" href="index.css" />
  </head>
  <body>
  
    <div class="container dashboard-container">
      <div class="main">
        <div class="welcome">
          <div>welcome student<?php echo $_SESSION["username"];?></div>
          <div>
            <div class="menu">
              <button>menu</button>
              <div class="hover-menu">
                <form action="studentdashboard.php" method="post">
                  <input type="submit" value="logout" name="logout" />
                </form>
                <a href="./updateinfo.php">update info</a>
              </div>
            </div>
          </div>
        </div>
        <div class="classes">
          <ul class="class-lists">
            <h2>Your Classes</h2>
          <?php
          if($result->num_rows > 0){
            while($row = $result -> fetch_assoc()){
              $teacherid=$row["teacherid"];
              $classid=$row["classid"];
              $ucid=$row["ucid"];
              $schoolyear=$row["schoolyear"];
              $ucsql= "SELECT * FROM `uc` WHERE ucid = '$ucid'";
              $crsql= "SELECT * FROM `classroom` WHERE classid = '$classid'";
              $tcsql= "SELECT * FROM `teacher` WHERE teacherid = '$teacherid'";
              
              $ucresult=$conn->query($ucsql);
              $crresult=$conn->query($crsql);
              $tcresult=$conn->query($tcsql);
              
              $ucrow = $ucresult -> fetch_assoc();
              if($ucresult->num_rows > 0){
                $uctitle= $ucrow['uctitle'];
                $uccode= $ucrow['uccode'];
                
            }
            $crrow = $crresult -> fetch_assoc();
            if($crresult->num_rows > 0){
              $classname = $crrow["classname"];
              
            }
            $tcrow = $tcresult -> fetch_assoc();
            if($tcresult->num_rows > 0){
              $departmentid = $tcrow["departmentid"];
              $teacher = $tcrow["firstname"];
            }
            $depsql="SELECT * FROM `department` WHERE departmentid = $departmentid";
            $depresult=$conn->query($depsql);
            $deprow = $depresult -> fetch_assoc();
            if($depresult->num_rows > 0){
              $departmentname = $deprow["departmentname"];
            }
            echo "<li>
            <p>$departmentname/level1/$classname</p>
            <p>UC name: $uctitle</p>
            <p>UC Code: $uccode</p>
            <p>teacher: $teacher</p>
            </li>";
        }
      }
      ?>
          </ul>
        </div>
      </div>
    </div>
  </body>
</html>
