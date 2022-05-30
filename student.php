<?php session_start();


include_once 'database.php';
if (!isset($_SESSION['user'])||$_SESSION['role']!='Teacher') {
  # code...
  header('Location:./logout.php');
}
?>
<?php

$sid =$fname =$lname = $classroom = $dob = $gender = $address = $parent=" ";


if(isset($_GET['update'])){
  $update = "SELECT * FROM student WHERE sid='".$_GET['update']."'";
  $result = $conn->query($update);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $sid = $row['sid'];
      $fname = $row['fname'];
      $lname = $row['lname'];
      $classroom = $row['classroom'];
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
                <h2><?php echo (isset($_GET['update']))?"Update student":"Add student"; ?></h2>
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
                    $sid = $_POST['sid'];
                    $fname = $_POST['fname'];
                    $lname = $_POST['lname'];
                    $email = $_POST['email'];
                    $classroom = $_POST['classroom'];

                    $dob = date_format(new DateTime($_POST['dob']),'Y-m-d');
                //echo $dob;
                    $gender = $_POST['gender'];
                    $address = $_POST['address'];
                    $parent=" ";
                    if(isset($_POST['parent'])){
                      $parent = $_POST['parent'];}





                      try {




                        $sql = "INSERT INTO student (sid,fname,lname,bday,address,gender,parent,classroom,email) VALUES ('".$sid."', '".$fname."', '".$lname."','".$dob."','".$address."','".$gender."','".$parent."','".$classroom."','".$email."')";

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
                    $sid = $_POST['sid'];
                    $fname = $_POST['fname'];
                    $lname = $_POST['lname'];
                    $classroom = $_POST['classroom'];
                    $email = $_POST['email'];
                    $dob = date_format(new DateTime($_POST['dob']),'Y-m-d');
                //echo $dob;
                    $gender = $_POST['gender'];
                    $address = $_POST['address'];

                    $parent = $_POST['parent'];





                    try {

                      $sql = "UPDATE student set fname='".$fname."',lname='".$lname."',bday='".$dob."',address='".$address."',gender='".$gender."',parent=".$parent.",classroom='".$classroom."',email='".$email."' where sid='".$sid."'";


                   // $sql = "INSERT INTO student (sid,fname,lname,bday,address,gender,parent,classroom) VALUES ('".$sid."', '".$fname."', '".$lname."','".$dob."','".$address."','".$gender."','".$parent."','".$classroom."')";

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
                  <label for="exampleInputPassword1">Student ID</label>
                  <input name="sid" type="text" class="form-control" id="exampleInputPassword1"  required value=<?php echo "'".$sid."'"; ?>>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">First Name</label>
                  <input name="fname" type="text" class="form-control" id="exampleInputPassword1" required value=<?php echo "'".$fname."'"; ?>>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Last Name</label>
                  <input name="lname" type="text" class="form-control" id="exampleInputPassword1"  required value=<?php echo "'".$lname."'"; ?>>
                </div>

                <div class="form-group">

                  <label>Date of Birth</label>

                  <div class="input-group date">
                    <input type="date" name='dob' class="form-control pull-right" id="datepicker" placeholder="Select Student's Data of Birth" value=<?php echo "'".$dob."'"; ?>>
                  </div>
                  <!-- /.input group -->

                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Gender</label>
                  <div class="radio ">
                    <label><input type="radio" name="gender" value="Male"  <?php if($gender=='Male'){echo 'checked';} ?>> Male</label>
                  </div>
                  <div class="radio ">
                    <label><input type="radio" name="gender" value="Female" <?php if($gender=='Female'){echo 'checked';} ?>> Female</label>

                  </div>

                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Email</label>
                  <input name="email" type="email" class="form-control" id="exampleInputPassword1"  required value=<?php echo "'".$email."'"; ?>>
                </div>



                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Address</label>
                  <textarea name="address" class="form-control" id="exampleFormControlTextarea1" rows="2"><?php echo $address; ?></textarea>
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
                      echo "<option "; if($classroom==$row["hno"]){echo 'selected="selected"';} echo " value='".$row["hno"]."' >".$row["title"]."_ID:".$row["hno"]."</option>";
                    }
                  }
                  ?>
                </select>
              </div>


              <div class="form-group">

                <label>Parent</label>
                <select name="parent" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" >
                 <option value="0">Select Parent</option>

                 <?php

                 $sql = "SELECT * FROM parent";
                 $result = $conn->query($sql);

                 if ($result->num_rows > 0) {
                   // output data of each row
                   while($row = $result->fetch_assoc()) {


                    echo "<option "; if($parent==$row["pid"]){echo 'selected="selected"';} echo " value='".$row["pid"]."' >".$row["fname"]." ".$row["lname"]." - ID:".$row["pid"]."</option>";
                  }
                }

                ?>
              </select>

            </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" name="submit" value="submit" class="btn btn-primary">Update Student</button>
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
                   <th>SID</th>
                   <th>Name</th>
                   <th>DOB</th>
                   <th>Gender</th>
                   <th>Address</th>
                   <th>Classroom</th>
                   <th>Parent</th>
                   <th>Actions</th>
                 </tr>
               </thead>


               <tbody>
                 <?php

                 $sql = "SELECT * FROM student";
                 $result = $conn->query($sql);

                 if ($result->num_rows > 0) {
                   // output data of each row
                   while($row = $result->fetch_assoc()) {
                    $class = (isset($_GET['update']) && $_GET['update'] == $row["sid"])?'parent':'';
                    echo "<tr class='{$class}'><td> " . $row["sid"]. " </td><td> " . $row["fname"]." ". $row["lname"]. " </td><td> " . $row["bday"]. "</td><td>" . $row["gender"]. "</td><td>" . $row["address"]. "</td><td>" . $row["classroom"]. "</td><td>" . $row["parent"]. "</td><td><a href='student.php?update=". $row["sid"]."'><small class='btn btn-sm btn-primary'>Update</small></a></td></tr>";
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