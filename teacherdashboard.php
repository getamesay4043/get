<?php
session_start(); 
include "conn.php";
$teacher_id = $_SESSION["teacherid"];
if (isset($_POST["logout"])) {
  session_destroy();
  header("Location:index.php");
  exit;
}
if (isset($_POST["submit"])) {
  $class=$_POST["class"];
  $uc=$_POST["UC"];
  $schoolyear=$_POST["schoolyear"];
  $teacherid=$_SESSION["teacherid"];

    $sql = "INSERT INTO teacherclass ( teacherid, classid, ucid, schoolyear) VALUES ( '$teacherid', '$class', '$uc', '$schoolyear')";
  $conn->query($sql);
}
$sql="SELECT * FROM `teacherclass` WHERE teacherid='$teacher_id'";
$result = $conn->query($sql);

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
          <div>welcome teacher<?php echo $_SESSION["username"];?></div>
          <div>
            <div class="menu">
              <button>menu</button>
              <div class="hover-menu">
                <form action="teacherdashboard.php" method="POST">
                  <input type="submit" value="logout" name="logout" />
                </form>
                <a href="./updateinfo.php">update info</a>
              </div>
            </div>
          </div>
        </div>
        <div class="classes">
          <ul>
            <?php
            while ($row = $result -> fetch_assoc()) {

              $teacherclassid = $row["teacherclassid"];
              $tcsql="SELECT * FROM `teacher` WHERE teacherid = $teacher_id";
              $tcresult=$conn->query($tcsql);
              $tcrow = $tcresult -> fetch_assoc();
              if($tcresult->num_rows > 0){
                $departmentid = $tcrow["departmentid"];
                $classid=$row["classid"];
                $ucid=$row["ucid"];
                $schoolyear=$row["schoolyear"];
              }
              $depsql="SELECT * FROM `department` WHERE departmentid = $departmentid";
              $depresult=$conn->query($depsql);
              $deprow = $depresult -> fetch_assoc();
              if($depresult->num_rows > 0){
                $departmentname = $deprow["departmentname"];
              }

              $crsql= "SELECT * FROM `classroom` WHERE classid = '$classid'";
              $crresult=$conn->query($crsql);
              $crrow = $crresult -> fetch_assoc();
              if($crresult->num_rows > 0){
                $classname = $crrow["classname"];
              }
              $ucsql= "SELECT * FROM `uc` WHERE ucid = '$ucid'";
              $ucresult=$conn->query($ucsql);
              $ucrow = $ucresult -> fetch_assoc();
              if($ucresult->num_rows > 0){
                $uctitle= $ucrow['uctitle'];
                $uccode= $ucrow['uccode'];
                
              }
  
              echo "<li>
                <p>$departmentname/level1/$classname</p>
                <p>UC name: $uctitle</p>
                <p>UC Code: $uccode</p>
                <p>Year: $schoolyear</p>
                <form class='remove' action='teacherdashboard.php' method='post'>
                <input type='hidden' name='courseid' value='$teacherclassid'>
                  <input style='  width:auto; padding-left: 12px; padding-right: 12px;' type='submit' class='remove' name='remove' value='Remove Course'>
                </form>
              </li>";
              if(isset($_POST["remove"])){
                $courseid=$_POST["courseid"];
                $conn->query("DELETE FROM `teacherclass` WHERE teacherclassid = $courseid");
              }   
            } 
            ?>
          </ul>
        </div>
      </div>

      <div class="addclass">
        <h3>Add Course</h3>
        <form action="teacherdashboard.php" method="POST">
          <label>Class Name</label>
          <select name="class">
            <option value="1">class1</option>
            <option value="2">class2</option>
            <option value="3">class3</option>
          </select>
          <label>UC</label>
          <select name="UC">
            <option value="1">Server side scripting</option>
            <option value="2">Sql Server Installation</option>
            <option value="3">Object Oriented Programming</option>
          </select>
          <label>School Year</label>
          <input type="text" name="schoolyear" />
          <input type="submit" value="Save" name="submit" />
        </form>
      </div>
    </div>
  </body>
</html>
