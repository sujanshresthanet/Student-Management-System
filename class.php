<?php session_start();


include_once 'database.php';
if (!isset($_SESSION['user'])||$_SESSION['role']!='Teacher') {
  # code...
  header('Location:./logout.php');
}
?>
<?php

$hno =$fname =$lname = $classroom = $dob = $gender = $address = $parent=" ";


if(isset($_GET['update'])){
  $update = "SELECT * FROM classroom WHERE hno='".$_GET['update']."'";
  $result = $conn->query($update);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $hno = $row['hno'];
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
                <h2><?php echo (isset($_GET['update']))?"Update classroom":"Add classroom"; ?></h2>
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
                    $hno = $_POST['hno'];
                    $title = $_POST['title'];
                    $location = $_POST['location'];
                    $capacity = $_POST['capacity'];


                    try {




                      $sql = "INSERT INTO classroom(hno,title,location,capacity) VALUES ( '".$hno."', '".$title."','".$location."',".$capacity.")";

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
                  Update Classroom Successfully
                </div>

                <?php

                if (isset($_POST['submit'])) {
                  $hno = $_POST['hno'];
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

                    $sql = "UPDATE classroom set fname='".$fname."',lname='".$lname."',bday='".$dob."',address='".$address."',gender='".$gender."',parent=".$parent.",classroom='".$classroom."',email='".$email."' where hno='".$hno."'";


                   // $sql = "INSERT INTO classroom (hno,fname,lname,bday,address,gender,parent,classroom) VALUES ('".$hno."', '".$fname."', '".$lname."','".$dob."','".$address."','".$gender."','".$parent."','".$classroom."')";

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
                  <label for="exampleInputPassword1">Class Room ID</label>
                  <input name="hno" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Class Room ID" required>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Class Room Title</label>
                  <input name="title" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Class Room Title" required>
                </div>


                <div class="form-group">
                  <label for="exampleInputPassword1">Location</label>
                  <input name="location" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Class Room Location" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Capacity</label>
                  <input name="capacity" type="number" class="form-control" id="exampleInputPassword1" placeholder="Enter Class Room Capacity" required>
                </div>








              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="submit" value="submit" class="btn btn-primary">Add Class Room</button>
              </div>
            </form>

          </div>
        </div>




      </div>

      <div class="col-md-9">

        <div class="x_panel">
          <div class="x_title">
            <h2>All <small>Classrooms</small></h2>
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

                     $sql = "SELECT * FROM classroom";
                     $result = $conn->query($sql);

                     if ($result->num_rows > 0) {
                   // output data of each row
                       while($row = $result->fetch_assoc()) {
                        $class = (isset($_GET['update']) && $_GET['update'] == $row["hno"])?'parent':'';
                        echo "<tr class='{$class}'><td> " . $row["hno"]. " </td><td> " . $row["title"]. "</td><td>" . $row["location"]. "</td><td>" . $row["capacity"]. "</td></tr>";
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