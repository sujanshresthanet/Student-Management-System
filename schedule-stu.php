<?php session_start();


include_once 'database.php';
if (!isset($_SESSION['user'])||$_SESSION['role']!='Student') {
  # code...
  header('Location:./logout.php');
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
  <title>Schedule</title><link rel="icon" href="../img/favicon2.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
      <div class="right_col">

        <div class="x_panel">
          <div class="x_title">
            <h2>All <small>Your Schedules</small></h2>
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
                        <th>Schedule ID</th>
                        <th>Subject</th>
                        <th>Teacher</th>
                        <th>Classroom</th>
                        <th>Day</th>
                        <th>Start Time</th>
                        <th>End Time</th>

                      </tr>
                    </thead>
                    <tbody>


                      <?php

                 // $sql = "select fname,lname from teacher where tid ='".$row["teacher"]."'";

                      $sql = "SELECT * FROM schedule where class = (SELECT classroom from student where sid ='".$_SESSION['uid']."')";
                      $result = $conn->query($sql);

                      if ($result->num_rows > 0) {
                   // output data of each row
                       while($row = $result->fetch_assoc()) {
                        $row2 = ($conn->query("select fname,lname from teacher where tid ='".$row["teacher"]."'"))->fetch_assoc();
                        $row3 = ($conn->query("select title from subject where sid ='".$row["subject"]."'"))->fetch_assoc();
                        echo "<tr><td> " . $row["id"]. " </td><td> " . $row["subject"]." - " . $row3["title"]." </td><td> " . $row2["fname"]."  " . $row2["lname"]."</td><td> " . $row["class"]. "</td><td>" . $row["day"]. "</td><td>" . $row["stime"]. "</td><td>" . $row["etime"]. "</td></tr>";
                      }
                    }

                    ?>


                  </tbody>
                  <tfoot>

                  </tfoot>
                </table>
              </div>
              <!-- /.box-body -->
            </div>

          </div>
          <!-- /.box -->



        </div>

      <!--------------------------
        | Your Page Content Here |
        -------------------------->

      </section>

      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->




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
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  });
  $('.select2').select2();
  $('#datepicker').datepicker({
    autoclose: true
  });



  var r = document.getElementById("schedule-stu");
  r.className += "active";



  $('.timepicker').timepicker({
    showInputs: false
  })

  $('#myDatepicker3, #myDatepicker4').datetimepicker({
    format: 'hh:mm A'
  });
</script>

</body>

</html>