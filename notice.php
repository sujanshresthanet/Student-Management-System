<?php session_start();


include_once 'database.php';
if (!isset($_SESSION['user'])||$_SESSION['role']!='Teacher') {
  # code...
  header('Location:./logout.php');
}
if (isset($_GET['delete'])) {

  $sql = "DELETE FROM notice WHERE id='".$_GET['delete']."'";
  $conn->query($sql);
   # code...
}
?>
<?php

$sid =$fname =$lname = $user = $dob = $gender = $address = $parent=" ";


if(isset($_GET['update'])){
  $update = "SELECT * FROM user WHERE sid='".$_GET['update']."'";
  $result = $conn->query($update);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $sid = $row['sid'];
      $fname = $row['fname'];
      $lname = $row['lname'];
      $user = $row['user'];
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
                <h2><?php echo (isset($_GET['update']))?"Update notice":"Add notice"; ?></h2>
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
                    $notice = $_POST['notice'];
                    $odience = $_POST['odience'];


              // $date = date_format(new DateTime($_POST['date']),'Y-m-d');
                //echo $dob;
               // $day = $_POST['day'];
                 // $stime = $_POST['stime'];
                 //  $grade = $_POST['grade'];






                    try {




                      $sql = "INSERT INTO notice(notice,odience,`date`) VALUES ('".$notice."', '".$odience."', now())";

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
                  Update User Successfully
                </div>

                <?php

                if (isset($_POST['submit'])) {
                  $sid = $_POST['sid'];
                  $fname = $_POST['fname'];
                  $lname = $_POST['lname'];
                  $user = $_POST['user'];
                  $email = $_POST['email'];
                  $dob = date_format(new DateTime($_POST['dob']),'Y-m-d');
                //echo $dob;
                  $gender = $_POST['gender'];
                  $address = $_POST['address'];

                  $parent = $_POST['parent'];





                  try {

                    $sql = "UPDATE user set fname='".$fname."',lname='".$lname."',bday='".$dob."',address='".$address."',gender='".$gender."',parent=".$parent.",user='".$user."',email='".$email."' where sid='".$sid."'";


                   // $sql = "INSERT INTO user (sid,fname,lname,bday,address,gender,parent,user) VALUES ('".$sid."', '".$fname."', '".$lname."','".$dob."','".$address."','".$gender."','".$parent."','".$user."')";

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
                  <label for="exampleFormControlTextarea1">Notice</label>
                  <textarea name="notice" class="form-control" id="exampleFormControlTextarea1" rows="10"></textarea>
                </div>



                <div class="form-group">
                  <label>Odience </label>
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="odience"><option >Select Odience</option>
                   <option value="All">All</option>
                   <option value="Student">Student</option>
                   <option value="Parent">Parent</option>

                 </select>
               </div>


             </div>
             <!-- /.box-body -->

             <div class="box-footer">
              <button type="submit" name="submit" value="submit" class="btn btn-primary">Add Notice</button>
            </div>
          </form>


        </div>
      </div>




    </div>

    <div class="col-md-9">

      <div class="x_panel">
        <div class="x_title">
          <h2>All <small>Notice</small></h2>
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
                      <th>Notice ID</th>

                      <th>Notice</th>

                      <th>Date and Time</th><th>Action</th>
                    </tr>
                  </thead>


                  <tbody>
                    <?php

                    $sql = "SELECT * FROM notice";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                   // output data of each row
                     while($row = $result->fetch_assoc()) {
                      echo "<tr><td> " . $row["id"]. " </td><td> " . $row["notice"]." </td><td> " . $row["date"]." </td>
                      <td><a href='notice.php?delete=". $row["id"]."' class='btn btn-sm btn-danger  delete-notice'><small class='label  bg-red'>Delete</small></a>
                      </td></tr>";
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

  $('a.delete-notice').click(function(){
    return confirm("Are you sure you want to delete?");
  });
</script>

</body>

</html>