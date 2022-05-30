<?php session_start();


include_once 'database.php';
if (!isset($_SESSION['user'])||$_SESSION['role']!='Teacher') {
  # code...
  header('Location:./logout.php');
}
?>
<?php

$id =$fname =$lname = $classroom = $dob = $gender = $address = $parent=" ";


if(isset($_GET['update'])){
  $update = "SELECT * FROM examresult WHERE exam='".$_GET['update']."'";
  $result = $conn->query($update);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

      $exam = $row['exam'];
      $fname = $row['fname'];
      $lname = $row['lname'];
      $contact = $row['contact'];
      $skill = $row['skill'];
      $dob = date_format(new DateTime($row['bday']),'m/d/Y');
                //echo $dob;
      $gender = $row['gender'];
      $address = $row['address'];
      $email=$row['email'];

    }
  }
}

?>

<!DOCTYPE html>

<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Dashboard</title><link rel="icon" href="../img/favicon2.png">
  <!-- Tell the browser to be responsive to screen width -->
  <?php include_once 'header.php'; ?>


</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <?php include_once 'sidebar.php'; ?>

      </div>

<?php include_once 'nav-menu.php'; ?>

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="row">
          <div class="col-md-3">
            <div class="x_panel">
              <div class="x_title">
                <h2><?php echo (isset($_GET['update']))?"Update examresult":"Add examresult"; ?></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                <?php if (!isset($_GET['update'])) {
                  if (isset($_POST['submit'])) {
                    $exam = $_POST['exam'];
                    $student = $_POST['student'];
                    $marks = $_POST['marks'];

              // $date = date_format(new DateTime($_POST['date']),'Y-m-d');
                //echo $dob;
               // $day = $_POST['day'];
                 // $stime = $_POST['stime'];
                    $grade = $_POST['grade'];



                    try {




                      $sql = "INSERT INTO examresult(exam,student,marks,grade) VALUES (".$exam.", '".$student."', ".$marks.",'".$grade."')";

                      if ($conn->query($sql) === TRUE) {
                       echo "<script type='text/javascript'> var x = document.getElementById('truemsg');
                       x.style.display='block';</script>";
                     } else {
                     }

                   } catch (Exception $e) {

                   }





                # code...
                 }

                 ?>
               <?php }elseif (isset($_GET['update'])) { ?>

                <div class="alert alert-success alert-dismissible" style="display: none;" id="truemsg">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-check"></i> Success!</h4>
                  Update Examresult Successfully
                </div>

                <?php

                if (isset($_POST['submit'])) {
                  $exam = $_POST['exam'];
                  $student = $_POST['student'];
                  $marks = $_POST['marks'];

              // $date = date_format(new DateTime($_POST['date']),'Y-m-d');
                //echo $dob;
               // $day = $_POST['day'];
                 // $stime = $_POST['stime'];
                  $grade = $_POST['grade'];






                  try {




                    $sql = "INSERT INTO examresult(exam,student,marks,grade) VALUES (".$exam.", '".$student."', ".$marks.",'".$grade."')";

                    if ($conn->query($sql) === TRUE) {
                     echo "<script type='text/javascript'> var x = document.getElementById('truemsg');
                     x.style.display='block';</script>";
                   } else {
                   }

                 } catch (Exception $e) {

                 }







                # code...
               }
             }

             ?>

             <form role="form" method="POST" >
              <div class="box-body">



                <div class="form-group">
                  <label>Exam</label>
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="exam"><option >Select Exam</option>
                    <?php
                    $sql = "SELECT * FROM exam";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                   // output data of each row
                     while($row = $result->fetch_assoc()) {
                      echo "<option value='".$row["id"]."' >".$row["subject"]." - ID:".$row["id"]." - Date:".$row["date"]."</option>";
                    }
                  }
                  ?>
                </select>
              </div>




              <div class="form-group">
                <label>Student</label>
                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="student"><option >Select Student</option>
                  <?php
                  $sql = "SELECT * FROM student";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                   // output data of each row
                   while($row = $result->fetch_assoc()) {
                    echo "<option value='".$row["sid"]."' >".$row["fname"]." ".$row["lname"]." -ID:".$row["sid"]."</option>";
                  }
                }
                ?>
              </select>
            </div>


            <div class="form-group">
              <label for="exampleInputPassword1">Marks</label>
              <input name="marks" type="number" class="form-control" id="exampleInputPassword1" placeholder="Enter Marks" required>
            </div>

            <div class="form-group">
              <label>Grade </label>
              <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="grade"><option >Select Grade</option>
               <option value="A+">A+</option>
               <option value="A">A</option>
               <option value="A-">A-</option>
               <option value="B+">B+</option>
               <option value="B">B</option>
               <option value="B-">B-</option>
               <option value="C+">C+</option>
               <option value="C">C</option>
               <option value="C-">C-</option>
               <option value="D+">D+</option>
               <option value="D">D</option>
               <option value="E">E</option>
             </select>
           </div>


         </div>
         <!-- /.box-body -->

         <div class="box-footer">
          <button type="submit" name="submit" value="submit" class="btn btn-primary">Add Result</button>
        </div>
      </form>

    </div>
  </div>




</div>

<div class="col-md-9">

  <div class="x_panel">
    <div class="x_title">
      <h2>All <small>Examresults</small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">Settings 1</a>
            <a class="dropdown-item" href="#">Settings 2</a>
          </div>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
          <div class="card-box table-responsive">
            <p class="text-muted font-13 m-b-30">
              School Management System
            </p>
            <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>Exam ID</th>
                  <th>Student ID</th>
                  <th>Marks</th>
                  <th>Grade</th>
                </tr>
              </thead>


              <tbody>
                <?php

                $sql = "SELECT * FROM examresult";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                   // output data of each row
                 while($row = $result->fetch_assoc()) {
                  echo "<tr><td> " . $row["exam"]. " </td><td> " . $row["student"]." </td><td> " . $row["marks"]." </td><td> " . $row["grade"]. "</td></tr>";
                }
              }

              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

</div>
<!-- /.box -->

</div>

</div>
<!-- /page content -->

<!-- footer content -->
<footer>
  <div class="pull-right">
    Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
  </div>
  <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>
<?php include_once 'footer.php'; ?>

</body>

</html>