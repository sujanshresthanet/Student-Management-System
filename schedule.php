<?php session_start();


include_once 'database.php';
if (!isset($_SESSION['user'])||$_SESSION['role']!='Teacher') {
  # code...
  header('Location:./logout.php');
}
?>
<?php

$id =$fname =$lname = $schedule = $dob = $gender = $address = $parent=" ";


if(isset($_GET['update'])){
  $update = "SELECT * FROM schedule WHERE id='".$_GET['update']."'";
  $result = $conn->query($update);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $id = $row['id'];
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
                    $subject = $_POST['subject'];
                    $teacher = $_POST['teacher'];
                    $classroom = $_POST['classroom'];

               // $dob = date_format(new DateTime($_POST['dob']),'Y-m-d');
                //echo $dob;
                    $day = $_POST['day'];
                    $stime = $_POST['stime'];
                    $etime = $_POST['etime'];






                    try {




                      $sql = "INSERT INTO schedule (subject,teacher,class,day,stime,etime) VALUES ('".$subject."', '".$teacher."', '".$classroom."','".$day."','".$stime."','".$etime."')";

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
                  $id = $_POST['id'];
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

                    $sql = "UPDATE schedule set fname='".$fname."',lname='".$lname."',bday='".$dob."',address='".$address."',gender='".$gender."',parent=".$parent.",schedule='".$schedule."',email='".$email."' where id='".$id."'";


                   // $sql = "INSERT INTO schedule (id,fname,lname,bday,address,gender,parent,schedule) VALUES ('".$id."', '".$fname."', '".$lname."','".$dob."','".$address."','".$gender."','".$parent."','".$schedule."')";

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
                <label>Teacher</label>
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
              <label>Class Room</label>
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
            <label>Day</label>
            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="day"><option >Select Day</option>
             <option value="Monday" >Monday</option>
             <option value="Tuesday" >Tuesday</option>
             <option value="Wendsday" >Wendsday</option>
             <option value="Thursday" >Thursday</option>
             <option value="Friday" >Friday</option>
             <option value="Saturday" >Saturday</option>
             <option value="Sunday" >Sunday</option>
           </select>
         </div>



         <div class="bootstrap-timepicker">
          <div class="form-group">
            <label>Start Time:</label>

            <div class="input-group date" id="myDatepicker3">
              <input type="text" name="stime" class="form-control">
              <span class="input-group-addon">
               <span class="fa fa-clock-o"></span>
             </span>
           </div>
           <!-- /.input group -->
         </div>
         <!-- /.form group -->
       </div>


       <div class="bootstrap-timepicker">
        <div class="form-group">
          <label>End Time:</label>

          <div class="input-group date" id="myDatepicker4">
            <input type="text" name="etime" class="form-control">
            <span class="input-group-addon">
             <span class="fa fa-clock-o"></span>
           </span>
         </div>
         <!-- /.input group -->
       </div>
       <!-- /.form group -->
     </div>











   </div>
   <!-- /.box-body -->

   <div class="box-footer">
    <button type="submit" name="submit" value="submit" class="btn btn-primary">Add Schedule</button>
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
                 <th>Class Room ID</th>
                 <th>Title</th>
                 <th>Location</th>
                 <th>Capacity</th>
               </tr>
             </thead>


             <tbody>
               <?php

               $sql = "SELECT * FROM schedule";
               $result = $conn->query($sql);

               if ($result->num_rows > 0) {
                   // output data of each row
                 while($row = $result->fetch_assoc()) {
                  $class = (isset($_GET['update']) && $_GET['update'] == $row["id"])?'parent':'';
                  echo "<tr class='{$class}'><td> " . $row["id"]. " </td><td> " . $row["subject"]." </td><td> " . $row["teacher"]." </td><td> " . $row["class"]. "</td><td>" . $row["day"]. "</td><td>" . $row["stime"]. "</td><td>" . $row["etime"]. "</td></tr>";
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