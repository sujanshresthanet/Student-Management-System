<?php session_start();


include_once 'database.php';
if (!isset($_SESSION['user'])||$_SESSION['role']!='Parent') {
  # code...
  header('Location:./logout.php');
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

          <div class="col-md-12">

            <div class="x_panel">
              <div class="x_title">
                <h2>All <small>Exam Reuslts</small></h2>
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
                           <th>Student ID</th>
                           <th>Full Name</th>
                           <th>Action</th>
                         </tr>
                       </thead>


                       <tbody>
                         <?php

                         $sql = "SELECT * FROM student where parent =".$_SESSION['uid'];
                         $result = $conn->query($sql);

                         if ($result->num_rows > 0) {
                   // output data of each row
                           while($row = $result->fetch_assoc()) {
                            echo "<tr><td> " . $row["sid"]. " </td><td> " . $row["fname"]." ". $row["lname"]. " </td><td><a href='examresults-par.php?sid=". $row["sid"]."'><small class='btn btn-sm btn-success'>View Results</small></a></td></tr>";
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