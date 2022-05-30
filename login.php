<?php
session_start();
include_once 'database.php';
$message = '';
if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $sql = "SELECT * FROM user WHERE email ='".$email."' and password = '".$password."' ";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
// output data of each row
    while($row = $result->fetch_assoc()) {
      $_SESSION['role'] = $row['role'];
      $_SESSION['user'] = $row['fname']." ".$row['lname'];
    }
    $role_table = strtolower($_SESSION['role']);
    $sql2 = "SELECT * FROM `".$role_table."` WHERE `email` ='".$email."'";
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
      while($row2 = $result2->fetch_assoc()) {
        $_SESSION['user'] = $row2['fname']." ".$row2['lname'];
//$_SESSION['uid'] = $row2['pid'];
        if($_SESSION['role']=='Student'){
          $_SESSION['uid']=$row2['sid'];
        }else if($_SESSION['role']=='Parent'){
          $_SESSION['uid']=$row2['pid'];
        }else if($_SESSION['role']=='Teacher'){
          $_SESSION['uid']=$row2['tid'];
        }
      }
    }
    header("Location:./");
  }else{
    $message = "<p style='width:100%;text-align;center'>Incorrect username or password</p>";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title><title>Admin Dashboard</title><link rel="icon" href="../img/favicon2.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap -->
  <link href="assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="assets/vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- Custom Theme Style -->
  <link href="assets/css/custom.css" rel="stylesheet">
</head>
<body class="login">
  <div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>
    <div class="login_wrapper">
      <div class="animate form login_form">
        <div class="text-center">
          <h2><i class="fa fa-institution"></i> Student Management System</h2>
        </div>
        <section class="login_content">
          <form  method="post">
            <h1>Login Form</h1>
            <div class="form-group has-feedback">
              <?php echo $message; ?>
              <input name="email" type="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group has-feedback">
              <input name="password" type="password" class="form-control" placeholder="Password">
            </div>
            <div class="row">
              <!-- /.col -->
              <div class="col-xs-12">
                <button name="submit" value="submit" type="submit" class="btn btn-success btn-block btn-flat">Sign In</button>
              </div>
              <!-- /.col -->
              <div>
                <p>©<?php echo date('Y'); ?> All Rights Reserved. Student management system</p>
              </div>
            </div>
          </form>
        </section>
      </div>
    </div>
  </div>
</body>