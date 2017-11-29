<?php

session_start();


require 'lib/password.php';


require 'data/connect.php';


if(isset($_POST['register'])){

    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $pass = !empty($_POST['password']) ? trim($_POST['password']) : null;
        $name = !empty($_POST['name']) ? trim($_POST['name']) : null;
    $sname = !empty($_POST['sname']) ? trim($_POST['sname']) : null;
        $cnum = !empty($_POST['cnum']) ? trim($_POST['cnum']) : null;
  
    
   
 
    $sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':username', $username);
 
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
 
    if($row['num'] > 0){
        die('That username already exists!');
    }
    
 
    $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));
    

    $sql = "INSERT INTO users (username, password, name, sname, cnum) VALUES (:username, :password, :name, :sname, :cnum)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':username', $username);
        $stmt->bindValue(':name', $name);
            $stmt->bindValue(':sname', $sname);
                $stmt->bindValue(':cnum', $cnum);

    $stmt->bindValue(':password', $passwordHash);

 
    $result = $stmt->execute();
    
  
    if($result){
      
           $_SESSION['user_id'] = $user['id'];
            $_SESSION['logged_in'] = time();
            
            //Redirect to our protected page, which we called home.php
            header('Location:login.php');
            exit;
    }
    
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">


  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="#"><b>Kingdom Hall Scheduler</b></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>
      

    <form action="register.php" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Name" name="name" id="name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
        <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Surname" name="sname" id="sname">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" id="username" name="username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

                                          <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" id="password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Retype password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>

                                       <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Cellnumber" name="cnum" id="cnum">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit"  name="register"  class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
        Google+</a>
    </div>

    <a href="login.php" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>

 
</body>
</html>
