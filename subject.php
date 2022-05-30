<?php session_start();


include_once 'database.php';
if (!isset($_SESSION['user'])||$_SESSION['role']!='Teacher') {
  # code...
  header('Location:./logout.php');
}
?>
<?php

$sid =$fname =$lname = $classroom = $dob = $gender = $address = $subject=" ";


if(isset($_GET['update'])){
  $update = "SELECT * FROM subject WHERE sid='".$_GET['update']."'";
  $result = $conn->query($update);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $sid = $row['sid'];
      $title = $row['title'];
      $description = $row['description'];

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
                <h2><?php echo (isset($_GET['update']))?"Update subject":"Add subject"; ?></h2>
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
                    $title = $_POST['title'];
                    $description = $_POST['description'];




                    try {




                      $sql = "INSERT INTO subject (sid,title,description) VALUES ( '".$sid."', '".$title."','".$description."')";

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
                  $title = $_POST['title'];
                  $description = $_POST['description'];




                  try {



                    $sql = "UPDATE subject set title='".$title."',description='".$description."' where sid = '".$sid."' " ;
                  //  $sql = "INSERT INTO subject (sid,title,description) VALUES ( '".$sid."', '".$title."','".$description."')";

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
                  <label for="exampleInputPassword1">Subject ID</label>
                  <input name="sid" type="text" class="form-control required" id="exampleInputPassword1"  required value=<?php echo "'".$sid."'"; ?> <?php if(isset($_GET['update'])):?>disabled<?php endif; ?>>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Subject Title</label>
                  <input name="title" type="text" class="form-control" id="exampleInputPassword1"  required value=<?php echo "'".$title."'"; ?>>
                </div>






                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Syllubus Details</label>
                  <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="10"><?php echo $description; ?></textarea>
                </div>




              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="submit" value="submit" class="btn btn-primary">Update Subject</button>
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
                        <th>Subject ID</th>
                        <th>Title</th>
                        <th>Details</th>
                        <th>Action</th>
                      </tr>
                    </thead>


                    <tbody>
                      <?php

                      $sql = "SELECT * FROM subject";
                      $result = $conn->query($sql);

                      if ($result->num_rows > 0) {
                   // output data of each row
                       while($row = $result->fetch_assoc()) {
                        $class = (isset($_GET['update']) && $_GET['update'] == $row["sid"])?'subject':'';
                        echo "<tr class='{$class}'><td> " . $row["sid"]. " </td><td> " . $row["title"]. "</td><td>" . $row["description"]. "</td><td><a href='subject.php?update=". $row["sid"]."'><small class='btn btn-sm btn-primary'>Update</small></a></td></tr>";
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