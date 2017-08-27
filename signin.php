<?php
session_start();

require_once('config.php');
require_once('functions.php');

if(checkLog()) {
  echo "<script>document.location.href = 'index.php';</script>";
}

if(isset($_POST['actSignin'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $encrypt = md5($password);

  $check = mysqli_query($conn, "SELECT * FROM base_users WHERE usr_login = '$username' AND usr_pwd = '$encrypt'");
  $count = mysqli_num_rows($check);
  $row = mysqli_fetch_array($check, MYSQLI_ASSOC);

  if(!empty($count)) {
    $_SESSION['engLog'] = true;
    $_SESSION['usrName'] = $row['usr_name'];

    echo "<script>document.location.href = 'index.php';</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Signin | Monitoring Firewall</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-table.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.min.css">
  </head>
  <body class="fmkb-dashboard">
    <main class="fmkb-main">
      <section class="fmkb-section-signin" style="margin-top: 100px;">
        <div class="container-fluid">
          <div class="row">
            <h1 class="text-center">Signin with your account.</h1>
          </div>
          <div class="row">
            <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
              <div class="panel panel-default">
                <div class="panel-body">
                  <form action="" method="POST" role="form">
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" name="username" id="inputUsername" class="form-control" value="" required="required" title="Username" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" name="password" id="inputPassword" class="form-control" value="" required="required" title="Password" autocomplete="off">
                    </div>
                    <p class="text-right">
                      <button type="submit" name="actSignin" class="btn btn-primary">Signin</button>
                    </p>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap-table.min.js"></script>
    <script src="assets/js/bootstrap-table-id-ID.min.js"></script>
    <script src="assets/js/main.min.js"></script>
  </body>
</html>