<?php session_start();


include_once 'database.php';
if (!isset($_SESSION['user'])) {
  # code...
  header('Location:./login.php');
}
?>
<?php


//include_once 'database.php';

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
          <div class="col-md-12">
            <div class="">
              <div class="x_content">

                <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="alert alert-success back-widget-set text-center">
                      <i class="fa fa-user fa-5x"></i>
                      <h3><?php $sql1="SELECT count(*) as a from student";
                      $result = $conn->query($sql1);

                      if ($result->num_rows > 0) {
                  // output data of each row
                        while($row = $result->fetch_assoc()) {
                          echo $row['a'];
                        }
                      }

                      ?></h3>
                      Total Students
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="alert alert-info back-widget-set text-center">
                      <i class="fa fa-black-tie fa-5x"></i>
                      <h3> <?php $sql2="SELECT count(*) as a from teacher";
                      $result = $conn->query($sql2);

                      if ($result->num_rows > 0) {
                  // output data of each row
                        while($row = $result->fetch_assoc()) {
                          echo $row['a'];
                        }
                      }

                      ?> </h3>
                      Total Teachers
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="alert alert-warning back-widget-set text-center">
                      <i class="fa fa-book fa-5x"></i>
                      <h3><?php $sql3="SELECT count(*) as a from subject";
                      $result = $conn->query($sql3);

                      if ($result->num_rows > 0) {
                  // output data of each row
                        while($row = $result->fetch_assoc()) {
                          echo $row['a'];
                        }
                      }

                      ?></h3>
                      Total Subjects
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="alert alert-danger back-widget-set text-center">
                      <i class="fa fa-users fa-5x"></i>
                      <h3><?php $sql4="SELECT count(*) as a from parent";
                      $result = $conn->query($sql4);

                      if ($result->num_rows > 0) {
                  // output data of each row
                        while($row = $result->fetch_assoc()) {
                          echo $row['a'];
                        }
                      }

                      ?></h3>
                      Registered Parents
                    </div>
                  </div>
                </div>


              </div>
            </div>
          </div>
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