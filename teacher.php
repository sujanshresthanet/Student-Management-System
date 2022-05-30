<?php session_start();


include_once 'database.php';
if (!isset($_SESSION['user'])||$_SESSION['role']!='Teacher') {
  # code...
  header('Location:./logout.php');
}
?>
<?php

$tid =$fname =$lname = $classroom = $dob = $gender = $address = $parent=" ";


if(isset($_GET['update'])){
  $update = "SELECT * FROM teacher WHERE tid='".$_GET['update']."'";
  $result = $conn->query($update);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

      $tid = $row['tid'];
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
                <h2><?php echo (isset($_GET['update']))?"Update teacher":"Add teacher"; ?></h2>
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
                    $tid = $_POST['tid'];
                    $fname = $_POST['fname'];
                    $lname = $_POST['lname'];

                    $dob = date_format(new DateTime($_POST['dob']),'Y-m-d');
                //echo $dob;
                    $gender = $_POST['gender'];
                    $address = $_POST['address'];

                    $skill = $_POST['skill'];
                    $email = $_POST['email'];
                    $contact = $_POST['contact'];



                    try {




                      $sql = "INSERT INTO teacher (tid,fname,lname,bday,address,gender,skill,contact,email) VALUES ('".$tid."', '".$fname."', '".$lname."','".$dob."','".$address."','".$gender."','".$skill."','".$contact."','".$email."')";

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
                  $tid = $_POST['tid'];
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


                   $sql = "UPDATE teacher SET fname='".$fname."',lname='".$lname."',bday='".$dob."',address='".$address."',gender='".$gender."',skill='".$skill."',contact='".$contact."',email='".$email."' WHERE tid = '".$tid."'";

                   // $sql = "INSERT INTO Teacher (tid,fname,lname,bday,address,gender,skill,contact,email) VALUES ('".$tid."', '".$fname."', '".$lname."','".$dob."','".$address."','".$gender."','".$skill."','".$contact."','".$email."')";

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
                <label for="exampleInputPassword1">Teacher ID</label>
                <input name="tid" type="text" class="form-control" id="exampleInputPassword1"  required value=<?php echo "'".$tid."'"; ?>>
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">First Name</label>
                <input name="fname" type="text" class="form-control" id="exampleInputPassword1"  required value=<?php echo "'".$fname."'"; ?>>
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Last Name</label>
                <input name="lname" type="text" class="form-control" id="exampleInputPassword1"  required value=<?php echo "'".$lname."'"; ?>>
              </div>

              <div class="form-group">

                <label>Date of Birth</label>

                <div class="input-group date">
                  <input type="date" name='dob' class="form-control pull-right" id="datepicker" value=<?php echo "'".$dob."'"; ?>>
                </div>
                <!-- /.input group -->

              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Gender</label>
                <div class="radio ">
                  <label style="width: 100px"><input type="radio" name="gender" value="Male" <?php if($gender=='Male'){echo 'checked';} ?>> Male</label>
                  <label style="width: 100px"><input type="radio" name="gender" value="Female" <?php if($gender=='Female'){echo 'checked';} ?>> Female</label>

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
                <label for="exampleInputPassword1">Contact</label>
                <input name="contact" type="text" class="form-control" id="exampleInputPassword1"  required value=<?php echo "'".$contact."'"; ?>>
              </div>

              <div class="form-group">
                <label for="exampleFormControlTextarea1">Skills</label>
                <textarea name="skill" class="form-control" id="exampleFormControlTextarea1" rows="2"><?php echo $skill; ?></textarea>
              </div>






            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" name="submit" value="submit" class="btn btn-primary">Update Teacher</button>
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
                      <th>TID</th>
                      <th>Name</th>
                      <th>DOB</th>
                      <th>Gender</th>
                      <th>Address</th>
                      <th>Contact</th>
                      <th>Skills</th>
                      <th>Actions</th>
                    </tr>
                  </thead>


                  <tbody>
                    <?php

                    $sql = "SELECT * FROM teacher";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                   // output data of each row
                     while($row = $result->fetch_assoc()) {
                      $class = (isset($_GET['update']) && $_GET['update'] == $row["tid"])?'parent':'';
                      echo "<tr class='{$class}'><td> " . $row["tid"]. " </td><td> " . $row["fname"]." ". $row["lname"]. " </td><td> " . $row["bday"]. "</td><td>" . $row["gender"]. "</td><td>" . $row["address"]. "</td><td>" . $row["contact"]. "</td><td>" . $row["skill"]. "</td><td><a href='teacher.php?update=". $row["tid"]."'><small class='btn btn-sm btn-primary'>Update</small></a></td></tr>";
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