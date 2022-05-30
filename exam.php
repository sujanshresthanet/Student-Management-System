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
  $update = "SELECT * FROM exam WHERE id='".$_GET['update']."'";
  $result = $conn->query($update);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

      $id = $row['id'];
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
                <h2><?php echo (isset($_GET['update']))?"Update exam":"Add exam"; ?></h2>
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
                    $subject = $_POST['subject'];
                    $teacher = $_POST['teacher'];
                    $classroom = $_POST['classroom'];

                    $date = date_format(new DateTime($_POST['date']),'Y-m-d');
                //echo $dob;
               // $day = $_POST['day'];
                    $stime = $_POST['stime'];
                    $etime = $_POST['etime'];






                    try {




                      $sql = "INSERT INTO exam(subject,teacher,classroom,`date`,stime,etime) VALUES ('".$subject."', '".$teacher."', '".$classroom."','".$date."','".$stime."','".$etime."')";

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
                  Update Student Successfully
                </div>

                <?php

                if (isset($_POST['submit'])) {
                  $id = $_POST['id'];
                  $fname = $_POST['fname'];
                  $lname = $_POST['lname'];
                  $email = $_POST['email'];
                  $dob = date_format(new DateTime($_POST['dob']),'Y-m-d');
                //echo $dob;
                  $gender = $_POST['gender'];
                  $address = $_POST['address'];

                  $skill = $_POST['skill'];

                  $contact = $_POST['contact'];



                  try {


                    $sql = "UPDATE exam SET fname='".$fname."',lname='".$lname."',bday='".$dob."',address='".$address."',gender='".$gender."',skill='".$skill."',contact='".$contact."',email='".$email."' WHERE id = '".$id."'";

                   // $sql = "INSERT INTO Exam (id,fname,lname,bday,address,gender,skill,contact,email) VALUES ('".$id."', '".$fname."', '".$lname."','".$dob."','".$address."','".$gender."','".$skill."','".$contact."','".$email."')";

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
                  <label>Subject</label>
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="subject"><option >Select Subject</option>
                    <?php
                    $sql = "SELECT * FROM subject";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                   // output data of each row
                     while($row = $result->fetch_assoc()) {
                      echo "<option value='".$row["sid"]."' >".$row["title"]."_ID:".$row["sid"]."</option>";
                    }
                  }
                  ?>
                </select>
              </div>




              <div class="form-group">
                <label>Exam Hall (Class Room)</label>
                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="classroom"><option >Select Class Room</option>
                  <?php
                  $sql = "SELECT * FROM classroom";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                   // output data of each row
                   while($row = $result->fetch_assoc()) {
                    echo "<option value='".$row["hno"]."' >".$row["title"]."_ID:".$row["hno"]."</option>";
                  }
                }
                ?>
              </select>
            </div>

            <div class="form-group">
              <label>Teacher in Charge </label>
              <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="teacher"><option >Select Teacher</option>
                <?php
                $sql = "SELECT * FROM teacher";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                   // output data of each row
                 while($row = $result->fetch_assoc()) {
                  echo "<option value='".$row["tid"]."' >".$row["fname"]." ".$row["lname"]."_ID:".$row["tid"]."</option>";
                }
              }
              ?>
            </select>
          </div>

          <div class="form-group">

            <label>Date</label>

            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" name='date' class="form-control pull-right" id="datepicker" placeholder="Select Student's Data of Birth">
            </div>
            <!-- /.input group -->

          </div>



          <div class="bootstrap-timepicker">
            <div class="form-group">
              <label>Start Time:</label>

              <div class="input-group">
                <input name="stime" type="text" class="form-control timepicker">

                <div class="input-group-addon">
                  <i class="fa fa-clock-o"></i>
                </div>
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
          </div>


          <div class="bootstrap-timepicker">
            <div class="form-group">
              <label>End Time:</label>

              <div class="input-group">
                <input name="etime" type="text" class="form-control timepicker">

                <div class="input-group-addon">
                  <i class="fa fa-clock-o"></i>
                </div>
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
          </div>











        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" name="submit" value="submit" class="btn btn-primary">Add Exam</button>
        </div>
      </form>

    </div>
  </div>




</div>

<div class="col-md-9">

  <div class="x_panel">
    <div class="x_title">
      <h2>All <small>Students</small></h2>
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
                  <th>Subject</th>
                  <th>Teacher In Charge</th>
                  <th>Location (Classroom)</th>
                  <th>Date</th>
                  <th>Start Time</th>
                  <th>End Time</th>

                </tr>
              </thead>


              <tbody>
               <?php

               $sql = "SELECT * FROM Exam";
               $result = $conn->query($sql);

               if ($result->num_rows > 0) {
                   // output data of each row
                 while($row = $result->fetch_assoc()) {
                  echo "<tr><td> " . $row["id"]. " </td><td> " . $row["subject"]." </td><td> " . $row["teacher"]." </td><td> " . $row["classroom"]. "</td><td>" . $row["date"]. "</td><td>" . $row["stime"]. "</td><td>" . $row["etime"]. "</td></tr>";
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