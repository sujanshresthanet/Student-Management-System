<?php session_start();


include_once 'database.php';
if (!isset($_SESSION['user'])||$_SESSION['role']!='Teacher') {
  # code...
  header('Location:./logout.php');
}
?>
<?php

$sid =$fname =$lname = $schedule = $dob = $gender = $address = $parent=" ";


if(isset($_GET['update'])){
  $update = "SELECT * FROM schedule WHERE sid='".$_GET['update']."'";
  $result = $conn->query($update);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $sid = $row['sid'];
      $fname = $row['fname'];
      $lname = $row['lname'];
      $schedule = $row['schedule'];
      $email = $row['email'];
      $dob = date_format(new DateTime($row['bday']),'Y-m-d');
                //echo $dob;
      $gender = $row['gender'];
      $address = $row['address'];
      $parent=$row['parent'];

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
                <h2><?php echo (isset($_GET['update']))?"Update schedule":"Add schedule"; ?></h2>
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
                    $sid = $_POST['schedule'];


                    $date = date_format(new DateTime($_POST['date']),'Y-m-d');


                    try {

                      $sql = "INSERT INTO attendance (`date`,sid) VALUES ('".$date."', '".$sid."')";

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
                  Update Schedule Successfully
                </div>

                <?php

                if (isset($_POST['submit'])) {
                  $sid = $_POST['sid'];
                  $fname = $_POST['fname'];
                  $lname = $_POST['lname'];
                  $schedule = $_POST['schedule'];
                  $email = $_POST['email'];
                  $dob = date_format(new DateTime($_POST['dob']),'Y-m-d');
                //echo $dob;
                  $gender = $_POST['gender'];
                  $address = $_POST['address'];

                  $parent = $_POST['parent'];





                  try {

                    $sql = "UPDATE schedule set fname='".$fname."',lname='".$lname."',bday='".$dob."',address='".$address."',gender='".$gender."',parent=".$parent.",schedule='".$schedule."',email='".$email."' where sid='".$sid."'";


                   // $sql = "INSERT INTO schedule (sid,fname,lname,bday,address,gender,parent,schedule) VALUES ('".$sid."', '".$fname."', '".$lname."','".$dob."','".$address."','".$gender."','".$parent."','".$schedule."')";

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
                  <label>Schedule</label>
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="schedule"><option >Select Schedule</option>
                    <?php
                    $sql = "SELECT * FROM schedule";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                   // output data of each row
                     while($row = $result->fetch_assoc()) {
                      echo "<option value='".$row["id"]."' >".$row["subject"]." - ".$row["class"]." - ".$row["day"]." - ".$row["stime"]."</option>";
                    }
                  }
                  ?>
                </select>
              </div>

              <div class="form-group">

                <label>Date</label>

                <div class="input-group date">
                  <input type="date" name='date' class="form-control pull-right" id="datepicker" placeholder="Select Date">
                </div>
                <!-- /.input group -->

              </div>



            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" name="submit" value="submit" class="btn btn-primary">Add Attendance</button>
            </div>
          </form>


        </div>
      </div>




    </div>

    <div class="col-md-9">

      <div class="x_panel">
        <div class="x_title">
          <h2>All <small>Schedules</small></h2>
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
                     <th>Attendance ID</th>
                     <th>Subject</th>
                     <th>Classroom</th>
                     <th>Date</th>
                     <th>Start Time</th>
                     <th>Actions</th>
                   </tr>
                 </thead>


                 <tbody>
                   <?php

                   $sql = "SELECT attendance.aid,attendance.date,schedule.subject,schedule.class,schedule.stime FROM attendance,schedule where attendance.sid=schedule.id";
                   $result = $conn->query($sql);

                   if ($result->num_rows > 0) {
                   // output data of each row
                     while($row = $result->fetch_assoc()) {
                      echo "<tr><td> " . $row["aid"]. " </td><td> " . $row["subject"]." </td><td> " . $row["class"]." </td><td> " . $row["date"]. "</td><td>" . $row["stime"]. "</td>
                      <td><a href='attendancelist.php?aid=". $row["aid"]."&class=". $row["class"]."&stime=". $row["stime"]."&date=". $row["date"]."&subject=". $row["subject"]."'><small class='btn btn-sm btn-primary'>View Report</small></a></td></tr>";
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


<script type="text/javascript">
  $('#myDatepicker3, #myDatepicker4').datetimepicker({
    format: 'hh:mm A'
  });
</script>

</body>

</html>